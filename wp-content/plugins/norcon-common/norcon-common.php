<?php
/**
* Plugin Name: Norcon Common
* Plugin URI: shtheme.com
* Description: A plugin to create custom post type, metabox...
* Version:  1.0
* Author: shtheme
* Author URI: shtheme.com
* License:  GPL2
*/
include dirname( __FILE__ ) . '/meta-box/meta-box.php';
include dirname( __FILE__ ) . '/redux-framework-master/ReduxCore/framework.php';
include dirname( __FILE__ ) . '/redux-framework-master/sample/sample-config.php';
include dirname( __FILE__ ) . '/custom-post-type/post_type.php';
return true;
