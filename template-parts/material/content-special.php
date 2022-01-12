<?php
/**
 * Material-Detail-Content 2-spaltig mit Medienviewer
 * User: Joachim, Daniel Reintanz
 * Date: 21.01.2017
 * Time: 07:34
 */
?>

<?php if (Materialpool_Material::is_viewer()): ?>
    <div class="material-detail-content-viewer material-column">
        <?php echo do_shortcode('[viewerjs "' . Materialpool_Material::get_url() . '" ]'); ?>
    </div>
<?php elseif (Materialpool_Material::is_special()): ?>
    <div class="material-detail-image">
        <?php echo Materialpool_Material::cover_facet_html_noallign(); ?>
        <?php
        if (Materialpool_Material::get_picture_source() != '') {
            echo "Bildquelle: " . Materialpool_Material::get_picture_source();
        }
        ?>
    </div>
<?php else: ?>
    <div class="material-detail-content-viewer material-column">
        <?php echo wp_oembed_get(Materialpool_Material::get_url(), array('width' => '9000', 'height' => '500')); ?>
        <p class="viewerjsurlmeta">Quelle: <span
                    class="viewerjsurl"><?php echo Materialpool_Material::get_url(); ?></span></p>
    </div>
<?php endif; ?>
