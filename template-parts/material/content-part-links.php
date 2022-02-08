<?php
/**
 * Zeigt Titel, Beschreibung und Inhalte eines Materials im Contentbereich
 * User: Joachim
 * Date: 21.01.2017
 * Time: 07:34
 */
?>
<?php if (Materialpool_Material::has_verweise()) : ?>
    <div class="material-detail-verweise material-links ">
        <h4>Siehe dazu auch folgendes Material:</h4>

        <div class="startseite-block-content material-results home">
            <div class="material-grid-layout" data-layout="" data-cards="boxed">
                <?php
                $ar = Materialpool_Material::get_verweise_ids();
                //TODO: refactor to material
                global $post;
                if ($ar !== false && sizeof($ar) != 0) {
                    $args = array(
                        'post__in' => $ar,
                        'post_type' => array('material'),
                        'posts_per_page' => 100,

                    );
                    $my_query = new WP_Query($args);
                    while ($my_query->have_posts()) : $my_query->the_post(); ?>
                        <article
                                class="entry-card<?php echo (Materialpool_Material::is_alpika()) ? ' alpika' : ''; ?><?php echo (Materialpool_Material::is_special()) ? ' special' : ''; ?>">
                            <div class="facet-treffer">
                                <div class="facet-treffer-content material-children">
                                    <h2 class="material-title"><a
                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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
                                    </div>
                                </div>
                                <div class="clear"></div>

                            </div>
                        </article>
                    <?php endwhile;
                }
                wp_reset_postdata();
                unset($my_query);

                ?>


            </div>
        </div>
    </div>
<?php endif; ?>


