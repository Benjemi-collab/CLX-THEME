<?php
/**
 * Showreel section.
 *
 * @package CLX\Theme
 */

$showreel_id  = absint( get_theme_mod( 'clx_showreel_video_id', 0 ) );
$showreel_url = clx_media_url( $showreel_id );
$showreel_mime = $showreel_id ? get_post_mime_type( $showreel_id ) : '';
?>
<section class="clx-section showreel-section" id="showreel" aria-labelledby="showreel-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="showreel-title"><?php esc_html_e( 'Showreel cinématique', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Une sélection de captations hybrides, expériences live et films produits par nos studios.', 'clx' ); ?></p>
        </div>
        <div class="showreel-media card-glass">
            <?php if ( $showreel_url ) : ?>
                <video class="showreel-video" controls preload="metadata">
                    <source src="<?php echo esc_url( $showreel_url ); ?>"<?php if ( $showreel_mime ) : ?> type="<?php echo esc_attr( $showreel_mime ); ?>"<?php endif; ?>>
                    <?php esc_html_e( 'Votre navigateur ne supporte pas la lecture vidéo.', 'clx' ); ?>
                </video>
            <?php else : ?>
                <div class="showreel-placeholder">
                    <p><?php esc_html_e( 'Ajoutez votre vidéo showreel depuis le Customizer pour la diffuser ici.', 'clx' ); ?></p>
                </div>
            <?php endif; ?>
        </div>
        <div class="showreel-meta">
            <div class="meta-block">
                <span class="meta-label"><?php esc_html_e( 'Studios', 'clx' ); ?></span>
                <span class="meta-value"><?php esc_html_e( 'Paris & Montréal', 'clx' ); ?></span>
            </div>
            <div class="meta-block">
                <span class="meta-label"><?php esc_html_e( 'Formats', 'clx' ); ?></span>
                <span class="meta-value"><?php esc_html_e( 'Ultra HD, XR, Live 4K', 'clx' ); ?></span>
            </div>
            <div class="meta-block">
                <span class="meta-label"><?php esc_html_e( 'Disponibilités', 'clx' ); ?></span>
                <span class="meta-value"><?php esc_html_e( 'Sous 2 semaines', 'clx' ); ?></span>
            </div>
        </div>
    </div>
</section>
