<?php
/**
 * Theme bootstrap.
 *
 * @package CLX\Theme
 */

if ( ! defined( 'CLX_THEME_VERSION' ) ) {
    define( 'CLX_THEME_VERSION', '1.0.0' );
}

if ( ! defined( 'CLX_THEME_DIR' ) ) {
    define( 'CLX_THEME_DIR', get_template_directory() );
}

if ( ! defined( 'CLX_THEME_URI' ) ) {
    define( 'CLX_THEME_URI', get_template_directory_uri() );
}

require_once CLX_THEME_DIR . '/inc/helpers.php';
require_once CLX_THEME_DIR . '/inc/customizer.php';
require_once CLX_THEME_DIR . '/inc/cpt.php';
require_once CLX_THEME_DIR . '/inc/patterns.php';

if ( ! function_exists( 'clx_theme_setup' ) ) {
    /**
     * Set up theme defaults and registers support for various WordPress features.
     */
    function clx_theme_setup() {
        load_theme_textdomain( 'clx', CLX_THEME_DIR . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-logo', [
            'height'      => 64,
            'width'       => 240,
            'flex-height' => true,
            'flex-width'  => true,
        ] );

        add_theme_support( 'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ] );

        register_nav_menus( [
            'primary' => __( 'Primary Menu', 'clx' ),
            'footer'  => __( 'Footer Menu', 'clx' ),
        ] );
    }
}
add_action( 'after_setup_theme', 'clx_theme_setup' );

if ( ! function_exists( 'clx_theme_scripts' ) ) {
    /**
     * Enqueue scripts and styles.
     */
    function clx_theme_scripts() {
        $style_path = 'assets/css/main.css';
        $style_uri  = trailingslashit( CLX_THEME_URI ) . $style_path;
        $style_ver  = clx_get_asset_version( $style_path );

        wp_enqueue_style( 'clx-theme', $style_uri, [], $style_ver );

        $script_path = 'assets/js/main.js';
        $script_uri  = trailingslashit( CLX_THEME_URI ) . $script_path;
        $script_ver  = clx_get_asset_version( $script_path );

        wp_enqueue_script( 'clx-theme', $script_uri, [], $script_ver, true );
    }
}
add_action( 'wp_enqueue_scripts', 'clx_theme_scripts' );

if ( ! function_exists( 'clx_theme_editor_styles' ) ) {
    /**
     * Enqueue editor styles for the block editor.
     */
    function clx_theme_editor_styles() {
        add_editor_style( 'assets/css/main.css' );
    }
}
add_action( 'after_setup_theme', 'clx_theme_editor_styles' );

if ( ! function_exists( 'clx_preload_hero_video' ) ) {
    /**
     * Preload hero video on the front page.
     */
    function clx_preload_hero_video() {
        if ( ! is_front_page() ) {
            return;
        }

        $video_id  = absint( get_theme_mod( 'clx_hero_video_id', 0 ) );
        $video_url = clx_media_url( $video_id );

        if ( '' === $video_url ) {
            return;
        }

        $mime_type = $video_id ? get_post_mime_type( $video_id ) : '';
        ?>
        <link rel="preload" as="video" href="<?php echo esc_url( $video_url ); ?>"<?php if ( $mime_type ) : ?> type="<?php echo esc_attr( $mime_type ); ?>"<?php endif; ?> />
        <?php
    }
}
add_action( 'wp_head', 'clx_preload_hero_video', 1 );
