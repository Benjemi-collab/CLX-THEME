<?php
/**
 * Front-page template assembling core sections.
 *
 * @package CLX
 */

get_header();

get_template_part( 'parts/hero' );
get_template_part( 'parts/approach' );
get_template_part( 'parts/pricing-slider' );
get_template_part( 'parts/showreel' );
get_template_part( 'parts/logos' );
get_template_part( 'parts/team' );
get_template_part( 'parts/contact' );

get_footer();
