<?php
// SEE THE README FOR DOCUMENTATION
// Initialize the class objects, and add functionality

$post_name = array(
	'rcw_builder',
	'Product Builder'
);
$args = array(
	'menu_position' => 5,
	'supports'      => array('title'),
	'has_archive'   => true,
);

$postLabelNames = array(
	'product builder',
	'Product Builder',
	'Product Builders'
);

$type_labels = array(
	'name' 					=> sprintf( _x( '%s', 'taxonomy general name', 'cuztom' ), $postLabelNames[2] ),
	'singular_name' 		=> sprintf( _x( '%s', 'taxonomy singular name', 'cuztom' ), $postLabelNames[1] ),
	'search_items' 			=> sprintf( __( 'Search %s', 'cuztom' ), $postLabelNames[2] ),
	'all_items' 			=> sprintf( __( 'All %s', 'cuztom' ), $postLabelNames[2] ),
	'parent_item' 			=> sprintf( __( 'Parent %s', 'cuztom' ), $postLabelNames[1] ),
	'parent_item_colon' 	=> sprintf( __( 'Parent %s:', 'cuztom' ), $postLabelNames[1] ),
	'edit_item' 			=> sprintf( __( 'Edit %s', 'cuztom' ), $postLabelNames[1] ),
	'update_item' 			=> sprintf( __( 'Update %s', 'cuztom' ), $postLabelNames[1] ),
	'add_new_item' 			=> sprintf( __( 'Add New %s', 'cuztom' ), $postLabelNames[1] ),
	'new_item_name' 		=> sprintf( __( 'New %s Name', 'cuztom' ), $postLabelNames[1] ),
	'menu_name' 			=> sprintf( __( '%s', 'cuztom' ), $postLabelNames[2] )
);

// Post type object is created here, extra functionality should be added through an extended model
$post_type = new Rcw_Builder($post_name, $args, $type_labels);

// This sets up metabox fields refer to the docs
$fields = array(
    array(
        'name'          => 'sample_text',
        'label'         => 'Sample Text',
        'type'          => 'text',
    )
);

// Create Metaboxes
$post_type->add_meta_box(
	'meta_builder',
	'Builder Data',
	$fields,
	'normal',
	'high'
);