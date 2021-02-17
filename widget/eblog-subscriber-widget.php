<?php

/**
 * COnstruc Social Widget
 *
 *
 * @author 		BokhtyerAbid
 * @category 	Widgets
 * @package 	Construc/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 *
 * Adds Subscriber_widgets widget.
 */


class Subscriber_widgets extends WP_Widget{
	
	function __construct() {
		parent::__construct(
			'subscribe_wid',
			esc_html__( 'Subscribe Widget', 'eblog' ),
			array( 'description' => esc_html__( 'A Subscriber Widget', 'eblog' ), ) // Args
		);
	}

	
	public function widget( $args, $instance ) {
		$wi_title = !empty($instance['title'])?$instance['title']:'';
		$newslatter_subscriber = !empty($instance['newslatter_subscriber'])?$instance['newslatter_subscriber']:'';
		$description = !empty($instance['description'])?$instance['description']:'';

		echo $args['before_widget'];
		echo $args['before_title'] . $wi_title . $args['after_title']; ?>

        <p><?php echo $description; ?></p>
        <?php
        if($newslatter_subscriber!=''){
			echo do_shortcode($newslatter_subscriber);
		}
        ?>
		<?php
		echo $args['after_widget'];

	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'eblog' );
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		$newslatter_subscriber = ! empty( $instance['newslatter_subscriber'] ) ? $instance['newslatter_subscriber'] : '';
		?>
		<!-- title field -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'eblog' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<!-- textarea -->
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_attr_e( 'Description:', 'eblog' ); ?></label> 
		<textarea  class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"><?php echo esc_attr( $description ); ?></textarea>
		</p>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'newslatter_subscriber' ) ); ?>"><?php esc_attr_e( 'Newslatter Shortcode:', 'eblog' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'newslatter_subscriber' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'newslatter_subscriber' ) ); ?>" type="text" value="<?php echo esc_attr( $newslatter_subscriber ); ?>">
		</p>
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
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? sanitize_text_field( $new_instance['description'] ) : '';
		$instance['newslatter_subscriber'] = ( ! empty( $new_instance['newslatter_subscriber'] ) ) ? sanitize_text_field( $new_instance['newslatter_subscriber'] ) : '';

		return $instance;
	}
}