<?php
/**
 * Header Layout - Default
 * 
 * @package indofinance
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>

<div class="top-wrapper <?php echo esc_attr($layout); ?>">
    <?php
        get_template_part('inc/modules/branding');
        get_template_part('inc/modules/nav-desktop');
    ?>
        <div class="search-dk-mod-wrapper">
            <?php get_template_part('inc/modules/modules/search'); ?>
        </div>



    <?php get_template_part('inc/modules/nav-mobile'); ?>
</div>
