<?php
/**
 * Zeigt auf der Material-Detailseite die rechte Spalte
 * User: Joachim
 * Date: 20.01.2017
 * Time: 22:44
 */
?>
<table class="material-meta-table">
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
    <?php if (!Materialpool_Material::is_special() && Materialpool_Material::get_lizenz() != '') { ?>
        <tr>
            <td>
                <p>
                    <img class="taxonomy-icon"
                         src="<?php echo get_stylesheet_directory_uri() . "/assets/008-open-source.svg" ?> "
                         alt="">
                    Lizenz
                </p>
            </td>
            <td>
                <div class="material-meta-content-entry">
                    <?php if (Materialpool_Material::get_lizenz() != ''):
                        Materialpool_Material::lizenz();
                    endif; ?>
                </div>
            </td>
        </tr>
    <?php } ?>
    <?php if (!Materialpool_Material::is_special() && Materialpool_Material::get_availability() != '') { ?>
        <tr>
            <td>
                <p>
                    <?php if (Materialpool_Material::get_availability() == 'kostenpflichtig') { ?>
                        <img class="taxonomy-icon"
                             src="<?php echo get_stylesheet_directory_uri() . "/assets/013-padlock.svg" ?> "
                             alt="">
                    <?php } else { ?>
                        <img class="taxonomy-icon"
                             src="<?php echo get_stylesheet_directory_uri() . "/assets/014-unlock.svg" ?> "
                             alt="">
                    <?php } ?>
                    Verfügbarkeit
                </p>
            </td>
            <td>
                <div class="material-meta-content-entry">
                    <?php if (Materialpool_Material::get_availability() != ''): ?>
                        <?php Materialpool_Material::availability(); ?>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
    <?php } ?>
    <?php if (!Materialpool_Material::is_special() && !empty(Materialpool_Material::get_werkzeuge())) { ?>
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
    <?php } ?>
</table>