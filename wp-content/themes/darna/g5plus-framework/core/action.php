<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/19/2015
 * Time: 3:59 PM
 */
if (!function_exists('g5plus_custom_style_wp_head')) {
	function g5plus_custom_style_wp_head()
	{
		echo '<style id="g5plus_custom_style"></style>';

	}
	add_action('wp_head','g5plus_custom_style_wp_head', 100);
}

/*---------------------------------------------------
/* SEARCH AJAX
/*---------------------------------------------------*/
if (!function_exists('g5plus_result_search_callback')) {
    function g5plus_result_search_callback() {
        ob_start();

        $posts_per_page = 8;
        $opt_search_box_result_amount = g5plus_get_option('search_box_result_amount');
        if (!empty($opt_search_box_result_amount)) {
            $posts_per_page = $opt_search_box_result_amount;
        }

        $post_type = array();
        $opt_search_box_post_type = g5plus_get_option('search_box_post_type',array(
	        'post'      => '1',
	        'page'      => '1',
	        'product'   => '1',
	        'portfolio' => '1',
	        'testimonial' => '1',
        ));
        if (is_array($opt_search_box_post_type)) {
            foreach($opt_search_box_post_type as $key => $value) {
                if ($value == 1) {
                    $post_type[] = $key;
                }
            }
        }


        $keyword = $_REQUEST['keyword'];

        if ( $keyword ) {
            $search_query = array(
                's' => $keyword,
                'order'     	=> 'DESC',
                'orderby'   	=> 'date',
                'post_status'	=> 'publish',
                'post_type' 	=> $post_type,
                'posts_per_page'         => $posts_per_page + 1,
            );
            $search = new WP_Query( $search_query );

            $newdata = array();
            if ($search && count($search->post) > 0) {
                $count = 0;
                foreach ( $search->posts as $post ) {
                    if ($count == $posts_per_page) {
                        $newdata[] = array(
                            'id'        => -2,
                            'title'     => '<a href="' . site_url() .'?s=' . $keyword . '"><i class="fa fa-mail-forward"></i> ' . esc_html__('View More','g5plus-darna') . '</a>',
                            'guid'      => '',
                            'date'      => null,
                        );

                        break;
                    }
                    $newdata[] = array(
                        'id'        => $post->ID,
                        'title'     => $post->post_title,
                        'guid'      => get_permalink( $post->ID ),
                        'date'      => mysql2date( 'M d Y', $post->post_date ),
                    );
                    $count++;

                }
            }
            else {
                $newdata[] = array(
                    'id'        => -1,
                    'title'     => esc_html__('Sorry, but nothing matched your search terms. Please try again with different keywords.','g5plus-darna'),
                    'guid'      => '',
                    'date'      => null,
                );
            }

            ob_end_clean();
            echo json_encode( $newdata );
        }
        die(); // this is required to return a proper result
    }
    add_action( 'wp_ajax_nopriv_result_search', 'g5plus_result_search_callback' );
    add_action( 'wp_ajax_result_search', 'g5plus_result_search_callback' );

}

/*---------------------------------------------------
/* Product Quick View
/*---------------------------------------------------*/
if (!function_exists('g5plus_product_quick_view_callback')) {
	function g5plus_product_quick_view_callback() {
		$product_id = $_REQUEST['id'];
		global $post, $product, $woocommerce;
		$post = get_post($product_id);
		setup_postdata($post);
		$product = wc_get_product( $product_id );
		wc_get_template_part('content-product-quick-view');
		wp_reset_postdata();
		die();
	}
	add_action( 'wp_ajax_nopriv_product_quick_view', 'g5plus_product_quick_view_callback' );
	add_action( 'wp_ajax_product_quick_view', 'g5plus_product_quick_view_callback' );
}






