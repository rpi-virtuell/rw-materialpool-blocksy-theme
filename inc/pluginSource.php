<?php

class pluginSource {
	 function __construct() {
		 if ( !is_admin() ) {
			 add_action( 'wp_head', array($this, 'frontend_ajax'));
		 }
	 }

	function frontend_ajax() {
		echo '<script type = "text/javascript" >';
		echo 'var ajaxurl = "'. admin_url('admin-ajax.php') . '"' ;
		echo '</script >';
	}
}
