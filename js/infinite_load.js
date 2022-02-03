(function ($) {
    window.fwp_is_paging = false;
    $(document).on('facetwp-refresh', function () {
        if (!window.fwp_is_paging) {
            window.fwp_page = 1;
            FWP.extras.per_page = 'default';
        }
        window.fwp_is_paging = false;
    });

    var do_refresh = true;

    $(document).on('facetwp-loaded', function () {
        window.fwp_total_rows = FWP.settings.pager.total_rows;
        if (!FWP.loaded) {
            window.fwp_default_per_page = FWP.settings.pager.per_page;
            if ($(document).height() <= $(window).height() && do_refresh)
            {
                window.fwp_page++;
                var init_per_page = (window.fwp_page * window.fwp_default_per_page);
               if(location.search  !== '')
               {
                   location.search ='?fwp_per_page=' + init_per_page;
               }else
               {
                   location.search +='&fwp_per_page=' + init_per_page;
               }
            }
            $(window).scroll(function () {
                if ($(window).scrollTop() <= $(document).height() - $(window).height() &&
                    $(window).scrollTop() >= $(document).height() - $(window).height() - ($(window).height() / 2)) {
                    var rows_loaded = (window.fwp_page * window.fwp_default_per_page);
                    var $loading_icon = jQuery('.loading-icon');
                    if (rows_loaded < window.fwp_total_rows && do_refresh) {
                        do_refresh = false;
                        $loading_icon.toggle({'duration': 0})
                        //console.log(rows_loaded + ' of ' + window.fwp_total_rows + ' rows');
                        window.fwp_page++;
                        window.fwp_is_paging = true;
                        FWP.extras.per_page = (window.fwp_page * window.fwp_default_per_page);
                        FWP.soft_refresh = true;
                        FWP.refresh();
                    }
                }
            });
            $(document).on('facetwp-loaded', function() {
                do_refresh = true;
            });
        }
    });

})(jQuery);