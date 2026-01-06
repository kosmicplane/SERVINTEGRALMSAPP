<?php
/**
 * Template for Header - Widget Layout
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>
<div class="top-wrapper <?php echo esc_attr($layout); ?>">
    <div class="branding-wrapper">
        <?php get_template_part('inc/modules/branding'); ?>
        
        <div class="header-widget-wrapper">
            <?php
                if ( is_active_sidebar('header-widget' ) ) {
                    dynamic_sidebar('header-widget');
                }
            ?>
        </div>
    </div>

    <div class="nav-wrapper">
        <?php
            get_template_part('inc/modules/nav-desktop');
            get_template_part('inc/modules/modules/search');
            get_template_part('inc/modules/nav-mobile');?>
            
    </div>
</div>