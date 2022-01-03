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
        <?php
        if ('organisation' === get_post_type()) :
            if (is_single()) {
                ?><h1 class="entry-title"><?php Materialpool_Organisation::title(); ?> </h1><?php
            } else {
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            }

        endif; ?>

        <div class="material-filter-button">
            <button type="button">
                <span class="dashicons dashicons-filter"></span>
                Filter
            </button>
        </div>

    </header><!-- .entry-header -->
    <div class="entry-content organisation">

        <div class="sidebar">
            <div class="first-search-facets">
                <?php echo facetwp_display('facet', 'bildungsstufe'); ?>
                <?php echo facetwp_display('facet', 'medientyp'); ?>

            </div>
        </div>
        <div class="organisation-content">
            <div class="material-suche">
                <?php echo facetwp_display('facet', 'suche'); ?>
            </div>
            <div class="clear"></div>
            <div class="material-selection">
                <?php echo facetwp_display('selections'); ?>
            </div>
            <div>
                <div class="material-counter">
                    <?php echo facetwp_display('counts'); ?> Treffer
                </div>
                <div class="material-pager">
                    <?php echo facetwp_display('pager'); ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="material-results"><?php echo facetwp_display('template', 'material_organisation'); ?></div>
            <div class="material-pager"><?php echo facetwp_display('pager'); ?></div>

        </div>

        <div class="organisation-right material-meta-container">
            <table class="organisation-meta-table">
                <?php if (Materialpool_Organisation::get_logo()): ?>
                    <tr>
                    <td colspan="2">
                    <?php Materialpool_Organisation::logo_html(); ?>
                <?php else: ?>
                    <h2 class="image-alt">
                        <?php Materialpool_Organisation::title(); ?>
                    </h2>
                    </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="2">
                        <div class="material-detail-buttons material-column">
                            <a class="cta-button" href="<?php echo Materialpool_Organisation::get_url(); ?>">Homepage
                                der
                                Einrichtung</a>

                        </div>
                    </td>
                </tr>
                <?php if (Materialpool_Organisation::is_alpika()): ?>
                    <tr>
                    <td colspan="2">
                    <p><img class="alpika-logo"
                            src="http://material.rpi-virtuell.de/wp-content/plugins/rw-materialpool//assets/alpika.png">
                        <?php Materialpool_Organisation::title(); ?> ist Teil der
                        <a href="http://www.relinet.de/alpika.html">Arbeitsgemeinschaft</a>
                        der Pädagogischen Institute und Katechetischen Ämter
                        <img class="ekd-logo"
                             src="https://datenschutz.ekd.de/wp-content/uploads/2015/01/EKD-Logo.png">
                        in der Evangelischen Kirche in Deutschland.
                    </p>
                <?php elseif (Materialpool_Organisation::get_konfession() == 'evangelisch'): ?>
                    <b>Evangelische Einrichtung.</b>
                <?php elseif (Materialpool_Organisation::get_konfession() == 'katholisch'): ?>
                    <b>Katholische Einrichtung.</b>
                <?php elseif (Materialpool_Organisation::get_konfession() == 'islamisch'): ?>
                    <b>Islamische Einrichtung.</b>
                    </td>
                    </tr>
                <?php endif; ?>

                <?php if (!empty(Materialpool_Organisation::get_autor())): ?>
                    <tr>
                        <td>
                            <div class="material-detail-meta-author material-meta">
                                <h4>Autor:innen</h4>
                                <?php Materialpool_Organisation::autor_html_picture(); ?>
                            </div>
                        </td>
                    </tr>

                <?php endif; ?>
            </table>

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
        </div>


    </div>
</article>
