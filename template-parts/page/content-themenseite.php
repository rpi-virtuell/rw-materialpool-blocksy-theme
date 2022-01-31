<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <?php //twentyseventeen_edit_link( get_the_ID() ); ?>
    </header><!-- .entry-header -->
    <div class="entry-content">
        <?php
        the_content();
        ?>
        <strong>Alphabetische Liste</strong>
        <?php

        $args = array(
            "post_type" => "themenseite",
            "post_status" => "publish",
            "orderby" => "title",
            "order" => "ASC",
            "posts_per_page" => 1000,
        );
        $the_query = new WP_Query($args);
        ?>
        <?php if ($the_query->have_posts()): ?>
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <span class="thema-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
            <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_reset_query(); ?>

        <h1>Die neusten Themenseiten:</h1>
        <?php

        $args = array(
            "post_type" => "themenseite",
            "post_status" => "publish",
            "orderby" => "date",
            "order" => "DESC",
            "posts_per_page" => 9
        );
        $the_query = new WP_Query($args);
        ?>
        <?php if ($the_query->have_posts()): ?>
            <div class="material-grid-layout" data-cards="boxed">
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <article class="entry-card themenseite">
                        <div class="facet-treffer">
                            <div class="facet-treffer-content themenseite">
                                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

                                <a class="search-cover boundless-image" href="<?php the_permalink(); ?>">
                                <img src="<?php echo catch_thema_image() ?>" alt="">
                                <span class="ct-ratio" style="padding-bottom: 75%"></span>
                            </a>
                            <p class="thema-excerpt themenseite">
                                <?php echo wp_trim_words(get_the_excerpt(), 50);  ?>
                            </p>
                            <div class="clear"></div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>

    </div><!-- .entry-content -->
</article><!-- #post-## -->


<script>

    (function ($) {
        window.fwp_is_paging = false;
        $(document).on('facetwp-refresh', function () {
            if (!window.fwp_is_paging) {
                window.fwp_page = 1;
                FWP.extras.per_page = 'default';
            }
            window.fwp_is_paging = false;
        });
        $(document).on('facetwp-loaded', function () {
            window.fwp_total_rows = FWP.settings.pager.total_rows;
            if (!FWP.loaded) {
                window.fwp_default_per_page = FWP.settings.pager.per_page;
                $(window).scroll(function () {
                    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
                        var rows_loaded = (window.fwp_page * window.fwp_default_per_page);
                        if (rows_loaded < window.fwp_total_rows) {
                            //console.log(rows_loaded + ' of ' + window.fwp_total_rows + ' rows');
                            window.fwp_page++;
                            window.fwp_is_paging = true;
                            FWP.extras.per_page = (window.fwp_page * window.fwp_default_per_page);
                            FWP.soft_refresh = true;
                            FWP.refresh();
                        }
                    }
                });
            }
        });
    })(jQuery);

</script>