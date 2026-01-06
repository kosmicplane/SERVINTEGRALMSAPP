<?php
$opt_mobile_header_menu_drop = g5plus_get_option('mobile_header_menu_drop','fly');

if ($opt_mobile_header_menu_drop == 'fly'):
?>
<div class="main-menu-overlay"></div>
<?php
endif;