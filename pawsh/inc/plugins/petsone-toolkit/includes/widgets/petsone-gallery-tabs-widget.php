<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor petsone-gallery-tabs Widget.
 *
 * Elementor widget that uses the petsone-gallery-tabs control.
 *
 * @since 1.0.0
 */
class Elementor_Petsone_Gallery_Tabs_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve petsone-gallery-tabs widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'petsone-gallery-tabs';
	}
	/**
	 * Get widget title.
	 *
	 * Retrieve petsone-gallery-tabs widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'petsone Gallery Tabs', 'elementor-petsone-gallery-tabs-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve petsone-gallery-tabs widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-code';
	}

	/**
	 * Register petsone-gallery-tabs widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
        
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'elementor-petsone-gallery-tabs-control' ),
				'type' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'selected_style',
			[
				'label' => esc_html__( 'Select Style', 'elementor-petsone-gallery-tabs-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1', // Set the default style
				'options' => [
					'style1' => esc_html__( 'Style 1', 'elementor-petsone-gallery-tabs-control' ),
					'style2' => esc_html__( 'Style 2', 'elementor-petsone-gallery-tabs-control' ),
				],
			]
		);	
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'nav_item_label',
			[
				'label' => esc_html__( 'Tab Label', 'elementor-petsone-gallery-tabs-control' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab', 'elementor-petsone-gallery-tabs-control' ),
			]
		);
		$repeater->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'elementor-petsone-nav-menu-control' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);
		$this->add_control(
			'tabs',
			[
				'label' => esc_html__( 'Tabs', 'elementor-petsone-gallery-tabs-control' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'nav_item_label' => esc_html__( 'Tab 1', 'elementor-petsone-gallery-tabs-control' ),
						'gallery' => '',
					],
				],
				'title_field' => '{{{ nav_item_label }}}',
			]
		);
		
        $this->end_controls_section();
	}
	/**
	 * Render petsone-gallery-tabs widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$selected_style = $settings['selected_style'];
		if($selected_style === 'style1') {
			?>
			<div class="gallery-section-outer tabs-title">
				<ul class="nav nav-tabs" role="tablist">
						<?php foreach ( $settings['tabs'] as $index => $tab ) : ?>
							<li class="nav-item">
								<a class="nav-link <?php echo ( $index === 0 ) ? 'active' : ''; ?>" data-toggle="tab" href="#tabs-<?php echo $index + 1; ?>" role="tab"><?php echo esc_html( $tab['nav_item_label'] ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul><!-- Tab panes -->
			</div>
			<div class="gallery-section">
				<div class="tab-content">
					<?php foreach ( $settings['tabs'] as $index => $tab ) : ?>
						<div class="tab-pane <?php echo ( $index === 0 ) ? 'active' : ''; ?>" id="tabs-<?php echo $index + 1; ?>" role="tabpanel">
							<div class="gallery-images">
								<?php foreach ( $tab['gallery'] as $image ) : ?>
									<img src="<?php echo esc_attr( $image['url'] ); ?>">
								<?php endforeach; ?>
							</div>
							<div class="lightbox">
								<div class="filter"></div>
								<div class="arrowr"></div>
								<div class="arrowl"></div>
								<div class="close"></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		}
		elseif($selected_style === 'style2') {
			?>
			<div class="gallery-section-outer graphic-gallery-section-outer tabs-title">
				<ul class="nav nav-tabs" role="tablist">
						<?php foreach ( $settings['tabs'] as $index => $tab ) : ?>
							<li class="nav-item">
								<a class="nav-link <?php echo ( $index === 0 ) ? 'active' : ''; ?>" data-toggle="tab" href="#tabs-<?php echo $index + 1; ?>" role="tab"><?php echo esc_html( $tab['nav_item_label'] ); ?></a>
							</li>
						<?php endforeach; ?>
					</ul><!-- Tab panes -->
			</div>
			<div class="gallery-section graphic-gallery-section">
				<div class="tab-content">
					<?php foreach ( $settings['tabs'] as $index => $tab ) : ?>
						<div class="tab-pane <?php echo ( $index === 0 ) ? 'active' : ''; ?>" id="tabs-<?php echo $index + 1; ?>" role="tabpanel">
							<div class="gallery-images">
								<?php foreach ( $tab['gallery'] as $image ) : ?>
									<img src="<?php echo esc_attr( $image['url'] ); ?>">
								<?php endforeach; ?>
							</div>
							<div class="lightbox">
								<div class="filter"></div>
								<div class="arrowr"></div>
								<div class="arrowl"></div>
								<div class="close"></div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<?php
		}
	}
}
