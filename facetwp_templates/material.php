<div class="material-grid-layout"<?php if (!isset($my_query)) echo 'data-layout="enhanced-grid"'; ?> data-cards="boxed">
    <?php
    if (!isset($my_query)) {
        while (have_posts()) : the_post();
            include get_stylesheet_directory() . "/facetwp_templates/material_loop_content.php";
        endwhile;
    } else {
        while ($my_query->have_posts()) : $my_query->the_post();
            include get_stylesheet_directory() . "/facetwp_templates/material_loop_content.php";
        endwhile;
    }
    unset($my_query);
    wp_reset_query();
    ?>
</div>

