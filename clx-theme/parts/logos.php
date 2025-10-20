<?php
/**
 * Logos section partial.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$logos = new WP_Query(
    array(
        'post_type'      => 'clx_logo',
        'posts_per_page' => -1,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    )
);
?>
<section class="clx-section logos-section" id="logos" aria-labelledby="logos-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="logos-title"><?php esc_html_e( 'Ils propulsent leurs lancements avec CLX', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Mode luxe, retail, tech : sélection de marques accompagnées.', 'clx' ); ?></p>
        </div>
        <ul class="logos-grid" role="list">
            <?php if ( $logos->have_posts() ) : ?>
                <?php
                while ( $logos->have_posts() ) :
                    $logos->the_post();
                    $logo_link = get_post_meta( get_the_ID(), 'logo_url', true );
                    $thumb_id  = get_post_thumbnail_id( get_the_ID() );
                    $logo_html = '';

                    if ( $thumb_id ) {
                        $logo_html = clx_attachment_image(
                            $thumb_id,
                            'medium',
                            array(
                                'class'     => 'logos-image',
                                'alt'       => get_the_title(),
                                'loading'   => 'lazy',
                                'decoding'  => 'async',
                            )
                        );
                    } else {
                        $logo_html = '<span class="logos-text">' . esc_html( get_the_title() ) . '</span>';
                    }
                    ?>
                    <li class="logos-item" role="listitem">
                        <?php if ( $logo_link ) : ?>
                            <a href="<?php echo esc_url( $logo_link ); ?>" target="_blank" rel="noopener" class="logos-link"><?php echo $logo_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
                        <?php else : ?>
                            <?php echo $logo_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <li class="logos-item" role="listitem">
                    <span class="logos-text"><?php esc_html_e( 'Ajoutez vos logos clients pour les afficher ici.', 'clx' ); ?></span>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</section>
