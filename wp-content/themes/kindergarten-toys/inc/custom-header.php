<?php
/**
 * Sample implementation of the Custom Header feature
 * @package Kindergarten Toys
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses kindergarten_toys_header_style()
 */
function kindergarten_toys_custom_header_setup()
{
    add_theme_support('custom-header',
        apply_filters('kindergarten_toys_custom_header_args', array(
            'default-image' => '',
            'default-text-color' => '000000',
            'width' => 1920,
            'height' => 400,
            'flex-height' => true,
            'flex-width' => true,
            'wp-head-callback' => 'kindergarten_toys_header_style',
        )));
}

add_action('after_setup_theme', 'kindergarten_toys_custom_header_setup');

if (!function_exists('kindergarten_toys_header_style')) :
    /**
     * Styles the header image and text displayed on the blog
     *
     * @see kindergarten_toys_custom_header_setup().
     */
    function kindergarten_toys_header_style()
    {
        $kindergarten_toys_header_text_color = get_header_textcolor();

        if (get_theme_support('custom-header', 'default-text-color') === $kindergarten_toys_header_text_color) {
            return;
        }

        ?>
        <style type="text/css">
            <?php
                if ( 'blank' == $kindergarten_toys_header_text_color ) :
            ?>
            .header-titles .custom-logo-name,
            .site-description {
                display: none;
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }

            <?php
                else :
            ?>
            .header-titles .custom-logo-name:not(:hover):not(:focus),
            .site-description {
                color: #<?php echo esc_attr( $kindergarten_toys_header_text_color ); ?>;
            }

            <?php endif; ?>
        </style>
        <?php
    }
endif;