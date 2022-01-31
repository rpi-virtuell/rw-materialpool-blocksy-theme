<?php
/**
 * Template Name: Autoren Suche
 * Template Post Type: page
 *
 * @version 1.0
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
ob_start()
?>
    <h1 class="entry-title">
        Autor/innen suchen
    </h1>
    <div class="material-suche">
        <?php echo facetwp_display('facet', 'autor_suche'); ?>
        <div class="material-filter-button">
            <button type="button">
                <span class="dashicons dashicons-filter"></span>
                Filter
            </button>
        </div>
    </div>
    <div class="entry-content material-facet-search">
    <div class="sidebar">
        <div class="first-search-facets">
            <?php echo facetwp_display('facet', 'autor_organisation'); ?>
        </div>
    </div>
    <div class="material-resultcontainer">
        <div class="right material-detail-buttons material-column">
            <?php Materialpool_Autor::autor_request_button2(); ?>
        </div>
        <div class="clear"></div>
        <div class="material-selection"><?php echo facetwp_display('selections'); ?></div>
        <div>
            <div class="material-counter">
                <?php echo facetwp_display('counts'); ?> Treffer
            </div>
        </div>
        <div class="clear"></div>
        <div class="material-results"><?php echo facetwp_display('template', 'autoren'); ?></div>
    </div>
    <div id="page-loader"></div>
    </div><?php
$content = ob_get_clean();
ThemeCore::draw_page_content($content);
