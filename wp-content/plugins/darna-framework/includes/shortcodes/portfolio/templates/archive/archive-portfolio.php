<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 7/23/15
 * Time: 9:28 PM
 */

get_header();
do_action('g5plus_before_archive');
echo do_shortcode('[g5plusframework_portfolio show_category="center" category_style="background-cat" column="4" item="8" order="DESC" show_pagging="1" overlay_style="title-float"]');
get_footer();
?>