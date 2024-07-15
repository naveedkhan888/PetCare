<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class Elementor_Products_Tab_Widget extends Widget_Base {
    /**
     * Get widget name.
     *
     * @return string
     */
    public function get_name() {
        return 'products-tab';
    }

    /**
     * Get widget title.
     *
     * @return string
     */
    public function get_title() {
        return 'Products Tab';
    }

    /**
     * Get widget icon.
     *
     * @return string
     */
    public function get_icon() {
        return 'eicon-tabs';
    }

    /**
     * Get widget categories.
     *
     * @return array
     */
    public function get_categories() {
        return ['general'];
    }

    /**
     * Register controls.
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => 'Tabs',
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
        
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_label',
            [
                'label' => 'Tab Label',
                'type' => Controls_Manager::TEXT,
                'default' => 'Tab',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'product_categories',
            [
                'label' => 'Product Categories',
                'type' => Controls_Manager::SELECT2,
                'options' => $this->getCategories(),
                'default' => [], // Default is an empty array for multiple selections
                'label_block' => true,
                'multiple' => true, // Allow multiple selections
            ]
        );
        $repeater->add_control(
            'products_per_tab',
            [
                'label' => 'Products Per Tab',
                'type' => Controls_Manager::NUMBER,
                'default' => 9, // Set a default value as per your requirement
                'min' => 1,     // Set a minimum value
            ]
        );
        

        $this->add_control(
            'tabs',
            [
                'label' => 'Tabs',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_label' => 'All Products',
                        'product_category' => '',
                    ],
                    [
                        'tab_label' => 'Dog Treats',
                        'product_category' => '',
                    ],
                    [
                        'tab_label' => 'Dog Food',
                        'product_category' => '',
                    ],
                    [
                        'tab_label' => 'Special Deals',
                        'product_category' => '',
                    ],
                    [
                        'tab_label' => 'Puppy Food',
                        'product_category' => '',
                    ],
                ],
                'title_field' => '{{{ tab_label }}}',
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
					'{{WRAPPER}} .store_image_box img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]);
		
		$this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'image Height', 'elementor-cpt-control' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .store_image_box img' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .store_image_box img' => 'object-fit: {{VALUE}};',
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
					'{{WRAPPER}} .store_image_box img' => 'object-position: {{VALUE}};',
				],
				'condition' => [
					'object-fit' => 'cover',
				],
			]
		);
		
		$this->end_controls_section();	
    }
     /**
     * Get WooCommerce product categories.
     *
     * @return array
     */
    function getCategories(){
        $category = [];
        $taxonomy     = 'product_cat';
        $orderby      = 'name';
        $show_count   = 0;      // 1 for yes, 0 for no
        $pad_counts   = 0;      // 1 for yes, 0 for no
        $hierarchical = 1;      // 1 for yes, 0 for no
        $title        = '';
        $empty        = 0;
    
        $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title,
            'hide_empty'   => $empty
        );
        $all_categories = get_categories( $args );
        foreach ($all_categories as $cat) {
            // print_r($cat);
            if($cat->category_parent == 0) {
                $category_id = $cat->term_id;
            
                $category[$category_id] = $cat->name;
                
                $args2 = array(
                        'taxonomy'     => $taxonomy,
                        'child_of'     => 0,
                        'parent'       => $category_id,
                        'orderby'      => $orderby,
                        'show_count'   => $show_count,
                        'pad_counts'   => $pad_counts,
                        'hierarchical' => $hierarchical,
                        'title_li'     => $title,
                        'hide_empty'   => $empty
                );
                $sub_cats = get_categories( $args2 );
                
                if($sub_cats) {
                    foreach($sub_cats as $sub_category) {
                       
                        //echo $sub_category->name;
                        $sub_category_id = $sub_category->term_id;
                        $category[$category_id]['sub_category'][$sub_category_id]['name'] = $sub_category->name;
                        $category[$category_id]['sub_category'][$sub_category_id]['slug'] = get_term_link($sub_category->slug, 'product_cat');
                    }
                }
            }
        }
        return $category;
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings();
        $selected_style = $settings['selected_style'];
    
        if (empty($settings['tabs'])) {
            return;
        }
    
        if ($selected_style === 'style1') { ?>
            <section class="store_section position-relative">
                <div class="container">
                    <div class="tabs-box tabs-options">
                        <ul class="nav nav-tabs">
                            <?php foreach ($settings['tabs'] as $index => $tab) : ?>
                                <li>
                                    <a class="<?php echo ($index === 0) ? 'active' : ''; ?>" data-toggle="tab" href="#tab-<?php echo $this->get_id() . '-' . $index; ?>">
                                        <?php echo esc_html($tab['tab_label']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="tab-content" data-aos="fade-up">
                            <?php foreach ($settings['tabs'] as $index => $tab) : ?>
                                <div id="tab-<?php echo $this->get_id() . '-' . $index; ?>" class="tab-pane fade<?php echo ($index === 0) ? ' in active show' : ''; ?>">
                                    <div class="row position-relative">
                                        <div class="owl-carousel owl-theme">
                                            <?php
                                            $product_category = $tab['product_category'];
                                            $args = array(
                                                'post_type' => 'product',
                                                'posts_per_page' => $tab['products_per_tab'],
                                                'tax_query' => (!empty($tab['product_categories'])) ? [
                                                    [
                                                        'taxonomy' => 'product_cat',
                                                        'field' => 'term_id',
                                                        'terms' => $tab['product_categories'],
                                                        'operator' => 'IN',
                                                    ],
                                                ] : [],
                                            );
    
                                            $query = new WP_Query($args);
    
                                            if ($query->have_posts()) :
                                                while ($query->have_posts()) : $query->the_post();
                                                    global $product;
                                                    ?>
                                                    <div class="item">
                                                        <a href="<?php echo $product->get_permalink(); ?>">
                                                            <div class="store_box">
                                                                <div class="store_image_box">
                                                                    <figure class="mb-0">
                                                                        <?php echo get_the_post_thumbnail($product->get_id(), 'thumbnail', array('class' => 'img-fluid')); ?>
                                                                    </figure>
                                                                </div>
                                                                <div class="store_box_content">
                                                                    <div class="text_rate_wrapper">
                                                                        <div class="text_wrapper">
                                                                            <h5><?php the_title(); ?></h5>
                                                                            <?php
                                                                            $categories = get_the_terms($product->get_id(), 'product_cat');
                                                                            if ($categories && !is_wp_error($categories)) {
                                                                                $category_names = array();
                                                                                foreach ($categories as $category) {
                                                                                    $category_names[] = $category->name;
                                                                                }
                                                                                echo '<p class="text-size-16">' . esc_html(implode(', ', $category_names)) . '</p>';
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                        <div class="rating">
                                                                            <?php
                                                                            $average_rating = $product->get_average_rating();
                                                                            $rating_html = ''; // Initialize the variable
    
                                                                            if ($average_rating > 0) {
                                                                                // Display the product rating if available
                                                                                $rating_html = '<i class="fa-solid fa-star"></i>';
                                                                                $rating_html .= '<span>' . esc_html($average_rating) . '/5</span>';
                                                                            }
    
                                                                            echo $rating_html;
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="price_cart_wrapper">
                                                                        <div class="price_wrapper">
                                                                            <span class="dollar"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                                                            <span class="counter"><?php echo $product->get_price(); ?></span>
                                                                            <span>.00</span>
                                                                        </div>
                                                                        <a href="<?php echo $product->get_permalink(); ?>">
                                                                            <figure class="cart mb-0">
                                                                                <img src="<?php echo PLUGIN_BASE_URI . 'assets/images/cart.png'; ?>" alt="" class="img-fluid">
                                                                            </figure>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php endwhile;
                                                wp_reset_postdata();
                                            else :
                                                echo '<p>No products found in this category.</p>';
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php } ?>
    <?php
    }
    
}
