<?php
/**
 * Zeigt Verweise und Werk(parent) / Band(child) Verknüpfungen zu einem Material unterhalb des des eigentlichen Inhalts
 * User: Joachim
 * Date: 11.01.2021
 * Time: 07:34
 */
?>
<div style="height:30px; width:100px;"></div>
<?php if (Materialpool_Material::is_part_of_werk()) : ?>
    <div class="material-detail-parent material-links">
        <h3>Dieses Material ist aus der Sammlung:</h3>
        <strong><?php Materialpool_Material::werk_html(true); ?></strong>
        <ul><?php Materialpool_Material::sibling_volumes_html(true); ?></ul>
    </div>
<?php endif; ?>

<?php if (Materialpool_Material::is_werk()) : ?>
    <div class="material-detail-children material-links home">
        <h3>Zu "<?php the_title('<b>', '</b>'); ?>" gehören weitere Materialien:</h3>

        <div class="startseite-block-content material-results">
            <div class="facetwp-template">
                <?php
                $ar = Materialpool_Material::volumes_ids();
                global $post;
                if ($ar === false) return;
                $args = array(
                    'post__in' => $ar,
                    'post_type' => array('material'),
                    'posts_per_page' => 100,
                    'orderby' => 'post_title',
                    'order' => 'ASC',
                );
                $my_query = new WP_Query($args);
                while ($my_query->have_posts()) : $my_query->the_post(); ?>
                    <div class="facet-treffer<?php echo (Materialpool_Material::is_alpika()) ? ' alpika' : ''; ?><?php echo (Materialpool_Material::is_special()) ? ' special' : ''; ?>">
                        <div class="facet-treffer-content material-children">
                            <h2 class="material-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <?php if (Materialpool_Material::cover_facet_html() && !in_array(strrchr(Materialpool_Material::get_url(), '.'), array('.docx', '.doc', '.odt'))): ?>
                                <div class="material-cover">
                                    <a href=" <?php the_permalink(); ?>">
                                        <?php echo Materialpool_Material::cover_facet_html(); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            <p class="material-picture-source" style="margin-right: unset;">
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
                            <p class="material-shortdescription">
                                <?php Materialpool_Material::shortdescription(); ?><br>
                                <?php //echo wp_trim_words(  wp_strip_all_tags ( Materialpool_Material::get_description() )) ; ?>
                            </p>
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
                            </div>
                        </div>
                        <div class="clear"></div>

                    </div>
                <?php endwhile;
                wp_reset_postdata();
                unset($my_query);

                ?>


            </div>
        </div>
    </div>

<?php endif; ?>
