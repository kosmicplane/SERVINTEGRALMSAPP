<?php 
if (isset($_GET['import-demo']) && $_GET['import-demo'] == true) {

    // ------- Create Nav Menu --------
$business_corporate_agency_menuname = 'Main Menus';
$business_corporate_agency_bpmenulocation = 'primary-menu';
$business_corporate_agency_menu_exists = wp_get_nav_menu_object($business_corporate_agency_menuname);

if (!$business_corporate_agency_menu_exists) {
    $business_corporate_agency_menu_id = wp_create_nav_menu($business_corporate_agency_menuname);

    // Create Home Page
    $business_corporate_agency_home_title = 'Home';
    $business_corporate_agency_home = array(
        'post_type' => 'page',
        'post_title' => $business_corporate_agency_home_title,
        'post_content' => '',
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'home'
    );
    $business_corporate_agency_home_id = wp_insert_post($business_corporate_agency_home);

    // Assign Home Page Template
    add_post_meta($business_corporate_agency_home_id, '_wp_page_template', 'page-template/front-page.php');

    // Update options to set Home Page as the front page
    update_option('page_on_front', $business_corporate_agency_home_id);
    update_option('show_on_front', 'page');

    // Add Home Page to Menu
    wp_update_nav_menu_item($business_corporate_agency_menu_id, 0, array(
        'menu-item-title' => __('Home', 'business-corporate-agency'),
        'menu-item-classes' => 'home',
        'menu-item-url' => home_url('/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $business_corporate_agency_home_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create About Us Page with Dummy Content
    $business_corporate_agency_about_title = 'About Us';
    $business_corporate_agency_about_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $business_corporate_agency_about = array(
        'post_type' => 'page',
        'post_title' => $business_corporate_agency_about_title,
        'post_content' => $business_corporate_agency_about_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'about-us'
    );
    $business_corporate_agency_about_id = wp_insert_post($business_corporate_agency_about);

    // Add About Us Page to Menu
    wp_update_nav_menu_item($business_corporate_agency_menu_id, 0, array(
        'menu-item-title' => __('About Us', 'business-corporate-agency'),
        'menu-item-classes' => 'about-us',
        'menu-item-url' => home_url('/about-us/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $business_corporate_agency_about_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Services Page with Dummy Content
    $business_corporate_agency_services_title = 'Services';
    $business_corporate_agency_services_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $business_corporate_agency_services = array(
        'post_type' => 'page',
        'post_title' => $business_corporate_agency_services_title,
        'post_content' => $business_corporate_agency_services_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'services'
    );
    $business_corporate_agency_services_id = wp_insert_post($business_corporate_agency_services);

    // Add Services Page to Menu
    wp_update_nav_menu_item($business_corporate_agency_menu_id, 0, array(
        'menu-item-title' => __('Services', 'business-corporate-agency'),
        'menu-item-classes' => 'services',
        'menu-item-url' => home_url('/services/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $business_corporate_agency_services_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Pages Page with Dummy Content
    $business_corporate_agency_pages_title = 'Pages';
    $business_corporate_agency_pages_content = '<h2>Our Pages</h2>
    <p>Explore all the pages we have on our website. Find information about our services, company, and more.</p>';
    $business_corporate_agency_pages = array(
        'post_type' => 'page',
        'post_title' => $business_corporate_agency_pages_title,
        'post_content' => $business_corporate_agency_pages_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'pages'
    );
    $business_corporate_agency_pages_id = wp_insert_post($business_corporate_agency_pages);

    // Add Pages Page to Menu
    wp_update_nav_menu_item($business_corporate_agency_menu_id, 0, array(
        'menu-item-title' => __('Pages', 'business-corporate-agency'),
        'menu-item-classes' => 'pages',
        'menu-item-url' => home_url('/pages/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $business_corporate_agency_pages_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Create Contact Page with Dummy Content
    $business_corporate_agency_contact_title = 'Contact';
    $business_corporate_agency_contact_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam...<br>

             Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960 with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br> 

                There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which dont look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isnt anything embarrassing hidden in the middle of text.<br> 

                All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.';
    $business_corporate_agency_contact = array(
        'post_type' => 'page',
        'post_title' => $business_corporate_agency_contact_title,
        'post_content' => $business_corporate_agency_contact_content,
        'post_status' => 'publish',
        'post_author' => 1,
        'post_slug' => 'contact'
    );
    $business_corporate_agency_contact_id = wp_insert_post($business_corporate_agency_contact);

    // Add Contact Page to Menu
    wp_update_nav_menu_item($business_corporate_agency_menu_id, 0, array(
        'menu-item-title' => __('Contact', 'business-corporate-agency'),
        'menu-item-classes' => 'contact',
        'menu-item-url' => home_url('/contact/'),
        'menu-item-status' => 'publish',
        'menu-item-object-id' => $business_corporate_agency_contact_id,
        'menu-item-object' => 'page',
        'menu-item-type' => 'post_type'
    ));

    // Set the menu location if it's not already set
    if (!has_nav_menu($business_corporate_agency_bpmenulocation)) {
        $locations = get_theme_mod('nav_menu_locations'); // Use 'nav_menu_locations' to get locations array
        if (empty($locations)) {
            $locations = array();
        }
        $locations[$business_corporate_agency_bpmenulocation] = $business_corporate_agency_menu_id;
        set_theme_mod('nav_menu_locations', $locations);
    }
}

        //---Header--//
        set_theme_mod('business_corporate_agency_location', '1901 Thornridge Cir. Shiloh, Hawaii 81063');
        set_theme_mod('business_corporate_agency_call', '(+33)735552102');

        set_theme_mod('business_corporate_agency_header_button', 'Get Consulatant');
        set_theme_mod('business_corporate_agency_header_link', '#');

        set_theme_mod('business_corporate_agency_header_fb_new_tab', true);
        set_theme_mod('business_corporate_agency_facebook_url', '#');
        set_theme_mod('business_corporate_agency_facebook_icon', 'fab fa-facebook-f');

        set_theme_mod('business_corporate_agency_header_twt_new_tab', true);
        set_theme_mod('business_corporate_agency_twitter_url', '#');
        set_theme_mod('business_corporate_agency_twitter_icon', 'fab fa-twitter');

        set_theme_mod('business_corporate_agency_header_ins_new_tab', true);
        set_theme_mod('business_corporate_agency_instagram_url', '#');
        set_theme_mod('business_corporate_agency_instagram_icon', 'fab fa-instagram');

        set_theme_mod('business_corporate_agency_linkedin_new_tab', true);
        set_theme_mod('business_corporate_agency_linkedin_url', '#');
        set_theme_mod('business_corporate_agency_linkedin_icon', 'fab fa-linkedin');

        set_theme_mod('business_corporate_agency_google_plus_new_tab', true);
        set_theme_mod('business_corporate_agency_google_plus_url', '#');
        set_theme_mod('business_corporate_agency_googleplus_icon', 'fab fa-google-plus-g');

        set_theme_mod('business_corporate_agency_youtube_new_tab', true);
        set_theme_mod('business_corporate_agency_youtube_url', '#');
        set_theme_mod('business_corporate_agency_youtube_icon', 'fab fa-youtube');


        // Slider Section
        set_theme_mod('business_corporate_agency_slider_arrows', true);
        set_theme_mod('business_corporate_agency_slider_short_heading', 'START GROWING YOUR BUSINESS TODAY');
        set_theme_mod('business_corporate_agency_product_btn_text1', 'Get Started');
        set_theme_mod('business_corporate_agency_product_btn_link1', '#');
        set_theme_mod('business_corporate_agency_slider_side_text', 'WELCOME');

        for ($i = 1; $i <= 4; $i++) {
            $business_corporate_agency_title = 'Launch Ultra Modern Effective';
            $business_corporate_agency_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';

            // Create post object
            $my_post = array(
                'post_title'    => wp_strip_all_tags($business_corporate_agency_title),
                'post_content'  => $business_corporate_agency_content,
                'post_status'   => 'publish',
                'post_type'     => 'page',
            );

            // Insert the post into the database
            $post_id = wp_insert_post($my_post);

            if ($post_id) {
                // Set the theme mod for the slider page
                set_theme_mod('business_corporate_agency_slider_page' . $i, $post_id);

                $image_url = get_template_directory_uri() . '/assets/images/slider-img.png';
                $image_id = media_sideload_image($image_url, $post_id, null, 'id');

                if (!is_wp_error($image_id)) {
                    // Set the downloaded image as the post's featured image
                    set_post_thumbnail($post_id, $image_id);
                }
            }
        }

        // About Section
        set_theme_mod('business_corporate_agency_about_show_hide', true);
        set_theme_mod('business_corporate_agency_service_sub_heading', 'More About Us');
        set_theme_mod('business_corporate_agency_service_about_us', 'About Us');

        set_theme_mod('business_corporate_agency_about_bg', get_template_directory_uri().'/assets/images/about-bg.png' );

        set_theme_mod('business_corporate_agency_tab_icon1', 'fas fa-check');
        set_theme_mod('business_corporate_agency_tab_icon2', 'fas fa-check');
        set_theme_mod('business_corporate_agency_tab_icon3', 'fas fa-check');
        set_theme_mod('business_corporate_agency_tab_icon4', 'fas fa-check');
        set_theme_mod('business_corporate_agency_tab_icon5', 'fas fa-check');
        set_theme_mod('business_corporate_agency_tab_icon6', 'fas fa-check');
        set_theme_mod('business_corporate_agency_tab_icon7', 'fas fa-check');
        set_theme_mod('business_corporate_agency_tab_icon8', 'fas fa-check');

        set_theme_mod('business_corporate_agency_tab_heading1', 'Leading Business Solution');
        set_theme_mod('business_corporate_agency_tab_heading2', 'Leading Business Solution');
        set_theme_mod('business_corporate_agency_tab_heading3', 'Business is the best plan');
        set_theme_mod('business_corporate_agency_tab_heading4', 'Business is the best plan');
        set_theme_mod('business_corporate_agency_tab_heading5', 'Services we provide');
        set_theme_mod('business_corporate_agency_tab_heading6', 'Services we provide');
        set_theme_mod('business_corporate_agency_tab_heading7', 'How to improve business');
        set_theme_mod('business_corporate_agency_tab_heading8', 'How to improve business');

        set_theme_mod('business_corporate_agency_abt_button', 'Get Started');
        set_theme_mod('business_corporate_agency_abt_link', '#');
        set_theme_mod('business_corporate_agency_design_artist_experience', '25+ Years');
        set_theme_mod('business_corporate_agency_customer_review', '1500+');

        // Create About page and set the featured image
        $business_corporate_agency_abt_title = 'We Provide Best Business Solution in Town';
        $business_corporate_agency_abt_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.';

        $my_post = array(
            'post_title'    => wp_strip_all_tags($business_corporate_agency_abt_title),
            'post_content'  => $business_corporate_agency_abt_content,
            'post_status'   => 'publish',
            'post_type'     => 'page',
        );

        $post_id = wp_insert_post($my_post);

        if ($post_id) {
            set_theme_mod('business_corporate_agency_about_page', $post_id);
            $image_url = get_template_directory_uri() . '/assets/images/about-img.png';
            $image_id = media_sideload_image($image_url, $post_id, null, 'id');
            if (!is_wp_error($image_id)) {
                set_post_thumbnail($post_id, $image_id);
            }
        }

        // Define post category names
        $business_corporate_agency_category_names = array('postcategory1');

        // Set theme mod values for the customer review and selected category
        set_theme_mod('business_corporate_agency_customer_review', '1500+');
        set_theme_mod('business_corporate_agency_about_catData', 'postcategory1');

        foreach ($business_corporate_agency_category_names as $business_corporate_agency_category_name) {
            // Check if the category exists, and insert if necessary
            $business_corporate_agency_term = term_exists($business_corporate_agency_category_name, 'category');
            
            if (!$business_corporate_agency_term) {
                $business_corporate_agency_term = wp_insert_term($business_corporate_agency_category_name, 'category');
            }

            // Handle term insertion errors
            if (is_wp_error($business_corporate_agency_term)) {
                error_log('Error creating category: ' . $business_corporate_agency_term->get_error_message());
                continue;
            }

            // Ensure the term ID is retrieved correctly
            $business_corporate_agency_term_id = is_array($business_corporate_agency_term) ? $business_corporate_agency_term['term_id'] : $business_corporate_agency_term;

            // Loop for creating posts under the category
            for ($business_corporate_agency_i = 0; $business_corporate_agency_i < 3; $business_corporate_agency_i++) {
                $business_corporate_agency_my_post = array(
                    'post_title'   => 'Post ' . ($business_corporate_agency_i + 1),
                    'post_content' => 'This is the content for post ' . ($business_corporate_agency_i + 1),
                    'post_status'  => 'publish',
                    'post_type'    => 'post',
                );

                $business_corporate_agency_post_id = wp_insert_post($business_corporate_agency_my_post);
                if (is_wp_error($business_corporate_agency_post_id)) {
                    error_log('Error creating post: ' . $business_corporate_agency_post_id->get_error_message());
                    continue;
                }

                // Assign the category to the post
                wp_set_post_categories($business_corporate_agency_post_id, array($business_corporate_agency_term_id));

                // Handle featured image
                $business_corporate_agency_image_url = get_template_directory_uri() . '/assets/images/post-img' . ($business_corporate_agency_i + 1) . '.png';
                $business_corporate_agency_image_id = media_sideload_image($business_corporate_agency_image_url, $business_corporate_agency_post_id, null, 'id');

                if (!is_wp_error($business_corporate_agency_image_id)) {
                    set_post_thumbnail($business_corporate_agency_post_id, $business_corporate_agency_image_id);
                }
            }
        }


    }
?>