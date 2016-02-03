<?php if(!empty($objForm->message)) { ?>
	<div class="alert <?php echo $objForm->message['type']; ?>" role="alert"><?php echo $objForm->message['msg']; ?></div>
<?php } ?>
<div class="alert alert-danger alert-hidden"></div>
<form action="" method="POST" autocomplete="off">

	<input type="hidden" name="url" id="url" value="" />

	<label for="first_name">First Name <span class="required">*</span></label>
	<input type="text" name="first_name" id="first_name"
		   class="form-input form-big <?php echo ($objForm->error && in_array('first_name', $objForm->errors)) ? 'error' : ''; ?>"
		   value="<?php echo ($objForm->error) ? $objForm->input['first_name'] : ''; ?>" />

	<label for="last_name">Last Name <span class="required">*</span></label>
	<input type="text" name="last_name" id="last_name"
	       class="form-input form-big <?php echo ($objForm->error && in_array('last_name', $objForm->errors)) ? 'error' : ''; ?>"
	       value="<?php echo ($objForm->error) ? $objForm->input['last_name'] : ''; ?>" />

	<label for="phone">Phone Number <span class="required">*</span></label>
	<input type="text" name="phone" id="phone"
	       class="form-input form-big <?php echo ($objForm->error && in_array('phone', $objForm->errors)) ? 'error' : ''; ?>"
	       value="<?php echo ($objForm->error) ? $objForm->input['phone'] : ''; ?>" />

	<label for="email">Email <span class="required">*</span></label>
	<input type="email" name="email" id="email"
	       class="form-input form-big  <?php echo ($objForm->error && in_array('email', $objForm->errors)) ? 'error' : ''; ?>"
	       value="<?php echo ($objForm->error) ? $objForm->input['email'] : ''; ?>" />

	<label for="ss_number">Social Security Number</label>
	<input type="text" name="ss_number" id="ss_number" class="form-input form-big"
	       value="<?php echo ($objForm->error) ? $objForm->input['ss_number'] : ''; ?>" />

	<label for="province">Province</label>
	<select name="province" id="province" class="form-input">
		<?php echo Nav_Payments::provinces_html($objForm->input['province']); ?>
	</select>

	<label for="amount">Re-payment Amount <span class="required">*</span></label>
	<input type="text" name="amount" id="amount"
	       class="form-input <?php echo ($objForm->error && in_array('amount', $objForm->errors)) ? 'error' : ''; ?>"
	       value="<?php echo ($objForm->error) ? $objForm->input['amount'] : ''; ?>" />

	<label for="payment_option">Payment Options</label>
	<select name="payment_option" id="payment_option" class="form-input">
		<?php echo Nav_Payments::payment_options_html($objForm->input['payment_option']); ?>
	</select>


	<input type="submit" value="Submit" class="nav-payment-submit" />
</form>