<?php
/**
 * Material-Detail-Content 3-spaltig
 * User: Joachim
 * Date: 21.01.2017
 * Time: 07:34
 */

?>

<article id="material-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		if ( is_sticky() && is_home() ) :
			echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
		endif;
	?>
	<header class="entry-header">
		<?php
			if ( 'material' === get_post_type() ) :
				echo '<div class="entry-meta">';
					if ( is_single() ) {?>
                        <div class="material-detail-url">
                            <a href="<?php Materialpool_Material::url(); ?>">
                                <?php Materialpool_Material::url_shorten(); ?>
                            </a>
                        </div>

                    <?php
                    }else {
                        echo twentyseventeen_time_link();
                        twentyseventeen_edit_link();
                    }
				echo '</div><!-- .entry-meta -->';
			endif;

			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header><!-- .entry-header -->

	<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
			</a>
		</div><!-- .post-thumbnail -->
	<?php endif; ?>

	<div class="entry-content material-detail">

        <div class="material-detail-left material-column">

            <div class="material-detail-image">
            <?php echo  Materialpool_Material::cover_facet_html_noallign(); ?>
            <?php
            if ( Materialpool_Material::get_picture_source() != '' ) {
                if ( Materialpool_Material::get_picture_url() != '') {
	                echo  "Bildquelle: <a href='". Materialpool_Material::get_picture_url() ."'>".Materialpool_Material::get_picture_source()."</a>";
                } else {
	                echo  "Bildquelle: ".Materialpool_Material::get_picture_source();
                }
            } else {
                if ( Materialpool_Material::get_picture_url() != '') {
                    $host = parse_url(Materialpool_Material::get_picture_url() );

                    if ( $host[ 'host' ] )
	                echo  "Bildquelle: <a href='". Materialpool_Material::get_picture_url() ."'>". $host[ 'host' ] ."</a>";
                }
            }
            ?>
            </div>

            <div class="material-detail-buttons">
                <?php echo Materialpool_Material::cta_link(); ?>
                <?php echo Materialpool_Material::cta_url2clipboard(); ?>
            </div>
        </div>
        <div class="material-detail-content material-column">
            <div class="material-detail-shortdescription material-desc">
                <?php Materialpool_Material::shortdescription(); ?>
            </div>
            <div class="material-detail-description material-desc">
                <?php
                $value = apply_filters( 'the_content', Materialpool_Material::get_description());
                $embed = $GLOBALS[ 'wp_embed' ];
                $value = $embed->run_shortcode( $value );
                $value = $embed->autoembed( $value );
                echo do_shortcode( $value );
                ?>
            </div>
            <div class="material-detail-description-footer material-desc">
                <?php Materialpool_Material::get_themenseiten_for_material_html(); ?>
                <?php Materialpool_Material::description_footer(); ?>
                <?php Materialpool_Material::back_to_search(); ?>
            </div>
            <?php  get_template_part('template-parts/material/content-part-links', get_post_format()); ?>
        </div>


        <div class="material-detail-right material-meta-container material-column">
            <?php  get_template_part('template-parts/material/content-part-meta', get_post_format()); ?>
        </div>
        <footer class="material-detail-footer">
            <?php  get_template_part('template-parts/material/content-part-footer', get_post_format()); ?>
        </footer>
        <div class="entry-content material-detail">
			<?php  get_template_part('template-parts/material/content-part-children', get_post_format()); ?>
        </div>

    </div>
</article><!-- #post-## -->
