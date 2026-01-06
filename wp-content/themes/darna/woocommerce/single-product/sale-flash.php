<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;
$product_new = get_post_meta(get_the_ID(),'g5plus_product_new',true);

?>
<?php if ( $product->is_on_sale() || $product_new == 'yes' ) : ?>
    <div class="product-flash-wrap">
        <?php if ($product->is_on_sale()): ?>
            <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="on-sale">' . esc_html__( 'Sale!', 'g5plus-darna' ) . '</span>', $post, $product ); ?>
        <?php endif; ?>

        <?php if ($product_new == 'yes') : ?>
            <?php echo apply_filters( 'g5plus_new_flash', '<span class="on-new">' . esc_html__( 'New', 'g5plus-darna' ) . '</span>', $post, $product ); ?>
        <?php endif; ?>
    </div>
<?php endif; ?>
