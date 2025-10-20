<?php
/**
 * Custom post types for CLX Theme Pro.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register custom post types.
 */
function clx_register_custom_post_types() {
    $logo_labels = array(
        'name'               => __( 'Logos', 'clx' ),
        'singular_name'      => __( 'Logo', 'clx' ),
        'add_new'            => __( 'Ajouter un logo', 'clx' ),
        'add_new_item'       => __( 'Ajouter un nouveau logo', 'clx' ),
        'edit_item'          => __( 'Modifier le logo', 'clx' ),
        'new_item'           => __( 'Nouveau logo', 'clx' ),
        'view_item'          => __( 'Voir le logo', 'clx' ),
        'search_items'       => __( 'Rechercher des logos', 'clx' ),
        'not_found'          => __( 'Aucun logo trouvé.', 'clx' ),
        'not_found_in_trash' => __( 'Aucun logo dans la corbeille.', 'clx' ),
        'menu_name'          => __( 'Logos CLX', 'clx' ),
    );

    register_post_type(
        'clx_logo',
        array(
            'labels'            => $logo_labels,
            'public'            => false,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_in_nav_menus' => false,
            'capability_type'   => 'post',
            'hierarchical'      => false,
            'supports'          => array( 'title', 'thumbnail' ),
            'menu_icon'         => 'dashicons-images-alt2',
            'menu_position'     => 20,
        )
    );

    $team_labels = array(
        'name'               => __( 'Talents CLX', 'clx' ),
        'singular_name'      => __( 'Talent CLX', 'clx' ),
        'add_new'            => __( 'Ajouter un talent', 'clx' ),
        'add_new_item'       => __( 'Ajouter un nouveau talent', 'clx' ),
        'edit_item'          => __( 'Modifier le talent', 'clx' ),
        'new_item'           => __( 'Nouveau talent', 'clx' ),
        'view_item'          => __( 'Voir le talent', 'clx' ),
        'search_items'       => __( 'Rechercher des talents', 'clx' ),
        'not_found'          => __( 'Aucun talent trouvé.', 'clx' ),
        'not_found_in_trash' => __( 'Aucun talent dans la corbeille.', 'clx' ),
        'menu_name'          => __( 'Équipe CLX', 'clx' ),
    );

    register_post_type(
        'clx_team',
        array(
            'labels'            => $team_labels,
            'public'            => false,
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_in_nav_menus' => false,
            'capability_type'   => 'post',
            'hierarchical'      => false,
            'supports'          => array( 'title', 'thumbnail', 'excerpt' ),
            'menu_icon'         => 'dashicons-groups',
            'menu_position'     => 21,
        )
    );
}
add_action( 'init', 'clx_register_custom_post_types' );

/**
 * Register custom post meta for CPTs.
 */
function clx_register_cpt_meta() {
    register_post_meta(
        'clx_logo',
        'logo_url',
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'clx_sanitize_logo_url',
            'show_in_rest'      => true,
        )
    );

    register_post_meta(
        'clx_team',
        'team_role',
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'clx_sanitize_team_role',
            'show_in_rest'      => true,
        )
    );

    register_post_meta(
        'clx_team',
        'team_hover_id',
        array(
            'type'              => 'integer',
            'single'            => true,
            'sanitize_callback' => 'clx_sanitize_hover_id',
            'show_in_rest'      => true,
        )
    );
}
add_action( 'init', 'clx_register_cpt_meta' );

/**
 * Add meta boxes.
 */
function clx_add_cpt_meta_boxes() {
    add_meta_box( 'clx_logo_meta', __( 'Lien logo', 'clx' ), 'clx_render_logo_meta_box', 'clx_logo', 'side', 'default' );
    add_meta_box( 'clx_team_meta', __( 'Détails du talent', 'clx' ), 'clx_render_team_meta_box', 'clx_team', 'normal', 'default' );
}
add_action( 'add_meta_boxes', 'clx_add_cpt_meta_boxes' );

/**
 * Render logo meta box.
 *
 * @param WP_Post $post Current post object.
 */
function clx_render_logo_meta_box( $post ) {
    wp_nonce_field( 'clx_save_logo_meta', 'clx_logo_meta_nonce' );

    $logo_url = get_post_meta( $post->ID, 'logo_url', true );
    ?>
    <p>
        <label class="screen-reader-text" for="clx_logo_url"><?php esc_html_e( 'URL du logo', 'clx' ); ?></label>
        <input type="url" name="clx_logo_url" id="clx_logo_url" class="widefat" value="<?php echo esc_attr( $logo_url ); ?>" placeholder="https://exemple.com">
    </p>
    <p class="description"><?php esc_html_e( 'Lien utilisé au survol des logos (optionnel).', 'clx' ); ?></p>
    <?php
}

/**
 * Render team meta box.
 *
 * @param WP_Post $post Current post object.
 */
function clx_render_team_meta_box( $post ) {
    wp_nonce_field( 'clx_save_team_meta', 'clx_team_meta_nonce' );

    $team_role   = get_post_meta( $post->ID, 'team_role', true );
    $hover_id    = (int) get_post_meta( $post->ID, 'team_hover_id', true );
    $hover_thumb = $hover_id ? wp_get_attachment_image( $hover_id, 'thumbnail' ) : '';
    ?>
    <p>
        <label for="clx_team_role"><?php esc_html_e( 'Rôle affiché', 'clx' ); ?></label>
        <input type="text" name="clx_team_role" id="clx_team_role" class="widefat" value="<?php echo esc_attr( $team_role ); ?>" placeholder="<?php esc_attr_e( 'Productrice live', 'clx' ); ?>">
    </p>
    <div class="clx-team-hover-field">
        <input type="hidden" name="clx_team_hover_id" id="clx_team_hover_id" value="<?php echo esc_attr( $hover_id ); ?>">
        <p class="clx-team-hover-actions">
            <button type="button" class="button clx-media-select" data-target="clx_team_hover_id" data-preview="clx-team-hover-preview" data-frame-title="<?php esc_attr_e( 'Sélectionner un visuel de survol', 'clx' ); ?>" data-button-text="<?php esc_attr_e( 'Utiliser cette image', 'clx' ); ?>"><?php esc_html_e( 'Choisir une image', 'clx' ); ?></button>
            <button type="button" class="button-link delete clx-media-clear" data-target="clx_team_hover_id" data-preview="clx-team-hover-preview"><?php esc_html_e( 'Retirer', 'clx' ); ?></button>
        </p>
        <div id="clx-team-hover-preview" class="clx-team-hover-preview" data-empty-text="<?php esc_attr_e( 'Aucun visuel secondaire sélectionné.', 'clx' ); ?>">
            <?php
            if ( $hover_thumb ) {
                echo $hover_thumb; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Generated via core helper.
            } else {
                echo '<p class="description">' . esc_html__( 'Aucun visuel secondaire sélectionné.', 'clx' ) . '</p>';
            }
            ?>
        </div>
    </div>
    <?php
}

/**
 * Save logo meta.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 */
function clx_save_logo_meta( $post_id, $post ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! isset( $_POST['clx_logo_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['clx_logo_meta_nonce'] ) ), 'clx_save_logo_meta' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $logo_url = isset( $_POST['clx_logo_url'] ) ? wp_unslash( $_POST['clx_logo_url'] ) : '';
    update_post_meta( $post_id, 'logo_url', clx_sanitize_logo_url( $logo_url ) );
}
add_action( 'save_post_clx_logo', 'clx_save_logo_meta', 10, 2 );

/**
 * Save team meta.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 */
function clx_save_team_meta( $post_id, $post ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! isset( $_POST['clx_team_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['clx_team_meta_nonce'] ) ), 'clx_save_team_meta' ) ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $team_role = isset( $_POST['clx_team_role'] ) ? wp_unslash( $_POST['clx_team_role'] ) : '';
    $hover_id  = isset( $_POST['clx_team_hover_id'] ) ? wp_unslash( $_POST['clx_team_hover_id'] ) : '';

    update_post_meta( $post_id, 'team_role', clx_sanitize_team_role( $team_role ) );
    update_post_meta( $post_id, 'team_hover_id', clx_sanitize_hover_id( $hover_id ) );
}
add_action( 'save_post_clx_team', 'clx_save_team_meta', 10, 2 );

/**
 * Sanitize logo URL meta.
 *
 * @param string $value URL value.
 * @return string
 */
function clx_sanitize_logo_url( $value ) {
    $value = (string) $value;

    return $value ? esc_url_raw( $value ) : '';
}

/**
 * Sanitize team role meta.
 *
 * @param string $value Role value.
 * @return string
 */
function clx_sanitize_team_role( $value ) {
    $value = (string) $value;

    return $value ? sanitize_text_field( $value ) : '';
}

/**
 * Sanitize hover image ID.
 *
 * @param mixed $value Hover ID.
 * @return int
 */
function clx_sanitize_hover_id( $value ) {
    $value = (int) $value;

    if ( $value <= 0 ) {
        return 0;
    }

    return $value;
}

/**
 * Enqueue admin assets for CPT meta.
 *
 * @param string $hook Current admin page hook.
 */
function clx_admin_meta_assets( $hook ) {
    global $typenow;

    if ( 'clx_team' !== $typenow ) {
        return;
    }

    wp_enqueue_media();

    $script_path = '/assets/js/admin-meta.js';
    $script_ver  = file_exists( get_template_directory() . $script_path ) ? filemtime( get_template_directory() . $script_path ) : CLX_THEME_VERSION;

    wp_enqueue_script( 'clx-admin-meta', get_template_directory_uri() . $script_path, array(), $script_ver, true );
}
add_action( 'admin_enqueue_scripts', 'clx_admin_meta_assets' );
