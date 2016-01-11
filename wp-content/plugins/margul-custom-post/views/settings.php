<form action="" method="POST" autocomplete="off">
	<div class="np-settings clearfix">
		<?php if(!empty($objSettings->message)) { ?>
		<div class="alert <?php echo $objSettings->message['type']; ?>"><?php echo $objSettings->message['msg']; ?></div>
		<?php } ?>

		<div class="clearfix">
			<input type="submit" value="Save" />
		</div>

		<div class="np-heading">Email Settings</div>
		<div class="np-option-wrapper">
			<div class="np-subheading">Admin Email</div>
			<div class="np-content">
				<p>
					Once a payment is successfully completed a notification will be sent to the admin users that a new payment has been made.
					Specify the email addresses below that the email should be sent to. Click the Add button to add another email address.
					<button type="button" id="email-add" class="email-add">Add</button>
				</p>

				<ul class="np-admin-emails">
				<?php
					$bolAppended = false;
					foreach ($objSettings->arrAdminEmails as $key => $email) {
						if($key > 0) $bolAppended = true;
				?>

						<li class="<?php echo ($bolAppended) ? 'admin-email-append' : ''; ?>">
							<ul class="np-options">
								<li class="np-option-title">Email</li>
								<li class="np-option-input">
									<input type="email" name="np_settings_admin_email[]" class="<?php echo ($bolAppended) ? 'np-admin-email-input' : ''; ?>" value="<?php echo $email; ?>" /><?php if($bolAppended) { ?><button type="button" class="np-admin-email-delete">Delete</button><?php } ?>
								</li>
							</ul>
						</li>

					<?php } ?>
				</ul>
			</div>
		</div>


		<div class="np-option-wrapper">
			<div class="np-subheading">Send Customer Email</div>
			<div class="np-content">
				<p>
					Once a payment is successfully completed the system will send out a email to the customer. Here you can specify if that
					should be enabled or disbaled.
				</p>
				<ul class="np-options">
					<li class="np-option-title">Customer Email</li>
					<li class="np-option-input">
						<span class="np-radio"><input type="radio" name="np_settings_customer_email" value="enabled" <?php echo ($objSettings->strSendEmail == 'enabled') ? 'checked' : ''; ?>/> Enabled</span>
						<span class="np-radio"><input type="radio" name="np_settings_customer_email" value="disabled" <?php echo ($objSettings->strSendEmail == 'disabled') ? 'checked' : ''; ?>/> Disabled</span>
					</li>
				</ul>
			</div>
		</div>

		<div class="np-option-wrapper">
			<div class="np-subheading">Customer Email Copy</div>
			<div class="np-content">
				<p>
					Once a payment is successfully completed the system will send out a email to the customer. Here you can specify what content
					will be in that email.
				</p>

				<ul class="np-options">
					<li class="np-option-title">Email Message</li>
					<li class="np-option-input">
						<textarea name="np_settings_email_copy" id="np_settings_email_copy" rows="5" class="text-area"><?php echo $objSettings->strThanksContent; ?></textarea>
					</li>
				</ul>
			</div>
		</div>

		<div class="np-option-wrapper">
			<div class="np-subheading">Custom Thank You Page</div>
			<div class="np-content">
				<p>
				   Once a payment is successfully completed the user will be redirected to a thank you page. If you wish to send the user to a page
				   of your choice please insert the full url here. For example http://www.speedycash.ca/my-custom-thank-you-page/. If this field is
				   left empty it will go to the systems default Thank You page, i.e http://www.speedycash.ca/thank-you/.
				</p>

				<ul class="np-options">
					<li class="np-option-title">Thank You Page URL</li>
					<li class="np-option-input">
						<input type="text" name="np_settings_thank_you_url" id="np_settings_thank_you_url" value="<?php echo $objSettings->strThanksURL; ?>" />
					</li>
				</ul>
			</div>
		</div>

		<div class="clearfix">
			<input type="submit" value="Save" />
		</div>
	</div>
</form>