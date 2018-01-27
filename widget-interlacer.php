<?php
/**
 * Plugin Name:         Widget Interlacer
 * Plugin URI:          https://github.com/joshsmith01/widget-interlacer
 * Description:         Interlace content from a widget into the main post content.
 * Version:             1.0.0
 * Author:              Josh Smith
 * Author URI:          http://www.efficiencyofmovement.com
 * Text Domain:         widget-interlacer
 * Domain Path:         /widget-interlacer
 * License:             GPL2
 * GitHub Plugin URI:   https://github.com/joshsmith01/widget-interlacer
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

require_once( 'includes/interlace-content.php' );
require_once( 'includes/register-interlace-sidebar.php' );
require_once( 'includes/interlace-post-metabox-options.php' );


function widget_interlacer_enqueue_plugin_styles_scripts() {
	// Set the file path to a variable. -JMS
	$file_path = plugin_dir_path( __DIR__ ) . 'widget-interlacer.php';
	// Read the version number from the main plugin file then set it to a variable. -JMS
	$plugin_data = get_file_data( $file_path, array(
		'Version' => 'Version'
	) );
	// The the value of the Version header to a variable. -JMS
	$ver = $plugin_data['Version'];

	// Use the variable, $ver, in more than one stylesheet/script to bust cache when the plugin gets updated. -JMS
	wp_enqueue_script( 'widget-interlacer-public-js', plugins_url( 'public/js/widget-interlacer-public.js', __FILE__ ), array(), $ver, true );
}
add_action( 'wp_enqueue_scripts', 'widget_interlacer_enqueue_plugin_styles_scripts' );
