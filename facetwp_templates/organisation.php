<div class="material-grid-layout" data-cards="boxed">
    <?php while (have_posts()) : the_post(); ?>
        <article class="entry-card">
            <div class="facet-treffer">
                <div class="facet-treffer-content">
                    <a class="search-cover boundless-image" href="<?php echo get_permalink() ?>">
                        <img style="object-fit: scale-down" src=" <?php echo Materialpool_Organisation::get_logo(); ?>"
                             alt="">
                        <span class="ct-ratio" style="padding-bottom: 75%"></span>
                    </a>
                    <div class="autor-content">
                        <h2><a href="<?php echo get_permalink(); ?>"><?php Materialpool_Organisation::title(); ?></a>
                        </h2>
                        <?php
                        $anzahl = Materialpool_Organisation::get_count_posts_per_organisation();

                        if ($anzahl != '' && $anzahl != 0) {
                            echo "Anzahl Materialien: " . $anzahl;
                        }
                        $url = Materialpool_Organisation::get_url();
                        if ('' != $url) {
                            ?>
                            Internet: <a href="<?php echo $url; ?>"><?php echo $url; ?></a>
                            <?php
                        }

                        ?>
                    </div>
                    <div class="ct-ghost"></div>
                </div>
            </div>
        </article>
    <?php endwhile; ?>
</div>
