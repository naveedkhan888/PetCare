<?php
/** 
 * Pawsh Customizer data
 */

function pawsh_customizer( $data ) {
	$pawsh_elementor_template_list = pawsh_get_elementor_templates();
	$pawsh_elementor_header_templates = pawsh_get_elementor_header_templates();
	return array(
		'panel' => array ( 
			'id' => 'pawsh',
			'name' => esc_html__('Pawsh Customizer','pawsh'),
			'priority' => 10,
			'section' => array(
				'header_setting' => array(
					'name' => esc_html__( 'Header Topbar Setting', 'pawsh' ),
					'priority' => 10,
					'fields' => array(
						array(
							'name' => esc_html__( 'Topbar Swicher', 'pawsh' ),
							'id' => 'pawsh_topbar_switch',
							'default' => false,
							'type' => 'switch',
							'transport'	=> 'refresh'
						),						
						array(
							'name' => esc_html__( 'Show Button', 'pawsh' ),
							'id' => 'pawsh_show_header_btn',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Button Text', 'pawsh' ),
							'id' => 'pawsh_header_btn_text',
							'default' => esc_html__('Sign in','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Button Link', 'pawsh' ),
							'id' => 'pawsh_header_btn_link',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Button Icon', 'pawsh' ),
							'id' => 'pawsh_header_btn_icon',
							'default' => esc_html__('fa fa-user-o', 'pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						/** investment button **/	
						array(
							'name' => esc_html__( 'Show Investment Offer Link', 'pawsh' ),
							'id' => 'pawsh_show_investment_offer_link',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Link Text', 'pawsh' ),
							'id' => 'pawsh_header_link_text',
							'default' => esc_html__('Pawsh Offer','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Link Url', 'pawsh' ),
							'id' => 'pawsh_header_link_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						/** contact-info **/
						array(
							'name' => esc_html__( 'Show Contact Info', 'pawsh' ),
							'id' => 'pawsh_show_contact_info',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Email Address', 'pawsh' ),
							'id' => 'pawsh_header_email',
							'default' => esc_html__('info@gmail.com','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Phone Number', 'pawsh' ),
							'id' => 'pawsh_header_phone',
							'default' => esc_html__('+97657945737', 'pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						)

					) 
				),
				'pawsh_topbar_social_profiles_setting' => array(
					'name' => esc_html__( 'Header Social Profiles', 'pawsh' ),
					'priority' => 15,
					'fields' => array(
						array(
							'name' => esc_html__( 'Show Social Profiles', 'pawsh' ),
							'id' => 'pawsh_show_social_profiles',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Facebook Url', 'pawsh' ),
							'id' => 'pawsh_topbar_fb_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Twitter Url', 'pawsh' ),
							'id' => 'pawsh_topbar_twitter_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Linkedin Url', 'pawsh' ),
							'id' => 'pawsh_topbar_linkedin_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Instagram Url', 'pawsh' ),
							'id' => 'pawsh_topbar_instagram_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
					) 
				),
				'header_main_setting' => array(
					'name' => esc_html__( 'Header Setting', 'pawsh' ),
					'priority' => 20,
					'fields' => array(
						array(
							'name' => esc_html__( 'Choose Header Style', 'pawsh' ),
							'id' => 'choose_default_header',
							'type'     => 'select',
							'choices'  => array(
								'header-style-1' => esc_html__( 'Header Style 1', 'pawsh' ),
								'header-style-2' => esc_html__( 'Header Style 2', 'pawsh' ),
							),
							'default' => 'header-style-2',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Header Type', 'pawsh' ),
							'id' => 'choose_default_header',
							'type'     => 'select',
							'choices'  => array(
								'default-header' => esc_html__( 'Default Header', 'pawsh' ),
								'elementor-header' => esc_html__( 'Elementor Header', 'pawsh' ),
							),
							'default' => 'default-header',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Header Elementor Templates', 'pawsh' ),
							'id' => 'choose_elementor_header',
							'type'     => 'select',
							'choices'  => $pawsh_elementor_header_templates,
							'transport'	=> 'refresh',
							'required' => ['header_source_type',
							'=',
							'e'],
						),
						array(
							'name' => esc_html__( 'Header Logo', 'pawsh' ),
							'id' => 'logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Black Logo', 'pawsh' ),
							'id' => 'seconday_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Retina Logo', 'pawsh' ),
							'id' => 'retina_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo@2x.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Retina Black Logo', 'pawsh' ),
							'id' => 'retina_secondary_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo-black@2x.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Show Header Search', 'pawsh' ),
							'id' => 'pawsh_header_search_show',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),	
					) 
				),	
				'banner_main_setting' => array(
					'name' => esc_html__( 'Sub Banner Setting', 'pawsh' ),
					'priority' => 20,
					'fields' => array(
						
						array(
							'name' => esc_html__( 'Banner Image', 'pawsh' ),
							'id' => 'sub-banner-img',
							'default' => get_template_directory_uri() . '/assets/img/sub-banner-img.jpg',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						
					) 
				),	
				'page_title_setting'=> array(
					'name'=> esc_html__('Page Title Setting','pawsh'),
					'priority'=> 30,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Choose Breadcrumb Style', 'pawsh' ),
							'id' => 'choose_default_breadcrumb',
							'type'     => 'select',
							'choices'  => array(
								'breadcrumb-style-1' => esc_html__( 'Breadcrumb Style 1', 'pawsh' ),
								'breadcrumb-style-2' => esc_html__( 'default', 'pawsh' ),
							),
							'default' => 'breadcrumb-style-1',
							'transport'	=> 'refresh'
						),
						array(
							'name'=>esc_html__('Breadcrumb BG Color','pawsh'),
							'id'=>'breadcrumb_bg_color',
							'default'=> esc_html__('#343a40','pawsh'),
							'transport'	=> 'refresh'  
						),
						array(
							'name' => esc_html__( 'Page Title Background Image', 'pawsh' ),
							'id' => 'breadcrumb_bg_img',
							'default' => '',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb Archive', 'pawsh' ),
							'id' => 'breadcrumb_archive',
							'default' => esc_html__('Archive for category','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb Search', 'pawsh' ),
							'id' => 'breadcrumb_search',
							'default' => esc_html__('Search results for','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb tagged', 'pawsh' ),
							'id' => 'breadcrumb_post_tags',
							'default' => esc_html__('Posts tagged','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb posted by', 'pawsh' ),
							'id' => 'breadcrumb_artitle_post_by',
							'default' => esc_html__('Articles posted by','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb Page Not Found', 'pawsh' ),
							'id' => 'breadcrumb_404',
							'default' => esc_html__('Page Not Found','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb Page', 'pawsh' ),
							'id' => 'breadcrumb_page',
							'default' => esc_html__('Page','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),			
						array(
							'name' => esc_html__( 'Breadcrumb Shop', 'pawsh' ),
							'id' => 'breadcrumb_shop',
							'default' => esc_html__('Shop','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),			
						array(
							'name' => esc_html__( 'Breadcrumb Home', 'pawsh' ),
							'id' => 'breadcrumb_home',
							'default' => esc_html__('Home','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),					
					)
				),
				'blog_setting'=> array(
					'name'=> esc_html__('Blog Setting','pawsh'),
					'priority'=> 40,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Show Blog BTN', 'pawsh' ),
							'id' => 'pawsh_blog_btn_switch',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Show Blog Btn Icon', 'pawsh' ),
							'id' => 'pawsh_blog_btn_icon_switch',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Blog Button text', 'pawsh' ),
							'id' => 'pawsh_blog_btn',
							'default' => esc_html__('Read More','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),							
						array(
							'name' => esc_html__( 'Blog Button Icon', 'pawsh' ),
							'id' => 'pawsh_blog_btn_icon',
							'default' => esc_html__('fas fa-angle-double-right','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Blog Title', 'pawsh' ),
							'id' => 'breadcrumb_blog_title',
							'default' => esc_html__('Blog','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Blog Details Title', 'pawsh' ),
							'id' => 'breadcrumb_blog_title_details',
							'default' => esc_html__('Blog Details','pawsh'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),

					)
				),
				'pawsh_footer_setting' => array(
					'name'=> esc_html__('Footer Setting','pawsh'),
					'priority'=> 60,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Footer Elementor Templates', 'pawsh' ),
							'id' => 'choose_elementor_footer',
							'type'     => 'select',
							'choices'  => $pawsh_elementor_template_list,
							'transport'	=> 'refresh',
							'required' => ['footer_source_type',
							'=',
							'e'],
						),
						array(
							'name' => esc_html__( 'Choose Footer Style', 'pawsh' ),
							'id' => 'choose_default_footer',
							'type'     => 'select',
							'choices'  => array(
								'footer-style-1' => esc_html__( 'Footer Style 1', 'pawsh' ),
								'footer-style-2' => esc_html__( 'Footer Style 2', 'pawsh' ),
								'footer-style-3' => esc_html__( 'Footer Style 3', 'pawsh' ),
							),
							'default' => 'footer-style-1',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Footer Background Image', 'pawsh' ),
							'id' => 'pawsh_footer_bg',
							'default' => '',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name'=>esc_html__('Footer BG Color','pawsh'),
							'id'=>'pawsh_footer_bg_color',
							'default'=> esc_html__('#f4f9fc','pawsh'),
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('Copy Right','pawsh'),
							'id'=>'pawsh_copyright',
							'default'=> esc_html__('Copyright &copy; Pawsh 2023. All rights reserved','pawsh'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),	
						array(
							'name'=>esc_html__('Enable Scrollup','pawsh'),
							'id'=>'pawsh_scrollup_switch',
							'default'=> false,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						),						
						array(
							'name'=>esc_html__('Enable Footer Widgets','pawsh'),
							'id'=>'pawsh_enable_footer_widgets',
							'default'=> true,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						),	
						array(
							'name'=>esc_html__('Enable Preloader','pawsh'),
							'id'=>'pawsh_preloader_switch',
							'default'=> false,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						)
					)
				),
				'error_page_setting'=> array(
					'name'=> esc_html__('404 Setting','pawsh'),
					'priority'=> 90,
					'fields'=> array(
						array(
							'name'=>esc_html__('400 Text','pawsh'),
							'id'=>'pawsh_error_404_text',
							'default'=> esc_html__('404','pawsh'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('Not Found Title','pawsh'),
							'id'=>'pawsh_error_title',
							'default'=> esc_html__('Page not found','pawsh'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('404 Description Text','pawsh'),
							'id'=>'pawsh_error_desc',
							'default'=> esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted','pawsh'),
							'type'=>'textarea',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('404 Link Text','pawsh'),
							'id'=>'pawsh_error_link_text',
							'default'=> esc_html__('Back To Home','pawsh'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						)
						
					)
				),
			),
		)
	);

}

add_filter('pawsh_customizer_data', 'pawsh_customizer');


