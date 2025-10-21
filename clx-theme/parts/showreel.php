<?php
/**
 * Template part: showreel.
 *
 * @package CLX
 */

$showreel_video_id = absint( get_theme_mod( 'clx_showreel_video_id' ) );
$hero_video_id     = absint( get_theme_mod( 'clx_hero_video_id' ) );
$poster_id         = absint( get_theme_mod( 'clx_hero_poster_id' ) );
$video_id_to_use   = $showreel_video_id ? $showreel_video_id : $hero_video_id;
$video_url         = $video_id_to_use ? clx_get_media_url( $video_id_to_use ) : '';
$poster_data       = clx_get_image_data( $poster_id );
$video_type        = '';

if ( $video_url ) {
$filetype  = wp_check_filetype( wp_basename( $video_url ), wp_get_mime_types() );
$video_type = isset( $filetype['type'] ) ? $filetype['type'] : 'video/mp4';
}
?>
<section class="clx-section showreel-section" id="clx-showreel" aria-labelledby="clx-showreel-title">
<div class="clx-wrap">
<div class="showreel-grid">
<div class="showreel-player">
<?php if ( $video_url ) : ?>
<video controls preload="metadata" playsinline<?php if ( $poster_data['src'] ) : ?> poster="<?php echo esc_url( $poster_data['src'] ); ?>"<?php endif; ?>>
<source src="<?php echo esc_url( $video_url ); ?>" type="<?php echo esc_attr( $video_type ); ?>">
</video>
<?php elseif ( $poster_data['src'] ) : ?>
<img src="<?php echo esc_url( $poster_data['src'] ); ?>" alt="<?php echo esc_attr( $poster_data['alt'] ? $poster_data['alt'] : __( 'Showreel CLX', 'clx' ) ); ?>"<?php if ( $poster_data['srcset'] ) : ?> srcset="<?php echo esc_attr( $poster_data['srcset'] ); ?>"<?php endif; ?><?php if ( $poster_data['sizes'] ) : ?> sizes="<?php echo esc_attr( $poster_data['sizes'] ); ?>"<?php endif; ?>>
<?php else : ?>
<div class="hero-placeholder" role="img" aria-label="<?php esc_attr_e( 'Showreel CLX', 'clx' ); ?>">
<span class="placeholder-grid" aria-hidden="true"></span>
</div>
<?php endif; ?>
</div>
<div class="showreel-copy">
<h2 class="section-title" id="clx-showreel-title"><?php esc_html_e( 'Showreel 2024', 'clx' ); ?></h2>
<p><?php esc_html_e( 'Plateaux XR, captations hybrides, hologrammes événementiels et storytelling social : découvrez notre palette cinématique.', 'clx' ); ?></p>
<p><?php esc_html_e( 'Chaque séquence est mixée en Dolby Atmos et livrée en versions adaptées aux écrans mobiles, LED walls et flux live.', 'clx' ); ?></p>
<a class="btn-cam btn-ghost" href="<?php echo esc_url( home_url( '/#clx-contact' ) ); ?>">
<span class="btn-label"><?php esc_html_e( 'Booker une session de vision', 'clx' ); ?></span>
</a>
</div>
</div>
</div>
</section>
