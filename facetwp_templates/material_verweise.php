<?php while (have_posts()) : the_post(); ?>
    <div class="facet-treffer">
        <div class="facet-treffer-mediatyps">
            <ul>
                <?php $type = Materialpool_Material::get_mediatyps_root();
                foreach ($type as $val) {
                    ?>
                    <li>
                    <span title="<?php echo $val['name']; ?>" class="fa-stack fa-2x">
                        <i class="fa fa-circle fa-stack-2x" style="color: <?php echo $val['farbe']; ?>"></i>
                        <i class="fa <?php echo $val['icon']; ?> fa-stack-1x icon-weiss"></i>
                    </span>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <div class="facet-treffer-content">
            <strong><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></strong>
            <p class="search-description">
                <?php Materialpool_Material::shortdescription(); ?><br>
                <?php if (Materialpool_Material::get_bildungsstufen()): ?>
                    Für <?php echo Materialpool_Material::get_bildungsstufen(); ?>
                <?php endif; ?>
            </p>
        </div>
        <div class="clear"></div>
    </div>
<?php endwhile; ?>