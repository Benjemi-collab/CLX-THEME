<?php
/**
 * Front page template.
 *
 * @package CLX\Theme
 */

get_header();
?>
<main id="primary" class="site-main">
	<?php
	get_template_part( 'parts/hero' );
	get_template_part( 'parts/approach' );
	get_template_part( 'parts/pricing-slider' );
	get_template_part( 'parts/showreel' );
	get_template_part( 'parts/logos' );
	get_template_part( 'parts/team' );
	get_template_part( 'parts/contact' );
	?>
</main>
<?php get_footer(); ?>
