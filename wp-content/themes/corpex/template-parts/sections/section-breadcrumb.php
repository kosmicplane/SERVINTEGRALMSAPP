<?php 
$hs_breadcrumb							= get_theme_mod('hs_breadcrumb','1');
$breadcrumb_effect_enable				= get_theme_mod('breadcrumb_effect_enable','1');
$breadcrumb_back_attach					= get_theme_mod('breadcrumb_back_attach');
$breadcrumb_bg_img						= get_theme_mod('breadcrumb_bg_img',esc_url(get_template_directory_uri() .'/assets/images/breadcrumb.jpg'));
$effect_class 							= ($breadcrumb_effect_enable=='1')?'breadcrumb-blur':'';
$breadcrumb_title_enable				= get_theme_mod('breadcrumb_title_enable','1');
if($hs_breadcrumb == '1') {
?>
<!-- =================== Breadcrumb Section =================-->
	<!-- breadcrumbed -->
<section id="<?php if($breadcrumb_effect_enable == '1') { echo "breadcrumb-section";}?>" class="breadcrumb-area <?php echo esc_attr($effect_class); ?>">
    <div class="blur-effect2"><svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" preserveAspectRatio="xMidYMid slice"
        style="position: absolute;inset:0;z-index:-1">
        <filter id="whiff" filterUnits="userSpaceOnUse" x="0" y="0" width="100%" height="100%">
            <feImage <?php if($hs_breadcrumb == '1') {	 ?> href="<?php echo esc_url($breadcrumb_bg_img); ?>" <?php } ?> preserveAspectRatio="xMidYMid slice" result="back" />
            <feGaussianBlur stdDeviation="40" in="SourceGraphic" />
            <feComponentTransfer result="cutoff">
                <feFuncA type="linear" slope="19" intercept="-9" />
            </feComponentTransfer>
            <feComposite operator="in" in="back" in2="blur" />
            <feGaussianBlur stdDeviation="30" result="blur" />
        </filter>
        <image id="scene" <?php if($hs_breadcrumb == '1') {	 ?> href="<?php echo esc_url($breadcrumb_bg_img); ?>" <?php } ?> width="100%" height="100%"
            preserveAspectRatio="xMidYMid slice" />
        <g id="breadcrumb-effect" style="filter:url(#whiff);fill:white">
        </g>
    </svg></div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
						<h1 class="breadcrumb-heading">
							<?php 
								if ( is_home() || is_front_page()):

									single_post_title();
							
								elseif ( is_day() ) : 
								
									printf( __( 'Daily Archives: %s', 'corpex' ), get_the_date() );
								
								elseif ( is_month() ) :
								
									printf( __( 'Monthly Archives: %s', 'corpex' ), (get_the_date( 'F Y' ) ));
									
								elseif ( is_year() ) :
								
									printf( __( 'Yearly Archives: %s', 'corpex' ), (get_the_date( 'Y' ) ) );
									
								elseif ( is_category() ) :
								
									printf( __( 'Category Archives: %s', 'corpex' ), (single_cat_title( '', false ) ));

								elseif ( is_tag() ) :
								
									printf( __( 'Tag Archives: %s', 'corpex' ), (single_tag_title( '', false ) ));
									
								elseif ( is_404() ) :

									printf( __( 'Error 404', 'corpex' ));
									
								elseif ( is_author() ) :
								
									printf( __( 'Author: %s', 'corpex' ), (get_the_author( '', false ) ));		
								
								elseif ( is_tax( 'portfolio_categories' ) ) :

									printf( __( 'Portfolio Categories: %s', 'corpex' ), (single_term_title( '', false ) ));	
									
								elseif ( is_tax( 'pricing_categories' ) ) :

									printf( __( 'Pricing Categories: %s', 'corpex' ), (single_term_title( '', false ) ));	
									
								elseif ( class_exists( 'woocommerce' ) ) : 
									
									if ( is_shop() ) {
										woocommerce_page_title();
									}
									
									elseif ( is_cart() ) {
										wp_title('');
									}
									
									elseif ( is_checkout() ) {
										wp_title('');
									}
									
									else {
										wp_title('');
									}
								else :
										wp_title('');
										
								endif;
									
							?>
						</h1>
					<?php if($breadcrumb_title_enable == '1') { ?>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb-list">
								<?php if (function_exists('corpex_breadcrumbs')) corpex_breadcrumbs();?>
							</ol>
						</nav>  
					<?php } ?>
                </div>               
            </div>
        </div>
    </div>
</section>
<!-- breadcrumbed -->	
<?php } ?>