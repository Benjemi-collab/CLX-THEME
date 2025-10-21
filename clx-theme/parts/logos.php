<?php
/**
 * Template part: logos.
 *
 * @package CLX
 */

$logos_query = get_posts(
    array(
        'post_type'      => 'clx_logo',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    )
);
?>
<section class="clx-section logos-section" id="clx-logos" aria-labelledby="clx-logos-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="clx-logos-title"><?php esc_html_e( 'Ils diffusent en mode CLX', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Marques, institutions et maisons de création qui activent nos studios.', 'clx' ); ?></p>
        </div>
        <div class="logos-wall" role="list">
            <?php if ( $logos_query ) : ?>
                <?php foreach ( $logos_query as $logo_post ) : ?>
                    <?php
                    $thumb_id  = get_post_thumbnail_id( $logo_post->ID );
                    $image     = clx_get_image_data( $thumb_id );
                    $link_url  = get_post_meta( $logo_post->ID, 'logo_url', true );
                    $title     = get_the_title( $logo_post );
                    $attributes = array(
                        'src' => $image['src'],
                        'alt' => $image['alt'] ? $image['alt'] : $title,
                    );

                    if ( $image['srcset'] ) {
                        $attributes['srcset'] = $image['srcset'];
                    }

                    if ( $image['sizes'] ) {
                        $attributes['sizes'] = $image['sizes'];
                    }

                    $attr_markup = '';
                    foreach ( $attributes as $attr_key => $attr_value ) {
                        if ( ! $attr_value ) {
                            continue;
                        }

                        $attr_markup .= sprintf( ' %s="%s"', esc_attr( $attr_key ), esc_attr( $attr_value ) );
                    }

                    $img_markup = '<img' . $attr_markup . ' />';
                    ?>
                    <?php if ( $link_url ) : ?>
                        <a class="logo-card" role="listitem" href="<?php echo esc_url( $link_url ); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo wp_kses_post( $img_markup ); ?>
                        </a>
                    <?php else : ?>
                        <div class="logo-card" role="listitem">
                            <?php echo wp_kses_post( $img_markup ); ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <div class="logo-card" role="listitem">
                    <span class="section-subtitle"><?php esc_html_e( 'Ajoutez vos logos depuis le CPT “Logos”.', 'clx' ); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
