<?php
/**
 * The Template for displaying single organisation
 *
 * This template can be overridden by copying it to yourtheme/materialpool/single-organisation.php.
 *
 * @since      0.0.1
 * @package    Materialpool
 * @author     Frank Staude <frank@staude.net>
 * @version    0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

get_header( 'materialpool' ); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php
                /* Start the Loop */
                while ( have_posts() ) : the_post();
                    get_template_part('template-parts/organisation/content', get_post_format());

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <div id="secondary" style="display: none"></div>
    </div><!-- .wrap -->

<?php get_footer();