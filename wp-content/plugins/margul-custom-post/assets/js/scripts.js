jQuery(document).ready(function($) {

	$('#email-add').on('click', function() {
		var email_list = $('.np-admin-emails');
		var html  = '';
			html += '<li class="admin-email-append"><ul class="np-options"><li class="np-option-title">Email</li>';
			html += '<li class="np-option-input">';
			html += '<input type="email" name="np_settings_admin_email[]" class="np-admin-email-input" />';
			html += '<button type="button" class="np-admin-email-delete">Delete</button>';
			html += '</li></ul></li>';

		email_list.append(html);
	});

	$('.np-admin-emails').delegate('.np-admin-email-delete', 'click', function() {
		$(this).closest('.admin-email-append').remove();
	});
});