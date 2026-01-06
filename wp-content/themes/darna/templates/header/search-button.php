<?php
	$data_search_type = g5plus_get_option('search_box_type','standard') ;
?>
<div class="search-button-wrapper header-customize-item">
	<a class="icon-search-menu" href="#" data-search-type="<?php echo esc_attr($data_search_type) ?>"><i class="fa fa-search"></i></a>
</div>