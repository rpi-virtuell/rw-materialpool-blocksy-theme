<?php
/**
 * Zeigt Verweise und Werk(parent) / Band(child) Verknüpfungen zu einem Material unterhalb des des eigentlichen Inhalts
 * User: Joachim
 * Date: 11.01.2021
 * Time: 07:34
 */
?>
<div style="height:30px; width:100px;"></div>
<?php if ( Materialpool_Material::is_part_of_werk() ) : ?>
    <div class="material-detail-parent material-links">
        <h3>Dieses Material ist aus der Sammlung:</h3>
        <strong><?php Materialpool_Material::werk_html( true ); ?></strong>
        <ul><?php Materialpool_Material::sibling_volumes_html(true); ?></ul>
    </div>
<?php endif; ?>

<?php if ( Materialpool_Material::is_werk() ) : ?>
    <div class="material-detail-children material-links home">
        <h3>Zu "<?php the_title( '<b>', '</b>' );?>" gehören weitere Materialien:</h3>

        <div class="startseite-block-content material-results">
            <div class="facetwp-template">
			    <?php
			    $ar = Materialpool_Material::volumes_ids();
			    global $post;
			    if ( $ar === false ) return;
			    $args = array(
				    'post__in'                      => $ar,
				    'post_type'              => array( 'material' ),
				    'posts_per_page'        => 100,
					'orderby' => 'post_title',
					'order'   => 'ASC',
			    );
			    $my_query = new WP_Query( $args );
			    while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                <div class="facet-treffer<?php echo (Materialpool_Material::is_alpika())?' alpika':'';?><?php echo (Materialpool_Material::is_special())?' special':'';?>">
                    <div class="facet-treffer-content">
					    <?php if (Materialpool_Material::cover_facet_html()  && !in_array(strrchr(Materialpool_Material::get_url(),'.'),array('.docx','.doc','.odt')) ):?>
                            <div class="material-cover">
							    <?php echo  Materialpool_Material::cover_facet_html(); ?>
                            </div>
					    <?php endif; ?>
                        <p class="material-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                        <p class="search-description">
						    <?php Materialpool_Material::shortdescription(); ?><br>
						    <?php //echo wp_trim_words(  wp_strip_all_tags ( Materialpool_Material::get_description() )) ; ?>
                        </p>
                        <p class="search-head">
						    <?php if(Materialpool_Material::get_organisation()[0]){
							    echo Materialpool_Material::organisation_facet_html().'<br>';
						    }
						    if(Materialpool_Material::get_autor()) {
							    echo Materialpool_Material::autor_facet_html();
						    }
						    ?>
                        </p>
                    </div><div class="clear"></div>

                </div>
                <?php endwhile;
	                    wp_reset_postdata();
	                    unset( $my_query);

	                    ?>


            </div>
        </div>
    </div>

<?php endif; ?>
