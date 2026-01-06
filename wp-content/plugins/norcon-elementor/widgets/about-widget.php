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
class BdevsAbout extends \Elementor\Widget_Base {

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
		return 'bdevs-about';
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
		return __( 'About', 'bdevs-elementor' );
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
		return [ 'about' ];
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
			'section_content_about',
			[
				'label' => esc_html__( 'About', 'bdevs-elementor' ),
			]	
		);
		$this->add_control(
			'subheading',
			[
				'label'       => __( 'Subheading', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Subheading', 'bdevs-elementor' ),
				'default'     => __( 'Construction Firm', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'heading',
			[
				'label'       => __( 'Heading', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Heading', 'bdevs-elementor' ),
				'default'     => __( 'About Norcon', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'desc',
			[
				'label'       => __( 'Description', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => __( 'Enter your Description', 'bdevs-elementor' ),
				'default'     => __( '<p>Our company at libero tristique mattis. Suspendisse potenti sed leonra magnain dignissim justo porta eget. Curabitur luctus magna numsaton vivention esellentesue the miss tenis vitae mollie.</p>
                    <p>Curabitur luctus magna numsaton vivention esellentesue the mis awa vitaotenti sed leonra magnain dignissim porta.</p>', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Slider Items', 'bdevs-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   => esc_html__( 'Slide #1', 'bdevs-elementor' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'bdevs-elementor' ),
					]
				],
				'fields' => [
					[
						'name'        => 'title',
						'label'       => esc_html__( ' Title', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Over 25 years of experience' , 'bdevs-elementor' ),
						'label_block' => true,
					],		
					[
						'name'        => 'icon',
						'label'       => esc_html__( 'Icon', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'norcon-d-check' , 'bdevs-elementor' ),
						'label_block' => true,
					],
					
				],
			]
		);	
		$this->add_control(
			'signature',
			[
				'label'       => esc_html__( 'signature Image', 'bdevs-elementor' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
				'description' => esc_html__( 'Upload signature Image', 'bdevs-elementor' ),
			]
		);
		$this->add_control(
			'name',
			[
				'label'       => __( 'Name', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Name', 'bdevs-elementor' ),
				'default'     => __( 'Adam Norman', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);		

		$this->add_control(
			'job',
			[
				'label'       => __( 'Job', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your Job', 'bdevs-elementor' ),
				'default'     => __( 'CEO & Founder', 'bdevs-elementor' ),
				'label_block' => true,
			]
		);	
		$this->add_control(
			'image',
			[
				'label'       => esc_html__( 'Background Image', 'bdevs-elementor' ),
				'type'        => Controls_Manager::MEDIA,
				'dynamic'     => [ 'active' => true ],
				'label_block' => true,
				'description' => esc_html__( 'Upload Image', 'bdevs-elementor' ),
			]
		);
		$this->add_control(
			'experience',
			[
				'label'       => __( 'Experience', 'bdevs-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your experience', 'bdevs-elementor' ),
				'default'     => __( 'Our 25 years working experience make a different construction building.', 'bdevs-elementor' ),
				'label_block' => true,
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
				'default'      => 'center',
			]
		);

		$this->add_control(
			'show_subheading',
			[
				'label'   => esc_html__( 'Show subheading', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);			

		$this->add_control(
			'show_heading',
			[
				'label'   => esc_html__( 'Show heading', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);		

		$this->add_control(
			'show_desc',
			[
				'label'   => esc_html__( 'Show desc', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);


		$this->add_control(
			'show_signature',
			[
				'label'   => esc_html__( 'Show Signature', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_number',
			[
				'label'   => esc_html__( 'Show Number', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_name',
			[
				'label'   => esc_html__( 'Show Name', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_experience',
			[
				'label'   => esc_html__( 'Show Experience', 'bdevs-elementor' ),
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
<section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-30">
                	<?php if (( '' !== $settings['subheading'] ) && ( $settings['show_subheading'] )) : ?>
                    <div class="section-subtitle"><?php echo wp_kses_post($settings['subheading']); ?></div>
                    <?php endif; ?>
                    <?php if (( '' !== $settings['heading'] ) && ( $settings['show_heading'] )) : ?>
                    <div class="section-title"><?php echo wp_kses_post($settings['heading']); ?></div>
                    <?php endif; ?>
                    <?php if (( '' !== $settings['desc'] ) && ( $settings['show_desc'] )) : ?>
                    <?php echo wp_kses_post($settings['desc']); ?>
                    <?php endif; ?>
                    <ul class="listext list-unstyled mb-30">
                    	<?php
					    	$idd = 0;
					    	foreach ( $settings['tabs'] as $item ) :
					    	$idd++;
				    	?>
                        <li>
                            <div class="listext-icon"> <i class="<?php echo wp_kses_post($item['icon']); ?>"></i> </div>
                            <div class="listext-text">
                                <p><?php echo wp_kses_post($item['title']); ?></p>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="line-dec"></div>
                    <div class="about-bottom"> <?php if (( '' !== $settings['signature'] ) && ( $settings['show_signature'] )) : ?><img src="<?php print esc_url($settings['signature']['url']); ?>" alt="" class="image about-signature"><?php endif; ?>
                    	<?php if (( '' !== $settings['name'] ) && ( $settings['show_name'] )) : ?>
                        <div class="about-name-wrapper">
                            <div class="about-name"><?php echo wp_kses_post($settings['name']); ?></div>
                            <div class="about-rol"><?php echo wp_kses_post($settings['job']); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="about-img"> <img src="<?php print esc_url($settings['image']['url']); ?>" alt="">
                    	<?php if (( '' !== $settings['experience'] ) && ( $settings['show_experience'] )) : ?>
                        <div class="about-img-hotifer">
                            <p><?php echo wp_kses_post($settings['experience']); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<?php
	}
}