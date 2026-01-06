<?php
/**
 * Desktop Navigation module
 * 
 * @package indofinance
 */
?>
<nav id="site-navigation" class="main-navigation">
    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'indofinance' ); ?></button>
    <?php
    wp_nav_menu(
        array(
            'container'      => 'div',
            'container_class'=> 'menu',
            'theme_location' => 'menu-1',
        )
    );
    ?>
</nav><!-- #site-navigation -->