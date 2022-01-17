<header class="author-header">

        <div class="detail-autor-header">
            <div class="autor-cover">
                <div class="detail-autor-image">
                    <img src=" <?php echo Materialpool_Autor::get_picture(); ?>"
                         onerror=this.src="<?php echo get_stylesheet_directory_uri() . '/assets/Portrait_placeholder.png' ?>"><br>
                    <div class="autor-image" style="margin-right: 0">
						<?php if (Materialpool_Autor::get_picture() != '') {
							?> <a href=' <?php echo Materialpool_Autor::get_picture() ?>'> Bildquelle </a>
						<?php } ?>
                    </div>
                    <div class="autor-name" style="text-align: center">
                        <h4>
							<?php Materialpool_Autor::firstname();
							echo " ";
							Materialpool_Autor::lastname(); ?>
                        </h4>
                    </div>
                </div>
                <div class="autor-detail-info-button info-button">
                    <button type="button">
                        i
                    </button>
                </div>
            </div>
            <div class="detail-autor-header-detail detail-info">
                <div class="detail-autor-header-aoe">
                    <h4>Wirkungsbereich</h4>
					<?php if (Materialpool_Autor::has_organisationen()): ?>
                        <div class="detail-autor-organisation">
							<?php Materialpool_Autor::organisation_html_cover(); ?>
                        </div>
					<?php endif; ?>
                    <div class="material-detail-buttons material-column">
                        <a class="cta-button" href="<?php Materialpool_Autor::url(); ?>">Webseite</a>
                    </div>
                    <div class="material-detail-buttons material-column">
						<?php Materialpool_Autor::autor_request_button(); ?>
                    </div>
                    <div class="material-detail-buttons material-column">
						<?php Materialpool_Autor::autor_request_button2(); ?>
                    </div>
                </div>
                <div class="detail-autor-header-material-info">

                    <h4>Auszeichnungen</h4>
                    <div class="detail-autor-header-meta">
						<?php echo "Anzahl der Materialien: " . Materialpool_Autor::get_count_posts_per_autor() . "</br>" ?>
						<?php echo "Material Aufrufe insgesamt: " . Materialpool_Autor::get_post_views_per_autor() . "</br>" ?>
                    </div>

					<?php if (($n = Materialpool_Autor::get_count_posts_per_autor()) > 4) { ?>
                        <div class="detail-autor-badge">
							<?php
							if ($n >= 5) {
								$badgeclass = 'grau';
								$badgetitle = 'mindestens <br>5 Beiträge';
							}
							if ($n >= 20) {
								$badgeclass = 'gruen';
								$badgetitle = '<b>über 20</b><br>Praxisbeiträge';
							}
							if ($n > 100) {
								$badgeclass = 'gold';
								$badgetitle = '<b>über 100</b><br>Praxisbeiträge';
							}
							?>
                            <div class="author-badge <?php echo $badgeclass; ?>">
								<?php echo $badgetitle; ?><br>
                                im Materialpool
                            </div>
                        </div>

					<?php } ?>
                </div>
            </div>
        </div>
</header>
