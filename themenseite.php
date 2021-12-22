<?php
/**
 * Template Name: Themenseite
 * Template Post Type: page
 *
 * @version 1.0
 *
 */
if (!defined('ABSPATH')) {
    exit; //Exit if accessed directly
}
ob_start();
?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <?php get_template_part('template-parts/page/content', 'themenseite'); ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php
$content = ob_get_clean();
ThemeCore::draw_page_content($content);
