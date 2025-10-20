<?php
/**
 * Custom post types and meta handling.
 *
 * @package CLX\Theme
 */

if ( ! function_exists( 'clx_register_custom_post_types' ) ) {
    /**
     * Register CLX custom post types.
     */
    function clx_register_custom_post_types() {
        $shared_labels = [
            'public'             => true,
            'publicly_queryable' => false,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_in_nav_menus' => false,
            'exclude_from_search' => true,
            'supports'         => [ 'title', 'thumbnail', 'editor' ],
            'has_archive'      => false,
            'rewrite'          => false,
        ];

        register_post_type(
            'clx_logo',
            wp_parse_args(
                [
                    'labels' => [
                        'name'          => __( 'Logos', 'clx' ),
                        'singular_name' => __( 'Logo', 'clx' ),
                        'add_new_item'  => __( 'Ajouter un logo client', 'clx' ),
                        'edit_item'     => __( 'Modifier le logo', 'clx' ),
                    ],
                    'menu_icon' => 'dashicons-awards',
                    'supports'  => [ 'title', 'thumbnail' ],
                ],
                $shared_labels
            )
        );

        register_post_type(
            'clx_team',
            wp_parse_args(
                [
                    'labels' => [
                        'name'          => __( 'Équipe CLX', 'clx' ),
                        'singular_name' => __( 'Membre de l\'équipe', 'clx' ),
                        'add_new_item'  => __( 'Ajouter un talent', 'clx' ),
                        'edit_item'     => __( 'Modifier le talent', 'clx' ),
                    ],
                    'menu_icon' => 'dashicons-groups',
                    'supports'  => [ 'title', 'thumbnail', 'editor' ],
                ],
                $shared_labels
            )
        );
    }
}
add_action( 'init', 'clx_register_custom_post_types' );

if ( ! function_exists( 'clx_register_cpt_meta' ) ) {
    /**
     * Register CPT meta fields.
     */
    function clx_register_cpt_meta() {
        register_post_meta(
            'clx_logo',
            'clx_logo_url',
            [
                'single'            => true,
                'type'              => 'string',
                'sanitize_callback' => 'esc_url_raw',
                'show_in_rest'      => true,
                'auth_callback'     => function() {
                    return current_user_can( 'edit_posts' );
                },
            ]
        );

        register_post_meta(
            'clx_team',
            'clx_team_role',
            [
                'single'            => true,
                'type'              => 'string',
                'sanitize_callback' => 'sanitize_text_field',
                'show_in_rest'      => true,
                'auth_callback'     => function() {
                    return current_user_can( 'edit_posts' );
                },
            ]
        );

        register_post_meta(
            'clx_team',
            'clx_team_hover_id',
            [
                'single'            => true,
                'type'              => 'integer',
                'sanitize_callback' => 'clx_sanitize_media_id',
                'show_in_rest'      => [
                    'schema' => [
                        'type' => 'integer',
                    ],
                ],
                'auth_callback'     => function() {
                    return current_user_can( 'edit_posts' );
                },
            ]
        );
    }
}
add_action( 'init', 'clx_register_cpt_meta' );

if ( ! function_exists( 'clx_add_cpt_meta_boxes' ) ) {
    /**
     * Register meta boxes for CPTs.
     */
    function clx_add_cpt_meta_boxes() {
        add_meta_box(
            'clx_logo_details',
            __( 'Lien du logo', 'clx' ),
            'clx_render_logo_metabox',
            'clx_logo',
            'normal',
            'default'
        );

        add_meta_box(
            'clx_team_details',
            __( 'Détails du membre', 'clx' ),
            'clx_render_team_metabox',
            'clx_team',
            'normal',
            'default'
        );
    }
}
add_action( 'add_meta_boxes', 'clx_add_cpt_meta_boxes' );

if ( ! function_exists( 'clx_render_logo_metabox' ) ) {
    /**
     * Render logo meta box.
     *
     * @param WP_Post $post Current post.
     */
    function clx_render_logo_metabox( $post ) {
        $logo_url = get_post_meta( $post->ID, 'clx_logo_url', true );

        wp_nonce_field( 'clx_save_logo_meta', 'clx_logo_nonce' );
        ?>
        <p>
            <label for="clx_logo_url" class="screen-reader-text"><?php esc_html_e( 'URL du site client', 'clx' ); ?></label>
            <input type="url" class="widefat" id="clx_logo_url" name="clx_logo_url" value="<?php echo esc_attr( $logo_url ); ?>" placeholder="https://" />
        </p>
        <p class="description"><?php esc_html_e( 'Optionnel : lien vers la page client ou la campagne.', 'clx' ); ?></p>
        <?php
    }
}

if ( ! function_exists( 'clx_render_team_metabox' ) ) {
    /**
     * Render team meta box.
     *
     * @param WP_Post $post Current post.
     */
    function clx_render_team_metabox( $post ) {
        $team_role     = get_post_meta( $post->ID, 'clx_team_role', true );
        $team_hover_id = absint( get_post_meta( $post->ID, 'clx_team_hover_id', true ) );
        $hover_preview = $team_hover_id ? wp_get_attachment_image( $team_hover_id, 'thumbnail' ) : '';

        wp_nonce_field( 'clx_save_team_meta', 'clx_team_nonce' );
        ?>
        <p>
            <label for="clx_team_role" class="screen-reader-text"><?php esc_html_e( 'Rôle', 'clx' ); ?></label>
            <input type="text" class="widefat" id="clx_team_role" name="clx_team_role" value="<?php echo esc_attr( $team_role ); ?>" placeholder="<?php esc_attr_e( 'Creative director, Producteur...', 'clx' ); ?>" />
        </p>
        <hr />
        <p>
            <strong><?php esc_html_e( 'Image au survol', 'clx' ); ?></strong>
        </p>
        <input type="hidden" id="clx_team_hover_id" name="clx_team_hover_id" value="<?php echo esc_attr( $team_hover_id ); ?>" />
        <div class="clx-media-actions">
            <button type="button" class="button clx-media-select" data-target="clx_team_hover_id" data-preview="clx_team_hover_preview" data-frame-title="<?php esc_attr_e( 'Sélectionner une image de survol', 'clx' ); ?>" data-button-text="<?php esc_attr_e( 'Utiliser cette image', 'clx' ); ?>"><?php esc_html_e( 'Choisir une image', 'clx' ); ?></button>
            <button type="button" class="button clx-media-clear" data-target="clx_team_hover_id" data-preview="clx_team_hover_preview"><?php esc_html_e( 'Retirer', 'clx' ); ?></button>
        </div>
        <div id="clx_team_hover_preview" class="clx-media-preview">
            <?php echo $hover_preview; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        </div>
        <?php
    }
}

if ( ! function_exists( 'clx_save_logo_meta' ) ) {
    /**
     * Save logo meta.
     *
     * @param int $post_id Post ID.
     */
    function clx_save_logo_meta( $post_id ) {
        if ( ! isset( $_POST['clx_logo_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['clx_logo_nonce'] ) ), 'clx_save_logo_meta' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( isset( $_POST['clx_logo_url'] ) ) {
            $logo_url = esc_url_raw( wp_unslash( $_POST['clx_logo_url'] ) );
            update_post_meta( $post_id, 'clx_logo_url', $logo_url );
        }
    }
}
add_action( 'save_post_clx_logo', 'clx_save_logo_meta' );

if ( ! function_exists( 'clx_save_team_meta' ) ) {
    /**
     * Save team meta.
     *
     * @param int $post_id Post ID.
     */
    function clx_save_team_meta( $post_id ) {
        if ( ! isset( $_POST['clx_team_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['clx_team_nonce'] ) ), 'clx_save_team_meta' ) ) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        if ( isset( $_POST['clx_team_role'] ) ) {
            $team_role = sanitize_text_field( wp_unslash( $_POST['clx_team_role'] ) );
            update_post_meta( $post_id, 'clx_team_role', $team_role );
        }

        if ( isset( $_POST['clx_team_hover_id'] ) ) {
            $hover_id = clx_sanitize_media_id( wp_unslash( $_POST['clx_team_hover_id'] ) );
            update_post_meta( $post_id, 'clx_team_hover_id', $hover_id );
        }
    }
}
add_action( 'save_post_clx_team', 'clx_save_team_meta' );

if ( ! function_exists( 'clx_enqueue_cpt_admin_assets' ) ) {
    /**
     * Enqueue admin assets for CPT meta boxes.
     *
     * @param string $hook Current admin page hook.
     */
    function clx_enqueue_cpt_admin_assets( $hook ) {
        global $typenow;

        if ( 'post.php' !== $hook && 'post-new.php' !== $hook ) {
            return;
        }

        if ( 'clx_team' !== $typenow ) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_script(
            'clx-admin-meta',
            trailingslashit( CLX_THEME_URI ) . 'assets/js/admin-meta.js',
            [],
            CLX_THEME_VERSION,
            true
        );
    }
}
add_action( 'admin_enqueue_scripts', 'clx_enqueue_cpt_admin_assets' );
