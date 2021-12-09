<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}


include_once "inc/themeCore.php";



add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('old-styles', get_stylesheet_directory_uri().'/old-style.css');
	wp_enqueue_style('theme-styles', get_stylesheet_directory_uri().'/style.css');
});



/**
* Ausgabe der Themensliste auf der Startseie
*/
function rw_material_get_themenliste(){

	$links =[];

	$args = array(
		"post_type" => "themenseite",
		"post_status" => "publish",
		"orderby" => "title",
		"order" => "ASC",
		"posts_per_page" => 1000,
	);
	$themen = get_posts($args);

	foreach ($themen as $thema){

		$pattern = '<a class="button" href="%s">%s</a>';
		$link = sprintf($pattern, $thema->guid, $thema->post_title);
		$links[] = $link;

	}

	return implode('<span> · </span>', $links);

}

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
        wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/clipboard.min.js', array (), 1.1, true);
        wp_enqueue_style( 'contextmenu', trailingslashit( get_stylesheet_directory_uri() ) . 'css/jquery.contextMenu.min.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
