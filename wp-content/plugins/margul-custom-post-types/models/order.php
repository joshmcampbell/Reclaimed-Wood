<?php
//--------------------

// File: example.class.php
// Author: Marcus Gullberg & Joshua Campbell
// Description: extends functionality of the default post type class

// Security check - Ensure valid load
defined('ABSPATH') OR exit;

// If we get past above check, we are OK to work with the order class.

//--------------------

class Order extends Cuztom_Post_type {

	/*
		Short function to convert the numeric 'quantity' into a phrase. Nicer to look at.
		Defaults back to just the number if larger than five, allowing expansion further should it be needed.
					~JC
	*/
	public static function numToEng($int){
		$str = '';
		switch($int){
			case 1:
				$str .= 'one';
				break;
			
			case 2:	
				$str .= 'two';	
				break;
			
			case 3:
				$str .= 'three';
				break;
			
			case 4:
				$str .= 'four';
				break;
			
			case 5: 
				$str .= 'five';
				break;
			 
			default:
				$str .= $int;
				break;
		}
		return $str;
	}

	/*
		Long(ish) function sorts through all the boards currently being used and converts to a short text summary for each.
		Simple text, stacked on top of each other.
				~JC
	*/
	public static function boardToText($arrboards){
		$strReturn = ''; //Initialize the string variable we'll be using.
		
		foreach($arrboards as $key => $board){ //For loop. Cycles through the entire board array.
			if($key == 0){ //Checks for the board# (key + 1). Allows Things to look nicer.
				$strReturn .= 'For your first board, you want '; //This section is the same no matter the function, only needs to be written once
				if($board['functionality'] == 'text'){ //Check for the function of the board
					$strReturn .= "the phrase '"; //This block inserts the text. Uses ugly double quotes so the phrase is encapsulated by single quotes.
					$strReturn .= $board['text'];  //I found that double quotes looked awkward on the user end. Maybe that's just me ~JC
					$strReturn .= "' written on it in ";
					$strReturn .= $board['font'];
					$strReturn .= '.';	
				} elseif($board['functionality'] == 'accessory') { //Accessory block
				 	$strReturn .= Order::numToEng($board['quantity']); //Call to numToEng to convert the quantity into a nice string value
				 	$strReturn .= ' ';
				 	$strReturn .= $board['accessory']; //Accessory is already nicely formatted text. Only issue is that it's always plural, even when 
				 	$strReturn .= ' arranged on it.'; //Quantity is 1. Too much effort for such a little problem for me to solve ~JC
				} elseif($board['functionality'] == 'blank') { //Blank block.
					$strReturn .= 'it to be left blank.'; //All text.
				}
				$strReturn .= '<br>'; //Line break after every board is written out.
			} elseif($key == 1){
				$strReturn .= 'For your second board, you want ';
				if($board['functionality'] == 'text'){
					$strReturn .= "the phrase '";
					$strReturn .= $board['text'];
					$strReturn .= "' written on it in ";
					$strReturn .= $board['font'];
					$strReturn .= '.';	
				} elseif($board['functionality'] == 'accessory') {
				 	$strReturn .= Order::numToEng($board['quantity']);
				 	$strReturn .= ' ';
				 	$strReturn .= $board['accessory'];
				 	$strReturn .= ' arranged on it.';
				} elseif($board['functionality'] == 'blank') {
					$strReturn .= 'it to be left blank.';
				}
				$strReturn .= '<br>';
			} elseif($key == 2){
				$strReturn .= 'For your third board, you want ';
				if($board['functionality'] == 'text'){
					$strReturn .= "the phrase '";
					$strReturn .= $board['text'];
					$strReturn .= "' written on it in ";
					$strReturn .= $board['font'];
					$strReturn .= '.';	
				} elseif($board['functionality'] == 'accessory') {
				 	$strReturn .= Order::numToEng($board['quantity']);
				 	$strReturn .= ' ';
				 	$strReturn .= $board['accessory'];
				 	$strReturn .= ' arranged on it.';
				} elseif($board['functionality'] == 'blank') {
					$strReturn .= 'it to be left blank.';
				}
				$strReturn .= '<br>';
			} elseif($key == 3){
				$strReturn .= 'For your fourth board, you want ';
				if($board['functionality'] == 'text'){
					$strReturn .= "the phrase '";
					$strReturn .= $board['text'];
					$strReturn .= "' written on it in ";
					$strReturn .= $board['font'];
					$strReturn .= '.';	
				} elseif($board['functionality'] == 'accessory') {
				 	$strReturn .= Order::numToEng($board['quantity']);
				 	$strReturn .= ' ';
				 	$strReturn .= $board['accessory'];
				 	$strReturn .= ' arranged on it.';
				} elseif($board['functionality'] == 'blank') {
					$strReturn .= 'it to be left blank.';
				}
				$strReturn .= '<br>';
			} elseif($key == 4){
				$strReturn .= 'For your fifth board, you want ';
				if($board['functionality'] == 'text'){
					$strReturn .= "the phrase '";
					$strReturn .= $board['text'];
					$strReturn .= "' written on it in ";
					$strReturn .= $board['font'];
					$strReturn .= '.';	
				} elseif($board['functionality'] == 'accessory') {
				 	$strReturn .= Order::numToEng($board['quantity']);
				 	$strReturn .= ' ';
				 	$strReturn .= $board['accessory'];
				 	$strReturn .= ' arranged on it.';
				} elseif($board['functionality'] == 'blank') {
					$strReturn .= 'it to be left blank.';
				}
				$strReturn .= '<br>';
			}
		} 
		return $strReturn; //Returns the completed str.
	}

	public static function stringMe($arrboards){
		$strReturn = "";
		foreach($arrboards as $key => $board){
			$strReturn .= ($key + 1);
			$strReturn .= " ";
			$strReturn .= $board['functionality'];
			if($board['functionality'] == 'text'){
				$strReturn .= " ";
				$strReturn .= $board['text'];
			} else if($board['functionality'] == 'accessory'){
				$strReturn .= " ";
				$strReturn .= $board['accessory'];
				$strReturn .= " ";
				$strReturn .= $board['quantity'];
			} else {
			}
			$strReturn .= " ";
		}
		return $strReturn;
	}

public static function validate(){
    $objData = new \stdClass;
    $objData->error      = false;
    $objData->errors     = array();
    $objData->input      = array();
    $objData->msg        = array();
    $objData->success    = null;
    // User posted the form
    if(!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
        $objData->input = $_POST;
        // Validate title
        if(empty(trim($objData->input['custName']))) {
            $objData->error     = true;
            $objData->errors[]  = 'custName';
            $objData->msg[]     = ' - You need to enter your name to move on.';
        }
        if(empty(trim($objData->input['custNum']))) {
            $objData->error     = true;
            $objData->errors[]  = 'custNum';
            $objData->msg[]     = ' - You need to enter your phone number to move on.';
        }
        if(empty(trim($objData->input['custAddr']))) {
            $objData->error     = true;
            $objData->errors[]  = 'custAddr';
            $objData->msg[]     = ' - You need to enter your address to move on.';
        }
        if(empty(trim($objData->input['custCode']))) {
            $objData->error     = true;
            $objData->errors[]  = 'custCode';
            $objData->msg[]     = ' - You need to enter your postal code to move on.';
        }
        if(trim($objData->input['custProv']) == "df") {
            $objData->error     = true;
            $objData->errors[]  = 'custProv';
            $objData->msg[]     = ' - You need to select a province to move on.';
        }
        if(empty(trim($objData->input['custCity']))) {
            $objData->error     = true;
            $objData->errors[]  = 'custCity';
            $objData->msg[]     = ' - You need to enter a city to move on.';
        }
        // No errors then insert the order
     /*   if(!$objData->error) {
            if(!$objBlog->error()) {
                $objData->success = true;
                $objData->msg[]   = 'The blog post was successfully created.';
            }
        }*/
    }
    // Load the view
    return $objData;
}
} // end of class