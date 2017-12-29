<?php
//Our Popular Posts
class Our_Popular_Posts_Widget extends WP_Widget
{
    function Our_Popular_Posts_Widget()
    {
    parent::WP_Widget(false, "Our Popular Posts");
    }

    function update($new_instance, $old_instance) {
	    $instance = array();
	    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        return $new_instance;
    }

    function form($instance)
    {
	    $title = @ $instance['title'] ?: 'Popular Posts';
	    $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
	    if ( ! $number ) {
		    $number = 5;
	    }

	    ?>
	    <p>
		    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	    </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
        </p>
	    <?php
    }

    function widget($args, $instance) {

        // $title = apply_filters( 'widget_title', $instance['title'] );


	    // I like to put the HTML output for the actual widget in a seperate file
	    include( realpath( dirname( __FILE__ ) ) . "/our_popular_posts_widget.php" );
    }
}
register_widget("Our_Popular_Posts_Widget");

