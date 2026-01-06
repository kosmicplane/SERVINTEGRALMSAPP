<?php
/**
 * Custom page walker for this theme.
 *
 * @package Kindergarten Toys
 */

if (!class_exists('Kindergarten_Toys_Walker_Page')) {
    /**
     * CUSTOM PAGE WALKER
     * A custom walker for pages.
     */
    class Kindergarten_Toys_Walker_Page extends Walker_Page
    {

        /**
         * Outputs the beginning of the current element in the tree.
         *
         * @param string $kindergarten_toys_output Used to append additional content. Passed by reference.
         * @param WP_Post $page Page data object.
         * @param int $kindergarten_toys_depth Optional. Depth of page. Used for padding. Default 0.
         * @param array $kindergarten_toys_args Optional. Array of arguments. Default empty array.
         * @param int $current_page Optional. Page ID. Default 0.
         * @since 2.1.0
         *
         * @see Walker::start_el()
         */

        public function start_lvl( &$kindergarten_toys_output, $kindergarten_toys_depth = 0, $kindergarten_toys_args = array() ) {
            $kindergarten_toys_indent  = str_repeat( "\t", $kindergarten_toys_depth );
            $kindergarten_toys_output .= "$kindergarten_toys_indent<ul class='sub-menu'>\n";
        }

        public function start_el(&$kindergarten_toys_output, $page, $kindergarten_toys_depth = 0, $kindergarten_toys_args = array(), $current_page = 0)
        {

            if (isset($kindergarten_toys_args['item_spacing']) && 'preserve' === $kindergarten_toys_args['item_spacing']) {
                $t = "\t";
                $n = "\n";
            } else {
                $t = '';
                $n = '';
            }
            if ($kindergarten_toys_depth) {
                $kindergarten_toys_indent = str_repeat($t, $kindergarten_toys_depth);
            } else {
                $kindergarten_toys_indent = '';
            }

            $kindergarten_toys_css_class = array('page_item', 'page-item-' . $page->ID);

            if (isset($kindergarten_toys_args['pages_with_children'][$page->ID])) {
                $kindergarten_toys_css_class[] = 'page_item_has_children';
            }

            if (!empty($current_page)) {
                $_current_page = get_post($current_page);
                if ($_current_page && in_array($page->ID, $_current_page->ancestors, true)) {
                    $kindergarten_toys_css_class[] = 'current_page_ancestor';
                }
                if ($page->ID === $current_page) {
                    $kindergarten_toys_css_class[] = 'current_page_item';
                } elseif ($_current_page && $page->ID === $_current_page->post_parent) {
                    $kindergarten_toys_css_class[] = 'current_page_parent';
                }
            } elseif (get_option('page_for_posts') === $page->ID) {
                $kindergarten_toys_css_class[] = 'current_page_parent';
            }

            /** This filter is documented in wp-includes/class-walker-page.php */
            $kindergarten_toys_css_classes = implode(' ', apply_filters('page_css_class', $kindergarten_toys_css_class, $page, $kindergarten_toys_depth, $kindergarten_toys_args, $current_page));
            $kindergarten_toys_css_classes = $kindergarten_toys_css_classes ? ' class="' . esc_attr($kindergarten_toys_css_classes) . '"' : '';

            if ('' === $page->post_title) {
                /* translators: %d: ID of a post. */
                $page->post_title = sprintf(__('#%d (no title)', 'kindergarten-toys'), $page->ID);
            }

            $kindergarten_toys_args['link_before'] = empty($kindergarten_toys_args['link_before']) ? '' : $kindergarten_toys_args['link_before'];
            $kindergarten_toys_args['link_after'] = empty($kindergarten_toys_args['link_after']) ? '' : $kindergarten_toys_args['link_after'];

            $kindergarten_toys_atts = array();
            $kindergarten_toys_atts['href'] = get_permalink($page->ID);
            $kindergarten_toys_atts['aria-current'] = ($page->ID === $current_page) ? 'page' : '';

            /** This filter is documented in wp-includes/class-walker-page.php */
            $kindergarten_toys_atts = apply_filters('page_menu_link_attributes', $kindergarten_toys_atts, $page, $kindergarten_toys_depth, $kindergarten_toys_args, $current_page);

            $kindergarten_toys_attributes = '';
            foreach ($kindergarten_toys_atts as $attr => $kindergarten_toys_value) {
                if (!empty($kindergarten_toys_value)) {
                    $kindergarten_toys_value = ('href' === $attr) ? esc_url($kindergarten_toys_value) : esc_attr($kindergarten_toys_value);
                    $kindergarten_toys_attributes .= ' ' . $attr . '="' . $kindergarten_toys_value . '"';
                }
            }

            $kindergarten_toys_args['list_item_before'] = '';
            $kindergarten_toys_args['list_item_after'] = '';
            $kindergarten_toys_args['icon_rennder'] = '';
            // Wrap the link in a div and append a sub menu toggle.
            if (isset($kindergarten_toys_args['show_toggles']) && true === $kindergarten_toys_args['show_toggles']) {
                // Wrap the menu item link contents in a div, used for positioning.
                $kindergarten_toys_args['list_item_after'] = '';
            }


            // Add icons to menu items with children.
            if (isset($kindergarten_toys_args['show_sub_menu_icons']) && true === $kindergarten_toys_args['show_sub_menu_icons']) {
                if (isset($kindergarten_toys_args['pages_with_children'][$page->ID])) {
                    $kindergarten_toys_args['icon_rennder'] = '';
                }
            }

            // Add icons to menu items with children.
            if (isset($kindergarten_toys_args['show_toggles']) && true === $kindergarten_toys_args['show_toggles']) {
                if (isset($kindergarten_toys_args['pages_with_children'][$page->ID])) {

                    $toggle_target_string = '.page_item.page-item-' . $page->ID . ' > .sub-menu';

                    $kindergarten_toys_args['list_item_after'] = '<button type="button" class="theme-aria-button submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'kindergarten-toys' ) . '</span>' . kindergarten_toys_get_theme_svg( 'chevron-down' ) . '</span></button>';
                }
            }

            if (isset($kindergarten_toys_args['show_toggles']) && true === $kindergarten_toys_args['show_toggles']) {

                $kindergarten_toys_output .= $kindergarten_toys_indent . sprintf(
                        '<li%s>%s%s<a%s>%s%s%s</a>%s%s',
                        $kindergarten_toys_css_classes,
                        '<div class="submenu-wrapper">',
                        $kindergarten_toys_args['list_item_before'],
                        $kindergarten_toys_attributes,
                        $kindergarten_toys_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $kindergarten_toys_args['link_after'],
                        $kindergarten_toys_args['list_item_after'],
                        '</div>'
                    );

            }else{

                $kindergarten_toys_output .= $kindergarten_toys_indent . sprintf(
                        '<li%s>%s<a%s>%s%s%s%s</a>%s',
                        $kindergarten_toys_css_classes,
                        $kindergarten_toys_args['list_item_before'],
                        $kindergarten_toys_attributes,
                        $kindergarten_toys_args['link_before'],
                        /** This filter is documented in wp-includes/post-template.php */
                        apply_filters('the_title', $page->post_title, $page->ID),
                        $kindergarten_toys_args['icon_rennder'],
                        $kindergarten_toys_args['link_after'],
                        $kindergarten_toys_args['list_item_after']
                    );

            }

            if (!empty($kindergarten_toys_args['show_date'])) {
                if ('modified' === $kindergarten_toys_args['show_date']) {
                    $kindergarten_toys_time = $page->post_modified;
                } else {
                    $kindergarten_toys_time = $page->post_date;
                }

                $kindergarten_toys_date_format = empty($kindergarten_toys_args['date_format']) ? '' : $kindergarten_toys_args['date_format'];
                $kindergarten_toys_output .= ' ' . mysql2date($kindergarten_toys_date_format, $kindergarten_toys_time);
            }
        }
    }
}