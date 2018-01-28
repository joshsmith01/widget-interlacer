<?php
/**
 * Display the widget content within the post content
 *
 * Widget content can be placed after a set amount of elements in the main content area of a WordPress post or page.
 * Default option is to allow it to post to the page, but Administrators may choose to not interlace content.
 * @link URL
 *
 * @package WordPress
 * @subpackage Component
 * @since 4.9.2 (when the file was introduced)
 *
 * @param $content
 * @return array
 */

function widget_interlacer_interlace_content( $content ) {
	$post_id = get_the_ID();
	$interlace_content = get_post_meta( $post_id, 'widget_interlacer_interlace_it', true );

	if ( is_singular() && is_active_sidebar('widget-interlacer') && $interlace_content === 'yes') {

		// Get some variables to add to the interlaceWidget function. -JMS
		$element_count = get_post_meta( $post_id, 'widget_interlacer_element_count', true );
		$element_after = get_post_meta( $post_id, 'widget_interlacer_after_element', true );
		$paragraphAfter[ $element_count ] = intval($element_count);
		$content           = explode( "</$element_after>", $content );
		$count             = count( $content );

		for ( $i = 0; $i < $count; $i ++ ) {
			if ( array_key_exists( $i, $paragraphAfter ) ) {

				dynamic_sidebar( 'widget-interlacer' );

			}
			echo $content[ $i ] . "</$element_after>";
		}
	} else {
		return $content;
	}
	return $content;
}

add_filter( 'the_content', 'widget_interlacer_interlace_content' );