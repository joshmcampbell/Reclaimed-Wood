<?php
//--------------------

// File: example.class.php
// Author: Marcus Gullberg
// Description: extends functionality of the default post type class

// Security check - Ensure valid load
defined('ABSPATH') OR exit;

// If we get past above check, we are OK to work with the user class.

//--------------------

class Board_Builder extends Cuztom_Post_type {

	// In the database this is the prefix for our post meta
	private static $prefix = '_meta_builder_';

	/*
		Function for grabbing the board prices for a customer builder

		@params integer $intID - ID of the board builder post.
		@returns array - Associative array with the amount and price.
	 */
	public static function getBoardPrices($intID) {
		
		// We have 5 right now as a static maximum supported boards.
		$intBoardAmounts = 5;
		$arrPrices = array();

		// loop from 1 to 5
		for ($i = 1; $i <= $intBoardAmounts ; $i++) { 
			// grab the price for 1 .. 5 boards
			$dblPrice = get_post_meta($intID, static::$prefix.'board_price_'.$i, true);
			// If the client has entered a value for the price, add it to the return array.
			if(!empty($dblPrice)) {
				$arrPrices[] = array(
					'amount' => $i,
					'price'  => (double)$dblPrice
				);
			}
		}

		return $arrPrices;
	}

	/*
		Function for grabbing the Text data for a custom builder

		@params integer $intID - ID of the board builder post
		@returns array - Array with maximum characters and array of available fonts.
	 */
	public static function getTextData($intID) {
		$arrTextData = array();
		// Grab the maximum character count post meta
		$arrTextData['max_character_count'] = (int)get_post_meta((int)$intID, static::$prefix.'max_character_count', true);
		// Get all the available fonts. Order them by name and ascending order. Grab even empty ones.
		$arrFonts = get_terms('fonts', array(
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => false
		));

		// We don't need the term object. Only need the font name so loop through the objects and grab the name.
		foreach ($arrFonts as $font) {
			$arrTextData['fonts'][] = $font->name;
		}

		return $arrTextData;
	}


} // end of class