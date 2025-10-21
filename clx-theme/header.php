<?php
/**
 * Header template.
 *
 * @package CLX
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="dark">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'clx-body' ); ?>>
	<?php wp_body_open(); ?>
	<a class="skip-link" href="#primary"><?php esc_html_e( 'Skip to content', 'clx' ); ?></a>
	<div class="clx-site">
		<header class="clx-header" role="banner">
			<div class="clx-wrap header-inner">
                                <div class="clx-brand">
                                        <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
                                                <?php the_custom_logo(); ?>
                                        <?php else : ?>
                                                <a class="clx-site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></a>
                                        <?php endif; ?>
                                </div>
				<nav class="clx-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'clx' ); ?>">
					<?php
					if ( has_nav_menu( 'primary' ) ) {
						wp_nav_menu(
							array(
								'theme_location' => 'primary',
								'menu_class'     => 'clx-menu-list',
								'container'      => false,
								'depth'          => 1,
							)
						);
					} else {
						?>
						<ul class="clx-menu-list">
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'clx' ); ?></a></li>
						</ul>
					<?php } ?>
				</nav>
				<div class="clx-header-actions">
					<a class="clx-cta btn-cam" href="<?php echo esc_url( home_url( '/#clx-contact' ) ); ?>">
						<span class="btn-dot" aria-hidden="true"></span>
						<span class="btn-label"><?php esc_html_e( 'Journal', 'clx' ); ?></span>
					</a>
					<button id="recToggle" class="rec-switch" type="button" aria-pressed="false">
						<span class="rec-switch-track" aria-hidden="true">
							<span class="rec-switch-thumb"></span>
						</span>
						<span class="rec-switch-label">REC</span>
					</button>
				</div>
			</div>
		</header>
