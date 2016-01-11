<?php

if( ! defined( 'ABSPATH' ) ) exit;

/**
 * General class with main methods and helper methods
 *
 * @author 	Gijs Jorissen
 * @since 	0.2
 *
 */
class Cuztom
{
	static $_reserved = array( 'attachment', 'attachment_id', 'author', 'author_name', 'calendar', 'cat', 'category','category__and', 'category__in', 'category__not_in',
		'category_name', 'comments_per_page', 'comments_popup', 'cpage', 'day', 'debug', 'error', 'exact', 'feed', 'hour', 'link_category',
		'm', 'minute', 'monthnum', 'more', 'name', 'nav_menu', 'nopaging', 'offset', 'order', 'orderby', 'p', 'page', 'page_id', 'paged', 'pagename', 'pb',
		'perm', 'post', 'post__in', 'post__not_in', 'post_format', 'post_mime_type', 'post_status', 'post_tag', 'post_type',
		'posts', 'posts_per_archive_page', 'posts_per_page', 'preview', 'robots', 's', 'search', 'second', 'sentence', 'showposts',
		'static', 'subpost', 'subpost_id', 'tag', 'tag__and', 'tag__in','tag__not_in', 'tag_id', 'tag_slug__and', 'tag_slug__in', 'taxonomy',
		'tb', 'term', 'type', 'w', 'withcomments', 'withoutcomments', 'year' );

	/**
	 * Beautifies a string. Capitalize words and remove underscores
	 *
	 * @param 	string 			$string
	 * @return 	string
	 *
	 * @author 	Gijs Jorissen
	 * @since 	0.1
	 *
	 */
	static function beautify( $string )
	{
		return apply_filters( 'cuztom_beautify', ucwords( str_replace( '_', ' ', $string ) ) );
	}

	/**
	 * Uglifies a string. Remove strange characters and lower strings
	 *
	 * @param 	string 			$string
	 * @return 	string
	 *
	 * @author 	Gijs Jorissen
	 * @since 	0.1
	 *
	 */
	static function uglify( $string )
	{
		return apply_filters( 'cuztom_uglify', str_replace( '-', '_', sanitize_title( $string ) ) );
	}

	/**
	 * Makes a word plural
	 *
	 * @param 	string 			$string
	 * @return 	string
	 *
	 * @author 	Gijs Jorissen
	 * @since 	0.1
	 *
	 */
	static function pluralize( $string )
	{
		$plural = array(
			array( '/(quiz)$/i',               "$1zes"   ),
			array( '/^(ox)$/i',                "$1en"    ),
			array( '/([m|l])ouse$/i',          "$1ice"   ),
			array( '/(matr|vert|ind)ix|ex$/i', "$1ices"  ),
			array( '/(x|ch|ss|sh)$/i',         "$1es"    ),
			array( '/([^aeiouy]|qu)y$/i',      "$1ies"   ),
			array( '/([^aeiouy]|qu)ies$/i',    "$1y"     ),
			array( '/(hive)$/i',               "$1s"     ),
			array( '/(?:([^f])fe|([lr])f)$/i', "$1$2ves" ),
			array( '/sis$/i',                  "ses"     ),
			array( '/([ti])um$/i',             "$1a"     ),
			array( '/(buffal|tomat)o$/i',      "$1oes"   ),
			array( '/(bu)s$/i',                "$1ses"   ),
			array( '/(alias|status)$/i',       "$1es"    ),
			array( '/(octop|vir)us$/i',        "$1i"     ),
			array( '/(ax|test)is$/i',          "$1es"    ),
			array( '/s$/i',                    "s"       ),
			array( '/$/',                      "s"       )
		);

		$irregular = array(
			array( 'move',		'moves'    ),
			array( 'sex',    	'sexes'    ),
			array( 'child', 	'children' ),
			array( 'man',    	'men'      ),
			array( 'woman',  	'women'    ),
			array( 'person', 	'people'   )
		);

		$uncountable = array(
			'sheep',
			'fish',
			'series',
			'species',
			'money',
			'rice',
			'information',
			'equipment'
		);

		// Save time if string in uncountable
		if ( in_array( strtolower( $string ), $uncountable ) )
			return apply_filters( 'cuztom_pluralize', $string );

		// Check for irregular words
		foreach ( $irregular as $noun )
		{
			if ( strtolower( $string ) == $noun[0] )
				return apply_filters( 'cuztom_pluralize', $noun[1] );
		}

		// Check for plural forms
		foreach ( $plural as $pattern )
		{
			if ( preg_match( $pattern[0], $string ) )
				return apply_filters( 'cuztom_pluralize', preg_replace( $pattern[0], $pattern[1], $string ) );
		}

		// Return if noting found
		return apply_filters( 'cuztom_pluralize', $string );
	}

	/**
	 * Checks if the callback is a Wordpress callback
	 * So, if the class, method and/or function exists. If so, call it.
	 * If it doesn't use the data array (cuztom).
	 *
	 * @param	string|array   	$callback
	 * @return 	boolean
	 *
	 * @author  Gijs Jorissen
	 * @since 	1.5
	 *
	 */
	static function is_wp_callback( $callback )
	{
		return ( ! is_array( $callback ) ) || ( is_array( $callback ) && ( ( isset( $callback[1] ) && ! is_array( $callback[1] ) && method_exists( $callback[0], $callback[1] ) ) || ( isset( $callback[0] ) && ! is_array( $callback[0] ) && class_exists( $callback[0] ) ) ) );
	}

	/**
	 * Check if the term is reserved by Wordpress
	 *
	 * @param  	string  		$term
	 * @return 	boolean
	 *
	 * @author  Gijs Jorissen
	 * @since  	1.6
	 *
	 */
	static function is_reserved_term( $term )
	{
		if( ! in_array( $term, self::$_reserved ) ) return false;

		return new WP_Error( 'reserved_term_used', __( 'Use of a reserved term.', 'cuztom' ) );
	}




	/*  New methods added by Morgan
		========================================================================== */

	/**
	 * Get array of Schema types
	 *
	 * @return array
	 */
	static function get_schema_types()
	{
		$schemas = array(
			'CreativeWork' 		=> 'Creative Work',
			'Event' 			=> 'Event',
			'MedicalEntity' 	=> 'Medical Entity',
			'Organization'		=> 'Organization',
			'Person'			=> 'Person',
			'Place' 			=> 'Place',
			'Product' 			=> 'Product',
			'Review'			=> 'Review',
		);

		return $schemas;
	}

	static $_reserved_item_props = array(
		'image' 		=> array('image'),
		'name' 			=> array('name'),
		'description'	=> array('description'),
		'url' 			=> array('url', 'link'),
		'weight' 		=> array('weight'),
		'width' 		=> array('width'),
		'height' 		=> array('height'),
		'depth' 		=> array('depth', 'length'),
		'color' 		=> array('color', 'colour'),
		'manufacturer' 	=> array('manufacturer'),
		'model' 		=> array('model', 'make', 'version'),
		'offers' 		=> array('offers'),
		'releaseDate' 	=> array('release date')
	);

	/**
	 * Checks array for if a certain keyword is a reserved terms
	 *
	 * @param string 		$prop_string
	 * @return string
	 */
	static function is_reserved_item_prop($prop_string)
	{
		$reserved_props		= self::$_reserved_item_props;
		$prop_string 		= self::uglify($prop_string);
		$prop_string 		= explode('_', $prop_string);

		if (!empty($prop_string)) {

			// loop through the props
			foreach ($reserved_props as $key => $reserved_prop) {

				// loop through the prop keyword values
				foreach ($reserved_prop as $prop_value) {
					// Set the plural version of the value
					$plural = self::pluralize($prop_value);

					// Start checking against the item prop
					if (in_array($prop_value, $prop_string)) {
						return $key;
					} else if (in_array($plural, $prop_string)) {
						return $key;
					}
				}

			}

		}

	}

	/**
	 * Creates a Dynamic Image Using Timthumb
	 *
	 * @return string
	 */
	public function create_image_src($image_src, $width = 100, $height = 100, $zoomcrop = 1, $quality = 80)
	{
		$image_src 	= trim($image_src);
		$width 		= intval(wp_is_mobile() ? $width*2 : $width);
		$height 	= intval(wp_is_mobile() ? $height*2 : $height);
		$zoomcrop 	= intval($zoomcrop);
		$quality 	= intval($quality);

		if (!empty($image_src)) {

			$image_src = NM_THUMB.'?src='.$image_src;

			if ($width > 0) 		$image_src .= '&w='.$width;
			if ($height > 0) 		$image_src .= '&h='.$height;
			if (!empty($zoomcrop)) 	$image_src .= '&zc='.$zoomcrop;
			if (!empty($quality)) 	$image_src .= '&q='.$quality;

			$image_src = htmlspecialchars($image_src);

			return $image_src;

		} else {

			return false;

		}

	}

	/**
	 * Curls a URL and returns the data
	 *
	 * @param string 	$url
	 */
	function fetch_data( $url ){
		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt( $ch, CURLOPT_TIMEOUT, 20 );
		$result = curl_exec( $ch );
		curl_close( $ch );
		return $result;
	}

	/**
	 * Creates HTML for a youtube video gallery
	 *
	 * @param string 	$url 		URL of the gallery
	 * @return string
	 */
	function create_youtube_gallery($url, $limit = 5) {
		$url 	= parse_url(htmlspecialchars_decode($url));
		$query  = array();

		if (!empty($url['query'])) {
			parse_str($url['query'], $query);
			$playlist_id = $query['list'];

			if ( $playlist_id !='' ) {

				// Get the Json feed from Youtube and apply the Playlist ID
				$result = self::fetch_data('https://gdata.youtube.com/feeds/api/playlists/'.$playlist_id.'?v=2&alt=jsonc&max-results='.$limit);
				$result = json_decode( $result );

				$playlist 	= $result->data;
 				$videos 	= $result->data->items;

				// See if the feed is sending data otherwise display an eorror message
				if (!empty($videos)) {

					$video_url 			= 'https://www.youtube.com/embed/';
					$video_options 		= '?enablejsapi=1&version=3&autoplay=0&showinfo=0&rel=0&wmode=opaque';
					$large_video_src 	= $video_url.$videos[0]->video->id.$video_options;
					$playlist_url		= 'http://www.youtube.com/watch?v='.$videos[0]->video->id.'&list='.$playlist->id;

					echo '<div class="nm-youtube-gallery grid cf">';

					// Large Video
					echo '<div class="col three-fourths">';
					echo '<div class="video-container"><iframe width="640" height="360" class="nm-large-video" id="nm-large-video" type="text/html" src="'.$large_video_src.'" frameborder="0" allowfullscreen=""></iframe></div>';
					echo '</div>';

					// Thumbnails
					if (count($videos) > 0) {
						echo '<div class="col one-fourth">';
						echo '<ul class="nm-youtube-thumbnails">';
						foreach ($videos as $key => $video) {
							$width = $height = 211;
							$video_link 	= $video_url.$video->video->id.$video_options;
							$video_thumb 	= self::create_image_src($video->video->thumbnail->hqDefault, $width, $height, 3);
							$video_title 	= $video->video->title;
							echo '<li class="nm-youtube-thumbnail"><a href="'.$video_link.'"><img width="'.$width.'" height="'.$height.'" src="'.$video_thumb.'" alt="'.$video_title.'"></a></li>';
						}
						echo '<li class="nm-youtube-more"><a href="'.$playlist_url.'" target="_blank">See More Videos</a></li>';
						echo '</ul>';
						echo '</div>';
					}

					echo '</div>';

				} else {

					echo '<p>Sorry the Youtube Feed is down at this time</p>';

				}

			}

		}
	}

	/**
	 * Gets all Posts in a post_type
	 *
	 * @param array $args 	The post type arguments name
	 */
	function get_cuztom_posts($args = array())
	{
		$default_args = array(
			'post_type' => $this->name,
			'posts_per_page' => -1,
			'post_status' => 'any'
		);
		$new_args = array_merge($default_args, $args);
		$posts = get_posts($new_args);
		return $posts;
	}

}