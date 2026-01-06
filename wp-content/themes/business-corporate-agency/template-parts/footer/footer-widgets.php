<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Business Corporate Agency
 * @subpackage business_corporate_agency
 */

?>
<?php

// Determine the number of columns dynamically for the footer (you can replace this with your logic).
$business_corporate_agency_number_of_footer_columns = get_theme_mod('business_corporate_agency_footer_columns', 4); // Change this value as needed.

// Calculate the Bootstrap class for large screens (col-lg-X) for footer.
$business_corporate_agency_col_lg_footer_class = 'col-lg-' . (12 / $business_corporate_agency_number_of_footer_columns);

// Calculate the Bootstrap class for medium screens (col-md-X) for footer.
$business_corporate_agency_col_md_footer_class = 'col-md-' . (12 / $business_corporate_agency_number_of_footer_columns);
?>
<div class="container">
    <aside class="widget-area row" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'business-corporate-agency' ); ?>">
        <div class="<?php echo esc_attr($business_corporate_agency_col_lg_footer_class); ?> <?php echo esc_attr($business_corporate_agency_col_md_footer_class); ?>">
            <?php dynamic_sidebar('footer-1'); ?>
        </div>
        <?php
        // Footer boxes 2 and onwards.
        for ($business_corporate_agency_i = 2; $business_corporate_agency_i <= $business_corporate_agency_number_of_footer_columns; $business_corporate_agency_i++) :
            if ($business_corporate_agency_i <= $business_corporate_agency_number_of_footer_columns) :
                ?>
               <div class="col-12 <?php echo esc_attr($business_corporate_agency_col_lg_footer_class); ?> <?php echo esc_attr($business_corporate_agency_col_md_footer_class); ?>">
                    <?php dynamic_sidebar('footer-' . $business_corporate_agency_i); ?>
                </div><!-- .footer-one-box -->
                <?php
            endif;
        endfor;
        ?>
    </aside>
</div>