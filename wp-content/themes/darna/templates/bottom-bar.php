<?php
$bottom_bar = get_post_meta(get_the_ID(),'g5plus_bottom_bar',true);
if (!isset($bottom_bar) || $bottom_bar === '-1' || $bottom_bar=='') {
    $bottom_bar = g5plus_get_option('bottom_bar','1');
}

$bottom_bar_layout = get_post_meta(get_the_ID(),'g5plus_bottom_bar_layout',true);
if (!isset($bottom_bar_layout) ||  $bottom_bar_layout == '-1' || $bottom_bar_layout=='') {
    $bottom_bar_layout = g5plus_get_option('bottom_bar_layout','bottom-bar-1');
}

$bottom_bar_left_sidebar = get_post_meta(get_the_ID(),'g5plus_bottom_bar_left_sidebar',true);
if (!isset($bottom_bar_left_sidebar) || $bottom_bar_left_sidebar == '-1' || $bottom_bar_left_sidebar == '') {
    $bottom_bar_left_sidebar = g5plus_get_option('bottom_bar_left_sidebar','bottom_bar_left');
}

$bottom_bar_right_sidebar = get_post_meta(get_the_ID(),'g5plus_bottom_bar_right_sidebar',true);

if (!isset($bottom_bar_right_sidebar) ||  $bottom_bar_right_sidebar == '-1' || $bottom_bar_right_sidebar == '') {
    $bottom_bar_right_sidebar = g5plus_get_option('bottom_bar_right_sidebar','bottom_bar_right');
}


$col_left_class = $col_right_class = 'col-md-6';

if($bottom_bar_layout ==='bottom-bar-2'){
    $col_left_class =  'col-md-9';
    $col_right_class = 'col-md-3';
}
if($bottom_bar_layout ==='bottom-bar-3'){
    $col_left_class =  'col-md-3';
    $col_right_class = 'col-md-9';
}

if($bottom_bar==='1' && ( ($bottom_bar_left_sidebar!='' && is_active_sidebar($bottom_bar_left_sidebar)) ||
                            ($bottom_bar_right_sidebar!='' && is_active_sidebar($bottom_bar_right_sidebar))
   ) ){
?>
<div class="bottom-bar-wrapper">
    <div class="container">
	    <div class="bottom-bar-inner">
		    <div class="row">
			    <div class="<?php echo esc_attr($col_left_class) ?> sidebar sidebar-bottom-left">
				    <?php if($bottom_bar_left_sidebar!='' && is_active_sidebar($bottom_bar_left_sidebar)) {
					    dynamic_sidebar($bottom_bar_left_sidebar);
				    }
				    ?>
			    </div>
			    <div class="<?php echo esc_attr($col_right_class) ?> sidebar sidebar-bottom-right">
				    <?php if($bottom_bar_right_sidebar!='' && is_active_sidebar($bottom_bar_right_sidebar)) {
					    dynamic_sidebar($bottom_bar_right_sidebar);
				    }
				    ?>
			    </div>
		    </div>
	    </div>
    </div>
</div>
<?php } ?>