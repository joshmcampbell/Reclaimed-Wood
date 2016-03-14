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
	 * Function to processes the checkout form with validation and keeping
	 * the input so user don't have to enter it again. Also the function 
	 * that will call the insert_order function.
	 * @return [object] [Object with all the data for the form]
	 */
	public static function processForm() {
		 // Set up the default object
	    $objData = new stdClass;
	    $objData->error      = false;
	    $objData->errors     = array();
	    $objData->input      = array();
	    $objData->msg        = array();
	    $objData->success    = null;

	    // Used to keep track of their order in case validation fails
	    if(!empty($_POST['boards'])) {
	    	$objData->boards = $_POST['boards'];
	    } elseif(!empty($_POST['check_boards'])) {
	    	$objData->boards = json_decode(stripslashes($_POST['check_boards']), true);
	    	self::boardArrayToText($objData->boards);
	    } else {
	    	$objData->boards = array();
	    }

	    // User posted the form
	    if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['checkout'])) {
	        $objData->input = $_POST;
	        // Validate name
	        if(empty(trim($objData->input['custName']))) {
	            $objData->error     = true;
	            $objData->errors[]  = 'custName';
	            $objData->msg[]     = ' - Please enter your name';
	        }
	        // Validate email
	        if(empty(trim($objData->input['custEmail']))) {
	            $objData->error     = true;
	            $objData->errors[]  = 'custEmail';
	            $objData->msg[]     = ' - Please enter your email address';
	        } elseif(!filter_var($objData->input['custEmail'], FILTER_VALIDATE_EMAIL)) {
	        	// Valid email?
	        	$objData->error     = true;
	            $objData->errors[]  = 'custEmail';
	            $objData->msg[]     = ' - Please enter a valid email address';
	        }
	        // Validate address
	        if(empty(trim($objData->input['custAddr']))) {
	            $objData->error     = true;
	            $objData->errors[]  = 'custAddr';
	            $objData->msg[]     = ' - Please enter your address.';
	        }
	        // Validate Province
	        if(strtolower(trim($objData->input['custProv'])) == '===select province===') {
	            $objData->error     = true;
	            $objData->errors[]  = 'custProv';
	            $objData->msg[]     = ' - Please enter your Province';
	        }
	        // Validate City
	        if(empty(trim($objData->input['custCity']))) {
	            $objData->error     = true;
	            $objData->errors[]  = 'custCity';
	            $objData->msg[]     = ' - Please enter your city.';
	        }
	        // Validate Postal Code
	        if(empty(trim($objData->input['custCode']))) {
	            $objData->error     = true;
	            $objData->errors[]  = 'custCode';
	            $objData->msg[]     = ' - Please enter your Postal Code.';
	        }
	        // No errors then insert the order
	        if(!$objData->error) {
	        	// Order inserted successfully so redirect to thank you page
	            if(self::insertForm($objData->input)) {
	            	header('Location: /thank-you');
	            } else {
	            	$objData->error = true;
	            	$objData->msg[] = 'Something went wrong trying to insert your order. Please try again or contact us if problem persists.';
	            }
	        }
	    }

        return $objData;
	}

	/**
	 * Function for inserting an order into the database
	 * @param  [array] $arrInput [Array of input data]
	 * @return [boolean]         [Success or Failure]
	 */
	public static function insertForm($arrInput) {
		// Database prefix for this post type
		$prefix = '_meta_orders_';
		
		// Create the post
		$post_id = wp_insert_post(array(
				'post_title' => 'Order by ' . $arrInput['custName'],
				'post_status' => 'publish',
				'post_type' => 'orders'
			));

		// If inserted successfully
		if($post_id != 0) {
			// Insert the rest of the data
			add_post_meta($post_id, $prefix.'name', $arrInput['custName']);
			add_post_meta($post_id, $prefix.'email', $arrInput['custEmail']);
			add_post_meta($post_id, $prefix.'phone_number', $arrInput['custNum']);
			add_post_meta($post_id, $prefix.'street_address', $arrInput['custAddr']);
			add_post_meta($post_id, $prefix.'city', $arrInput['custCity']);
			add_post_meta($post_id, $prefix.'province', $arrInput['custProv']);
			add_post_meta($post_id, $prefix.'postal_code', $arrInput['custCode']);
			add_post_meta($post_id, $prefix.'order_summary', 
				wp_slash(self::boardArrayToText(json_decode(stripslashes($arrInput['check_boards']), true))));
			add_post_meta($post_id, $prefix.'additional_comments', $arrInput['custComm']);

			// Send Admin Email
			
			// Send Customer Email

			return true; 
		} else {
			return false;
		}
	}

	public static function boardArrayToText($arrBoards) {
		$strReturn = '';

		foreach ($arrBoards as $key => $board) {
			$strReturn .= 'Board Number: ' . ($key + 1);
			$strReturn .= '\\n===================\\n';
			$strReturn .= 'Functionality: ' . $board['functionality'] . '\\n';

			if($board['functionality'] == 'text') {
				$strReturn .= 'Font: ' . $board['font'] . '\\n';
				$strReturn .= 'Text: ' . $board['text'] . '\\n';
			} elseif($board['functionality'] == 'accessory') {
				$strReturn .= 'Type: ' . $board['accessory'] . '\\n';
				$strReturn .= 'Quantity: ' . $board['quantity'] . '\\n';
			}
		}

		$strReturn .= '\\n';

		return $strReturn;
	}

	public static function numToEng($num){
		$strReturn = "";
		
		if($num == 1){
			$strReturn = "one";
		} elseif($num == 2){
			$strReturn = "two";
		} elseif($num == 3){
			$strReturn = "three";
		} elseif($num == 4){
			$strReturn = "four";
		} elseif($num == 5){
			$strReturn = "five";
		} else {
			$strReturn = $num;
		}
		return $strReturn;
	}
	
	public static function nth($num){
		switch($num){
			case 0:
			return "first";
			break;

			case 1:
			return "second";
			break;

			case 2:
			return "third";
			break;

			case 3:
			return "fourth";
			break;

			case 4:
			return "fifth";
			break;
		}
	}

	public static function boardToEng($arrBoards){
		if(empty($arrBoards)) return;		

		$strReturn = "";

		foreach($arrBoards as $key => $board){
			$strReturn .= 'For your ';
			$strReturn .= Order::nth($key);
			$strReturn .= ' board, you want ';

			if ($board['functionality'] == 'blank'){
				$strReturn .= 'it to be left blank.';
			} 
			if($board['functionality'] == 'text'){
				$strReturn .= $board['text'];
				$strReturn .= ' written on it in ';
				$strReturn .= $board['font'];
				$strReturn .= '.';
			}
			if($board['functionality'] == 'accessory'){
				$strReturn .= Order::numToEng($board['quantity']);
				$strReturn .= " ";
				$strReturn .= $board['accessory'];
				$strReturn .= " arranged on it.";
			}
			$strReturn .= '<br>';
		}
		return $strReturn;
	}

	
} // end of class