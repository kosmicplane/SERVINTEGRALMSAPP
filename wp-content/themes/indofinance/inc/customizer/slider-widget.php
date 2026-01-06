<?php
/**
 * Featured Posts Slider Widget
 */

class IndoFinance_Featured_Posts_Slider_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'indofinance_featured_posts_slider_widget',
            __('IndoFinance Featured Posts Slider', 'indofinance'),
            array('description' => __('Displays a featured posts slider using Swiper JS.', 'indofinance'))
        );
    }

    public function widget($args, $instance) {
        $number_of_posts = !empty($instance['number_of_posts']) ? absint($instance['number_of_posts']) : 4;
        $order = !empty($instance['order']) ? $instance['order'] : 'DESC';
        $category = !empty($instance['category']) ? absint($instance['category']) : '';

        $featured_post_slider_args = array(
            'posts_per_page'      => $number_of_posts,
            'ignore_sticky_posts' => 1,
            'order'               => $order,
            'cat'                 => $category,
        );

        $featured_post_slider = new WP_Query($featured_post_slider_args);

        echo $args['before_widget'];
        if ($featured_post_slider->have_posts()) {
            echo '<div class="swiper-container swiper-widget-slider">';
            echo '<div class="swiper-wrapper">';
            while ($featured_post_slider->have_posts()) {
                $featured_post_slider->the_post();

                $link = get_permalink();
                $title = get_the_title();
                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

                // Each post as a swiper slide
                echo '<div class="swiper-slide" style="background-image: url(' . esc_url($thumbnail_url) . ');">';
                echo '<div class="slide-overlay">';
                echo '<div class="post-details-wrapper">';
                
                // Display post category
                $categories = get_the_category();
                if (!empty($categories)) {
                    echo '<div class="post-category">' . esc_html($categories[0]->name) . '</div>';
                }
                echo '<a href="' . esc_url($link) . '" title="' . esc_attr($title) . '">';
                echo '<h2 class="slide-title">' . esc_html($title) . '</h2>';
                echo '</a>';

                // Display post author and date
                echo '<div class="post-meta">';
                echo '<span class="post-author">' . esc_html__('By', 'indofinance') . ' ' . get_the_author() . '</span>';
                echo '<span class="post-date">' . esc_html(get_the_date()) . '</span>';
                echo '</div>'; // End of .post-meta

                echo '</div>'; // End of .post-details-wrapper
                echo '</div>'; // End of .slide-overlay
                echo '</div>'; // End of .swiper-slide
            }
            echo '</div>'; // End of .swiper-wrapper
            echo '</div>'; // End of .swiper-container
        }
        wp_reset_postdata();
        echo $args['after_widget'];
    }

    public function form($instance) {
        $number_of_posts = !empty($instance['number_of_posts']) ? $instance['number_of_posts'] : 4;
        $order = !empty($instance['order']) ? $instance['order'] : 'DESC';
        $category = !empty($instance['category']) ? $instance['category'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_posts'); ?>"><?php _e('Number of Posts:', 'indofinance'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="number" value="<?php echo esc_attr($number_of_posts); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('order'); ?>"><?php _e('Order:', 'indofinance'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                <option value="DESC" <?php selected($order, 'DESC'); ?>><?php _e('Descending', 'indofinance'); ?></option>
                <option value="ASC" <?php selected($order, 'ASC'); ?>><?php _e('Ascending', 'indofinance'); ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category ID:', 'indofinance'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" type="number" value="<?php echo esc_attr($category); ?>" />
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['number_of_posts'] = !empty($new_instance['number_of_posts']) ? absint($new_instance['number_of_posts']) : 4;
        $instance['order'] = !empty($new_instance['order']) ? sanitize_text_field($new_instance['order']) : 'DESC';
        $instance['category'] = !empty($new_instance['category']) ? absint($new_instance['category']) : '';
        return $instance;
    }
}

// Register the widget
function indofinance_register_featured_posts_slider_widget() {
    register_widget('IndoFinance_Featured_Posts_Slider_Widget');
}
add_action('widgets_init', 'indofinance_register_featured_posts_slider_widget');
