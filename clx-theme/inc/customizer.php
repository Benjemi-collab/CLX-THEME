<?php
/**
 * Customizer settings.
 *
 * @package CLX\Theme
 */

if ( ! function_exists( 'clx_customize_register' ) ) {
    /**
     * Register customizer settings for the CLX theme.
     *
     * @param WP_Customize_Manager $wp_customize Customizer object.
     */
    function clx_customize_register( \WP_Customize_Manager $wp_customize ) {
        $wp_customize->add_panel(
            'clx_panel',
            [
                'title'       => __( 'CLX', 'clx' ),
                'description' => __( 'Options spécifiques au thème CLX Theme Pro.', 'clx' ),
                'priority'    => 160,
            ]
        );

        // Hero section.
        $wp_customize->add_section(
            'clx_hero_section',
            [
                'title'    => __( 'Hero', 'clx' ),
                'panel'    => 'clx_panel',
                'priority' => 10,
            ]
        );

        $wp_customize->add_setting(
            'clx_hero_video_id',
            [
                'default'           => 0,
                'sanitize_callback' => 'clx_sanitize_media_id',
            ]
        );

        $wp_customize->add_control(
            new \WP_Customize_Media_Control(
                $wp_customize,
                'clx_hero_video_id',
                [
                    'label'    => __( 'Vidéo du hero', 'clx' ),
                    'section'  => 'clx_hero_section',
                    'mime_type'=> 'video',
                ]
            )
        );

        $wp_customize->add_setting(
            'clx_hero_poster_id',
            [
                'default'           => 0,
                'sanitize_callback' => 'clx_sanitize_media_id',
            ]
        );

        $wp_customize->add_control(
            new \WP_Customize_Media_Control(
                $wp_customize,
                'clx_hero_poster_id',
                [
                    'label'    => __( 'Poster de la vidéo hero', 'clx' ),
                    'section'  => 'clx_hero_section',
                    'mime_type'=> 'image',
                ]
            )
        );

        $wp_customize->add_setting(
            'clx_hero_title',
            [
                'default'           => '',
                'sanitize_callback' => 'clx_sanitize_text',
            ]
        );

        $wp_customize->add_control(
            'clx_hero_title',
            [
                'label'       => __( 'Titre hero', 'clx' ),
                'section'     => 'clx_hero_section',
                'type'        => 'text',
                'description' => __( 'Titre principal affiché dans le hero vidéo.', 'clx' ),
            ]
        );

        // Showreel section.
        $wp_customize->add_section(
            'clx_showreel_section',
            [
                'title'    => __( 'Showreel', 'clx' ),
                'panel'    => 'clx_panel',
                'priority' => 20,
            ]
        );

        $wp_customize->add_setting(
            'clx_showreel_video_id',
            [
                'default'           => 0,
                'sanitize_callback' => 'clx_sanitize_media_id',
            ]
        );

        $wp_customize->add_control(
            new \WP_Customize_Media_Control(
                $wp_customize,
                'clx_showreel_video_id',
                [
                    'label'    => __( 'Vidéo Showreel', 'clx' ),
                    'section'  => 'clx_showreel_section',
                    'mime_type'=> 'video',
                ]
            )
        );

        // Appearance section.
        $wp_customize->add_section(
            'clx_appearance_section',
            [
                'title'    => __( 'Apparence', 'clx' ),
                'panel'    => 'clx_panel',
                'priority' => 30,
            ]
        );

        $wp_customize->add_setting(
            'clx_accent_color',
            [
                'default'           => '',
                'sanitize_callback' => 'sanitize_hex_color',
            ]
        );

        $wp_customize->add_control(
            new \WP_Customize_Color_Control(
                $wp_customize,
                'clx_accent_color',
                [
                    'label'       => __( 'Couleur d\'accent', 'clx' ),
                    'description' => __( 'Optionnel, permet d\'adapter les détails colorés.', 'clx' ),
                    'section'     => 'clx_appearance_section',
                ]
            )
        );

        $wp_customize->add_setting(
            'clx_holo_enabled',
            [
                'default'           => false,
                'sanitize_callback' => 'clx_sanitize_checkbox',
            ]
        );

        $wp_customize->add_control(
            'clx_holo_enabled',
            [
                'label'       => __( 'Activer l\'effet holo sur les avatars', 'clx' ),
                'section'     => 'clx_appearance_section',
                'type'        => 'checkbox',
                'description' => __( 'Active des reflets holographiques sur les visuels d\'équipe.', 'clx' ),
            ]
        );
    }
}
add_action( 'customize_register', 'clx_customize_register' );
