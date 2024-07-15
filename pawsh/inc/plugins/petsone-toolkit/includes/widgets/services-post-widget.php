<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor services-post Widget.
 *
 * Elementor widget that uses the services-post control.
 *
 * @since 1.0.0
 */
class Elementor_Services_Post_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve services-post widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'services-post';
    }

    /**
     * Get widget title.
     *
     * Retrieve services-post widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Services Post', 'elementor-services-post-control');
    }

    /**
     * Get widget icon.
     *
     * Retrieve services-post widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    /**
     * Register services-post widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-services-post-control'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'number_of_services_post',
            [
                'label' => __('Number of Projects', 'elementor-services-post-control'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6, // Set a default value
                'min' => 1,
                'max' => 21,
                'step' => 1,
            ]
        );
        $this->add_control(
            'selected_services',
            [
                'label' => esc_html__('Select Services', 'elementor-services-post-control'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_services_options(), // Define a function to get available services options
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'elementor-immersive-button-control'),
                'label_block' => true,
                'placeholder' => __('Read More', 'elementor-immersive-button-control'),
                'type' => 'text',
            ]
        );
        $this->add_control(
			'selected_style',
			[
				'label' => esc_html__( 'Select Style', 'elementor-services-post-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1', // Set the default style
				'options' => [
					'style1' => esc_html__( 'Style 1', 'elementor-services-post-control' ),
					'style2' => esc_html__( 'Style 2', 'elementor-services-post-control' ),
				],
			]
		);
        $this->end_controls_section();
        $this->start_controls_section(
            'query_section',
            [
                'label' => esc_html__('Query Settings', 'your-text-domain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__('Order By', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ID' => esc_html__('Post ID', 'your-text-domain'),
                    'title' => esc_html__('Title', 'your-text-domain'),
                    'date' => esc_html__('Date', 'your-text-domain'),
                    // Add other options as needed
                ],
                'default' => 'ID', // Default order by Post ID
            ]
        );

        $this->add_control(
            'post_status',
            [
                'label' => esc_html__('Post Status', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'publish' => esc_html__('Publish', 'your-text-domain'),
                    'draft' => esc_html__('Draft', 'your-text-domain'),
                    // Add other options as needed
                ],
                'default' => 'publish', // Default post status is 'publish'
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__('Order', 'your-text-domain'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ASC' => esc_html__('Ascending', 'your-text-domain'),
                    'DESC' => esc_html__('Descending', 'your-text-domain'),
                ],
                'default' => 'ASC', // Default order is ascending
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
			'image_control_section',
			[
				'label' => esc_html__( 'Image Dimensions', 'elementor-cpt-control' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Image Width', 'elementor-cpt-control' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-image img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]);
		
		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'image Height', 'elementor-cpt-control' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .main-image img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'object-fit',
			[
				'label' => esc_html__( 'Object Fit', 'elementor-services-post-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'condition' => [
					'image_height[size]!' => '',
				],
				'options' => [
					'' => esc_html__( 'Default', 'elementor-services-post-control' ),
					'fill' => esc_html__( 'Fill', 'elementor-services-post-control' ),
					'cover' => esc_html__( 'Cover', 'elementor-services-post-control' ),
					'contain' => esc_html__( 'Contain', 'elementor-services-post-control' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .main-image img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'object-position',
			[
				'label' => esc_html__( 'Object Position', 'elementor-services-post-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'center center' => esc_html__( 'Center Center', 'elementor-services-post-control' ),
					'center left' => esc_html__( 'Center Left', 'elementor-services-post-control' ),
					'center right' => esc_html__( 'Center Right', 'elementor-services-post-control' ),
					'top center' => esc_html__( 'Top Center', 'elementor-services-post-control' ),
					'top left' => esc_html__( 'Top Left', 'elementor-services-post-control' ),
					'top right' => esc_html__( 'Top Right', 'elementor-services-post-control' ),
					'bottom center' => esc_html__( 'Bottom Center', 'elementor-services-post-control' ),
					'bottom left' => esc_html__( 'Bottom Left', 'elementor-services-post-control' ),
					'bottom right' => esc_html__( 'Bottom Right', 'elementor-services-post-control' ),
				],
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} .main-image img' => 'object-position: {{VALUE}};',
				],
				'condition' => [
					'object-fit' => 'cover',
				],
			]
		);
		
		$this->end_controls_section();	
    }

    private function get_services_options()
    {
        $options = [];
        $args = array(
            'post_type' => 'our_services',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        );
        $services = new WP_Query($args);

        if ($services->have_posts()) {
            while ($services->have_posts()) {
                $services->the_post();
                $options[get_the_ID()] = get_the_title();
            }
            wp_reset_postdata();
        }

        return $options;
    }

    /**
     * Render services-post widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
{
    $settings = $this->get_settings_for_display();
    $button_text = $settings['button_text'];
    $number_of_services_post = $settings['number_of_services_post'];
	$selected_style = $settings['selected_style'];
    $selected_services = $settings['selected_services'];
    $args = array(
        'post_type' => 'our_services',
        'orderby' => $this->get_settings('orderby'),
        'post_status' => $this->get_settings('post_status'),
        'order' => $this->get_settings('order'),
        'posts_per_page' => $number_of_services_post,
        'post__in' => $selected_services, // Include only the selected services
    );

    $result = new WP_Query($args);
    if ($selected_style === 'style1') {
    echo '<div class="services_section position-relative">';
    if ($result->have_posts()) {
        echo '<div class="container">';
        echo '<div class="row position-relative" data-aos="fade-up">';
        echo '<div class="owl-carousel owl-theme">';
        while ($result->have_posts()) {
            $result->the_post();
            $url = wp_get_attachment_url(get_post_thumbnail_id(), "post_thumbnail");
            $meta = get_post_meta(get_the_ID(), 'post_thumbnail', true);
            ?>
                <div class="item">
                    <div class="services_box box1">
                        <figure>
                            <img src="<?php echo $meta ?>" alt="" class="img-fluid">
                        </figure>
                        <a href="<?php echo get_post_permalink(); ?>"><h3><?php echo wp_trim_words(get_the_title(), 2) ?></h3></a>
                        <p class="text-size-18"><?php echo wp_trim_words(get_the_content(), 11) ?></p>
                        <div class="btn_wrapper">
                        <?php
                            if (!empty($button_text)) {
                                // User has set values, display them
                                ?>
                                <a href="<?php echo get_post_permalink(); ?>" class="text-decoration-none"><span class="new_text_read">
                                    <?php echo $settings['button_text'] ?></span><i class="fa-solid fa-arrow-right"></i>
                                </a>
                                <?php
                            } else {
                                // User hasn't set values, display the default text and icon
                                ?>
                                <a href="<?php echo get_post_permalink(); ?>">Read More <i class="fa-solid fa-arrow-right"></i></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php
        }
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    }
    elseif ($selected_style === 'style2') {
        ?>
        <?php 
    }
}

}