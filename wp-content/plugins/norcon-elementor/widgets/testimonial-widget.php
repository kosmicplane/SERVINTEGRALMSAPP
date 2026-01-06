<?php
namespace BdevsElementor\Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * Bdevs Elementor Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class BdevsTestimonial extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Bdevs Elementor widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'bdevs-testimonial';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Bdevs Elementor widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonial', 'bdevs-elementor' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Bdevs Slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-favorite';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Bdevs Slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'bdevs-elementor' ];
	}

	public function get_keywords() {
		return [ 'testimonial' ];
	}

	public function get_script_depends() {
		return [ 'bdevs-elementor'];
	}

	// BDT Position
	protected function element_pack_position() {
	    $position_options = [
	        ''              => esc_html__('Default', 'bdevs-elementor'),
	        'top-left'      => esc_html__('Top Left', 'bdevs-elementor') ,
	        'top-center'    => esc_html__('Top Center', 'bdevs-elementor') ,
	        'top-right'     => esc_html__('Top Right', 'bdevs-elementor') ,
	        'center'        => esc_html__('Center', 'bdevs-elementor') ,
	        'center-left'   => esc_html__('Center Left', 'bdevs-elementor') ,
	        'center-right'  => esc_html__('Center Right', 'bdevs-elementor') ,
	        'bottom-left'   => esc_html__('Bottom Left', 'bdevs-elementor') ,
	        'bottom-center' => esc_html__('Bottom Center', 'bdevs-elementor') ,
	        'bottom-right'  => esc_html__('Bottom Right', 'bdevs-elementor') ,
	    ];

	    return $position_options;
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_content_video',
			[
				'label' => esc_html__( 'Video', 'bdevs-elementor' ),
			]	
		);
		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Background Image', 'bdevs-elementor' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
				'description' => esc_html__( 'Upload Background  Image', 'bdevs-elementor' ),
			]
		);
		$this->add_control(
			'link_video',
			[
				'label'       => __( 'Link Video', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Link Video', 'bdevs-elementor' ),
				'default'     => __( 'https://youtu.be/z4nO6NuEM3A', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'subheading_video',
			[
				'label'       => __( 'Subheading Video', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Subheading Video', 'bdevs-elementor' ),
				'default'     => __( 'Promo Video', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'heading_video',
			[
				'label'       => __( 'Heading Video', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Heading Video', 'bdevs-elementor' ),
				'default'     => __( 'Video About Company', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'desc_video',
			[
				'label'       => __( 'Description Video', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your Description', 'bdevs-elementor' ),
				'default'     => __( 'Video showing our 25 years of business experience.', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_content_testimonial',
			[
				'label' => esc_html__( 'Testimonial', 'bdevs-elementor' ),
			]	
		);
		$this->add_control(
			'subheading',
			[
				'label'       => __( 'Subheading', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Subheading', 'bdevs-elementor' ),
				'default'     => __( 'What said about us', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'heading',
			[
				'label'       => __( 'Heading', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Heading', 'bdevs-elementor' ),
				'default'     => __( 'Customer Reviews', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Testimonial Items', 'bdevs-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   => esc_html__( 'Slide #1', 'bdevs-elementor' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'bdevs-elementor' ),
					]
				],
				'fields' => [
					[
						'name'    => 'quote',
						'label'   => esc_html__( 'Image quote', 'bdevs-elementor' ),
						'type'    => Controls_Manager::MEDIA,
						'dynamic' => [ 'active' => true ],
					],	
					[
						'name'    => 'team',
						'label'   => esc_html__( 'Image team', 'bdevs-elementor' ),
						'type'    => Controls_Manager::MEDIA,
						'dynamic' => [ 'active' => true ],
					],	
					[
						'name'        => 'desc',
						'label'       => esc_html__( ' desc', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXTAREA,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Sed ut perspiciatis unde omnis iste natus error voluptatem accusanm doloremque laudantium, totam rem aperiam, eaque ipsa quae ab inven tore veritatis et quasi architecto beatae' , 'bdevs-elementor' ),
						'label_block' => true,
					],		
					[
						'name'        => 'name',
						'label'       => esc_html__( 'Name', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Jon S. Svendsen' , 'bdevs-elementor' ),
						'label_block' => true,
					],				
					[
						'name'        => 'job',
						'label'       => esc_html__( 'Job', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'CEO & Founder' , 'bdevs-elementor' ),
						'label_block' => true,
					],	
				],
			]
		);
		

		$this->end_controls_section();

		/** 
		*	Layout section 
		**/
		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'bdevs-elementor' ),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   => esc_html__( 'Alignment', 'bdevs-elementor' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'bdevs-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'bdevs-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'bdevs-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'bdevs-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'description'  => 'Use align to match position',
				'default'      => 'left',
			]
		);

		$this->add_control(
			'show_link_video',
			[
				'label'   => esc_html__( 'Show Video', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);			

		$this->add_control(
			'show_subheading_video',
			[
				'label'   => esc_html__( 'Show Subheading Video', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);		

		$this->add_control(
			'show_heading_video',
			[
				'label'   => esc_html__( 'Show Heading Video', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'show_desc_video',
			[
				'label'   => esc_html__( 'Show Description Video', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_heading',
			[
				'label'   => esc_html__( 'Show Heading Testimonials', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_subheading',
			[
				'label'   => esc_html__( 'Show Subheading Testimonials', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

	}

	public function render() {
		$settings  = $this->get_settings_for_display();
		extract($settings);
		$bg_src = wp_get_attachment_image_src( $settings['background_bg']['id'], 'full' );
	$bg_url = $bg_src ? $bg_src[0] : '';
	?> 
<section class="testimonials">
    <div class="background bg-img bg-fixed section-padding pb-0" data-background="<?php print esc_url($settings['image']['url']); ?>" data-overlay-dark="4">
        <div class="container">
            <div class="row">
                <!-- Video -->
                <div class="col-md-6 mb-30 valign">
                    <div class="vid-area">
                    	<?php if (( '' !== $settings['link_video'] ) && ( $settings['show_link_video'] )) : ?>
                        <div class="vid-icon">
                            <a class="play-button vid" href="<?php echo wp_kses_post($settings['link_video']); ?>">
                                <svg class="circle-fill">
                                    <circle cx="43" cy="43" r="39" stroke="#fff" stroke-width="1"></circle>
                                </svg>
                                <svg class="circle-track">
                                    <circle cx="43" cy="43" r="39" stroke="none" stroke-width="1" fill="none"></circle>
                                </svg> <span class="polygon">
                                    <i class="norcon-triangle-right"></i>
                                </span> </a>
                        </div>
                        <?php endif; ?>
                        <div class="cont mt-30 mb-30">
                        	<?php if (( '' !== $settings['subheading_video'] ) && ( $settings['show_subheading_video'] )) : ?>
                            <h6><?php echo wp_kses_post($settings['subheading_video']); ?></h6>
                            <?php endif; ?>
                            <?php if (( '' !== $settings['heading_video'] ) && ( $settings['show_heading_video'] )) : ?>
                            <h4><?php echo wp_kses_post($settings['heading_video']); ?></h4>
                            <?php endif; ?>
                            <?php if (( '' !== $settings['desc_video'] ) && ( $settings['show_desc_video'] )) : ?>
                            <p><?php echo wp_kses_post($settings['desc_video']); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- Testiominals -->
                <div class="col-md-5 offset-md-1">
                    <div class="testimonials-box">
                        <div class="head-box">
                        	<?php if (( '' !== $settings['subheading'] ) && ( $settings['show_subheading'] )) : ?>
                            <h6><?php echo wp_kses_post($settings['subheading']); ?></h6>
                            <?php endif; ?>
                            <?php if (( '' !== $settings['heading'] ) && ( $settings['show_heading'] )) : ?>
                            <h4><?php echo wp_kses_post($settings['heading']); ?></h4>
                            <?php endif; ?>
                        </div>
                        <div class="owl-carousel owl-theme">
                        	<?php
						    	$idd = 0;
						    	foreach ( $settings['tabs'] as $item ) :
						    	$idd++;
					    	?>
                            <div class="item"> <span class="quote"><img src="<?php print esc_url($item['quote']['url']); ?>" alt=""></span>
                                <p class="v-border"><?php echo wp_kses_post($item['desc']); ?></p>
                                <div class="info">
                                    <div class="author-img"> <img src="<?php print esc_url($item['team']['url']); ?>" alt=""> </div>
                                    <div class="cont">
                                        <h6><?php echo wp_kses_post($settings['name']); ?></h6> <span><?php echo wp_kses_post($settings['job']); ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
	<?php
	}

}