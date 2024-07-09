<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor petsone-button Widget.
 *
 * Elementor widget that uses the button control.
 *
 * @since 1.0.0
 */
class Elementor_Petsone_Button_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve petsone-button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Petsone Button';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve petsone-button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Petsone Button', 'elementor-petsone-button-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve petsone-button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-button';
	}

	/**
	 * Register petsone-button widget controls.
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
				'label' => esc_html__( 'Content', 'elementor-petsone-button-control' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);
		$this->add_control(
			'ai_button_text',
			[
				'label' => esc_html__( 'Button Text', 'elementor-petsone-button-control' ),
				'label_block' => true,
				'placeholder' => __( 'Read More', 'elementor-petsone-button-control' ),
				'default' => __( 'Read More' , 'elementor-petsone-button-control' ),
				'type' => 'text',
			]
		);
		$this->add_control(
			'ai_button_link',
			[
				'label' => esc_html__( 'Button Link', 'elementor-petsone-button-control' ),
				'label_block' => true,
				'placeholder' => __( '#', 'elementor-petsone-button-control' ),
				'default' => __( '#' , 'elementor-petsone-button-control' ),
				'type' => 'text',
			]
		);
		$this->add_responsive_control(
			'alignment',
			[
			'label' => esc_html__( 'Alignment', 'elementor-petsone-button-control' ),
			'type' => \Elementor\Controls_Manager::CHOOSE,
			'options' => [
				'left' => [
					'title' => esc_html__( 'Left', 'elementor-petsone-button-control' ),
					'icon' => 'eicon-text-align-left',
				],
				'center' => [
					'title' => esc_html__( 'Center', 'elementor-petsone-button-control' ),
					'icon' => 'eicon-text-align-center',
				],
				'right' => [
					'title' => esc_html__( 'Right', 'elementor-petsone-button-control' ),
					'icon' => 'eicon-text-align-right',
				],
			],
			'default' => 'center',
			'toggle' => true,
			'selectors' => [
			'{{WRAPPER}} .btn_wrapper_widget' => 'text-align: {{VALUE}};',
			],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Styling', 'elementor-portfolio-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]

        );
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'content_typography_text',
				'label' => __( 'Text Typography', 'textdomain' ),
				'selector' => '{{WRAPPER}} .btn_wrapper_widget a',
			]
		);
		$this->start_controls_tabs(
			'style_tabs'
		);
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);
		$this->add_control(
            'button_text',
            [
                'label' => esc_html__( 'Button Text', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_wrapper_widget a' => 'color: {{VALUE}}',
                ],
            ]
        );
		// $this->add_control(
		// 	'button_background_color',
		// 	[
		// 		'label' => esc_html__( 'Button Background', 'elementor' ),
		// 		'type' => \Elementor\Controls_Manager::COLOR,
		// 		'default' => '',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .btn_wrapper_widget a' => 'background-color: {{VALUE}};',
		// 		],
		// 	]
		// );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .btn_wrapper_widget a',
			]
		);
		$this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Button Padding', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .btn_wrapper_widget a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'button_radius',
			[
				'label' => esc_html__( 'Button Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .btn_wrapper_widget a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_wrapper_widget i' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
			'icon_background_color',
			[
				'label' => esc_html__( 'Icon background', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn_wrapper_widget i' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Icon Padding', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .btn_wrapper_widget i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Icon Spacing', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .btn_wrapper_widget i' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'range' => [
					'em' => [
						'min' => 0,
						'max' => 5,
					],
				],
			]
		);
		$this->add_responsive_control(
			'icon_radius',
			[
				'label' => esc_html__( 'Icon Radius', 'elementor' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .btn_wrapper_widget i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'icon_border',
				'label' => esc_html__( 'Icon Border', 'elementor' ),
				'selector' => '{{WRAPPER}} .btn_wrapper_widget i',
			]
		);
		$this->add_responsive_control(
			'icon_rotation',
			[
				'label' => esc_html__( 'Icon Rotation', 'elementor' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'selectors' => [
					'{{WRAPPER}} .btn_wrapper_widget i' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		$this->end_controls_tab();
			
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);
		$this->add_control(
            'button_text_hover',
            [
                'label' => esc_html__( 'Button Text', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_wrapper_widget a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background2',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .btn_wrapper_widget a:hover',
			]
		);
		$this->add_control(
            'icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .btn_wrapper_widget a:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );
		$this->add_control(
			'icon_background_color_hover',
			[
				'label' => esc_html__( 'Icon background', 'elementor' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .btn_wrapper_widget a:hover i' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();
			
		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	/**
	 * Render petsone-button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$selected_icon = $settings['selected_icon']['value'];
        	?>
				<div class="btn_wrapper_widget" data-aos="fade-up">
					<a  href="<?php echo $settings['ai_button_link']; ?>" class="primary-btn button-effect"><?php echo $settings['ai_button_text']; ?><i class="<?php echo $selected_icon ?>"></i></a>
				</div>
       		 <?php
	}
}