<?php while (have_posts()): the_post(); ?>
    <div class="themenseite-entry">
        <div class="themenseite-image">
            <img src="<?php echo catch_thema_image() ?>">
        </div>
        <div class="thema-description">
            <h2 class="thema-title"><a href="<?php the_permalink(); ?>"><?php $title = get_the_title();
                    $title = str_replace('Themenseite ', '', $title);
                    echo $title; ?></a></h2>
            <p class="thema-excerpt">
                <?php the_excerpt(); ?>
            </p>
        </div>
        <div class="clear"></div>
    </div>
<?php endwhile; ?>