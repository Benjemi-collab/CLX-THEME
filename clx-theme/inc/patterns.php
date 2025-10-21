<?php
/**
 * Block pattern registration.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Retrieve pattern file contents.
 *
 * @param string $slug Pattern slug.
 * @return string
 */
function clx_get_pattern_content( string $slug ): string {
    $path = trailingslashit( get_template_directory() ) . 'patterns/' . $slug . '.html';

    if ( ! file_exists( $path ) ) {
        return '';
    }

    $content = file_get_contents( $path ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents

    return is_string( $content ) ? $content : '';
}

/**
 * Register theme block patterns.
 */
function clx_register_block_patterns(): void {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    register_block_pattern_category( 'clx', array(
        'label' => __( 'CLX', 'clx' ),
    ) );

    $patterns = array(
        'hero'     => array(
            'title'       => __( 'Hero vidéo 16:9', 'clx' ),
            'description' => __( 'Hero vidéo avec gradient ciné et CTA pills.', 'clx' ),
        ),
        'approach' => array(
            'title'       => __( 'Approche orchestrée', 'clx' ),
            'description' => __( 'Trois phases glass détaillant la méthode CLX.', 'clx' ),
        ),
        'pricing'  => array(
            'title'       => __( 'Slider tarifs 3D', 'clx' ),
            'description' => __( 'Cartes packs studios avec CTA.', 'clx' ),
        ),
        'showreel' => array(
            'title'       => __( 'Showreel ciné', 'clx' ),
            'description' => __( 'Présentation du showreel et CTA visionnage.', 'clx' ),
        ),
        'logos'    => array(
            'title'       => __( 'Mur de logos', 'clx' ),
            'description' => __( 'Grille de partenaires en mode glass.', 'clx' ),
        ),
        'team'     => array(
            'title'       => __( 'Crew créatif', 'clx' ),
            'description' => __( 'Carousel horizontal des talents.', 'clx' ),
        ),
        'contact'  => array(
            'title'       => __( 'Contact studio', 'clx' ),
            'description' => __( 'Coordonnées et formulaire pill glass.', 'clx' ),
        ),
    );

    foreach ( $patterns as $slug => $data ) {
        $content = clx_get_pattern_content( $slug );

        if ( ! $content ) {
            continue;
        }

        register_block_pattern(
            'clx/' . $slug,
            array(
                'title'       => $data['title'],
                'description' => $data['description'],
                'categories'  => array( 'clx' ),
                'content'     => $content,
            )
        );
    }
}
add_action( 'init', 'clx_register_block_patterns' );
