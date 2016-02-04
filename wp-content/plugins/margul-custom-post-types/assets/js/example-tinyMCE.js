// closure to avoid namespace collision
(function(){

	// Grab our vars from metas in the header
	var plugin_path   	= jQuery('#nm-plugin-path').attr('value');
	var plugin_dir    	= jQuery('#nm-plugin-dir').attr('value');
	var post_type		= 'example';
	var label_name      = 'Example Post Type';

	// creates the plugin
	tinymce.create('tinymce.plugins.nav_shortcode', {
		// creates control instances based on the control's id.
		createControl : function(id, controlManager) {
			if (id == 'nm_shortcode_button') {
				// creates the button
				var button = controlManager.createButton('nm_shortcode_button', {
					title : label_name+' Shortcode', // title of the button
					image : plugin_path+'/assets/images/tinyMCE-icon.png', // path to the button's image
					onclick : function() {
						// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show(label_name+' Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=nav-shortcode-html' );
					}
				});
				return button;
			}
			return null;
		}
	});

	// registers the plugin.
	tinymce.PluginManager.add('nav_shortcode', tinymce.plugins.nav_shortcode);

	// executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form;
		jQuery.ajax({
			type: "GET",
			url: plugin_path+'/views/'+post_type+'/_shortcode_form.php',
			async: false,
			dataType: "html",
			success: function(html) {
				form = jQuery(html);
			}
		});

		var table = form.find('table');
		form.appendTo('body').hide();

		// handles the click event of the submit button
		form.find('#nav-shortcode-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless

			var options = {
				'id'         : '',
				'cat_id'     : '',
				'cols'       : '',
			};
			var shortcode = '[nm_boats';

			for(var option in options) {
				// creates an array of selected values
				var values = jQuery('.nav-shortcode-'+option).map(function() {
								// if the the option is a
								if (!jQuery(this).is('input[type=checkbox]') || jQuery(this).is(':checked')) {
									return jQuery(this).val();
								}
							}).get();

				// make a comma separated list of the ids
				value = values.join();

				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[option] ) {
					console.log(value);
					shortcode += ' ' + option + '="' + value + '"';
				}
			}

			shortcode += ']';

			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);

			// closes Thickbox
			tb_remove();
			// Reset the inputs for next time
			jQuery('#nav-shortcode-form')[0].reset();
		});
	});
})()