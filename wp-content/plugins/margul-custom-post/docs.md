# Cuztom Helper

This helper can be used to quickly register Custom Post Types, Taxonomies, Meta Boxes, Menu Pages and Sidebars within your Wordpress projects. Please comment, review, watch, fork and report bugs.

**Version:** 2.9.6
**Requires:** 3.5 / 3.0+

## Basic usage

Include the main file.

	include( 'cuztom/cuztom.php' );

### Add Custom Post Types

	$book = register_cuztom_post_type( 'Book' );

**Note:** If you're using Custom Post Types, don't forget to *[flush rewrite rules on activation](http://codex.wordpress.org/Function_Reference/register_post_type#Flushing_Rewrite_on_Activation "Flushing Rewrite Rules on Activation")*.

### Add Custom Taxonomies

To add Custom Taxonomies to the newly created Post Type, simply call this method.

	$book->add_taxonomy( 'Author' );

You can also call this as a seperate class like this. The second parameter is the Post Type name.

	$taxonomy = register_cuztom_taxonomy( 'Author', 'book' );

### Add Meta Boxes

Add Meta Boxes.

	$book->add_meta_box(
		'meta_box_id',
		'Book Info',
		array(
			array(
				'name' 			=> 'author',
				'label' 		=> 'Author',
				'description'	=> 'Just a little description',
				'type'			=> 'text'
			)
		)
	);

Meta Boxes can be added with their own class too. The second parameter is the Post Type name.

	$box = add_cuztom_meta_box(
		'meta_box_id',
		'Book Info',
		'book',
		array(
			'name' 			=> 'author',
			'label' 		=> 'Author',
			'description'	=> 'Just a little description',
			'type'			=> 'text'
		)
	)

### Add Sidebars

To register a sidebar, just call this.

	$sidebar = new Cuztom_Sidebar( array(
		'name'				=> 'Sidebar Twee',
		'id'				=> 'sidebar_twee',
		'description'		=> 'Build with an array',
	) );

## Advanced usage
See the <a href="https://github.com/Gizburdt/Wordpress-Cuztom-Helper/wiki">wiki</a> for the full and advanced guides.

##Post Types

The main goal of Cuztom Helper is to register Custom Post Types. This can easily be done with the Cuztom_Post_Type class:

    $book = new Cuztom_Post_Type( 'Book' );
    As second parameter you can pass some arguments. Take a look here to see which arguments are available.

    $book  = new Cuztom_Post_Type( 'Book', array(
        'has_archive' => true,
        'supports' => array( 'title', 'editor', 'thumbnail' )
    ) );

The third parameter can be used to pass cuztom labels. If you don't set the labels yourself, Cuztom will do it for you. To see which labels can be used, take a look here

##Taxonomies

To add Custom Taxonomies to the newly created Post Types, simply call this method.

    $book->add_taxonomy( 'Genre' );
    You can also call this as a separate class like this. The second parameter is the Post Type name.

    $taxonomy = register_cuztom_taxonomy( 'Genre', 'book' );

To learn how to add meta fields to taxonomies check out the Term Meta page.

## Term Meta

It is also possible to add meta fields to term (taxonomies). You just need three steps for that:

1. Register your Post Types.
2. Register your Taxonomies.
3. Add the meta field to term.

Example:

    // Add Book CPT.
    $book = register_cuztom_post_type( 'Book' );

    // Register custom taxonomies.
    $author = register_cuztom_taxonomy( 'Genre', 'book' );

    // Add image field to Genre (Note that you need to wrap all the fields in an array).
    $author->add_term_meta (
        array(
            array(
                'name'        => 'genre_image',
                'label'       => 'Author Image',
                'description' => 'Featured Author Image',
                'type'        => 'image'
            )
        )
    );

## Meta Boxes

### Text

	array(
        'name'          => 'name_text',
        'label'         => 'Text',
        'description'   => 'Text Description',
        'type'          => 'text',
    )

### Textarea

    array(
        'name'          => 'name_textarea',
        'label'         => 'Text Area',
        'description'   => 'Text Area Field Description',
        'type'          => 'textarea',
    )

### Radios

    array(
        'name'          => 'name_radios',
        'label'         => 'Radios',
        'description'   => 'Radios Description',
        'type'          => 'radios',
        'options'       => array(
            'value1'    => 'Value 1',
            'value2'    => 'Value 2',
            'value3'    => 'Value 3'
        ),
        'default_value' => 'value2'
    )

### Yes No

    array(
        'name'          => 'name_yesno',
        'label'         => 'Yes No',
        'description'   => 'Yes No Description',
        'type'          => 'yesno',
    )

### Select

    array(
        'name'          => 'name_select',
        'label'         => 'Select',
        'description'   => 'Select Description',
        'type'          => 'select',
        'options'       => array(
            'value1'    => 'Value 1',
            'value2'    => 'Value 2',
            'value3'    => 'Value 3'
        ),
        'default_value' => 'value2'

     )
### Post Select (Select posts of any [custom] post type)

    array(
        'name'          => 'name_post_select',
        'label'         => 'Post Select',
        'description'   => 'Post Select Description',
        'type'          => 'post_select',
        'args'          => array(
            'post_type' => 'any_post_type_name',
        )
    )
'args' would take any arguments listed on http://codex.wordpress.org/Template_Tags/get_posts

### Term Select (Select terms of any [custom] taxonomy)

    array(
        'name'          => 'name_term_select',
        'label'         => 'Term Select',
        'description'   => 'Term Select Description',
        'type'          => 'term_select',
        'args'       => array(
            'taxonomy' => 'any_taxonomy_name',
        )
    )
'args' would take any arguments listed on http://codex.wordpress.org/Function_Reference/wp_dropdown_categories

### Checkbox

    array(
        'name'          => 'name_checkbox',
        'label'         => 'Checkbox',
        'description'   => 'Checkbox Description',
        'type'          => 'checkbox',
        'default_value' => 'on'
    )

### Checkboxes

    array(
        'name'          => 'name_checkboxes',
        'label'         => ' Checkboxes',
        'description'   => ' Checkboxes Description',
        'type'          => 'checkboxes',
        'options'       => array(
            'value1'    => 'Value 1',
            'value2'    => 'Value 2',
        )
    )

### Post Checkboxes (Checkboxes of posts of any [custom] post type)

    array(
        'name'          => 'name_post_checkboxes',
        'label'         => 'Post Checkboxes',
        'description'   => 'Post Checkboxes Description',
        'type'          => 'post_checkboxes',
        'args'       => array(
            'post_type' => 'any_post_type_name'
        )
    )
'args' would take any arguments listed on http://codex.wordpress.org/Template_Tags/get_posts

### Term Checkboxes (Checkboxes of terms of any [custom] taxonomy)

    array(
        'name'          => 'name_term_checkboxes',
        'label'         => 'Term Checkboxes',
        'description'   => 'Term Checkboxes Description',
        'type'          => 'term_checkboxes',
        'args'       => array(
            'taxonomy' => 'any_taxonomy_name',
        )
    )
'args' would take any arguments listed on http://codex.wordpress.org/Template_Tags/get_terms

### Image

    array(
        'name'          => 'name_image',
        'label'         => 'Image',
        'description'   => 'Image Description',
        'type'          => 'image',
    )

### File

    array(
        'name'          => 'name_file',
        'label'         => 'File',
        'description'   => 'File Description',
        'type'          => 'file',
    )

### WYSIWYG

    array(
        'name'          => 'name_wysiwyg',
        'label'         => 'WYSIWYG',
        'description'   => 'WYSIWYG Description',
        'type'          => 'wysiwyg',
    )

### Datepicker

    array(
        'name'          => 'name_date',
        'label'         => 'Date',
        'description'   => 'Date Description',
        'type'          => 'date',
        'args'       => array(
            'date_format' => 'mm/dd/yy'
        )
    )
You can pass an 'args' parameter with an array of named arguments.

date_format - gives you a chance to format the date picker format. E.g. yy-mm-dd (please note that jqueryUI only uses two yy's as a representation of years).
Format	Example
Default format	mm/dd/yy	11/16/2012
ISO 8601	yy-mm-dd	2012-11-16
Short	d M, y	16 Nov, 12
Medium	d MM, y	16 November, 12
Full	DD, d MM, yy	Friday, 16 November, 2012
With text
'day' d 'of' MM 'in the year' yy	'day' d 'of' MM 'in the year' yy	day 16 of November in the year 2012
Datepicker

    array(
        'name'          => 'name_date',
        'label'         => 'Date',
        'description'   => 'Date Description',
        'type'          => 'date',
        'args'       => array(
            'date_format' => 'mm/dd/yy'
        )
    )

### Datetime

    array(
        'name'          => 'name_datetime',
        'label'         => 'Datetime',
        'description'   => 'Datetime Description',
        'type'          => 'datetime',
        'args'       => array(
            'date_format' => 'mm/dd/yy'
        )
    )

### Time

    array(
        'name'          => 'name_time',
        'label'         => 'Time',
        'description'   => 'Time Description',
        'type'          => 'time',
    )

### Color

    array(
        'name'          => 'name_color',
        'label'         => 'Color',
        'description'   => 'Color Description',
        'type'          => 'color',
    )

### Hidden

    array(
        'name'          => 'name_hidden',
        'label'         => 'Hidden',
        'description'   => 'Hidden Description',
        'type'          => 'hidden',
        'default_value' => 'whatever'
    )

## Repeatable fields

To make a meta box repeatable, simply add 'repeatable' => true to the field. Example:

    array(
        'name'          => 'name_text',
        'label'         => 'Text',
        'description'   => 'Text Description',
        'type'          => 'text',
        'repeatable'    => true
    )

Presently, 'text', 'textarea', 'image' , 'select', 'post_select', 'term_select' are the repeatable fields.

## Creating tabs in a meta box

The general syntax for creating tabs in a meta box is:

	$your_cpt->add_meta_box(
	    'meta_box_id',
	    'Name of Metabox',
	    array(
	        'tabs',
	        array(
	            'Tab Name' => array(
	                // Fields here
	            ),

	            'Another Tab Name' => array(
	                // Fields here
	            )
	        )
	    )
	);

A simple example:

	$insyum_food_item->add_meta_box(
	    'meta_box_id',
	    'Test Tabs',
	    array(
	        'tabs',
	        array(
	            'Tab A' => array(
	                array(
	                    'name'          => 'a_text',
	                    'label'         => 'Text',
	                    'description'   => 'Text Description',
	                    'type'          => 'text'
	                ),
	                array(
	                    'name'          => 'a_textarea',
	                    'label'         => 'Textarea',
	                    'description'   => 'Textarea Description',
	                    'type'          => 'textarea'
	                )
	            ),

	            'Tab B' => array(
	                array(
	                    'name'          => 'b_color',
	                    'label'         => 'Pick a Color',
	                    'description'   => 'Color Description',
	                    'type'          => 'color'
	                ),
	                array(
	                    'name'          => 'b_date',
	                    'label'         => 'Choose Date',
	                    'description'   => 'Date Description',
	                    'type'          => 'date'
	                )
	            )
	        )
	    )
	);

## Creating accordion in a meta box

Accordion is created in the exact same manner as tabs. So, simply change the type from tabs to accordion just after the meta box name in the usage and example provided in Creating tabs in a meta box section above. The tab names will become the names of accordion sections.

## Bundles (A repeatable set of fields)

Bundles are repeatable groups of fields. Here's the usage via an example :

	$cpt_car->add_meta_box(
	        'meta_box_id',
	    'Model Details',
	    array(
	            'bundle',
	        array(
	            array(
	                'name'          => 'model',
	                'label'         => 'Model',
	                'description'   => 'Model number',
	                'type'          => 'text'
	            ),
	            array(
	                'name'          => 'price',
	                'label'         => 'Price',
	                'description'   => 'Price of this model',
	                'type'          => 'text'
	            )
	        )
	    )
	);

## Retrieving Your Fields

This is how to get your fields to add them to your theme:

	echo get_post_meta($post->ID, '_box_name_field_name', true);

### Usage example

	echo get_post_meta($post->ID, '_Date_party_date', true);

Read more about get_post_meta() on the WordPress Codex

### Image Fields

The image field stores only an ID to the image, without any image information, so you must use this ID to return the attached image:

	echo wp_get_attachment_image(get_post_meta($post->ID, '_box_name_field_name', true));

Read more about wp_get_attachment_image() on the WordPress Codex

## Bundles

The bundles are stored in an array that's returned by using whole bundle's key:

	print_r(get_post_meta($post->ID, '_bundle_name', true));

eg: print_r(get_post_meta($post->ID, '_meta_box_id', true)); Notice the _ before the bundle_name.

This will print out an array in the following format:

	Array
	(
	    [0] => Array
	    (
	         [_box_name_field_name] => Field Name Value
	         [_box_name_another_field_name] => Another Field Name Value
	     )
	     [1] => Array
	     (
	         [_box_name_field_name] => Field Name Value
	         [_box_name_another_field_name] => Another Field Name Value
	     )
	     ...
	     [n] => Array
	     (
	         [_box_name_field_name] => Field Name Value
	         [_box_name_another_field_name] => Another Field Name Value
	     )
	)

You can iterate through these entries to return each per key.