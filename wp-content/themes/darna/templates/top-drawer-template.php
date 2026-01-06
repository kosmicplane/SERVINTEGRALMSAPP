<?php
$top_drawer_sidebar = g5plus_get_option('top_drawer_sidebar','top_drawer_sidebar');
$top_drawer_type = g5plus_get_option('top_drawer_type','none');
$top_drawer_wrapper_layout = g5plus_get_option('top_drawer_wrapper_layout','container');
$top_drawer_class='top-drawer-show';
if ($top_drawer_type!='show') {
    $top_drawer_class = 'top-drawer-hide';
}
?>
<?php if ((is_active_sidebar( $top_drawer_sidebar)) && $top_drawer_type!='none'): ?>
<div id="top-drawer-area" class="hidden-sm hidden-xs">
    <div id="top-drawer-bar" class="<?php echo esc_attr($top_drawer_class); ?>">
        <?php if($top_drawer_wrapper_layout!='full'):?>
        <div class="<?php echo esc_attr($top_drawer_wrapper_layout) ?>">
        <?php endif;?>
            <div class="sidebar sidebar-top-drawer row">
                <?php dynamic_sidebar( $top_drawer_sidebar );?>
            </div>
        <?php if($top_drawer_wrapper_layout!='full'):?>
        </div>
        <?php endif;?>
    </div>
    <?php if ($top_drawer_type!='show'): ?>
        <a href="#" class="top-drawer-toggle"></a>
    <?php endif;?>
</div>
<?php endif;?>