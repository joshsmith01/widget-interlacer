<?php
/**
 * Plugin Name:         Widget Interlacer
 * Plugin URI:          https://github.com/joshsmith01/widget-interlacer
 * Description:         Interlace content from a widget into the main post content.
 * Version:             0.1.0
 * Author:              Josh Smith
 * Author URI:          http://www.efficiencyofmovement.com
 * Text Domain:         widget-interlacer
 * Domain Path:         /widget-interlacer
 * License:             GPL2
 * GitHub Plugin URI:   https://github.com/joshsmith01/widget-interlacer
 */


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


require_once( 'includes/form-widget.php' );
require_once( 'includes/interlace-content.php' );
require_once( 'includes/register-interlace-sidebar.php' );
require_once( 'includes/interlace-post-metabox-options.php' );
require_once( 'includes/widget-interlacer-settings.php' );


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
	wp_enqueue_style( 'widget-interlacer-widget-public-style', plugins_url( 'widget-interlacer/public/css/widget-interlacer-public.css' ), array(), $ver );
	wp_enqueue_script( 'widget-interlacer-public-js', plugins_url( 'public/js/widget-interlacer-public.js', __FILE__ ), array(), false, true );


}
add_action( 'wp_enqueue_scripts', 'widget_interlacer_enqueue_plugin_styles_scripts' );

function enqueue_widget_interlacer_admin_scripts() {
	wp_enqueue_style('jquery-ui-tabs-smoothness','http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css');
	wp_enqueue_style('widget-interlacer-admin.css', plugins_url( 'admin/css/widget-interlacer-admin.css', __FILE__ ));
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( 'admin/js/wp-color-picker-alpha.min.js', __FILE__ ), array( 'wp-color-picker' ) );
	wp_enqueue_script( 'widget-interlacer-admin-js', plugins_url( 'admin/js/widget-interlacer-admin.js', __FILE__ ), array( 'wp-color-picker', 'jquery-ui-tabs' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'enqueue_widget_interlacer_admin_scripts' );
