
<script type="text/javascript" src="/wp-content/plugins/margul-custom-post-types/assets/js/script-front.js">
	function();
</script>

<div class="row">
	<div class="col-xs-12" >
		<h3>You're almost finished!</h3>
		<div>
			But first, let's review:
			<div>
				<br>
				<?php echo Order::boardToEng($_POST['boards']); ?>
				<br>
			</div>
			<form class="form-horizontal form-inline" action="" method="POST">
			Is there anything more specific you'd like to add?
			<div class="full-width order-div">
				<textarea class="full-width" name="custComm" rows="4">
				</textarea>
			</div>
		</div>
		<div>
			<div>
				<font size="15"><b>Shipping Details:</b></font>	
				<br>
				<font size="1"><i>* denotes required fields.</i></font>
			</div>
			<br>
				<div id="nameDiv" class="form-group order-div <?php echo (in_array('custName', $objData->errors)) ? 'has-error' : ''; ?>">
					Full Name*:
					<input type="text" id="checkout-name" name="custName" class="right alt-width" value="<?php echo ($objData->error) ? $objData->input['custName'] : ''; ?>">
				</div>
				<div id="addressDiv" class="form-group order-div <?php echo (in_array('custAddr', $objData->errors)) ? 'has-error' : ''; ?>">
					Address*:
					<input type="text" id="checkout-address" name="custAddr" class="right alt-width" value="<?php echo ($objData->error) ? $objData->input['custAddr'] : ''; ?>">
				</div>
				<div class="form-group order-div">
					Address (line 2):
					<input type="text" id="checkout-addr2"name="custAddr2" class="right alt-width" value="<?php echo ($objData->error) ? $objData->input['custAddr2'] : ''; ?>">
				</div>
				<div id="provinceDiv" class="form-group order-div <?php echo (in_array('custProv', $objData->errors)) ? 'has-error' : ''; ?>">
					Province*:
					<select name="custProv" id="checkout-province" class="form-control board-func right alt-width" data-id="0" value="<?php echo ($objData->error) ? $objData->input['custProv'] : ''; ?>">
			       		<option value="df">===Select Province===</option>  
			      		<option value="al">Alberta</option>
			       		<option value="bc">British Columbia</option>
			       		<option value="on">Ontario</option>
			       		<option value="qb">Quebec</option>
			       		<option value="ma">Manitoba</option>
		        		<option value="nb">New Brunswick</option>
		        		<option value="ns">Nova Scotia</option>
		        		<option value="sa">Saskatchewan</option>
		        		<option value="pe">Prince Edward Island</option>
		        		<option value="nl">Newfoundland and Labrador</option>
			        </select>
				</div>
				<div id="cityDiv" class="form-group order-div <?php echo (in_array('custCity', $objData->errors)) ? 'has-error' : ''; ?>">
					City*:
					<input type="text" id="checkout-city" name="custCity"  class="right alt-width" value="<?php echo ($objData->error) ? $objData->input['custCity'] : ''; ?>">
				</div>
				<div id="phoneDiv" class="form-group order-div <?php echo (in_array('custNum', $objData->errors)) ? 'has-error' : ''; ?>">
					Phone Number*:
					<input type="text" id="checkout-phone" name="custNum" class="right alt-width" value="<?php echo ($objData->error) ? $objData->input['custCustNum'] : ''; ?>">
				</div>
				<div id="postalDiv" class="form-group order-div <?php echo (in_array('custCode', $objData->errors)) ? 'has-error' : ''; ?>">
					Postal Code*:
					<input type="text" id="checkout-postal" name="custCode" class="right alt-width" maxlength="6" value="<?php echo ($objData->error) ? $objData->input['custCode'] : ''; ?>">
				</div>
				<div class="form-group">
					<input type="hidden" id="hidden-field-boards" name="board" value="<?php json_encode($_POST['boards']); ?>"/>
				</div>
                <div class="full-width" id="alertDiv">
                </div>
				<div class="alt-width right">
				<br>
					<input type="submit" id="checkout-btn" class="btn btn-continue half-width left" value="Checkout">
					<input type="button" id="return-btn" class="btn btn-return half-width right" value="Return">
 				</div>		
			</form>
		</div>
	</div>
</div>