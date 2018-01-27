<?php
/**
 * Create the custom widget
 *
 * Extend the WP_Widget Class and create a new widget that facilitates widget content in the middle of post content.
 *
 * @link URL
 *
 * @package WordPress
 * @subpackage Component
 * @since x.x.x (when the file was introduced)
 */

/**
 * Adds Widget_Interlacer_Widget widget.
 */
class Widget_Interlacer_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'Widget_Interlacer_Widget', // Base ID
			esc_html__( 'Widget Interlacer', 'widget-interlacer' ), // Name
			array( 'description' => esc_html__( 'Display widget content within the main post content.', 'widget-interlacer' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		?>
        <div class="interlacer-content-holder" style="background: <?php echo $instance['background_color']; ?>; color: <?php echo $instance['background_font_color']; ?>"><?php
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			}
	        if ( ! empty( $instance['body_text'] ) ) {
		        echo $instance['body_text'];
	        }
	        ?>


        </div>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title                 = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'widget-interlacer' );
		$body_text             = ! empty( $instance['body_text'] ) ? $instance['body_text'] : esc_html__( 'Add Body Text', 'widget-interlacer' );
		$element_count         = ! empty( $instance['element_count'] ) ? $instance['element_count'] : esc_html__( 4, 'widget-interlacer' );
		$element_after         = ! empty( $instance['element_after'] ) ? $instance['element_after'] : esc_html__( 'p', 'widget-interlacer' );
		$background_color      = ! empty( $instance['background_color'] ) ? $instance['background_color'] : esc_html__( '#eeeeee', 'widget-interlacer' );
		$background_font_color = ! empty( $instance['background_font_color'] ) ? $instance['background_font_color'] : esc_html__( '#fff', 'widget-interlacer' );
		?>
        <div class="tabs">
            <ul>
                <li><a href="#meta"><?php _e( 'Meta', 'widget-interlacer' ); ?></a></li>
                <li><a href="#colors"><?php _e( 'Colors', 'widget-interlacer' ); ?></a></li>
            </ul>
            <div id="meta">
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'widget-interlacer' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                           name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
                           value="<?php echo esc_attr( $title ); ?>">
                </p>

                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'body_text' ) ); ?>"><?php esc_attr_e( 'Body Text:', 'widget-interlacer' ); ?></label>
                    <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'body_text' ) ); ?>"
                           name="<?php echo esc_attr( $this->get_field_name( 'body_text' ) ); ?>" type="text"
                           value="<?php echo esc_attr( $body_text ); ?>">
                </p>

                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'element_after' ) ); ?>"><?php esc_attr_e( 'What Element:', 'widget-interlacer' ); ?></label>
                    <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'element_after' ) ); ?>"
                            name="<?php echo esc_attr( $this->get_field_name( 'element_after' ) ); ?>">
                        <option value="p" <?php selected( $instance['element_after'], "p" ); ?>>p</option>
                        <option value="h1" <?php selected( $instance['element_after'], "h1" ); ?>>h1</option>
                        <option value="h2" <?php selected( $instance['element_after'], "h2" ); ?>>h2</option>
                        <option value="h3" <?php selected( $instance['element_after'], "h3" ); ?>>h3</option>
                        <option value="h4" <?php selected( $instance['element_after'], "h4" ); ?>>h4</option>
                        <option value="h5" <?php selected( $instance['element_after'], "h5" ); ?>>h5</option>
                        <option value="h6" <?php selected( $instance['element_after'], "h6" ); ?>>h6</option>
                        <option value="pre" <?php selected( $instance['element_after'], "pre" ); ?>>preformatted</option>
                        <option value="span" <?php selected( $instance['element_after'], "span" ); ?>>span</option>
                    </select>
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'element_count' ) ); ?>"><?php esc_attr_e( 'After # of Elements', 'widget-interlacer' ); ?></label>
                    <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'element_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'element_count' ) ); ?>">
                        <option value="1" <?php selected( $instance['element_count'], "1" ); ?>>1</option>
                        <option value="2" <?php selected( $instance['element_count'], "2" ); ?>>2</option>
                        <option value="3" <?php selected( $instance['element_count'], "3" ); ?>>3</option>
                        <option value="4" <?php selected( $instance['element_count'], "4" ); ?>>4</option>
                    </select>
                </p>
            </div>
            <div id="colors">
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"><?php esc_attr_e( 'Background Color:', 'widget-interlacer' ); ?></label>
                    <input class="widefat my-color-field color-picker" data-alpha="true"
                           id="<?php echo esc_attr( $this->get_field_id( 'background_color' ) ); ?>"
                           name="<?php echo esc_attr( $this->get_field_name( 'background_color' ) ); ?>" type="text"
                           value="<?php echo esc_attr( $background_color ); ?>">
                </p>
                <p>
                    <label for="<?php echo esc_attr( $this->get_field_id( 'background_font_color' ) ); ?>"><?php esc_attr_e( 'Background Font Color:', 'widget-interlacer' ); ?></label>
                    <input class="widefat my-color-field color-picker" data-alpha="true"
                           id="<?php echo esc_attr( $this->get_field_id( 'background_font_color' ) ); ?>"
                           name="<?php echo esc_attr( $this->get_field_name( 'background_font_color' ) ); ?>"
                           type="text"
                           value="<?php echo esc_attr( $background_font_color ); ?>">
                </p>
            </div>
        </div>

		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                          = array();
		$instance['title']                 = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['body_text']             = ( ! empty( $new_instance['body_text'] ) ) ? strip_tags( $new_instance['body_text'] ) : '';
		$instance['element_count']         = ( ! empty( $new_instance['element_count'] ) ) ? strip_tags( $new_instance['element_count'] ) : '';
		$instance['element_after']         = ( ! empty( $new_instance['element_after'] ) ) ? strip_tags( $new_instance['element_after'] ) : '';
		$instance['background_color']      = ( ! empty( $new_instance['background_color'] ) ) ? strip_tags( $new_instance['background_color'] ) : '';
		$instance['font_color']            = ( ! empty( $new_instance['font_color'] ) ) ? strip_tags( $new_instance['font_color'] ) : '';
		$instance['background_font_color'] = ( ! empty( $new_instance['background_font_color'] ) ) ? strip_tags( $new_instance['background_font_color'] ) : '';


		return $instance;
	}

} // class Foo_Widget

// Register Foo_Widget widget
add_action( 'widgets_init', function () {
	register_widget( 'Widget_Interlacer_Widget' );
} );
