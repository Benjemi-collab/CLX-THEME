<?php
/**
 * Logos section.
 *
 * @package CLX\Theme
 */

?>
<section class="clx-section logos-section" id="logos" aria-labelledby="logos-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="logos-title"><?php esc_html_e( 'Ils propulsent leurs sorties avec CLX', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Industrie ciné, maisons premium et scale-ups choisissent nos formats glass & pills.', 'clx' ); ?></p>
        </div>
        <div class="logos-grid" role="list" aria-live="polite">
            <?php
            $logos_query = new WP_Query(
                [
                    'post_type'      => 'clx_logo',
                    'posts_per_page' => 12,
                    'post_status'    => 'publish',
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ]
            );

            if ( $logos_query->have_posts() ) :
                while ( $logos_query->have_posts() ) :
                    $logos_query->the_post();
                    $logo_title   = get_the_title();
                    $logo_url     = get_post_meta( get_the_ID(), 'clx_logo_url', true );
                    $logo_href    = $logo_url ? esc_url( $logo_url ) : '';
                    $thumbnail_id = get_post_thumbnail_id();
                    $logo_alt     = $thumbnail_id ? clx_attachment_alt( $thumbnail_id ) : '';
                    $logo_alt     = $logo_alt ? $logo_alt : $logo_title;
                    $logo_image   = '';

                    if ( $thumbnail_id ) {
                        $logo_image = wp_get_attachment_image(
                            $thumbnail_id,
                            'medium',
                            false,
                            [
                                'class'   => 'logo-image',
                                'loading' => 'lazy',
                                'alt'     => $logo_alt,
                            ]
                        );
                    }
                    ?>
                    <article class="logo-card card-glass" role="listitem">
                        <?php if ( $logo_href ) : ?>
                            <a class="logo-body" href="<?php echo esc_url( $logo_href ); ?>" target="_blank" rel="noopener">
                        <?php else : ?>
                            <div class="logo-body">
                        <?php endif; ?>
                                <?php if ( $logo_image ) : ?>
                                    <span class="logo-visual"><?php echo wp_kses_post( $logo_image ); ?></span>
                                <?php endif; ?>
                                <span class="logo-name"><?php echo esc_html( $logo_title ); ?></span>
                        <?php if ( $logo_href ) : ?>
                            </a>
                        <?php else : ?>
                            </div>
                        <?php endif; ?>
                    </article>
                    <?php
                endwhile;
            else :
                $placeholder_brands = [
                    __( 'Nebula Studios', 'clx' ),
                    __( 'Maison Valéon', 'clx' ),
                    __( 'Circuit 27', 'clx' ),
                    __( 'Noctis Records', 'clx' ),
                    __( 'Aérospace One', 'clx' ),
                    __( 'Studio Mirage', 'clx' ),
                ];
                foreach ( $placeholder_brands as $brand_name ) :
                    ?>
                    <article class="logo-card card-glass" role="listitem">
                        <div class="logo-body">
                            <span class="logo-name"><?php echo esc_html( $brand_name ); ?></span>
                        </div>
                    </article>
                    <?php
                endforeach;
            endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
