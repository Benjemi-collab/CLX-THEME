<?php
/**
 * Template part: contact.
 *
 * @package CLX
 */
?>
<section class="clx-section contact-section" id="clx-contact" aria-labelledby="clx-contact-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="clx-contact-title"><?php esc_html_e( 'On tourne quand ?', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Brief express, repérage ou démo live : notre équipe vous répond sous 24 h.', 'clx' ); ?></p>
        </div>
        <div class="contact-grid">
            <div class="contact-card">
                <p><?php esc_html_e( 'CLX — 42 rue du Cinéma, 75010 Paris', 'clx' ); ?></p>
                <ul class="contact-links">
                    <li><a href="tel:+33102030405">+33 (0)1 02 03 04 05</a></li>
                    <li><a href="mailto:studio@clx.agency">studio@clx.agency</a></li>
                    <li><a href="https://www.linkedin.com/company/clx" target="_blank" rel="noopener noreferrer">LinkedIn</a></li>
                </ul>
                <p><?php esc_html_e( 'Studios ouverts du lundi au samedi, 8h — 22h. Créneaux nocturnes sur demande.', 'clx' ); ?></p>
            </div>
            <form class="contact-card contact-form" action="<?php echo esc_url( home_url( '/contact' ) ); ?>" method="post" novalidate>
                <?php wp_nonce_field( 'clx_contact_submit', 'clx_contact_nonce' ); ?>
                <input type="hidden" name="clx_contact_form" value="1">
                <label for="clx-contact-name"><?php esc_html_e( 'Nom &amp; prénom', 'clx' ); ?></label>
                <input id="clx-contact-name" name="clx_contact_name" type="text" autocomplete="name" required>
                <label for="clx-contact-email"><?php esc_html_e( 'Email', 'clx' ); ?></label>
                <input id="clx-contact-email" name="clx_contact_email" type="email" autocomplete="email" required>
                <label for="clx-contact-company"><?php esc_html_e( 'Société', 'clx' ); ?></label>
                <input id="clx-contact-company" name="clx_contact_company" type="text" autocomplete="organization">
                <label for="clx-contact-message"><?php esc_html_e( 'Projet', 'clx' ); ?></label>
                <textarea id="clx-contact-message" name="clx_contact_message" required></textarea>
                <button class="btn-cam btn-primary" type="submit">
                    <span class="btn-dot" aria-hidden="true"></span>
                    <span class="btn-label"><?php esc_html_e( 'Envoyer le brief', 'clx' ); ?></span>
                </button>
            </form>
        </div>
    </div>
</section>
