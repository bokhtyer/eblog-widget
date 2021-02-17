<?php

/**
 * Eblog Social Widget
 *
 *
 * @author 		BokhtyerAbid
 * @category 	Widgets
 * @package 	Construc/Widgets
 * @version 	1.0.0
 * @extends 	WP_Widget
 *
 * Adds Recent_Blog_widgets widget.
 */


class Recent_Blog_widgets extends WP_Widget{
	
	function __construct() {
		parent::__construct(
			'recent_blog_wid',
			esc_html__( 'Eblog Recent Post Widget', 'eblog' ),
			array( 'description' => esc_html__( 'A Eblog Recent Blog Widget', 'eblog' ), ) // Args
		);
	}
	public function widget( $args, $instance ) {
		$wi_title = !empty($instance['title'])?$instance['title']:'Title';
		$post_num = !empty($instance['post_num'])?$instance['post_num']:2;
		echo $args['before_widget'];
			echo $args['before_title'] . $wi_title . $args['after_title'];

		/*
		* Show Post
		*/
		$arg = array( 'numberposts' => $post_num );
		$recent_posts = wp_get_recent_posts( $arg );
		if(!empty($recent_posts)){

			foreach( $recent_posts as $recent ){
				echo "<div class='widgets-recent-single-post'>";
					if(has_post_thumbnail($recent["ID"])){
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($recent["ID"]), array(85,85) );
						echo "<div class='r-post-thumbnail'>";
							echo '<a href="'. get_permalink($recent["ID"]) .'"><img src="'. esc_url(current($image)).'" ></a>';
						echo "</div>";
					}
					echo '<div class="text">';
                    	echo '<a href="'.get_permalink($recent["ID"]).'">'. $recent["post_title"].'</a>';
                    	echo '<span>'.get_the_date( '', $recent->ID ).'</span>';
                    echo '</div>';
				echo "</div>";
			}

		}
		

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
	public function form($instance){
		$title  = isset($instance['title'])? $instance['title']:'';
		$post_num  = isset($instance['post_num'])? $instance['post_num']:'';
		?>
		<div class="re-blog-in">
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title','eblog'); ?></label>
			<input type="text" value="<?php echo $title; ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>">
		</div>
		<div class="re-blog-in">
			<label for="<?php echo esc_attr($this->get_field_id('post_num')); ?>"><?php esc_html_e('Number of posts to show:','eblog'); ?></label>
		
			<input type="number" class="widefat" id="<?php echo esc_attr($this->get_field_id('post_num')); ?>"  name="<?php echo esc_attr($this->get_field_name('post_num')); ?>" value="<?php echo esc_attr($post_num); ?>">
		</div>
		<?php
	}
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['post_num'] = ( ! empty( $new_instance['post_num'] ) ) ? strip_tags( $new_instance['post_num'] ) : '';
		return $instance;
	}
}