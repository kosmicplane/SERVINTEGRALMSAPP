<?php
/**
 * Adds indofinance_Featured_Posts_Widget widget.
 */
class indofinance_Featured_Posts_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'indofinance_featured_posts_widget', // Base ID
			esc_html__( 'Featured Posts', 'indofinance' ), // Name
			array( 'description' => esc_html__( 'A Widget to display featured posts', 'indofinance' ) ) // Args
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
		$title            = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$number_of_posts  = ! empty( $instance['number_of_posts'] ) ? absint( $instance['number_of_posts'] ) : 4;
		$order            = ! empty( $instance['order'] ) ? $instance['order'] : 'DESC';
		$category         = ! empty( $instance['category'] ) ? $instance['category'] : '';

		$args['before_widget'] = str_replace('class="widget', 'class="widget widget_block', $args['before_widget']);
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $title ) . $args['after_title'];
		}
		$featured_post_sidebar_args = array(
			'posts_per_page'      => $number_of_posts,
			'ignore_sticky_posts' => 1,
			'order'               => $order,
			'cat'                 => $category,
		);

		$featured_post_sidebar = new WP_Query( $featured_post_sidebar_args );

		if ( $featured_post_sidebar->have_posts() ) {

			echo '<div class="featured-posts">';
			while ( $featured_post_sidebar->have_posts() ) {
				$featured_post_sidebar->the_post();

				$link = get_permalink();
				$title = get_the_title();

				echo '<div class="featured-posts__post">';
				echo '<div class="featured-posts__post--thumb">';
				printf('<a href="%s" title="%s">', esc_url( $link ), esc_attr( $title ));
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} else {
					echo '<img src="' . esc_url( get_template_directory_uri() . "/images/thumbnail.jpg" ) . '" alt="' . esc_attr( $title ) . '">';
				}
				echo '</a>';
				echo '</div>';
				echo '<div class="featured-posts__post--content">';
				echo '<h4 class="featured-posts__post--title">';
				printf('<a href="%s" title="%s">%s</a>', esc_url( $link ), esc_attr( $title ), esc_html( $title ));
				echo '</h4>';
				echo '<div class="featured-posts__post--meta">';
				indofinance_posted_on();
				echo '</div><!-- .entry-meta -->';
				echo '</div><!-- sidebar-post-info-wrapper -->';
				echo '</div>';
			}
			echo '</div><!-- .featured-post-widget -->';
		}

		wp_reset_postdata();
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
		$title            = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Featured Posts', 'indofinance' );
		$number_of_posts  = ! empty( $instance['number_of_posts'] ) ? absint( $instance['number_of_posts'] ) : 4;
		$order            = ! empty( $instance['order'] ) ? $instance['order'] : 'DESC';
		$category         = ! empty( $instance['category'] ) ? $instance['category'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'indofinance' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>"><?php esc_html_e( 'Number of Posts:', 'indofinance' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'number_of_posts' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number_of_posts' ) ); ?>" type="number" min="1" step="1" value="<?php echo esc_attr( $number_of_posts ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>"><?php esc_html_e( 'Post Order:', 'indofinance' ); ?></label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'order' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'order' ) ); ?>">
				<option value="DESC" <?php selected( $order, 'DESC' ); ?>><?php esc_html_e( 'Descending', 'indofinance' ); ?></option>
				<option value="ASC" <?php selected( $order, 'ASC' ); ?>><?php esc_html_e( 'Ascending', 'indofinance' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Category:', 'indofinance' ); ?></label>
			<?php wp_dropdown_categories( array(
				'show_option_none' => esc_html__( 'Select category', 'indofinance' ),
				'name'             => $this->get_field_name( 'category' ),
				'id'               => $this->get_field_id( 'category' ),
				'selected'         => $category,
				'class'            => 'widefat',
			) ); ?>
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
		$instance                 = array();
		$instance['title']        = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['number_of_posts'] = ( ! empty( $new_instance['number_of_posts'] ) ) ? absint( $new_instance['number_of_posts'] ) : 4;
		$instance['order']        = ( ! empty( $new_instance['order'] ) ) ? sanitize_text_field( $new_instance['order'] ) : 'DESC';
		$instance['category']     = ( ! empty( $new_instance['category'] ) ) ? absint( $new_instance['category'] ) : '';

		return $instance;
	}

}

// register indofinance_Featured_Posts_Widget widget
function indofinance_register_featured_posts_widget() {
	register_widget( 'indofinance_Featured_Posts_Widget' );
}
add_action( 'widgets_init', 'indofinance_register_featured_posts_widget' );
