<?php

/**
 * The Template for displaying single autor
 *
 * This template can be overridden by copying it to yourtheme/materialpool/single-material.php.
 *
 * @since      0.0.1
 * @package    Materialpool
 * @author     Frank Staude <frank@staude.net>
 * @version    0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

ob_start();

/* Start the Loop */
while ( have_posts() ) : the_post();
	get_template_part('template-parts/autor/content', get_post_format());
endwhile; // End of the loop.

$content = ob_get_clean();
ThemeCore::draw_page_content($content, 'author');
