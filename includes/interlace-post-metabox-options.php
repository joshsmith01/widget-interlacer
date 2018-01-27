<?php

/**
 * Register meta box(es).
 */
function wpdocs_register_meta_boxes() {
	add_meta_box( 'meta-box-id', __( 'Widget Interlacer', 'widget-interlacer' ), 'wpdocs_my_display_callback', 'post', 'side', 'high' );
}

add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function wpdocs_my_display_callback( $post ) {
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
                <option value="p" <?php selected( $widget_interlacer_after_element, "p" ); ?>>p</option>
                <option value="h1" <?php selected( $widget_interlacer_after_element, "h1" ); ?>>h1</option>
                <option value="h2" <?php selected( $widget_interlacer_after_element, "h2" ); ?>>h2</option>
                <option value="h3" <?php selected( $widget_interlacer_after_element, "h3" ); ?>>h3</option>
                <option value="h4" <?php selected( $widget_interlacer_after_element, "h4" ); ?>>h4</option>
                <option value="h5" <?php selected( $widget_interlacer_after_element, "h5" ); ?>>h5</option>
                <option value="h6" <?php selected( $widget_interlacer_after_element, "h6" ); ?>>h6</option>
                <option value="pre" <?php selected( $widget_interlacer_after_element, "pre" ); ?>>preformatted</option>
                <option value="span" <?php selected( $widget_interlacer_after_element, "span" ); ?>>span</option>
            </select>
        </p>

        <p>
            <label for="widget_interlacer_element_count"><?php _e( 'After how many elements?', 'widget-interlacer' ); ?>  </label>
            <select class="widefat" id="widget_interlacer_element_count" name="widget_interlacer_element_count">
                <option value="1" <?php selected( $widget_interlacer_element_count, "1" ); ?>>1</option>
                <option value="2" <?php selected( $widget_interlacer_element_count, "2" ); ?>>2</option>
                <option value="3" <?php selected( $widget_interlacer_element_count, "3" ); ?>>3</option>
                <option value="4" <?php selected( $widget_interlacer_element_count, "4" ); ?>>4</option>
                <option value="5" <?php selected( $widget_interlacer_element_count, "5" ); ?>>5</option>
                <option value="6" <?php selected( $widget_interlacer_element_count, "6" ); ?>>6</option>
                <option value="7" <?php selected( $widget_interlacer_element_count, "7" ); ?>>7</option>
                <option value="8" <?php selected( $widget_interlacer_element_count, "8" ); ?>>8</option>
                <option value="9" <?php selected( $widget_interlacer_element_count, "9" ); ?>>9</option>
                <option value="10" <?php selected( $widget_interlacer_element_count, "10" ); ?>>10</option>
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
function wpdocs_save_meta_box( $post_id ) {

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
		update_post_meta( $post_id, 'widget_interlacer_interlace_it', $_POST['interlace_content'], get_post_meta( $post_id, 'widget_interlacer_interlace_it', true ) );
		update_post_meta( $post_id, 'widget_interlacer_after_element', $_POST['widget_interlacer_after_element'] );
		update_post_meta( $post_id, 'widget_interlacer_element_count', $_POST['widget_interlacer_element_count'] );
	}
}

add_action( 'save_post', 'wpdocs_save_meta_box' );
