<?php
$product_quick_view = g5plus_get_option('product_quick_view','1');
if ($product_quick_view == 0) {
    return;
}
?>
<div class="product-actions">
    <a  title="<?php esc_attr_e('Quick view', 'g5plus-darna') ?>" class="product-quick-view darna-button style1 size-xs" data-product_id="<?php the_ID(); ?>" href="<?php the_permalink(); ?>"><?php esc_html_e('Quick view', 'g5plus-darna') ?></a>
</div>
