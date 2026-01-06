<?php
get_header();

if (!function_exists('g5plus_portfolio_nav')) {
    function g5plus_portfolio_nav() {
        include_once(plugin_dir_path( __FILE__ ).'/portfolio-nav.php');
    }
    add_action('g5plus_after_single_portfolio_content','g5plus_portfolio_nav',1);
}

if ( have_posts() ) {
    // Start the Loop.
    while ( have_posts() ) : the_post();
        $post_id = get_the_ID();
        $categories = get_the_terms($post_id, G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY);
        $investor_name = get_post_meta($post_id, 'portfolio-investor', true );
        $location = get_post_meta($post_id, 'portfolio-location', true );
        $portfolio_publish_date = get_post_meta($post_id, 'portfolio-publish-date', true );
        $portfolio_value = get_post_meta($post_id, 'portfolio-value', true );
        $portfolio_architecture = get_post_meta($post_id, 'portfolio-architecture', true );


        $meta_values = get_post_meta( get_the_ID(), 'portfolio-format-gallery', false );
        $imgThumbs = wp_get_attachment_image_src(get_post_thumbnail_id($post_id),'full');
        $cat = '';
        $arrCatId = array();
        if($categories){
            foreach($categories as $category) {
                $arrCatId[count($arrCatId)] = $category->term_id;
            }
        }

        $image_size = 'thumbnail-1170x730'; // image size for related

        include_once(plugin_dir_path( __FILE__ ).'/small-slider.php');

    endwhile;
    }
?>

<script type="text/javascript">
    (function($) {
        "use strict";
        $(document).ready(function(){
            $("a[rel^='prettyPhoto']").prettyPhoto(
                {
                    theme: 'light_rounded',
                    slideshow: 5000,
                    deeplinking: false,
                    social_tools: false
                });
            $('.portfolio-item > div.entry-thumbnail').hoverdir();
        })


        $(window).load(function(){
            $(".post-slideshow",'#content').owlCarousel({
                items: 1,
                singleItem: true,
                navigation : true,
                slideSpeed: 600,
                navigationText: ['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
                pagination: false,
                afterInit:function(){
                    $(".post-slideshow",'#content').css('opacity','1');
                }
            });
        })


    })(jQuery);
</script>

<?php get_footer(); ?>
