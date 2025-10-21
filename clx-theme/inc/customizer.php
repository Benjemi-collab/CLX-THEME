<?php
/**
 * Theme customizer settings.
 *
 * @package CLX
 */

use WP_Customize_Color_Control;
use WP_Customize_Manager;
use WP_Customize_Media_Control;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Sanitize checkbox/toggle values.
 *
 * @param mixed $value Value from the customizer.
 * @return int
 */
function clx_sanitize_toggle( $value ): int {
    return $value ? 1 : 0;
}

/**
 * Sanitize text field values.
 *
 * @param mixed $value Value from the customizer.
 * @return string
 */
function clx_sanitize_text_value( $value ): string {
    if ( is_string( $value ) ) {
        return sanitize_text_field( $value );
    }

    return '';
}

/**
 * Register customizer settings and controls.
 *
 * @param WP_Customize_Manager $wp_customize Customizer instance.
 */
function clx_customize_register( WP_Customize_Manager $wp_customize ): void {
    $wp_customize->add_panel(
        'clx_panel',
        array(
            'title'       => __( 'CLX', 'clx' ),
            'description' => __( 'Réglez les contenus ciné et l’apparence du thème CLX.', 'clx' ),
            'priority'    => 160,
        )
    );

    $wp_customize->add_section(
        'clx_section_hero',
        array(
            'title'    => __( 'Hero ciné', 'clx' ),
            'panel'    => 'clx_panel',
            'priority' => 10,
        )
    );

    $wp_customize->add_setting(
        'clx_hero_video_id',
        array(
            'default'           => 0,
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'clx_hero_video_id',
            array(
                'label'       => __( 'Vidéo hero (MP4)', 'clx' ),
                'section'     => 'clx_section_hero',
                'mime_type'   => 'video',
                'description' => __( 'Vidéo 16:9 silencieuse pour l’arrière-plan hero.', 'clx' ),
            )
        )
    );

    $wp_customize->add_setting(
        'clx_hero_poster_id',
        array(
            'default'           => 0,
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'clx_hero_poster_id',
            array(
                'label'       => __( 'Poster hero', 'clx' ),
                'section'     => 'clx_section_hero',
                'mime_type'   => 'image',
                'description' => __( 'Image fallback pour les navigateurs sans lecture auto.', 'clx' ),
            )
        )
    );

    $wp_customize->add_setting(
        'clx_hero_title',
        array(
            'default'           => __( 'CLX agence votre contenu cinématique & live', 'clx' ),
            'sanitize_callback' => 'clx_sanitize_text_value',
        )
    );

    $wp_customize->add_control(
        'clx_hero_title',
        array(
            'label'   => __( 'Titre hero', 'clx' ),
            'section' => 'clx_section_hero',
            'type'    => 'text',
        )
    );

    $wp_customize->add_setting(
        'clx_hero_sub',
        array(
            'default'           => __( 'Une task force créative pour orchestrer tournages, capsules sociales et expériences immersives.', 'clx' ),
            'sanitize_callback' => 'clx_sanitize_text_value',
        )
    );

    $wp_customize->add_control(
        'clx_hero_sub',
        array(
            'label'   => __( 'Sous-titre hero', 'clx' ),
            'section' => 'clx_section_hero',
            'type'    => 'text',
        )
    );

    $wp_customize->add_section(
        'clx_section_showreel',
        array(
            'title'    => __( 'Showreel', 'clx' ),
            'panel'    => 'clx_panel',
            'priority' => 20,
        )
    );

    $wp_customize->add_setting(
        'clx_showreel_video_id',
        array(
            'default'           => 0,
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Media_Control(
            $wp_customize,
            'clx_showreel_video_id',
            array(
                'label'       => __( 'Vidéo showreel', 'clx' ),
                'section'     => 'clx_section_showreel',
                'mime_type'   => 'video',
                'description' => __( 'Sélectionnez une vidéo haute qualité pour la section showreel.', 'clx' ),
            )
        )
    );

    $wp_customize->add_section(
        'clx_section_appearance',
        array(
            'title'    => __( 'Apparence', 'clx' ),
            'panel'    => 'clx_panel',
            'priority' => 30,
        )
    );

    $wp_customize->add_setting(
        'clx_holo_enabled',
        array(
            'default'           => 0,
            'sanitize_callback' => 'clx_sanitize_toggle',
        )
    );

    $wp_customize->add_control(
        'clx_holo_enabled',
        array(
            'label'       => __( 'Activer le mode holo (beta)', 'clx' ),
            'description' => __( 'Prépare les effets holographiques pour les futures mises à jour.', 'clx' ),
            'section'     => 'clx_section_appearance',
            'type'        => 'checkbox',
        )
    );

    $wp_customize->add_setting(
        'clx_accent_color',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_hex_color',
        )
    );

    if ( class_exists( WP_Customize_Color_Control::class ) ) {
        $wp_customize->add_control(
            new WP_Customize_Color_Control(
                $wp_customize,
                'clx_accent_color',
                array(
                    'label'       => __( 'Couleur d’accent', 'clx' ),
                    'description' => __( 'Ajuste la teinte principale des pills et badges.', 'clx' ),
                    'section'     => 'clx_section_appearance',
                )
            )
        );
    }
}
add_action( 'customize_register', 'clx_customize_register' );

/**
 * Output custom accent color overrides.
 */
function clx_output_accent_style(): void {
    $accent = get_theme_mod( 'clx_accent_color' );

    $accent = $accent ? sanitize_hex_color( $accent ) : '';

    if ( ! $accent ) {
        return;
    }

    $accent_soft = sprintf( 'color-mix(in srgb, %1$s 18%%, transparent)', $accent );

    echo '<style id="clx-accent-color">:root{--accent:' . esc_html( $accent ) . ';--accent-soft:' . esc_html( $accent_soft ) . ';}</style>' . PHP_EOL; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
add_action( 'wp_head', 'clx_output_accent_style', 20 );
