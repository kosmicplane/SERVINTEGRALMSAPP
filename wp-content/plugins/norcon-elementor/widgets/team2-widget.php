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
class BdevsTeam2 extends \Elementor\Widget_Base {

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
		return 'bdevs-team2';
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
		return __( 'Team 2', 'bdevs-elementor' );
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
		return [ 'Team 2' ];
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
			'section_content_Team2',
			[
				'label' => esc_html__( 'Team 2', 'bdevs-elementor' ),
			]	
		);	
		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Team Items', 'bdevs-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   => esc_html__( 'Service #1', 'bdevs-elementor' ),
						'tab_content' => esc_html__( 'I am item content. Click edit button to change this text.', 'bdevs-elementor' ),
					],
				],
				'fields' => [					
					[
						'name'    => 'image',
						'label'   => esc_html__( 'Background Image', 'bdevs-elementor' ),
						'type'    => Controls_Manager::MEDIA,
						'dynamic' => [ 'active' => true ],
					],
					[
						'name'        => 'title',
						'label'       => esc_html__( ' Title', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Steven J. Doyle' , 'bdevs-elementor' ),
						'label_block' => true,
					],
					
					[
						'name'        => 'subtitle',
						'label'       => esc_html__( 'Subtitle', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXTAREA,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Medical Specialist' , 'bdevs-elementor' ),
						'label_block' => true,
					],
					[
						'name'        => 'link_facebook',
						'label'       => esc_html__( 'Link Facebook', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'https://www.facebook.com/' , 'bdevs-elementor' ),
						'label_block' => true,
					],
					[
						'name'        => 'link_twitter',
						'label'       => esc_html__( 'Link Twitter', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'https://twitter.com/' , 'bdevs-elementor' ),
						'label_block' => true,
					],
					[
						'name'        => 'link_instagram',
						'label'       => esc_html__( 'Link Instagram', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'https://www.instagram.com/' , 'bdevs-elementor' ),
						'label_block' => true,
					],
					[
						'name'        => 'link_linkedin',
						'label'       => esc_html__( 'Link Linkedin', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'https://www.linkedin.com/' , 'bdevs-elementor' ),
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
			'show_title',
			[
				'label'   => esc_html__( 'Show Title', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);		
		$this->add_control(
			'show_subtitle',
			[
				'label'   => esc_html__( 'Show Subitle', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);	
		$this->add_control(
			'show_link_facebook',
			[
				'label'   => esc_html__( 'Show Facebook', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_link_twitter',
			[
				'label'   => esc_html__( 'Show Twitter', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_link_instagram',
			[
				'label'   => esc_html__( 'Show Instagram', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);
		$this->add_control(
			'show_link_linkedin',
			[
				'label'   => esc_html__( 'Show Linkedin', 'bdevs-elementor' ),
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
<section class="team section-padding">
        <div class="container">
            <div class="row">
            	<?php
			    	$idd = 0;
			    	foreach ( $settings['tabs'] as $item ) :
			    	$idd++;
			    ?>
                <div class="col-md-4">
                    <div class="team-card mb-60">
                        <div class="team-img"><img src="<?php print esc_url($item['image']['url']); ?>" alt="" class="w-100"></div>
                        <div class="team-content">
                            <?php if (( '' !== $item['title'] ) && ( $settings['show_title'] )) : ?>
                            <h3 class="team-title"><?php echo wp_kses_post($item['title']); ?></h3>
                            <?php endif; ?>
                            <?php if (( '' !== $item['subtitle'] ) && ( $settings['show_subtitle'] )) : ?>
                            <p class="team-text"><?php echo wp_kses_post($item['subtitle']); ?></p>
                            <?php endif; ?>
                            <div class="social">
								<div class="full-width">
								    <?php if (( '' !== $item['link_linkedin'] ) && ( $settings['show_link_linkedin'] )) : ?>
                                	<a href="<?php echo wp_kses_post($item['link_linkedin']); ?>"><i class="fa fa-linkedin"></i></a> 
                                	<?php endif; ?>
                                	<?php if (( '' !== $item['link_facebook'] ) && ( $settings['show_link_facebook'] )) : ?>
                                	<a href="<?php echo wp_kses_post($item['link_facebook']); ?>"><i class="fa fa-facebook"></i></a> 
                                	<?php endif; ?>
                                	<?php if (( '' !== $item['link_twitter'] ) && ( $settings['show_link_twitter'] )) : ?>
                                	<a href="<?php echo wp_kses_post($item['link_twitter']); ?>"><i class="fa fa-twitter"></i></a> 
                                	<?php endif; ?>
                                	<?php if (( '' !== $item['link_instagram'] ) && ( $settings['show_link_instagram'] )) : ?>
                                	<a href="<?php echo wp_kses_post($item['link_instagram']); ?>"><i class="fa fa-instagram"></i></a> 
                                	<?php endif; ?>
								</div>
							</div>
                        </div>
                        <?php if (( '' !== $item['title'] ) && ( $settings['show_title'] )) : ?>
                        <div class="title-box">
                            <h3 class="mb-0"><?php echo wp_kses_post($item['title']); ?></h3>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
	<?php
	}

}