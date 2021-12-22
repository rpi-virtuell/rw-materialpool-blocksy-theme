<?php
if (!defined('WP_DEBUG')) {
    die('Direct access forbidden.');
}


include_once "inc/themeCore.php";
include_once "inc/pluginSource.php";


add_action('wp_enqueue_scripts', function () {
    //stylesheets
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('old-styles', get_stylesheet_directory_uri() . '/old-style.css');
    wp_enqueue_style('theme-styles', get_stylesheet_directory_uri() . '/style.css');

    wp_enqueue_style('contextmenu', trailingslashit(get_stylesheet_directory_uri()) . 'css/jquery.contextMenu.min.css', array());
    wp_enqueue_style('font-awesome', '//use.fontawesome.com/releases/v5.6.3/css/all.css');

    //javscripts
    //für accordions notwendig
    wp_enqueue_style('jqueryui', "//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css");
    wp_enqueue_script('jquery-ui', '//code.jquery.com/ui/1.12.1/jquery-ui.js', array(), 1.1, true);

    wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/clipboard.min.js', array(), 1.1, true);
    wp_enqueue_script('load_rw_facet_js', get_stylesheet_directory_uri() . '/js/facet_labels.js', array(), 0.1, true);
    wp_enqueue_script('load_toc_js', get_stylesheet_directory_uri() . '/js/jquery.toc.js', array(), 0.1, true);
    wp_enqueue_script('load_rw_materialpool_js', get_stylesheet_directory_uri() . '/js/materialpool.js', array(), 0.1, true);
    wp_enqueue_script('load_rw_materialpool_js_menue', get_stylesheet_directory_uri() . '/js/jquery.contextMenu.min.js', array('load_rw_materialpool_js'), 0.1, true);
    wp_enqueue_script('load_rw_materialpool_js_ui_position', get_stylesheet_directory_uri() . '/js/jquery.ui.position.min.js', array(), 0.1, true);
});


/**
 * Ausgabe der Themensliste auf der Startseie
 */
function rw_material_get_themenliste()
{

    $links = [];

    $args = array(
        "post_type" => "themenseite",
        "post_status" => "publish",
        "orderby" => "title",
        "order" => "ASC",
        "posts_per_page" => 1000,
    );
    $themen = get_posts($args);

    foreach ($themen as $thema) {

        $pattern = '<a class="button" href="%s">%s</a>';
        $link = sprintf($pattern, $thema->guid, $thema->post_title);
        $links[] = $link;

    }

    return implode('<span> · </span>', $links);

}

if (!function_exists('chld_thm_cfg_parent_css')):
    function chld_thm_cfg_parent_css()
    {
        wp_enqueue_style('chld_thm_cfg_parent', trailingslashit(get_template_directory_uri()) . 'style.css', array());
        wp_enqueue_script('script', get_stylesheet_directory_uri() . '/js/clipboard.min.js', array(), 1.1, true);
        wp_enqueue_style('contextmenu', trailingslashit(get_stylesheet_directory_uri()) . 'css/jquery.contextMenu.min.css', array());
    }
endif;
add_action('wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10);


function frontend_ajax()
{
    echo '<script type = "text/javascript" >';
    echo 'var ajaxurl = "' . admin_url('admin-ajax.php') . '"';
    echo '</script >';
}

if (!is_admin()) {
    add_action('wp_head', 'frontend_ajax');
}


/**
 * facetwp wpquery manipulationen
 */

function facetwp_query_args_autor($query_args, $class)
{
    global $post;

    if (strpos($class->ajax_params['http_params']['uri'], 'autor/') === false) {
        return $query_args;
    }
    if ('material_autor' == $class->ajax_params['template']) {

        $autor = get_page_by_path(str_replace('autor/', '', $class->ajax_params['http_params']['uri']), OBJECT, 'autor');

        $material_ids = get_post_meta($autor->ID, 'material_autoren', true);

        if (isset($query_args['meta_query'])) {
            unset($query_args['meta_query']);
        }

        $query_args["post__in"] = $material_ids;
    }

    /*
    if ( defined('REST_REQUEST') && REST_REQUEST ) {
          if ( 'material_autor' == $class->ajax_params['template'] ) {
            $autor =  get_page_by_path( str_replace('autor/','',$class->ajax_params['http_params']['uri']) , OBJECT, 'autor' );
            $query_args['meta_query'][0][ 'value'] = (string)$autor->ID;
        }
    } else {
        if ( 'material_autor' == $class->ajax_params['template'] ) {

            $query_args['meta_query'][0][ 'value'] = (string)$post->ID;
        }
    }
    */
    return $query_args;
}

add_filter('facetwp_query_args', 'facetwp_query_args_autor', 10, 2);

function facetwp_query_args_organisation($query_args, $class)
{

    if (defined('REST_REQUEST') && REST_REQUEST) {

        if ('material_organisation' == $class->ajax_params['template']) {
            $organisation = get_page_by_path(str_replace('organisation/', '', $class->ajax_params['http_params']['uri']), OBJECT, 'organisation');
            $query_args['meta_query'][0]['value'] = (string)$organisation->ID;
        }
    } else {
        global $post;
        if ('material_organisation' == $class->ajax_params['template']) {
            $query_args['meta_query'][0]['value'] = $post->ID;
        }
    }
    return $query_args;
}

add_filter('facetwp_query_args', 'facetwp_query_args_organisation', 10, 2);

function facetwp_query_args_werkzeug($query_args, $class)
{

    if (is_tax()) {
        $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
        $query_args['tax_query'][0]['terms'] = $term->slug;
    }
    return $query_args;
}

add_filter('facetwp_query_args', 'facetwp_query_args_werkzeug', 10, 2);


function facetwp_query_args_material_verweise($query_args, $class)
{
    global $post;
    if ('material_verweise' == $class->ajax_params['template']) {
        $query_args = Materialpool_Material::get_verweise_ids();
    }
    return $query_args;
}

add_filter('facetwp_pre_filtered_post_ids', 'facetwp_query_args_material_verweise', 10, 2);

function facetwp_query_args_themenseiten($query_args, $class)
{
    global $post;
    global $themenseite_material_id_list;

    $func = function ($value) {
        return (int)$value;
    };

    $material_id_list = array();
    if (defined('REST_REQUEST') && REST_REQUEST) {

        if ('thema' == $class->ajax_params['template']) {
            $themenseite = get_page_by_path(str_replace('themenseite/', '', $class->ajax_params['http_params']['uri']), OBJECT, 'themenseite');


            foreach (Materialpool_Themenseite::get_gruppen($themenseite->ID) as $gruppe) {
                $id_list = array_map($func, $gruppe['auswahl']);
                $material_id_list = array_merge($material_id_list, $id_list);
            }

            $query_args = $material_id_list;
        }

    } elseif ($post->post_type == "themenseite" && !is_embed()) {

        foreach (Materialpool_Themenseite::get_gruppen($post->ID) as $gruppe) {
            if (!$gruppe['auswahl']) continue;
            $id_list = array_map($func, $gruppe['auswahl']);
            $material_id_list = array_merge($material_id_list, $id_list);
        }
        $query_args = $material_id_list;
    }
    return $query_args;
}

add_filter('facetwp_pre_filtered_post_ids', 'facetwp_query_args_themenseiten', 10, 2);


function my_facetwp_facet_html($output, $params)
{
    if ('alpika' == $params['facet']['name']) {
        $output = str_replace('>1 <', '>aus den Instituten <', $output);
    }
    if ('alpika_organisation' == $params['facet']['name']) {
        $output = str_replace('>1 <', '>ALPIKA <', $output);
    }
    if ('erscheinungsjahr' == $params['facet']['name']) {
        $output = str_replace('>0 <', '>Keine Angabe <', $output);
    }

    return $output;
}

function catch_thema_image()
{
    global $post, $posts;
    $first_img = '';
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if (empty($first_img)) { //Defines a default image
        $first_img = get_stylesheet_directory_uri() . '/assets/default.jpg';
    }
    return $first_img;
}

add_filter('facetwp_facet_html', 'my_facetwp_facet_html', 10, 2);

/*add accordeons to [accordion].<h3>..[/accordion] shortcode*/

function rw_add_accordion($atts, $content){

    $description = str_replace('</h3>','</h3><div>',do_shortcode($content));
    $description = str_replace('<h3>','</div><h3>',$description);


    $html = '<div class="accordion"><div>'.$description.'</div></div>';
    $html = str_replace('<div></div>','',$html);
    $html .= "
             <script>
                  jQuery( function() {
                    jQuery( '.accordion' ).accordion({
                      collapsible: true,
                      heightStyle: 'content',
                      active:false,
                      header:'h3'
                    });
                  } );
             </script>
            
            ";
    return $html;
}
add_shortcode( 'accordion','rw_add_accordion' );

/*add tabs to [tabs].<h5>..[/tabs] shortcode*/

function rw_add_tabs($atts, $content){

    $content = do_shortcode($content);

    $id = 'tabs-'.generateRandomString(4);

    $html = '<div id="'.$id.'"><ul>';

    $pattern = '#<h5>(.*)</h5>#i';

    $tabs = array();

    preg_match_all($pattern, $content,$matches);
    $i=0;


    foreach($matches[1] as $m){
        $i ++;
        $tabs[$i]=$m;
    }

    $tabids=array();

    foreach ($tabs as $d=>$tab){
        $tabid = $id.$d;
        $html .= "<li><a href=\"#".$tabid."\">".$tab."</a></li>";
        $tabids[$d]= $tabid;
    }

    $html .= '</ul>';


    $content = preg_replace('#(<h5>.*</h5>)#','[tab]$1',$content);
    $parts = explode('[tab]',$content);

    $i = 0;
    foreach($parts as $part){
        if($i>0){
            $html .= '<div id="'.$tabids[$i].'">'.$part.'</div>';
        }
        $i++;
    }

    $html .= "</div>
             <script>
                  jQuery( function() {
                     jQuery( '#" . $id . "' ).tabs({
                        collapsible: true
                     });
                  } );
             </script>
            
            ";
    return $html;
}
add_shortcode( 'tabs','rw_add_tabs' );

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
