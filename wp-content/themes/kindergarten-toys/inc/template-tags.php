<?php
/**
 * Custom Functions
 * @package Kindergarten Toys
 * @since 1.0.0
 */

if( !function_exists('kindergarten_toys_site_logo') ):

    /**
     * Logo & Description
     */
    /**
     * Displays the site logo, either text or image.
     *
     * @param array $kindergarten_toys_args Arguments for displaying the site logo either as an image or text.
     * @param boolean $kindergarten_toys_echo Echo or return the HTML.
     *
     * @return string $kindergarten_toys_html Compiled HTML based on our arguments.
     */
    function kindergarten_toys_site_logo( $kindergarten_toys_args = array(), $kindergarten_toys_echo = true ){
        $kindergarten_toys_logo = get_custom_logo();
        $kindergarten_toys_site_title = get_bloginfo('name');
        $kindergarten_toys_contents = '';
        $kindergarten_toys_classname = '';
        $kindergarten_toys_defaults = array(
            'logo' => '%1$s<span class="screen-reader-text">%2$s</span>',
            'logo_class' => 'site-logo site-branding',
            'title' => '<a href="%1$s" class="custom-logo-name">%2$s</a>',
            'title_class' => 'site-title',
            'home_wrap' => '<h1 class="%1$s">%2$s</h1>',
            'single_wrap' => '<div class="%1$s">%2$s</div>',
            'condition' => (is_front_page() || is_home()) && !is_page(),
        );
        $kindergarten_toys_args = wp_parse_args($kindergarten_toys_args, $kindergarten_toys_defaults);
        /**
         * Filters the arguments for `kindergarten_toys_site_logo()`.
         *
         * @param array $kindergarten_toys_args Parsed arguments.
         * @param array $kindergarten_toys_defaults Function's default arguments.
         */
        $kindergarten_toys_args = apply_filters('kindergarten_toys_site_logo_args', $kindergarten_toys_args, $kindergarten_toys_defaults);
        if ( has_custom_logo() ) {
            $kindergarten_toys_contents = sprintf($kindergarten_toys_args['logo'], $kindergarten_toys_logo, esc_html($kindergarten_toys_site_title));
            $kindergarten_toys_contents .= sprintf($kindergarten_toys_args['title'], esc_url( get_home_url(null, '/') ), esc_html($kindergarten_toys_site_title));
            $kindergarten_toys_classname = $kindergarten_toys_args['logo_class'];
        } else {
            $kindergarten_toys_contents = sprintf($kindergarten_toys_args['title'], esc_url( get_home_url(null, '/') ), esc_html($kindergarten_toys_site_title));
            $kindergarten_toys_classname = $kindergarten_toys_args['title_class'];
        }
        $kindergarten_toys_wrap = $kindergarten_toys_args['condition'] ? 'home_wrap' : 'single_wrap';
        // $kindergarten_toys_wrap = 'home_wrap';
        $kindergarten_toys_html = sprintf($kindergarten_toys_args[$kindergarten_toys_wrap], $kindergarten_toys_classname, $kindergarten_toys_contents);
        /**
         * Filters the arguments for `kindergarten_toys_site_logo()`.
         *
         * @param string $kindergarten_toys_html Compiled html based on our arguments.
         * @param array $kindergarten_toys_args Parsed arguments.
         * @param string $kindergarten_toys_classname Class name based on current view, home or single.
         * @param string $kindergarten_toys_contents HTML for site title or logo.
         */
        $kindergarten_toys_html = apply_filters('kindergarten_toys_site_logo', $kindergarten_toys_html, $kindergarten_toys_args, $kindergarten_toys_classname, $kindergarten_toys_contents);
        if (!$kindergarten_toys_echo) {
            return $kindergarten_toys_html;
        }
        echo $kindergarten_toys_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }

endif;

if( !function_exists('kindergarten_toys_site_description') ):

    /**
     * Displays the site description.
     *
     * @param boolean $kindergarten_toys_echo Echo or return the html.
     *
     * @return string $kindergarten_toys_html The HTML to display.
     */
    function kindergarten_toys_site_description($kindergarten_toys_echo = true){

        if ( get_theme_mod('kindergarten_toys_display_header_text', false) == true ) :
        $kindergarten_toys_description = get_bloginfo('description');
        if (!$kindergarten_toys_description) {
            return;
        }
        $kindergarten_toys_wrapper = '<div class="site-description"><span>%s</span></div><!-- .site-description -->';
        $kindergarten_toys_html = sprintf($kindergarten_toys_wrapper, esc_html($kindergarten_toys_description));
        /**
         * Filters the html for the site description.
         *
         * @param string $kindergarten_toys_html The HTML to display.
         * @param string $kindergarten_toys_description Site description via `bloginfo()`.
         * @param string $kindergarten_toys_wrapper The format used in case you want to reuse it in a `sprintf()`.
         * @since 1.0.0
         *
         */
        $kindergarten_toys_html = apply_filters('kindergarten_toys_site_description', $kindergarten_toys_html, $kindergarten_toys_description, $kindergarten_toys_wrapper);
        if (!$kindergarten_toys_echo) {
            return $kindergarten_toys_html;
        }
        echo $kindergarten_toys_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        endif;
    }

endif;

if( !function_exists('kindergarten_toys_posted_on') ):

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function kindergarten_toys_posted_on( $kindergarten_toys_icon = true, $kindergarten_toys_animation_class = '' ){

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
        $kindergarten_toys_post_date = absint( get_theme_mod( 'kindergarten_toys_post_date',$kindergarten_toys_default['kindergarten_toys_post_date'] ) );

        if( $kindergarten_toys_post_date ){

            $kindergarten_toys_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if (get_the_time('U') !== get_the_modified_time('U')) {
                $kindergarten_toys_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $kindergarten_toys_time_string = sprintf($kindergarten_toys_time_string,
                esc_attr(get_the_date(DATE_W3C)),
                esc_html(get_the_date()),
                esc_attr(get_the_modified_date(DATE_W3C)),
                esc_html(get_the_modified_date())
            );

            $kindergarten_toys_year = get_the_date('Y');
            $kindergarten_toys_month = get_the_date('m');
            $kindergarten_toys_day = get_the_date('d');
            $kindergarten_toys_link = get_day_link($kindergarten_toys_year, $kindergarten_toys_month, $kindergarten_toys_day);

            $kindergarten_toys_posted_on = '<a href="' . esc_url($kindergarten_toys_link) . '" rel="bookmark">' . $kindergarten_toys_time_string . '</a>';

            echo '<div class="entry-meta-item entry-meta-date">';
            echo '<div class="entry-meta-wrapper '.esc_attr( $kindergarten_toys_animation_class ).'">';

            if( $kindergarten_toys_icon ){

                echo '<span class="entry-meta-icon calendar-icon"> ';
                kindergarten_toys_the_theme_svg('calendar');
                echo '</span>';

            }

            echo '<span class="posted-on">' . $kindergarten_toys_posted_on . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;

if( !function_exists('kindergarten_toys_posted_by') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function kindergarten_toys_posted_by( $kindergarten_toys_icon = true, $kindergarten_toys_animation_class = '' ){   

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
        $kindergarten_toys_post_author = absint( get_theme_mod( 'kindergarten_toys_post_author',$kindergarten_toys_default['kindergarten_toys_post_author'] ) );

        if( $kindergarten_toys_post_author ){

            echo '<div class="entry-meta-item entry-meta-author">';
            echo '<div class="entry-meta-wrapper '.esc_attr( $kindergarten_toys_animation_class ).'">';

            if( $kindergarten_toys_icon ){
            
                echo '<span class="entry-meta-icon author-icon"> ';
                kindergarten_toys_the_theme_svg('user');
                echo '</span>';
                
            }

            $kindergarten_toys_byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a></span>';
            echo '<span class="byline"> ' . $kindergarten_toys_byline . '</span>'; // WPCS: XSS OK.
            echo '</div>';
            echo '</div>';

        }

    }

endif;


if( !function_exists('kindergarten_toys_posted_by_avatar') ) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function kindergarten_toys_posted_by_avatar( $kindergarten_toys_date = false ){

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
        $kindergarten_toys_post_author = absint( get_theme_mod( 'kindergarten_toys_post_author',$kindergarten_toys_default['kindergarten_toys_post_author'] ) );

        if( $kindergarten_toys_post_author ){



            echo '<div class="entry-meta-left">';
            echo '<div class="entry-meta-item entry-meta-avatar">';
            echo wp_kses_post( get_avatar( get_the_author_meta( 'ID' ) ) );
            echo '</div>';
            echo '</div>';

            echo '<div class="entry-meta-right">';

            $kindergarten_toys_byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) . '">' . esc_html(get_the_author()) . '</a></span>';

            echo '<div class="entry-meta-item entry-meta-byline"> ' . $kindergarten_toys_byline . '</div>';

            if( $kindergarten_toys_date ){
                kindergarten_toys_posted_on($kindergarten_toys_icon = false);
            }
            echo '</div>';

        }

    }

endif;

if( !function_exists('kindergarten_toys_entry_footer') ):

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function kindergarten_toys_entry_footer( $kindergarten_toys_cats = true, $kindergarten_toys_tags = true, $kindergarten_toys_edits = true){   

        $kindergarten_toys_default = kindergarten_toys_get_default_theme_options();
        $kindergarten_toys_post_category = absint( get_theme_mod( 'kindergarten_toys_post_category',$kindergarten_toys_default['kindergarten_toys_post_category'] ) );
        $kindergarten_toys_post_tags = absint( get_theme_mod( 'kindergarten_toys_post_tags',$kindergarten_toys_default['kindergarten_toys_post_tags'] ) );

        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {

            if( $kindergarten_toys_cats && $kindergarten_toys_post_category ){

                /* translators: used between list items, there is a space after the comma */
                $kindergarten_toys_categories = get_the_category();
                if ($kindergarten_toys_categories) {
                    echo '<div class="entry-meta-item entry-meta-categories">';
                    echo '<div class="entry-meta-wrapper">';
                
                    /* translators: 1: list of categories. */
                    echo '<span class="cat-links">';
                    foreach( $kindergarten_toys_categories as $kindergarten_toys_category ){

                        $kindergarten_toys_cat_name = $kindergarten_toys_category->name;
                        $kindergarten_toys_cat_slug = $kindergarten_toys_category->slug;
                        $kindergarten_toys_cat_url = get_category_link( $kindergarten_toys_category->term_id );
                        ?>

                        <a class="twp_cat_<?php echo esc_attr( $kindergarten_toys_cat_slug ); ?>" href="<?php echo esc_url( $kindergarten_toys_cat_url ); ?>" rel="category tag"><?php echo esc_html( $kindergarten_toys_cat_name ); ?></a>

                    <?php }
                    echo '</span>'; // WPCS: XSS OK.
                    echo '</div>';
                    echo '</div>';
                }

            }

            if( $kindergarten_toys_tags && $kindergarten_toys_post_tags ){
                /* translators: used between list items, there is a space after the comma */
                $kindergarten_toys_tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'kindergarten-toys'));
                if( $kindergarten_toys_tags_list ){

                    echo '<div class="entry-meta-item entry-meta-tags">';
                    echo '<div class="entry-meta-wrapper">';

                    /* translators: 1: list of tags. */
                    echo '<span class="tags-links">';
                    echo wp_kses_post($kindergarten_toys_tags_list) . '</span>'; // WPCS: XSS OK.
                    echo '</div>';
                    echo '</div>';

                }

            }

            if( $kindergarten_toys_edits ){

                edit_post_link(
                    sprintf(
                        wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                            __('Edit <span class="screen-reader-text">%s</span>', 'kindergarten-toys'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    ),
                    '<span class="edit-link">',
                    '</span>'
                );
            }

        }
    }

endif;

if ( ! function_exists( 'kindergarten_toys_post_thumbnail' ) ) :

    /**
     * Displays an optional post thumbnail.
     *
     * Shows background style image with height class on archive/search/front,
     * and a normal inline image on single post/page views.
     */
    function kindergarten_toys_post_thumbnail( $kindergarten_toys_image_size = 'full' ) {

        if ( post_password_required() || is_attachment() ) {
            return;
        }

        // Fallback image path
        $kindergarten_toys_default_image = get_template_directory_uri() . '/assets/images/default.jpg';

        // Image size → height class map
        $kindergarten_toys_size_class_map = array(
            'full'      => 'data-bg-large',
            'large'     => 'data-bg-big',
            'medium'    => 'data-bg-medium',
            'small'     => 'data-bg-small',
            'xsmall'    => 'data-bg-xsmall',
            'thumbnail' => 'data-bg-thumbnail',
        );

        $kindergarten_toys_class = isset( $kindergarten_toys_size_class_map[ $kindergarten_toys_image_size ] )
            ? $kindergarten_toys_size_class_map[ $kindergarten_toys_image_size ]
            : 'data-bg-medium';

        if ( is_singular() ) {
            the_post_thumbnail();
        } else {
            // 🔵 On archives → use background image style
            $kindergarten_toys_image = has_post_thumbnail()
                ? wp_get_attachment_image_src( get_post_thumbnail_id(), $kindergarten_toys_image_size )
                : array( $kindergarten_toys_default_image );

            $kindergarten_toys_bg_image = isset( $kindergarten_toys_image[0] ) ? $kindergarten_toys_image[0] : $kindergarten_toys_default_image;
            ?>
            <div class="post-thumbnail data-bg <?php echo esc_attr( $kindergarten_toys_class ); ?>"
                 data-background="<?php echo esc_url( $kindergarten_toys_bg_image ); ?>">
                <a href="<?php the_permalink(); ?>" class="theme-image-responsive" tabindex="0"></a>
            </div>
            <?php
        }
    }

endif;

if( !function_exists('kindergarten_toys_is_comment_by_post_author') ):

    /**
     * Comments
     */
    /**
     * Check if the specified comment is written by the author of the post commented on.
     *
     * @param object $kindergarten_toys_comment Comment data.
     *
     * @return bool
     */
    function kindergarten_toys_is_comment_by_post_author($kindergarten_toys_comment = null){

        if (is_object($kindergarten_toys_comment) && $kindergarten_toys_comment->user_id > 0) {
            $kindergarten_toys_user = get_userdata($kindergarten_toys_comment->user_id);
            $post = get_post($kindergarten_toys_comment->comment_post_ID);
            if (!empty($kindergarten_toys_user) && !empty($post)) {
                return $kindergarten_toys_comment->user_id === $post->post_author;
            }
        }
        return false;
    }

endif;

if( !function_exists('kindergarten_toys_breadcrumb') ) :

    /**
     * Kindergarten Toys Breadcrumb
     */
    function kindergarten_toys_breadcrumb($kindergarten_toys_comment = null){

        echo '<div class="entry-breadcrumb">';
        kindergarten_toys_breadcrumb_trail();
        echo '</div>';

    }

endif;