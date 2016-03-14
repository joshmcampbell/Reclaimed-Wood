<?php

// Custom Post Type name
$post_name = array(
	'orders',
	'Orders'
);
// The argument for creating the post type. https://codex.wordpress.org/Function_Reference/register_post_type
$args = array(
	'menu_position' => 5,
	'supports'      => array('title'),
	'has_archive'   => true,
);

// The labels for the post type.
$postLabelNames = array(
	'order',
	'orders',
	'Orders'
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

// Post type object is created here, extra functionality is added through an extended model
$post_type = new Order($post_name, $args, $type_labels);

// This is the data that we are adding for the field.
$fields = array(
    array(
        'name'          => 'name',
        'label'         => 'Name',
        'type'          => 'text',
    ),
    array(
        'name'          => 'email',
        'label'         => 'Email',
        'type'          => 'text',
    ),
    array(
        'name'          => 'phone_number',
        'label'         => 'Phone Number',
        'type'          => 'text',
    ),
    array(
        'name'          => 'street_address',
        'label'         => 'Street Address',
        'type'          => 'text',
    ),
    array(
        'name'          => 'city',
        'label'         => 'City',
        'type'          => 'text',
    ),
    array(
        'name'          => 'province',
        'label'         => 'Province',
        'type'          => 'text',
    ),
    array(
        'name'          => 'postal_code',
        'label'         => 'Postal Code',
        'type'          => 'text',
    ),
    array(
        'name'          => 'order_summary',
        'label'         => 'Order Summary',
        'type'          => 'textarea',
    ),
    array(
        'name'          => 'additional_comments',
        'label'         => 'Additional Comments',
        'type'          => 'textarea',
    ),
);

// Create Metabox
$post_type->add_meta_box(
	'meta_orders',
	'Order Data',
	$fields,
	'normal',
	'high'
);