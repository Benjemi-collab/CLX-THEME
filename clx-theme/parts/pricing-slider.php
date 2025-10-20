<?php
/**
 * Pricing slider section partial.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$packages = array(
    array(
        'name'      => __( 'Sprint créatif', 'clx' ),
        'price'     => __( '3 900 €', 'clx' ),
        'tagline'   => __( 'Production agile social & stories', 'clx' ),
        'features'  => array(
            __( '1 journée studio glass', 'clx' ),
            __( 'Équipe agile 3 talents', 'clx' ),
            __( 'Livrables reels & stills', 'clx' ),
        ),
        'cta_label' => '',
        'cta_url'   => '',
    ),
    array(
        'name'      => __( 'Ciné premium', 'clx' ),
        'price'     => __( '7 500 €', 'clx' ),
        'tagline'   => __( 'Tournage ciné multi-cam & mixage', 'clx' ),
        'features'  => array(
            __( '2 jours tournage multi-cam', 'clx' ),
            __( 'Chef op + réalisateur', 'clx' ),
            __( 'Mastering color & mixage', 'clx' ),
        ),
        'cta_label' => __( 'Planifier une session', 'clx' ),
        'cta_url'   => '#contact',
    ),
    array(
        'name'      => __( 'Signature broadcast', 'clx' ),
        'price'     => __( '12 900 €', 'clx' ),
        'tagline'   => __( 'Campagne 360° + diffusion média', 'clx' ),
        'features'  => array(
            __( 'Storytelling 360°', 'clx' ),
            __( 'Versioning TV, social & DOOH', 'clx' ),
            __( 'Activation média & reporting', 'clx' ),
        ),
        'cta_label' => '',
        'cta_url'   => '',
    ),
);
?>
<section class="clx-section pricing-section" id="formules" aria-labelledby="pricing-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="pricing-title"><?php esc_html_e( 'Formules immersives', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Choisissez votre tempo : production agile, tournage ciné ou campagne signature.', 'clx' ); ?></p>
        </div>
        <div class="clx-3d-slider" data-slider="pricing" tabindex="0">
            <div class="clx-3d-track" role="list" aria-live="polite">
                <?php foreach ( $packages as $index => $package ) :
                    $class_names = 'clx-3d-slide';
                    if ( 1 === $index ) {
                        $class_names .= ' is-center';
                    } elseif ( 0 === $index ) {
                        $class_names .= ' is-left';
                    } else {
                        $class_names .= ' is-right';
                    }
                    if ( ! empty( $package['cta_label'] ) ) {
                        $class_names .= ' is-featured';
                    }
                    ?>
                    <article class="<?php echo esc_attr( $class_names ); ?>" role="listitem" data-index="<?php echo esc_attr( $index ); ?>">
                        <header class="clx-3d-header">
                            <p class="clx-3d-tagline"><?php echo esc_html( $package['tagline'] ); ?></p>
                            <h3 class="clx-3d-title"><?php echo esc_html( $package['name'] ); ?></h3>
                            <p class="clx-3d-price"><?php echo esc_html( $package['price'] ); ?></p>
                        </header>
                        <?php if ( ! empty( $package['features'] ) ) : ?>
                            <ul class="clx-3d-list">
                                <?php foreach ( $package['features'] as $feature ) : ?>
                                    <li><?php echo esc_html( $feature ); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                        <?php if ( ! empty( $package['cta_label'] ) && ! empty( $package['cta_url'] ) ) : ?>
                            <a class="pill-cta" href="<?php echo esc_url( $package['cta_url'] ); ?>"><?php echo esc_html( $package['cta_label'] ); ?></a>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
            <div class="clx-3d-nav">
                <button class="pill-ghost" type="button" data-slider-prev="pricing" aria-label="<?php esc_attr_e( 'Formule précédente', 'clx' ); ?>"><?php esc_html_e( 'Précédent', 'clx' ); ?></button>
                <button class="pill-ghost" type="button" data-slider-next="pricing" aria-label="<?php esc_attr_e( 'Formule suivante', 'clx' ); ?>"><?php esc_html_e( 'Suivant', 'clx' ); ?></button>
            </div>
        </div>
    </div>
</section>
