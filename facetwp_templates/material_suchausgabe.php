<div class="material-grid-layout" data-cards="boxed">
    <?php while (have_posts()) :
        the_post(); ?>

        <?php

      /*  if (($transient = get_transient('facet_serach2_entry-' . $post->ID))) {*/
            ob_start();

            ?>
            <?php if (get_post_type() == 'themenseite'): ?>
                <article class="entry-card themenseite">
                    <div class="facet-treffer">
                        <div class="facet-treffer-content themenseite">
                            <h2><a href="<?php the_permalink(); ?>">Themenseite: <?php the_title(); ?></a></h2>
                            <a class="search-cover boundless-image" href="<?php the_permalink(); ?>">
                                <img src="<?php echo catch_thema_image() ?>" alt="">
                                <span class="ct-ratio" style="padding-bottom: 75%"></span>
                            </a>
                            <p class="thema-excerpt">
                                <?php echo wp_trim_words(get_the_excerpt(), 50); ?>
                            </p>
                        </div>
                    </div>
                </article>

            <?php else: ?>

                <article
                        class="entry-card<?php echo (Materialpool_Material::is_alpika()) ? ' alpika' : ''; ?><?php echo (Materialpool_Material::is_special()) ? ' special' : ''; ?>">

                    <div class="facet-treffer">
                        <div class="facet-treffer-content">
                            <h2>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php if (!empty(Materialpool_Material::get_cover())) { ?>
                                <a class="search-cover boundless-image" href="<?php the_permalink(); ?>" tabindex="-1">
                                    <img src="<?php echo Materialpool_Material::get_cover() ?>"
                                         onerror="this.onerror = null; this.src=' <?php echo get_stylesheet_directory_uri() . "/assets/material_placeholder.jpg" ?>'"
                                         alt="">
                                    <span class="ct-ratio" style="padding-bottom: 75%"></span>
                                </a>
                            <?php } ?>
                            <p class="material-picture-source">
                                <?php
                                if (Materialpool_Material::get_picture_source() != '') {
                                    if (Materialpool_Material::get_picture_url() != '') {
                                        echo "Bildquelle: <a href='" . Materialpool_Material::get_picture_url() . "'>" . Materialpool_Material::get_picture_source() . "</a>";
                                    } else {
                                        echo "Bildquelle: " . Materialpool_Material::get_picture_source();
                                    }
                                } else {
                                    if (Materialpool_Material::get_picture_url() != '') {
                                        $host = parse_url(Materialpool_Material::get_picture_url());

                                        if ($host['host'])
                                            echo "Bildquelle: <a href='" . Materialpool_Material::get_picture_url() . "'>" . $host['host'] . "</a>";
                                    }
                                }
                                ?>
                            </p>
                            <p class="material-shortdescription"><?php Materialpool_Material::shortdescription(); ?></p>
                            <p class="material-desc"> <?php echo wp_trim_words(wp_strip_all_tags(Materialpool_Material::get_description())); ?> </p>

                            <div class="ct-ghost"></div>
                            <div style="clear: both;"></div>
                            <div class="taxonomien">
                                <div class="organisation">
                                    <?php if (!empty(Materialpool_Material::get_organisation()[0])) {
                                        ?>
                                        <img class="taxonomy-icon"
                                             src="<?php echo get_stylesheet_directory_uri() . "/assets/006-institution.svg" ?> "
                                             alt="">
                                        <?php
                                        //echo Materialpool_Material::organisation_facet_html();
                                        global $post;
                                        $data = '';
                                        $verweise = Materialpool_Material::get_organisation();
                                        foreach ($verweise as $verweisID) {
                                            $verweis = get_post($verweisID, ARRAY_A);
                                            $url = get_permalink($verweis['ID']);
                                            if ($data != '') $data .= ', ';
                                            $data .= '<a href="' . $url . '" class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-verweise') . '">' . $verweis['post_title'] . '</a>';

                                        }
                                        $organisation = apply_filters('materialpool_material_description_interim_organisation', get_metadata('post', $post->ID, 'material_organisation_interim', true));
                                        if ($organisation != '') {
                                            if ($data != '') $data .= ', ';
                                            $data .= '<a class="' . apply_filters('materialpool-template-material-organisation', 'materialpool-template-material-organisation') . '">' . $organisation . '</a>';
                                        }
                                        echo $data;

                                    }
                                    ?>
                                </div>
                                <div class="author">
                                    <?php
                                    if (!empty(Materialpool_Material::get_autor())) {
                                        ?>
                                        <img class="taxonomy-icon"
                                             src="<?php echo get_stylesheet_directory_uri() . "/assets/003-user.svg" ?> "
                                             alt="">
                                        <?php
                                        echo Materialpool_Material::get_autor_html();
                                    }
                                    ?>
                                </div>
                                <div class="bildungsstufe">
                                    <?php if (!empty(Materialpool_Material::get_bildungsstufen() || !empty(Materialpool_Material::get_inklusion()))) { ?>
                                        <img class="taxonomy-icon"
                                             src="<?php echo get_stylesheet_directory_uri() . "/assets/007-volume.svg" ?>  "
                                             alt="">
                                        <?php echo Materialpool_Material::get_bildungsstufen(); ?>
                                        <?php echo Materialpool_Material::get_inklusion(); ?>
                                    <?php } ?>
                                </div>
                                <div class="medientypen">
                                    <?php if (!empty(Materialpool_Material::get_medientypen())) { ?>

                                        <img class="taxonomy-icon"
                                             src="<?php echo get_stylesheet_directory_uri() . "/assets/009-package.svg" ?> "
                                             alt="">
                                        <?php echo Materialpool_Material::get_medientypen(); ?>

                                    <?php } ?>
                                </div>
                                <div class="schlagworte">
                                    <?php if (!empty(Materialpool_Material::get_schlagworte_html())) { ?>

                                        <img class="taxonomy-icon"
                                             src="<?php echo get_stylesheet_directory_uri() . "/assets/001-price-tag.svg" ?> "
                                             alt="">
                                        <?php echo Materialpool_Material::get_schlagworte_html(); ?>

                                    <?php } ?>
                                </div>
                                <div style="float: left">
                                    <div class="material-rating">
                                        <?php echo Materialpool_Material::rating_facet_html(); ?>
                                    </div>
                                </div>
                                <?php if (is_user_logged_in()) { ?>
                                    <div style="float: right;">
                <span id="themenseitenedit_<?php echo $post->ID; ?>" data-materialid="<?php echo $post->ID; ?>"
                      data-materialtitel="<?php echo $post->post_title; ?>"
                      data-materialurl="<?php echo get_permalink($post->ID); ?>" class="themenseitenedit btn-neutral"><i
                            class="fas fa-ellipsis-v"> </i></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </article>

            <?php endif;
            $buffer = ob_get_contents();
            ob_end_clean();
            echo $buffer;
            set_transient('facet_serach2_entry-' . $post->ID, $buffer);
        /*} else {
            echo $transient;
        }*/

        ?>

    <?php endwhile; ?>
</div>
<div class="loading-icon"></div>
<script src="<?php echo get_stylesheet_directory_uri() . '/js/infinite_load.js' ?>" type="text/javascript">
</script>

<script>
    jQuery(document).ready(function () {

        if (typeof jQuery.contextMenu != 'undefined' && typeof themenseiten != 'undefined' && Object.keys(themenseiten).length !== 0) {
            jQuery.contextMenu({
                selector: '.themenseitenedit',
                trigger: 'left',
                build: function ($trigger, e) {
                    var items = new Object();
                    items['titel_' + themenseiten[0].id] = {name: "Themenseite: " + themenseiten[0].titel}
                    items['sep1'] = "---------";
                    for (var tg in themengruppen) {
                        var material = new Object;
                        material['add_' + themengruppen[tg].id] = {name: "Material hinzufügen"};
                        material['sep' + tg] = "---------";
                        for (var m in materialien) {
                            if (themengruppen[tg].id == materialien[m].gruppenid) {
                                material["m_" + materialien[m].materialid] = {name: materialien[m].titel};
                            }
                        }
                        items["tg_" + tg + "_" + themengruppen[tg].themenid] = {
                            name: themengruppen[tg].titel,
                            items: material
                        };
                    }
                    items['sep2'] = "---------";
                    items['quit'] = {
                        name: "Speichern und Beenden",
                    };
                    return {
                        callback: function (key, opt, $trigger) {
                            res = key.split("_");
                            if (res[0] == "m") {
                                // Vorhandenes Material angeklickt, URL holen und dorthin weiterleiten.
                                db.materialien.where("id").equals(parseInt(res[1])).toArray().then(function (response) {
                                    var win = window.open(response[0].url, '_blank');
                                    win.focus();
                                });
                            }
                            if (res[0] == "titel") {
                                // Vorhandene Themengruppe angeklickt, Themenseiten URL holen und dorthin weiterleiten.
                                db.themenseiten.where("id").equals(parseInt(res[1])).toArray().then(function (response) {
                                    var win = window.open(response[0].url, '_blank');
                                    win.focus();
                                });
                            }
                            if (res[0] == "add") {
                                // Material einer Themengruppe hinzufügen
                                var themengruppe = res[1];
                                var url = opt.$trigger[0].getAttribute('data-materialurl');
                                var id = opt.$trigger[0].getAttribute('data-materialid');
                                var titel = opt.$trigger[0].getAttribute('data-materialtitel');
                                db.materialien.add({
                                    materialid: parseInt(id),
                                    gruppenid: themengruppe,
                                    titel: titel,
                                    url: url
                                });
                                db.materialien.toArray().then(function (response) {
                                    materialien = response;
                                });
                            }
                            if (res[0] == "quit") {
                                // Daten an Materialpool übergeben und DB löschen.
                                var data = {
                                    'action': 'mp_update_themenseite',
                                    'material': materialien,
                                    'themenseite': themenseiten,
                                };
                                jQuery.post(ajaxurl, data, function (response) {
                                    ret = response;
                                    db.delete();
                                    themenseiten = new Object();
                                });
                            }
                        },
                        items: items
                    };
                }
            });
        }
    });
</script>
