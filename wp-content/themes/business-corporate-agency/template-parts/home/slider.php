<?php
/**
 * Template part for displaying slider section
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

$business_corporate_agency_static_image = get_stylesheet_directory_uri() . '/assets/images/header_img.png';

if (get_theme_mod('business_corporate_agency_slider_arrows', true) != '') : ?>

<section id="slider">
  <div id="owl-carousel" class="owl-carousel">
    <?php
    $business_corporate_agency_slide_pages = array();
    for ($business_corporate_agency_count = 1; $business_corporate_agency_count <= 4; $business_corporate_agency_count++) {
        $business_corporate_agency_mod = intval(get_theme_mod('business_corporate_agency_slider_page' . $business_corporate_agency_count, 0));
        if ($business_corporate_agency_mod > 0) {
            $business_corporate_agency_slide_pages[] = $business_corporate_agency_mod;
        }
    }

    if (!empty($business_corporate_agency_slide_pages)) :
        $business_corporate_agency_args = array(
            'post_type' => 'page',
            'post__in' => $business_corporate_agency_slide_pages,
            'orderby' => 'post__in'
        );
        $business_corporate_agency_query = new WP_Query($business_corporate_agency_args);
        if ($business_corporate_agency_query->have_posts()) :
            while ($business_corporate_agency_query->have_posts()) : $business_corporate_agency_query->the_post(); ?>
                <div class="item">
                    <div class="slider-border">
                        <?php if (has_post_thumbnail()) { ?>
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute(); ?>" />
                        <?php } else { ?>
                            <img src="<?php echo esc_url($business_corporate_agency_static_image); ?>" alt="<?php esc_attr_e('Default Image', 'business-corporate-agency'); ?>" />
                        <?php } ?>
                    </div>
                    <?php $business_corporate_agency_side_text = get_theme_mod('business_corporate_agency_slider_side_text', 'welcome');
                    if (!empty($business_corporate_agency_side_text)) { ?>
                        <p class="welcome-text m-0"><?php echo esc_html($business_corporate_agency_side_text,'welcome'); ?></p>
                    <?php } ?>
                    <div class="carousel-caption">
                        <div class="inner_carousel">
                            <?php $business_corporate_agency_short_heading = get_theme_mod('business_corporate_agency_slider_short_heading', '');
                            if (!empty($business_corporate_agency_short_heading)) { ?>
                                <p class="slidetop-text m-0"><?php echo esc_html($business_corporate_agency_short_heading); ?></p>
                            <?php } ?>
                            <?php
                            $business_corporate_agency_title = get_the_title();
                            $business_corporate_agency_title_words = explode(' ', $business_corporate_agency_title);
                            $business_corporate_agency_last_word = array_pop($business_corporate_agency_title_words);
                            $business_corporate_agency_rest_of_title = implode(' ', $business_corporate_agency_title_words);
                            ?>
                            <h1 class="custom-title"><a href="<?php the_permalink(); ?>"><?php echo esc_html($business_corporate_agency_rest_of_title) . ' <span class="bordered-word">' . esc_html($business_corporate_agency_last_word) . '</span>'; ?></a></h1>
                            <p class="mb-0"><?php echo esc_html(wp_trim_words(get_the_content(), 35)); ?></p>
                            <div class="more-btn mt-4">
                                <?php $business_corporate_agency_btn_text1 = get_theme_mod('business_corporate_agency_product_btn_text1', __('Get Started', 'business-corporate-agency'));
                                $business_corporate_agency_btn_link1 = get_theme_mod('business_corporate_agency_product_btn_link1', get_permalink());
                                if (!empty($business_corporate_agency_btn_text1) || !empty($business_corporate_agency_btn_link1)) { ?>
                                    <a target="_blank" class="text-capitalize me-2 mb-3 slider-btn1" href="<?php echo esc_url($business_corporate_agency_btn_link1); ?>">
                                        <?php echo esc_html($business_corporate_agency_btn_text1); ?>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile;
            wp_reset_postdata();
        else : ?>
            <div class="no-postfound"><?php esc_html_e('No slides found.', 'business-corporate-agency'); ?></div>
        <?php endif;
    endif; ?>
  </div>
</section>
<?php endif; ?>