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
$archive_link =get_post_type_archive_link('portfolio');
global $g5plus_darna_options;
if(isset($g5plus_darna_options['portfolio_archive_link']) && $g5plus_darna_options['portfolio_archive_link']!='')
    $archive_link = $g5plus_darna_options['portfolio_archive_link'];

?>
<div class="portfolio-navigation-wrap">

    <?php
    previous_post_link('<div class="nav-previous">%link</div>',_x('<i class="fa fa-angle-left"></i>','Previous post link','g5plus-darna'));
    ?>
    <div class="portfolio-archive">
       <a href="<?php echo esc_url($archive_link ) ?>"><i class="fa fa-th"></i></a>
    </div>
   <?php next_post_link('<div class="nav-next">%link</div>', _x('<i class="fa fa-angle-right"></i>','Next post link','g5plus-darna'));
    ?>
</div>


