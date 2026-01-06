<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/17/2015
 * Time: 5:29 PM
 */
class G5Plus_Widget_Posts extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-posts';
        $this->widget_description = __( "Posts widget", 'g5plus-darna' );
        $this->widget_id          = 'g5plus-posts';
        $this->widget_name        = __( 'G5Plus: Posts', 'g5plus-darna' );
        $this->settings           = array(
            'title' => array(
                'type' => 'text',
                'std' => '',
                'label' => __('Title','g5plus-darna')
            ),
            'source'  => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => __( 'Source', 'g5plus-darna' ),
                'options' => array(
                    'random' => __('Random','g5plus-darna'),
                    'popular' => __('Popular','g5plus-darna'),
                    'recent'  => __( 'Recent', 'g5plus-darna' ),
                    'oldest' => __('Oldest','g5plus-darna')
                )
            ),
            'number' => array(
                'type'  => 'number',
                'std'   => '5',
                'label' => __( 'Number of posts to show', 'g5plus-darna' ),
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) )
            return;

        extract( $args, EXTR_SKIP );
        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
        $source        = empty( $instance['source'] ) ? '' : $instance['source'];
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $class_custom = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
        $query_args = array();

        switch ($source) {
            case 'random' :
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'rand',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
            case 'popular':
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'comment_count',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;

            case 'recent':
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
            case 'oldest':
                $query_args = array(
                    'posts_per_page' => $number,
                    'no_found_rows' => true,
                    'post_status' => 'publish',
                    'ignore_sticky_posts' => true,
                    'orderby' => 'post_date',
                    'order' => 'ASC',
                    'post_type' => 'post',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'post_format',
                            'field' => 'slug',
                            'terms' => array('post-format-quote', 'post-format-link', 'post-format-audio','post-format-video'),
                            'operator' => 'NOT IN'
                        )
                    )
                );
                break;
        }

        $class = array('widget-posts-wrap');
        if  (!empty($class_custom)) {
            $class[] = $class_custom;
        }

        ob_start();
        $r = new WP_Query( $query_args);
        if ($r->have_posts()) : ?>
            <?php echo wp_kses_post($args['before_widget']); ?>
            <?php if ( $title ) {
                echo wp_kses_post($args['before_title'] . $title . $args['after_title']);
            } ?>
            <div class="<?php echo join(' ',$class); ?>">
                <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                    <div class="widget_posts_item clearfix">
                        <?php
                            $thumbnail = g5plus_post_thumbnail('thumbnail');
                            if (!empty($thumbnail)) : ?>
                                <div class="widget-posts-thumbnail">
                                    <?php echo wp_kses_post($thumbnail); ?>
                                </div>
                            <?php endif; ?>
                        <div class="widget-posts-content-wrap">
                            <div class="widget-posts-date">
                                <?php echo get_the_date(); ?>
                            </div>
                            <a class="widget-posts-title" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
            <?php echo wp_kses_post($args['after_widget']); ?>
        <?php endif;
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();
        $content =  ob_get_clean();
        echo wp_kses_post($content);
        $this->cache_widget( $args, $content );
    }
}

if (!function_exists('g5plus_register_widget_posts')) {
    function g5plus_register_widget_posts() {
        register_widget('G5Plus_Widget_Posts');
    }
    add_action('widgets_init', 'g5plus_register_widget_posts', 1);
}