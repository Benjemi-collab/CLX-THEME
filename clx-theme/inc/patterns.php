<?php
/**
 * Block patterns registration.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register custom block patterns for CLX.
 */
function clx_register_block_patterns() {
    if ( ! function_exists( 'register_block_pattern' ) ) {
        return;
    }

    if ( function_exists( 'register_block_pattern_category' ) ) {
        register_block_pattern_category( 'clx', array( 'label' => __( 'CLX', 'clx' ) ) );
    }

    $patterns = array(
        'hero'     => array(
            'title'       => __( 'Hero vidéo CLX', 'clx' ),
            'description' => __( 'Hero 16:9 avec badges et CTA pill.', 'clx' ),
            'file'        => 'hero.html',
        ),
        'approach' => array(
            'title'       => __( 'Approche orchestrée', 'clx' ),
            'description' => __( 'Trois piliers pour détailler votre méthode de production.', 'clx' ),
            'file'        => 'approach.html',
        ),
        'pricing'  => array(
            'title'       => __( 'Slider formules 3D', 'clx' ),
            'description' => __( 'Présentez trois offres dans un slider cinématique.', 'clx' ),
            'file'        => 'pricing.html',
        ),
        'showreel' => array(
            'title'       => __( 'Showreel Customizer', 'clx' ),
            'description' => __( 'Cadre vidéo pour projeter vos contenus signature.', 'clx' ),
            'file'        => 'showreel.html',
        ),
        'logos'    => array(
            'title'       => __( 'Logos clients', 'clx' ),
            'description' => __( 'Grille vitrines pour vos partenaires clés.', 'clx' ),
            'file'        => 'logos.html',
        ),
        'team'     => array(
            'title'       => __( 'Slider équipe CLX', 'clx' ),
            'description' => __( 'Cartes horizontales pour mettre en avant l\'équipe.', 'clx' ),
            'file'        => 'team.html',
        ),
        'contact'  => array(
            'title'       => __( 'Contact premium', 'clx' ),
            'description' => __( 'Bloc contact avec formulaire cristal.', 'clx' ),
            'file'        => 'contact.html',
        ),
    );

    foreach ( $patterns as $slug => $data ) {
        $content = clx_get_pattern_content( $data['file'] );

        if ( '' === $content ) {
            continue;
        }

        register_block_pattern(
            'clx/' . $slug,
            array(
                'title'       => $data['title'],
                'description' => $data['description'],
                'content'     => $content,
                'categories'  => array( 'clx' ),
            )
        );
    }
}
add_action( 'init', 'clx_register_block_patterns' );

/**
 * Retrieve pattern file content.
 *
 * @param string $filename Pattern filename.
 * @return string
 */
function clx_get_pattern_content( $filename ) {
    $path = get_template_directory() . '/patterns/' . $filename;

    if ( ! file_exists( $path ) ) {
        return '';
    }

    $content = file_get_contents( $path );

    return $content ? $content : '';
}
