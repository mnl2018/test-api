<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

function add_dashboard_widgets() {
	wp_add_dashboard_widget(
    	'dashboard_widget',
		'Latest Posts',
        'dashboard_widget_function');	
}
add_action('wp_dashboard_setup','add_dashboard_widgets');

function dashboard_widget_function() {	
	/*echo "Website: ".
		 "<form action='" . site_url() . "'/wp-admin/admin-ajax.php' method='POST' id='filter'>".
		 "<select>".
		 "<option value='https://techcrunch.com'>TechCrunch</option>".
		 "<option value='https://variety.com'>Variety</option>".
		 "<option value='https://www.sonymusic.com'>Sony Music</option>".
		 "</select>".
		 "<input type='submit' id='filter-website' class='button' value='Submit'>".
		 "</form>";*/
 
	$sites = array("https://techcrunch.com", "https://variety.com", "https://www.sonymusic.com");
	$list_all = array();
	
	foreach($sites as $key => $site){	
		$json_link = wp_remote_get($site . '/wp-json/wp/v2/posts?orderby=date&order=desc');
 		$list_posts = json_decode($json_link['body']);
		
		foreach($list_posts as $list_post ) {
			$list_all[] = $list_post;
		}	
		
		echo "<ul style='list-style:disc; list-style-position:inside;'>";
		
		foreach($list_all as $show_list){
			echo "<li>" . $show_list->title->rendered . "</li>";
		}
		
		echo "</ul>";
	}
}
