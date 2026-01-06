<?php
/**
 * Template part for displaying about section
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

$business_corporate_agency_static_image = get_stylesheet_directory_uri() . '/assets/images/header_img.png';

if (get_theme_mod('business_corporate_agency_service_enable', true) != '') : ?>
<section id="service" class="my-5 px-md-0 px-3">
    <div class="container">
        <?php
        $business_corporate_agency_about_page_id = absint(get_theme_mod('business_corporate_agency_about_page'));
        if ($business_corporate_agency_about_page_id != 0) : 
            $business_corporate_agency_args = array(
                'post_type' => 'page',
                'p' => $business_corporate_agency_about_page_id
            );
            $business_corporate_agency_query = new WP_Query($business_corporate_agency_args);
            if ($business_corporate_agency_query->have_posts()) :
                while ($business_corporate_agency_query->have_posts()) : $business_corporate_agency_query->the_post(); ?>
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-12 image-abt position-relative">
                            <div class="about-block">
                                <div class="about-image1">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <img src="<?php the_post_thumbnail_url('full'); ?>" />
                                    <?php } else { ?>
                                        <img src="<?php echo esc_url($business_corporate_agency_static_image); ?>" />
                                    <?php } ?>
                                </div>
                                <div class="experience_btn">
                                    <div class="circular-button">
                                        <?php
                                        $business_corporate_agency_design_artist_experience = get_theme_mod('business_corporate_agency_design_artist_experience');
                                        if ($business_corporate_agency_design_artist_experience) : ?>
                                            <p class="mb-0 text-capitalize designer-experi">
                                                <span class="experience-year"><?php echo esc_html($business_corporate_agency_design_artist_experience); ?></span><br>
                                                <span class="experience-plus"><?php echo esc_html__('Years', 'business-corporate-agency'); ?></span><br>
                                                <span class="experience-text"><?php echo esc_html__('of Experience in consultaing services', 'business-corporate-agency'); ?></span></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="about-image2 text-start">
                                    <?php
                                    $business_corporate_agency_about_bg = get_theme_mod('business_corporate_agency_about_bg');
                                    if (!empty($business_corporate_agency_about_bg)) {
                                        echo '<img src="' . esc_url($business_corporate_agency_about_bg) . '" alt="Customer Image" />';
                                    } else {
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7 col-12 align-self-center">
                            <div class="match-heading position-relative">
                                <?php if (get_theme_mod('business_corporate_agency_service_about_us') != '') : ?>
                                  <p class="bold-text m-0 text-capitalize"><?php echo esc_html(get_theme_mod('business_corporate_agency_service_about_us')); ?></p>
                                <?php endif; ?>
                                <?php if (get_theme_mod('business_corporate_agency_service_sub_heading') != '') : ?>
                                  <h2 class="about-h2 m-0"><?php echo esc_html(get_theme_mod('business_corporate_agency_service_sub_heading')); ?></h2>
                                <?php endif; ?>
                            </div>
                            <?php
                            $business_corporate_agency_title = get_the_title();

                            $business_corporate_agency_words = explode(' ', $business_corporate_agency_title);

                            $business_corporate_agency_word_count = count($business_corporate_agency_words);

                            if ($business_corporate_agency_word_count > 1) {
                                $business_corporate_agency_middle_index = floor(($business_corporate_agency_word_count - 1) / 2);
                                $business_corporate_agency_words[$business_corporate_agency_middle_index] = '<span class="middle-word">' . esc_html($business_corporate_agency_words[$business_corporate_agency_middle_index]) . '</span>';
                                $business_corporate_agency_modified_title = implode(' ', $business_corporate_agency_words);
                            } else {
                                $business_corporate_agency_modified_title = esc_html($business_corporate_agency_title);
                            }
                            ?>
                            <h3 class="mb-3">
                                <a href="<?php the_permalink(); ?>">
                                    <?php echo wp_kses_post($business_corporate_agency_modified_title); ?>
                                </a>
                            </h3>
                            <p class="mb-3 abt-content"><?php echo esc_html(wp_trim_words(get_the_content(), 18)); ?></p>
                            <?php if (get_theme_mod('business_corporate_agency_tab_heading1') != '' || get_theme_mod('business_corporate_agency_tab_heading2') != '' || get_theme_mod('business_corporate_agency_tab_heading3') != '') : ?>
                              <div class="row">
                                  <?php for ($business_corporate_agency_i = 1; $business_corporate_agency_i <= 8; $business_corporate_agency_i++) : ?>
                                      <?php if (get_theme_mod('business_corporate_agency_tab_heading' . $business_corporate_agency_i) != '') : ?>
                                          <div class="col-lg-6 col-md-6"> <!-- Column -->
                                              <div class="tab-details d-flex align-items-center">
                                                  <?php
                                                  $business_corporate_agency_icon_class = get_theme_mod('business_corporate_agency_tab_icon' . $business_corporate_agency_i);
                                                  if (!$business_corporate_agency_icon_class) {
                                                      $business_corporate_agency_icon_class = 'fas fa-check'; // Default icon
                                                  }
                                                  ?>
                                                  <i class="me-3 <?php echo esc_attr($business_corporate_agency_icon_class); ?>"></i>
                                                  <h3><?php echo esc_html(get_theme_mod('business_corporate_agency_tab_heading' . $business_corporate_agency_i)); ?></h3>
                                              </div>
                                          </div>
                                      <?php endif; ?>
                                  <?php endfor; ?>
                              </div>
                          <?php endif; ?>

                            <div class="row">
                                <div class="col-lg-9 col-md-7 align-self-center mt-4 mb-3">
                                    <div class="rating-col">
                                        <div class="row rating-box">
                                            <div class="col-lg-4 col-md-5 col-5 align-self-center px-0 position-relative">
                                                <?php 
                                                $business_corporate_agency_selected_category = get_theme_mod('business_corporate_agency_about_catData', 'select');
                                                if ($business_corporate_agency_selected_category != 'select') { ?>
                                                    <div class="abt-cat">
                                                        <div class="owl-carousel m-0">
                                                            <?php
                                                            $business_corporate_agency_abtpage_query = new WP_Query(array(
                                                                'category_name' => esc_attr($business_corporate_agency_selected_category),
                                                                'posts_per_page' => -1,
                                                            ));
                                                            if ($business_corporate_agency_abtpage_query->have_posts()) :
                                                                while ($business_corporate_agency_abtpage_query->have_posts()) : $business_corporate_agency_abtpage_query->the_post(); ?>
                                                                    <div class="abt-imagebox">
                                                                        <?php if (has_post_thumbnail()) { ?>
                                                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title_attribute(); ?>" />
                                                                        <?php } else { ?>
                                                                            <img src="<?php echo esc_url($business_corporate_agency_static_image); ?>" alt="<?php esc_attr_e('Default image', 'business-corporate-agency'); ?>" />
                                                                        <?php } ?>
                                                                    </div>
                                                                <?php endwhile;
                                                                wp_reset_postdata();
                                                            else : ?>
                                                                <p><?php esc_html_e('No posts found in this category.', 'business-corporate-agency'); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-7 align-self-center">
                                                <div class="customzer-rating">
                                                    <span class="rate-no"><?php echo esc_html(get_theme_mod('business_corporate_agency_customer_review', '')); ?></span>

                                                    <?php if (get_theme_mod('business_corporate_agency_customer_review')) : ?>
                                                        <div class="customer-review"><?php esc_html_e('Active Reviews', 'business-corporate-agency'); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-5 align-self-center text-start mt-4">
                                    <?php if( get_theme_mod( 'business_corporate_agency_abt_link' ) != '' || get_theme_mod( 'business_corporate_agency_abt_button','Get Started' ) != '') { ?>
                                        <div class="abt-btn text-center">
                                            <a href="<?php echo esc_url( get_theme_mod( 'business_corporate_agency_abt_link','' ) ); ?>" class="abt-btn"><?php echo esc_html( get_theme_mod( 'business_corporate_agency_abt_button','Get Started' ) ); ?></a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            endif;
        endif; ?>
    </div>
</section>
<?php endif; ?>