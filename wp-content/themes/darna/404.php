<?php
remove_action('g5plus_before_page_wrapper_content','g5plus_page_above_header',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_top_bar',10);
remove_action('g5plus_before_page_wrapper_content','g5plus_page_header',15);

get_header();
$page_404_bg = g5plus_get_option('page_404_bg_image',array(
	'url' => THEME_URL . 'assets/images/bg-404.jpg'
));

$page_404_bg_url='';
if(isset($page_404_bg) && isset($page_404_bg['url'])) {
	$page_404_bg_url = $page_404_bg['url'];
}

$logo_url = '';
$opt_dark_logo = g5plus_get_option('dark_logo',array(
	'url' => THEME_URL . '/assets/images/theme-options/logo-dark.png'
));
if (isset($opt_dark_logo['url'])) {
	$logo_url = $opt_dark_logo['url'];
}

$opt_subtitle_404 = g5plus_get_option('subtitle_404');
$opt_social_sharing_404 = g5plus_get_option('social_sharing_404',array(
	'facebook' => '1',
	'twitter' => '1',
	'behance' => '1',
	'skype' => '1'
));
$opt_facebook_url = g5plus_get_option('facebook_url');
$opt_twitter_url = g5plus_get_option('twitter_url');
$opt_behance_url = g5plus_get_option('behance_url');
$opt_skype_username = g5plus_get_option('skype_username');
$opt_copyright_404 = g5plus_get_option('copyright_404',esc_html__('© 2015 darna  is proudly powered by  G5Theme', 'g5plus-darna'));
?>

<div class="page404" style="background-image: url(<?php echo esc_url($page_404_bg_url) ?>)">
    <div class="logo">
        <img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" src="<?php echo esc_url($logo_url) ?>" />
    </div>

    <div class="container content-404">

        <span class="title secondary-font"><?php esc_html_e('Error','g5plus-darna') ?></span>
        <h2>404</h2>
        <span class="title not-found secondary-font"><?php esc_html_e('Page not found','g5plus-darna') ?></span>
        <div class="description"><?php echo wp_kses_post($opt_subtitle_404); ?></div>
        <div class="search">
           <?php the_widget('WP_Widget_Search') ?>
        </div>
        <div class="social-share">
            <?php if($opt_social_sharing_404['facebook']=='1'){ ?>
                <a href="<?php echo esc_url($opt_facebook_url)?>"><i class="fa fa-facebook"></i></a>
            <?php } ?>
            <?php if($opt_social_sharing_404['twitter']=='1'){ ?>
                <a href="<?php echo esc_url($opt_twitter_url)?>"><i class="fa fa-twitter"></i></a>
            <?php } ?>
            <?php if($opt_social_sharing_404['behance']=='1'){ ?>
                <a href="<?php echo esc_url($opt_behance_url)?>"><i class="fa fa-behance"></i></a>
            <?php } ?>
            <?php if($opt_social_sharing_404['skype']=='1'){ ?>
                <a href="skype:<?php echo esc_attr($opt_skype_username)?>?chat"><i class="fa fa-skype"></i></a>
            <?php } ?>
        </div>

    </div>
    <div class="copyright">
        <?php
        echo wp_kses_post($opt_copyright_404);
        ?>
    </div>

</div>
<?php
remove_action('g5plus_main_wrapper_footer','g5plus_footer_widgets',10);
get_footer();
?>

<script type="text/javascript">
    (function($) {
        "use strict";

        $(document).ready(function(){
            function setFitHeight(){
                var wpadminbar = $('#wpadminbar').outerHeight();
                var windowHeight = $(window).height();
                var contentHeight = windowHeight - wpadminbar;
                if(contentHeight <700)
                    contentHeight = 700;
                var $windowWidth = $(window).width();
                    $('.page404').css('height',contentHeight);


                $('.page404').css('opacity','1');
            }
            setFitHeight();
            $(window).resize(function () {
                setFitHeight();
            });

        });
    })(jQuery);
</script>

