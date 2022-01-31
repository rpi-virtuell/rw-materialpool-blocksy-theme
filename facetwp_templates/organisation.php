<div class="material-grid-layout" data-cards="boxed">
    <?php while (have_posts()) : the_post(); ?>
        <article class="entry-card">
            <div class="facet-treffer">
                <div class="facet-treffer-content">
                    <a class="search-cover boundless-image" href="<?php echo get_permalink() ?>">
                        <img style="object-fit: scale-down" src=" <?php echo Materialpool_Organisation::get_logo(); ?>"
                             alt="">
                        <span class="ct-ratio" style="padding-bottom: 75%"></span>
                    </a>
                    <div class="autor-content">
                        <h2><a href="<?php echo get_permalink(); ?>"><?php Materialpool_Organisation::title(); ?></a>
                        </h2>
                        <?php
                        $anzahl = Materialpool_Organisation::get_count_posts_per_organisation();

                        if ($anzahl != '' && $anzahl != 0) {
                            echo "Anzahl Materialien: " . $anzahl;
                        }
                        $url = Materialpool_Organisation::get_url();
                        if ('' != $url) {
                            ?>
                            Internet: <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
                            <?php
                        }

                        ?>
                    </div>
                    <div class="ct-ghost"></div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</div>
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
