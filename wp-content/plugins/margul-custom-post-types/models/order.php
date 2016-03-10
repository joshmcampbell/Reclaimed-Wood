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

<<<<<<< HEAD
=======
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
>>>>>>> 340e134407316ccffd87ffccc09bb6fddfec6ada

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