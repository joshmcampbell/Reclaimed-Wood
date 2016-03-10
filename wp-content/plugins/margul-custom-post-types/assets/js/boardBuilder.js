/*
	
	Board Builder JavaScript

 */
jQuery(document).ready(function($) {

	/*
		This is our board builder object. The constructor is called after the object with
		boardBuilder.init(). So the constructor function in this object is the init where
		we grab the data and set up our events.
	 */
	var boardBuilder = (function() {

		// The data for the board builder
		var data = {};
		// Board id. Used to keep each board unique
		var boardID = 0;
		// The number of active boards in the DOM
		var boardNumber = 1;
		// The URL for doing ajax request
		var ajaxUrl = $('#ajax-url').html();
		// jQuery object for body DOM element. We are caching the body element here so 
		// we don't have to keep on accessing the DOM element (unnecessary requests)
		var $body = $('body');
		// jQuery object for the att board button
		var addBtn = $body.find('#boardAdd');
		// jQuery object for the accordion (where all the boards are placed)
		var accWrap = $body.find('#accordion');
 		// The current discount applied by coupons, default to 0
 		var discount = 0;
 		// jQuery object for the 'Enter Discount' button
 		var disBtn = $body.find('#couponBtn');
 		// The preview object that gets passed in the constructor
 		var objPreview = {};
		
		/*
			Constructor function for the object
		 */
		var init = function(objPrev) {

			// AJAX call to grab all the data for the board
			getData();

			objPreview = objPrev;
			
			// Event for when clicking the add board button
			addBtn.on('click', addBoard);
			// Event for deleting a board
			$body.on('click', '.board-delete', deleteBoard);
			// Event for when you change the functionality for a board
			$body.on('change', '.board-func', injectBoardFunctionality);
			// Event for when you change the accessory type
			$body.on('change', '.accessory-type', accessoryChange);
			// Event for when you change the accesory quantity
			$body.on('change', '.accessory-qty', updateAccessoryQty);
			// Event for updating the text on a board
			$body.on('keyup', '.board-text', boardTextUpdate)
			// Event for when the discount button is pressed.
			disBtn.on('click', addDiscount);
		}

		/*
			Function to grab all the data
		 */
		var getData = function() {
			$.ajax({
				url: ajaxUrl,
				'method': 'POST',
				'dataType': 'JSON',
				'data': {
					action: 'bb_get_data'
				},
				success: function(response) {
					data = response;
					updateCost();
				}
			});
		}

		/*
			Function for adding a board.
		 */
		var addBoard = function() {
			// If number of boards active is more the the maximum allowed. Just return.
			if(boardNumber >= data.maxBoardAmount) {
				return;
			}

			// Increment the board ID and the board number
			boardID++;
			boardNumber++;

			strHtml = '';
			strHtml += '<div class="panel panel-default">';
			strHtml +=  	'<div class="panel-heading" role="tab" id="heading' + boardID+ '">';
			strHtml +=      	'<h4 class="panel-title">';
			strHtml +=        		'<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' + boardID + '" aria-expanded="true" aria-controls="collapse' + boardID +'">';
			strHtml +=          		'Board #<span class="board-nr">' + boardNumber + '</span>';
			strHtml +=        		'</a>';
			strHtml += 				'<button type="button" class="btn btn-danger pull-right board-delete">X</button>';
			strHtml +=      	'</h4>';
			strHtml +=    	'</div>';
			strHtml +=    	'<div id="collapse' + boardID + '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' + boardID + '">';
			strHtml +=      	'<div class="panel-body">';
			strHtml +=				'<div class="form-group">';
			strHtml +=	        		'<label>Board Functionality</label>';
			strHtml +=	        		'<select name="boards[' + boardID + '][functionality]" class="form-control board-func" data-id="' + boardID + '">';
			strHtml +=	        			'<option value="blank">Blank</option>';
			strHtml +=	        			'<option value="text">Text</option>';
			strHtml +=	        			'<option value="accessory">Accessories</option>';
			strHtml +=	        		'</select>';
			strHtml +=	        	'</div>';
			strHtml +=	        	'<div class="board-func-data"></div>';
			strHtml +=      	'</div>';
			strHtml +=    	'</div>';
			strHtml +=  '</div>';

			// Inject the board html
			accWrap.append(strHtml);

			// If the board number is greater then or equal to the maximum boards allowed then
			// disabled the add board button.
			if(boardNumber >= data.maxBoardAmount) {
				addBtn.prop('disabled', true);
			}

			updateCost();

			objPreview.addBoard();

		};

		/*
			Function for deleting a board.
		 */
		var deleteBoard = function() {
			// Grab the index of the board for the objPreview
			var index = $(this).closest('.panel').index();
			// Call the objPreview API and delete the board
			objPreview.deleteBoard(index);
			// Decrement the amount of boards
			boardNumber--;
			// Remove the board panel from the DOM
			$(this).closest('.panel').remove();
			// if you have less boards active then the maxAmount set the addbutton to enabled again.
			if(boardNumber < data.maxBoardAmount) {
				addBtn.prop('disabled', false);
			}
			// Update the board numbers and make sure that they are correct
			updateBoardNumbers();
			// Update the cost after a board has been deleted
			updateCost();
		};

		/*
			Inject the correct board options based on the functionality of the board
		 */
		var injectBoardFunctionality = function() {
			// Grab the index of the board for the objPreview
			var index = $(this).closest('.panel').index();

			switch($(this).val()) {
				case 'text':
					addTextOption($(this));
					// Call the objPreview module to update
					objPreview.setTextOptions(index);
					break;
				case 'accessory':
					addAccessoryOption($(this));
					// Call the objPreview module to update
					objPreview.setAccessoryOption(index, 
						getAccessoryImage($(this)), 
						parseInt($(this).closest('.panel').find('.accessory-qty').val()));
					break;
				case 'blank':
					deleteBoardOptions($(this));
					objPreview.deleteOptions(index);
					break;
			}
		}

		/*
			Inject text option for the board.
		 */
		var addTextOption = function(objThis) {
			// Grab the ID for the board
			var boardID = parseInt(objThis.data('id'));
			// The option container where we will be injecting the html
			var boardOptionContainer = objThis.closest('.panel-body').find('.board-func-data');

			var strHtml = '';
			strHtml += '<div class="form-group">';
			strHtml += 	'<label>Font</label>';
			strHtml += 	'<select name="boards[' + boardID + '][font]" class="form-control">';
		
			// Get all the fonts from the data object and put them in the select box 
			$.each(data.fonts, function(index, value) {
				strHtml += '<option value="' + value + '">' + value + '</option>';
			});

			strHtml +=   '</select>';
			strHtml += '</div>';
			strHtml += '<div class="form-group">';
			strHtml +=   '<label>Text (max 16 chars)</label>';
			strHtml += 	'<input name="boards[' +  boardID + '][text]" type="text" class="form-control board-text" maxlength="' + data.maxTextCharacters + '">';
			strHtml += '</div>';

			// Inject the HTML into the options container
			boardOptionContainer.html(strHtml);
		}

		/*
			Function for when the board text is changed. Will call the preview Module
			and set the text for that board. On keyUp event.
		 */
		var boardTextUpdate = function() {
			// Grab the index of the board for the objPreview
			var index = $(this).closest('.panel').index();

			// Call preview module with index and the text value
			objPreview.updateText(index, $(this).val());
		} 

		/*
			Inject accessory options for the board
		 */
		var addAccessoryOption = function(objThis) {
			// Get the ID for the board
			var boardID = parseInt(objThis.data('id'));
			// The option container where we will be injecting the html
			var boardOptionContainer = objThis.closest('.panel-body').find('.board-func-data');

			var strHtml = '';
			strHtml += '<div class="form-group">';
			strHtml += 	'<label>Type</label>';
			strHtml += 	'<select name="boards[' +  boardID + '][accessory]" class="form-control accessory-type">';
			
			// Loop through all the accessories from the data object and put them into the
			// accessories select box.
			$.each(data.accessories, function(index, value) {
				strHtml += '<option value="' + value.name + '">' + value.name + '</option>';
			});

			strHtml +=   '</select>';
			strHtml += '</div>';
			strHtml += '<div class="form-group">';
			strHtml +=   '<label>Quantity</label>';
			strHtml +=   '<select name="boards[' +  boardID + '][quantity]" class="form-control accessory-qty">';

			// For the quantity use the first accessoriy type on creation. This will be updated
			// if the user selects a new accessory type to reflect that type's maximum amount.
			var selected = '';
			for(var i = 1; i <= data.accessories[0].maxAmt; i++) {
				selected = (i == data.accessories[0].maxAmt) ? 'selected' : '';
				strHtml += '<option value="' + i + '" ' + selected +'>' + i + '</option>';
			}

			strHtml += 	'</select>';
			strHtml += '</div>';

			// Inject the HTML into the options container.
			boardOptionContainer.html(strHtml);
		}

		/*
			Delete board options. Used for when the user selects blank as a functionality for the board.
			You can pass in and jQuery object that is in the same board.
		 */
		var deleteBoardOptions = function(objThis) {
			// Just find the board-func-data class where the options are and set it to empty.
			objThis.closest('.panel').find('.board-func-data').html('');
		}

		/*
			Function that gets run when you change accessory type
		 */
		var accessoryChange = function() {
			// Update the quantity to reflect the new accessory
			updateMaxAmount($(this));

			// Get the index of the board
			var index = $(this).closest('.panel').index();
			// Get the image associated with this accessory
			var image = getAccessoryImage($(this));
			// Get the quantity selected
			var qty   = $(this).closest('.panel').find('.accessory-qty').val();

			// Call preview API to update;
			objPreview.setAccessoryOption(index, image, qty);
		}

		/*
			Update the maximum quantity amount for a accessory type. Used when a user changes the accessory type.
		 */
		var updateMaxAmount = function(objThis) {
			// Start with 1 as a max amount
			var maxAmt = 1;
			// The accessories type selected
			var accessoryType = objThis.closest('.panel').find('.accessory-type').val();
			// The jQuery quantity selectbox.
			var objQty = objThis.closest('.panel').find('.accessory-qty');

			// Loop through the data.accessories until you are at the accessory they selected.
			$.each(data.accessories, function(index, value) {
				if(value.name == accessoryType) {
					// Once found set the maxAmt to the maximum amount for that accessory type.
					maxAmt = parseInt(value.maxAmt);
					return;
				}
			});

			// Create the options to reflect the new accessory's maximum amount
			var strHtml = '';
			var selected = '';
			for(var i = 1; i <= maxAmt; i++) {
				selected = (maxAmt == i) ? 'selected' : '';
				strHtml += '<option value="' + i + '" ' + selected + '>' + i +'</option>';
			}

			// Inject the HTML for the quantity select box
			objQty.html(strHtml);
		}

		/*
			Update the accessory quantity amount
		 */
		var updateAccessoryQty = function() {
			// Grab the index of where to change the qty
			var index = $(this).closest('.panel').index();
			// Get the image associated with the accessory
			var image = getAccessoryImage($(this));
			// Grab the quantity
			var qty = $(this).val();
			// Call the preview API to update the board
			objPreview.setAccessoryOption(index, image, qty);
		}

		/*
			Update the board numbers to be correct in ascending order.
		 */
		var updateBoardNumbers = function() {
			// Get all the boards
			var arrPanels = $body.find('.panel');

			// Loop through all the current active boards.
			for(var i = 1; i <= arrPanels.length; i++) {
				// Set the board number to be the correct increment.
				$(arrPanels[i - 1]).find('.board-nr').html(i);
			}

		}

		/*
			Function to get the image for an accessory. Pass in any jQuery object
			that is within the board DOM element.
		 */
		var getAccessoryImage = function(objThis) {
			var acc = objThis.closest('.panel').find('.accessory-type').val();
			var img = '';

			$.each(data.accessories, function(index, value) {
				if(value.name == acc) {
					img = value.image;;
				}
			});

			return img;
		}

		/*
			Function to apply discount code
		*/
		var addDiscount = function(){
			var code = $('#couponTB').val();
			var found = false; // Flag
			$.each(data.coupons, function(index, value) {
				if(value.code == code) {
					// Sets the discount to the percent associated with the user code
					discount = parseFloat(value.percent);
					found = true;
					return;	
				}
			});
			if (found==false){ // If no coupon is found, send an error message
				alert('Invalid coupon code');
				return;
			}
			updateCost();
		}

		/*
			Function to reset the cost
		*/
		var updateCost = function(){
			var price = 0.0;
			$.each(data.prices, function(index, value) {
				if(value.amount == boardNumber) {
					// Sets price variable to the associated cost for the amount of boards.
					price = parseFloat(value.price);
					return;	
				}
			});
			// Set price textbox to the calculated cost, with additional formatting
			$body.find('#price').val('$' + price.toFixed(2));

		}	

		/*
			Our object will just return one function called init. This function will call the
			objects init function (constructor) and set everything up.
		 */
		return {
			init: function(objPrev) {
				init(objPrev);
			}
		}

	})();

	var boardPreview = (function() {

		// Cache the preview wrapper element so we don't have to keep accessing it.
		var $preview = $('.preview-wrapper');
		var $ul = $preview.find('.preview-ul');

		// Set up the event for a hover to call the boardbuilder return API.

		function buildAccessoryHTML(img, qty) {
			
			var width = 'width:' + parseFloat(100 / qty) + '%; ';
			var image = "background-image: url('" + img + "');";

			var strHTML = '';
			strHTML += '<ul class="acc-wrap">';

			for (var i = 1; i <= qty; i++) {
				strHTML += '<li style="' + width + image + '"></li>';
			}

			strHTML += '</ul>';

			return strHTML;
		}

		return {
			addBoard: function() {
				$ul.append('<li class="board blank-functionality"></li>');
			},
			deleteBoard: function(index) {
				$ul.find('li').eq(index).remove();			
			},
			setTextOptions: function(index) {
				$ul.find('li').eq(index).removeClass().addClass('board text-functionality').html('');
			},
			setAccessoryOption: function(index, img, qty) {
				$ul.find('li').eq(index).removeClass().addClass('board accessory-functionality')
									    .html(buildAccessoryHTML(img, qty));
			},
			deleteOptions: function(index) {
				$ul.find('li').eq(index).removeClass().addClass('board blank-functionality').text('');
			},
			updateText: function(index, text) {
				$ul.find('li').eq(index).text(text);
			},
			changeAccessoryQty: function(index, img, qty) {
				$ul.find('li').eq(index).html(buildAccessoryHTML(img, qty));
			},
		}

	})();

	// Call the boardBuilder init function to set up the builder.
	// Pass in the preview object because it will be used as an API to the preview module.
	boardBuilder.init(boardPreview);
});