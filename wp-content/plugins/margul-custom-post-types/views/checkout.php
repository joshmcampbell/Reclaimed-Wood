

<script type="text/javascript" src="/wp-content/plugins/margul-custom-post-types/assets/js/script-front.js">
	function();
</script>


<?php 
	$objData = Order::processForm();
?>
<div class="row">
	<div class="col-xs-12" >
		<?php if($objData->error) { ?>
            <div class="alert-danger" role="alert"><strong>You seem to be missing something:</strong><br><?php echo implode('<br>', $objData->msg); ?></div>
        <?php } ?>
		<h3>You're almost finished!</h3>
		<div>
			But first, let's review:
			<div class="order-summary">
				<h3>Order Summary</h3>
				<?php echo Order::boardToEng($objData->boards); ?>
			</div>
			<form action="" method="POST">
			Is there anything more specific you'd like to add?
			<div class="form-group">
				<textarea class="form-control" name="custComm" rows="4"><?php echo ($objData->error) ? $objData->input['custComm'] : ''; ?></textarea>
			</div>
		</div>
		<div>
			<div>
				<font size="15"><b>Shipping Details:</b></font>	
				<br>
				<font size="1"><i>* denotes required fields.</i></font>
			</div>
			<br>

                <div class="form-group clearfix <?php echo (in_array('custName', $objData->errors)) ? 'has-error' : ''; ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<label for="custName">Full Name <span class="req">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<input type="text" name="custName" class="form-control" value="<?php echo ($objData->error) ? $objData->input['custName'] : ''; ?>">
						</div>
					</div>
				</div>

				<div class="form-group clearfix <?php echo (in_array('custEmail', $objData->errors)) ? 'has-error' : ''; ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<label for="custEmail">Email <span class="req">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<input type="email" name="custEmail" class="form-control" value="<?php echo ($objData->error) ? $objData->input['custEmail'] : ''; ?>">
						</div>
					</div>
				</div>

				<div class="form-group clearfix <?php echo (in_array('custAddr', $objData->errors)) ? 'has-error' : ''; ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<label for="custAddr">Address <span class="req">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<input type="text" name="custAddr" class="form-control" value="<?php echo ($objData->error) ? $objData->input['custAddr'] : ''; ?>">
						</div>
					</div>
				</div>

				<div class="form-group clearfix <?php echo (in_array('custProv', $objData->errors)) ? 'has-error' : ''; ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<label for="custProv">Province <span class="req">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<select name="custProv" class="form-control">
					       		<option>===Select Province===</option>  
					      		<option value="Alberta" <?php echo ($objData->error && $objData->input['custProv'] == 'Alberta') ? 'selected' : ''; ?>>Alberta</option>
					       		<option value="British Columbia"<?php echo ($objData->error && $objData->input['custProv'] == 'British Columbia') ? 'selected' : ''; ?>>British Columbia</option>
					       		<option value="Ontario" <?php echo ($objData->error && $objData->input['custProv'] == 'Ontario') ? 'selected' : ''; ?>>Ontario</option>
					       		<option value="Quebec" <?php echo ($objData->error && $objData->input['custProv'] == 'Quebec') ? 'selected' : ''; ?>>Quebec</option>
					       		<option value="Manitoba" <?php echo ($objData->error && $objData->input['custProv'] == 'Manitoba') ? 'selected' : ''; ?>>Manitoba</option>
				        		<option value="New Brunswick" <?php echo ($objData->error && $objData->input['custProv'] == 'New Brunswick') ? 'selected' : ''; ?>>New Brunswick</option>
				        		<option value="Nova Scotia" <?php echo ($objData->error && $objData->input['custProv'] == 'Nova Scotia') ? 'selected' : ''; ?>>Nova Scotia</option>
				        		<option value="Saskatchewan" <?php echo ($objData->error && $objData->input['custProv'] == 'Saskatchewan') ? 'selected' : ''; ?>>Saskatchewan</option>
				        		<option value="Prince Edward Island" <?php echo ($objData->error && $objData->input['custProv'] == 'Prince Edward Island') ? 'selected' : ''; ?>>Prince Edward Island</option>
				        		<option value="Newfoundland and Labrador" <?php echo ($objData->error && $objData->input['custProv'] == 'Newfoundland and Labrador') ? 'selected' : ''; ?>>Newfoundland and Labrador</option>
					        </select>
						</div>
					</div>
				</div>

				<div class="form-group clearfix <?php echo (in_array('custCity', $objData->errors)) ? 'has-error' : ''; ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<label for="custCity">City <span class="req">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<input type="text" name="custCity" class="form-control" value="<?php echo ($objData->error) ? $objData->input['custCity'] : ''; ?>">
						</div>
					</div>
				</div>

				<div class="form-group clearfix <?php echo (in_array('custCode', $objData->errors)) ? 'has-error' : ''; ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<label for="custCode">Postal Code <span class="req">*</span></label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<input type="text" name="custCode" class="form-control" value="<?php echo ($objData->error) ? $objData->input['custCode'] : ''; ?>">
						</div>
					</div>
				</div>

				<div class="form-group clearfix <?php echo (in_array('custNum', $objData->errors)) ? 'has-error' : ''; ?>">
					<div class="row">
						<div class="col-xs-12 col-sm-4">
							<label for="custNum">Phone Number</label>
						</div>
						<div class="col-xs-12 col-sm-8">
							<input type="text" name="custNum" class="form-control" value="<?php echo ($objData->error) ? $objData->input['custNum'] : ''; ?>">
						</div>
					</div>
				</div>

				<div class="form-group">
				<br>
                <div class="full-width alert" id="alertDiv">
                </div>
					<input type="hidden" name="check_boards" value='<?php echo json_encode($objData->boards); ?>'/>
				</div>
				<div class="alt-width right">
				<br>
					<input type="submit" class="btn btn-continue half-width left" id="checkout-btn" name="checkout" value="Checkout">
					<input type="button" id="return" class="btn btn-return half-width right" value="Return">
 				</div>		
			</form>
		</div>
	</div>
</div>