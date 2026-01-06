<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */
global $g5plus_woocommerce_loop;
?>
<?php if (isset($g5plus_woocommerce_loop['layout']) && ($g5plus_woocommerce_loop['layout'] == 'slider')) : ?>
	</div>
<?php endif; ?>
</div>
<?php g5plus_woocommerce_reset_loop(); ?>