<?php
/**
Plugin Name: CMS 2 Labb 2 Widget
Description: Widget that adds youtube video with ID
Version: 1.0.0
Author: Izabela Walczak-Niznik

*/



 add_action( 'widgets_init', function(){
 	register_widget( 'yt_widget' );
 });

/**
 * Adds Foo_Widget widget.
 */
class YT_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'yt_widget', // Base ID
			esc_html__( 'yt_widget', 'yts_domain' ), // Name
			array( 'description' => esc_html__( 'Youtube Widget', 'yts_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		echo '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$instance['id'].'" controls=1&autoplay=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Youtube video', 'yts_domain' );

	  $id = ! empty( $instance['title'] ) ? $instance['$id'] : esc_html__( 'ID', 'yts_domain' );
    ?>

<!--Title -->
<p>
   <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
          <?php esc_attr_e( 'title:', 'yts_domain' ); ?>

       </label>

   <input
          class="widefat"
          id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
          name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
          type="yts_domain"
          value="<?php echo esc_attr( $title ); ?>">
</p>




    <!--id-->

    <p>
       <label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>">
        <?php esc_attr_e( 'id:', 'yts_domain' ); ?>

       </label>
       <input
        class="widefat"
        id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>"
        type="yts_domain"
        value="<?php echo esc_attr( $id ); ?>">
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
    $instance['id'] = ( ! empty( $new_instance['id'] ) ) ? sanitize_text_field( $new_instance['id'] ) : '';

		return $instance;
	}

} // class Foo_Widget
