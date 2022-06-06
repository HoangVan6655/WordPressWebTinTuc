<?php 
function pixanews_colors_customize_register($wp_customize) {
	
	$wp_customize->get_control('header_textcolor')->label = __('Site Title Color','pixanews');
	$wp_customize->get_section('colors')->title = __('Website Color Scheme','pixanews');
	
	$wp_customize->add_setting(
		'pixanews-background-darker-color', array(
			'default'	=>	'#EEEEEE',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-background-darker-color', array(
				'label'		=>	__('Background (Darker Shade)', 'pixanews'),
				'description' =>	__('A Slightly darker shade of the main background color. Helpful in adding accents to the design.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-background-darker-color',
				'priority'	=>	30
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-primary-color', array(
			'default'	=>	'#f9095d',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-primary-color', array(
				'label'		=>	__('Primary Color', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-primary-color',
				'priority'	=>	30
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-primary-text-color', array(
			'default'	=>	'#f9ffe7',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-primary-text-color', array(
				'label'		=>	__('Primary Text Color', 'pixanews'),
				'description' => __('This is the color of the text, where the background color is Primary color. Like Menu Bar, Buttons, etc.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-primary-text-color',
				'priority'	=>	30
			)	
		)
	);
	
	//Secondary
	$wp_customize->add_setting(
		'pixanews-secondary-color', array(
			'default'	=>	'#4a58d9',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-secondary-color', array(
				'label'		=>	__('Secondary Color', 'pixanews'),
				'description' => __('Secondary Color. Used for Links within content, sidebar, etc.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-secondary-color',
				'priority'	=>	30
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-secondary-text-color', array(
			'default'	=>	'#f9ffe7',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-secondary-text-color', array(
				'label'		=>	__('Secondary Text Color', 'pixanews'),
				'description' => __('This is the color of the text, where the background color is Secondary color. Like Module Headings, Some Buttons, etc.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-secondary-text-color',
				'priority'	=>	30
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-secondary-dark-color', array(
			'default'	=>	'#5241c1',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-secondary-dark-color', array(
				'label'		=>	__('Secondary Color (Darker Shade)', 'pixanews'),
				'description' => __('Darker shade of Secondary color. Used on Link Hover, etc.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-secondary-dark-color',
				'priority'	=>	30
			)	
		)
	);
	
	//Text Colors.
	$wp_customize->add_setting(
		'pixanews-text-color', array(
			'default'	=>	'#555555',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-text-color', array(
				'label'		=>	__('Text Color', 'pixanews'),
				'description' =>	__('Text Color. Main color of the content.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-text-color',
				'priority'	=>	30
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-text-dark-color', array(
			'default'	=>	'#111111',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-text-dark-color', array(
				'label'		=>	__('Text Color (Darker shade)', 'pixanews'),
				'description' =>	__('Darker Shade of the text color. Used for headings and important text.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-text-dark-color',
				'priority'	=>	30
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-text-light-color', array(
			'default'	=>	'#777777',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-text-light-color', array(
				'label'		=>	__('Text Color (Lighter Shade)', 'pixanews'),
				'description' =>	__('Lighter Shade of Text Color. Used for Top Menu, Meta Data and other text.', 'pixanews'),
				'section'	=>	'colors',
				'settings'	=>	'pixanews-text-light-color',
				'priority'	=>	30
			)	
		)
	);
		
}
add_action('customize_register','pixanews_colors_customize_register');