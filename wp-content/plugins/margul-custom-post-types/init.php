<?php
// Must be run through the wp core
defined('ABSPATH') OR exit;

/*
Plugin Name: MarGul Custom Post Types
Plugin URI: http://okangan.bc.ca
Description: A plugin that handles the custom post types.
Version: 1.0
Author: Marcus Gullberg
Author URI: https://github.com/MarGul

Notes:
Thanks to Gizburdt on Github for the framework
https://github.com/Gizburdt/Wordpress-Cuztom-Helper

Naming conventions
php variables + files use = lowercase_with_underscores
css selectors = lowercase-with-dashes
config paths exclude trailing slash/
*/

/**
 * Plugin constants and variables
 *
 */

// General
define('MG_VERSION', 1.2);
define('MG_URL', get_bloginfo('url'));
define('MG_REQUEST', $_SERVER['REQUEST_URI']);
define('MG_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('MG_PLUGIN', plugins_url('margul-custom-post-types'));
define('MG_PLUGIN_DIR', dirname(__FILE__));
define('MG_IMAGES', MG_PLUGIN.'/assets/images');
define('MG_CSS', MG_PLUGIN.'/assets/css');
define('MG_JS', MG_PLUGIN.'/assets/js');
define('MG_VENDOR', MG_PLUGIN.'/assets/vendor');
define('MG_VIEWS', MG_PLUGIN_DIR.'/views');

// Upload + image
$uploads = wp_upload_dir();
define('MG_UPLOADS', $uploads['baseurl']);
define('MG_UPLOADS_ROOT', $uploads['basedir']);

// Timthumb, this has its own config options in the file
define('MG_THUMB', MG_PLUGIN.'/assets/timthumb.php');

// Uninstall, we will loop through these to remove data on uninstall
$mg_uninstall = array(
	'post_types' 	=> array(),
	'taxonomies' 	=> array(),
	'options' 		=> array()
);

/**
 * Plugin + framework file includes
 *
 */

// Load our framework
include_once('cuztom.php');

// Post types extra functionality ex. shortcodes they will be extended in the models
$pattern=MG_PLUGIN_DIR."/models/*.php";
foreach (glob($pattern) as $filename) {
	include_once($filename);
}

// Controls post type options + fields
$pattern=MG_PLUGIN_DIR."/controllers/*.php";
foreach (glob($pattern) as $filename) {
	include_once($filename);
}

// Adds admin assets
function my_enqueue($hook) {
    wp_enqueue_style( 'bb-style-admin', MG_CSS . '/style-admin.css' );
    //wp_enqueue_script( 'bb-script-admin', MG_JS . '/scripts.js' , 'jquery', MG_VERSION, true);
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );


/**
 * Plugin enqueue hooks to add the frontend CSS + scripts
 */
add_action('wp_print_styles', 'mg_enqueues', 10);
function mg_enqueues() {
	// Default script dependancies
	$dependencies = array('jquery');

	wp_enqueue_style( 'bb-style-front', MG_CSS . '/style-front.css' );
	wp_enqueue_script( 'board-builder', MG_JS . '/boardBuilder.js', $dependencies, '1.0');
}

// Adds Plugin meta to the head for passing values to js
add_action('admin_head', 'mg_head', 10);
function mg_head() {
	echo '<meta name="mg-plugin-path" id="mg-plugin-path" value="'.MG_PLUGIN.'" />'.PHP_EOL;
	echo '<meta name="mg-plugin-dir" id="mg-plugin-dir" value="'.MG_PLUGIN_DIR.'" />'.PHP_EOL;
}


/**
 * Plugin Activation / Deactivation / Uninstall Hooks
 *
 */

// Plugin activate function
register_activation_hook(__FILE__, 'mg_plugin_activate');
function mg_plugin_activate() {
	flush_rewrite_rules();
	// Create the Application number Option.
	add_option('pf_app_number', '1');
}

// Plugin deactivate function
register_deactivation_hook (__FILE__, 'mg_plugin_deactivate');
function mg_plugin_deactivate() {
	flush_rewrite_rules();
}

// Plugin uninstall function
// WP Reccommends uninstall.php method, but we need $nm_uninstall
register_uninstall_hook(__FILE__, 'mg_plugin_delete');
function mg_plugin_delete() {
	global $wpdb, $wp_taxonomies, $mg_uninstall;

	// Delete Post Options
	foreach ($mg_uninstall['options'] as $option) {
		if (!empty($option)) {
			delete_option($option);
		}
	}

	// Delete Custom Posts
	if (!empty($mg_uninstall['post_types'])) {
		$args = array(
			'post_type' => $mg_uninstall['post_types'],
			'posts_per_page' => -1,
			'post_status' => 'any'
		);
		$posts = get_posts($args);
		if (!empty($posts)) {
			foreach ($posts as $post) {
				wp_delete_object_term_relationships($post->ID, $mg_uninstall['taxonomies']);
				wp_delete_post($post->ID, true);
			}
		}
	}

	// Delete Taxonomy Terms
	foreach ($mg_uninstall['taxonomies'] as $taxonomy) {
		// Custom Select for terms since taxonomies are deactivated with the plugin
		// WP devs are working on a tax delete func, look into in future
		$query = 'SELECT DISTINCT
					t.term_id
				FROM
					`wp_terms` t
				INNER JOIN
					`wp_term_taxonomy` tax
				ON
				 `tax`.term_id = `t`.term_id
				WHERE
					( `tax`.taxonomy = \'' . $taxonomy . '\')';

		$terms =  $wpdb->get_results($query , ARRAY_A);

		foreach ($terms as $term) {
			// Delete Any term metas saved in the wp_options table
			$id = $term['term_id'];
			delete_option('term_meta_' . $taxonomy . '_' . $id);

			// Delete the actual Terms/Categories
			if (term_exists($id, $taxonomy)) {
				wp_delete_term($id, $taxonomy);
			}

		}

		// Remove the registered Taxonomy
		if (taxonomy_exists($taxonomy)) {
			unset($wp_taxonomies[$taxonomy]);
		}

	}

	//die('end of uninstall + data cleaned');

}