<?php
/**
 * Pricing slider section.
 *
 * @package CLX\Theme
 */
?>
<section class="clx-section pricing-section" id="formules" aria-labelledby="pricing-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="pricing-title"><?php esc_html_e( 'Formules pour accélérer vos campagnes', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Trois modules marketing cumulables pour délivrer votre narration de lancement sans friction.', 'clx' ); ?></p>
        </div>
        <div class="clx-3d-slider" data-slider="pricing" aria-labelledby="pricing-title">
            <button class="slider-nav slider-nav-prev pill-ghost" type="button" aria-label="<?php echo esc_attr__( 'Voir l\'offre précédente', 'clx' ); ?>">
                <span aria-hidden="true">&#8592;</span>
            </button>
            <div class="clx-3d-track" role="listbox" aria-live="polite">
                <article class="clx-3d-slide is-left" role="option" aria-label="<?php echo esc_attr__( 'Launch Capsule', 'clx' ); ?>">
                    <div class="pricing-card card-glass">
                        <header class="pricing-card-header">
                            <span class="badge badge-soft"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Launch Capsule', 'clx' ); ?></span>
                            <p class="pricing-tag"><?php esc_html_e( 'à partir de 8 500€', 'clx' ); ?></p>
                        </header>
                        <p class="pricing-intro"><?php esc_html_e( 'Un sprint créatif pour capter l\'attention de votre audience sur 10 jours.', 'clx' ); ?></p>
                        <ul class="pricing-list">
                            <li><?php esc_html_e( 'Repérages & tournage mono-lieu 4K', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Montage vertical + horizontal', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Kit diffusion social + paid', 'clx' ); ?></li>
                        </ul>
                        <a class="pill-cta" href="<?php echo esc_url( '#contact' ); ?>"><?php esc_html_e( 'Réserver un créneau', 'clx' ); ?></a>
                    </div>
                </article>
                <article class="clx-3d-slide is-center" role="option" aria-label="<?php echo esc_attr__( 'Experience Live', 'clx' ); ?>">
                    <div class="pricing-card card-glass is-featured">
                        <header class="pricing-card-header">
                            <span class="badge badge-soft"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Experience Live', 'clx' ); ?></span>
                            <p class="pricing-tag"><?php esc_html_e( 'à partir de 16 900€', 'clx' ); ?></p>
                        </header>
                        <p class="pricing-intro"><?php esc_html_e( 'Production multi-cam, set design et diffusion live pour dévoiler votre produit en direct.', 'clx' ); ?></p>
                        <ul class="pricing-list">
                            <li><?php esc_html_e( 'Régie broadcast & réalisation live', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Captation audio binaurale & mixage', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Plateforme de streaming brandée', 'clx' ); ?></li>
                        </ul>
                        <a class="pill-cta" href="<?php echo esc_url( '#contact' ); ?>"><?php esc_html_e( 'Planifier une démo', 'clx' ); ?></a>
                    </div>
                </article>
                <article class="clx-3d-slide is-right" role="option" aria-label="<?php echo esc_attr__( 'Cinéverse Access', 'clx' ); ?>">
                    <div class="pricing-card card-glass">
                        <header class="pricing-card-header">
                            <span class="badge badge-soft"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Cinéverse Access', 'clx' ); ?></span>
                            <p class="pricing-tag"><?php esc_html_e( 'à partir de 24 500€', 'clx' ); ?></p>
                        </header>
                        <p class="pricing-intro"><?php esc_html_e( 'Expérience immersive phygitale avec showroom XR, diffusion metaverse et analytics live.', 'clx' ); ?></p>
                        <ul class="pricing-list">
                            <li><?php esc_html_e( 'Scénographie XR & hologrammes', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Captations 360° & réalité mixte', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Command center performance 24/7', 'clx' ); ?></li>
                        </ul>
                        <a class="pill-cta" href="<?php echo esc_url( '#contact' ); ?>"><?php esc_html_e( 'Lancer mon cinéverse', 'clx' ); ?></a>
                    </div>
                </article>
                <article class="clx-3d-slide is-far" role="option" aria-label="<?php echo esc_attr__( 'Upgrade on-demand', 'clx' ); ?>">
                    <div class="pricing-card card-glass">
                        <header class="pricing-card-header">
                            <span class="badge badge-soft"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Upgrade on-demand', 'clx' ); ?></span>
                            <p class="pricing-tag"><?php esc_html_e( 'options à la carte', 'clx' ); ?></p>
                        </header>
                        <p class="pricing-intro"><?php esc_html_e( 'Renforts créatifs & technos additionnels pour amplifier vos activations existantes.', 'clx' ); ?></p>
                        <ul class="pricing-list">
                            <li><?php esc_html_e( 'Social war room & community care', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Influence & relations presse ciné', 'clx' ); ?></li>
                            <li><?php esc_html_e( 'Dashboards data studio personnalisés', 'clx' ); ?></li>
                        </ul>
                        <a class="pill-outline" href="<?php echo esc_url( '#contact' ); ?>"><?php esc_html_e( 'Composer mon module', 'clx' ); ?></a>
                    </div>
                </article>
            </div>
            <button class="slider-nav slider-nav-next pill-ghost" type="button" aria-label="<?php echo esc_attr__( 'Voir l\'offre suivante', 'clx' ); ?>">
                <span aria-hidden="true">&#8594;</span>
            </button>
        </div>
    </div>
</section>
