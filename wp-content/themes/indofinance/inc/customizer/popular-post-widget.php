<?php
/**
 * Adds Popular Posts Widget.
 */
class indofinance_Popular_Posts_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'indofinance_popular_posts_widget',
            esc_html__('Popular Posts', 'indofinance'),
            array('description' => esc_html__('Displays popular posts.', 'indofinance'))
        );
    }

    public function widget($args, $instance) {
        $title            = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $number_of_posts = !empty($instance['number_of_posts']) ? absint($instance['number_of_posts']) : 4;
        $order           = !empty($instance['order']) ? $instance['order'] : 'random';
        $category        = !empty($instance['category']) ? absint($instance['category']) : '';

        echo $args['before_widget'];

        if (!empty($title)) {
            echo $args['before_title'] . apply_filters('widget_title', $title) . $args['after_title'];
        }
        

        // Query Args
        $query_args = array(
            'posts_per_page'      => $number_of_posts,
            'ignore_sticky_posts' => 1,
            $order = !empty($instance['order']) ? esc_attr($instance['order']) : 'DESC',
            'order'               => 'DESC',
        );

        if (!empty($category)) {
            $query_args['cat'] = $category;
        }

        $popular_posts = new WP_Query($query_args);

        if ($popular_posts->have_posts()) {
            echo '<div class="popular-posts-widget">';

            $counter = 0;
            while ($popular_posts->have_posts()) {
                $popular_posts->the_post();
                $link = get_the_permalink();
                $post_title = get_the_title();

                if ($counter == 0) {
                    echo '<div class="popular-posts full">';
                } elseif ($counter == 1) {
                    echo '<div class="popular-posts-grid">';
                }

                echo '<div class="popular-post">';
                echo '<div class="popular-post-thumb">';
                printf('<a href="%s" title="%s">', esc_url($link), esc_attr($post_title));
                if (has_post_thumbnail()) {
                    the_post_thumbnail();
                } else {
                    echo '<img src="' . esc_url(get_template_directory_uri() . '/images/thumbnail.jpg') . '" alt="No image">';
                }
                echo '</a>';
                echo '</div>';
                echo '<div class="popular-post-content">';
                printf('<h4 class="popular-post-title"><a href="%s" title="%s">%s</a></h4>', esc_url($link), esc_attr($post_title), esc_html($post_title));
                echo '<div class="popular-post-meta">';
                indofinance_posted_on();
                echo '</div>';
                echo '</div>';
                echo '</div>';

                if ($counter == 0) {
                    echo '</div>'; // Close full-width div
                }

                $counter++;
            }

            if ($counter > 1) {
                echo '</div>'; // Close grid container
            }

            echo '</div>'; // Close widget wrapper
        }

        wp_reset_postdata();
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? esc_attr($instance['title']) : esc_html__('Popular Posts', 'indofinance');
        $number_of_posts = !empty($instance['number_of_posts']) ? absint($instance['number_of_posts']) : 4;
        $order = !empty($instance['order']) ? esc_attr($instance['order']) : 'random';
        $category = !empty($instance['category']) ? absint($instance['category']) : '';

        // Title Field
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                <?php esc_html_e('Title:', 'indofinance'); ?>
            </label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                   type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <!-- Number of Posts Field -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>">
                <?php esc_html_e('Number of Posts:', 'indofinance'); ?>
            </label>
            <input class="tiny-text" id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>"
                   type="number" step="1" min="1" value="<?php echo esc_attr($number_of_posts); ?>">
        </p>

        <!-- Order Field -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('order')); ?>">
                <?php esc_html_e('Order:', 'indofinance'); ?>
            </label>
            <select id="<?php echo esc_attr($this->get_field_id('order')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('order')); ?>" class="widefat">
                <option value="random" <?php selected($order, 'random'); ?>><?php esc_html_e('Random', 'indofinance'); ?></option>
                <option value="DESC" <?php selected($order, 'DESC'); ?>><?php esc_html_e('Latest', 'indofinance'); ?></option>
            </select>
        </p>

        <!-- Category Selection -->
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('category')); ?>">
                <?php esc_html_e('Category:', 'indofinance'); ?>
            </label>
            <select id="<?php echo esc_attr($this->get_field_id('category')); ?>"
                    name="<?php echo esc_attr($this->get_field_name('category')); ?>" class="widefat">
                <option value=""><?php esc_html_e('All Categories', 'indofinance'); ?></option>
                <?php
                $categories = get_categories(array('hide_empty' => false));
                foreach ($categories as $cat) {
                    ?>
                    <option value="<?php echo esc_attr($cat->term_id); ?>" <?php selected($category, $cat->term_id); ?>>
                        <?php echo esc_html($cat->name); ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? absint($new_instance['number_of_posts']) : 4;
        $instance['order'] = (!empty($new_instance['order'])) ? sanitize_text_field($new_instance['order']) : 'random';
        $instance['category'] = (!empty($new_instance['category'])) ? absint($new_instance['category']) : '';

        return $instance;
    }
}

// Register the widget
function indofinance_register_popular_posts_widget() {
    register_widget('indofinance_Popular_Posts_Widget');
}
add_action('widgets_init', 'indofinance_register_popular_posts_widget');
