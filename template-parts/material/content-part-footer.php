<?php
/**
 * Zeigt auf der Material-Detailseite den Detailfußbereich mit Bildungsstufe und Schlagworten
 * User: Joachim
 * Date: 21.01.2017
 * Time: 08:12
 */
?>
<div class="material-detail-schlagworte material-footer">
    Schlagworte: <?php echo Materialpool_Material::get_schlagworte_html( "/facettierte-suche/"); ?>
    <?php if ( Materialpool_Material::get_jahr() != '' && Materialpool_Material::get_jahr() != 0   ) :?>
        , <a href="/facettierte-suche/?fwp_erscheinungsjahr=<?php echo Materialpool_Material::get_jahr(); ?>"><?php echo Materialpool_Material::get_jahr(); ?></a>
    <?php endif; ?>
	<?php if ( Materialpool_Material::get_inklusion() != '' ) :?>
        , <a href="/facettierte-suche/?fwp_inklusion=inclusive"><?php echo Materialpool_Material::get_inklusion(); ?></a>
	<?php endif; ?>
</div>