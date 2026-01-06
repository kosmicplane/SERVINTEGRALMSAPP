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
class BdevsAbout2 extends \Elementor\Widget_Base {

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
		return 'bdevs-about2';
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
		return __( 'About 2', 'bdevs-elementor' );
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
			'section_content_about2',
			[
				'label' => esc_html__( 'About 2', 'bdevs-elementor' ),
			]	
		);
		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Brand', 'bdevs-elementor' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name'    => 'image',
						'label'   => esc_html__( 'Image Brand', 'bdevs-elementor' ),
						'type'    => Controls_Manager::MEDIA,
						'dynamic' => [ 'active' => true ],
						
					],
					[
						'name'        => 'title',
						'label'       => esc_html__( 'Title', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXT,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Title' , 'bdevs-elementor' ),
						'label_block' => true,
					],
					[
						'name'        => 'subtitle',
						'label'       => esc_html__( 'Subtitle', 'bdevs-elementor' ),
						'type'        => Controls_Manager::TEXTAREA,
						'dynamic'     => [ 'active' => true ],
						'default'     => esc_html__( 'Subtitle' , 'bdevs-elementor' ),
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
				'label'   => esc_html__( 'Show Subtitle', 'bdevs-elementor' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);	


		$this->add_control(
			'show_image',
			[
				'label'   => esc_html__( 'Show Text 2', 'bdevs-elementor' ),
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
<section class="about-info section-padding bg-gray">
    <div class="container">
        <div class="about-info">
            <div class="row">
            	<?php
			    	$idd = 0;
			    	foreach ( $settings['tabs'] as $item ) :
			    	$idd++;
		    	?>
		    	<?php if($idd%2=='1') {?>
                <div class="col-md-5">
                	<?php if (( '' !== $settings['image'] ) && ( $settings['show_image'] )) : ?>
                    <div class="about-info-img mb-60">
                        <div class="img"> <img src="<?php print esc_url($item['image']['url']); ?>" class="img-fluid" alt=""> </div>
                    </div>
                    <?php endif; ?>
                    <?php if (( '' !== $settings['title'] ) && ( $settings['show_title'] )) : ?>
                    <div class="section-title2"><?php echo wp_kses_post($item['title']); ?></div>
                    <?php endif; ?>
                    <?php if (( '' !== $settings['subtitle'] ) && ( $settings['show_subtitle'] )) : ?>
                    <p><?php echo wp_kses_post($item['subtitle']); ?></p>
                    <?php endif; ?>
                </div>
                <?php } else { ?>
                <div class="col-md-6 offset-md-1 pt-60">
                    <?php if (( '' !== $settings['title'] ) && ( $settings['show_title'] )) : ?>
                    <div class="section-title2"><?php echo wp_kses_post($item['title']); ?></div>
                    <?php endif; ?>
                    <?php if (( '' !== $settings['subtitle'] ) && ( $settings['show_subtitle'] )) : ?>
                    <p><?php echo wp_kses_post($item['subtitle']); ?></p>
                    <?php endif; ?>
                    <?php if (( '' !== $settings['image'] ) && ( $settings['show_image'] )) : ?>
                    <div class="about-info-img pt-60">
                        <div class="img"> <img src="<?php print esc_url($item['image']['url']); ?>" class="img-fluid" alt=""> </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
	<?php
	}
}