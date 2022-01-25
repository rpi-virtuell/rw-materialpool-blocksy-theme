<?php
get_header();
?>
<header class="author-header">

    <div class="detail-autor-header">
        <div class="autor-cover">
            <div class="autor-cover-container">
            <img src=" <?php echo Materialpool_Autor::get_picture(); ?>"
                 onerror=this.src="<?php echo get_stylesheet_directory_uri() . '/assets/Portrait_placeholder.png' ?>"><br>

            <?php if (Materialpool_Autor::get_picture() != '') {
                ?> <a class="material-picture-source" href=' <?php echo Materialpool_Autor::get_picture() ?>'> Bildquelle </a>
            <?php } ?>
            </div>
        </div>
        <div class="autor-name">
            <h4>
                <?php Materialpool_Autor::firstname();
                echo " ";
                Materialpool_Autor::lastname(); ?>
                <?php if (($n = Materialpool_Autor::get_count_posts_per_autor()) > 4) { ?>
                    <?php
                    if ($n >= 5) {
                        $badgeicon = '010-badge';
                        $badgeclass = 'grau';
                        $badgetitle = 'mindestens <br>5 Beiträge';
                    }
                    if ($n >= 20) {
                        $badgeicon = '011-badge-1';
                        $badgeclass = 'gruen';
                        $badgetitle = '<b>über 20</b><br>Praxisbeiträge';
                    }
                    if ($n > 100) {
                        $badgeicon = '012-trophy';
                        $badgeclass = 'gold';
                        $badgetitle = '<b>über 100</b><br>Praxisbeiträge';
                    }
                    ?>
                    <div class="tooltip tooltip-badge">
                        <img class="autor-award"
                             src="<?php echo get_stylesheet_directory_uri() . "/assets/" . $badgeicon . ".svg" ?> "
                             alt="">
                        <span class="tooltiptext">
                        <div class="detail-autor-badge">
                            <div class="author-badge <?php echo $badgeclass; ?>">
								<?php echo $badgetitle; ?><br>
                                im Materialpool
                            </div>
                        </div>
                            </span>
                    </div>
                <?php } ?>
            </h4>
            <div class="detail-autor-meta mobile">
                <?php echo "Anzahl der Materialien: " . Materialpool_Autor::get_count_posts_per_autor() . " " ?>
                <?php echo "Material Aufrufe insgesamt: " . Materialpool_Autor::get_post_views_per_autor() ?>
            </div>
        </div>
        <?php if (Materialpool_Autor::has_organisationen()): ?>
            <div class="detail-autor-organisation">
                <?php Materialpool_Autor::organisation_html_cover(); ?>
            </div>
        <?php endif; ?>
        <div class="autor-header-tabs">
            <?php if (Materialpool_Autor::has_organisationen()): ?>
                <button id="organisation-button" type="button" class="header-tab"> Wirkungsbereich</button>
            <?php endif; ?>
            <?php if (!empty(Materialpool_Autor::get_url())) ?>
            <button class="header-tab" onclick="window.location.href = '<?php Materialpool_Autor::url(); ?>';">
                Webseite
            </button>
            <div class="detail-autor-meta desktop">
                <?php echo "| " . "Anzahl der Materialien: " . Materialpool_Autor::get_count_posts_per_autor() . " | " ?>
                <?php echo "Material Aufrufe insgesamt: " . Materialpool_Autor::get_post_views_per_autor() . " |"?>
            </div>
        </div>
    </div>
</header>

<script>
    jQuery('#organisation-button').on('click', function () {
        jQuery('.detail-autor-organisation').slideToggle(1000);
        jQuery('#organisation-button').toggleClass("active");
    })
</script>
