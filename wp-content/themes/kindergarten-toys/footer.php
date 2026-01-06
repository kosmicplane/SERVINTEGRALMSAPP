<?php
/**
 * The template for displaying the footer
 * @package Kindergarten Toys
 * @since 1.0.0
 */

/**
 * Toogle Contents
 * @hooked kindergarten_toys_content_offcanvas - 30
*/

do_action('kindergarten_toys_before_footer_content_action'); ?>

</div>

<footer id="site-footer" role="contentinfo">

    <?php
    /**
     * Footer Content
     * @hooked kindergarten_toys_footer_content_widget - 10
     * @hooked kindergarten_toys_footer_content_info - 20
    */

    do_action('kindergarten_toys_footer_content_action'); ?>

</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>