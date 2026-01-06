<?php
/**
 * Top Menu
 * 
 * @package indofinance
 */
?>
<div class="menu-top">
    <?php
    wp_nav_menu([
        'theme_location'	=>	'menu-top',
        'container'         =>  'ul',
        'depth'				=>	1
    ]);
    ?>
</div>