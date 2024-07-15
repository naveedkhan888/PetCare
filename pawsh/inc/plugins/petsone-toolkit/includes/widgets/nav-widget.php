<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor nav Widget.
 *
 * Elementor widget that uses the nav-menu control.
 *
 * @since 1.0.0
 */
class Elementor_Nav_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve nav-menu widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'nav-menu';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve nav widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Petsone Nav Menu', 'elementor-nav-control' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve nav widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Register nav widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
        $menus = get_terms('nav_menu');
        $menu_options = array();
        
        foreach ($menus as $menu) {
            $menu_options[$menu->term_id] = $menu->name;
        }
    
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-nav-control'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $this->add_control(
            'selected_menu',
            [
                'label' => esc_html__('Select Menu', 'elementor-nav-control'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $menu_options,
                'default' => '0',
            ]
        );
    
        $this->end_controls_section();
        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__('Style', 'elementor-nav-control'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        // Alignment Control
        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__('Alignment', 'elementor-nav-control'),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'elementor-nav-control'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'elementor-nav-control'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'elementor-nav-control'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .sub-home-nav .navbar-nav' => 'text-align: {{VALUE}};',
                ],
            ]
        );
    
        // Menu Items Color Control
        $this->add_control(
            'menu_items_color',
            [
                'label' => esc_html__('Menu Items Color', 'elementor-nav-control'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-home-nav .navbar-nav li a  ' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        // Menu Items Hover Color Control
        $this->add_control(
            'menu_items_hover_color',
            [
                'label' => esc_html__('Menu Items Hover Color', 'elementor-nav-control'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-area.style-2 .navbar-expand-lg .nav-container .navbar-nav li:hover a:first-child' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'dropdown_color',
            [
                'label' => esc_html__('Dropdown Item Color', 'elementor-nav-control'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-area.style-2 .nav-container .navbar-collapse .navbar-nav li.menu-item-has-children .sub-menu li a' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
    
        // Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'label' => esc_html__('Typography', 'elementor-nav-control'),
                'selector' => '{{WRAPPER}} .sub-home-nav .navbar-nav li a',
            ]
        );
    
        // Items Padding Control
        $this->add_responsive_control(
            'items_padding',
            [
                'label' => esc_html__('Items Padding', 'elementor-nav-control'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sub-home-nav .navbar-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section();
    
    }
    


	/**
	 * Render nav widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();
        $selected_menu_id = $settings['selected_menu'];
    
        if ($selected_menu_id !== '0') {
            $menu_args = array(
                'menu' => $selected_menu_id,
                'menu_class' => 'navbar-nav',
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id' => 'food_main_menu',
                'fallback_cb' => 'food_theme_fallback_menu',
            );
            ?>
            
            <div class="sub-home-nav">
                <div class="navbar-area navbar-area-2 style-2 extra-margin-top">
                    <nav class="navbar-area navbar-expand-lg nav-transparent">
                        <div class="container nav-container nav-white">
                            <div class="responsive-mobile-menu">
                                <div class="logo"></div>
                                <button class="s7t-header-menu toggle-btn d-block d-lg-none" data-toggle="collapse" data-target="#food_main_menu" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','food'); ?>">
                                    <span class="icon-left"></span>
                                    <span class="icon-right"></span>
                                </button>
                            </div>
                            <?php wp_nav_menu($menu_args); ?>
                        </div>
                    </nav>
                </div>
            </div>
            <?php
        }
    }
	
    
}