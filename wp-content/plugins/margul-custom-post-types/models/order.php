<?php
//--------------------

// File: example.class.php
// Author: Marcus Gullberg
// Description: extends functionality of the default post type class

// Security check - Ensure valid load
defined('ABSPATH') OR exit;

// If we get past above check, we are OK to work with the order class.

//--------------------

class Order extends Cuztom_Post_type {

	/**
	 * Function that grabs the boards array and makes a string of the order summary
	 * @param  [array]  $arrBoards [boards array.]
	 * @return [string]            [String of order summary]
	 */
	public static function arrayToOrderSummary($arrBoards) {
		$strText = '';

		// Loop through each board and get the text
		foreach ($arrBoards as $key => $board) {
			$strText .= 'Board Number: #' . ($key + 1) . '\n';
			$strText .= 'Functionality: ' . $board['functionality'] . '\n';

			if($board['functionality'] == 'text') {
				$strText .= '\tFont: ' . $board['font'] . '\n';
				$strText .= '\tText: ' . $board['text'] . '\n';
			} elseif($board['functionality'] == 'accessory') {
				$strText .= '\tType: ' . $board['accessory'] . '\n';
				$strText .= '\tQuantity: ' . $board['quantity'] . '\n';
			}

			$strText .= '\n';
		}

		return $strText;
	}

	public static function insertOrder($arrOrder) {
		
	}

} // end of class