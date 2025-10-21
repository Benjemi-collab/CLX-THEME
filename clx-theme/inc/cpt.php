<?php
/**
 * Custom post types for CLX theme.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register custom post types and meta.
 */
function clx_register_cpts(): void {
    $logo_labels = array(
        'name'               => __( 'Logos', 'clx' ),
        'singular_name'      => __( 'Logo', 'clx' ),
        'menu_name'          => __( 'Logos CLX', 'clx' ),
        'add_new'            => __( 'Ajouter un logo', 'clx' ),
        'add_new_item'       => __( 'Ajouter un logo partenaire', 'clx' ),
        'edit_item'          => __( 'Modifier le logo', 'clx' ),
        'new_item'           => __( 'Nouveau logo', 'clx' ),
        'view_item'          => __( 'Voir le logo', 'clx' ),
        'search_items'       => __( 'Rechercher un logo', 'clx' ),
        'not_found'          => __( 'Aucun logo trouvé.', 'clx' ),
        'not_found_in_trash' => __( 'Aucun logo dans la corbeille.', 'clx' ),
    );

    $logo_args = array(
        'labels'             => $logo_labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 22,
        'menu_icon'          => 'dashicons-awards',
        'supports'           => array( 'title', 'thumbnail' ),
        'show_in_rest'       => true,
        'hierarchical'       => false,
    );

    register_post_type( 'clx_logo', $logo_args );

    $team_labels = array(
        'name'               => __( 'Équipe', 'clx' ),
        'singular_name'      => __( 'Talent', 'clx' ),
        'menu_name'          => __( 'Crew CLX', 'clx' ),
        'add_new'            => __( 'Ajouter un talent', 'clx' ),
        'add_new_item'       => __( 'Ajouter un membre de l’équipe', 'clx' ),
        'edit_item'          => __( 'Modifier le talent', 'clx' ),
        'new_item'           => __( 'Nouveau talent', 'clx' ),
        'view_item'          => __( 'Voir le talent', 'clx' ),
        'search_items'       => __( 'Rechercher un talent', 'clx' ),
        'not_found'          => __( 'Aucun talent trouvé.', 'clx' ),
        'not_found_in_trash' => __( 'Aucun talent dans la corbeille.', 'clx' ),
    );

    $team_args = array(
        'labels'             => $team_labels,
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 23,
        'menu_icon'          => 'dashicons-groups',
        'supports'           => array( 'title', 'thumbnail', 'editor' ),
        'show_in_rest'       => true,
        'hierarchical'       => false,
    );

    register_post_type( 'clx_team', $team_args );

    register_post_meta(
        'clx_logo',
        'logo_url',
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'esc_url_raw',
            'show_in_rest'      => array(
                'schema' => array(
                    'type'   => 'string',
                    'format' => 'uri',
                ),
            ),
            'auth_callback'     => 'clx_meta_edit_capability',
        )
    );

    register_post_meta(
        'clx_team',
        'team_role',
        array(
            'type'              => 'string',
            'single'            => true,
            'sanitize_callback' => 'sanitize_text_field',
            'show_in_rest'      => true,
            'auth_callback'     => 'clx_meta_edit_capability',
        )
    );

    register_post_meta(
        'clx_team',
        'team_hover_id',
        array(
            'type'              => 'integer',
            'single'            => true,
            'sanitize_callback' => 'absint',
            'show_in_rest'      => array(
                'schema' => array(
                    'type' => 'integer',
                ),
            ),
            'auth_callback'     => 'clx_meta_edit_capability',
        )
    );
}
add_action( 'init', 'clx_register_cpts' );

/**
 * Control access to editing custom meta.
 *
 * @param bool   $allowed Whether the edit is allowed.
 * @param string $meta_key Meta key.
 * @param int    $post_id Post ID.
 * @param int    $user_id User ID.
 * @param string $cap Capability.
 * @param array  $caps Capabilities.
 * @return bool
 */
function clx_meta_edit_capability( $allowed, $meta_key, $post_id, $user_id, $cap, $caps ) {
    unset( $meta_key, $user_id, $cap, $caps );

    return current_user_can( 'edit_post', $post_id );
}

/**
 * Register meta boxes for CPT fields.
 */
function clx_add_cpt_meta_boxes(): void {
    add_meta_box( 'clx_logo_meta', __( 'Lien partenaire', 'clx' ), 'clx_render_logo_meta_box', 'clx_logo', 'normal', 'default' );
    add_meta_box( 'clx_team_meta', __( 'Infos talent', 'clx' ), 'clx_render_team_meta_box', 'clx_team', 'normal', 'default' );
}
add_action( 'add_meta_boxes', 'clx_add_cpt_meta_boxes' );

/**
 * Render logo meta box.
 *
 * @param WP_Post $post Post object.
 */
function clx_render_logo_meta_box( $post ): void {
    wp_nonce_field( 'clx_logo_meta', 'clx_logo_meta_nonce' );

    $logo_url = get_post_meta( $post->ID, 'logo_url', true );
    ?>
    <p>
        <label for="clx-logo-url"><?php esc_html_e( 'URL partenaire', 'clx' ); ?></label>
        <input type="url" class="widefat" id="clx-logo-url" name="clx_logo_url" value="<?php echo esc_attr( $logo_url ); ?>" placeholder="https://">
    </p>
    <?php
}

/**
 * Render team meta box.
 *
 * @param WP_Post $post Post object.
 */
function clx_render_team_meta_box( $post ): void {
    wp_nonce_field( 'clx_team_meta', 'clx_team_meta_nonce' );

    $team_role   = get_post_meta( $post->ID, 'team_role', true );
    $hover_image = absint( get_post_meta( $post->ID, 'team_hover_id', true ) );
    ?>
    <p>
        <label for="clx-team-role"><?php esc_html_e( 'Rôle / spécialité', 'clx' ); ?></label>
        <input type="text" class="widefat" id="clx-team-role" name="clx_team_role" value="<?php echo esc_attr( $team_role ); ?>" placeholder="Réalisation live, DOP, Motion..."></p>
    <p>
        <label for="clx-team-hover"><?php esc_html_e( 'ID image hover (optionnel)', 'clx' ); ?></label>
        <input type="number" class="small-text" id="clx-team-hover" name="clx_team_hover_id" value="<?php echo esc_attr( $hover_image ); ?>" min="0">
        <br><span class="description"><?php esc_html_e( 'ID de la media library pour la photo alternative.', 'clx' ); ?></span>
    </p>
    <?php
}

/**
 * Save logo meta data.
 *
 * @param int $post_id Post ID.
 */
function clx_save_logo_meta( int $post_id ): void {
    if ( ! isset( $_POST['clx_logo_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['clx_logo_meta_nonce'] ) ), 'clx_logo_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $logo_url = isset( $_POST['clx_logo_url'] ) ? esc_url_raw( wp_unslash( $_POST['clx_logo_url'] ) ) : '';
    update_post_meta( $post_id, 'logo_url', $logo_url );
}
add_action( 'save_post_clx_logo', 'clx_save_logo_meta' );

/**
 * Save team meta data.
 *
 * @param int $post_id Post ID.
 */
function clx_save_team_meta( int $post_id ): void {
    if ( ! isset( $_POST['clx_team_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['clx_team_meta_nonce'] ) ), 'clx_team_meta' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $role     = isset( $_POST['clx_team_role'] ) ? sanitize_text_field( wp_unslash( $_POST['clx_team_role'] ) ) : '';
    $hover_id = isset( $_POST['clx_team_hover_id'] ) ? absint( $_POST['clx_team_hover_id'] ) : 0;

    update_post_meta( $post_id, 'team_role', $role );
    update_post_meta( $post_id, 'team_hover_id', $hover_id );
}
add_action( 'save_post_clx_team', 'clx_save_team_meta' );
