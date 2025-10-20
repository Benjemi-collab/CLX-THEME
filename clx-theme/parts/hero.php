<?php
/**
 * Hero section.
 *
 * @package CLX\Theme
 */

$hero_video_id   = absint( get_theme_mod( 'clx_hero_video_id', 0 ) );
$hero_poster_id  = absint( get_theme_mod( 'clx_hero_poster_id', 0 ) );
$hero_title      = get_theme_mod( 'clx_hero_title', __( 'Studios & marketing immersifs pour marques audacieuses.', 'clx' ) );
$hero_video_url  = clx_media_url( $hero_video_id );
$hero_poster_url = clx_attachment_url( $hero_poster_id, 'full' );
$hero_mime_type  = $hero_video_id ? get_post_mime_type( $hero_video_id ) : '';
?>
<section class="clx-section hero-section" id="hero" aria-labelledby="hero-title">
    <div class="hero-fixed">
        <?php if ( $hero_video_url ) : ?>
            <video class="hero-video" autoplay muted loop playsinline preload="auto"<?php if ( $hero_poster_url ) : ?> poster="<?php echo esc_url( $hero_poster_url ); ?>"<?php endif; ?>>
                <source src="<?php echo esc_url( $hero_video_url ); ?>"<?php if ( $hero_mime_type ) : ?> type="<?php echo esc_attr( $hero_mime_type ); ?>"<?php endif; ?>>
                <?php esc_html_e( 'Votre navigateur ne supporte pas la lecture vidéo.', 'clx' ); ?>
            </video>
        <?php elseif ( $hero_poster_url ) : ?>
            <div class="hero-poster" role="img" aria-label="<?php echo esc_attr( $hero_title ); ?>" style="background-image: url('<?php echo esc_url( $hero_poster_url ); ?>');"></div>
        <?php else : ?>
            <div class="hero-fallback" role="img" aria-label="<?php echo esc_attr( $hero_title ); ?>">
                <span><?php esc_html_e( 'Ajoutez une vidéo hero depuis le Customizer CLX.', 'clx' ); ?></span>
            </div>
        <?php endif; ?>
        <div class="hero-overlay" aria-hidden="true"></div>
        <div class="hero-caption">
            <?php if ( $hero_title ) : ?>
                <h1 class="hero-title" id="hero-title"><?php echo esc_html( $hero_title ); ?></h1>
            <?php endif; ?>
            <p class="hero-subtitle"><?php esc_html_e( 'Production, diffusion & growth au service de vos lancements cinéma, luxe et tech.', 'clx' ); ?></p>
            <div class="hero-badges" role="list">
                <span class="badge" role="listitem"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Vidéo', 'clx' ); ?></span>
                <span class="badge" role="listitem"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Photographie', 'clx' ); ?></span>
                <span class="badge" role="listitem"><span class="dot" aria-hidden="true"></span><?php esc_html_e( 'Diffusion & stratégie', 'clx' ); ?></span>
            </div>
        </div>
    </div>
</section>
