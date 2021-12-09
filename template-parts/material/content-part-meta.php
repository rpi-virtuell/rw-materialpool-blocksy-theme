<?php
/**
 * Zeigt auf der Material-Detailseite die rechte Spalte
 * User: Joachim
 * Date: 20.01.2017
 * Time: 22:44
 */
?>
<?php if(Materialpool_Material::is_special()):?>
    <div class="materialpool-special-logo">Dossier<br>
    </div>
    <div class="clear"></div>
<?php endif;?>

<div class="facet-treffer-mediatyps material-meta">
    <?php $type = Materialpool_Material::get_mediatyps_root();
    foreach ( $type as $val ) {
        ?>

        <span title="<?php echo $val[ 'name' ]; ?>" class="fa-stack fa-2x">
            <i  class="fa fa-circle fa-stack-2x" style="color: <?php echo $val[ 'farbe' ]; ?>"></i>
            <i class="fa <?php echo $val[ 'icon' ]; ?> fa-stack-1x icon-weiss"></i>
        </span>

    <?php } ?>
    <div style="float: right;">
        <span id="themenseitenedit_<?php echo $post->ID; ?>" data-materialid="<?php echo $post->ID; ?>" data-materialtitel="<?php echo $post->post_title; ?>" data-materialurl="<?php echo get_permalink( $post->ID) ; ?>"class="themenseitenedit btn-neutral"><i class="fas fa-ellipsis-v"> </i></span>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="material-detail-meta-rating material-meta">
    <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
</div>
<div class="material-meta" style="clear: both;height:10px;"></div>

<div class="material-detail-meta-author material-meta">
    <?php if(Materialpool_Material::has_organisation() || Materialpool_Material::has_autor() ): ?>
        <h4>Herkunft des Materials</h4>
        <div class="material-meta-content-entry">

        <?php if(Materialpool_Material::has_organisation()): ?>
            <?php Materialpool_Material::organisation_html_cover(); ?>
            <?php $o = Materialpool_Material::get_organisation(); ?>
            <?php if(isset($o[ 0 ][ 'ID' ]))
                $oid = Materialpool_Organisation::get_top_orga_id( $o[ 0 ][ 'ID' ] );
            else
	            $oid = false;
            ?>
            <?php if ( $oid !== false ) { ?>
                <div class="organisation-top-orga" >
                    Diese Seite ist Teil von:<br>
			        <?php Materialpool_Organisation::top_orga_html( $oid ); ?><br>
                </div>
	        <?php } ?>
        <?php endif;?>
        <?php if( Materialpool_Material::has_autor() ):?>
            <?php Materialpool_Material::autor_html_picture(); ?>
        <?php endif;?>
        </div>
    <?php endif;?>

</div>

<div class="material-detail-bildungsstufe material-meta">
    <?php if (Materialpool_Material::bildungsstufen()):?>
        <h4>Bildungskontext</h4>
        <div class="material-meta-content-entry">
            <div>
                <?php echo Materialpool_Material::bildungsstufen();?>
                <?php if ( Materialpool_Material::inklusion_facet_html() != '' ) :?>
                , inklusiver Unterricht.
                <?php endif;?>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php if(!Materialpool_Material::is_special() && ( Materialpool_Material::get_availability() != '' || Materialpool_Material::get_lizenz() != '' )): ?>
    <div class="material-detail-meta-access material-meta">
        <h4>Verfügbarkeit</h4>
        <div class="material-meta-content-entry">
	        <?php if(  Materialpool_Material::get_lizenz() != '' ): ?>
                <?php Materialpool_Material::lizenz(); ?>
	        <?php endif;?>
	        <?php if( Materialpool_Material::get_availability() != ''): ?>
		        <?php Materialpool_Material::availability(); ?>
	        <?php endif;?>
        </div>
    </div>
<?php endif;?>
<?php if(!Materialpool_Material::is_special() && Materialpool_Material::get_werkzeuge() != ''): ?>
    <div class="material-detail-meta-access material-meta">
        <h4>Erstellt mit</h4>
        <div class="material-meta-content-entry">
			<?php Materialpool_Material::werkzeuge_html(); ?>
        </div>
    </div>
<?php endif;?>


<div class="material-meta" style="clear: both;height:10px;"></div>
<div class="material-detail-meta-ticker material-meta">
    <h4>Materialticker</h4>
    <div class="material-meta-content-entry">
Melden Sie sich zum <a href="https://material.rpi-virtuell.de/materialticker/">materialticker</a> an und erhalten Sie mehrmals wöchentlich die aktuellen Materialpooleinträge zugeschickt.
<br>
    <img src="<?php echo get_stylesheet_directory_uri() . '/assets/materialticker.png'; ?>">
</div>
</div>
