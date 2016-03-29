<?php

// Custom Post Type name
$post_name = array(
	'board_builder',
	'Board Builder'
);
// The argument for creating the post type. https://codex.wordpress.org/Function_Reference/register_post_type
$args = array(
	'menu_position' => 5,
	'supports'      => array('title'),
	'has_archive'   => true,
);

// The labels for the post type.
$postLabelNames = array(
	'board builder',
	'Board Builder',
	'Board Builders'
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
$post_type = new Board_Builder($post_name, $args, $type_labels);

// Accessories Taxonomy https://codex.wordpress.org/Function_Reference/register_taxonomy
$tax_name = array(
    'accessories',
    'Accessories',
    'Accessories',
);
// Labels for the Accessories taxonomy
$tax_labels = array(
    'name'                  => sprintf( _x( '%s', 'taxonomy general name', 'cuztom' ), $tax_name[2] ),
    'singular_name'         => sprintf( _x( '%s', 'taxonomy singular name', 'cuztom' ), $tax_name[1] ),
    'search_items'          => sprintf( __( 'Search %s', 'cuztom' ), $tax_name[2] ),
    'all_items'             => sprintf( __( 'All %s', 'cuztom' ), $tax_name[2] ),
    'parent_item'           => sprintf( __( 'Parent %s', 'cuztom' ), $tax_name[1] ),
    'parent_item_colon'     => sprintf( __( 'Parent %s:', 'cuztom' ), $tax_name[1] ),
    'edit_item'             => sprintf( __( 'Edit %s', 'cuztom' ), $tax_name[1] ),
    'update_item'           => sprintf( __( 'Update %s', 'cuztom' ), $tax_name[1] ),
    'add_new_item'          => sprintf( __( 'Add New %s', 'cuztom' ), $tax_name[1] ),
    'new_item_name'         => sprintf( __( 'New %s Name', 'cuztom' ), $tax_name[1] ),
    'menu_name'             => sprintf( __( '%s', 'cuztom' ), $tax_name[2] )
);

// Arguments for the accessories taxonomy
$args = array(
    'hierarchical'     => false
);
// Register the taxnomy Accessories
$taxonomy = register_cuztom_taxonomy( $tax_name, $post_name, $args, $tax_labels);

// This is the data that we are adding to the accessories taxonomy. We are adding the
// max amount and an image for the accessories.
$taxonomy->add_term_meta(
    array(
        array(
            'name'          => 'max_amount',
            'label'         => 'Max Amount',
            'description'   => 'Max amount of this accessory type that can go on one board.',
            'type'          => 'text'
        ),
        array(
            'name'          => 'accessory_image',
            'label'         => 'An Image of the accessory',
            'description'   => 'Please select a image for the accessory.',
            'type'          => 'image'
        )
    )
);

// Fonts Taxonomy with labels
$tax_name = array(
    'fonts',
    'Fonts',
    'Fonts',
);
$tax_labels = array(
    'name'                  => sprintf( _x( '%s', 'taxonomy general name', 'cuztom' ), $tax_name[2] ),
    'singular_name'         => sprintf( _x( '%s', 'taxonomy singular name', 'cuztom' ), $tax_name[1] ),
    'search_items'          => sprintf( __( 'Search %s', 'cuztom' ), $tax_name[2] ),
    'all_items'             => sprintf( __( 'All %s', 'cuztom' ), $tax_name[2] ),
    'parent_item'           => sprintf( __( 'Parent %s', 'cuztom' ), $tax_name[1] ),
    'parent_item_colon'     => sprintf( __( 'Parent %s:', 'cuztom' ), $tax_name[1] ),
    'edit_item'             => sprintf( __( 'Edit %s', 'cuztom' ), $tax_name[1] ),
    'update_item'           => sprintf( __( 'Update %s', 'cuztom' ), $tax_name[1] ),
    'add_new_item'          => sprintf( __( 'Add New %s', 'cuztom' ), $tax_name[1] ),
    'new_item_name'         => sprintf( __( 'New %s Name', 'cuztom' ), $tax_name[1] ),
    'menu_name'             => sprintf( __( '%s', 'cuztom' ), $tax_name[2] )
);

// The argments for registering the font taxonomy
$args = array(
    'hierarchical'     => false
);
$taxonomy = register_cuztom_taxonomy( $tax_name, $post_name, $args, $tax_labels);

// This is the data that we are adding for the field.
$fields = array(
    array(
        'name'          => 'max_board_amount',
        'label'         => 'Maximum Amount of Boards',
        'description'   => 'This is the maximum amount of boards that the user can select.',
        'type'          => 'text',
    ),
    array(
        'name'          => 'board_price_1',
        'label'         => 'Price for 1 board',
        'type'          => 'text',
    ),
    array(
        'name'          => 'board_price_2',
        'label'         => 'Price for 2 boards',
        'type'          => 'text',
    ),
    array(
        'name'          => 'board_price_3',
        'label'         => 'Price for 3 boards',
        'type'          => 'text',
    ),
    array(
        'name'          => 'board_price_4',
        'label'         => 'Price for 4 boards',
        'type'          => 'text',
    ),
    array(
        'name'          => 'board_price_5',
        'label'         => 'Price for 5 boards',
        'type'          => 'text',
    ),
    array(
        'name'          => 'fonts',
        'label'         => 'Fonts',
        'description'   => 'Select the supported font styles.',
        'type'          => 'term_checkboxes',
        'args'       => array(
            'taxonomy' => 'fonts',
        ),
        'options' => array(
        	'hide_empty' => false
        )
    ),
    array(
        'name'          => 'max_character_count',
        'label'         => 'Maximum Character Count',
        'description'   => 'This is the maximum amount of characters that can be used on a text board.',
        'type'          => 'text',
    ),
    array(
        'name'          => 'accessory_types',
        'label'         => 'Accessory Types',
        'description'   => 'Select the accessory types that this board supports.',
        'type'          => 'term_checkboxes',
        'args'       => array(
            'taxonomy' => 'accessories',
        ),
        'options' => array(
        	'hide_empty' => false
        )
    )
);

// Create Metabox
$post_type->add_meta_box(
	'meta_builder',
	'Builder Data',
	$fields,
	'normal',
	'high'
);

// Board Builder Hooks
function boardBuilderHTML() {
    $shortcodeHTML = '';
    ob_start();
    include(MG_VIEWS . '/boardBuilder.php');
    $shortcodeHTML .= ob_get_clean();

    var_dump($shortcodeHTML); die;

    return $shortcodeHTML;
}
add_shortcode('board_builder', 'boardBuilderHTML');

// AJAX request from board Builder to grab the data
add_action( 'wp_ajax_bb_get_data', 'getBoardBuilderDataAJAX' );
add_action( 'wp_ajax_nopriv_bb_get_data', 'getBoardBuilderDataAJAX' );
function getBoardBuilderDataAJAX() {
    echo json_encode(Board_Builder::getBoardData(26));

    exit();
} 
?>