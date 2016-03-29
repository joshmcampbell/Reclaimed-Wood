<?php

$post_name = array(
	'coupon',
	'Coupon'
);

$args = array(
	'menu_position' => 5,
	'supports' => array('title'),
	'has_archive' => true,
);

$postLabelNames = array(
	'coupon',
	'Coupon',
	'Coupons',
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

$post_type = new Board_Builder($post_name, $args, $type_labels);

$fields = array(
    array(
        'name'          => 'coupon_code',
        'label'         => 'Coupon Code',
        'description'   => 'The code used to activate the coupon.',
        'type'          => 'text',
    ),
    array(
        'name'          => 'coupon_discount',
        'label'         => 'Coupon Discount',
        'description'   => 'The percentage reduction in price upon coupon activation.',
        'type'          => 'text',
    )	
);

$post_type->add_meta_box(
	'meta_builder',
	'Coupon Data',
	$fields,
	'normal',
	'high'
);

?>