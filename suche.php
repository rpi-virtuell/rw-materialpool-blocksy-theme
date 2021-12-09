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

/*
    if ( 'iframe' == $wp_query->query_vars[ 'mpembed'] ) {
        get_header( 'materialpool-iframe' );
    } else {
        get_header( 'materialpool');
    }
*/

    ob_start();
    ?>
    <div class="entry-content material-facet-search">
        <div class="material-facetscontainer">
            <div class="mfacet-wrap">
                <div class="first-search-facets">
                    <?php echo facetwp_display( 'facet', 'bildungsstufe' ); ?>
                    <?php echo facetwp_display( 'facet', 'kompetenzen' ); ?>
                    <?php echo facetwp_display( 'facet', 'medientyp' ); ?>
                    <?php echo facetwp_display( 'facet', 'alpika' ); ?>
                    <?php echo facetwp_display( 'facet', 'vorauswahl' ); ?>
                    <?php echo facetwp_display( 'facet', 'schlagworte' ); ?>
                    <?php echo facetwp_display( 'facet', 'inklusion' ); ?>
                    <?php echo facetwp_display( 'facet', 'organisation' ); ?>
                    <?php echo facetwp_display( 'facet', 'autor' ); ?>
                    <?php echo facetwp_display( 'facet', 'lizenz' ); ?>
                    <?php echo facetwp_display( 'facet', 'sprache' ); ?>
                    <?php echo facetwp_display( 'facet', 'verfuegbarkeit' ); ?>
                    <?php echo facetwp_display( 'facet', 'zugaenglichkeit' ); ?>
                    <?php echo facetwp_display( 'facet', 'werkzeuge' ); ?>
                    <?php echo facetwp_display( 'facet', 'erscheinungsjahr' ); ?>
                </div>
                <div class="advanced-search-facets" style="display:none">
                    <?php echo facetwp_display( 'facet', 'erfassungsdatum' ); ?>
                    <?php echo facetwp_display( 'facet', 'bewertung' ); ?>
                </div>
                <div>
                    <?php if ( is_user_logged_in()) { ?>
                        <div class="mpshortcodegeneration-container">
                            <h5>Material-Liste Einbetten</h5>
                            <button class="mpshortcodegeneration" title="[ shortcode ]">[ copy code ]</button>
                            <input type="text" id="mpshortcode" style="position: absolute; z-index: -999; opacity: 0;">
                            Teilen: Mit diesem <a href="https://github.com/rpi-virtuell/rpi-virtuell-materialliste">Wordpress Plugin</a> kannst du diese Auswahl in deiner Seite anzeigen
                        </div>

                        <div class="clear"></div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="material-resultcontainer">

            <div class="material-suche">
                <?php echo facetwp_display( 'facet', 'suche' ); ?>
            </div>
            <div class="clear"></div>
            <div class="material-selection"><?php echo facetwp_display( 'selections' ); ?></div>
            <div class="clear"></div>

            <div>
                <div class="material-counter">
                    <?php echo facetwp_display( 'counts' ); ?> Treffer
                </div>
                <div class="material-pager">
                    <?php echo facetwp_display( 'pager' ); ?>
                </div>

            </div>
            <div class="clear"></div>
            <div class="material-old">
                <?php echo facetwp_display( 'facet', 'test' ); ?>
            </div>
            <div class="material-results"><?php echo facetwp_display( 'template', 'material_suchausgabe' ); ?></div>
            <div class="material-pager"><?php echo facetwp_display( 'pager' ); ?></div>
            <div id="page-loader"></div>
        </div>
    </div>
    <?php
$content = ob_get_clean();
ThemeCore::draw_page_content($content);
/*
if ( 'iframe' == $wp_query->query_vars[ 'mpembed'] ) {
    get_footer('materialpool-iframe' );
} else {
	get_footer( );
}
*/
