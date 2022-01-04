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
        <div class="detail-organisation-header">
            <div class="organisation-info">
                <div class="organisation-cover">
                    <?php if (Materialpool_Organisation::get_logo()) { ?>
                        <?php Materialpool_Organisation::logo_html(); ?>
                    <?php } else { ?>
                        <h2 class="image-alt">
                            <?php Materialpool_Organisation::title(); ?>
                        </h2>
                    <?php } ?>
                </div>
                <div class="organisation-link">
                    <a class="cta-button" href="<?php echo Materialpool_Organisation::get_url(); ?>">Homepage der
                        Einrichtung</a>
                </div>
                <div class="organisation-meta">
                    <?php if (Materialpool_Organisation::is_alpika()): ?>
                        <p>
                            <img class="alpika-logo"
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
                    <?php endif; ?>
                </div>
            </div>
            <div class="organisation-author">

                <?php if (!empty(Materialpool_Organisation::get_autor())) { ?>
                        <?php
                        $accordion = '<h3>Autor:innen</h3>';
                    $verweise = Materialpool_Organisation::get_autor();
                        $accordion .= '<div class="detail-organisation-author" ';
                        if (count($verweise) == 1)
                            $accordion .= 'style = "grid-template-columns: unset"';
                        $accordion .= '>';
                       if (!empty($verweise) && is_array($verweise))
                        {
                        foreach ($verweise as $verweis) {
                            if (empty($verweis))
                                continue;
                            $url = get_permalink($verweis);
                            $post = get_post($verweis);
                            $logo = get_metadata('post', $verweis, 'autor_bild_url', true);
                            $vorname = get_metadata('post', $verweis, 'autor_vorname', true);
                            $nachname = get_metadata('post', $verweis, 'autor_nachname', true);

                            $accordion .= "<div class='detail-herkunft-single-author'>";
                            if ($logo != '') {
                                $accordion .= '<a href="' . $url . '" style="background-image:url(\'' . $logo . '\')" class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '"><img  class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '" src="' . $logo . '"></a>';
                            }
                            else {
                                $accordion .= '<a href="' . $url . '" style="background-image:url(\'/wp-content/themes/rw_materialpool-blocksy-theme/assets/Portrait_placeholder.png\')" class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '"><img  class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '" src="../../assets/Portrait_placeholder.png"></a>';
                            }
                            $accordion .= '<div class="detail-herkunft-single-author-name">';
                            $accordion .= '<a href="' . $url . '" class="' . apply_filters('materialpool-template-material-autor', 'materialpool-template-material-autor') . '">' . $vorname . ' ' . $nachname . '</a>';
                            $accordion .= "</div>";
                            $accordion .= "</div>";
                        }
                        $accordion .= "</div>";
                        echo do_shortcode('[accordion]' . $accordion . '[/accordion]');
                        }
                        ?>
                <?php } ?>

            </div>
        </div>
        <div class="detail-organisation-search">
            <?php
            if ('organisation' === get_post_type()) :
                if (is_single()) {
                    ?><h1 class="entry-title"><?php Materialpool_Organisation::title(); ?> </h1><?php
                } else {
                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                }

            endif; ?>

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
            </div>

        </div>
        <div class="detail-organisation-material organisation-content">
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
