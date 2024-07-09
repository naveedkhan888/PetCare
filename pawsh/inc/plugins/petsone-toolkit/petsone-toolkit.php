<?php
/**
 * Plugin Name: Petsone Toolkit
 * Description: Petsone Custom Elementor addon.
 * Plugin URI:  http://designingmedia.com
 * Version:     1.0.0
 * Author:      Designing Media
 * Author URI:  http://designingmedia.com
 * Text Domain: petsone-toolkit
 * 
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define('PLUGIN_BASE_URI', plugin_dir_url( __FILE__ ));

function petsone_toolkit_addon() {

	// Load plugin file
	require_once( __DIR__ . '/includes/petsone-plugin.php' );

	// Run the plugin
	\petsone_Toolkit_Addon\Petsone_Plugin::instance();

}
add_action( 'plugins_loaded', 'petsone_toolkit_addon' );

function HomeURL() { 
	return home_url(); 
} 
add_shortcode('URL', 'HomeURL'); 
// Home URL Link Shortcode 
	function HomeURL1() { 
	$url = preg_replace("(^http?://)", "", home_url() ); 
	$url = preg_replace("(^https?://)", "", home_url() ); 
	return $url; 
} 
add_shortcode('url', 'HomeURL1');

// Woocomerce Cart Short Code

add_shortcode ('woo_cart_but', 'woo_cart_but' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
		if(isset(WC()->cart)){
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
		<a class="btn nav-link" href="<?php echo $cart_url; ?>">
            <img class="cart-img" src="<?php echo get_template_directory_uri() .'/assets/img/cart-icon.png'?>">
			<span class="badge badge-info"></span>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        </a></li>
        <?php
		}
	    else{
            ?>
            <img class="cart-img" src="<?php echo get_template_directory_uri() . '/assets/img/cart-icon.png' ?>">
            <?php
        }
    return ob_get_clean();
 
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count', 10, 1 );
/**
 * Add AJAX Shortcode when cart contents update
 */
function woo_cart_but_count( $fragments ) {
 
    ob_start();
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php            
    }
        ?></a>
    <?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
}

add_filter( 'wp_nav_menu_top-menu_items', 'woo_cart_but_icon', 10, 2 ); // Change menu to suit - example uses 'top-menu'
/**
 * Add WooCommerce Cart Menu Item Shortcode to particular menu
 */
function woo_cart_but_icon ( $items, $args ) {
       $items .=  '[woo_cart_but]'; // Adding the created Icon via the shortcode already created
       return $items;
}

add_action('wp_ajax_cart_count_retriever', 'cart_count_retriever');
add_action('wp_ajax_nopriv_cart_count_retriever', 'cart_count_retriever');
function cart_count_retriever() {
    global $wpdb;
    echo WC()->cart->get_cart_contents_count();
    wp_die();
}

// Define a function that enqueues your JS styles
function js_styles() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'petsone_JS',  $plugin_url . "assets/js/petsone.js", array( 'jquery' ), '', true );

}
// Define a function that enqueues your CSS styles
function css_styles() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'petsone_widget_style',  $plugin_url . "assets/css/petsone-widget.css");
}
// Hook the function to an appropriate WordPress action
add_action( 'wp_enqueue_scripts', 'js_styles' );

function enqueue_admin_scripts() {
    wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'owl-carousel-min-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '', true );

	// Enqueue plugin-related scripts
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_script( 'petsone_JS',  $plugin_url . "assets/js/petsone.js", array( 'jquery' ), '', true );
}

add_action( 'admin_enqueue_scripts', 'enqueue_admin_scripts' );
add_action( 'elementor/editor/after_enqueue_scripts', 'enqueue_admin_scripts' );

add_shortcode('search_button', 'search_button');
function search_button()
    {
        ob_start();
        ?>
            <ul class="right-part-search pr-0">
	                    <li class="search" id="search">
	                        <a href="#">
            <img class="search-img" src="<?php echo get_template_directory_uri() . '/assets/img/search-icon.png' ?>">
            </a>
	                    </li>
	                </ul>
        <?php

        return ob_get_clean();

    }
    function cptui_register_my_cpts() {

        /**
         * Post Type: Our Services.
         */
    
        $labels = [
            "name" => esc_html__( "Our Services", "petsone" ),
            "singular_name" => esc_html__( "Our Service", "petsone" ),
        ];
    
        $args = [
            "label" => esc_html__( "Our Services", "petsone" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => true,
            "rewrite" => [ "slug" => "our_services", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
            "show_in_graphql" => false,
        ];
    
        register_post_type( "our_services", $args );
    
        /**
         * Post Type: Our Team.
         */
    
        $labels = [
            "name" => esc_html__( "Our Team", "petsone" ),
            "singular_name" => esc_html__( "Our Team", "petsone" ),
        ];
    
        $args = [
            "label" => esc_html__( "Our Team", "petsone" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => true,
            "rewrite" => [ "slug" => "our_team", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
            "show_in_graphql" => false,
        ];
    
        register_post_type( "our_team", $args );
    }
    
    add_action( 'init', 'cptui_register_my_cpts' );
    
    function cptui_register_my_cpts_our_services() {

        /**
         * Post Type: Our Services.
         */
    
        $labels = [
            "name" => esc_html__( "Our Services", "petsone" ),
            "singular_name" => esc_html__( "Our Service", "petsone" ),
        ];
    
        $args = [
            "label" => esc_html__( "Our Services", "petsone" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => true,
            "rewrite" => [ "slug" => "our_services", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
            "show_in_graphql" => false,
        ];
    
        register_post_type( "our_services", $args );
    }
    
    add_action( 'init', 'cptui_register_my_cpts_our_services' );
    function cptui_register_my_cpts_our_team() {

        /**
         * Post Type: Our Team.
         */
    
        $labels = [
            "name" => esc_html__( "Our Team", "petsone" ),
            "singular_name" => esc_html__( "Our Team", "petsone" ),
        ];
    
        $args = [
            "label" => esc_html__( "Our Team", "petsone" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => true,
            "rewrite" => [ "slug" => "our_team", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields" ],
            "show_in_graphql" => false,
        ];
    
        register_post_type( "our_team", $args );
    }
    
    add_action( 'init', 'cptui_register_my_cpts_our_team' );
    



    