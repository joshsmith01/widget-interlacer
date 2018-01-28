<?php

/**
 * Register meta box(es).
 */
function widget_interlacer_register_meta_boxes() {
	add_meta_box( 'meta-box-id', __( 'Widget Interlacer', 'widget-interlacer' ), 'widget_interlacer_display_callback', 'post', 'side', 'high' );
}
add_action( 'add_meta_boxes', 'widget_interlacer_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function widget_interlacer_display_callback( $post ) {
	if ( get_post_type( $post ) == 'post' ) {
		$widget_interlacer_after_element = get_post_meta( $post->ID, 'widget_interlacer_after_element', true );
		$widget_interlacer_element_count = get_post_meta( $post->ID, 'widget_interlacer_element_count', true );
		$widget_interlacer_interlace_it  = get_post_meta( $post->ID, 'widget_interlacer_interlace_it', true ) ? get_post_meta( $post->ID, 'widget_interlacer_interlace_it', true ) : 'yes';

		wp_nonce_field( plugin_basename( __FILE__ ), 'interlace_content_nonce' ); ?>

        <p>
            <input type="radio" name="interlace_content" id="interlace_content-yes"
                   value="yes" <?php checked( $widget_interlacer_interlace_it, 'yes', true ) ?>/>
            <label for="interlace_content-yes" class="select-it"><?php _e( 'Yes, interlace it', 'widget-interlacer' ); ?>  </label><br/>
            <input type="radio" name="interlace_content" id="interlace_content-no"
                   value="no" <?php checked( $widget_interlacer_interlace_it, 'no', true ) ?>/>
            <label for="interlace_content-no" class="select-it"><?php _e( 'No, just regular layout', 'widget-interlacer' ); ?>  </label>
        </p>


        <p>
            <label for="widget_interlacer_after_element"><?php _e( 'After what element?', 'widget-interlacer' ); ?>  </label>
            <select name="widget_interlacer_after_element" id="widget_interlacer_after_element" class="postbox">
                <option value="p" <?php selected( $widget_interlacer_after_element, "p" ); ?>><?php _e( 'p', 'widget-interlacer' ); ?>  </option>
                <option value="h1" <?php selected( $widget_interlacer_after_element, "h1" ); ?>><?php _e( 'h1', 'widget-interlacer' ); ?>  </option>
                <option value="h2" <?php selected( $widget_interlacer_after_element, "h2" ); ?>><?php _e( 'h2', 'widget-interlacer' ); ?>  </option>
                <option value="h3" <?php selected( $widget_interlacer_after_element, "h3" ); ?>><?php _e( 'h3', 'widget-interlacer' ); ?>  </option>
                <option value="h4" <?php selected( $widget_interlacer_after_element, "h4" ); ?>><?php _e( 'h4', 'widget-interlacer' ); ?>  </option>
                <option value="h5" <?php selected( $widget_interlacer_after_element, "h5" ); ?>><?php _e( 'h5', 'widget-interlacer' ); ?>  </option>
                <option value="h6" <?php selected( $widget_interlacer_after_element, "h6" ); ?>><?php _e( 'h6', 'widget-interlacer' ); ?>  </option>
                <option value="pre" <?php selected( $widget_interlacer_after_element, "pre" ); ?>><?php _e( 'preformatted', 'widget-interlacer' ); ?>  </option>
                <option value="span" <?php selected( $widget_interlacer_after_element, "span" ); ?>><?php _e( 'span', 'widget-interlacer' ); ?>  </option>
            </select>
        </p>

        <p>
            <label for="widget_interlacer_element_count"><?php _e( 'After how many elements?', 'widget-interlacer' ); ?>  </label>
            <select class="widefat" id="widget_interlacer_element_count" name="widget_interlacer_element_count">
                <option value="1" <?php selected( $widget_interlacer_element_count, "1" ); ?>><?php _e( '1', 'widget-interlacer' ); ?>  </option>
                <option value="2" <?php selected( $widget_interlacer_element_count, "2" ); ?>><?php _e( '2', 'widget-interlacer' ); ?>  </option>
                <option value="3" <?php selected( $widget_interlacer_element_count, "3" ); ?>><?php _e( '3', 'widget-interlacer' ); ?>  </option>
                <option value="4" <?php selected( $widget_interlacer_element_count, "4" ); ?>><?php _e( '4', 'widget-interlacer' ); ?>  </option>
                <option value="5" <?php selected( $widget_interlacer_element_count, "5" ); ?>><?php _e( '5', 'widget-interlacer' ); ?>  </option>
                <option value="6" <?php selected( $widget_interlacer_element_count, "6" ); ?>><?php _e( '6', 'widget-interlacer' ); ?>  </option>
                <option value="7" <?php selected( $widget_interlacer_element_count, "7" ); ?>><?php _e( '7', 'widget-interlacer' ); ?>  </option>
                <option value="8" <?php selected( $widget_interlacer_element_count, "8" ); ?>><?php _e( '8', 'widget-interlacer' ); ?>  </option>
                <option value="9" <?php selected( $widget_interlacer_element_count, "9" ); ?>><?php _e( '9', 'widget-interlacer' ); ?>  </option>
                <option value="10" <?php selected( $widget_interlacer_element_count, "10" ); ?>><?php _e( '10', 'widget-interlacer' ); ?>  </option>
            </select>
        </p>

		<?php
	}
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function widget_interlacer_save_meta_box( $post_id ) {

	if ( ! isset( $_POST['post_type'] ) ) {
		return $post_id;
	}

	if ( ! wp_verify_nonce( $_POST['interlace_content_nonce'], plugin_basename( __FILE__ ) ) ) {
		return $post_id;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	if ( 'post' == $_POST['post_type'] && ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( ! isset( $_POST['interlace_content'] ) ) {
		return $post_id;
	} else {
		update_post_meta( $post_id, 'widget_interlacer_interlace_it', sanitize_text_field( $_POST['interlace_content'] ), get_post_meta( $post_id, 'widget_interlacer_interlace_it', true ) );
		update_post_meta( $post_id, 'widget_interlacer_after_element', sanitize_text_field( $_POST['widget_interlacer_after_element'] ) );
		update_post_meta( $post_id, 'widget_interlacer_element_count', sanitize_text_field( absint( $_POST['widget_interlacer_element_count'] ) ) );
	}
}

add_action( 'save_post', 'widget_interlacer_save_meta_box' );
