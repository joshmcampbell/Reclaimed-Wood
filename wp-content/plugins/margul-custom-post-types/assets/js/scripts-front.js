jQuery(document).ready(function($) {
	var error = false;
	$('#checkout-name').on('keypress', function(event) {
		error = false;
		document.getElementById("nameDiv").style.color="black";
	});
	$('#checkout-address').on('keypress', function(event) {
		error = false;
		document.getElementById("addressDiv").style.color="black";
	});
	$('#checkout-province').on('change', function(event) {
		error = false;
		document.getElementById("provinceDiv").style.color="black";
	});
	$('#checkout-city').on('keypress', function(event) {
		error = false;
		document.getElementById("cityDiv").style.color="black";
	});
	$('#checkout-phone').on('keypress', function(event) {
		error = false;
		document.getElementById("phoneDiv").style.color="black";
	});
	$('#checkout-postal').on('keypress', function(event) {
		error = false;
		document.getElementById("postalDiv").style.color="black";
	});

	$('#checkout-btn').on('click', function(event) {
		var errorMsg = "You need to fill in your ";

		if(!$('#checkout-name').val()){
			error=true;
			document.getElementById("nameDiv").style.color="red";
			$('#checkout-name').addClass('has-error');
			errorMsg += "name, ";
		} else{
			$('#checkout-name').removeClass('hass-error');
		}
		if(!$('#checkout-address').val()){
			error=true;
			document.getElementById("addressDiv").style.color="red";
			$('#checkout-address').addClass('has-error');
			errorMsg += "address, ";
		} else{
			$('#checkout-address').removeClass('hass-error');
		}
		if($('#checkout-province').val() == 'df'){
			error=true;
			document.getElementById("provinceDiv").style.color="red";
			$('#checkout-province').addClass('has-error');
			errorMsg += "province, ";
		} else{
			$('#checkout-province').removeClass('hass-error');
		}
		if(!$('#checkout-city').val()){
			error=true;
			document.getElementById("cityDiv").style.color="red";
			$('#checkout-city').addClass('has-error');
			errorMsg += "city, ";
		} else{
			$('#checkout-city').removeClass('hass-error');
		}
		if(!$('#checkout-phone').val()){
			error=true;
			document.getElementById("phoneDiv").style.color="red";
			$('#checkout-phone').addClass('has-error');
			errorMsg += "phone number, ";
		} else{
			$('#checkout-phone').removeClass('hass-error');
		}
		if(!$('#checkout-postal').val()){
			error=true;
			document.getElementById("postalDiv").style.color="red";
			$('#checkout-postal').addClass('has-error');
			errorMsg += "postal code, ";
		} else{
			$('#checkout-postal').removeClass('hass-error');
		}

		errorMsg += "before you can move on.";

		if(error == true) {
			event.preventDefault();
			return false;
			strHtml = "";
			strHtml += "<br>";
			strHtml += errorMsg;
			strHtml += "<br>";
			document.getElementById("alertDiv").append(strHtml);
		}
	});
});