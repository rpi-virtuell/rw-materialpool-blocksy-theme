<div class="material-grid-layout" data-cards="boxed">
    <?php while (have_posts()) : the_post(); ?>
        <div class="entry-content autor facet-treffer">
            <div class="autor-content autor-archiv">

                <div class="author-picture">
                    <a href="<?php get_permalink($id); ?>">
                        <?php if (!empty(Materialpool_Autor::get_picture())) { ?>
                            <img src="<?php echo Materialpool_Autor::get_picture(); ?>"
                                 onError="this.onerror = null; this.src=' <?php echo get_stylesheet_directory_uri() . "/assets/Portrait_placeholder.png" ?>'">
                        <?php } ?>
                    </a>
                </div>
                <div class="author-info">
                    <h2>
                        <a href="<?php echo get_permalink($id); ?>">
                            <?php Materialpool_Autor::firstname();
                            echo " ";
                            Materialpool_Autor::lastname(); ?></a>
                    </h2>
                    <?php

                    $anzahl = Materialpool_Autor::get_count_posts_per_autor();
                    if ($anzahl != '' && $anzahl != 0) {
                        echo "Anzahl der Beiträge im Materialpool: " . $anzahl . "<br>";
                    }
                    ?>

                    <div class="taxonomien">
                        <?php
                        $url = Materialpool_Autor::get_url();
                        if ('' != $url) {
                            ?>
                            <a href="<?php echo $url; ?>">Internet</a>
                        <?php } ?>

                        <div class="organisation">
                            <?php
                            $data = '';
                            $organisationen = Materialpool_Autor::get_organisationen();

                            if (is_array($organisationen) && $organisationen != false) {

                                ?>
                                <img class="taxonomy-icon"
                                     src="<?php echo get_stylesheet_directory_uri() . "/assets/006-institution.svg" ?> "
                                     alt="">
                                <?php
                                foreach ($organisationen as $organisation) {
                                    $url = get_permalink($organisation);
                                    $post = get_post($organisation);
                                    if ($data != '') $data .= ', ';
                                    $data .= '<a href="' . $url . '" class="' . apply_filters('materialpool-template-material-volumes', 'materialpool-template-material-volumes') . '">' . $post->post_title . '</a>';
                                }
                                echo $data;
                            }
                            ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
