<?php
/**
 * Block patterns registration.
 *
 * @package CLX\Theme
 */

if ( ! function_exists( 'clx_register_block_patterns' ) ) {
    /**
     * Register CLX block patterns from HTML files.
     */
    function clx_register_block_patterns() {
        if ( ! function_exists( 'register_block_pattern' ) ) {
            return;
        }

        if ( function_exists( 'register_block_pattern_category' ) && class_exists( 'WP_Block_Pattern_Categories_Registry' ) ) {
            $registry = WP_Block_Pattern_Categories_Registry::get_instance();

            if ( ! $registry->is_registered( 'clx' ) ) {
                register_block_pattern_category(
                    'clx',
                    [
                        'label' => __( 'Sections CLX', 'clx' ),
                    ]
                );
            }
        }

        $patterns = [
            'clx/hero'     => [
                'title'       => __( 'Hero vidéo CLX', 'clx' ),
                'description' => __( 'Section hero 16:9 avec vidéo immersive.', 'clx' ),
                'file'        => 'hero.html',
            ],
            'clx/approach' => [
                'title'       => __( 'Approche CLX en 3 phases', 'clx' ),
                'description' => __( 'Cartes pour détailler votre méthode.', 'clx' ),
                'file'        => 'approach.html',
            ],
            'clx/pricing'  => [
                'title'       => __( 'Slider pricing 3D', 'clx' ),
                'description' => __( 'Formules marketing en slider 3D.', 'clx' ),
                'file'        => 'pricing.html',
            ],
            'clx/showreel' => [
                'title'       => __( 'Showreel vidéo', 'clx' ),
                'description' => __( 'Bloc vidéo pour présenter vos productions.', 'clx' ),
                'file'        => 'showreel.html',
            ],
            'clx/logos'    => [
                'title'       => __( 'Logos clients CLX', 'clx' ),
                'description' => __( 'Grille de références clients.', 'clx' ),
                'file'        => 'logos.html',
            ],
            'clx/team'     => [
                'title'       => __( 'Slider équipe CLX', 'clx' ),
                'description' => __( 'Présentation de l\'équipe studio & growth.', 'clx' ),
                'file'        => 'team.html',
            ],
            'clx/contact'  => [
                'title'       => __( 'Formulaire contact CLX', 'clx' ),
                'description' => __( 'Bloc contact glass + formulaire.', 'clx' ),
                'file'        => 'contact.html',
            ],
        ];

        foreach ( $patterns as $slug => $pattern ) {
            $file_path = trailingslashit( CLX_THEME_DIR ) . 'patterns/' . $pattern['file'];

            if ( ! file_exists( $file_path ) ) {
                continue;
            }

            $content = file_get_contents( $file_path );

            if ( false === $content ) {
                continue;
            }

            register_block_pattern(
                $slug,
                [
                    'title'       => $pattern['title'],
                    'description' => $pattern['description'],
                    'categories'  => [ 'clx' ],
                    'content'     => wp_kses_post( $content ),
                ]
            );
        }
    }
}
add_action( 'init', 'clx_register_block_patterns' );
