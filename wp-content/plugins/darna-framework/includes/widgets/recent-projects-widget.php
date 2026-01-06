<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/26/15
 * Time: 5:24 PM
 */
class Darna_Recent_Portfolio extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-recent-portfolio';
        $this->widget_description = __( "Recent Portfolio", 'g5plus-darna' );
        $this->widget_id          = 'darna-recent-portfolio';
        $this->widget_name        = __( 'G5Plus: Recent Projects', 'g5plus-darna' );
        $this->settings           = array(
            'title' => array(
                'type'  => 'text',
                'std'   => 'Recent Projects',
                'label' => __( 'Enter title ', 'g5plus-darna' ),
            ),
            'column' => array(
                'type'  => 'text',
                'std'   => '4',
                'label' => __( 'Enter column ', 'g5plus-darna' ),
            ),
            'row' => array(
                'type'  => 'text',
                'std'   => '2',
                'label' => __( 'Enter row ', 'g5plus-darna' ),
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $class_custom   = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
        $title  = empty( $instance['title'] ) ? '' : apply_filters( 'widget_title', $instance['title'] );
        $column  = empty( $instance['column'] ) ? '' : apply_filters( 'widget_column', $instance['column'] );
        $row  = empty( $instance['row'] ) ? '' : apply_filters( 'row', $instance['row'] );
        $widget_id = $args['widget_id'];
        echo wp_kses_post($before_widget);

        if(class_exists('G5PlusFramework_Portfolio'))
        {
            $post_per_page = $column * $row;
            $args = array(
                'posts_per_page'   => $post_per_page,
                'orderby'          => 'post_date',
                'order'            => 'DESC',
                'post_type'        => 'portfolio',
                'post_status'      => 'publish');

            $posts_array  = new WP_Query( $args );
        ?>
        <div>
            <h4><?php echo wp_kses_post($title)?></h4>
            <ul>
            <?php
                while ( $posts_array->have_posts() ) : $posts_array->the_post();
                    $permalink = get_permalink();
                    $title_post = get_the_title();
                    $post_thumbnail_id = get_post_thumbnail_id(  get_the_ID() );
                    $thumbnail_url = '';

	                if (function_exists('matthewruddy_image_resize_id')) {
		                $thumbnail_url = matthewruddy_image_resize_id($post_thumbnail_id,270,270);
	                }
            ?>
                <li>
                    <a href="<?php echo esc_url($permalink) ?>">
                        <img src="<?php echo esc_url($thumbnail_url) ?>" alt="<?php echo esc_attr($title_post) ?>">
                    </a>
                </li>
            <?php
                endwhile;
                wp_reset_postdata(); ?>
            </ul>
        </div>
        <?php
        }
        echo wp_kses_post($after_widget);
    }
}
if (!function_exists('darna_register_widget_recent_portfolio')) {
    function darna_register_widget_recent_portfolio() {
        register_widget('Darna_Recent_Portfolio');
    }
    add_action('widgets_init', 'darna_register_widget_recent_portfolio', 1);
}