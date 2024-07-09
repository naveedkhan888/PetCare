<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor petsone-team Widget.
 *
 * Elementor widget that uses the petsone-team control.
 *
 * @since 1.0.0
 */
class Elementor_Petsone_Team_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve petsone-team widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'petsone-team';
    }

    /**
     * Get widget title.
     *
     * Retrieve petsone-team widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__('Petsone Team', 'elementor-petsone-team-control');
    }

    /**
     * Get widget icon.
     *
     * Retrieve petsone-team widget icon.
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
     * Register petsone-team widget controls.
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
                'label' => esc_html__('Content', 'elementor-petsone-team-control'),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'selected_members',
            [
                'label' => esc_html__('Select Members', 'elementor-petsone-team-control'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_teams_options(), // Define a function to get available services options
            ]
        );
        // Inside the register_controls method
        $this->add_control(
            'selected_categories',
            [
                'label' => esc_html__('Select Categories', 'elementor-petsone-team-control'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_categories_options(), // Define a function to get available category options
            ]
        );
        $this->add_control(
			'selected_style',
			[
				'label' => esc_html__( 'Select Style', 'elementor-petsone-team-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'style1', // Set the default style
				'options' => [
					'style1' => esc_html__( 'Style 1', 'elementor-petsone-team-control' ),
					'style2' => esc_html__( 'Style 2', 'elementor-petsone-team-control' ),
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
					'{{WRAPPER}} img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]);
		
		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'image Height', 'elementor-cpt-control' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'object-fit',
			[
				'label' => esc_html__( 'Object Fit', 'elementor-petsone-team-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'condition' => [
					'image_height[size]!' => '',
				],
				'options' => [
					'' => esc_html__( 'Default', 'elementor-petsone-team-control' ),
					'fill' => esc_html__( 'Fill', 'elementor-petsone-team-control' ),
					'cover' => esc_html__( 'Cover', 'elementor-petsone-team-control' ),
					'contain' => esc_html__( 'Contain', 'elementor-petsone-team-control' ),
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} img' => 'object-fit: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'object-position',
			[
				'label' => esc_html__( 'Object Position', 'elementor-petsone-team-control' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'center center' => esc_html__( 'Center Center', 'elementor-petsone-team-control' ),
					'center left' => esc_html__( 'Center Left', 'elementor-petsone-team-control' ),
					'center right' => esc_html__( 'Center Right', 'elementor-petsone-team-control' ),
					'top center' => esc_html__( 'Top Center', 'elementor-petsone-team-control' ),
					'top left' => esc_html__( 'Top Left', 'elementor-petsone-team-control' ),
					'top right' => esc_html__( 'Top Right', 'elementor-petsone-team-control' ),
					'bottom center' => esc_html__( 'Bottom Center', 'elementor-petsone-team-control' ),
					'bottom left' => esc_html__( 'Bottom Left', 'elementor-petsone-team-control' ),
					'bottom right' => esc_html__( 'Bottom Right', 'elementor-petsone-team-control' ),
				],
				'default' => 'center center',
				'selectors' => [
					'{{WRAPPER}} img' => 'object-position: {{VALUE}};',
				],
				'condition' => [
					'object-fit' => 'cover',
				],
			]
		);
		
		$this->end_controls_section();	
    }

    private function get_teams_options()
    {
        $options = [];
        $args = array(
            'post_type' => 'our_team',
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
    // ...

    private function get_categories_options()
    {
        $options = [];
        $categories = get_categories(); // Get all categories

        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        return $options;
    }
    /**
     * Render petsone-team widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
{
    $settings = $this->get_settings_for_display();
    $selected_members = $settings['selected_members'];
    $selected_categories = $settings['selected_categories'];
    $selected_style = $settings['selected_style'];
    $args = array(
        'post_type'      => 'our_team',
        'orderby'        => $this->get_settings('orderby'),
        'post_status'    => $this->get_settings('post_status'),
        'order'          => $this->get_settings('order'),
        'posts_per_page' => -1,
        'post__in'       => $selected_members, // Include only the selected services
        'category__in'   => $selected_categories, // Include only the selected categories
    );

    $result = new WP_Query($args);
    if ($selected_style === 'style1') {
        ?>
        <section class="team_section">
        <div class="container">
            <div class="row" data-aos="fade-up">
                    <?php while ($result->have_posts()) {
                $result->the_post();
                $url = wp_get_attachment_url(get_post_thumbnail_id(), "post_thumbnail");
                $meta = get_post_meta(get_the_ID(), 'post_thumbnail', true);
                $fb = get_post_meta(get_the_ID(), 'social_profile_facebook_link', true);
                $twitter = get_post_meta(get_the_ID(), 'social_profile_twitter_link', true);
                $instagram = get_post_meta(get_the_ID(), 'social_profile_instagram_link', true);
                ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                        <a href="<?php echo get_post_permalink(); ?>"><div class="team_box">
                            <a href="<?php echo get_post_permalink(); ?>"><figure>
                                <img src="<?php echo $url ?>" alt="" class="img-fluid">
                            </figure></a>
                            <a href="<?php echo get_post_permalink(); ?>"><h3><?php echo get_the_title(); ?></h3></a>
                            <p class="text-size-18"><?php echo get_the_excerpt(); ?></p>
                            <div class="team_social_icons">
                                <?php if($fb){?>
                                    <a href="<?php echo $fb ?>" class="text-decoration-none">
                                        <i class="fa-brands fa-facebook-f hover-effect" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>
                                <?php if($twitter){?> 
                                <a href="<?php echo $twitter ?>" class="text-decoration-none">
                                    <i class="fa-brands fa-twitter hover-effect" aria-hidden="true"></i>
                                </a>
                                <?php } ?>
                                <?php if($instagram){?>
                                <a href="<?php echo $instagram ?>" class="text-decoration-none">
                                    <i class="fa-brands fa-instagram hover-effect mr-0" aria-hidden="true"></i>
                                </a>
                                <?php } ?>
                            </div>
                        </div></a>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </section>
    <?php
    }
    elseif($selected_style === 'style2'){
        ?>
    <?php
    }
}

}