<?php
/**
 * Header Layout - Top
 * 
 * @package indofinance
 */
$layout = isset($args['layout']) ? $args['layout'] : '';
?>
    
    <div class="branding-wrapper <?php echo esc_attr($layout); ?>">
        <?php
            get_template_part('inc/modules/branding');
        ?>
    </div>
    <div class="top-container top-header">
        <div class="top-wrapper <?php echo esc_attr($layout); ?>">
        <?php
            get_template_part('inc/modules/nav-desktop');
            get_template_part('inc/modules/nav-mobile');?>
           
        
        </div>
    </div>