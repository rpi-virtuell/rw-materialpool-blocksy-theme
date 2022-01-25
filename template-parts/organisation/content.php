<?php
/**
 * Created by PhpStorm.
 * User: Joachim
 * Date: 23.01.2017
 * Time: 17:22
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<article id="organisation-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if (is_sticky() && is_home()) :
        echo twentyseventeen_get_svg(array('icon' => 'thumb-tack'));
    endif;
    ?>
    <header class="entry-header">
    </header><!-- .entry-header -->
    <div class="organisation-detail-grid">
        <?php
        if ('organisation' === get_post_type()) { ?>
            <h1 class="entry-title">Unsere Praxishilfen</h1>
            <?php } ?>
        <div class="detail-organisation-search">
            <div class="organisation-content">
                <div class="material-suche">
                    <?php echo facetwp_display('facet', 'suche'); ?>
                    <div class="material-filter-button">
                        <button type="button">
                            <span class="dashicons dashicons-filter"></span>
                            Filter
                        </button>

                    </div>
                </div>
                <div class="clear"></div>
                <div class="material-selection">
                    <?php echo facetwp_display('selections'); ?>
                </div>
                <div class="sidebar">
                    <div class="first-search-facets">
                        <?php echo facetwp_display('facet', 'bildungsstufe'); ?>
                        <?php echo facetwp_display('facet', 'medientyp'); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="detail-organisation-material">
            <div class="organisation-content">
                <div class="material-counter">
                    <?php echo facetwp_display('counts'); ?> Treffer
                </div>
                <div class="material-pager">
                    <?php echo facetwp_display('pager'); ?>
                </div>
                <div class="clear"></div>
                <div class="material-results"><?php echo facetwp_display('template', 'material_organisation'); ?></div>
                <div class="material-pager"><?php echo facetwp_display('pager'); ?></div>
            </div>
        </div>

    </div>

    <?php /*
                if ( Materialpool_Organisation::get_top_orga_id() !== false ) { ?>
                <div class="organisation-top-orga" >
                    Diese Seite ist Teil von:<br>
                    <?php Materialpool_Organisation::top_orga_html(); ?><br>
                </div>
            <?php } ?>
	        <?php $a = Materialpool_Organisation::get_bottom_orga_ids(); if ( $a[0] > 0 ) { ?>
                <div class="organisation-bottom-orga" >
                    Zu dieser Seite gehören auch:<br>
			        <?php Materialpool_Organisation::bottom_orga_html(); ?><br>
                </div>
	        <?php }
            */ ?>
</article>

<script>
    jQuery(document).ready(function ($) {
        $('#more-button').on('click', function () {
            $('.detail-organisation-author').css({overflow: 'visible', height: 'auto'});
            $('#less-button').show();
            $('#more-button').hide();
        });
        $('#less-button').on('click', function () {
            $('.detail-organisation-author').css({overflow: 'hidden', height: '200px'});
            $('#more-button').show();
            $('#less-button').hide();
        });
    })
</script>