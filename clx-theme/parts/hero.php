<?php
/**
 * Template part: hero.
 *
 * @package CLX
 */

$hero_video_id   = absint( get_theme_mod( 'clx_hero_video_id' ) );
$hero_poster_id  = absint( get_theme_mod( 'clx_hero_poster_id' ) );
$hero_title      = clx_get_theme_string( 'clx_hero_title', __( 'CLX agence votre contenu cinématique & live', 'clx' ) );
$hero_subtitle   = clx_get_theme_string( 'clx_hero_sub', __( 'Une task force créative pour orchestrer tournages, capsules sociales et expériences immersives.', 'clx' ) );
$hero_video_url  = $hero_video_id ? clx_get_media_url( $hero_video_id ) : '';
$hero_poster     = clx_get_image_data( $hero_poster_id );
$hero_video_type = '';

if ( $hero_video_url ) {
    $filetype       = wp_check_filetype( wp_basename( $hero_video_url ), wp_get_mime_types() );
    $hero_video_type = isset( $filetype['type'] ) ? $filetype['type'] : 'video/mp4';
}
?>
<section class="clx-section hero-section" id="clx-hero" aria-labelledby="clx-hero-title">
    <div class="clx-wrap">
        <div class="hero-fixed">
            <?php if ( $hero_video_url ) : ?>
                <video class="hero-video" playsinline muted loop autoplay preload="auto"<?php if ( $hero_poster['src'] ) : ?> poster="<?php echo esc_url( $hero_poster['src'] ); ?>"<?php endif; ?>>
                    <source src="<?php echo esc_url( $hero_video_url ); ?>" type="<?php echo esc_attr( $hero_video_type ); ?>">
                </video>
            <?php elseif ( $hero_poster['src'] ) : ?>
                <img class="hero-poster" src="<?php echo esc_url( $hero_poster['src'] ); ?>" alt="<?php echo esc_attr( $hero_poster['alt'] ? $hero_poster['alt'] : $hero_title ); ?>"<?php if ( $hero_poster['srcset'] ) : ?> srcset="<?php echo esc_attr( $hero_poster['srcset'] ); ?>"<?php endif; ?><?php if ( $hero_poster['sizes'] ) : ?> sizes="<?php echo esc_attr( $hero_poster['sizes'] ); ?>"<?php endif; ?>>
            <?php else : ?>
                <div class="hero-placeholder" role="img" aria-label="<?php echo esc_attr( $hero_title ); ?>">
                    <span class="placeholder-grid" aria-hidden="true"></span>
                </div>
            <?php endif; ?>
            <div class="hero-caption" aria-live="polite">
                <span class="badge badge-live"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Mode ciné actif', 'clx' ); ?></span>
                <h1 class="hero-title" id="clx-hero-title"><?php echo esc_html( $hero_title ); ?></h1>
                <?php if ( $hero_subtitle ) : ?>
                    <p class="hero-subtitle"><?php echo esc_html( $hero_subtitle ); ?></p>
                <?php endif; ?>
                <div class="hero-actions" role="group" aria-label="<?php esc_attr_e( 'Actions principales', 'clx' ); ?>">
                    <a class="btn-cam btn-primary" href="<?php echo esc_url( home_url( '/#clx-contact' ) ); ?>">
                        <span class="btn-dot" aria-hidden="true"></span>
                        <span class="btn-label"><?php esc_html_e( 'Planifier un tournage', 'clx' ); ?></span>
                    </a>
                    <a class="btn-cam btn-ghost" href="<?php echo esc_url( home_url( '/#clx-showreel' ) ); ?>">
                        <span class="btn-label"><?php esc_html_e( 'Voir le showreel', 'clx' ); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
