<?php

do_action('g5plus_before_page');

$data_section_id = uniqid();

$terms = wp_get_post_terms( get_the_ID(), array( G5PLUS_PORTFOLIO_CATEGORY_TAXONOMY));
$cat = $cat_filter = '';
foreach ( $terms as $term ){
    $cat_filter .= preg_replace('/\s+/', '', $term->name) .' ';
    $cat .= $term->name.', ';
}
$cat = rtrim($cat,', ');

?>
<div class="portfolio-full small-slider" id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="navigator">
                    <?php
                    do_action('g5plus_after_single_portfolio_content'); ?>
                </div>
                <div class="portfolio-title"><h1><?php the_title() ?></h1></div>
                <div class="portfolio-category"><?php echo esc_html__('IN ','g5plus-darna');?><span class="primary-color"><?php echo wp_kses_post($cat) ?></span></div>
            </div>
            <div class="col-md-12">
                <div class="post-slideshow" id="post_slideshow_<?php echo esc_attr($data_section_id) ?>">
                    <?php if(count($meta_values) > 0){
                        $index = 0;
                        foreach($meta_values as $image){
                            $img = '';
                            $image_src = wp_get_attachment_image_src( $image, 'full' );
                            if (is_array($image_src) && count($image_src) > 0) {
                                $img =   $image_src[0];
                            }
                            ?>

                            <?php if ($img !== ''): ?>
                            <div class="item">
                                <a class="nav-post-slideshow" href="javascript:;" data-section-id="<?php echo esc_attr($data_section_id) ?>" data-index="<?php echo esc_attr($index++) ?>">
                                    <img alt="portfolio" src="<?php echo esc_url($img) ?>" />
                                </a>
                            </div>
                            <?php endif; ?>
                        <?php }
                    }else { if(count($imgThumbs)>0) {?>
                        <div class="item"><img alt="portfolio" src="<?php echo esc_url($imgThumbs[0])?>" /></div>
                    <?php }
                    }
                    ?>
                </div>

            </div>
        </div>
        <div class="row content-wrap">
            <div class="col-md-3 portfolio-attribute">
                <div class="portfolio-info border-primary-color">
                    <div class="portfolio-info-box">
                        <h6 class="primary-font"><i class="fa fa-briefcase primary-color"></i><?php echo esc_html__('Investor Name:','g5plus-darna') ?></h6>
                        <div class="portfolio-term bold-color"><?php echo esc_html($investor_name) ?></div>
                    </div>

                    <div class="portfolio-info-box">
                        <h6 class="primary-font"><i class="fa fa-calendar primary-color"></i><?php echo esc_html__('Published Date:','g5plus-darna') ?></h6>
                        <div class="portfolio-term bold-color"><?php echo date(get_option('date_format'),strtotime($portfolio_publish_date)) ?></div>
                    </div>

                    <div class="portfolio-info-box">
                        <h6 class="primary-font"><i class="fa fa-map-marker primary-color"></i><?php echo esc_html__('Location:','g5plus-darna') ?></h6>
                        <div class="portfolio-term bold-color"><?php echo esc_html($location) ?></div>
                    </div>
                    <div class="portfolio-info-box">
                        <h6 class="primary-font"><i class="fa fa-money primary-color"></i><?php echo esc_html__('Value:','g5plus-darna') ?></h6>
                        <div class="portfolio-term bold-color"><?php echo wp_kses_post($portfolio_value); ?></div>
                    </div>
                    <div class="portfolio-info-box">
                        <h6 class="primary-font"><i class="fa fa-user primary-color"></i><?php echo esc_html__('Architecture:','g5plus-darna') ?></h6>
                        <div class="portfolio-term bold-color"><?php echo wp_kses_post($portfolio_architecture); ?></div>
                    </div>

                </div>
            </div>
            <div class="col-md-9 portfolio-content">
                <div class="portfolio-info">
                    <h5 class="clear-top title bold-color border-primary-color"><?php echo esc_html__('About Project','g5plus-darna') ?></h5>
                    <?php the_content() ?>
                </div>
                <div class="portfolio-info-box share">
                    <h6 class="menu-font"><?php echo esc_html__('Share:','g5plus-darna') ?></h6>
                    <?php
                    $img_share = trailingslashit( get_template_directory_uri() ) . 'assets/images/share.png';
                    ?>
                    <img src="<?php echo esc_url($img_share) ?>" alt="share" />
                    <div class="portfolio-term icon-wrap">
                        <span><a href="javascript:;" data-href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink($post_id);?>" class="facebook bold-color"><i class="fa fa-facebook"></i></a></span>
                        <span><a href="javascript:;" data-href="https://twitter.com/home?status=<?php echo get_permalink($post_id);?>" class="bold-color"><i class="fa fa-twitter"></i></a></span>
                        <span><a href="javascript:;" data-href="https://plus.google.com/share?url=<?php echo get_permalink($post_id);?>" class="bold-color"><i class="fa fa-google-plus"></i></a></span>
                       <!-- <span><a href="javascript:;" data-href="https://plus.google.com/share?url=<?php /*echo get_permalink($post_id);*/?>" class="bold-color"><i class="fa fa-instagram"></i></a></span>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="portfolio-related-wrap">
    <div class="heading-wrap border-primary-color">
        <div class="heading bold-color  secondary-font">
            <?php echo esc_html__('Related Projects','g5plus-darna'); ?>
        </div>
        <div class="sub-heading bold-color ">
            <?php echo esc_html__('Always dedicated and devoted','g5plus-darna'); ?>
        </div>
    </div>
    <?php  include_once(plugin_dir_path( __FILE__ ).'/related.php'); ?>
</div>

<script type="text/javascript">
    (function($) {
        "use strict";
        $(document).ready(function(){
            $('a','.portfolio-full .share').each(function(){
                $(this).click(function(){
                    var href = $(this).attr('data-href');
                    var leftPosition, topPosition;
                    var width = 400;
                    var height = 300;
                    var leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
                    var topPosition = (window.screen.height / 2) - ((height / 2) + 50);
                    //Open the window.
                    window.open(href, "", "width=300, height=200,left=" + leftPosition + ",top=" + topPosition);
                })
            })
        })
    })(jQuery)
</script>

