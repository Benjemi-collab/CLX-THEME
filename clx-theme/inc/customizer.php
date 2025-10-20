<?php
/**
 * Customizer settings for CLX Theme Pro.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register theme customizer options.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function clx_customize_register( $wp_customize ) {
    $wp_customize->add_panel(
        'clx_panel',
        array(
            'title'       => __( 'CLX', 'clx' ),
            'description' => __( 'Réglages spécifiques au thème CLX.', 'clx' ),
            'priority'    => 160,
        )
    );

    $wp_customize->add_section(
        'clx_hero_section',
        array(
            'title' => __( 'Hero', 'clx' ),
            'panel' => 'clx_panel',
        )
    );

    $wp_customize->add_setting(
        'clx_hero_video_id',
        array(
            'sanitize_callback' => 'clx_sanitize_video',
            'default'           => 0,
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'clx_hero_video_id',
            array(
                'label'       => __( 'Vidéo Hero', 'clx' ),
                'description' => __( 'Sélectionnez une vidéo paysage (16:9).', 'clx' ),
                'section'     => 'clx_hero_section',
                'mime_type'   => 'video',
            )
        )
    );

    $wp_customize->add_setting(
        'clx_hero_poster_id',
        array(
            'sanitize_callback' => 'clx_sanitize_image',
            'default'           => 0,
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'clx_hero_poster_id',
            array(
                'label'       => __( 'Poster Hero', 'clx' ),
                'description' => __( 'Image de fallback affichée avant le chargement de la vidéo.', 'clx' ),
                'section'     => 'clx_hero_section',
                'mime_type'   => 'image',
            )
        )
    );

    $wp_customize->add_setting(
        'clx_hero_title',
        array(
            'sanitize_callback' => 'clx_sanitize_text',
            'default'           => __( 'CLX orchestre vos contenus signature.', 'clx' ),
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'clx_hero_title',
        array(
            'label'   => __( 'Titre Hero', 'clx' ),
            'section' => 'clx_hero_section',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'clx_hero_sub',
        array(
            'sanitize_callback' => 'clx_sanitize_textarea',
            'default'           => __( 'Studio photo & vidéo premium pour marques ambitieuses.', 'clx' ),
            'transport'         => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'clx_hero_sub',
        array(
            'label'   => __( 'Sous-titre Hero', 'clx' ),
            'section' => 'clx_hero_section',
            'type'    => 'textarea',
        )
    );

    $wp_customize->add_section(
        'clx_showreel_section',
        array(
            'title' => __( 'Showreel', 'clx' ),
            'panel' => 'clx_panel',
        )
    );

    $wp_customize->add_setting(
        'clx_showreel_video_id',
        array(
            'sanitize_callback' => 'clx_sanitize_video',
            'default'           => 0,
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'clx_showreel_video_id',
            array(
                'label'       => __( 'Vidéo Showreel', 'clx' ),
                'description' => __( 'Vidéo de démonstration pour la section showreel.', 'clx' ),
                'section'     => 'clx_showreel_section',
                'mime_type'   => 'video',
            )
        )
    );

    $wp_customize->add_section(
        'clx_appearance_section',
        array(
            'title' => __( 'Apparence', 'clx' ),
            'panel' => 'clx_panel',
        )
    );

    $wp_customize->add_setting(
        'clx_accent_color',
        array(
            'sanitize_callback' => 'clx_sanitize_hex_color',
            'default'           => '',
        )
    );

    $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'clx_accent_color',
                array(
                    'label'   => __( 'Couleur d\'accent', 'clx' ),
                    'section' => 'clx_appearance_section',
                )
            )
    );

    $wp_customize->add_setting(
        'clx_holo_enabled',
        array(
            'sanitize_callback' => 'clx_sanitize_checkbox',
            'default'           => false,
        )
    );

    $wp_customize->add_control(
        'clx_holo_enabled',
        array(
            'label'   => __( 'Activer les avatars holographiques', 'clx' ),
            'section' => 'clx_appearance_section',
            'type'    => 'checkbox',
        )
    );
}
add_action( 'customize_register', 'clx_customize_register' );

/**
 * Sanitize checkbox value.
 *
 * @param mixed $value Value to sanitize.
 * @return bool
 */
function clx_sanitize_checkbox( $value ) {
    return (bool) $value;
}

/**
 * Sanitize text inputs.
 *
 * @param string $value Value to sanitize.
 * @return string
 */
function clx_sanitize_text( $value ) {
    return sanitize_text_field( $value );
}

/**
 * Sanitize textarea content.
 *
 * @param string $value Value to sanitize.
 * @return string
 */
function clx_sanitize_textarea( $value ) {
    return wp_kses_post( $value );
}

/**
 * Sanitize image attachment.
 *
 * @param int $value Attachment ID.
 * @return int
 */
function clx_sanitize_image( $value ) {
    $value = (int) $value;

    if ( $value <= 0 ) {
        return 0;
    }

    $mime = get_post_mime_type( $value );

    if ( $mime && 0 === strpos( $mime, 'image/' ) ) {
        return $value;
    }

    return 0;
}

/**
 * Sanitize video attachment.
 *
 * @param int $value Attachment ID.
 * @return int
 */
function clx_sanitize_video( $value ) {
    $value = (int) $value;

    if ( $value <= 0 ) {
        return 0;
    }

    $mime = get_post_mime_type( $value );

    if ( $mime && 0 === strpos( $mime, 'video/' ) ) {
        return $value;
    }

    return 0;
}

/**
 * Sanitize hex color.
 *
 * @param string $value Color value.
 * @return string
 */
function clx_sanitize_hex_color( $value ) {
    $color = sanitize_hex_color( $value );

    return $color ? $color : '';
}
