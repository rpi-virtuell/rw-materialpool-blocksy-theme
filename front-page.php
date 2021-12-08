<?php
/**
 * Template Name: Startseite
 * Template Post Type: page
 *
 * @version 1.0
 *
 */

get_header();
global $post;
?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">



	            <?php

	            $show_title = get_field( 'show_title' );

                if($show_title):

	                $startseite_title = get_field( 'startseite_title' );
	                $startseite_freitext= get_field( 'startseite_freitext' );

	                ?>
                    <div class="startseite-block-header">
                        <p><?php echo $startseite_title; ?></p>
                    </div>
                    <div class="startseite-block-content material-results">
                        <div>
		                <?php echo do_shortcode($startseite_freitext); ?>
                        </div>
                    </div>
                <?php
                endif;
	            $show_aktuell = get_field( 'show_aktuell' );
	            if ( $show_aktuell == 1 ) {
		            ?>
                <div class="startseite-block-header">
                    <p><?php
	                    $startseite_aktuell_titel = get_field( 'startseite_aktuell_titel' );
	                    echo do_shortcode( $startseite_aktuell_titel );
	                    ?></p>
                    <div class="startseite-block-content material-results">
                        <div class="facetwp-template" data-name="startseite_aktuell">
                        <?php
                        $startseite_aktuell = get_field( 'startseite_aktuell' );
		                if ( $startseite_aktuell !== null && $startseite_aktuell != '' ) {
			                $IDlistArr = array();
			                foreach ( $startseite_aktuell as $entry ) {
				                $IDlistArr[] = $entry->ID;
			                }

			                $args     = array(
				                'post__in' => $IDlistArr,
				                'post_type' => array( 'material' ),
			                );
			                $my_query = new WP_Query( $args );
			                while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                                <div class="facet-treffer<?php echo ( Materialpool_Material::is_alpika() ) ? ' alpika' : ''; ?><?php echo ( Materialpool_Material::is_special() ) ? ' special' : ''; ?>">
                                    <div class="facet-treffer-content">
						                <?php if ( Materialpool_Material::cover_facet_html() ): ?>
                                            <div class="material-cover">
								                <?php echo Materialpool_Material::cover_facet_html(); ?>
                                            </div>
						                <?php endif; ?>
                                        <p class="material-title"><a
                                                    href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                        <p class="search-description">
							                <?php Materialpool_Material::shortdescription(); ?><br>
							                <?php //echo wp_trim_words(  wp_strip_all_tags ( Materialpool_Material::get_description() )) ; ?>
                                        </p>
                                        <p class="search-head">
							                <?php if ( Materialpool_Material::get_organisation() ) {
								                echo Materialpool_Material::organisation_facet_html() . '<br>';
							                }
							                if ( Materialpool_Material::get_autor() ) {
								                echo Materialpool_Material::autor_facet_html();
							                }
							                ?>
                                        </p>
                                    </div>
                                    <div class="clear"></div>

                                </div>
			                <?php endwhile;
			                wp_reset_postdata();
			                unset( $my_query );
		                }
                        $startseite_aktuell = get_field( 'startseite_themen');

                        if ( $startseite_aktuell !== null && !empty($startseite_aktuell)) {
                            $IDlistArr = array();
                            foreach ( $startseite_aktuell as $entry ) {
                                $IDlistArr[] = $entry->ID;
                            }
                            $args = array(
                                'post__in'                      => $IDlistArr ,
                                'post_type'              => array( 'themenseite' ),
                            );
                            $my_query = new WP_Query( $args );
                            while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                                <div class="facet-treffer>">
                                    <div class="facet-treffer-content">
                                            <div class="material-cover">
                                                <img src="<?php echo catch_thema_image() ?>">
                                            </div>
                                        <p class="material-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                        <p class="search-description">
                                            <?php the_excerpt(); ?>
                                        </p>
                                    </div><div class="clear"></div>
                                </div>
                            <?php endwhile;
                            wp_reset_postdata();
                        }
	                    ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
	            <?php
	            }




	            ?>
	            <?php
	            $show_neu = get_field( 'show_neu' );
	            if ( $show_neu == 1 ) {
		            ?>
                <div class="startseite-block-header">
                    <P><?php
	                    $startseite_neu_titel = get_field( 'startseite_neu_titel' );
	                    echo do_shortcode( $startseite_neu_titel );
	                    ?></P>
                    <div class="startseite-block-content  material-results">
                       <?php echo facetwp_display( 'template', 'startseite_neue_materialien' ); ?>
                    </div>
                </div>
                <div class="clear"></div>
	            <?php
	            }
	            ?>
	            <?php


	            $show_themenseiten = get_field( 'show_themenseiten' );
                if ( $show_themenseiten  ) {
		            ?>
                    <div class="startseite-block-header">
                        <P><?php
		                    $show_themenseiten_titel = get_field( 'startseite_themenseiten_titel' );
		                    echo do_shortcode( $show_themenseiten_titel );
		                    ?></P>

                        <div class="startseite-block-content">
			                <?php
			                echo rw_material_get_themenliste();
				############################
				die('end');
				########################

			                ?>
                        </div>
                    </div>

                    <div class="clear"></div>


		            <?php
	            }
	            ?>



	            <?php
	            $show_oer = get_field( 'show_oer');
	            if ( $show_oer == 1 ) {
		            ?>
                <div class="startseite-block-header">
                    <P><?php
                        $startseite_oer_titel = get_field( 'startseite_oer_titel' );
	                    echo do_shortcode( $startseite_oer_titel );
	                    ?></P>
                    <div class="startseite-block-content  material-results">
                        <?php echo facetwp_display( 'template', 'startseite_oer' ); ?>
                    </div>
                </div>
                <div class="clear"></div>
	            <?php
	            }
	            ?>
	            <?php
	            $show_special = get_field( 'show_special' );
	            if ( $show_special == 1 ) {
		            ?>
                <div class="startseite-block-header">
                    <p><?php
	                    $startseite_special_titel = get_field( 'startseite_special_titel' );
	                    echo do_shortcode( $startseite_special_titel );
	                    ?></p>
                    <div class="startseite-block-content material-results">
                        <?php echo facetwp_display( 'template', 'startseite_specials' ); ?>
                    </div>
                </div>
                <div class="clear"></div>
	            <?php
	            }
	            ?>
	            <?php
	            $show_about = get_field( 'show_about' );
	            if ( $show_about == 1 ) {
		            ?>
                <div class="startseite-block-header">
                    <p><?php
	                    $startseite_about_titel = get_field( 'startseite_about_titel' );
	                    echo do_shortcode( $startseite_about_titel );
	                    ?></p>
                    <div class="startseite-block-content">
                        <?php
                        $about = get_field( 'startseite_about' );
                        echo do_shortcode( $about );
                        ?>
                    </div>
                </div>
                <div class="clear"></div>
	            <?php
	            }


                if(false):
                ?>
                <div class="startseite-block-header">
                    <p><?php
			            $show_themenseiten_titel = get_field( 'startseite_themenseiten_titel' );
			            echo do_shortcode( $show_themenseiten_titel );
			            ?></p>
                    <div class="startseite-block-content  material-results">
                        <div class="facetwp-template" data-name="startseite_aktuell">
				            <?php
				            $args = array(
					            'posts_per_page' => 3,
					            'post_type'              => array( 'themenseite' ),
				            );
				            $my_query = new WP_Query( $args );
				            while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
                                <div class="facet-treffer>">
                                    <div class="facet-treffer-content">
                                        <div class="material-cover">
                                            <img src="<?php echo catch_thema_image() ?>">
                                        </div>
                                        <p class="material-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                        <p class="search-description">
								            <?php the_excerpt(); ?>
                                        </p>
                                    </div><div class="clear"></div>
                                </div>

				            <?php endwhile;
				            wp_reset_postdata();
				            ?>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <?php endif;?>

            </main><!-- #main -->
        </div><!-- #primary -->
        <div id="secondary" style="display: none"></div>
    </div><!-- .wrap -->

<?php get_footer();
