<?php
/**
 * Theme functions and definitions.
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
	 * Configure theme defaults.
	 */
	function clx_theme_setup() {
		load_theme_textdomain( 'clx', get_template_directory() . '/languages' );

		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-logo', array(
			'height'      => 64,
			'width'       => 220,
			'flex-height' => true,
			'flex-width'  => true,
		) );
		add_theme_support( 'html5', array(
			'comment-list',
			'comment-form',
			'search-form',
			'gallery',
			'caption',
		) );

		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'clx' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'clx_theme_setup' );

if ( ! function_exists( 'clx_theme_scripts' ) ) {
	/**
	 * Enqueue theme assets.
	 */
	function clx_theme_scripts() {
		$theme_dir   = get_template_directory();
		$theme_uri   = get_template_directory_uri();
		$style_path  = $theme_dir . '/assets/css/main.css';
		$script_path = $theme_dir . '/assets/js/main.js';

		$style_version  = file_exists( $style_path ) ? (string) filemtime( $style_path ) : CLX_THEME_VERSION;
		$script_version = file_exists( $script_path ) ? (string) filemtime( $script_path ) : CLX_THEME_VERSION;

		wp_enqueue_style( 'clx-main', $theme_uri . '/assets/css/main.css', array(), $style_version );
		wp_enqueue_script( 'clx-main', $theme_uri . '/assets/js/main.js', array(), $script_version, true );
	}
}
add_action( 'wp_enqueue_scripts', 'clx_theme_scripts' );

if ( ! function_exists( 'clx_theme_preload_hero_video' ) ) {
	/**
	 * Preload the hero video when configured.
	 */
	function clx_theme_preload_hero_video() {
		$hero_id = absint( get_theme_mod( 'clx_hero_video_id' ) );

		if ( ! $hero_id ) {
			return;
		}

		$video_url = wp_get_attachment_url( $hero_id );

		if ( ! $video_url ) {
			return;
		}

		echo '<link rel="preload" as="video" href="' . esc_url( $video_url ) . '">' . "\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'clx_theme_preload_hero_video', 1 );

if ( ! function_exists( 'clx_theme_disable_emojis' ) ) {
	/**
	 * Disable WordPress emojis for performance.
	 */
	function clx_theme_disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'emoji_svg_url', '__return_false' );
	}
}
add_action( 'init', 'clx_theme_disable_emojis' );

if ( ! function_exists( 'clx_theme_disable_emojis_tinymce' ) ) {
	/**
	 * Remove the emoji plugin from TinyMCE.
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
}
add_filter( 'tiny_mce_plugins', 'clx_theme_disable_emojis_tinymce' );
