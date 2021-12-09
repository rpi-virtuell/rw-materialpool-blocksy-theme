<?php
/**
 * The Template for displaying all single material
 *
 * This template can be overridden by copying it to yourtheme/materialpool/single-material.php.
 *
 * @since      0.0.1
 * @package    Materialpool
 * @author     Frank Staude <frank@staude.net>
 * @version    0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


get_header( 'materialpool' ); ?>
<section  class="content-area">
    <div id="content" class="site-content" role="main">
        <div class="autor-detail-left">
            <?php Materialpool_Organisation::logo_html(); ?>
            <br>
        </div>
        <div class="material-detail-content">
            <div class="material-detail-header facet-treffer-content">
                <h2><?php Materialpool_Organisation::title(); ?>
                </h2>
                <strong>URL</strong> <?php Materialpool_Organisation::url_html(); ?><br>
                ALPIKA: <?php if ( Materialpool_Organisation::is_alpika() ) { echo 'Ja'; } else { echo "Nein"; } ?><br>
                Konfession: <?php Materialpool_Organisation::konfession(); ?><br>
                <div class="autor-detail-main">
                    <div class="material-detail-middle">
                    <h3>Material der Organisation:</h3><br>
                    <?php  echo do_shortcode( '[facetwp template="material_organisation"]'); ?>
                    </div>
                    <div class="material-detail-right">
                        <?php Materialpool_Organisation::autor_html_picture(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php get_footer( 'materialpool' ); ?>

