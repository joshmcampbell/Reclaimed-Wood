<?php

if( ! defined( 'ABSPATH' ) ) exit;

class Cuztom_Field_Readonly extends Cuztom_Field
{
	var $_supports_repeatable 	= true;
	var $_supports_bundle		= true;
	var $_supports_ajax			= true;

	var $css_classes			= array( 'cuztom-input' );

	function _output( $value )
	{
		if(!isset($this->options) || !isset($this->options['meta_field']) || empty($this->options['meta_field'])){
			// no value to show
			return '';
		}

		global $post;

		$metaValue = get_post_meta($post->ID, $this->options['meta_field'], true);

		$value = $metaValue . ' <input type="hidden" name="cuztom[' . $this->name . ']" id="' . $this->id . '" value="' . $metaValue . '" />';

		if(empty($metaValue)) {
			return '';
		}

		if(isset($this->options) || isset($this->options['type']) && !empty($this->options['type'])){
			// Deal with special types
			switch(strtolower($this->options['type'])){
				case 'encrypted':
					$encKey 		= pack('H*', NM_ENCRYPTION_KEY);
					$ciphertext_dec = base64_decode($metaValue);
					$iv_size 		= mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
					$iv_dec 		= substr($ciphertext_dec, 0, $iv_size);
					$ciphertext_dec = substr($ciphertext_dec, $iv_size);
					$plaintext_dec  = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $encKey, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

					$value = $plaintext_dec;
				break;
				case 'currency':
					$value = '$' . number_format((float)$metaValue, 2);
				break;
				case 'payment_option':
					$value = get_term($metaValue, 'payment_options')->name;
				break;
			}
		}

		return $value;
	}

	function do_htmlspecialchars( &$value )
	{
		$value = htmlspecialchars( $value );
	}
}