<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 6/15/15
 * Time: 2:56 PM
 */

global $g5plus_darna_options;

wp_enqueue_script('darna-jquery-countdown',plugins_url() . '/darna-framework/includes/shortcodes/countdown/assets/jquery.countdown/jquery.countdown.min.js', false, true);
wp_enqueue_script('darna-jquery-knob',plugins_url() . '/darna-framework/includes/shortcodes/countdown/assets/jquery.countdown/jquery.knob.min.js', false, true);
$args = array(
    'orderby'          => 'post_date',
    'order'            => 'DESC',
    'post_type'        => 'countdown',
    'post_status'      => 'publish');
$posts_array  = new WP_Query( $args );
$title_post = $opening_hours = $countdown_type = $description = $bg_image = '';
$urlRedirect = '';
while ( $posts_array->have_posts() ) : $posts_array->the_post();
    $type= rwmb_meta('countdown-type');
    if($type=='comming-soon'){
        $countdown_type = $type;
        $urlRedirect = rwmb_meta('countdown-url');
        $opening_hours = rwmb_meta('countdown-opening');
        $footer_text = rwmb_meta('footer_text');
        $title_post = get_the_title();
        $images = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
        if(count($images)>0 && is_array($images))
            $bg_image = $images[0];
        ?>
        <div class="countdown overlay <?php echo esc_attr($countdown_type) ?>" style="background-image: url(<?php echo esc_url($bg_image) ?>);">
            <div class="container">
                <div class="logo">
                    <img alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" src="<?php echo esc_url($g5plus_darna_options['light_logo']['url']) ?>" />
                </div>
                <div class="description"><?php the_content(); ?></div>
                <div class="end-line"></div>
                <div id="opening-hours" class="opening-hours">
                    <div class="time menu-font">
                        <div class="count">
                            <div class="months box"></div>
                            <div class="info"><?php esc_html_e('Months','g5plus-darna') ?></div>
                        </div>
                        <div class="count">
                            <div class="days box"></div>
                            <div class="info"><?php esc_html_e('Days','g5plus-darna') ?></div>

                        </div>
                        <div class="count">
                            <div class="hours box"></div>
                            <div class="info"><?php esc_html_e('Hours','g5plus-darna') ?></div>

                        </div>
                        <div class="count">
                            <div class="minutes box"></div>
                            <div class="info"><?php esc_html_e('Minutes','g5plus-darna') ?></div>
                        </div>
                        <div class="count">
                            <div class="seconds box"></div>
                            <div class="info"><?php esc_html_e('Seconds','g5plus-darna') ?></div>
                        </div>
                    </div>
                    <div style="clear: both"></div>


                </div>
                <?php if(isset($footer_text) && $footer_text!=''){ ?>
                    <div class="copyright">
                        <?php
                        echo wp_kses_post($footer_text);
                        ?>
                    </div>
                <?php } ?>

            </div>

        </div>


       <?php break;
    }
endwhile;
wp_reset_postdata();
?>
<script type="text/javascript">
    (function($) {
        "use strict";

        $('body').css('opacity','0');
        $('body').css('transition','opacity 0.3s');
        $('body').css('-webkit-transition','opacity 0.3s');
        $('body').css('-moz-transition','opacity 0.3s');
        $('body').css('-ms-transition','opacity 0.3s');
        $('body').css('-o-transition','opacity 0.3s');
        $(document).ready(function(){

            function setFitHeight(){
                var footer_height = $('.footer_bottom_holder').outerHeight();
                var wpadminbar = $('#wpadminbar').outerHeight();
                var windowHeight = $(window).height();
                var contentHeight = windowHeight - wpadminbar;
                if(contentHeight <700)
                    contentHeight = 700;
                var $windowWidth = $(window).width();
                if($windowWidth>992)
                    $('.comming-soon').css('height',contentHeight);
                else
                    $('.comming-soon').css('height','auto');
                $('body').css('opacity','1');
            }

            setFitHeight();
            $(window).resize(function () {
                setFitHeight();
            });

            $("#opening-hours").countdown('<?php echo esc_html($opening_hours); ?>').on('update.countdown', function(event) {
                var second = parseInt(event.strftime('%S'));
                var minutes = parseInt(event.strftime('%M'));
                var hours = parseInt(event.strftime('%H'));
                var days = parseInt(event.strftime('%d'));
                var months = parseInt(event.strftime('%m'));
                var weeks = parseInt(event.strftime('%w'));

                if(months>0){
                    var bufferDay = weeks%4 * 7;
                    if(bufferDay>0){
                        days = bufferDay;
                    }
                }
                else{
                    days =  weeks*7 + days;
                }
                if(second<10)
                    second = '0' + second;
                if(minutes<10)
                    minutes = '0' + minutes;
                if(hours<10)
                    hours = '0' + hours;
                if(days<10)
                    days = '0' + days;
                if(months<10)
                    months = '0' + months;
                $('.seconds',this).html(second);
                $('.minutes',this).html(minutes);
                $('.hours',this).html(hours);
                $('.days',this).html(days);
                $('.months',this).html(months);
            }).on('finish.countdown', function(event){
                $('.seconds',this).html(0);
                <?php if( $urlRedirect!=''){ ?>
                window.location.href= '<?php echo esc_url($urlRedirect); ?>';
                <?php } ?>
            });


        });
    })(jQuery);
</script>
