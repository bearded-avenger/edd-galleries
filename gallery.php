<?php
/**
 	* Gallery Shortcode Class - removes core gallery shortcode and overrides with out own.
 	* Benefits of this approach are no extra meta, and [gallery] shortcode is retained when user deactivates plugin.
 	*
 	* @package     EDD Galleries
 	* @subpackage  Gallery Shortcode [gallery]
 	* @copyright   Copyright (c) 2013, Nick Haskins & CO
 	* @since       0.1
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

class eddPostGallery {

	const version = '0.1';

	function __construct(){

		$this->init();

	}

	// since only one gallery shortcode is allowed, let's remove the core gallery shortcode and replace it with out own
	function init(){

		remove_shortcode('gallery', array($this,'gallery_shortcode'));
		add_shortcode('gallery',	array($this,'edd_gallery_shortcode'));

	}

	// Override WP Gallery Shortcode
	function edd_gallery_shortcode() {

	  	global $post;

	 	$id 		= $post->ID;

	 	// Enqueue Flex Stuff
	 	wp_enqueue_script('edd-galleries-flex');
		wp_enqueue_style('edd-galleries-flex-style');

		?><!-- EDD Galleries -->
		<script>
			jQuery(document).ready(function(){
				jQuery('#ba-edd-gallery-<?php echo $id;?>').flexslider({
				    animation: 'fade',
				    smoothHeight: true,
				    pauseOnHover: true,
				    slideshow: false,
				    slideshowSpeed: 5000,
				    animationSpeed: 200,
				    namespace: 'ba-edd-gallery-'
				});
			});
		</script><?php

		$shortcode_args = shortcode_parse_atts($this->get_match('/\[gallery\s(.*)\]/isU', $post->post_content));

		$ids = $shortcode_args["ids"];

		$args = array(
			'include' 			=> $ids,
	        'post_status' 		=> 'inherit',
	        'post_type' 		=> 'attachment',
        	'post_mime_type' 	=> 'image',
        	'order' 			=> 'menu_order ID',
        	'orderby' 			=> 'post__in', //required to order results based on order specified the "include" param
        );

		$images = get_posts($args);

		// Action
		do_action('ba_edd_galleries_before');

		$out  = '';
		$out .= sprintf('<div id="ba-edd-gallery-%s" class="ba-edd-post-gallery"><ul class="slides">',$id);

			// Action
			do_action('ba_edd_galleries_inside_top');

				foreach($images as $image):

					$img  = wp_get_attachment_url($image->ID, 'full', false,'');
					$alt  = get_post_meta($image->ID, '_wp_attachment_image_alt', true);
					$out .= apply_filters('edd_galleries_output', sprintf('<li><img src="%s" alt="%s" /></li>',$img,$alt));

				endforeach;

			// Action
			do_action('ba_edd_galleries_inside_bottom');

		$out .= '</ul></div>';

		// Action
		do_action('ba_edd_galleries_after');

		return $out;
	}


	// regex helper
	function get_match( $regex, $content ) {
	    preg_match($regex, $content, $matches);
	    return $matches[1];
	}

}
new eddPostGallery;