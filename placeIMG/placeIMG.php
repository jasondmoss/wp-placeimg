<?php
/**
 * @package PlaceIMG
 * @version 1.0
 */
/*
Plugin Name: PlaceIMG
Plugin URI: http://placeIMG.com
Description: Allows WP to easily utilize placeIMG images
Author: Masuga Design
Version: 1.0
Author URI: http://masugadesign.com
*/

function placeIMG($atttributes) {
    extract(shortcode_atts(array(
        'width' => '640',
        'height' => '480',
        'category' => 'any',
        'filter' => 'none',
        'tag' => 'Y'
    ), $atttributes));

    // Usable categories & filters
  	$valid_categories 	= array('animals', 'arch', 'nature', 'people', 'tech');
  	$valid_filters		= array('grayscale', 'sepia');

  	// Check for valid width & height (numeric, 1-3000)
	if (!$width || !is_numeric($width) || $width < 0 || $width > 3000) { $width = '640'; }
	if (!$height || !is_numeric($height) || $height < 0 || $height > 3000) { $height = '480'; }

	// Check for valid category & filter
	if (!$category || !in_array($category, $valid_categories)) { $category = 'any'; }
	if (!$filter || !in_array($filter, $valid_filters)) { $filter = 'none'; }

	// Generated the img url
	$img_url = 'http://placeimg.com/'.$width.'/'.$height.'/'.$category.'/'.$filter;

	// Add tag if needed
	if (strtolower($tag) == 'y') { $img_url = '<img src="'.$img_url.'" />'; }

	// Return image (or image url)
	return $img_url;
}

// Add our placeIMG shortcode
add_shortcode('placeIMG', 'placeIMG');
// Add a back-up shortcode if people don't capitalize correctly
add_shortcode('placeimg', 'placeIMG');

?>
