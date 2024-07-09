<?php
/** 
 * Petsone Customizer data
 */

function petsone_customizer( $data ) {
	$petsone_elementor_template_list = petsone_get_elementor_templates();
	$petsone_elementor_header_templates = petsone_get_elementor_header_templates();
	return array(
		'panel' => array ( 
			'id' => 'petsone',
			'name' => esc_html__('Petsone Customizer','petsone'),
			'priority' => 10,
			'section' => array(
				'header_setting' => array(
					'name' => esc_html__( 'Header Topbar Setting', 'petsone' ),
					'priority' => 10,
					'fields' => array(
						array(
							'name' => esc_html__( 'Topbar Swicher', 'petsone' ),
							'id' => 'petsone_topbar_switch',
							'default' => false,
							'type' => 'switch',
							'transport'	=> 'refresh'
						),						
						array(
							'name' => esc_html__( 'Show Button', 'petsone' ),
							'id' => 'petsone_show_header_btn',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Button Text', 'petsone' ),
							'id' => 'petsone_header_btn_text',
							'default' => esc_html__('Sign in','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Button Link', 'petsone' ),
							'id' => 'petsone_header_btn_link',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Button Icon', 'petsone' ),
							'id' => 'petsone_header_btn_icon',
							'default' => esc_html__('fa fa-user-o', 'petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						/** investment button **/	
						array(
							'name' => esc_html__( 'Show Investment Offer Link', 'petsone' ),
							'id' => 'petsone_show_investment_offer_link',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Link Text', 'petsone' ),
							'id' => 'petsone_header_link_text',
							'default' => esc_html__('Petsone Offer','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Link Url', 'petsone' ),
							'id' => 'petsone_header_link_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						/** contact-info **/
						array(
							'name' => esc_html__( 'Show Contact Info', 'petsone' ),
							'id' => 'petsone_show_contact_info',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Email Address', 'petsone' ),
							'id' => 'petsone_header_email',
							'default' => esc_html__('info@gmail.com','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Phone Number', 'petsone' ),
							'id' => 'petsone_header_phone',
							'default' => esc_html__('+97657945737', 'petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						)

					) 
				),
				'petsone_topbar_social_profiles_setting' => array(
					'name' => esc_html__( 'Header Social Profiles', 'petsone' ),
					'priority' => 15,
					'fields' => array(
						array(
							'name' => esc_html__( 'Show Social Profiles', 'petsone' ),
							'id' => 'petsone_show_social_profiles',
							'default' => 0,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Facebook Url', 'petsone' ),
							'id' => 'petsone_topbar_fb_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Twitter Url', 'petsone' ),
							'id' => 'petsone_topbar_twitter_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Linkedin Url', 'petsone' ),
							'id' => 'petsone_topbar_linkedin_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Instagram Url', 'petsone' ),
							'id' => 'petsone_topbar_instagram_url',
							'default' => '#',
							'type' => 'text',
							'transport'	=> 'refresh' 
						),
					) 
				),
				'header_main_setting' => array(
					'name' => esc_html__( 'Header Setting', 'petsone' ),
					'priority' => 20,
					'fields' => array(
						array(
							'name' => esc_html__( 'Choose Header Style', 'petsone' ),
							'id' => 'choose_default_header',
							'type'     => 'select',
							'choices'  => array(
								'header-style-1' => esc_html__( 'Header Style 1', 'petsone' ),
								'header-style-2' => esc_html__( 'Header Style 2', 'petsone' ),
							),
							'default' => 'header-style-2',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Header Type', 'petsone' ),
							'id' => 'choose_default_header',
							'type'     => 'select',
							'choices'  => array(
								'default-header' => esc_html__( 'Default Header', 'petsone' ),
								'elementor-header' => esc_html__( 'Elementor Header', 'petsone' ),
							),
							'default' => 'default-header',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Header Elementor Templates', 'petsone' ),
							'id' => 'choose_elementor_header',
							'type'     => 'select',
							'choices'  => $petsone_elementor_header_templates,
							'transport'	=> 'refresh',
							'required' => ['header_source_type',
							'=',
							'e'],
						),
						array(
							'name' => esc_html__( 'Header Logo', 'petsone' ),
							'id' => 'logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Black Logo', 'petsone' ),
							'id' => 'seconday_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo-black.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Retina Logo', 'petsone' ),
							'id' => 'retina_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo@2x.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Header Retina Black Logo', 'petsone' ),
							'id' => 'retina_secondary_logo',
							'default' => get_template_directory_uri() . '/assets/img/logo/logo-black@2x.png',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Show Header Search', 'petsone' ),
							'id' => 'petsone_header_search_show',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),	
					) 
				),	
				'banner_main_setting' => array(
					'name' => esc_html__( 'Sub Banner Setting', 'petsone' ),
					'priority' => 20,
					'fields' => array(
						
						array(
							'name' => esc_html__( 'Banner Image', 'petsone' ),
							'id' => 'sub-banner-img',
							'default' => get_template_directory_uri() . '/assets/img/sub-banner-img.jpg',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						
					) 
				),	
				'page_title_setting'=> array(
					'name'=> esc_html__('Page Title Setting','petsone'),
					'priority'=> 30,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Choose Breadcrumb Style', 'petsone' ),
							'id' => 'choose_default_breadcrumb',
							'type'     => 'select',
							'choices'  => array(
								'breadcrumb-style-1' => esc_html__( 'Breadcrumb Style 1', 'petsone' ),
								'breadcrumb-style-2' => esc_html__( 'default', 'petsone' ),
							),
							'default' => 'breadcrumb-style-1',
							'transport'	=> 'refresh'
						),
						array(
							'name'=>esc_html__('Breadcrumb BG Color','petsone'),
							'id'=>'breadcrumb_bg_color',
							'default'=> esc_html__('#343a40','petsone'),
							'transport'	=> 'refresh'  
						),
						array(
							'name' => esc_html__( 'Page Title Background Image', 'petsone' ),
							'id' => 'breadcrumb_bg_img',
							'default' => '',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb Archive', 'petsone' ),
							'id' => 'breadcrumb_archive',
							'default' => esc_html__('Archive for category','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb Search', 'petsone' ),
							'id' => 'breadcrumb_search',
							'default' => esc_html__('Search results for','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Breadcrumb tagged', 'petsone' ),
							'id' => 'breadcrumb_post_tags',
							'default' => esc_html__('Posts tagged','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb posted by', 'petsone' ),
							'id' => 'breadcrumb_artitle_post_by',
							'default' => esc_html__('Articles posted by','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb Page Not Found', 'petsone' ),
							'id' => 'breadcrumb_404',
							'default' => esc_html__('Page Not Found','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),		
						array(
							'name' => esc_html__( 'Breadcrumb Page', 'petsone' ),
							'id' => 'breadcrumb_page',
							'default' => esc_html__('Page','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),			
						array(
							'name' => esc_html__( 'Breadcrumb Shop', 'petsone' ),
							'id' => 'breadcrumb_shop',
							'default' => esc_html__('Shop','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),			
						array(
							'name' => esc_html__( 'Breadcrumb Home', 'petsone' ),
							'id' => 'breadcrumb_home',
							'default' => esc_html__('Home','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),					
					)
				),
				'blog_setting'=> array(
					'name'=> esc_html__('Blog Setting','petsone'),
					'priority'=> 40,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Show Blog BTN', 'petsone' ),
							'id' => 'petsone_blog_btn_switch',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),	
						array(
							'name' => esc_html__( 'Show Blog Btn Icon', 'petsone' ),
							'id' => 'petsone_blog_btn_icon_switch',
							'default' => 1,
							'type' => 'switch',
							'transport'	=> 'refresh' 
						),
						array(
							'name' => esc_html__( 'Blog Button text', 'petsone' ),
							'id' => 'petsone_blog_btn',
							'default' => esc_html__('Read More','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),							
						array(
							'name' => esc_html__( 'Blog Button Icon', 'petsone' ),
							'id' => 'petsone_blog_btn_icon',
							'default' => esc_html__('fas fa-angle-double-right','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Blog Title', 'petsone' ),
							'id' => 'breadcrumb_blog_title',
							'default' => esc_html__('Blog','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),						
						array(
							'name' => esc_html__( 'Blog Details Title', 'petsone' ),
							'id' => 'breadcrumb_blog_title_details',
							'default' => esc_html__('Blog Details','petsone'),
							'type' => 'text',
							'transport'	=> 'refresh' 
						),

					)
				),
				'petsone_footer_setting' => array(
					'name'=> esc_html__('Footer Setting','petsone'),
					'priority'=> 60,
					'fields'=> array(
						array(
							'name' => esc_html__( 'Footer Elementor Templates', 'petsone' ),
							'id' => 'choose_elementor_footer',
							'type'     => 'select',
							'choices'  => $petsone_elementor_template_list,
							'transport'	=> 'refresh',
							'required' => ['footer_source_type',
							'=',
							'e'],
						),
						array(
							'name' => esc_html__( 'Choose Footer Style', 'petsone' ),
							'id' => 'choose_default_footer',
							'type'     => 'select',
							'choices'  => array(
								'footer-style-1' => esc_html__( 'Footer Style 1', 'petsone' ),
								'footer-style-2' => esc_html__( 'Footer Style 2', 'petsone' ),
								'footer-style-3' => esc_html__( 'Footer Style 3', 'petsone' ),
							),
							'default' => 'footer-style-1',
							'transport'	=> 'refresh'
						),
						array(
							'name' => esc_html__( 'Footer Background Image', 'petsone' ),
							'id' => 'petsone_footer_bg',
							'default' => '',
							'type' => 'image',
							'transport'	=> 'refresh' 
						),
						array(
							'name'=>esc_html__('Footer BG Color','petsone'),
							'id'=>'petsone_footer_bg_color',
							'default'=> esc_html__('#f4f9fc','petsone'),
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('Copy Right','petsone'),
							'id'=>'petsone_copyright',
							'default'=> esc_html__('Copyright &copy; Petsone 2023. All rights reserved','petsone'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),	
						array(
							'name'=>esc_html__('Enable Scrollup','petsone'),
							'id'=>'petsone_scrollup_switch',
							'default'=> false,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						),						
						array(
							'name'=>esc_html__('Enable Footer Widgets','petsone'),
							'id'=>'petsone_enable_footer_widgets',
							'default'=> true,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						),	
						array(
							'name'=>esc_html__('Enable Preloader','petsone'),
							'id'=>'petsone_preloader_switch',
							'default'=> false,
							'type'=>'switch',
							'transport'	=> 'refresh'  
						)
					)
				),
				'error_page_setting'=> array(
					'name'=> esc_html__('404 Setting','petsone'),
					'priority'=> 90,
					'fields'=> array(
						array(
							'name'=>esc_html__('400 Text','petsone'),
							'id'=>'petsone_error_404_text',
							'default'=> esc_html__('404','petsone'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('Not Found Title','petsone'),
							'id'=>'petsone_error_title',
							'default'=> esc_html__('Page not found','petsone'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('404 Description Text','petsone'),
							'id'=>'petsone_error_desc',
							'default'=> esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted','petsone'),
							'type'=>'textarea',
							'transport'	=> 'refresh'  
						),
						array(
							'name'=>esc_html__('404 Link Text','petsone'),
							'id'=>'petsone_error_link_text',
							'default'=> esc_html__('Back To Home','petsone'),
							'type'=>'text',
							'transport'	=> 'refresh'  
						)
						
					)
				),
			),
		)
	);

}

add_filter('petsone_customizer_data', 'petsone_customizer');


