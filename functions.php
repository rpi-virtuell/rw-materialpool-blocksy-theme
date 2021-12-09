<?php
if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}


include_once "inc/themeCore.php";
include_once "inc/pluginSource.php";



add_action( 'wp_enqueue_scripts', function () {
	//stylesheets
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('old-styles', get_stylesheet_directory_uri().'/old-style.css');
	wp_enqueue_style('theme-styles', get_stylesheet_directory_uri().'/style.css');

	wp_enqueue_style( 'contextmenu', trailingslashit( get_stylesheet_directory_uri() ) . 'css/jquery.contextMenu.min.css', array(  ) );
	wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.6.3/css/all.css');

	//javscripts
	//für accordions notwendig
	wp_enqueue_style('jqueryui', "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
	wp_enqueue_script( 'jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js', array (), 1.1, true);

	wp_enqueue_script( 'script', get_stylesheet_directory_uri() . '/js/clipboard.min.js', array (), 1.1, true);
	wp_enqueue_script( 'load_rw_facet_js', get_stylesheet_directory_uri() . '/js/facet_labels.js', array (), 0.1, true);
	wp_enqueue_script( 'load_toc_js', get_stylesheet_directory_uri() . '/js/jquery.toc.js', array (), 0.1, true);
	wp_enqueue_script( 'load_rw_materialpool_js', get_stylesheet_directory_uri() . '/js/materialpool.js', array (), 0.1, true);
	wp_enqueue_script( 'load_rw_materialpool_js_menue', get_stylesheet_directory_uri() . '/js/jquery.contextMenu.min.js', array ('load_rw_materialpool_js'), 0.1, true);
	wp_enqueue_script( 'load_rw_materialpool_js_ui_position', get_stylesheet_directory_uri() . '/js/jquery.ui.position.min.js', array (), 0.1, true);
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


function frontend_ajax() {
	echo '<script type = "text/javascript" >';
	echo 'var ajaxurl = "'. admin_url('admin-ajax.php') . '"' ;
	echo '</script >';
}

if ( !is_admin() ) {
	add_action( 'wp_head', 'frontend_ajax');
}
