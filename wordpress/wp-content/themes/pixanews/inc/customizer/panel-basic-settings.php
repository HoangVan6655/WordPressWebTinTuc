<?php
/**
 *	Basic Settings
 *  Background Image
 *  Homepage
 *  Archives
 *  Search Results Page
 *  Page Settings
 *  Single Post Settings
 *  404 Error Page
 */ 
function pixanews_basic_settings_customize_register( $wp_customize ) {
	
	$wp_customize->add_panel(
		'pixanews-basic-settings', array(
			'title'		=>	__('Basic Settings', 'pixanews'),
			'priority'	=>	20
		)
	);
	
	//Homepage Settings
	$wp_customize->add_section(
		'pixanews-homepage', array(
			'title'		=>	__('Homepage (Blog)', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-basic-settings'
		)
	);
	
	//Enable Latest Posts Section
	$wp_customize->add_setting(
		'pixanews-enable-latest-posts', array(
			'default'		=>	1,
			'sanitize_callback'	=>	'absint' 
		)
	);
	
	$wp_customize->add_control(
		'pixanews-enable-latest-posts', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-homepage',
			  'label' => __( 'Enable Latest Posts Section','pixanews' ),
			  'description' => __( 'If you want to design your Homepage (Blog Page) using only the Featured Areas, then you can disable the latest posts area on homepage. (Optional).','pixanews' ),
			)	
	);
	
	$wp_customize->add_setting(
		'pixanews-latest-post-title', array(
			'default'		=>	__('Latest Posts','pixanews'),
			'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		'pixanews-latest-post-title', array(
			  'type' => 'text',
			  'section'		=>	'pixanews-homepage',
			  'label' => __( 'Latest Posts Heading','pixanews' ),
			  'description' => __( 'The Heading of the Section which displays the latest posts on the homepage. Below all featured areas.','pixanews' ),
			  'active_callback' => function($control) {
				  return (true == $control->manager->get_setting('pixanews-enable-latest-posts')->value());
			  },
			)	
	);
	
	$wp_customize->add_setting(
		'pixanews-home-layout', array(
			'default' => 'style2',
			'sanitize_callback'	=>	'pixanews_sanitize_fa_style'
		)
	);
		
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-home-layout', array(
				'type' => 'radio',
				'label' => esc_html__('Latest Posts Style', 'pixanews'),
				'section' => 'pixanews-homepage',
				'settings' => 'pixanews-home-layout',
				'input_attrs' => array('class' => 'blog_layout_chooser'),
				'choices' => array(
					'style1' => get_template_directory_uri() . '/inc/customizer/images/content-style1.png',
					'style2' => get_template_directory_uri() . '/inc/customizer/images/content-style2.png',
					'style3' => get_template_directory_uri() . '/inc/customizer/images/content-style3.png',
				),
				'active_callback' => function($control) {
					  return (true == $control->manager->get_setting('pixanews-enable-latest-posts')->value());
				 },
			)
		)
	);
	
		
		
	$wp_customize->add_setting(
			'pixanews-primary-width-home', array(
				'default'	=>	'right-sidebar',
				'sanitize_callback'	=>	'pixanews_sanitize_sidebar_layout'
			)
		);
		
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-primary-width-home', array(
				'type' => 'radio',
				'label' => esc_html__('Sidebar Layout', 'pixanews'),
				'section' => 'pixanews-homepage',
				'settings' => 'pixanews-primary-width-home',
				'input_attrs' => array('class' => 'sidebar_layout_chooser'),
				'choices' => array(
					'no-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no.jpg',
					'right-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right.jpg',
					'right-sidebar-narrow' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right-narrow.jpg',
					'no-sidebar-narrow-primary' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no-narrow-primary.jpg',
				),
				'active_callback' => function($control) {
					  return (true == $control->manager->get_setting('pixanews-enable-latest-posts')->value());
				},
			)
		)
	);
	
	//Background Image
	$wp_customize->get_section('background_image')->panel = 'pixanews-basic-settings';
	$wp_customize->get_section('background_image')->priority = 5;
	
	//Archives
	$wp_customize->add_section(
		'pixanews-archives', array(
			'title'		=>	__('Archives (Category/Tags)', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-basic-settings'
		)
	);
	
	$wp_customize->add_setting('pixahive-archive-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-archive-message', array(
				'label'		=>	__('Archive Settings', 'pixanews'),
				'description'	=>	__('Use this section to customize the layout of Category and Tag Archive pages. This will also support any other custom taxonomies. Navigate to an archive page to view changes on the right side.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'pixanews-archives',
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-archives-layout', array(
			'default' => 'style2',
			'sanitize_callback'	=>	'pixanews_sanitize_fa_style'
		)
		);
		
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-archives-layout', array(
				'type' => 'radio',
				'label' => esc_html__('Select Content Style', 'pixanews'),
				'section' => 'pixanews-archives',
				'settings' => 'pixanews-archives-layout',
				'input_attrs' => array('class' => 'blog_layout_chooser'),
				'choices' => array(
					'style1' => get_template_directory_uri() . '/inc/customizer/images/content-style1.png',
					'style2' => get_template_directory_uri() . '/inc/customizer/images/content-style2.png',
					'style3' => get_template_directory_uri() . '/inc/customizer/images/content-style3.png',
				)
			)
		)
	);
		
		
	$wp_customize->add_setting(
			'pixanews-primary-width-archives', array(
				'default'	=>	'right-sidebar',
				'sanitize_callback'	=>	'pixanews_sanitize_sidebar_layout'
			)
		);
		
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-primary-width-archives', array(
				'type' => 'radio',
				'label' => esc_html__('Sidebar Layout', 'pixanews'),
				'section' => 'pixanews-archives',
				'settings' => 'pixanews-primary-width-archives',
				'input_attrs' => array('class' => 'sidebar_layout_chooser'),
				'choices' => array(
					'no-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no.jpg',
					'right-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right.jpg',
					'right-sidebar-narrow' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right-narrow.jpg',
					'no-sidebar-narrow-primary' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no-narrow-primary.jpg',
				)
			)
		)
	);
		
	//Page Settings.
	$wp_customize->add_section(
		'pixanews-page-settings', array(
			'title'		=>	__('Pages', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-basic-settings'
		)
	);
	
	$wp_customize->add_setting('pixahive-page-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-page-message', array(
				'label'		=>	__('Page Settings', 'pixanews'),
				'description'	=>	__('Use this section to customize the layout of pages of your site.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'pixanews-page-settings',
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-primary-width-page', array(
				'default'	=>	'right-sidebar',
				'sanitize_callback'	=>	'pixanews_sanitize_sidebar_layout'
			)
		);
		
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-primary-width-page', array(
				'type' => 'radio',
				'label' => esc_html__('Sidebar Layout', 'pixanews'),
				'section' => 'pixanews-page-settings',
				'settings' => 'pixanews-primary-width-page',
				'input_attrs' => array('class' => 'sidebar_layout_chooser'),
				'choices' => array(
					'no-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no.jpg',
					'right-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right.jpg',
					'right-sidebar-narrow' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right-narrow.jpg',
					'no-sidebar-narrow-primary' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no-narrow-primary.jpg',
				)
			)
		)
	);
	
	//Single Post Settings.
	$wp_customize->add_section(
		'pixanews-single-post', array(
			'title'		=>	__('Single Posts', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-basic-settings'
		)
	);
	
	$wp_customize->add_setting('pixahive-single-post-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-single-post-message', array(
				'label'		=>	__('Single Post Settings', 'pixanews'),
				'description'	=>	__('Use this section to customize the layout of Single Posts. Navigate to one of the published posts to view changes on the right side.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'pixanews-single-post',
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-single-post-style', array(
				'default'	=>	'style2',
				'sanitize_callback'	=>	'pixanews_sanitize_fa_style'
			)
		);
		
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-single-post-style', array(
				'type' => 'radio',
				'label' => esc_html__('Post Style', 'pixanews'),
				'section' => 'pixanews-single-post',
				'settings' => 'pixanews-single-post-style',
				'input_attrs' => array('class' => 'sidebar_layout_chooser'),
				'choices' => array(
					'style1' => get_template_directory_uri() . '/inc/customizer/images/single-style1.png',
					'style2' => get_template_directory_uri() . '/inc/customizer/images/single-style2.png',
				)
			)
		)
	);	
	
	$wp_customize->add_setting(
		'pixanews-enable-author-bio', array(
			'default'		=>	0,
			'sanitize_callback'	=>	'absint' 
		)
	);
		
	$wp_customize->add_control(
		'pixanews-enable-author-bio', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-single-post',
			  'label' => __( 'Enable Author Bio','pixanews' ),
			  'description' => __( 'Show Author Bio below the post.','pixanews' ),
			)	
	);
	
	$wp_customize->add_setting(
		'pixanews-primary-width-single-post', array(
				'default'	=>	'right-sidebar',
				'sanitize_callback'	=>	'pixanews_sanitize_sidebar_layout'
			)
		);
		
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-primary-width-single-post', array(
				'type' => 'radio',
				'label' => esc_html__('Sidebar Layout', 'pixanews'),
				'section' => 'pixanews-single-post',
				'settings' => 'pixanews-primary-width-single-post',
				'input_attrs' => array('class' => 'sidebar_layout_chooser'),
				'choices' => array(
					'no-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no.jpg',
					'right-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right.jpg',
					'right-sidebar-narrow' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right-narrow.jpg',
					'no-sidebar-narrow-primary' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no-narrow-primary.jpg',
				)
			)
		)
	);	
	
	//Search Results Page
	$wp_customize->add_section(
		'pixanews-search-results', array(
			'title'		=>	__('Search Results Page', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-basic-settings'
		)
	);
	
	$wp_customize->add_setting('pixahive-search-results-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-search-results-message', array(
				'label'		=>	__('Search Results Settings', 'pixanews'),
				'description'	=>	__('Use this section to customize the layout of results on Search Pages. Perform a search on the right hand side so you can view changes.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'pixanews-search-results',
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-search-results-layout', array(
			'default' => 'style2',
			'sanitize_callback'	=>	'pixanews_sanitize_fa_style'
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-search-results-layout', array(
				'type' => 'radio',
				'label' => esc_html__('Select Content Style', 'pixanews'),
				'section' => 'pixanews-search-results',
				'settings' => 'pixanews-search-results-layout',
				'input_attrs' => array('class' => 'blog_layout_chooser'),
				'choices' => array(
					'style1' => get_template_directory_uri() . '/inc/customizer/images/content-style1.png',
					'style2' => get_template_directory_uri() . '/inc/customizer/images/content-style2.png',
					'style3' => get_template_directory_uri() . '/inc/customizer/images/content-style3.png',
				)
			)
		)
	);
	
	
	$wp_customize->add_setting(
		'pixanews-primary-width-search', array(
			'default'	=>	'right-sidebar',
			'sanitize_callback'	=>	'pixanews_sanitize_sidebar_layout'
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-primary-width-search', array(
				'type' => 'radio',
				'label' => esc_html__('Sidebar Layout', 'pixanews'),
				'section' => 'pixanews-search-results',
				'settings' => 'pixanews-primary-width-search',
				'input_attrs' => array('class' => 'sidebar_layout_chooser'),
				'choices' => array(
					'no-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no.jpg',
					'right-sidebar' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right.jpg',
					'right-sidebar-narrow' => get_template_directory_uri() . '/inc/customizer/images/sidebar-right-narrow.jpg',
					'no-sidebar-narrow-primary' => get_template_directory_uri() . '/inc/customizer/images/sidebar-no-narrow-primary.jpg',
				)
			)
		)
	);
	
	
	//404 Error Page Settings.
	$wp_customize->add_section(
		'pixanews-404-error', array(
			'title'		=>	__('404 Error Page', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-basic-settings'
		)
	);
	
	$wp_customize->add_setting('pixahive-404page-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-404page-message', array(
				'label'		=>	__('404 Page', 'pixanews'),
				'description'	=>	__('Use this page to customize the 404 Error Page.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'pixanews-404-error',
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-enable-404-posts', array(
			'default'		=>	1,
			'sanitize_callback'	=>	'absint' 
		)
	);
		
	$wp_customize->add_control(
		'pixanews-enable-404-posts', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-404-error',
			  'label' => __( 'Show Latest Posts on 404 Page','pixanews' ),
			)	
	);
	
	
	
}
add_action('customize_register', 'pixanews_basic_settings_customize_register');