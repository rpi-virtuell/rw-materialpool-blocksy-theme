<?php

/**
 * Helper Class
 */
class ThemeCore
{

    /**
     * baut aus dem die blocksy single page struktur um den Content:
     *
     *  ThemeCore::draw_page_pre_content(); ? >
     *
     *  <div>
     *      <p>Seiteninhalt</p>
     *  </div>
     *
     *  < ?php
     *  ThemeCore::draw_page_post_content();
     *
     *
     */
    static function draw_page_content($content, $name = null, $args = array())
    {

        if (WP_DEBUG) {
            @error_reporting(-1);
        }

        get_header($name,$args);
        if (have_posts()) {
            the_post();
        }

        /**
         * Note to code reviewers: This line doesn't need to be escaped.
         * Function blocksy_output_hero_section() used here escapes the value properly.
         */
        if (apply_filters('blocksy:single:has-default-hero', true)) {
            echo blocksy_output_hero_section([
                'type' => 'type-2'
            ]);
        }

        $page_structure = blocksy_get_page_structure();

        $container_class = 'ct-container-full';
        $data_container_output = '';

        if ($page_structure === 'none' || blocksy_post_uses_vc()) {
            $container_class = 'ct-container';

            if ($page_structure === 'narrow') {
                $container_class = 'ct-container-narrow';
            }
        } else {
            $data_container_output = 'data-content="' . $page_structure . '"';
        }


        ?>

        <div
                class="<?php echo trim($container_class) ?>"
            <?php echo wp_kses_post(blocksy_sidebar_position_attr()); ?>
            <?php echo $data_container_output; ?>
            <?php echo blocksy_get_v_spacing() ?>>

            <?php do_action('blocksy:single:container:top'); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php do_action('blocksy:single:content:top'); ?>

                <?php
                if (function_exists('blocksy_single_content')) {
                    echo blocksy_single_content($content);
                }
                ?>
            </article>
            <?php do_action('blocksy:single:content:bottom'); ?>
            <?php get_sidebar(); ?>

            <?php do_action('blocksy:single:container:bottom'); ?>
        </div>

        <?php

        blocksy_display_page_elements('separated');

        have_posts();
        wp_reset_query();
        get_footer();
    }
}
