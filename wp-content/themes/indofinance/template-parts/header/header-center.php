<?php
/**
 * Header Layout - Center
 */
$layout = isset($args['layout']) ? $args['layout'] : '';

?>
<div class="branding-wrapper <?php echo esc_attr($layout); ?>">
    <?php get_template_part('inc/modules/branding'); ?>
            <?php get_template_part('template-parts/header/widget//header-ad-banner');
            get_template_part('inc/modules/nav-mobile');?>
</div>
<div class="nav-wrapper">
    <div class="<?php echo esc_attr($layout); ?>">
        <?php get_template_part('inc/modules/nav-desktop'); ?>
        <?php get_template_part('inc/modules/search'); ?>
    </div>
</div>


