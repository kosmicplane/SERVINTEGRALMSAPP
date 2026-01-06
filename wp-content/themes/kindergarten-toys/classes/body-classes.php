<?php
/**
 * Body Classes.
 * @package Kindergarten Toys
 */

if (!function_exists('kindergarten_toys_body_classes')) :

    function kindergarten_toys_body_classes($kindergarten_toys_classes)
    {
        $kindergarten_toys_defaults = kindergarten_toys_get_default_theme_options();
        $kindergarten_toys_layout = kindergarten_toys_get_final_sidebar_layout();

        // Adds a class of hfeed to non-singular pages.
        if (!is_singular()) {
            $kindergarten_toys_classes[] = 'hfeed';
        }

        // Sidebar layout logic
        $kindergarten_toys_classes[] = $kindergarten_toys_layout;

        // Copyright alignment
        $copyright_alignment = get_theme_mod('kindergarten_toys_copyright_alignment', 'Default');
        $kindergarten_toys_classes[] = 'copyright-' . strtolower($copyright_alignment);

        return $kindergarten_toys_classes;
    }

endif;

add_filter('body_class', 'kindergarten_toys_body_classes');