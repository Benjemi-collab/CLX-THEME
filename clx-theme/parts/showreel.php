<?php
/**
 * Showreel section partial.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$showreel_id  = clx_get_theme_mod_int( 'clx_showreel_video_id' );
$showreel_url = clx_attachment_url( $showreel_id );
$showreel_mime = $showreel_id ? get_post_mime_type( $showreel_id ) : '';
?>
<section class="clx-section showreel-section" id="showreel" aria-labelledby="showreel-title">
    <div class="clx-wrap">
        <div class="section-header">
            <h2 class="section-title" id="showreel-title"><?php esc_html_e( 'Showreel instantané', 'clx' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'Diffusez vos best cases sur écran géant, stand ou social live.', 'clx' ); ?></p>
        </div>
        <div class="showreel-frame">
            <?php if ( $showreel_url ) : ?>
                <video class="showreel-video" controls preload="metadata" playsinline>
                    <source src="<?php echo esc_url( $showreel_url ); ?>"<?php echo $showreel_mime ? ' type="' . esc_attr( $showreel_mime ) . '"' : ''; ?>>
                    <?php esc_html_e( 'Votre navigateur ne peut pas lire cette vidéo.', 'clx' ); ?>
                </video>
            <?php else : ?>
                <div class="showreel-placeholder" role="img" aria-label="<?php esc_attr_e( 'Importez votre showreel via le Customizer.', 'clx' ); ?>">
                    <span class="showreel-placeholder-text"><?php esc_html_e( 'Vidéo showreel – Customizer', 'clx' ); ?></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
