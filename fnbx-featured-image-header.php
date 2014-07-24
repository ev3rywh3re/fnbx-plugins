<?php
/*
Plugin Name: FNBX Theme - Featured Image for Header
Plugin URI: http://funroe.net
Description: Allows the featured image for a post or page to be used in the header image area in a FNBX theme.
Author: Jess Planck
Version: 1.0
Author URI: http://funroe.net

Copyright (c) Jess Planck (http://funroe.net)
This is released under the GNU General Public
License: http://www.gnu.org/licenses/gpl.txt

This is a WordPress plugin (http://wordpress.org). WordPress is
free software; you can redistribute it and/or modify it under the
terms of the GNU General Public License as published by the Free
Software Foundation; either version 2 of the License, or (at your
option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
General Public License for more details.

For a copy of the GNU General Public License, write to:

Free Software Foundation, Inc.
59 Temple Place, Suite 330
Boston, MA  02111-1307
USA

You can also view a copy of the HTML version of the GNU General
Public License at http://www.gnu.org/copyleft/gpl.html
*/

/**
* FNBX - Featured image for header
*
* These functions control the core functionality for this Wordpress Plugin. 
* @package fnbx_plugins
* @author Jess Planck
* @version 1.0
*/


/**
 * Initialize featured image for header.
 *
 * Initializaiton sets up global variable for image src and size values.
 * @package fnbx_plugins
 */
function fnbx_featured_header_image_init() {
	global $post, $fnbx_featured_image;

	$featured_image_id = get_post_thumbnail_id( $post->ID );
	if( !$featured_image_id ) return;
	$fnbx_featured_image = wp_get_attachment_image_src( $featured_image_id, 'full' );
	
}
add_action( 'fnbx_init', 'fnbx_featured_header_image_init' );

/**
 * Filter image file.
 *
 * Filter to mod the image file for the standard FNBX header image.
 * @package fnbx_plugins
 */
function fnbx_featured_header_image_filter( $css_image = '' ) {
	global $fnbx_featured_image;
	
	if( !empty( $fnbx_featured_image ) ) $css_image = $fnbx_featured_image[0];
	
	return $css_image;
}
add_filter( 'fnbx_custom_header_css_background_url',  'fnbx_featured_header_image_filter' );

/**
 * Filter image height.
 *
 * Filter to mod the image height for the standard FNBX header image CSS.
 * @package fnbx_plugins
 */
function fnbx_featured_header_image_height_filter( $css_image_height = '' ) {
	global $fnbx_featured_image;
	
	if( !empty( $fnbx_featured_image ) ) $css_image_height = $fnbx_featured_image[2];
			
	return $css_image_height;
}
add_filter( 'fnbx_custom_header_css_background_height',  'fnbx_featured_header_image_height_filter' );
