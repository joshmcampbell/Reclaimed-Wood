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

	/**
	 * Function for grabbing the board prices for a customer builder
	 * @param  [integer] $intID [the post ID for the board bilder]
	 * @return [array]          [containing prices as assoc array's]
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

	/**
	 * function for getting the text data for a board builder post
	 * @param  [int] $intID [the post ID for the board bilder]
	 * @return [array]      [Array of font names]
	 */
	public static function getTextData($intID) {
		$arrTextData = array();
		// Grab the maximum character count post meta
		$arrTextData['max_character_count'] = (int)get_post_meta((int)$intID, static::$prefix.'max_character_count', true);

		// Grab the font term id's for this board builder post		
		$arrFontIDs = get_post_meta($intID, static::$prefix.'fonts', true);

		// loop through the ID's and get the term object
		$arrFonts = array();
		foreach ($arrFontIDs as $fontID) {
			$arrFonts[] = get_term((int)$fontID, 'fonts');
		}

		// We don't need the term object. Only need the font name so loop through the objects and grab the name.
		foreach ($arrFonts as $font) {
			$arrTextData['fonts'][] = $font->name;
		}

		return $arrTextData;
	}

	/**
	 * Function for getting the accessories for a board builder post
	 * @param  [int] $intID [the post ID for the board bilder]
	 * @return [array]      [containing assecories as assoc array's]
	 */
	public static function getAccessories($intID) {
		$arrReturn = array();
		// Get all the Accessory ID's for this post.
		$arrAccIDs = get_post_meta($intID, static::$prefix.'accessory_types', true);

		// Loop through the accessories and get the term objects.
		$arrAccessories = array();
		foreach ($arrAccIDs as $accID) {
			$arrAccessories[] = get_term((int)$accID, 'accessories');
		}

		// Loop through the term objects.
		foreach ($arrAccessories as $key => $acc) {
			// Grab the term meta
			$arrAccMeta = get_option('term_meta_accessories_'.$acc->term_id);

			// Set the maximum amount to input if there is any. Otherwise hardcoded 5.
			$intMaxAmount = (!empty($arrAccMeta['_max_amount'])) ? (int)$arrAccMeta['_max_amount'] : 5;

			$arrReturn[] = array(
				'name' => $acc->name,
				'maxAmt' => $intMaxAmount,
				'image' => wp_get_attachment_url((int)$arrAccMeta['_accessory_image'])
			);
		}

		return $arrReturn;
	}


} // end of class