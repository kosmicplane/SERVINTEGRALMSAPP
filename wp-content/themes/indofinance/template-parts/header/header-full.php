<?php
/**
 * Header Layout - Full
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>

<div class="top-wrapper <?php echo esc_attr($layout); ?>">
    <?php get_template_part('inc/modules/branding'); ?>

    <div class="search-dk-mod-wrapper">
        <?php get_template_part('inc/modules/nav-mobile'); ?>
    </div>
</div>

