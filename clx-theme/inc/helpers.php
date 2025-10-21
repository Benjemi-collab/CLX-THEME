<?php
/**
 * Helper functions.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Retrieve a sanitized theme mod string.
 *
 * @param string $name    Theme mod key.
 * @param string $default Default value.
 * @return string
 */
function clx_get_theme_string( string $name, string $default = '' ): string {
	$value = get_theme_mod( $name, $default );

	if ( is_string( $value ) || is_numeric( $value ) ) {
		return (string) $value;
	}

	return $default;
}

/**
 * Get an attachment image data set.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $size          Image size.
 * @return array{src:string,srcset:string,sizes:string,alt:string}
 */
function clx_get_image_data( int $attachment_id, string $size = 'full' ): array {
	$attachment_id = absint( $attachment_id );

	if ( ! $attachment_id ) {
		return array(
			'src'    => '',
			'srcset' => '',
			'sizes'  => '',
			'alt'    => '',
		);
	}

	$image  = wp_get_attachment_image_src( $attachment_id, $size );
	$srcset = wp_get_attachment_image_srcset( $attachment_id, $size ) ?: '';
	$sizes  = wp_get_attachment_image_sizes( $attachment_id, $size ) ?: '';
	$alt    = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

	return array(
		'src'    => $image ? (string) $image[0] : '',
		'srcset' => (string) $srcset,
		'sizes'  => (string) $sizes,
		'alt'    => $alt ? sanitize_text_field( $alt ) : '',
	);
}

/**
 * Retrieve an attachment URL for media (video/audio/etc.).
 *
 * @param int $attachment_id Attachment ID.
 * @return string
 */
function clx_get_media_url( int $attachment_id ): string {
	$attachment_id = absint( $attachment_id );

	if ( ! $attachment_id ) {
		return '';
	}

	$url = wp_get_attachment_url( $attachment_id );

	return $url ? (string) $url : '';
}
