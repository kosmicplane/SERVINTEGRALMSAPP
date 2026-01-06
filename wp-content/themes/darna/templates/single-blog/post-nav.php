<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/9/2015
 * Time: 8:58 AM
 */
// Don't print empty markup if there's nowhere to navigate.
$previous = (is_attachment()) ? get_post(get_post()->post_parent) : get_adjacent_post(false, '', true);
$next = get_adjacent_post(false, '', false);

if (!$next && !$previous) {
    return;
}
?>

<div class="post-navigation-wrap">
    <?php g5plus_share(); ?>
    <?php
    previous_post_link('<div class="nav-previous darna-button style3 size-md">%link</div>',_x('<i class="fa fa-angle-double-left"></i> Previous Post','Previous post link','g5plus-darna'));
    next_post_link('<div class="nav-next darna-button style1 size-md">%link</div>', _x('Next Post <i class="fa fa-angle-double-right"></i>','Next post link','g5plus-darna'));
    ?>
</div>


