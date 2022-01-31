<div class="material-grid-layout"<?php if (!isset($my_query)) echo 'data-layout="enhanced-grid"'; ?> data-cards="boxed">
    <?php
    if (!isset($my_query)) {
        while (have_posts()) : the_post();
            include get_stylesheet_directory() . "/facetwp_templates/material_loop_content.php";
        endwhile;
    } else {
        while ($my_query->have_posts()) : $my_query->the_post();
            include get_stylesheet_directory() . "/facetwp_templates/material_loop_content.php";
        endwhile;
    }
    unset($my_query);
    wp_reset_query();
    ?>
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
