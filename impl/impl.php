<?php header("Content-Type: text/html; charset=ISO-8859-1"); 
/**
 * Plugin Name: IMPL Plugin
 * Plugin URI: 
 * Description:
 * Version: 0.0.1
 * Author: Martin Schmidt
 * Author URI: 
 * License: 
 */

add_shortcode('show_impl_view_table', 'impl_view');
function impl_view() {
	include("view.php");
}


?>