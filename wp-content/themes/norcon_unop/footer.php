<?php $norcon_redux_demo = get_option('redux_demo');?> 
<footer class="footer clearfix">
    <div class="container">
        <!-- First footer -->
        <div class="first-footer">
            <div class="row">
                <div class="col-md-12">
                    <div class="links dark footer-contact-links">
                        <div class="footer-contact-links-wrapper">
                            
                                <?php if ( is_active_sidebar( 'footer-area-1' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer-area-1' ); ?>
                                <?php endif; ?>
                            <div class="footer-contact-links-divider"></div>
                            
                                <?php if ( is_active_sidebar( 'footer-area-2' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer-area-2' ); ?>
                                <?php endif; ?>
                            
                            <div class="footer-contact-links-divider"></div>
                            
                                <?php if ( is_active_sidebar( 'footer-area-3' ) ) : ?>
                                    <?php dynamic_sidebar( 'footer-area-3' ); ?>
                                <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Second footer -->
        <div class="second-footer">
            <div class="row">
                <!-- about & social icons -->
                <div class="col-md-4 widget-area">
                    <div class="widget clearfix">
                        <?php if ( is_active_sidebar( 'footer-area-4' ) ) : ?>
                            <?php dynamic_sidebar( 'footer-area-4' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- quick links -->
                <div class="col-md-3 offset-md-1 widget-area">
                    <?php if ( is_active_sidebar( 'footer-area-5' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-area-5' ); ?>
                    <?php endif; ?>
                </div>
                <!-- subscribe -->
                <div class="col-md-4 widget-area">
                    <?php if ( is_active_sidebar( 'footer-area-6' ) ) : ?>
                        <?php dynamic_sidebar( 'footer-area-6' ); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Bottom footer -->
        <div class="bottom-footer-text">
            <div class="row copyright">
                <div class="col-md-12">
                    <p class="mb-0"><?php if(isset($norcon_redux_demo['footer_text_copyright'])){?>
                    <?php echo esc_attr($norcon_redux_demo['footer_text_copyright']);?>
                    <?php }else{?>
                    <?php echo esc_html__( '©2022 Shtheme. All rights reserved.', 'norcon' ); } ?></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>