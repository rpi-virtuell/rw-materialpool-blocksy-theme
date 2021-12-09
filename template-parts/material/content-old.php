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
        if ( 'post' === get_post_type() ) :
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
            <img alt="screenshot" src="http://s.wordpress.com/mshots/v1/<?php echo urlencode(Materialpool_Material::url());?>?w=400%&h=300%" />
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
                <?php echo do_shortcode(apply_filters( 'the_content', Materialpool_Material::get_description())); ?>
            </div>
            <div class="material-detail-description-footer material-desc">
                <?php Materialpool_Material::description_footer(); ?>
            </div>
            <?php  get_template_part('template-parts/material/content-part-links', get_post_format()); ?>
        </div>


        <div class="material-detail-right material-meta-container material-column">
            <div class="facet-treffer-mediatyps material-meta">
                <?php $type = Materialpool_Material::get_mediatyps_root();
                foreach ( $type as $val ) {
                    ?>

                    <span title="<?php echo $val[ 'name' ]; ?>" class="fa-stack fa-2x">
                        <i  class="fa fa-circle fa-stack-2x" style="color: <?php echo $val[ 'farbe' ]; ?>"></i>
                        <i class="fa <?php echo $val[ 'icon' ]; ?> fa-stack-1x icon-weiss"></i>
                    </span><span style="font-size:13px"><?php echo $val[ 'name' ]; ?></span>

                <?php } ?>
            </div>
            <div class="clear"></div>
            <div class="material-detail-meta-rating material-meta">
                <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
            </div>
            <div class="clear">&nbsp;<br>&nbsp;</div>
            <div class="material-detail-meta-author material-meta">
                <h4>Alter Eintrag!</h4>
                <div class="material-meta-content-entry">
                    <span style="font-size:14px">
                        Dieses Material wurde noch nicht überarbeitet und entspricht
                        möglicherweise nicht mehr den qualitativen Anforderungen des neuen Materialpools.
                    </span>
                </div>
                <h4>Herkunft</h4>
                <div class="material-meta-content-entry">
                <?php

                $post_id = get_the_ID();

                $keywords= get_post_meta($post_id, 'material_autor_interim') ;
                if(is_array($keywords)) $keywords = $keywords[0];
                echo str_replace(',', ', ', $keywords) . '<br>';
                $keywords= get_post_meta($post_id, 'material_organisation_interim') ;
                if(is_array($keywords)) $keywords = $keywords[0];
                echo str_replace(' ', ', ' , str_replace(',', ', ', $keywords));

                ?>
                </div>

                <h4>Bildungstufen</h4>
                <div class="material-meta-content-entry">
                    <?php
                        $bildungsstufen = get_post_meta($post_id, 'material_bildungsstufe');
                        foreach ($bildungsstufen as $bs){
                            $bildungsstufe[$bs]=$bs;
                        }
                        foreach ($bildungsstufe as $bs){
                            echo '<span>'.get_term($bs)->name.', </span>';
                        }
                    ?>
                </div>

            </div>
        </div>
        <footer class="material-detail-footer">
            Schlagworte:
            <?php
            $keywords= get_post_meta($post_id, 'material_schlagworte_interim') ;
            if(is_array($keywords)) $keywords = $keywords[0];
            echo str_replace(',', ', ', $keywords);
            ?>
            <?php
            //get_template_part('template-parts/material/content-part-footer', get_post_format()); ?>
        </footer>


    </div>
</article><!-- #post-## -->
