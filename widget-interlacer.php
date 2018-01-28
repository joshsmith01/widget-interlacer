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
