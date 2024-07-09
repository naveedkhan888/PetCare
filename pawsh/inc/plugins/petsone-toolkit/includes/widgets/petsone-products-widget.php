<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Petsone_Products_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * @return string
     */
    public function get_name()
    {
        return 'petsonewoocommerce-widget';
    }

    /**
     * Get widget title.
     *
     * @return string
     */
    public function get_title()
    {
        return esc_html__('Petsone Products', 'textdomain');
    }

    /**
     * Get widget icon.
     *
     * @return string
     */
    public function get_icon()
    {
        return 'eicon-carousel-loop';
    }

    /**
     * Get widget categories.
     *
     * @return array
     */
    public function get_categories()
    {
        return ['general'];
    }

    /**
     * Register widget controls.
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'textdomain'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'number_of_products',
            [
                'label' => esc_html__('Number of Products', 'textdomain'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 200,
                'step' => 1,
            ]
        );

        $this->add_control(
            'woocommerce_products_category',
            [
                'label' => esc_html__('Select Products Category', 'elementor-petsone-products-control'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->getCategories(),
                'default' => 'Restaurant',
            ]
        );

        $this->end_controls_section();
    }

    function getCategories()
    {
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
        $all_categories = get_categories($args);
        foreach ($all_categories as $cat) {
            if ($cat->category_parent == 0) {
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
                $sub_cats = get_categories($args2);

                if ($sub_cats) {
                    foreach ($sub_cats as $sub_category) {
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
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Query WooCommerce products
        $category = $settings['woocommerce_products_category'];
        $query_args = array(
            'post_type'      => 'product',
            'posts_per_page' => $settings['number_of_products'],
        );

        // Check if a category is selected
        if (!empty($category)) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'Name',
                    'terms'    => $category,
                ),
            );
        }

        $products = new WP_Query($query_args);

        // Display products
        if ($products->have_posts()) {
            echo '<div class="petsone-products">';
            $product_count = 0;
            echo '<div class="row">';
            while ($products->have_posts()) {
                $products->the_post();
                global $product;

                ?>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="product-content">
                        <figure class="mb-0">
                            <?php echo get_the_post_thumbnail($product->get_id(), 'full', array('class' => 'img-fluid')); ?>
                            <a class="text-decoration-none" href="<?php echo $product->get_permalink(); ?>">
                                Add to Cart
                            </a>
                        </figure>
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
                        <a class="text-decoration-none" href="<?php echo $product->get_permalink(); ?>">
                            <h5><?php the_title(); ?></h5>
                        </a>
                        <ul class="list-unstyled">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <div class="price_cart_wrapper">
                            <div class="price_wrapper">
                                <span class="dollar"><?php echo get_woocommerce_currency_symbol(); ?></span>
                                <span class="counter"><?php echo $product->get_price(); ?></span>
                                <span>.00</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php
                $product_count++;
            }

            echo '</div>';
            echo '</div>';
            wp_reset_postdata();
        }
    }
}
