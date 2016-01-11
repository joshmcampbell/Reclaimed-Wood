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
define('NM_VERSION', 1.2);
define('NM_URL', get_bloginfo('url'));
define('NM_REQUEST', $_SERVER['REQUEST_URI']);
define('NM_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('NM_PLUGIN', plugins_url('mg-rcw'));
define('NM_PLUGIN_DIR', dirname(__FILE__));
define('NM_IMAGES', NM_PLUGIN.'/assets/images');
define('NM_CSS', NM_PLUGIN.'/assets/css');
define('NM_JS', NM_PLUGIN.'/assets/js');
define('NM_VENDOR', NM_PLUGIN.'/assets/vendor');
define('NM_ENCRYPTION_KEY', 'bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3');

// Upload + image
$uploads = wp_upload_dir();
define('NM_UPLOADS', $uploads['baseurl']);
define('NM_UPLOADS_ROOT', $uploads['basedir']);

// Timthumb, this has its own config options in the file
define('NM_THUMB', NM_PLUGIN.'/assets/timthumb.php');

// Uninstall, we will loop through these to remove data on uninstall
$nm_uninstall = array(
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
$pattern=NM_PLUGIN_DIR."/models/*.php";
foreach (glob($pattern) as $filename) {
	include_once($filename);
}

// Controls post type options + fields
$pattern=NM_PLUGIN_DIR."/controllers/*.php";
foreach (glob($pattern) as $filename) {
	include_once($filename);
}

// Adds the print.css
function my_enqueue($hook) {
    wp_enqueue_style( 'print-form', NM_CSS . '/form_print.css' );
    wp_enqueue_style( 'style-admin', NM_CSS . '/style-admin.css' );
    wp_enqueue_script( 'script-admin', NM_JS . '/scripts.js' , 'jquery', NM_VERSION, true);
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );


/**
 * Plugin enqueue hooks to add the frontend CSS + scripts
 *
 */
add_action('wp_print_styles', 'nm_enqueues', 10);
function nm_enqueues() {
	// Default script dependancies
	$dependencies = array('jquery');

}

// Adds Plugin meta to the head for passing values to js
add_action('admin_head', 'nm_head', 10);
function nm_head() {
	echo '<meta name="nm-plugin-path" id="nm-plugin-path" value="'.NM_PLUGIN.'" />'.PHP_EOL;
	echo '<meta name="nm-plugin-dir" id="nm-plugin-dir" value="'.NM_PLUGIN_DIR.'" />'.PHP_EOL;
}


/**
 * Plugin Activation / Deactivation / Uninstall Hooks
 *
 */

// Plugin activate function
register_activation_hook(__FILE__, 'nm_plugin_activate');
function nm_plugin_activate() {
	flush_rewrite_rules();
	// Create the Application number Option.
	add_option('pf_app_number', '1');
}

// Plugin deactivate function
register_deactivation_hook (__FILE__, 'nm_plugin_deactivate');
function nm_plugin_deactivate() {
	flush_rewrite_rules();
}

// Plugin uninstall function
// WP Reccommends uninstall.php method, but we need $nm_uninstall
register_uninstall_hook(__FILE__, 'nm_plugin_delete');
function nm_plugin_delete() {
	global $wpdb, $wp_taxonomies, $nm_uninstall;

	// Delete Post Options
	foreach ($nm_uninstall['options'] as $option) {
		if (!empty($option)) {
			delete_option($option);
		}
	}

	// Delete Custom Posts
	if (!empty($nm_uninstall['post_types'])) {
		$args = array(
			'post_type' => $nm_uninstall['post_types'],
			'posts_per_page' => -1,
			'post_status' => 'any'
		);
		$posts = get_posts($args);
		if (!empty($posts)) {
			foreach ($posts as $post) {
				wp_delete_object_term_relationships($post->ID, $nm_uninstall['taxonomies']);
				wp_delete_post($post->ID, true);
			}
		}
	}

	// Delete Taxonomy Terms
	foreach ($nm_uninstall['taxonomies'] as $taxonomy) {
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