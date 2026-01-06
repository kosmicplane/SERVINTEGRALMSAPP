<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 3/26/15
 * Time: 5:24 PM
 */
class G5plus_Social_Profile extends  G5Plus_Widget {
    public function __construct() {
        $this->widget_cssclass    = 'widget-social-profile';
        $this->widget_description = __( "Social profile widget", 'g5plus-darna' );
        $this->widget_id          = 'g5plus-social-profile';
        $this->widget_name        = __( 'G5Plus: Social Profile', 'g5plus-darna' );
        $this->settings           = array(
            'type'  => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => __( 'Type', 'g5plus-darna' ),
                'options' => array(
                    'social-icon-no-border' => __( 'No Border', 'g5plus-darna' ),
                    'social-icon-bordered'  => __( 'Bordered', 'g5plus-darna' )
                )
            ),
            'icons' => array(
                'type'  => 'multi-select',
                'label'   => __( 'Select social profiles', 'g5plus-darna' ),
                'std'   => '',
	            'options' => array(
		            'twitter'  => __( 'Twitter', 'g5plus-darna' ),
		            'facebook'  => __( 'Facebook', 'g5plus-darna' ),
		            'dribbble'  => __( 'Dribbble', 'g5plus-darna' ),
		            'vimeo'  => __( 'Vimeo', 'g5plus-darna' ),
		            'tumblr'  => __( 'Tumblr', 'g5plus-darna' ),
		            'skype'  => __( 'Skype', 'g5plus-darna' ),
		            'linkedin'  => __( 'LinkedIn', 'g5plus-darna' ),
		            'flickr'  => __( 'Flickr', 'g5plus-darna' ),
		            'youtube'  => __( 'YouTube', 'g5plus-darna' ),
		            'pinterest' => __( 'Pinterest', 'g5plus-darna' ),
		            'foursquare'  => __( 'Foursquare', 'g5plus-darna' ),
		            'instagram' => __( 'Instagram', 'g5plus-darna' ),
		            'github'  => __( 'GitHub', 'g5plus-darna' ),
		            'xing' => __( 'Xing', 'g5plus-darna' ),
		            'behance'  => __( 'Behance', 'g5plus-darna' ),
		            'deviantart'  => __( 'Deviantart', 'g5plus-darna' ),
		            'soundcloud'  => __( 'SoundCloud', 'g5plus-darna' ),
		            'yelp'  => __( 'Yelp', 'g5plus-darna' ),
		            'rss'  => __( 'RSS Feed', 'g5plus-darna' ),
		            'email'  => __( 'Email address', 'g5plus-darna' ),
	            )
            )
        );
        parent::__construct();
    }

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        $type         = empty( $instance['type'] ) ? '' : apply_filters( 'widget_type', $instance['type'] );
        $icons        = empty( $instance['icons'] ) ? '' : apply_filters( 'widget_icons', $instance['icons'] );
        $class_custom = empty( $instance['class_custom'] ) ? '' : apply_filters( 'widget_class_custom', $instance['class_custom'] );
        $widget_id    = $args['widget_id'];
        global $g5plus_darna_options;

        $twitter = '';
        if ( isset( $g5plus_darna_options['twitter_url'] ) ) {
            $twitter = $g5plus_darna_options['twitter_url'];
        }

	    $facebook = '';
	    if ( isset( $g5plus_darna_options['facebook_url'] ) ) {
		    $facebook = $g5plus_darna_options['facebook_url'];
	    }

	    $dribbble = '';
	    if ( isset( $g5plus_darna_options['dribbble_url'] ) ) {
		    $dribbble = $g5plus_darna_options['dribbble_url'];
	    }

	    $vimeo = '';
	    if ( isset( $g5plus_darna_options['vimeo_url'] ) ) {
		    $vimeo = $g5plus_darna_options['vimeo_url'];
	    }

	    $tumblr = '';
	    if ( isset( $g5plus_darna_options['tumblr_url'] ) ) {
		    $tumblr = $g5plus_darna_options['tumblr_url'];
	    }

	    $skype = $g5plus_darna_options['skype_username'];
	    if ( isset( $g5plus_darna_options['skype_username'] ) ) {
		    $skype = $g5plus_darna_options['skype_username'];
	    }

	    $linkedin = '';
	    if ( isset( $g5plus_darna_options['linkedin_url'] ) ) {
		    $linkedin = $g5plus_darna_options['linkedin_url'];
	    }


	    $flickr = '';
	    if ( isset( $g5plus_darna_options['flickr_url'] ) ) {
		    $flickr = $g5plus_darna_options['flickr_url'];
	    }

	    $youtube = '';
	    if ( isset( $g5plus_darna_options['youtube_url'] ) ) {
		    $youtube = $g5plus_darna_options['youtube_url'];
	    }

	    $pinterest = '';
	    if ( isset( $g5plus_darna_options['pinterest_url'] ) ) {
		    $pinterest = $g5plus_darna_options['pinterest_url'];
	    }

	    $foursquare = $g5plus_darna_options['foursquare_url'];
	    if ( isset( $g5plus_darna_options['foursquare_url'] ) ) {
		    $foursquare = $g5plus_darna_options['foursquare_url'];
	    }

	    $instagram = '';
	    if ( isset( $g5plus_darna_options['instagram_url'] ) ) {
		    $instagram = $g5plus_darna_options['instagram_url'];
	    }

	    $github = '';
	    if ( isset( $g5plus_darna_options['github_url'] ) ) {
		    $github = $g5plus_darna_options['github_url'];
	    }

	    $xing = $g5plus_darna_options['xing_url'];
	    if ( isset( $g5plus_darna_options['xing_url'] ) ) {
		    $xing = $g5plus_darna_options['xing_url'];
	    }

	    $rss = '';
	    if ( isset( $g5plus_darna_options['rss_url'] ) ) {
		    $rss = $g5plus_darna_options['rss_url'];
	    }

	    $behance = '';
	    if ( isset( $g5plus_darna_options['behance_url'] ) ) {
		    $behance = $g5plus_darna_options['behance_url'];
	    }

	    $soundcloud = '';
	    if ( isset( $g5plus_darna_options['soundcloud_url'] ) ) {
		    $soundcloud = $g5plus_darna_options['soundcloud_url'];
	    }

	    $deviantart = '';
	    if ( isset( $g5plus_darna_options['deviantart_url'] ) ) {
		    $deviantart = $g5plus_darna_options['deviantart_url'];
	    }

	    $yelp = "";
	    if ( isset( $g5plus_darna_options['yelp_url'] ) ) {
		    $yelp = $g5plus_darna_options['yelp_url'];
	    }

	    $email = "";
	    if ( isset( $g5plus_darna_options['email_address'] ) ) {
		    $email = $g5plus_darna_options['email_address'];
	    }

	    $social_icons = '';

	    if ( empty( $icons ) ) {
		    if ( $twitter ) {
			    $social_icons .= '<li><a href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' . "\n";
		    }
		    if ( $facebook ) {
			    $social_icons .= '<li><a href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' . "\n";
		    }
		    if ( $dribbble ) {
			    $social_icons .= '<li><a href="' . esc_url( $dribbble ) . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>' . "\n";
		    }
		    if ( $youtube ) {
			    $social_icons .= '<li><a href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>' . "\n";
		    }
		    if ( $vimeo ) {
			    $social_icons .= '<li><a href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>' . "\n";
		    }
		    if ( $tumblr ) {
			    $social_icons .= '<li><a href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>' . "\n";
		    }
		    if ( $skype ) {
			    $social_icons .= '<li><a href="skype:' . esc_attr( $skype ) . '" target="_blank"><i class="fa fa-skype"></i></a></li>' . "\n";
		    }
		    if ( $linkedin ) {
			    $social_icons .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' . "\n";
		    }
		    if ( $flickr ) {
			    $social_icons .= '<li><a href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>' . "\n";
		    }
		    if ( $pinterest ) {
			    $social_icons .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>' . "\n";
		    }
		    if ( $foursquare ) {
			    $social_icons .= '<li><a href="' . esc_url( $foursquare ) . '" target="_blank"><i class="fa fa-foursquare"></i></a></li>' . "\n";
		    }
		    if ( $instagram ) {
			    $social_icons .= '<li><a href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>' . "\n";
		    }
		    if ( $github ) {
			    $social_icons .= '<li><a href="' . esc_url( $github ) . '" target="_blank"><i class="fa fa-github"></i></a></li>' . "\n";
		    }
		    if ( $xing ) {
			    $social_icons .= '<li><a href="' . esc_url( $xing ) . '" target="_blank"><i class="fa fa-xing"></i></a></li>' . "\n";
		    }
		    if ( $behance ) {
			    $social_icons .= '<li><a href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i></a></li>' . "\n";
		    }
		    if ( $deviantart ) {
			    $social_icons .= '<li><a href="' . esc_url( $deviantart ) . '" target="_blank"><i class="fa fa-deviantart"></i></a></li>' . "\n";
		    }
		    if ( $soundcloud ) {
			    $social_icons .= '<li><a href="' . esc_url( $soundcloud ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>' . "\n";
		    }
		    if ( $yelp ) {
			    $social_icons .= '<li><a href="' . esc_url( $yelp ) . '" target="_blank"><i class="fa fa-yelp"></i></a></li>' . "\n";
		    }
		    if ( $rss ) {
			    $social_icons .= '<li><a href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i></a></li>' . "\n";
		    }
		    if ( $email ) {
			    $social_icons .= '<li><a href="mailto:' . esc_attr( $email ) . '" target="_blank"><i class="fa fa-vk"></i></a></li>' . "\n";
		    }
	    } else {

	    	if (strpos('||',$icons)) {
			    $social_type = explode( '||', $icons );
		    } else {
			    $social_type = explode( ',', $icons );
		    }

		    if (empty($twitter)) { $twitter = '#'; }
		    if (empty($facebook)) { $facebook = '#'; }
		    if (empty($dribbble)) { $dribbble = '#'; }
		    if (empty($youtube)) { $youtube = '#'; }
		    if (empty($vimeo)) { $vimeo = '#'; }
		    if (empty($tumblr)) { $tumblr = '#'; }
		    if (empty($skype)) { $skype = '#'; }
		    if (empty($linkedin)) { $linkedin = '#'; }
		    if (empty($flickr)) { $flickr = '#'; }
		    if (empty($pinterest)) { $pinterest = '#'; }
		    if (empty($foursquare)) { $foursquare = '#'; }
		    if (empty($instagram)) { $instagram = '#'; }
		    if (empty($github)) { $github = '#'; }
		    if (empty($xing)) { $xing = '#'; }
		    if (empty($behance)) { $behance = '#'; }
		    if (empty($deviantart)) { $deviantart = '#'; }
		    if (empty($soundcloud)) { $soundcloud = '#'; }
		    if (empty($yelp)) { $yelp = '#'; }
		    if (empty($rss)) { $rss = '#'; }
		    if (empty($email)) { $email = '#'; }

		    foreach ( $social_type as $id ) {
			    if ( ( $id == 'twitter' ) && $twitter ) {
				    $social_icons .= '<li><a href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'facebook' ) && $facebook ) {
				    $social_icons .= '<li><a href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'dribbble' ) && $dribbble ) {
				    $social_icons .= '<li><a href="' . esc_url( $dribbble ) . '" target="_blank"><i class="fa fa-dribbble"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'youtube' ) && $youtube ) {
				    $social_icons .= '<li><a href="' . esc_url( $youtube ) . '" target="_blank"><i class="fa fa-youtube"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'vimeo' ) && $vimeo ) {
				    $social_icons .= '<li><a href="' . esc_url( $vimeo ) . '" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'tumblr' ) && $tumblr ) {
				    $social_icons .= '<li><a href="' . esc_url( $tumblr ) . '" target="_blank"><i class="fa fa-tumblr"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'skype' ) && $skype ) {
				    $social_icons .= '<li><a href="skype:' . esc_attr( $skype ) . '" target="_blank"><i class="fa fa-skype"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'linkedin' ) && $linkedin ) {
				    $social_icons .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="fa fa-linkedin"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'flickr' ) && $flickr ) {
				    $social_icons .= '<li><a href="' . esc_url( $flickr ) . '" target="_blank"><i class="fa fa-flickr"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'pinterest' ) && $pinterest ) {
				    $social_icons .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="fa fa-pinterest"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'foursquare' ) && $foursquare ) {
				    $social_icons .= '<li><a href="' . esc_url( $foursquare ) . '" target="_blank"><i class="fa fa-foursquare"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'instagram' ) && $instagram ) {
				    $social_icons .= '<li><a href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'github' ) && $github ) {
				    $social_icons .= '<li><a href="' . esc_url( $github ) . '" target="_blank"><i class="fa fa-github"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'xing' ) && $xing ) {
				    $social_icons .= '<li><a href="' . esc_url( $xing ) . '" target="_blank"><i class="fa fa-xing"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'behance' ) && $behance ) {
				    $social_icons .= '<li><a href="' . esc_url( $behance ) . '" target="_blank"><i class="fa fa-behance"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'deviantart' ) && $deviantart ) {
				    $social_icons .= '<li><a href="' . esc_url( $deviantart ) . '" target="_blank"><i class="fa fa-deviantart"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'soundcloud' ) && $soundcloud ) {
				    $social_icons .= '<li><a href="' . esc_url( $soundcloud ) . '" target="_blank"><i class="fa fa-soundcloud"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'yelp' ) && $yelp ) {
				    $social_icons .= '<li><a href="' . esc_url( $yelp ) . '" target="_blank"><i class="fa fa-yelp"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'rss' ) && $rss ) {
				    $social_icons .= '<li><a href="' . esc_url( $rss ) . '" target="_blank"><i class="fa fa-rss"></i></a></li>' . "\n";
			    }
			    if ( ( $id == 'email' ) && $email ) {
				    $social_icons .= '<li><a href="mailto:' . esc_attr( $email ) . '" target="_blank"><i class="fa fa-vk"></i></a></li>' . "\n";
			    }
		    }
	    }


	    echo wp_kses_post( $before_widget );
	    ?>
	    <?php if ( ! empty( $class_custom ) ): ?>
		    <div class="<?php echo esc_attr( $class_custom ) ?>">
	    <?php endif; ?>
	    <ul class="widget-social-profile <?php echo esc_attr($type) ?>">
		    <?php echo wp_kses_post( $social_icons ); ?>
	    </ul>
	    <?php if ( ! empty( $class_custom ) ): ?>
		    </div>
	    <?php endif; ?>
	    <?php
	    echo wp_kses_post( $after_widget );
    }
}
if (!function_exists('g5plus_register_social_profile')) {
    function g5plus_register_social_profile() {
        register_widget('G5plus_Social_Profile');
    }
    add_action('widgets_init', 'g5plus_register_social_profile', 1);
}