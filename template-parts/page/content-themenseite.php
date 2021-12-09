<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php twentyseventeen_edit_link( get_the_ID() ); ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
			the_content();
		?>
        <strong>Alphabetische Liste</strong>
        <?php

        $args = array(
	        "post_type" => "themenseite",
	        "post_status" => "publish",
	        "orderby" => "title",
	        "order" => "ASC",
	        "posts_per_page" => 1000,
        );
        $the_query = new WP_Query( $args );
        ?>
		<?php if( $the_query->have_posts() ): ?>
		    <?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <span class="thema-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>

        <h1>Die neusten Themenseiten:</h1>
        <?php

        $args = array(
	        "post_type" => "themenseite",
	        "post_status" => "publish",
	        "orderby" => "date",
	        "order" => "DESC",
	        "posts_per_page" => 10
        );
        $the_query = new WP_Query( $args );
        ?>
		<?php if( $the_query->have_posts() ): ?>
			<?php while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                <div class="themenseite-entry">
                    <div class="themenseite-image">
                        <img src="<?php echo catch_thema_image() ?>">
                    </div>
                    <div class="thema-description">
                        <h2 class="thema-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                        <p class="thema-excerpt">
							<?php the_excerpt(); ?>
                        </p>
                    </div>
                    <div class="clear"></div>
                </div>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>

	</div><!-- .entry-content -->
</article><!-- #post-## -->
