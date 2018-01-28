<?php
/**
 * Summary (no period for file headers)
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package WordPress
 * @subpackage Component
 * @since x.x.x (when the file was introduced)
 */

function widget_interlacer_create_widget_interlacer_sidebar() {
	register_sidebar( array(
		'name'          => __( 'Widget Interlacer Content', 'widget-interlacer' ),
		'id'            => 'widget-interlacer',
		'description'   => __( 'Content will be interlaced with regular post content', 'widget-interlacer' ),
		'before_widget' => '<div id="%1$s" class="interlacer-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="interlacer-widgettitle">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'widget_interlacer_create_widget_interlacer_sidebar' );
