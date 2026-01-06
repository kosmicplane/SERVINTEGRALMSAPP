<?php
global $wp_version;
$opt_custom_ios_title = g5plus_get_option('custom_ios_title');
$opt_custom_favicon = g5plus_get_option('custom_favicon');
$opt_custom_ios_icon144 = g5plus_get_option('custom_ios_icon144');
$opt_custom_ios_icon114 = g5plus_get_option('custom_ios_icon114');
$opt_custom_ios_icon72 = g5plus_get_option('custom_ios_icon72');
$opt_custom_ios_icon57 = g5plus_get_option('custom_ios_icon57');

?>
<?php
if (version_compare($wp_version, '4.1', '<')): ?>
	<title><?php wp_title('|', true, 'right'); ?></title>
<?php endif; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>"/>

<?php
$viewport_content = apply_filters('g5plus_viewport_content','width=device-width, initial-scale=1, maximum-scale=1');
?>
<meta name="viewport" content="<?php echo esc_attr($viewport_content);?>">

<?php if (!empty($opt_custom_ios_title)) :?>
	<meta name="apple-mobile-web-app-title" content="<?php echo esc_attr($opt_custom_ios_title); ?>">
<?php endif;?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
<?php if (isset($opt_custom_favicon['url']) && !empty($opt_custom_favicon['url'])) :?>
    <link rel="shortcut icon" href="<?php echo esc_url($opt_custom_favicon['url']); ?>" />
<?php else: ?>
    <link rel="shortcut icon" href="<?php echo esc_url(THEME_URL . 'assets/images/favicon.ico'); ?>" />
<?php endif;?>

<?php if (isset($opt_custom_ios_icon144['url']) && !empty($opt_custom_ios_icon144['url'])) :?>
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo esc_url($opt_custom_ios_icon144['url']); ?>">
<?php endif;?>

<?php if (isset($opt_custom_ios_icon114['url']) && !empty($opt_custom_ios_icon114['url'])) :?>
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo esc_url($opt_custom_ios_icon114['url']); ?>">
<?php endif;?>

<?php if (isset($opt_custom_ios_icon72['url']) && !empty($opt_custom_ios_icon72['url'])) :?>
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo esc_url($opt_custom_ios_icon72['url']); ?>">
<?php endif;?>

<?php if (isset($opt_custom_ios_icon57['url']) && !empty($opt_custom_ios_icon57['url'])) :?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo esc_url($opt_custom_ios_icon57['url']); ?>">
<?php endif;?>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->