<?php

function kindergarten_toys_enqueue_fonts() {
    $kindergarten_toys_default_font_content = 'Poppins';
    $kindergarten_toys_default_font_heading = 'Poppins';

    $kindergarten_toys_font_content = esc_attr(get_theme_mod('kindergarten_toys_content_typography_font', $kindergarten_toys_default_font_content));
    $kindergarten_toys_font_heading = esc_attr(get_theme_mod('kindergarten_toys_heading_typography_font', $kindergarten_toys_default_font_heading));

    $kindergarten_toys_css = '';

    // Always enqueue main font
    $kindergarten_toys_css .= '
    :root {
        --font-main: ' . $kindergarten_toys_font_content . ', ' . (in_array($kindergarten_toys_font_content, ['bitter', 'charis-sil']) ? 'serif' : 'sans-serif') . '!important;
    }';
    wp_enqueue_style('kindergarten-toys-style-font-general', get_template_directory_uri() . '/fonts/' . $kindergarten_toys_font_content . '/font.css');

    // Always enqueue header font
    $kindergarten_toys_css .= '
    :root {
        --font-head: ' . $kindergarten_toys_font_heading . ', ' . (in_array($kindergarten_toys_font_heading, ['bitter', 'charis-sil']) ? 'serif' : 'sans-serif') . '!important;
    }';
    wp_enqueue_style('kindergarten-toys-style-font-h', get_template_directory_uri() . '/fonts/' . $kindergarten_toys_font_heading . '/font.css');

    // Add inline style
    wp_add_inline_style('kindergarten-toys-style-font-general', $kindergarten_toys_css);
}
add_action('wp_enqueue_scripts', 'kindergarten_toys_enqueue_fonts', 50);