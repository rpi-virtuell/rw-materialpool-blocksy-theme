<?php
/**
 * Zeigt auf der Material-Detailseite die rechte Spalte
 * User: Joachim
 * Date: 20.01.2017
 * Time: 22:44
 */
?>
<?php if (Materialpool_Material::is_special()): ?>
    <div class="materialpool-special-logo">Dossier<br>
    </div>
    <div class="clear"></div>
<?php endif; ?>

<div style="float: right;">
        <span id="themenseitenedit_<?php echo $post->ID; ?>" data-materialid="<?php echo $post->ID; ?>"
              data-materialtitel="<?php echo $post->post_title; ?>"
              data-materialurl="<?php echo get_permalink($post->ID); ?>" class="themenseitenedit btn-neutral"><i
                    class="fas fa-ellipsis-v"> </i></span>
</div>
<div style="clear: both;"></div>
<table class="material-meta-table">
    <?php if (Materialpool_Material::has_organisation()) { ?>
        <tr>
            <td colspan="2">
                <p class="meta-table-caption">
                    Herkunft des Materials
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <?php Materialpool_Material::organisation_html_cover(); ?>
                <?php $o = Materialpool_Material::get_organisation(); ?>
                <?php if (isset($o[0]['ID']))
                    $oid = Materialpool_Organisation::get_top_orga_id($o[0]['ID']);
                else
                    $oid = false;
                ?>
                <?php if ($oid !== false) { ?>
                    <div class="organisation-top-orga">
                        Diese Seite ist Teil von:<br>
                        <?php Materialpool_Organisation::top_orga_html($oid); ?><br>
                    </div>
                <?php }
                if ('material' === get_post_type()) :
                    if (is_single()) { ?>
                        <div class="materialpool-template-material-organisation">
                            <a href="<?php Materialpool_Material::url(); ?>">
                                <?php Materialpool_Material::url_shorten(); ?>
                            </a>
                        </div>
                        <?php
                    }
                endif; ?>
            </td>
        </tr>
    <?php } ?>
    <?php if (!empty(Materialpool_Material::get_autor())) { ?>
        <tr>
            <td>
                <p>
                    <img class="taxonomy-icon"
                         src="<?php echo get_stylesheet_directory_uri() . "/assets/003-user.svg" ?> "
                         alt="">
                    Autor
                </p>
            </td>
            <td>
                <?php Materialpool_Material::autor_html_picture(); ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="2">
            <p class="meta-table-caption">
                Eigenschaften
            </p>
        </td>
    </tr>
    <?php if (Materialpool_Material::bildungsstufen()) { ?>
        <tr>
            <td>
                <p>
                    <img class="taxonomy-icon"
                         src="<?php echo get_stylesheet_directory_uri() . "/assets/007-volume.svg" ?>  "
                         alt="">
                    Bildungsstufen
                </p>
            </td>
            <td>
                <?php echo Materialpool_Material::bildungsstufen(); ?>
                <?php if (Materialpool_Material::inklusion_facet_html() != '') : ?>
                    , inklusiver Unterricht.
                <?php endif; ?>
            </td>
        </tr>
    <?php } ?>
    <?php if (!empty(Materialpool_Material::get_medientypen())) { ?>
        <tr>
            <td>
                <p>
                    <img class="taxonomy-icon"
                         src="<?php echo get_stylesheet_directory_uri() . "/assets/009-package.svg" ?> "
                         alt="">
                    Medientypen
                </p>
            </td>
            <td>
                <?php echo Materialpool_Material::get_medientypen(); ?>
            </td>
        </tr>
    <?php } ?>
    <?php if (!empty(Materialpool_Material::get_schlagworte_html())) { ?>
        <tr>
            <td>
                <p>
                    <img class="taxonomy-icon"
                         src="<?php echo get_stylesheet_directory_uri() . "/assets/001-price-tag.svg" ?> "
                         alt="">
                    Schlagworte
                </p>
            </td>
            <td>
                <?php echo Materialpool_Material::get_schlagworte_html(); ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td>
            <p>
                Bewertungen
            </p>
        </td>
        <td>
            <?php if (function_exists('the_ratings')) {
                the_ratings();
            } ?>
        </td>
    </tr>
    <?php if (!Materialpool_Material::is_special() && (Materialpool_Material::get_availability() != '' || Materialpool_Material::get_lizenz() != '')): ?>
        <tr>
            <td>
                <p>
                    Verfügbarkeit
                </p>
            </td>
            <td>
                <div class="material-meta-content-entry">
                    <?php if (Materialpool_Material::get_lizenz() != ''): ?>
                        <?php Materialpool_Material::lizenz(); ?>
                    <?php endif; ?>
                    <?php if (Materialpool_Material::get_availability() != ''): ?>
                        <?php Materialpool_Material::availability(); ?>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php endif; ?>
    <?php if (!Materialpool_Material::is_special() && Materialpool_Material::get_werkzeuge() != ''): ?>
        <tr>
            <td>
                <p>
                    Erstellt mit
                </p>
            </td>
            <td>
                <div class="material-meta-content-entry">
                    <?php Materialpool_Material::werkzeuge_html(); ?>
                </div>
            </td>
        </tr>
    <?php endif; ?>
    <?php if (Materialpool_Material::is_part_of_werk()) { ?>
        <tr>
            <td colspan="2">
                <p class="meta-table-caption">
                    Sammlung
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="material-detail-parent material-links">
                    <a href="<?php echo get_permalink(Materialpool_Material::get_werk_id()); ?>">
                        <?php echo Materialpool_Material::cover_facet_html_noallign(Materialpool_Material::get_werk_id()) ?>
                    </a>
                    <p class="meta-table-caption">
                        <?php Materialpool_Material::werk_html(); ?>
                    </p>
                </div>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <td colspan="2">
            <p class="meta-table-caption">
                Materialticker
            </p>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div class="material-meta-content-entry">
                Melden Sie sich zum <a href="https://material.rpi-virtuell.de/materialticker/">materialticker</a> an und
                erhalten Sie mehrmals wöchentlich die aktuellen Materialpooleinträge zugeschickt.
                <br>
                <img src="<?php echo get_stylesheet_directory_uri() . '/assets/materialticker.png'; ?>">
            </div>
        </td>
    </tr>
</table>
