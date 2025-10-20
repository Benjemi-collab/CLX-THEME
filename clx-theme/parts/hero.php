<?php
/**
 * Hero section partial.
 *
 * @package CLX
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$video_id   = clx_get_theme_mod_int( 'clx_hero_video_id' );
$poster_id  = clx_get_theme_mod_int( 'clx_hero_poster_id' );
$title      = clx_get_theme_mod_text( 'clx_hero_title' );
$subtitle   = clx_get_theme_mod_text( 'clx_hero_sub' );
$video_url  = clx_attachment_url( $video_id );
$poster_url = clx_attachment_url( $poster_id );
$video_mime = $video_id ? get_post_mime_type( $video_id ) : '';
$poster_attr = $poster_url ? ' poster="' . esc_url( $poster_url ) . '"' : '';

if ( '' === $title ) {
    $title = __( 'CLX orchestre vos contenus signature.', 'clx' );
}

if ( '' === $subtitle ) {
    $subtitle = __( 'Studio photo & vidéo premium pour marques ambitieuses.', 'clx' );
}
?>
<section class="clx-section hero-section" id="hero" aria-labelledby="hero-title">
    <div class="clx-wrap">
        <div class="hero-fixed">
            <?php if ( $video_url ) : ?>
                <video class="hero-video" autoplay muted loop playsinline preload="auto"<?php echo $poster_attr; ?>>
                    <source src="<?php echo esc_url( $video_url ); ?>"<?php echo $video_mime ? ' type="' . esc_attr( $video_mime ) . '"' : ''; ?>>
                    <?php esc_html_e( 'Votre navigateur ne supporte pas la vidéo HTML5.', 'clx' ); ?>
                </video>
            <?php else : ?>
                <div class="hero-placeholder" role="img" aria-label="<?php esc_attr_e( 'Ajouter une vidéo hero depuis le Customizer.', 'clx' ); ?>">
                    <span class="hero-placeholder-text"><?php esc_html_e( 'Vidéo hero en attente', 'clx' ); ?></span>
                </div>
            <?php endif; ?>
            <div class="hero-caption">
                <div class="hero-badges" role="list">
                    <span class="badge badge-rec" role="listitem"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Vidéo', 'clx' ); ?></span>
                    <span class="badge badge-soft" role="listitem"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Photographie', 'clx' ); ?></span>
                    <span class="badge badge-ghost" role="listitem"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Diffusion & stratégie', 'clx' ); ?></span>
                </div>
                <h1 class="hero-title" id="hero-title"><?php echo wp_kses_post( $title ); ?></h1>
                <p class="hero-subtitle"><?php echo wp_kses_post( $subtitle ); ?></p>
                <div class="hero-cta">
                    <a class="pill-cta" href="#formules"><?php esc_html_e( 'Découvrir les formules', 'clx' ); ?></a>
                    <a class="pill-outline" href="#contact"><?php esc_html_e( 'Parler de mon projet', 'clx' ); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>
