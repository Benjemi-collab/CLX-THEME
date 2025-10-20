<?php
/**
 * Header template for CLX Theme Pro.
 *
 * @package CLX
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js" data-theme="dark">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#site-content"><?php esc_html_e( 'Aller au contenu', 'clx' ); ?></a>
<noscript><div class="clx-nojs-banner"><?php esc_html_e( 'Activez JavaScript pour profiter de l\'expérience interactive CLX.', 'clx' ); ?></div></noscript>
<header id="site-header" class="clx-header" role="banner">
    <div class="clx-wrap clx-header-inner">
        <div class="clx-brand">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a class="clx-brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <span class="clx-brand-title"><?php bloginfo( 'name' ); ?></span>
                </a>
            <?php endif; ?>
        </div>
        <nav class="clx-menu" aria-label="<?php esc_attr_e( 'Navigation principale', 'clx' ); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'clx-menu-list',
                    'container'      => '',
                    'depth'          => 1,
                    'fallback_cb'    => 'clx_header_fallback_menu',
                    'link_before'    => '<span class=\'clx-pill-label\'>',
                    'link_after'     => '</span>',
                )
            );
            ?>
        </nav>
        <div class="clx-header-actions">
            <button id="recToggle" class="rec-switch is-on" type="button" aria-pressed="true">
                <span class="rec-switch-dot" aria-hidden="true"></span>
                <span class="rec-switch-label"><?php esc_html_e( 'Mode ciné', 'clx' ); ?></span>
            </button>
            <button id="clx-burger" class="clx-burger" type="button" aria-controls="clx-drawer" aria-expanded="false">
                <span class="clx-burger-line" aria-hidden="true"></span>
                <span class="clx-burger-line" aria-hidden="true"></span>
                <span class="clx-burger-line" aria-hidden="true"></span>
                <span class="clx-burger-label screen-reader-text"><?php esc_html_e( 'Ouvrir le menu', 'clx' ); ?></span>
            </button>
        </div>
    </div>
</header>
<div id="clx-drawer" class="clx-drawer" hidden>
    <div class="clx-drawer-inner">
        <nav class="clx-drawer-nav" aria-label="<?php esc_attr_e( 'Navigation mobile', 'clx' ); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'menu_class'     => 'clx-drawer-list',
                    'container'      => '',
                    'depth'          => 1,
                    'fallback_cb'    => 'clx_header_fallback_menu',
                    'link_before'    => '<span class=\'clx-pill-label\'>',
                    'link_after'     => '</span>',
                )
            );
            ?>
        </nav>
    </div>
</div>
<main id="site-content" class="site-content">
