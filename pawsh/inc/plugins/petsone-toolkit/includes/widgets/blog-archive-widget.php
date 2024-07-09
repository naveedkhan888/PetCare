<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor blog-archive Widget.
 *
 * Elementor widget that uses the blog-archive control.
 *
 * @since 1.0.0
 */
class Elementor_Blog_Archive_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve blog-archive widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name() {
        return 'blog-archive';
    }
    /**
     * Get widget title.
     *
     * Retrieve blog-archive widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__( 'Blog Archive', 'elementor-blog-archive-control' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve blog-archive widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    // public function get_icon() {
    //  return 'eicon-carousel-loop';
    // }

    /**
     * Register blog-archive widget controls.
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
                'label' => esc_html__( 'Content', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'number_of_columns',
            [
                'label' => __( 'Number of Columns', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1, // Set a default value
                'min' => 1,
                'max' => 12,
                'step' => 1,
            ]
        );
        $this->add_control(
            'number_of_post_blogs',
            [
                'label' => __( 'Posts Per Page', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3, // Set a default value
                'min' => 1,
                'max' => 21,
                'step' => 1,
            ]
        );
        $this->add_control(
            'post_blog_meta',
            [
                'label' => esc_html__( 'Select Post Meta', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_post_blog_meta(),
                'default' => 'post',
            ]
        );
        $this->add_control(
            'post_meta_separator',
            [
                'label' => esc_html__( 'Meta Separator', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '|', // Set your default separator
            ]
        );
        $this->add_control(
            'post_blog_category',
            [
                'label' => esc_html__( 'Category Filter', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_post_blog_categories(),
                'default' => 'post',
            ]
        );
        $this->add_control(
            'post_category_separator',
            [
                'label' => esc_html__( 'Category Separator', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => ',', // Set your default separator
            ]
        );

        $this->add_control(
            'archive_horizontal_view',
            [
                'label' => esc_html__( 'Vertical View', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes', // Set your default value
                'label_on' => 'ON',
                'label_off' => 'OFF',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'archive_image_section',
            [
                'label' => esc_html__('Image', 'elementor-blog-archive-control'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_image',
            [
                'label' => esc_html__( 'Show Image', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes', // Set your default value
                'label_on' => 'Show',
                'label_off' => 'Hide',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'post_order_section',
            [
                'label' => esc_html__('Post Order', 'elementor-blog-archive-control'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'post_order',
            [
                'label'   => esc_html__('Post Order', 'elementor-blog-archive-control'),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'asc'  => [
                        'title' => esc_html__('Ascending', 'elementor-blog-archive-control'),
                        'icon'  => 'fa fa-sort-amount-asc',
                    ],
                    'desc' => [
                        'title' => esc_html__('Descending', 'elementor-blog-archive-control'),
                        'icon'  => 'fa fa-sort-amount-desc',
                    ],
                ],
                'default' => 'asc',
            ]
        );
        
        $this->add_control(
            'post_order_by',
            [
                'label'   => esc_html__('Sort Order', 'elementor-blog-archive-control'),
                'type'    => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'date'  => [
                        'title' => esc_html__('Latest Posts', 'elementor-blog-archive-control'),
                        'icon'  => 'fa fa-calendar',
                    ],
                    'title' => [
                        'title' => esc_html__('Alphabetical Order', 'elementor-blog-archive-control'),
                        'icon'  => 'fa fa-sort-alpha-asc',
                    ],
                ],
                'default' => 'date',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'excerpt_section',
            [
                'label' => esc_html__( 'Excerpt', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'show_excerpt',
            [
                'label' => esc_html__( 'Show Excerpt', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes', // Set your default value
                'label_on' => 'Show',
                'label_off' => 'Hide',
            ]
        );

        $this->add_control(
            'excerpt_length',
            [
                'label' => esc_html__('Excerpt Length', 'elementor-blog-archive-control'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
                'default' => 20, // Set your default excerpt length
                'description' => esc_html__('Specify the number of words to display in the excerpt.', 'elementor-blog-archive-control'),
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'pagination_section',
            [
                'label' => esc_html__( 'Pagination', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'show_pagination',
            [
                'label' => esc_html__( 'Show pagination', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes', // Set your default value
                'label_on' => 'Show',
                'label_off' => 'Hide',
            ]
        );

        $this->add_control(
            'text_align',
            [
                'label' => esc_html__( 'Alignment', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'textdomain' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'textdomain' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'textdomain' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .post_archive .pagination' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'read_more_section',
            [
                'label' => esc_html__( 'Read More', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        
        $this->add_control(
            'show_readMore',
            [
                'label' => esc_html__( 'Show Read More', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'yes', // Set your default value
                'label_on' => 'Show',
                'label_off' => 'Hide',
            ]
        );

        $this->add_control(
            'readMore_text',
            [
                'label' => esc_html__( 'Read More Text', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'textdomain' ),
                'placeholder' => esc_html__( 'Read More', 'textdomain' ),
                'condition' => [
                    'show_readMore' => 'yes',
                    ]
                
            ]
        );
        $this->end_controls_section();
        // $this->start_controls_section(
        //  'image_section',
        //  [
        //      'label' => esc_html__( 'Image Controls', 'elementor-blog-archive-control' ),
        //      'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        //  ]
        // );
        
        // $this->add_responsive_control(
        //  'image_size',
        //  [
        //      'label' => esc_html__( 'Image Size', 'elementor-blog-archive-control' ),
        //      'type' => \Elementor\Controls_Manager::SELECT,
        //      'default' => 'medium', // Set your default image size
        //      'options' => [
        //          'thumbnail' => 'Thumbnail',
        //          'medium' => 'Medium',
        //          'large' => 'Large',
        //          'full' => 'Full',
        //      ],
        //  ]
        // );
        
        // $this->end_controls_section();
        // $this->start_controls_section(
        //  'date_comments_section',
        //  [
        //      'label' => esc_html__( 'Date & Comments', 'elementor-blog-archive-control' ),
        //      'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
        //  ]
        // );
        
        // $this->add_control(
        //  'show_date_comments',
        //  [
        //      'label' => esc_html__( 'Show Date & Comments', 'elementor-blog-archive-control' ),
        //      'type' => \Elementor\Controls_Manager::SWITCHER,
        //      'default' => 'yes', // Set your default value
        //      'label_on' => 'Show',
        //      'label_off' => 'Hide',
        //  ]
        // );
        
        // $this->end_controls_section();
        ////////////////////////////////////////////////////////////////////////////////////

        ////////////////////////////////// Box Style /////////////////////////////////////

        $this->start_controls_section(
            'archive_box_control_section',
            [
                'label' => esc_html__( 'Box Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'archive_box_padding',
            [
                'label' => __( 'Padding', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'archive_box_margin',
            [
                'label' => __( 'Margin', 'tabs' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '30',
                    'unit' => 'px', // Default unit
                ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box' => 'margin-bottom: {{BOTTOM}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'archive_box_border',
                'selector' => '{{WRAPPER}} .post_archive .post_box',
            ]
        );
        $this->add_responsive_control(
            'archive_box_radius',
            [
                'label' => esc_html__( 'Border Radius', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'archive_box_background',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .post_archive .post_box',
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'archive_box_shadow',
                'selector' => '{{WRAPPER}} .post_archive .post_box',
            ]
        );
        $this->add_responsive_control(
            'archive_gap',
            [
                'label' => esc_html__( 'Gap', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive' => 'grid-gap: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
        
        $this->end_controls_section();
        ////////////////////////////////// Box Style Ends/////////////////////////////////////

        ////////////////////////////////// Image Style /////////////////////////////////////

        $this->start_controls_section(
            'image_control_section',
            [
                'label' => esc_html__( 'Image Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_image' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'selector' => '{{WRAPPER}} .post_box .host-archive-fig',
            ]
        );
        $this->add_responsive_control(
            'archive_blog_radius_img',
            [
                'label' => esc_html__( 'Border Radius', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .post_box .host-archive-fig img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'archive_blog_margin_img',
            [
                'label' => __( 'Margin', 'tabs' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '30',
                    'unit' => 'px', // Default unit
                ],
                'selectors' => [
                    '{{WRAPPER}} .post_box .host-archive-fig' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'archive_image_width',
            [
                'label' => esc_html__( 'Image Width', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post_box .host-archive-fig img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'archive_image_height',
            [
                'label' => esc_html__( 'Image Height', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'condition' => [
                    'archive_horizontal_view' => '',
                ],
                'default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post_box .post_image .archive-image-link .host-archive-fig img' => 'height: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->add_responsive_control(
            'archive_posts_gap',
            [
                'label' => esc_html__( 'Gap', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'condition' => [
                    'archive_horizontal_view' => '',
                ],
                'default' => [
                    'size' => 15,
                    'unit' => 'px',
                ],
                
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box' => 'gap: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
        
        $this->end_controls_section();
        ////////////////////////////////// Image Style Ends/////////////////////////////////////

        ////////////////////////////////// Category Style Starts/////////////////////////////////////

        $this->start_controls_section(
            'category_style_section',
            [
                'label' => esc_html__( ' Category Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'category_typography',
                'label' => __( ' Category Typography', 'elementor-blog-archive-control' ),
                'selector' => '{{WRAPPER}} .post_archive .post_box a',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
        );
        $this->add_control(
            'category_color',
            [
                'label' => __( ' Category Color', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .post-category a' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
                ],
            ]
        );
        $this->add_control(
            'category_color_hover',
            [
                'label' => __( ' Category Hover Color', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box a:hover' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );
        
        $this->add_responsive_control(
            'category_margin',
            [
                'label' => __( ' Category Margin', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'unit' => 'px', // Default unit
                ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .post-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_responsive_control(
            'category_padding',
            [
                'label' => __( 'Category Padding', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .post-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        ////////////////////////////////// Category Style Ends/////////////////////////////////////
        ////////////////////////////////// Title Style Starts/////////////////////////////////////
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => esc_html__( 'Title Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( ' Title Typography', 'elementor-blog-archive-control' ),
                'selector' => '{{WRAPPER}} .post_archive .post_box  a .heading-txt',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
            
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( ' Title Color', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box  a .heading-txt' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => __( ' Title Hover Color', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box  a .heading-txt:hover' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
                ],
            ]
        );
        
        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __( ' Title Margin', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box  a .heading-txt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'unit' => 'px', // Default unit
                ],
            ]
        );
    
        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __( 'Title Padding', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box  a .heading-txt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        ////////////////////////////////// Title Style Ends/////////////////////////////////////
        ////////////////////////////////// Meta Style Starts/////////////////////////////////////
        $this->start_controls_section(
            'meta_style_section',
            [
                'label' => esc_html__( 'Meta Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => __( ' Meta Typography', 'elementor-blog-archive-control' ),
                'selector' => '{{WRAPPER}} .post_archive .post_box .span_wrapper span',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_ACCENT,
                ],
            ]
            
        );
        $this->add_control(
            'meta_color',
            [
                'label' => __( ' Meta Color', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .span_wrapper span' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
                ],
            ]
        );
       
        $this->add_responsive_control(
            'meta_margin',
            [
                'label' => __( ' Meta Margin', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .span_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'unit' => 'px', // Default unit
                ],
            ]
        );
    
        $this->add_responsive_control(
            'meta_padding',
            [
                'label' => __( 'Meta Padding', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .span_wrapper span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        ////////////////////////////////// Meta Style Ends/////////////////////////////////////

        ////////////////////////////////// Excerpt Style Starts/////////////////////////////////////
        $this->start_controls_section(
            'excerpt_style_section',
            [
                'label' => esc_html__( 'Excerpt Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_excerpt' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => __( ' Excerpt Typography', 'elementor-blog-archive-control' ),
                'selector' => '{{WRAPPER}} .post_archive .post_box .blog-archive-contents',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
            
        );
        $this->add_control(
            'excerpt_color',
            [
                'label' => __( ' Excerpt Color', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .blog-archive-contents' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_TEXT,
                ],
            ]
        );
       
        
        $this->add_responsive_control(
            'excerpt_margin',
            [
                'label' => __( ' Excerpt Margin', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .blog-archive-contents' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'unit' => 'px', // Default unit
                ],
            ]
        );
    
        $this->add_responsive_control(
            'excerpt_padding',
            [
                'label' => __( 'Excerpt Padding', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .blog-archive-contents' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        ////////////////////////////////// Excerpt Style Ends/////////////////////////////////////
        ////////////////////////////////// Read More Style Starts/////////////////////////////////////
        $this->start_controls_section(
            'readMore_style_section',
            [
                'label' => esc_html__( 'Read More Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_readMore' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'readMore_typography',
                'label' => __( 'Typography', 'elementor-blog-archive-control' ),
                'selector' => '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
            
        );
        
        $this->add_responsive_control(
            'readMore_margin',
            [
                'label' => __( 'Read More Margin', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'unit' => 'px', // Default unit
                ],
            ]
        );
    
        $this->add_responsive_control(
            'readMore_padding',
            [
                'label' => __( 'Read More Padding', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs(
            'readMore_style_tabs'
        );
            $this->start_controls_tab(
                'style_readMore_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'textdomain' ),
                    ]
                );
                $this->add_control(
                    'readMore_color',
                    [
                        'label' => __( 'Color', 'elementor-blog-archive-control' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn' => 'color: {{VALUE}};',
                        ],
                        'global' => [
                            'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                        ],
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'readMore_box_border',
                        'selector' => '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn',
                    ]
                );
                $this->add_responsive_control(
                    'readMore_box_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'elementor-blog-archive-control' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'selectors' => [
                            '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
        
                
                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'readMore_box_background',
                        'types' => [ 'classic', 'gradient', 'video' ],
                        'selector' => '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn',
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'readMore_box_shadow',
                        'selector' => '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn',
                    ]
                );
               
            $this->end_controls_tab();
 
            $this->start_controls_tab(
                'style_readMore_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'textdomain' ),
                ]
            );
            $this->add_control(
                'readMore_color_hover',
                [
                    'label' => __( 'Color', 'elementor-blog-archive-control' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn:hover' => 'color: {{VALUE}};',
                    ],
                    'global' => [
                        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'readMore_box_border_hover',
                    'selector' => '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn:hover',
                ]
            );
            $this->add_responsive_control(
                'readMore_box_radius_hover',
                [
                    'label' => esc_html__( 'Border Radius', 'elementor-blog-archive-control' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'readMore_box_background_hover',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn:hover',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'readMore_box_shadow_hover',
                    'selector' => '{{WRAPPER}} .post_archive .post_box .post-content-outter a.arcive_read_more_btn:hover',
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->end_controls_section();
        ////////////////////////////////// Read More Style Ends/////////////////////////////////////

        ////////////////////////////////// Pagination Style Starts/////////////////////////////////////
        $this->start_controls_section(
            'pagination_style_section',
            [
                'label' => esc_html__( 'Pagination Style', 'elementor-blog-archive-control' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_pagination' => 'yes',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'pagination_typography',
                'label' => __( 'Typography', 'elementor-blog-archive-control' ),
                'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
            
        );
        
        $this->add_responsive_control(
            'pagination_margin',
            [
                'label' => __( 'Pagination Margin', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .pagination .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '0',
                    'left' => '0',
                    'right' => '0',
                    'bottom' => '20',
                    'unit' => 'px', // Default unit
                ],
            ]
        );
    
        $this->add_responsive_control(
            'pagination_padding',
            [
                'label' => __( 'Pagination Padding', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .pagination .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pagination_width',
            [
                'label' => esc_html__( 'Pagination Width', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .pagination  span.page-numbers' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post_archive .pagination  span.page-numbers.current' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pagination_height',
            [
                'label' => esc_html__( 'Pagination Height', 'elementor-blog-archive-control' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'default' => [
                    'size' => 10,
                    'unit' => 'px',
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .post_archive .pagination  span.page-numbers' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .post_archive .pagination  span.page-numbers.current' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'pagination_style_tabs'
        );
            $this->start_controls_tab(
                'style_pagination_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'textdomain' ),
                    ]
                );
                $this->add_control(
                    'pagination_color',
                    [
                        'label' => __( 'Color', 'elementor-blog-archive-control' ),
                        'type' => \Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .post_archive .pagination .page-numbers' => 'color: {{VALUE}};',
                        ],
                        'global' => [
                            'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                        ],
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'pagination_box_border',
                        'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers',
                    ]
                );
                $this->add_responsive_control(
                    'pagination_box_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'elementor-blog-archive-control' ),
                        'type' => \Elementor\Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                        'selectors' => [
                            '{{WRAPPER}} .post_archive .pagination .page-numbers' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );
        
                
                $this->add_group_control(
                    \Elementor\Group_Control_Background::get_type(),
                    [
                        'name' => 'pagination_box_background',
                        'types' => [ 'classic', 'gradient', 'video' ],
                        'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers',
                    ]
                );
                $this->add_group_control(
                    \Elementor\Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'pagination_box_shadow',
                        'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers',
                    ]
                );
               
            $this->end_controls_tab();
 
            $this->start_controls_tab(
                'style_pagination_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'textdomain' ),
                ]
            );
            $this->add_control(
                'pagination_color_hover',
                [
                    'label' => __( 'Color', 'elementor-blog-archive-control' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post_archive .pagination .page-numbers:hover' => 'color: {{VALUE}};',
                    ],
                    'global' => [
                        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'pagination_box_border_hover',
                    'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers:hover',
                ]
            );
            $this->add_responsive_control(
                'pagination_box_radius_hover',
                [
                    'label' => esc_html__( 'Border Radius', 'elementor-blog-archive-control' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .post_archive .pagination .page-numbers:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'pagination_box_background_hover',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .post_archive .page-numbers',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'pagination_box_shadow_hover',
                    'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers:hover',
                ]
            );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'style_pagination_active_tab',
                [
                    'label' => esc_html__( 'Active', 'textdomain' ),
                ]
            );
            $this->add_control(
                'pagination_color_active',
                [
                    'label' => __( 'Color', 'elementor-blog-archive-control' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post_archive .pagination .page-numbers.current' => 'color: {{VALUE}} !important;',
                    ],
                    'global' => [
                        'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_ACCENT,
                    ],
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'pagination_box_border_active',
                    'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers.current',
                ]
            );
            $this->add_responsive_control(
                'pagination_box_radius_active',
                [
                    'label' => esc_html__( 'Border Radius', 'elementor-blog-archive-control' ),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                    'selectors' => [
                        '{{WRAPPER}} .post_archive .pagination .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'pagination_box_background_active',
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers.current',
                ]
            );
            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'pagination_box_shadow_active',
                    'selector' => '{{WRAPPER}} .post_archive .pagination .page-numbers.current',
                ]
            );
            $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
        ////////////////////////////////// Pagination Style Ends/////////////////////////////////////
    }
        /**
     * Get blog-archive categories.
     *
     * Retrieve the blog-archive categories to populate the category control.
     *
     * @since 1.0.0
     * @access protected
     * @return array blog-archive categories.
     */

    //Get Post categories
    protected function get_post_blog_categories() {
        $categories = get_categories( array( 'taxonomy' => 'category' ) );
        $options = array();

        foreach ( $categories as $category ) {
            $options[ $category->term_id ] = $category->name;
        }
        return $options;
    }

    //Get Post Meta
    protected function get_post_blog_meta() {
        
        $options = [
            'author' => esc_html__('Author', 'elementor-blog-archive-control'),
            'date' => esc_html__('Publication Date', 'elementor-blog-archive-control'),
            'comments' => esc_html__('Number of Comments', 'elementor-blog-archive-control'),
        ];
        
        $metaArray = [];

        foreach ($options as $key => $value) {
            $metaArray[$key] = $value;
        }
        return $metaArray;
    }
    /**
     * Render blog-archive widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        $number_of_post_blogs = $settings['number_of_post_blogs'];
        if (isset($settings['post_blog_category']) && !empty($settings['post_blog_category'])) {
            $category = $settings['post_blog_category'];
        } else {
            // If post_blog_category is not defined or empty, set $category to an empty array
            $category = array();
        }

        // $category = $settings['post_blog_category'];
        $metaValues = $settings['post_blog_meta'];
        $post_order = ($settings['post_order'] === 'asc') ? 'ASC' : 'DESC';
        // $show_date_comments = $settings['show_date_comments']; // Get the user's selection
        // Get user-selected sorting order (latest posts or alphabetical)
        $post_order_by = ($settings['post_order_by'] === 'date') ? 'date' : 'title';
        $number_of_columns = $settings['number_of_columns'];
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $number_of_post_blogs,
            'order'          => $post_order,    // Use user-selected post order
            'orderby'        => $post_order_by, // Use user-selected sorting order
            );
            if (!empty($category)) {
                $args['tax_query'] =  array(
                    array(
                        'taxonomy' => 'category',
                        'field'    => 'Name',
                        'terms'    => $category,
                ),
            );
        }
        if (isset($settings['number_of_post_blogs']) && is_numeric($settings['number_of_post_blogs']) && $settings['number_of_post_blogs'] > 0) {
            $args['posts_per_page'] = $settings['number_of_post_blogs'];
            $args['paged'] = get_query_var('paged') ? get_query_var('paged') : 1;
        }

        $result = new WP_Query($args);
        echo '<div class="post_archive">';
        if ($result->have_posts()) {
            echo '<div class="post_archive" style="display: grid; grid-template-columns: repeat(' . $number_of_columns . ', 1fr);">';
            // echo '<div class="post_archive" style="display: grid; ">';
    
            // echo '<div class="row" data-aos="fade-up">';
            $count = 0;
            while ($result->have_posts()) {
                $result->the_post();
                $post_id = get_the_ID();
                // $meta = get_the_post_thumbnail(get_the_ID(), 'large');
                // $comment_count = get_comments_number($post_id);
                ?>
                <!-- <div class="col-lg-4 col-md-6 col-sm-12 col-12"> -->
                    <div class="post_box">
                    <?php
                    if($settings['show_image'] == 'yes'){
                    ?>
                        <div class="post_image">
                            <a class="archive-image-link d-block" href="<?php echo the_permalink(); ?><?php isset($_GET['view'])?'view='.$_GET['view']:'' ?>">
                                <figure class="host-archive-fig">
                                    <!-- < ?php echo get_the_post_thumbnail($post_id, $image_size); ?> -->
                                    <?php echo get_the_post_thumbnail($post_id); ?>
                                </figure>
                            </a>
                        </div>
                        <?php
                    }
                            ?>
                            <div class="post-content-outter">
                                <div class="post-category">
                                    <?php
                                        $post_categories = get_the_category(); // This function should be used within the WordPress Loop
                                        
                                        if (!empty($post_categories)) {
                                            $total_categories = count($post_categories);
                                        
                                            foreach ($post_categories as $index => $category) {
                                                echo '<a href="' . esc_url(get_category_link($category->term_id)) . '">' . esc_html($category->name) . '</a>';
                                        
                                                // Add a separator if it's not the last category
                                                if ($index < $total_categories - 1) {
                                                    echo ' <span> '. $settings['post_category_separator'];'</span>';
                                                }
                                            }
                                        }
                                        
                                    ?>
                                </div>
                       
                                <a href="<?php echo get_post_permalink(); ?>">
                                    <h5 class="heading-txt"><?php the_title(); ?></h5>
                                </a>
                                <div class="span_wrapper">
                                    <?php
                                    if (is_array($metaValues) && in_array('date', $metaValues)) {
                                        $comments_link = get_comments_link(get_the_ID());
                                    ?>
                                        <span><a href="<?php echo get_day_link(get_the_date('Y'), get_post_time('m'), get_post_time('j')); ?>" class="entry-date"><?php the_time('M d, Y') ?></a></span>
                                        <span><?php echo $settings['post_meta_separator']; ?></span>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if (is_array($metaValues) && in_array('author', $metaValues)) {
                                    ?>
                                        <span><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></span>
                                        <span><?php echo $settings['post_meta_separator']; ?></span>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if (is_array($metaValues) && in_array('comments', $metaValues)) {
                                    ?>
                                        <span><a href="<?php echo esc_url(get_comments_link(get_the_ID())); ?>"><?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></a></span>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <?php
                                if($settings['show_excerpt'] == 'yes'){
                                ?>
                                    <p class="blog-archive-contents"><?php echo wp_trim_words(get_the_excerpt($post_id), $settings['excerpt_length']); ?></p>
                                <?php
                                }
                                if($settings['show_readMore'] == 'yes'){
                                    echo '<a class="arcive_read_more_btn d-inline-block" href="' . esc_url(get_permalink()) . '">' . esc_html(!empty($settings['readMore_text']) ? $settings['readMore_text'] : 'Read More') . '</a>';
                                
                                }
                            ?>
                            </div>
                        </div>
                    <!-- </div> -->
                <!-- </div> -->
                <?php
            }
            echo '</div>';
        }
        if($settings['show_pagination'] == 'yes'){
          
            echo '<div class="pagination">';
            echo paginate_links(['total' => $result->max_num_pages, 'current' => $args['paged']]);
            echo '</div>';
        }
        ?>
        <?php
        if($settings['archive_horizontal_view'] == null || $settings['archive_horizontal_view'] == 'no'){
            ?>
            <style>
                .post_archive .post_box {display:flex;}
            </style>
            <?php
        }
        if($number_of_columns > 1 && ($settings['archive_horizontal_view'] !== '')){
            ?>
            <style>
            @media only screen and (max-width: 1024px){
                .post_archive .post_archive{
                    grid-template-columns: repeat(2, 1fr) !important;
                }
            }
            @media only screen and (max-width: 767px){
                .post_archive .post_archive{
                    grid-template-columns: repeat(1, 1fr) !important;
                }
            }
            </style>
            <?php
        }
        if($number_of_columns > 1 && ($settings['archive_horizontal_view'] == '')){
            ?>
            <style>
            @media only screen and (max-width: 1199px){
                .post_archive .post_archive{
                    grid-template-columns: repeat(1, 1fr) !important;
                }
            }
            </style>
            <?php
        }
    }
    
    

}