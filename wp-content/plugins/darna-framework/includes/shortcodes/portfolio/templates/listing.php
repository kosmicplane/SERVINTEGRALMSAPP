<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/19/15
 * Time: 5:31 PM
 */
global $g5plus_darna_options;
$primary_color = $g5plus_darna_options['primary_color'];
$args = array(
    'offset' => $offset,
    'posts_per_page'   => $post_per_page,
    'orderby'          => 'post_date',
    'order'            => $order,
    'post_type'        => G5PLUS_PORTFOLIO_POST_TYPE,
    G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY    => strtolower($category),
    'post_status'      => 'publish');


$posts_array  = new WP_Query( $args );
$total_post = $posts_array->found_posts;
$col_class = '';
$col_class='darna-col-md-'.$column;
$data_section_id = uniqid();
$paging_style = $show_pagging== 2 ? 'slider' : 'paging';

$current_cat = '';
if (is_tax(G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY)) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $current_cat = $term->slug;
}


?>
<div class="portfolio <?php echo esc_attr($g5plus_animation . ' '. $styles_animation . ' ' . $style . ' '.$paging_style) ?>" id="portfolio-<?php echo esc_attr($data_section_id)?>">
    <?php if($show_category!=''){ ?>
    <div class="portfolio-tabs">
        <?php
        $arr_terms = array();
        $terms = get_categories(array('taxonomy' => G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
        $catSelect = explode(',',$category);
        foreach ( $terms as $term ){
            if( (in_array($term->slug,$catSelect ) || $category=='' ) && !array_key_exists($term->slug,$arr_terms )){
                $arr_terms[$term->slug] = $term->name;
            }
        }

        wp_reset_postdata();

            if(count($arr_terms)>0){
                $index = 1;
                ?>
                    <div class="tab-wrapper <?php if($category_style=='background-cat'){ echo 'container bg-category-wrap';} ?>  <?php echo esc_attr($show_category) ?>">
                        <ul class="<?php echo esc_attr($category_style); ?> primary-color">
                            <li class="<?php echo esc_attr($current_cat === '' ? 'active' : '')?>">
                                <a class="isotope-portfolio ladda-button <?php echo esc_attr($current_cat === '' ? 'active' : '')?>" data-section-id="<?php echo esc_attr($data_section_id) ?>"
                                                  data-group="all" data-filter="*" data-layout-type="<?php echo esc_attr($layout_type) ?>" data-order="<?php echo esc_attr($order) ?>"
                                                  data-column = "<?php echo esc_attr($column) ?>"  data-overlay-style = "<?php echo esc_attr($overlay_style) ?>"
                                                  data-style="zoom-out" data-spinner-color="<?php echo esc_attr($primary_color) ?>" href="javascript:;">
                                    <?php echo esc_html__('All','g5plus-darna') ?>
                                </a>
                            </li>
                            <?php if($category_style=='magic-line-container'){ ?>
                                <li class="none-magic-line">/</li>
                            <?php } ?>

                            <?php
                            foreach ($arr_terms as $slug=>$term_name ) {?>
                                <?php
                                $liClasses = array();

                                if ($index === count($arr_terms)) {
                                    $liClasses[] = 'last';
                                }

                                if ($current_cat === $slug) {
                                    $liClasses[] = 'active';
                                }

                                $liClass = implode(' ', $liClasses);
                                ?>
                                <li class="<?php echo esc_attr($liClass)?>">
                                    <a class="isotope-portfolio isotope-portfolio-cat ladda-button <?php echo esc_attr($current_cat === $slug ? 'active' : '')?>" href="javascript:;" data-section-id="<?php echo esc_attr($data_section_id) ?>"
                                       data-layout-type="<?php echo esc_attr($layout_type) ?>" data-column = "<?php echo esc_attr($column) ?>" data-order="<?php echo esc_attr($order) ?>"
                                       data-group="<?php echo  preg_replace('/\s+/', '', $slug) ?>" data-filter=".<?php echo preg_replace('/\s+/', '', $term_name) ?>"
                                       data-overlay-style = "<?php echo esc_attr($overlay_style) ?>" data-style="zoom-out" data-spinner-color="<?php echo esc_attr($primary_color) ?>" >
                                        <?php echo wp_kses_post($term_name) ?>
                                    </a>
                                </li>
                                <?php  if ($index++ != count($arr_terms) && $category_style=='magic-line-container') {?>
                                    <li class="none-magic-line">/</li>
                                <?php } ?>
                            <?php } ?>
                            <?php if($category_style=='magic-line-container'){ ?>
                                <li class="top magic-line"></li>
                                <li class="bottom magic-line"></li>
                            <?php } ?>
                        </ul>
                    </div>

        <?php } ?>
    </div>
    <?php } ?>
    <?php
        $data_plugin_options = $owl_carousel_class = '';
        if($show_pagging=='2' && $total_post/$item> 1){
            $data_plugin_options = 'data-plugin-options=\'{ "items" : '.$item.',"pagination": false, "navigation": true, "autoPlay": false}\'';
            $owl_carousel_class = 'owl-carousel';
        }
    ?>
    <div  class="portfolio-wrapper <?php echo sprintf('%s %s %s %s',$col_class,$padding,$layout_type, $owl_carousel_class)  ?>" <?php echo wp_kses_post($data_plugin_options)  ?>  data-section-id="<?php echo esc_attr($data_section_id) ?>" id="portfolio-container-<?php echo esc_attr($data_section_id) ?>" data-columns="<?php echo esc_attr($column) ?>">
        <?php
        $index = 0;
        while ( $posts_array->have_posts() ) : $posts_array->the_post();
            $index++;
            $permalink = get_permalink();
            $title_post = get_the_title();
            $terms = wp_get_post_terms( get_the_ID(), array( G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
            $cat = $cat_filter = '';
            foreach ( $terms as $term ){
                $cat_filter .= preg_replace('/\s+/', '', $term->name) .' ';
                $cat .= $term->name.', ';
            }
            $cat = rtrim($cat,', ');
            ?>
            <?php include(plugin_dir_path( __FILE__ ).'/'.$layout_type.'-item.php');?>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>

    </div>
    <?php if($show_pagging!='' || $style=='style_2'){ ?>
    <div id="view_all_button_wrap_<?php echo esc_attr($data_section_id) ?>" class="container view-button-wrap">
        <?php
        //parse link
        $view_all_link = ( $view_all_link == '||' ) ? '' : $view_all_link;
        $view_all_link = vc_build_link( $view_all_link );
        if ( strlen( $view_all_link['url'] ) > 0 ) {
            $a_href = $view_all_link['url'];
            $a_title = $view_all_link['title'];
            $a_target = strlen( $view_all_link['target'] ) > 0 ? $view_all_link['target'] : '_self';
            $button_html = $a_title;
            $button_class = 'size-md style1 icon-left';
            ?>
            <a class="darna-button <?php echo esc_attr( trim( $button_class ) ); ?>"
               href="<?php echo esc_url( $a_href ); ?>"
               title="<?php echo esc_attr( $a_title ); ?>"
               target="<?php echo trim( esc_attr( $a_target ) ); ?>"
                <?php echo g5plusFramework_Shortcodes::g5plus_get_style_animation($duration,$delay);?> >
                <?php echo wp_kses_post($button_html); ?>
            </a>
        <?php } ?>
    </div>
    <?php } ?>
    <?php if($show_pagging=='1' && $post_per_page > 0 && $total_post/$post_per_page> 1 && $total_post > ($post_per_page*$current_page)){ ?>
        <div style="clear: both"></div>
        <div class="paging" id="load-more-<?php echo esc_attr($data_section_id) ?>">
            <a href="javascript:;" class="darna-button style1 button-sm load-more" data-loading-text="<i class='fa fa-refresh fa-spin'></i> <?php _e("Loading...",'g5plus-darna'); ?>"
                data-section-id="<?php echo esc_attr($data_section_id) ?>"
                data-current-page="<?php echo esc_attr($current_page + 1) ?>"
                data-offset="<?php echo esc_attr($offset) ?>"
                data-post-per-page = "<?php echo esc_attr($post_per_page) ?>"
                data-overlay-style = "<?php echo esc_attr($overlay_style) ?>"
                data-column = "<?php echo esc_attr($column) ?>"
                data-padding = "<?php echo esc_attr($padding) ?>"
                data-layout-type = "<?php echo esc_attr($layout_type) ?>"
                data-order="<?php echo esc_attr($order) ?>"
            ><?php _e('LOAD MORE','g5plus-darna') ?></a>
        </div>
    <?php } ?>

</div>

<script type="text/javascript">
    (function($) {
        "use strict";
        <?php if($show_category!='' && $show_pagging!='2') {?>

            var $container = jQuery('div[data-section-id="<?php echo esc_attr($data_section_id); ?>"]');
            $($container).css('opacity',0);
            $(window).load(function(){
                $('.isotope-portfolio','.portfolio-tabs').off();
                $('.isotope-portfolio','.portfolio-tabs').click(function(){
                    $('.isotope-portfolio','.portfolio-tabs').removeClass('active');
                    $('li','.portfolio-tabs').removeClass('active');
                    $(this).addClass('active');
                    $(this).parent().addClass('active');
                    var dataSectionId = $(this).attr('data-section-id');
                    var filter = $(this).attr('data-filter');
                    var $container = jQuery('div[data-section-id="' + dataSectionId + '"]').isotope({ filter: filter});
                    $container.imagesLoaded( function() {
                        $container.isotope('layout');
                    });
                });
                var $container = jQuery('div[data-section-id="<?php echo esc_attr($data_section_id); ?>"]');
                $container.imagesLoaded( function() {
                    $container.isotope({
                        itemSelector: '.portfolio-item'
                    }).isotope('layout');
                });
                $($container).css('opacity',1);

                $container.closest('.portfolio').find('.isotope-portfolio-cat.active').trigger('click');

            });

        <?php } ?>

        $(document).ready(function(){
            $('.portfolio-item > div.entry-thumbnail').hoverdir();
            PortfolioAjaxAction.init('<?php echo esc_url(get_site_url() . '/wp-admin/admin-ajax.php') ?>');
            var $container = $('div[data-section-id="<?php echo esc_attr($data_section_id); ?>"]');
            $($container).bind('afterOwlInit', function(){
                $('.owl-controls','.portfolio-wrapper').addClass('container');
            });
        })
    })(jQuery);
</script>


