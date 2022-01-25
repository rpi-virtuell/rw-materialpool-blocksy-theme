<?php
/**
 * Template Name: Startseite
 * Template Post Type: page
 *
 * @version 1.0
 *
 */

ob_start();

$show_title = get_field('show_title');

if ($show_title):

    $startseite_title = get_field('startseite_title');
    $startseite_freitext = get_field('startseite_freitext');

    ?>
    <div class="startseite-block-header">
        <p><?php echo $startseite_title; ?></p>
    </div>
    <div class="startseite-block-content material-results">
        <div>
            <?php echo do_shortcode($startseite_freitext); ?>
        </div>
    </div>
<?php
endif;
$show_aktuell = get_field('show_aktuell');
if ($show_aktuell == 1) {
    ?>
    <div class="startseite-block-header">
        <p><?php
            $startseite_aktuell_titel = get_field('startseite_aktuell_titel');
            echo do_shortcode($startseite_aktuell_titel);
            ?></p>
        <div class="startseite-block-content material-results">
            <?php
            $startseite_aktuell = get_field('startseite_aktuell');
            if ($startseite_aktuell !== null && $startseite_aktuell != '') {
                $IDlistArr = array();
                foreach ($startseite_aktuell as $entry) {
                    $IDlistArr[] = $entry->ID;
                }

                $args = array(
                    'post__in' => $IDlistArr,
                    'post_type' => array('material'),
                );
                $my_query = new WP_Query($args); ?>
                <div class="material-grid-layout" data-cards="boxed">
                    <?php
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <?php
                        if (true || false === ($transient = get_transient('facet_autor_entry-' . $post->ID))) {
                            ob_start();
                            ?>
                            <article class="entry-card">
                            <div class="facet-treffer">
                                <div class="facet-treffer-content">
                                    <h2>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>

                                    <a class="search-cover boundless-image" href="<?php the_permalink(); ?>"
                                       tabindex="-1">
                                        <?php if (!empty(Materialpool_Material::get_cover())) { ?>
                                            <img src="<?php echo Materialpool_Material::get_cover() ?>" alt="">
                                            <span class="ct-ratio" style="padding-bottom: 75%"></span>
                                        <?php } ?>
                                    </a>
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
                                            if (Materialpool_Material::has_autor()) {
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
                                        <div style="text-align: end">
                                            <?php echo Materialpool_Material::rating_facet_html(); ?>
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

                            <?php
                            $buffer = ob_get_contents();
                            ob_end_clean();
                            echo $buffer;
                            set_transient('facet_autor_entry-' . $post->ID, $buffer);
                        } else {
                            echo $transient;
                        }
                        ?>
                        </article>
                    <?php endwhile; ?>
                </div>


                <?php
                wp_reset_postdata();
                unset($my_query);
            }
            $startseite_aktuell = get_field('startseite_themen');

            if ($startseite_aktuell !== null && !empty($startseite_aktuell)) {
                $IDlistArr = array();
                foreach ($startseite_aktuell as $entry) {
                    $IDlistArr[] = $entry->ID;
                }
                $args = array(
                    'post__in' => $IDlistArr,
                    'post_type' => array('themenseite'),
                );
                $my_query = new WP_Query($args);
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <div class="facet-treffer>">
                        <div class="facet-treffer-content">
                            <div class="material-cover">
                                <img src="<?php echo catch_thema_image() ?>">
                            </div>
                            <p class="material-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </p>
                            <p class="search-description">
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php
}


?>
<?php
$show_neu = get_field('show_neu');
if ($show_neu == 1) {
    ?>
    <div class="startseite-block-header">
        <P><?php
            $startseite_neu_titel = get_field('startseite_neu_titel');
            echo do_shortcode($startseite_neu_titel);
            ?></P>
        <div class="startseite-block-content  material-results">
            <?php echo facetwp_display('template', 'startseite_neue_materialien'); ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php
}
?>

<?php
$show_themenseiten = get_field('show_themenseiten');
if ($show_themenseiten) {
    ?>
    <div class="startseite-block-header">
        <P><?php
            $show_themenseiten_titel = get_field('startseite_themenseiten_titel');
            echo do_shortcode($show_themenseiten_titel);
            ?></P>

        <div class="startseite-block-content">
            <?php
            echo rw_material_get_themenliste();
            ############################
            ########################

            ?>
        </div>
    </div>

    <div class="clear"></div>


    <?php
}
?>



<?php
$show_oer = get_field('show_oer');
if ($show_oer == 1) {
    ?>
    <div class="startseite-block-header">
        <P><?php
            $startseite_oer_titel = get_field('startseite_oer_titel');
            echo do_shortcode($startseite_oer_titel);
            ?></P>
        <div class="startseite-block-content  material-results">
            <?php echo facetwp_display('template', 'startseite_oer'); ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php
}
?>
<?php
$show_special = get_field('show_special');
if ($show_special == 1) {
    ?>
    <div class="startseite-block-header">
        <p><?php
            $startseite_special_titel = get_field('startseite_special_titel');
            echo do_shortcode($startseite_special_titel);
            ?></p>
        <div class="startseite-block-content material-results">
            <?php echo facetwp_display('template', 'startseite_specials'); ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php
}
?>
<?php
$show_about = get_field('show_about');
if ($show_about == 1) {
    ?>
    <div class="startseite-block-header">
        <p><?php
            $startseite_about_titel = get_field('startseite_about_titel');
            echo do_shortcode($startseite_about_titel);
            ?></p>
        <div class="startseite-block-content">
            <?php
            $about = get_field('startseite_about');
            echo do_shortcode($about);
            ?>
        </div>
    </div>
    <div class="clear"></div>
    <?php
}


if (false):
    ?>
    <div class="startseite-block-header">
        <p><?php
            $show_themenseiten_titel = get_field('startseite_themenseiten_titel');
            echo do_shortcode($show_themenseiten_titel);
            ?></p>
        <div class="startseite-block-content  material-results">
            <div class="facetwp-template" data-name="startseite_aktuell">
                <?php
                $args = array(
                    'posts_per_page' => 3,
                    'post_type' => array('themenseite'),
                );
                $my_query = new WP_Query($args);
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <div class="facet-treffer>">
                        <div class="facet-treffer-content">
                            <div class="material-cover">
                                <img src="<?php echo catch_thema_image() ?>">
                            </div>
                            <p class="material-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                            <p class="search-description">
                                <?php the_excerpt(); ?>
                            </p>
                        </div>
                        <div class="clear"></div>
                    </div>

                <?php endwhile;
                wp_reset_postdata();
                ?>
            </div>
        </div>
    </div>
    <div class="clear"></div>
<?php endif;

$content = ob_get_clean();
ThemeCore::draw_page_content($content);
?>
