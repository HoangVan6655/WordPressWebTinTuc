<?php
/**
 *	Featured Areas
 */
function pixanews_featured_areas_customize_register( $wp_customize ) {
	
	
	//Featured Areas
	$wp_customize->add_panel(
		'pixanews-featured-areas', array(
			'title'		=>	__('Featured Areas', 'pixanews'),
			'priority'	=>	30
		)
	);
	
	//Ticker
	$wp_customize->add_section(
		'pixanews-ticker', array(
			'title'		=>	__('Featured Ticker', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-featured-areas'
		)
		);
		
	$wp_customize->add_setting(
		'pixanews-enable-ticker', array(
			'default'		=>	0,
			'sanitize_callback'	=>	'absint' 
		)
	);
		
	$wp_customize->add_control(
		'pixanews-enable-ticker', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-ticker',
			  'label' => __( 'Enable ticker (Homepage Only)','pixanews' ),
			  'description' => __( 'Animated Ticker generally used to show viral or trending content.','pixanews' ),
			)	
	);
	
	$wp_customize->add_setting(
		'pixanews-enable-ticker-sitewide', array(
			'default'		=>	0,
			'sanitize_callback'	=>	'absint' 
		)
	);
		
	$wp_customize->add_control(
		'pixanews-enable-ticker-sitewide', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-ticker',
			  'label' => __( 'Enable Ticker (Sitewide)','pixanews' ),
			)	
	);
	
	$wp_customize->add_setting(
		'pixanews-ticker-label', array(
			'default'		=>	__('Latest Posts', 'pixanews'),
			'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
		
	$wp_customize->add_control(
		'pixanews-ticker-label', array(
			  'type' => 'text',
			  'section'		=>	'pixanews-ticker',
			  'label' => __( 'Ticker Label','pixanews' ),
			)	
	);
		
	$wp_customize->add_setting(
		'pixanews-ticker-cat', array(
			'default'		=>	0,
			'sanitize_callback'	=>	'absint'
		)
	);
	
		
	$wp_customize->add_control(
		new pixanews_WP_Customize_Category_Control(
			$wp_customize, 'pixanews-ticker-cat', array(
				'label'		=>	__('Category', 'pixanews'),
				'description'	=>	__('Category whose posts need to be featured..', 'pixanews'),
				'priority'		=>	10,
				'section'		=>	'pixanews-ticker'
				
			)
		)
	);
		
	$wp_customize->add_setting(
		'pixanews-ticker-count', array(
			'default'		=>	6,
			'sanitize_callback'	=>	'absint'
		)
	);
		
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'pixanews-ticker-count',
			array(
				'label'    => __( 'No. of Posts', 'pixanews' ),
				'description'    => __( 'Recommended to set this value to 6 or more.', 'pixanews' ),
				'section'  => 'pixanews-ticker',
				'settings' => 'pixanews-ticker-count',
				'type'     => 'number'
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-ticker-disable-phone', array(
			'default'		=>	1,
			'sanitize_callback'	=>	'absint' 
		)
	);
	$wp_customize->add_control(
		'pixanews-ticker-disable-phone', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-ticker',
			  'label' => __( 'Disable ticker on Mobile Devices','pixanews' ),
			  'description' => __( 'The Slider Ticker may not produce the desired effect on Mobile as it does on Desktop Devices. Use this to disable Ticker on Phone. (Recommended)','pixanews' ),
			)	
	);
	
	
		
	//Carousel
	$wp_customize->add_section(
		'pixanews-carousel', array(
			'title'		=>	__('Featured Carousel', 'pixanews'),
			'priority'	=>	10,
			'panel'		=>	'pixanews-featured-areas'
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-enable-carousel', array(
			'default'		=>	0,
			'sanitize_callback'	=>	'absint' 
		)
	);
	
	$wp_customize->add_control(
		'pixanews-enable-carousel', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-carousel',
			  'label' => __( 'Enable Carousel','pixanews' ),
			  'description' => __( 'A Sliding Carousel appears at the top of the Homepage, below the Menu Bar.','pixanews' ),
			)	
	);
	
	$wp_customize->add_setting(
		'pixanews-carousel-cat', array(
			'default'		=>	0,
			'sanitize_callback'	=>	'absint'
		)
	);
	
	$wp_customize->add_control(
		new pixanews_WP_Customize_Category_Control(
			$wp_customize, 'pixanews-carousel-cat', array(
				'label'		=>	__('Category', 'pixanews'),
				'description'	=>	__('Category whose posts need to be featured..', 'pixanews'),
				'priority'		=>	10,
				'section'		=>	'pixanews-carousel'
				
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-carousel-count', array(
			'default'		=>	6,
			'sanitize_callback'	=>	'absint'
		)
	);
	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'pixanews-carousel-count',
			array(
				'label'    => __( 'No. of Posts', 'pixanews' ),
				'description'    => __( 'Recommended to set this value to 6 or more.', 'pixanews' ),
				'section'  => 'pixanews-carousel',
				'settings' => 'pixanews-carousel-count',
				'type'     => 'number'
			)
		)
	);
	
	//Featured Areas Section Generator
	$i = 0;
	for ($i = 1; $i < 8; $i++) :
		$wp_customize->add_section(
			'pixanews-fa-'.$i, array(
				'title'		=>	__('Featured Posts Area - ', 'pixanews').$i,
				'priority'	=>	10,
				'panel'		=>	'pixanews-featured-areas'
			)
		);
		
		//Enable
		$wp_customize->add_setting(
			'pixanews-fa-enable-'.$i, array(
				'default'		=>	0,
				'sanitize_callback'	=>	'absint' 
			)
		);
		
		$wp_customize->add_control(
			'pixanews-fa-enable-'.$i, array(
				  'type' => 'checkbox',
				  'section'		=>	'pixanews-fa-'.$i,
				  'label' => __( 'Enable','pixanews' ),
				  'description' => __( 'Enable this Featured Area.','pixanews' ),
				)	
		);
		
		//Category Select Box
		$wp_customize->add_setting(
			'pixanews-fa-cat-'.$i, array(
				'default'		=>	0,
				'sanitize_callback'	=>	'absint' 
			)
		);
		
		$wp_customize->add_control(
			new pixanews_WP_Customize_Category_Control(
				$wp_customize, 'pixanews-fa-cat-'.$i, array(
					'label'		=>	__('Category', 'pixanews'),
					'description'	=>	__('Category whose posts need to be featured', 'pixanews'),
					'priority'		=>	10,
					'section'		=>	'pixanews-fa-'.$i,
				)
			)
		);
		
		//Show Title Checkbox
		$wp_customize->add_setting(
			'pixanews-fa-show-title-'.$i, array(
				'default'		=>	0,
				'sanitize_callback'	=>	'absint' 
			)
		);
		
		$wp_customize->add_control(
			'pixanews-fa-show-title-'.$i, array(
				  'type' => 'checkbox',
				  'section'		=>	'pixanews-fa-'.$i,
				  'label' => __( 'Show Title','pixanews' ),
				  'description' => __( 'By Default, the category name will appear as the title above the featured section.','pixanews' ),
				)	
		);
		
		//Show Title Checkbox
		$wp_customize->add_setting(
			'pixanews-fa-random-order-'.$i, array(
				'default'		=>	0,
				'sanitize_callback'	=>	'absint' 
			)
		);
		
		$wp_customize->add_control(
			'pixanews-fa-random-order-'.$i, array(
				  'type' => 'checkbox',
				  'section'		=>	'pixanews-fa-'.$i,
				  'label' => __( 'Random Post Order','pixanews' ),
				  'description' => __( 'By Default, the post are in descending order (newest first). Checking this will make it random.','pixanews' ),
				)	
		);
		
		$wp_customize->add_setting(
			'pixanews-fa-style-'.$i, array(
				'default' => 'style1',
				'sanitize_callback'	=>	'pixanews_sanitize_fa_style'
			)
		);
		
		$wp_customize->add_control(
			new pixanews_Image_Radio_Control($wp_customize, 
				'pixanews-fa-style-'.$i, array(
					'type' => 'radio',
					'label' => esc_html__('Select Featured Area Style', 'pixanews'),
					'section' => 'pixanews-fa-'.$i,
					'settings' => 'pixanews-fa-style-'.$i,
					'choices' => array(
						'style1' => get_template_directory_uri() . '/inc/customizer/images/fa-style1.png',
						'style2' => get_template_directory_uri() . '/inc/customizer/images/fa-style2.png',
						'style3' => get_template_directory_uri() . '/inc/customizer/images/fa-style3.png',
					)
				)
			)
		);
		
		
	endfor;	
	
}
add_action('customize_register', 'pixanews_featured_areas_customize_register');