jQuery(document).ready(function($) {
	$('#checkout-btn').on('click', function(event) {
		var error = false;
		var errorMsg = "You need to fill in your ";

		if(!$('#checkout-name').val()){
			error=true;
			$('#checkout-name').addClass('has-error');
			errorMsg += "name, ";
		} else{
			$('#checkout-name').removeClass('hass-error');
		}
		if(!$('#checkout-address').val()){
			error=true;
			$('#checkout-address').addClass('has-error');
			errorMsg += "address, ";
		} else{
			$('#checkout-address').removeClass('hass-error');
		}
		if(!$('#checkout-province').val()){
			error=true;
			$('#checkout-province').addClass('has-error');
			errorMsg += "province, ";
		} else{
			$('#checkout-province').removeClass('hass-error');
		}
		if(!$('#checkout-city').val()){
			error=true;
			$('#checkout-city').addClass('has-error');
			errorMsg += "city, ";
		} else{
			$('#checkout-city').removeClass('hass-error');
		}
		if(!$('#checkout-phone').val()){
			error=true;
			$('#checkout-phone').addClass('has-error');
			errorMsg += "phone number, ";
		} else{
			$('#checkout-phone').removeClass('hass-error');
		}
		if(!$('#checkout-postal').val()){
			error=true;
			$('#checkout-postal').addClass('has-error');
			errorMsg += "postal code, ";
		} else{
			$('#checkout-postal').removeClass('hass-error');
		}

		errorMsg += "before you can move on.";

		if(error == true) {
			event.defaultPrevented;
			alert(errorMsg);
		}
	});
});