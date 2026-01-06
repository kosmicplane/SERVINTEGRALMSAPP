<footer id="footer-widgets" class="<?php echo esc_attr(get_theme_mod('indofinance_footer_background_image', false) ? 'has-bg-image' : ''); ?>" 
    <?php if (get_theme_mod('indofinance_footer_background_image', false)): ?>
    style="position: relative; background-image: url('<?php echo esc_url(get_theme_mod('indofinance_footer_background_image', '')); ?>');" 
    <?php endif; ?>>

    <?php if (get_theme_mod('indofinance_footer_background_image', false)): ?>
        <div class="footer-widgets-overlay"></div>
    <?php endif; ?>
    <div class="widgets-wrapper container">
        <?php
            $footer_columns = get_theme_mod('indofinance_footer_column_choice', 'four-columns');
            switch ($footer_columns) {
                case 'one-column':
                    $col_class = 'md-12';
                    $max_columns = 1;
                    break;
                case 'two-columns':
                    $col_class = 'md-6';
                    $max_columns = 2;
                    break;
                case 'three-columns':
                    $col_class = 'md-4';
                    $max_columns = 3;
                    break;
                case 'four-columns':
                default:
                    $col_class = 'md-3';
                    $max_columns = 4;
            }

            for ($i = 1; $i <= $max_columns; $i++): 
                if (is_active_sidebar('footer-' . $i)): ?>
                    <div class="<?php echo $col_class; ?> footer-column footer-column-<?php echo $i; ?>">
                        <?php dynamic_sidebar('footer-' . $i); ?>
                    </div>
                <?php endif;
            endfor;
        ?>
    </div>
</footer>
