<?php
get_header();
?>
<header class="organisation-header">
    <div class="detail-organisation-header">
        <div class="organisation-cover">
            <?php if (Materialpool_Organisation::get_logo()) { ?>
                <div class="organisation-cover-container">
                    <a href="<?php echo Materialpool_Organisation::get_url(); ?>">
                        <?php Materialpool_Organisation::logo_html(); ?>
                    </a>
                </div>
            <?php } else { ?>
                <h2 class="image-alt">
                    <?php Materialpool_Organisation::title(); ?>
                </h2>
            <?php } ?>
        </div>
        <div class="organisation-name">
            <h4>
                <?php Materialpool_Organisation::title() ?>
            </h4>
            <div class="detail-autor-meta mobile">
                <?php echo "Anzahl der Materialien: " . Materialpool_Organisation::get_count_posts_per_organisation() . " " ?>
                <?php echo "Material Aufrufe insgesamt: " . Materialpool_Organisation::get_post_views_per_organisation() ?>
            </div>
            <div class="organisation-meta">
                <?php if (Materialpool_Organisation::is_alpika()): ?>
                    <div class="tooltip">Alpika Institut
                        <span class="tooltiptext">
                                <img class="alpika-logo"
                                     src="http://material.rpi-virtuell.de/wp-content/plugins/rw-materialpool//assets/alpika.png">
                                <br>
                                <?php Materialpool_Organisation::title(); ?>
                                        ist Teil der <a href="http://www.relinet.de/alpika.html">Arbeitsgemeinschaft</a>
                                der Pädagogischen Institute und Katechetischen Ämter  in der Evangelischen Kirche in Deutschland.
                            <img class="ekd-logo"
                                 src="https://datenschutz.ekd.de/wp-content/uploads/2015/01/EKD-Logo.png">
                            </span>
                    </div>
                <?php elseif (Materialpool_Organisation::get_konfession() == 'evangelisch'): ?>
                    <b>Evangelische Einrichtung.</b>
                <?php elseif (Materialpool_Organisation::get_konfession() == 'katholisch'): ?>
                    <b>Katholische Einrichtung.</b>
                <?php elseif (Materialpool_Organisation::get_konfession() == 'islamisch'): ?>
                    <b>Islamische Einrichtung.</b>
                <?php endif; ?>
            </div>
        </div>
        <?php if (!empty(Materialpool_Organisation::get_autor())) { ?>
            <div class="organisation-author">
                <?php
                $accordion = '';
                $verweise = Materialpool_Organisation::get_autor();
                $button = count($verweise) > 4;
                $accordion .= '<div class="detail-organisation-author" ';
                if (count($verweise) == 1)
                    $accordion .= 'style = "grid-template-columns: unset" ';
                if (!$button)
                    $accordion .= 'style = "height: auto; overflow: visible"';
                $accordion .= '>';
                if (!empty($verweise) && is_array($verweise)) {
                    foreach ($verweise as $verweis) {
                        if (empty($verweis))
                            continue;
                        $url = get_permalink($verweis);
                        $logo = get_metadata('post', $verweis, 'autor_bild_url', true);
                        $vorname = get_metadata('post', $verweis, 'autor_vorname', true);
                        $nachname = get_metadata('post', $verweis, 'autor_nachname', true);

                        $accordion .= "<div class='detail-herkunft-single-author'>";
                        if (!empty($logo)) {
                            $accordion .= '<a href="' . $url . '" style="background-image:url(\'' . $logo . '\')" class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '"><img  class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '" src="' . $logo . '"></a>';
                        } else {
                            $accordion .= '<a href="' . $url . '" style="background-image:url(\'/wp-content/themes/rw_materialpool-blocksy-theme/assets/Portrait_placeholder.png\')" class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '"><img  class="' . apply_filters('materialpool-template-material-verweise', 'materialpool-template-material-autor-logo') . '" src="../../assets/Portrait_placeholder.png"></a>';
                        }
                        $accordion .= '<div class="detail-herkunft-single-author-name">';
                        $accordion .= '<a href="' . $url . '" class="' . apply_filters('materialpool-template-material-autor', 'materialpool-template-material-autor') . '">' . $vorname . ' ' . $nachname . '</a>';
                        $accordion .= "</div>";
                        $accordion .= "</div>";
                    }
                    $accordion .= "</div>";
                    echo $accordion;
                }
                ?>
            </div>
        <?php } ?>
        <div class="organisation-header-tabs">
            <?php if (!empty(Materialpool_Organisation::get_autor())): ?>
                <button id="autoren-button" type="button" class="header-tab"> Autor:innen</button>
            <?php endif; ?>
            <?php if (!empty(Materialpool_Organisation::get_url())) ?>
            <button class="header-tab"
                    onclick="window.location.href = '<?php Materialpool_Organisation::url() ?>';">
                Webseite
            </button>
            <div class="detail-autor-meta desktop">
                <?php echo "| " . "Anzahl der Materialien: " . Materialpool_Organisation::get_count_posts_per_organisation() . " | " ?>
                <?php echo "Material Aufrufe insgesamt: " . Materialpool_Organisation::get_post_views_per_organisation() . " |"?>
            </div>
        </div>
    </div>
</header>

<script>
    jQuery('#autoren-button').on('click', function () {
        jQuery('.organisation-author').slideToggle(1000);
        jQuery('#autoren-button').toggleClass("active");
    })
</script>