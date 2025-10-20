<?php
/**
 * Header template.
 *
 * @package CLX\Theme
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
</head>
<body <?php body_class( 'no-js' ); ?>>
<?php wp_body_open(); ?>
<a class="clx-skip-link" href="#primary"><?php esc_html_e( 'Aller au contenu', 'clx' ); ?></a>
<?php
$clx_header_links = [
    [
        'label' => __( 'Services', 'clx' ),
        'url'   => '#formules',
        'class' => 'pill-ghost',
    ],
    [
        'label' => __( 'Parler de mon projet', 'clx' ),
        'url'   => '#contact',
        'class' => 'pill-cta',
    ],
];
?>
<header id="masthead" class="clx-header" role="banner">
    <div class="clx-header-safe">
        <div class="clx-header-inner">
            <div class="clx-header-brand">
                <?php if ( has_custom_logo() ) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <a class="clx-brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                <?php endif; ?>
            </div>
            <nav class="clx-header-nav" role="navigation" aria-label="<?php echo esc_attr__( 'Navigation principale', 'clx' ); ?>">
                <ul class="clx-nav-list">
                    <?php foreach ( $clx_header_links as $clx_link ) : ?>
                        <li class="clx-nav-item">
                            <a class="clx-nav-link <?php echo esc_attr( $clx_link['class'] ); ?>" href="<?php echo esc_url( $clx_link['url'] ); ?>"><?php echo esc_html( $clx_link['label'] ); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="clx-header-actions">
                <button id="themeToggle" class="pill-switch" type="button" data-mode-default="light" aria-pressed="false">
                    <span class="pill-switch-label"><?php esc_html_e( 'Mode ciné', 'clx' ); ?></span>
                    <span class="switch-dot" aria-hidden="true"></span>
                </button>
                <button id="clx-burger" class="clx-burger" type="button" aria-controls="clx-drawer" aria-expanded="false">
                    <span class="clx-burger-box" aria-hidden="true">
                        <span class="clx-burger-line"></span>
                        <span class="clx-burger-line"></span>
                        <span class="clx-burger-line"></span>
                    </span>
                    <span class="screen-reader-text"><?php esc_html_e( 'Ouvrir le menu', 'clx' ); ?></span>
                </button>
            </div>
        </div>
    </div>
</header>
<nav id="clx-drawer" class="clx-drawer" aria-label="<?php echo esc_attr__( 'Navigation mobile', 'clx' ); ?>" aria-hidden="true">
    <div class="clx-drawer-inner">
        <ul class="clx-drawer-menu">
            <?php foreach ( $clx_header_links as $clx_link ) : ?>
                <li class="clx-drawer-item">
                    <a class="clx-drawer-link <?php echo esc_attr( $clx_link['class'] ); ?>" href="<?php echo esc_url( $clx_link['url'] ); ?>"><?php echo esc_html( $clx_link['label'] ); ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <button id="themeToggleM" class="pill-switch pill-switch-mobile" type="button" aria-pressed="false">
            <span class="pill-switch-label"><?php esc_html_e( 'Mode ciné', 'clx' ); ?></span>
            <span class="switch-dot" aria-hidden="true"></span>
        </button>
    </div>
</nav>
