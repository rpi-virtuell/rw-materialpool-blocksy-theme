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
<article id="autor-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if (is_sticky() && is_home()) :
        echo twentyseventeen_get_svg(array('icon' => 'thumb-tack'));
    endif;
    ?>
    <header class="entry-header">
        <?php
        if ('autor' === get_post_type()) :
            if (is_single()) {
                ?><h1 class="entry-title">Materialien
                von <?php Materialpool_Autor::firstname();
                echo " ";
                Materialpool_Autor::lastname(); ?></h1><?php
            } else {
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            }

        endif; ?>
    </header><!-- .entry-header -->
    <div class="entry-content autor">
        <div class="sidebar">
            <div class="first-search-facets">
                <?php echo facetwp_display('facet', 'bildungsstufe'); ?>
                <?php echo facetwp_display('facet', 'medientyp'); ?>
            </div>
        </div>
        <div class="autor-content" style="margin: 0 15px 0">

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
            <div class="material-results"><?php echo facetwp_display('template', 'material_autor'); ?></div>
            <div class="material-pager"><?php echo facetwp_display('pager'); ?></div>

        </div>
        <div class="autor-right material-meta-container">
            <table class="autor-meta-table">
                <?php if (Materialpool_Autor::get_picture()): ?>
                    <tr>
                        <td colspan="2">
                            <div class="autor-image">
                                <?php Materialpool_Autor::picture_html(); ?><br>
                                <div class="material-picture-source" style="margin-right: 0">
                                    <?php if (Materialpool_Autor::get_picture() != '') {
                                        ?> <a href=' <?php echo Materialpool_Autor::get_picture() ?>'> Bildquelle </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="autor-name" style="text-align: center">
                                <?php Materialpool_Autor::firstname();
                                echo " ";
                                Materialpool_Autor::lastname(); ?>
                            </div>
                            <div class="material-detail-buttons material-column">
                                <a class="cta-button" href="<?php Materialpool_Autor::url(); ?>">Webseite</a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
                <?php if (Materialpool_Autor::has_organisationen()): ?>
                    <tr>
                        <td colspan="2">
                            <div class="material-detail-meta-author material-meta">
                                <h4>Wirkungsbereich</h4>
                                <?php Materialpool_Autor::organisation_html_cover(); ?>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>

                <?php if (($n = Materialpool_Autor::get_count_posts_per_autor()) > 4): ?>
                    <tr>
                        <td colspan="2">
                            <?php
                            if ($n >= 5) {
                                $badgeclass = 'grau';
                                $badgetitle = 'mindestens <br>5 Beiträge';
                            }
                            if ($n >= 20) {
                                $badgeclass = 'gruen';
                                $badgetitle = '<b>' . $n . '</b><br>Praxisbeiträge';
                            }
                            if ($n > 100) {
                                $badgeclass = 'gold';
                                $badgetitle = '<b>über 100</b><br>Praxisbeiträge';
                            }
                            ?>
                            <div class="autor-right badges material-meta">
                                <h4>Auszeichnungen</h4>
                                <div class="author-badge <?php echo $badgeclass; ?>">
                                    <?php echo $badgetitle; ?><br>
                                    im Materialpool
                                </div>

                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </table>

            <div class="material-detail-buttons material-column">
                <?php Materialpool_Autor::autor_request_button(); ?>
            </div>
            <div class="material-detail-buttons material-column">
                <?php Materialpool_Autor::autor_request_button2(); ?>
            </div>
        </div>


    </div>
</article>
