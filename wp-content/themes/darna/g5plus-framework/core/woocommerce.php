<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/8/2015
 * Time: 3:24 PM
 */
if ( class_exists( 'WooCommerce' ) ) {
    /*================================================
    FILTER HOOK
    ================================================== */
    remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
    add_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_price',5);


    /*================================================
    RESET LOOP
    ================================================== */
    if (!function_exists('g5plus_woocommerce_reset_loop')) {
        function g5plus_woocommerce_reset_loop() {
            global $g5plus_woocommerce_loop;
            $g5plus_woocommerce_loop['layout'] = '';
            $g5plus_woocommerce_loop['single_columns'] = '';
            $g5plus_woocommerce_loop['columns'] = '';
	        $g5plus_woocommerce_loop['autoPlay'] = 'false';

        }
    }

    /*================================================
    LOOP CATEGORY TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocommerce_template_loop_category')) {
        function g5plus_woocommerce_template_loop_category() {
            wc_get_template( 'loop/category.php' );
        }
        add_action('woocommerce_after_shop_loop_item_title','g5plus_woocommerce_template_loop_category',1);
    }

    /*================================================
    LOOP NAME TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocommerce_template_loop_name')) {
        function g5plus_woocommerce_template_loop_name() {
            wc_get_template( 'loop/name.php' );
        }
        add_action('woocommerce_after_shop_loop_item_title','g5plus_woocommerce_template_loop_name',1);
    }

    /*================================================
    LOOP LINK TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_link')) {
        function g5plus_woocomerce_template_loop_link() {
            wc_get_template( 'loop/link.php' );
        }
        add_action('woocommerce_before_shop_loop_item_title','g5plus_woocomerce_template_loop_link',20);
    }

    /*================================================
    QUICK VIEW TEMPLATE
    ================================================== */
    if (!function_exists('g5plus_woocomerce_template_loop_quick_view')) {
        function g5plus_woocomerce_template_loop_quick_view() {
            wc_get_template( 'loop/quick-view.php' );
        }
        add_action('woocommerce_before_shop_loop_item_title','g5plus_woocomerce_template_loop_quick_view',15);
    }





    /*================================================
    FILTER PRODUCTS PER PAGE
    ================================================== */
    if (!function_exists('g5plus_show_products_per_page')) {
        function g5plus_show_products_per_page() {
            $product_per_page = g5plus_get_option('product_per_page','12');
            if (empty($product_per_page)) {
                $product_per_page = 12;
            }
            $page_size = isset($_GET['page_size']) ? wc_clean($_GET['page_size']) : $product_per_page;
            return $page_size;
        }
        add_filter('loop_shop_per_page', 'g5plus_show_products_per_page');
    }


    /*================================================
    OVERWRITE LOOP PRODUCT THUMBNAIL
    ================================================== */
    if (!function_exists('woocommerce_template_loop_product_thumbnail')) {
        /**
         * Get the product thumbnail for the loop.
         *
         * @access public
         * @subpackage    Loop
         * @return void
         */
        function woocommerce_template_loop_product_thumbnail() {
            global $product;
            $attachment_ids  = $product->get_gallery_image_ids();
            $secondary_image = '';
            $class           = 'product-thumb-one';
            if ( $attachment_ids ) {
                $secondary_image_id = $attachment_ids['0'];
                $secondary_image    = wp_get_attachment_image( $secondary_image_id, apply_filters( 'shop_catalog', 'shop_catalog' ) );
                if ( ! empty( $secondary_image ) ) {
                    $class = 'product-thumb-primary';
                }
            }
            ?>
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="<?php echo esc_attr( $class ); ?>">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                </div>
                <?php if ( ! empty( $secondary_image ) ) : ?>
                    <div class="product-thumb-secondary">
                        <?php echo wp_kses_post( $secondary_image ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php
        }
    }

    /*================================================
    PRODUCT NEWS
    ================================================== */
    if (!function_exists('g5plus_woocommerce_add_custom_general_fields')) {
        function g5plus_woocommerce_add_custom_general_fields() {
            echo '<div class="options_group">';
            woocommerce_wp_checkbox(
                array(
                    'id' => 'g5plus_product_new',
                    'label' => esc_html__('Product New', 'g5plus-darna')
                )
            );
            echo '</div>';
        }
        add_action('woocommerce_product_options_general_product_data', 'g5plus_woocommerce_add_custom_general_fields');
    }

    if (!function_exists('g5plus_woo_add_custom_general_fields_save')) {
        function g5plus_woo_add_custom_general_fields_save($post_id) {
            $g5plus_product_new = isset($_POST['g5plus_product_new']) ? 'yes' : 'no';
            update_post_meta($post_id, 'g5plus_product_new', $g5plus_product_new);
        }
        add_action('woocommerce_process_product_meta', 'g5plus_woo_add_custom_general_fields_save');
    }

    if (!function_exists('g5plus_columns_into_product_list')) {
        function g5plus_columns_into_product_list($defaults) {
            $defaults['g5plus_product_new'] = 'New';
            return $defaults;
        }
        add_filter('manage_edit-product_columns', 'g5plus_columns_into_product_list');
    }

    if (!function_exists('g5plus_column_into_product_list')) {
        function g5plus_column_into_product_list($column, $post_id) {
            switch ($column) {
                case 'g5plus_product_new':
                    echo get_post_meta($post_id, 'g5plus_product_new', true);
                    break;
            }
        }
        add_action('manage_product_posts_custom_column', 'g5plus_column_into_product_list', 10, 2);
    }

    if (!function_exists('g5plus_sortable_columns')) {
        function g5plus_sortable_columns() {
            return array(
                'g5plus_product_new' => 'g5plus_product_new'
            );
        }
        add_filter("manage_edit-product_sortable_columns", "g5plus_sortable_columns");
    }

    if (!function_exists('g5plus_event_column_orderby')) {
        function g5plus_event_column_orderby($query) {
            if (!is_admin())
                return;
            $orderby = $query->get('orderby');
            if ('g5plus_product_new' == $orderby) {
                $query->set('meta_key', 'g5plus_product_new');
                $query->set('orderby', 'meta_value_num');
            }
        }
        add_action('pre_get_posts', 'g5plus_event_column_orderby');
    }


    /*================================================
    SINGLE PRODUCT
    ================================================== */
    remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
    add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',15);

    if (!function_exists('g5plus_product_description_heading')) {
        function g5plus_product_description_heading() {
            return '';
        }
    }
    add_filter('woocommerce_product_description_heading','g5plus_product_description_heading');
    add_filter('woocommerce_product_additional_information_heading','g5plus_product_description_heading');


    if (!function_exists('g5plus_related_products_args')) {
        function g5plus_related_products_args() {
            $args['posts_per_page'] = g5plus_get_option('related_product_count',8);
            return $args;
        }
        add_filter('woocommerce_output_related_products_args', 'g5plus_related_products_args');
    }

    if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_category')) {
        function g5plus_woocommerce_product_related_posts_relate_by_category() {
            $opt_related_product_condition = g5plus_get_option('related_product_condition',array(
	            'category'      => '1',
	            'tag'      => '1',
            ));
            return isset($opt_related_product_condition['category']) && ($opt_related_product_condition['category'] == 1) ? true : false;
        }
        add_filter('woocommerce_product_related_posts_relate_by_category','g5plus_woocommerce_product_related_posts_relate_by_category');
    }

    if (!function_exists('g5plus_woocommerce_product_related_posts_relate_by_tag')) {
        function g5plus_woocommerce_product_related_posts_relate_by_tag() {
	        $opt_related_product_condition = g5plus_get_option('related_product_condition',array(
		        'category'      => '1',
		        'tag'      => '1',
	        ));
            return isset($opt_related_product_condition['tag']) && ($opt_related_product_condition['tag'] == 1) ? true : false;
        }
        add_filter('woocommerce_product_related_posts_relate_by_tag','g5plus_woocommerce_product_related_posts_relate_by_tag');
    }


    /*================================================
    SHOPPING CART
    ================================================== */
    remove_action('woocommerce_cart_collaterals','woocommerce_cross_sell_display');
    add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display',15 );
    add_action('woocommerce_before_cart_totals','woocommerce_shipping_calculator',5);

    if (!function_exists('g5plus_button_continue_shopping')) {
        function g5plus_button_continue_shopping () {
            $continue_shopping =  get_permalink( wc_get_page_id( 'shop' ) );
            ?>
            <a href="<?php echo esc_url($continue_shopping); ?>" class="continue-shopping button"><?php _e( 'Continue shopping', 'g5plus-darna' ); ?></a>
            <?php
        }
    }


    if (!function_exists('g5plus_woocommerce_sale_flash')) {
        function g5plus_woocommerce_sale_flash($sale_flash,$post,$product) {
            $product_sale_flash_mode = g5plus_get_option('product_sale_flash_mode','text');
            if ($product_sale_flash_mode == 'percent') {
                $sale_percent = 0;
                if ($product->is_on_sale() && $product->get_type() != 'grouped') {
                    if ($product->get_type() == 'variable') {
                        $available_variations =  $product->get_available_variations();
                        for ($i = 0; $i < count($available_variations); ++$i) {
                            $variation_id = $available_variations[$i]['variation_id'];
                            $variable_product1 = new WC_Product_Variation( $variation_id );
                            $regular_price = $variable_product1->get_regular_price();
                            $sales_price = $variable_product1->get_sale_price();
                            $price = $variable_product1->get_price();
                            if ( $sales_price != $regular_price && $sales_price == $price ) {
                                $percentage= round((( ( $regular_price - $sales_price ) / $regular_price ) * 100),1) ;
                                if ($percentage > $sale_percent) {
                                    $sale_percent = $percentage;
                                }
                            }
                        }
                    } else {
                        $sale_percent = round((( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100),1) ;
                    }
                }
                if ($sale_percent > 0) {
                    return '<span class="on-sale">' . $sale_percent . '%</span>';
                } else {
                    return "";
                }

            }
            return $sale_flash;
        }
        add_filter('woocommerce_sale_flash','g5plus_woocommerce_sale_flash',10,3);
    }


	/*Quick View*/
	add_action('g5plus_before_quick_view_product_summary','woocommerce_show_product_sale_flash',10);
	if (!function_exists('g5plus_quick_view_product_images')) {
		function g5plus_quick_view_product_images() {
			wc_get_template( 'quick-view/product-image.php' );
		}
		add_action('g5plus_before_quick_view_product_summary','g5plus_quick_view_product_images',20);
	}


	if (!function_exists('g5plus_template_quick_view_product_title')) {
		function g5plus_template_quick_view_product_title() {
			wc_get_template( 'quick-view/title.php' );
		}
		add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_title',5);
	}

	if (!function_exists('g5plus_template_quick_view_product_rating')) {
		function g5plus_template_quick_view_product_rating() {
			wc_get_template( 'quick-view/rating.php' );
		}
		add_action('g5plus_quick_view_product_summary','g5plus_template_quick_view_product_rating',15);
	}

	add_action('g5plus_quick_view_product_summary','woocommerce_template_single_price',10);
	add_action('g5plus_quick_view_product_summary','woocommerce_template_single_excerpt',20);
	add_action('g5plus_quick_view_product_summary','woocommerce_template_single_add_to_cart',30);
	add_action('g5plus_quick_view_product_summary','woocommerce_template_single_meta',40);
	add_action('g5plus_quick_view_product_summary','woocommerce_template_single_sharing',50);


    /*================================================
	CHANGE THE ADD TO CART TEXT ON SINGLE PRODUCT PAGES
	================================================== */
    if (!function_exists('g5plus_custom_cart_button_text')) {
        function g5plus_custom_cart_button_text() {
            return esc_html__( 'Add to cart', 'g5plus-darna' );
        }
        add_filter( 'woocommerce_product_single_add_to_cart_text', 'g5plus_custom_cart_button_text' );    // 2.1 +
    }

    /*================================================
	CHANGE THE ADD TO CART TEXT ON PRODUCT ARCHIVES
	================================================== */
    if (!function_exists('g5plus_woocommerce_product_add_to_cart_text')) {
        function g5plus_woocommerce_product_add_to_cart_text() {
            global $product;
            $product_type = $product->get_type();
            switch ( $product_type ) {
                case 'external':
                    return esc_html__( 'Buy product', 'g5plus-darna' );
                    break;
                case 'grouped':
                    return esc_html__( 'View products', 'g5plus-darna' );
                    break;
                case 'simple':
                    return esc_html__( 'Add to cart', 'g5plus-darna' );
                    break;
                case 'variable':
                    return esc_html__( 'Select options', 'g5plus-darna' );
                    break;
                default:
                    return esc_html__( 'Read more', 'g5plus-darna' );
            }
        }
        add_filter( 'woocommerce_product_add_to_cart_text' , 'g5plus_woocommerce_product_add_to_cart_text' );
    }


}
