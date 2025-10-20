<?php
/**
 * Helper functions for CLX Theme Pro.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Retrieve a sanitized attachment URL.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $size          Image size.
 * @return string
 */
function clx_attachment_url( $attachment_id, $size = 'full' ) {
    $attachment_id = (int) $attachment_id;

    if ( $attachment_id <= 0 ) {
        return '';
    }

    if ( 'full' === $size ) {
        $url = wp_get_attachment_url( $attachment_id );
    } else {
        $image = wp_get_attachment_image_src( $attachment_id, $size );
        $url   = $image ? $image[0] : '';
    }

    return $url ? $url : '';
}

/**
 * Retrieve attachment image HTML with safe defaults.
 *
 * @param int    $attachment_id Attachment ID.
 * @param string $size          Image size.
 * @param array  $attr          Additional attributes.
 * @return string
 */
function clx_attachment_image( $attachment_id, $size = 'full', $attr = array() ) {
    $attachment_id = (int) $attachment_id;

    if ( $attachment_id <= 0 ) {
        return '';
    }

    $defaults = array(
        'loading' => 'lazy',
        'decoding' => 'async',
    );

    $attr = wp_parse_args( $attr, $defaults );

    return wp_get_attachment_image( $attachment_id, $size, false, $attr );
}

/**
 * Get sanitized integer post meta.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Meta key.
 * @return int
 */
function clx_get_meta_int( $post_id, $key ) {
    $post_id = (int) $post_id;
    $value   = get_post_meta( $post_id, $key, true );

    return (int) $value;
}

/**
 * Get sanitized text meta value.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Meta key.
 * @return string
 */
function clx_get_meta_text( $post_id, $key ) {
    $post_id = (int) $post_id;
    $value   = get_post_meta( $post_id, $key, true );

    return is_string( $value ) ? sanitize_text_field( $value ) : '';
}

/**
 * Build HTML attributes string safely.
 *
 * @param array $attributes Key => value pairs.
 * @return string
 */
function clx_html_attributes( $attributes ) {
    $output = array();

    foreach ( $attributes as $key => $value ) {
        if ( is_bool( $value ) ) {
            if ( $value ) {
                $output[] = esc_attr( $key );
            }
            continue;
        }

        if ( '' === $value || null === $value ) {
            continue;
        }

        $output[] = sprintf( '%s="%s"', esc_attr( $key ), esc_attr( $value ) );
    }

    return implode( ' ', $output );
}

/**
 * Fetch theme mod integer value safely.
 *
 * @param string $key Theme mod key.
 * @return int
 */
function clx_get_theme_mod_int( $key ) {
    return (int) get_theme_mod( $key );
}

/**
 * Fetch theme mod text value safely.
 *
 * @param string $key Theme mod key.
 * @return string
 */
function clx_get_theme_mod_text( $key ) {
    $value = get_theme_mod( $key );

    return is_string( $value ) ? wp_kses_post( $value ) : '';
}
