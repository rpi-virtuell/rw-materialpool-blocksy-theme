<?php
/**
 * Template Name: Suche
 * Template Post Type: page
 *
 * @version 1.0
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
ThemeCore::draw_page_pre_content();
?>
            <div class="entry-content material-facet-search">
                <div class="material-facetscontainer">
                    <div class="mfacet-wrap">
                        <div class="first-search-facets">
                            <?php echo facetwp_display( 'facet', 'alpika_organisation' ); ?>
                            <?php echo facetwp_display( 'facet', 'konfession_organisation' ); ?>
                        </div>
                    </div>
                </div>
                <div class="material-resultcontainer">
                    <div class="material-suche">
                        <?php echo facetwp_display( 'facet', 'organisation_suche' ); ?>
                    </div>
                    <div class="clear"></div>
                    <div class="material-selection"><?php echo facetwp_display( 'selections' ); ?></div>
                    <div>
                        <div class="material-counter">
                            <?php echo facetwp_display( 'counts' ); ?> Treffer
                        </div>
                        <div class="material-pager">
                            <?php echo facetwp_display( 'pager' ); ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="material-results"><?php echo facetwp_display( 'template', 'organisation' ); ?></div>
                    <div class="material-pager"><?php echo facetwp_display( 'pager' ); ?></div></div><div id="page-loader"></div>
            </div>


<?php
ThemeCore::draw_page_post_content();
