<?php
/**
 * Helper functions.
 *
 * @package CLX\Theme
 */

if ( ! function_exists( 'clx_get_asset_path' ) ) {
    /**
     * Retrieve the absolute path to a theme asset.
     *
     * @param string $relative Relative path from the theme root.
     * @return string Absolute path.
     */
    function clx_get_asset_path( $relative ) {
        $relative = ltrim( (string) $relative, '/' );

        return trailingslashit( CLX_THEME_DIR ) . $relative;
    }
}

if ( ! function_exists( 'clx_get_asset_uri' ) ) {
    /**
     * Retrieve the URI to a theme asset.
     *
     * @param string $relative Relative path from the theme root.
     * @return string Asset URI.
     */
    function clx_get_asset_uri( $relative ) {
        $relative = ltrim( (string) $relative, '/' );

        return trailingslashit( CLX_THEME_URI ) . $relative;
    }
}

if ( ! function_exists( 'clx_get_asset_version' ) ) {
    /**
     * Determine the version hash for an asset based on filemtime.
     *
     * @param string $relative Relative path from the theme root.
     * @return string Version string.
     */
    function clx_get_asset_version( $relative ) {
        $path = clx_get_asset_path( $relative );

        if ( file_exists( $path ) ) {
            return (string) filemtime( $path );
        }

        return CLX_THEME_VERSION;
    }
}

if ( ! function_exists( 'clx_attachment_url' ) ) {
    /**
     * Safely retrieve an attachment URL.
     *
     * @param int    $attachment_id Attachment ID.
     * @param string $size          Image size.
     * @return string Attachment URL or empty string.
     */
    function clx_attachment_url( $attachment_id, $size = 'full' ) {
        $attachment_id = absint( $attachment_id );

        if ( 0 === $attachment_id ) {
            return '';
        }

        $url = wp_get_attachment_image_url( $attachment_id, $size );

        return $url ? $url : '';
    }
}

if ( ! function_exists( 'clx_sanitize_media_id' ) ) {
    /**
     * Sanitize attachment IDs.
     *
     * @param mixed $value Value to sanitize.
     * @return int Sanitized attachment ID.
     */
    function clx_sanitize_media_id( $value ) {
        return absint( $value );
    }
}

if ( ! function_exists( 'clx_sanitize_checkbox' ) ) {
    /**
     * Sanitize checkbox values.
     *
     * @param mixed $value Value to sanitize.
     * @return bool Boolean value.
     */
    function clx_sanitize_checkbox( $value ) {
        return (bool) $value;
    }
}

if ( ! function_exists( 'clx_sanitize_text' ) ) {
    /**
     * Sanitize text fields.
     *
     * @param string $value Input text.
     * @return string Sanitized text.
     */
    function clx_sanitize_text( $value ) {
        return sanitize_text_field( (string) $value );
    }
}

if ( ! function_exists( 'clx_media_url' ) ) {
    /**
     * Retrieve a generic media URL.
     *
     * @param int $attachment_id Attachment ID.
     * @return string Media URL.
     */
    function clx_media_url( $attachment_id ) {
        $attachment_id = absint( $attachment_id );

        if ( 0 === $attachment_id ) {
            return '';
        }

        $url = wp_get_attachment_url( $attachment_id );

        return $url ? $url : '';
    }
}

if ( ! function_exists( 'clx_attachment_alt' ) ) {
    /**
     * Retrieve attachment alt text.
     *
     * @param int $attachment_id Attachment ID.
     * @return string Alt text.
     */
    function clx_attachment_alt( $attachment_id ) {
        $attachment_id = absint( $attachment_id );

        if ( 0 === $attachment_id ) {
            return '';
        }

        $alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );

        return $alt ? $alt : '';
    }
}
