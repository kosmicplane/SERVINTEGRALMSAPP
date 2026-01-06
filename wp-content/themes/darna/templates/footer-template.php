<?php
$footer_layout = get_post_meta(get_the_ID(),'g5plus_footer_layout',true);

if (!isset($footer_layout) || $footer_layout == '-1' || $footer_layout == '') {
    $footer_layout = g5plus_get_option('footer_layout','footer-1');
}

$col_footer = 0;
for ($i=1; $i<=4; $i++) {
    if(is_active_sidebar('footer-'. $i)) {
        $col_footer +=1;
    }
}
$col_footer_class = array();

if($footer_layout=='footer-1'){
    $col_footer_class[0] = $col_footer_class[1] = $col_footer_class[2] = $col_footer_class[3] =  'col-md-3 col-sm-6';
}
if($footer_layout=='footer-2'){
    $col_footer_class[0] = 'col-md-6 col-sm-12';
    $col_footer_class[1] = $col_footer_class[2] = 'col-md-3 col-sm-6';
}

if($footer_layout=='footer-3'){
    $col_footer_class[0] = $col_footer_class[1] = 'col-md-3 col-sm-6';
    $col_footer_class[2] = 'col-md-6 col-sm-12';
}

if($footer_layout=='footer-4'){
    $col_footer_class[0] = $col_footer_class[1] = 'col-md-6 col-sm-12';
}

if($footer_layout=='footer-5'){
    $col_footer_class[0] = $col_footer_class[1] = $col_footer_class[2] = 'col-md-4 col-sm-12';
}

if($footer_layout=='footer-6'){
    $col_footer_class[0] = 'col-md-9 col-sm-12';
    $col_footer_class[1] = 'col-md-3 col-sm-12';
}

if($footer_layout=='footer-7'){
    $col_footer_class[0] = 'col-md-3 col-sm-12';
    $col_footer_class[1] = 'col-md-9 col-sm-12';
}

if($footer_layout=='footer-8'){
    $col_footer_class[0] = 'col-md-3 col-sm-12';
    $col_footer_class[1] = 'col-md-6 col-sm-12';
    $col_footer_class[2] = 'col-md-3 col-sm-12';
}

if($footer_layout=='footer-9'){
    $col_footer_class[0] = 'col-md-12 col-sm-12';
}

$footer_above_layout = g5plus_get_option('footer_above_layout','col-md-6 col-md-push-3');
?>
<div class="main-footer">
	<div class="footer_inner clearfix">
		<?php if(is_active_sidebar('footer-above')):?>
			<div class="container">
				<div class="row">
					<div class="<?php echo esc_attr($footer_above_layout) ?>">
						<div class="footer-above-wrapper sidebar">
							<?php dynamic_sidebar('footer-above'); ?>
						</div>
					</div>
				</div>
			</div>
		<?php endif;?>
		<?php if ($col_footer > 0):?>
			<div class="footer_top_holder col-<?php echo esc_attr($col_footer); ?>">
				<div class="container">
					<div class="row footer-top-col-<?php echo esc_attr($col_footer . ' ' . $footer_layout); ?>">
						<?php
						for ($j=1; $j<=4; $j++) {
							if(is_active_sidebar('footer-'. $j)) {
								if(count($col_footer_class) >= $j ){
									echo '<div class="sidebar '. esc_attr($col_footer_class[$j-1]).' col-'. $j .'">';
									dynamic_sidebar('footer-'. $j);
									echo '</div>';
								}
							}
						}
						?>
					</div>
				</div>
			</div>
		<?php endif;?>

	</div>
</div>