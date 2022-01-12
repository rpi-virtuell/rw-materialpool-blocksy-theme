<?php
/**
 * Material-Detail-Grid
 * User: Joachim, Daniel Reintanz
 * Date: 21.01.2017
 * Time: 07:34
 */

?>

<article id="material-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php

        if (is_single()) {
            the_title('<h1 class="entry-title">', '</h1>');
        } else {
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
        }
        ?>
    </header><!-- .entry-header -->
    <div class="material-detail">
        <div class="material-detail-grid">
            <div class="detail-snapshot detail-element">

                <?php
                if (!Materialpool_Material::is_special() && !Materialpool_Material::is_viewer() && !Materialpool_Material::is_playable()) {
                    ?>
                    <div class="detail-cover normal-cover"> <?php
                        echo "<a href='" . Materialpool_Material::get_url()  ."'>";
                        echo Materialpool_Material::cover_facet_html_noallign();
                        echo "</a>";
                        if (Materialpool_Material::get_picture_source() != '') {
                            if (Materialpool_Material::get_picture_url() != '') {
                                echo "Bildquelle: <a href='" . Materialpool_Material::get_picture_url() . "'>" . Materialpool_Material::get_picture_source() . "</a>";
                            } else {
                                echo "Bildquelle: " . Materialpool_Material::get_picture_source();
                            }
                        } else {
                            if (Materialpool_Material::get_picture_url() != '') {
                                $host = parse_url(Materialpool_Material::get_picture_url());
                            }
                        } ?>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="detail-cover special-cover">
                        <?php
                        get_template_part('template-parts/material/content-special', get_post_format());
                        ?>
                    </div>
                <?php } ?>
                <div class="detail-cover-source">
                    <?php
                    if (!empty($host['host'])) {
                        echo "Bildquelle: <a href='" . Materialpool_Material::get_picture_url() . "'>" . $host['host'] . "</a>";
                    }
                    ?>
                </div>
                <div class="detail-snapshot-footer">
                    <div class="detail-short-desc">
                        <?php Materialpool_Material::shortdescription(); ?>
                    </div>
                </div>
            </div>
            <div class="detail-origin detail-element">
                <div class="detail-herkunft">
                    <?php if (Materialpool_Material::has_organisation()) { ?>
                    <h4> Herkunft</h4>
                        <div class="detail-herkunft-organisation">
                            <?php Materialpool_Material::organisation_html_cover();
                            $organisationen = Materialpool_Material::get_organisation();
                            if (is_array($organisationen)) {
                                foreach ($organisationen as $organisation) {
                                    if (isset($organisation['ID'])) {
                                        $oid = Materialpool_Organisation::get_top_orga_id($organisation['ID']);
                                    } else {
                                        $oid = false;
                                    }
                                    if ($oid !== false) { ?>
                                        Diese Seite ist Teil von:
                                        <?php Materialpool_Organisation::top_orga_html($oid); ?><br>
                                        <?php
                                    }
                                    if ('material' === get_post_type()) {
                                        if (is_single()) { ?>
                                            <a href="<?php Materialpool_Material::url(); ?>">
                                                <?php Materialpool_Material::url_shorten(); ?>
                                            </a>
                                        <?php }
                                    }
                                }
                            } ?>
                        </div>
                    <?php } ?>
                    <?php if (Materialpool_Material::has_autor()) {
                        global $post;
                        $verweise = Materialpool_Material::get_autor();
                        if (!empty($verweise) && is_array($verweise)) {
                                $accordion = '<h3> Autoren </h3>';
                                $accordion .= '<div class="detail-herkunft-author" ';
                                if (count($verweise) == 1)
                                    $accordion .= 'style = "grid-template-columns: unset"';
                                $accordion .= '>';
                                foreach ($verweise as $verweisID) {
                                    $verweis = get_post($verweisID, ARRAY_A);
                                    $url = get_permalink($verweis['ID']);
                                    $logo = get_metadata('post', $verweis['ID'], 'autor_bild_url', true);
                                    $vorname = get_post_meta($verweis['ID'], 'autor_vorname', true);
                                    $nachname = get_post_meta($verweis['ID'], 'autor_nachname', true);
                                     $accordion .= '<div class="detail-herkunft-single-author">';
                                    if ($logo != '') {
                                        //echo '<a href="' . $url . '" class="'. apply_filters( 'materialpool-template-material-verweise', 'materialpool-template-material-autor-logo' ) .'"><img  class="'. apply_filters( 'materialpool-template-material-verweise', 'materialpool-template-material-autor-logo' ) .'" src="' . $logo . '"></a>';
                                        $accordion .= '<a href="' . $url . '" style="background-image:url(\'' . $logo . '\')" class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '"><img  class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '" src="' . $logo . '"></a>';
                                    } else {
                                        $accordion .= '<a href="' . $url . '" style="background-image:url(\'/wp-content/themes/rw_materialpool-blocksy-theme/assets/Portrait_placeholder.png\')" class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '"><img  class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '" src="../../assets/Portrait_placeholder.png"></a>';
                                    }
                                    $accordion .= '<div class="detail-herkunft-single-author-name">';
                                    $accordion .= '<a href="' . $url . '" class="' . apply_filters('materialpool-template-material-autor', 'materialpool-template-material-autor') . '">' . $vorname . ' ' . $nachname . '</a>';
                                    $accordion .= '</div>';
                                    $accordion .= '</div>';
                                }
                                $accordion .= '</div>';
                               echo do_shortcode('[accordion]'.$accordion .'[/accordion]');
                               ?>
                        <?php }
                    } ?>
                    <?php if (Materialpool_Material::get_werk_id()) { ?>
                        <div class="detail-parent">
                            <p>Dieses Material gehört zu: <?php Materialpool_Material::werk_html(); ?> </p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="detail-desc">

                <div id="description" class="description">
                    <div id="description-short">
                        <?php
                        $value = apply_filters('the_content', Materialpool_Material::get_description());
                        $embed = $GLOBALS['wp_embed'];
                        // $value = do_shortcode('[accordion] <h3> Beschreibung </h3>' . $value . '[/accordion]');
                        $value = $embed->run_shortcode($value);
                        $value = $embed->autoembed($value);
                        $value = do_shortcode($value);
                        echo wp_trim_words(wp_strip_all_tags($value), 50,
                            '<a id="more-button" href="#more"> Mehr Anzeigen</a>');

                        ?>
                    </div>
                    <div id="description-more" style="display: none">
                        <?php echo $value ?>
                        <a id="less-button" href="#less">Weniger Anzeigen</a>
                    </div>
                </div>
                <div class="detail-access-buttons">
                    <?php echo Materialpool_Material::cta_link(); ?>
                    <?php echo Materialpool_Material::cta_url2clipboard(); ?>
                    <?php Materialpool_Material::get_themenseiten_for_material_html(); //TODO: doesnt work?
                    ?>
                </div>
                <div class="description-footer">
                    <?php Materialpool_Material::description_footer(); ?>
                </div>
            </div>
            <div class="detail-meta">
                <?php get_template_part('template-parts/material/content-part-meta', get_post_format()); ?>
            </div>
            <div class="detail-links">
                <?php get_template_part('template-parts/material/content-part-links', get_post_format()); ?>
            </div>
            <div class="detail-children">
                <?php get_template_part('template-parts/material/content-part-children', get_post_format()); ?>
            </div>
        </div>
</article><!-- #post-## -->

<script>
    jQuery(document).ready(function ($) {
        $('#more-button').on('click', function () {
            $('#description-short').hide(0, function () {
                $('#description-more').slideDown(700);
                $('#less-button').show();
            });
        });
        $('#less-button').on('click', function () {
            $('#description-more').slideUp(700);
            $('#description-short').show(0);
            $('#less-button').hide();
        });
    })
</script>
