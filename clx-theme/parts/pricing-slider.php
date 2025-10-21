<?php
/**
 * Template part: pricing slider.
 *
 * @package CLX
 */
?>
<section class="clx-section pricing-section" id="clx-pricing" aria-labelledby="clx-pricing-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="clx-pricing-title"><?php esc_html_e( 'Studios &amp; packs ciné', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Choisissez la capsule idéale, nous ajustons l’équipe live et la post-prod pour chaque activation.', 'clx' ); ?></p>
        </div>
        <div class="pricing-shell">
            <button class="slider-nav pricing-prev" type="button" aria-label="<?php esc_attr_e( 'Offre précédente', 'clx' ); ?>" data-target="clx-pricing-track">
                <span aria-hidden="true">&#10094;</span>
            </button>
            <ul class="pricing-track" id="clx-pricing-track" role="listbox" aria-labelledby="clx-pricing-title">
                <li class="pricing-card is-left" data-index="0" role="option" aria-selected="false">
                    <span class="pricing-badge"><?php esc_html_e( 'Pulse', 'clx' ); ?></span>
                    <h3 class="pricing-title"><?php esc_html_e( 'Live Social', 'clx' ); ?></h3>
                    <p class="pricing-price">1 900 €</p>
                    <p class="pricing-meta"><?php esc_html_e( '1/2 journée – 2 opérateurs', 'clx' ); ?></p>
                    <ul class="pricing-list">
                        <li><?php esc_html_e( 'Multi-cam vertical &amp; format carré', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Habillage live + modération chat', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Export express stories &amp; reels', 'clx' ); ?></li>
                    </ul>
                </li>
                <li class="pricing-card is-center" data-index="1" role="option" aria-selected="true">
                    <span class="pricing-badge"><?php esc_html_e( 'Climax', 'clx' ); ?></span>
                    <h3 class="pricing-title"><?php esc_html_e( 'Plateau premium', 'clx' ); ?></h3>
                    <p class="pricing-price">4 600 €</p>
                    <p class="pricing-meta"><?php esc_html_e( '1 journée – 5 talents', 'clx' ); ?></p>
                    <ul class="pricing-list">
                        <li><?php esc_html_e( 'Régie mobile HDR &amp; light design', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Chef opérateur, steadicam &amp; drone', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Motion kit &amp; bande sonore originale', 'clx' ); ?></li>
                    </ul>
                    <a class="btn-cam btn-primary" href="<?php echo esc_url( home_url( '/#clx-contact' ) ); ?>">
                        <span class="btn-dot" aria-hidden="true"></span>
                        <span class="btn-label"><?php esc_html_e( 'Réserver le studio', 'clx' ); ?></span>
                    </a>
                </li>
                <li class="pricing-card is-right" data-index="2" role="option" aria-selected="false">
                    <span class="pricing-badge"><?php esc_html_e( 'Chrono', 'clx' ); ?></span>
                    <h3 class="pricing-title"><?php esc_html_e( 'Sprint contenu', 'clx' ); ?></h3>
                    <p class="pricing-price">2 800 €</p>
                    <p class="pricing-meta"><?php esc_html_e( '1 journée – 3 tournages', 'clx' ); ?></p>
                    <ul class="pricing-list">
                        <li><?php esc_html_e( 'Équipe mobile 4K + audio sans fil', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Set multi-décors &amp; fond LED', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Montages cut en 48h', 'clx' ); ?></li>
                    </ul>
                </li>
                <li class="pricing-card is-far" data-index="3" role="option" aria-selected="false">
                    <span class="pricing-badge"><?php esc_html_e( 'Aurora', 'clx' ); ?></span>
                    <h3 class="pricing-title"><?php esc_html_e( 'Expérience immersive', 'clx' ); ?></h3>
                    <p class="pricing-price">8 900 €</p>
                    <p class="pricing-meta"><?php esc_html_e( '2 jours – live + aftermovie', 'clx' ); ?></p>
                    <ul class="pricing-list">
                        <li><?php esc_html_e( 'Réalité mixte &amp; captation volumétrique', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Diffusion simultanée showroom &amp; metaverse', 'clx' ); ?></li>
                        <li><?php esc_html_e( 'Reporting interactif + data room', 'clx' ); ?></li>
                    </ul>
                </li>
            </ul>
            <button class="slider-nav pricing-next" type="button" aria-label="<?php esc_attr_e( 'Offre suivante', 'clx' ); ?>" data-target="clx-pricing-track">
                <span aria-hidden="true">&#10095;</span>
            </button>
        </div>
    </div>
</section>
