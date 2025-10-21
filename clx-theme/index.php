<?php
/**
 * Main index file for CLX Theme Pro.
 *
 * @package CLX
 */

get_header();
?>
<main id="primary" class="site-main" role="main">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'template-parts/content', get_post_type() ); ?>
<?php endwhile; ?>
<?php else : ?>
<?php get_template_part( 'template-parts/content', 'none' ); ?>
<?php endif; ?>
</main>
<?php
get_footer();
?>
