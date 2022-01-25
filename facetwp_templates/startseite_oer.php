<div class="material-grid-layout"  data-cards="boxed">
    <?php
    while (have_posts()) : the_post(); ?>
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

                    <a class="search-cover boundless-image" href="<?php the_permalink(); ?>" tabindex="-1">
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



