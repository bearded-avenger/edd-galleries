<?php
/*
Author: Nick Haskins
Author URI: http://nickhaskins.com
Plugin Name: EDD Galleries by Bearded Avenger
Plugin URI: http://nickhaskins.com
Version: 0.1
Description: Turns all WP Gallery Shortcodes into a responsive gallery if EDD is active
*/

// remove the check if you want to use teh gallery stuff everywhere
if( function_exists( 'EDD' ) )
	new baEDDGalleries;

class baEDDGalleries {

	const version = '0.1';

	function __construct() {

        $this->dir  = plugin_dir_path( __FILE__ );
        $this->url  = plugins_url( '', __FILE__ );

		include($this->dir.'/gallery.php' );

		add_action('wp_enqueue_scripts',array($this,'scripts'));

	}

	function scripts(){
		wp_register_style( 'edd-galleries-flex-style', $this->url.'/libs/flexslider/flexslider.css', self::version, true);
		wp_register_script('edd-galleries-flex',       $this->url.'/libs/flexslider/jquery.flexslider-min.js', array('jquery'), self::version, true);
	}

}
