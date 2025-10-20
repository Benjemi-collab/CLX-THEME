<?php
/**
 * Contact section partial.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<section class="clx-section contact-section" id="contact" aria-labelledby="contact-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="contact-title"><?php esc_html_e( 'Parler de mon projet', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Brief express, repérages, devis sur-mesure : on vous rappelle sous 24h.', 'clx' ); ?></p>
        </div>
        <div class="contact-grid">
            <div class="contact-intro card-glass">
                <p class="contact-lead"><?php esc_html_e( 'CLX conçoit vos contenus immersifs, du tournage à la diffusion.', 'clx' ); ?></p>
                <ul class="contact-list">
                    <li><strong><?php esc_html_e( 'Studio', 'clx' ); ?></strong> <?php esc_html_e( 'Paris & Marseille', 'clx' ); ?></li>
                    <li><strong><?php esc_html_e( 'Hotline', 'clx' ); ?></strong> <a href="tel:+33184809010">+33 1 84 80 90 10</a></li>
                    <li><strong><?php esc_html_e( 'Mail', 'clx' ); ?></strong> <a href="mailto:hello@clx.agency">hello@clx.agency</a></li>
                </ul>
            </div>
            <form class="contact-form card-glass" action="#contact" method="post">
                <div class="form-row">
                    <label for="clx-contact-name"><?php esc_html_e( 'Nom & prénom', 'clx' ); ?></label>
                    <input type="text" id="clx-contact-name" name="clx-contact-name" required placeholder="<?php esc_attr_e( 'Alexis Nova', 'clx' ); ?>">
                </div>
                <div class="form-row">
                    <label for="clx-contact-email"><?php esc_html_e( 'Email', 'clx' ); ?></label>
                    <input type="email" id="clx-contact-email" name="clx-contact-email" required placeholder="<?php esc_attr_e( 'vous@marque.com', 'clx' ); ?>">
                </div>
                <div class="form-row">
                    <label for="clx-contact-message"><?php esc_html_e( 'Projet', 'clx' ); ?></label>
                    <textarea id="clx-contact-message" name="clx-contact-message" rows="4" required placeholder="<?php esc_attr_e( 'Lancement capsule, coverage event, diffusion showroom...', 'clx' ); ?>"></textarea>
                </div>
                <button class="pill-cta" type="submit"><?php esc_html_e( 'Envoyer', 'clx' ); ?></button>
            </form>
        </div>
    </div>
</section>
