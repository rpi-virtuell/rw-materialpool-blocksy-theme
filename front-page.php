<?php
/**
 * Template Name: Startseite
 * Template Post Type: page
 *
 * @version 1.0
 *
 */

ob_start();
?>

<div class="startseite-block-content">
    <div class="frontpage-search-container">
        <form action="/facettierte-suche/">
            <div class="frontpage-search">
                <div></div>
                <input class="frontpage-search-field search" type="text" name="fwp_suche"
                       placeholder="Suchbegriff eingeben">
                <select class="frontpage-search-field" name="fwp_bildungsstufe">
                    <option value="">Alle Bereiche</option>
                    <option value="elementary">Elementarbereich</option>
                    <option value="primary">Grundschule</option>
                    <option value="secondary">Sekundarstufe</option>
                    <option value="advanced">Oberstufe</option>
                    <option value="professional">Berufsschule</option>
                    <option value="teachers">Unterrichtende</option>
                    <option value="adult-education">Erwachsenenbildung</option>
                    <option value="confirmation-work">Konfirmandenarbeit</option>
                </select>
                <input class="frontpage-search-field material-filter-button" type="submit" value="Suchen">
                <div></div>
            </div>
        </form>
    </div>
</div>
<?php
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
endif; ?>
<?php
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
                $my_query = new WP_Query($args);
                include get_stylesheet_directory() . "/facetwp_templates/material.php";
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
$show_oer = get_field('show_oer');
if ($show_oer) {

    $args = array(
        "post_type" => "material",
        "post_status" => "publish",
        "orderby" => "date",
        "order" => "DESC",
        "posts_per_page" => 3,
        "tax_query" => array(
            array(
                "taxonomy" => "lizenz",
                "field" => "slug",
                "terms" => array('non-commercial-copyable', 'non-commercial-remixable', 'copyable', 'remixable')
            )
        )
    );

    $my_query = new WP_Query($args);
    ?>
    <div class="startseite-block-header">
        <P><?php
            $startseite_oer_titel = get_field('startseite_oer_titel');
            echo do_shortcode($startseite_oer_titel);
            ?></P>
        <div class="startseite-block-content  material-results">
            <?php include get_stylesheet_directory() . "/facetwp_templates/material.php"; ?>
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
            <?php
            $args = [
                "post_type" => [
                    "material"
                ],
                "post_status" => [
                    "publish"
                ],
                "tax_query" => [
                    [
                        "taxonomy" => "vorauswahl",
                        "field" => "slug",
                        "operator" => "IN",
                        "terms" => [
                            "handverlesen"
                        ]
                    ]
                ],
                "orderby" => [
                    "date" => "DESC"
                ],
                "posts_per_page" => "6"
            ];
            $my_query = new WP_Query($args);
            include get_stylesheet_directory() . "/facetwp_templates/material.php";
            ?>
        </div>
    </div>
    <div class="home-page-show-more">
        <a class="button" href="<?php echo home_url() . '/facettierte-suche/'; ?>">Mehr Material</a>
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
