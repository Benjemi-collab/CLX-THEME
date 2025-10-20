<?php
/**
 * Contact section.
 *
 * @package CLX\Theme
 */
?>
<section class="clx-section contact-section" id="contact" aria-labelledby="contact-title">
    <div class="clx-wrap contact-grid">
        <div class="contact-intro card-glass">
            <span class="badge badge-soft"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Prendre rendez-vous', 'clx' ); ?></span>
            <h2 class="section-title" id="contact-title"><?php esc_html_e( 'Parlons de votre lancement', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Décrivez votre projet, nous revenons vers vous sous 24h avec une proposition d\'activation.', 'clx' ); ?></p>
            <ul class="contact-list">
                <li><?php esc_html_e( 'Calendrier de production optimisé', 'clx' ); ?></li>
                <li><?php esc_html_e( 'Roadmap média & contenus prête à partager', 'clx' ); ?></li>
                <li><?php esc_html_e( 'Estimate budgétaire détaillé', 'clx' ); ?></li>
            </ul>
            <div class="contact-meta">
                <a class="pill-cta" href="<?php echo esc_url( 'mailto:bonjour@clx.agency' ); ?>"><?php esc_html_e( 'bonjour@clx.agency', 'clx' ); ?></a>
                <a class="pill-outline" href="<?php echo esc_url( 'tel:+33184260000' ); ?>"><?php esc_html_e( '+33 1 84 26 00 00', 'clx' ); ?></a>
            </div>
        </div>
        <form class="contact-form card-glass" action="<?php echo esc_url( home_url( '/#contact' ) ); ?>" method="post">
            <div class="form-group">
                <label for="contact-name"><?php esc_html_e( 'Nom & prénom', 'clx' ); ?></label>
                <input type="text" id="contact-name" name="contact-name" required />
            </div>
            <div class="form-group">
                <label for="contact-email"><?php esc_html_e( 'Email professionnel', 'clx' ); ?></label>
                <input type="email" id="contact-email" name="contact-email" required />
            </div>
            <div class="form-group">
                <label for="contact-company"><?php esc_html_e( 'Entreprise', 'clx' ); ?></label>
                <input type="text" id="contact-company" name="contact-company" />
            </div>
            <div class="form-group">
                <label for="contact-message"><?php esc_html_e( 'Votre besoin', 'clx' ); ?></label>
                <textarea id="contact-message" name="contact-message" rows="4" required></textarea>
            </div>
            <div class="form-group form-group-inline">
                <label for="contact-budget"><?php esc_html_e( 'Budget indicatif', 'clx' ); ?></label>
                <select id="contact-budget" name="contact-budget">
                    <option value="">"><?php esc_html_e( 'Sélectionner', 'clx' ); ?></option>
                    <option value="8500-15000"><?php esc_html_e( '8 500€ - 15 000€', 'clx' ); ?></option>
                    <option value="15000-30000"><?php esc_html_e( '15 000€ - 30 000€', 'clx' ); ?></option>
                    <option value="30000+">"><?php esc_html_e( '30 000€ et plus', 'clx' ); ?></option>
                </select>
            </div>
            <div class="form-group consent">
                <label class="checkbox">
                    <input type="checkbox" name="contact-consent" required />
                    <span><?php esc_html_e( 'J\'accepte d\'être contacté·e par l\'équipe CLX.', 'clx' ); ?></span>
                </label>
            </div>
            <button class="pill-cta" type="submit"><?php esc_html_e( 'Envoyer ma demande', 'clx' ); ?></button>
        </form>
    </div>
</section>
