<?php
/**
 * Created by PhpStorm.
 * Autor-Detail-Grid
 * User: Joachim, Daniel Reintanz
 * Date: 23.01.2017
 * Time: 17:22
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<article id="autor-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="autor-detail">
        <div class="autor-detail-grid">
            <div class="detail-autor-search">
				<?php
				if ( 'autor' === get_post_type() ) :
					if ( is_single() ) {
						?><h1 class="entry-title">Meine Materialien</h1><?php
					} else {
						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					}

				endif; ?>
                <div class="autor-content" style="margin: 0 15px 0">
                    <div class="material-suche">
						<?php echo facetwp_display( 'facet', 'suche' ); ?>
                        <div class="material-filter-button">
                            <button type="button">
                                <span class="dashicons dashicons-filter"></span>
                                Filter
                            </button>

                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="material-selection">
						<?php echo facetwp_display( 'selections' ); ?>
                    </div>
                    <div class="sidebar">
                        <div class="first-search-facets">
							<?php echo facetwp_display( 'facet', 'bildungsstufe' ); ?>
							<?php echo facetwp_display( 'facet', 'medientyp' ); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="detail-autor-material">
                <div class="autor-content">
                    <div>
                        <div class="material-counter">
							<?php echo facetwp_display( 'counts' ); ?> Treffer
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="material-results">
						<?php echo facetwp_display( 'template', 'material_autor' ); ?></div>

                </div>
            </div>
        </div>
    </div>
</article>
