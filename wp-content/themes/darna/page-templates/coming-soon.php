<?php
/**
 * Template Name: Coming Soon
 *
 * @package darna
 */

remove_action('g5plus_before_page_wrapper_content','g5plus_page_above_header',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_top_bar',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);

get_header();
?>
<?php echo do_shortcode('[darna_countdown_shortcode type="comming-soon"]');?>
<?php
    remove_action('g5plus_main_wrapper_footer','g5plus_footer_widgets',10);
    get_footer();
?>