<?php
/**
 * Theme bootstrap functions.
 *
 * @package CLX
 */

if ( ! defined( 'CLX_THEME_VERSION' ) ) {
    define( 'CLX_THEME_VERSION', '1.0.0' );
}

require_once get_template_directory() . '/inc/helpers.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/patterns.php';

if ( ! function_exists( 'clx_theme_setup' ) ) {
    /**
     * Register theme supports and menus.
     */
    function clx_theme_setup() {
        load_theme_textdomain( 'clx', get_template_directory() . '/languages' );

        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-logo', array(
            'height'      => 56,
            'width'       => 168,
            'flex-height' => true,
            'flex-width'  => true,
        ) );
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ) );

        register_nav_menus(
            array(
                'primary' => __( 'Primary Menu', 'clx' ),
            )
        );
    }
}
add_action( 'after_setup_theme', 'clx_theme_setup' );

/**
 * Set the content width in pixels.
 */
function clx_theme_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'clx_theme_content_width', 860 );
}
add_action( 'after_setup_theme', 'clx_theme_content_width', 0 );

/**
 * Enqueue theme assets.
 */
function clx_theme_enqueue_assets() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    $style_path = '/assets/css/main.css';
    $style_ver  = file_exists( $theme_dir . $style_path ) ? filemtime( $theme_dir . $style_path ) : CLX_THEME_VERSION;
    wp_enqueue_style( 'clx-main', $theme_uri . $style_path, array(), $style_ver );

    $script_path = '/assets/js/main.js';
    $script_ver  = file_exists( $theme_dir . $script_path ) ? filemtime( $theme_dir . $script_path ) : CLX_THEME_VERSION;
    wp_enqueue_script( 'clx-main', $theme_uri . $script_path, array(), $script_ver, true );
}
add_action( 'wp_enqueue_scripts', 'clx_theme_enqueue_assets' );

/**
 * Disable emoji scripts and styles.
 */
function clx_theme_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'tiny_mce_plugins', 'clx_theme_disable_emojis_tinymce' );
    add_filter( 'wp_resource_hints', 'clx_theme_disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'clx_theme_disable_emojis' );

/**
 * Filter function for TinyMCE plugins.
 *
 * @param array $plugins TinyMCE plugins.
 * @return array
 */
function clx_theme_disable_emojis_tinymce( $plugins ) {
    if ( is_array( $plugins ) ) {
        $plugins = array_diff( $plugins, array( 'wpemoji' ) );
    }

    return $plugins;
}

/**
 * Remove emoji DNS prefetch.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed for.
 * @return array
 */
function clx_theme_disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/14.0.0/svg/' );
        $urls          = array_diff( $urls, array( $emoji_svg_url ) );
    }

    return $urls;
}

/**
 * Preload hero video asset when available.
 */
function clx_theme_preload_hero_video() {
    if ( ! is_front_page() ) {
        return;
    }

    $video_id = (int) get_theme_mod( 'clx_hero_video_id' );

    if ( $video_id <= 0 ) {
        return;
    }

    $video_url = clx_attachment_url( $video_id );

    if ( ! $video_url ) {
        return;
    }

    echo '<link rel="preload" as="video" href="' . esc_url( $video_url ) . '" />' . "\n";
}
add_action( 'wp_head', 'clx_theme_preload_hero_video', 1 );

/**
 * Add pill styling class to primary navigation links.
 *
 * @param array   $atts  Existing attributes.
 * @param WP_Post $item  Menu item.
 * @param stdClass $args Arguments.
 * @return array
 */
function clx_primary_nav_link_attributes( $atts, $item, $args ) {
    if ( isset( $args->theme_location ) && 'primary' === $args->theme_location ) {
        $existing       = isset( $atts['class'] ) ? $atts['class'] . ' ' : '';
        $atts['class'] = $existing . 'clx-pill-link';
    }

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'clx_primary_nav_link_attributes', 10, 3 );

/**
 * Fallback navigation for primary menu.
 *
 * @param stdClass|array $args Menu arguments.
 * @return void|string
 */
function clx_header_fallback_menu( $args ) {
    $items = array(
        array(
            'url'   => '#formules',
            'label' => __( 'Services', 'clx' ),
        ),
        array(
            'url'   => '#contact',
            'label' => __( 'Parler de mon projet', 'clx' ),
        ),
    );

    if ( is_array( $args ) ) {
        $args = (object) $args;
    }

    $menu_class = isset( $args->menu_class ) ? $args->menu_class : 'clx-menu-list';
    $wrap       = '<ul class="' . esc_attr( $menu_class ) . '">%s</ul>';

    $links = array();

    foreach ( $items as $item ) {
        $links[] = sprintf(
            '<li class="menu-item"><a class="clx-pill-link" href="%s"><span class="clx-pill-label">%s</span></a></li>',
            esc_url( $item['url'] ),
            esc_html( $item['label'] )
        );
    }

    $output = sprintf( $wrap, implode( '', $links ) );

    if ( isset( $args->echo ) && false === $args->echo ) {
        return $output;
    }

    echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Already escaped above.
}
