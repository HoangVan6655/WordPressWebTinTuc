<?php
/*
* Header Customization Panel
* Site Identity (Desktop Logo Width, Logo Mobile)
* Section - Header Image
* Section - Header Settings - Top Bar (enable, disable). Date (Enable/disable), Search form (enable/disable)
* Section - Header Mobile
*/
function pixanews_header_customize_register($wp_customize) {

	$wp_customize->add_panel(
		'pixanews-header-settings', array(
			'title'		=>	__('Header Settings', 'pixanews'),
			'priority'	=>	20
		)
	);
	
	$wp_customize->get_section('title_tagline')->panel = 'pixanews-header-settings';
	$wp_customize->get_section('title_tagline')->priority = 5;
	$wp_customize->get_section('header_image')->panel = 'pixanews-header-settings';
	$wp_customize->get_section('header_image')->priority = 5;
	
	//Logo
	$wp_customize->add_setting( 'pixanews-logo-max-height', array(
		'default' => 90,
		'sanitize_callback' => 'absint'
	));
	
	$wp_customize->add_control( new WP_Customize_Control(
		$wp_customize,
		'pixanews-logo-max-height',
			array(
				'label'    => __( 'Logo height (in pixels)', 'pixanews' ),
				'description'    => __( 'Adjust Height of Logo in desktop view if its too large. This only affects the maximum height. If your logo is small, it will not make it bigger.', 'pixanews' ),
				'section'  => 'title_tagline',
				'settings' => 'pixanews-logo-max-height',
				'priority' => 5,
				'type'     => 'range',
				'input_attrs' => array(
					'min' => 30,
					'max' => 100,
					'step' => 1,
				  )
			)
		)
	);
	
	$wp_customize->add_setting( 'pixanews-mobile-logo', array(
		'sanitize_callback' => 'esc_url_raw'
	));
 
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'pixanews-mobile-logo-control', array(
		'label' => __('Mobile Logo (optional)','pixanews'),
		'description' => __('If you want a different logo to be used for mobile devices, you can use this setting. By Default, Main Logo will be shown for Desktop and Mobile both.','pixanews'),
		'priority' => 100,
		'section' => 'title_tagline',
		'settings' => 'pixanews-mobile-logo',
		'button_labels' => array(// All These labels are optional
					'select' => __('Select Logo','pixanews'),
					'remove' => __('Remove Logo','pixanews'),
					'change' => __('Change Logo','pixanews'),
					)
	)));
	
	//Header Image
	$wp_customize->add_setting('pixahive-header-image-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-header-image-message', array(
				'label'		=>	__('Note:', 'pixanews'),
				'description'	=>	__('Header Image only appears when you choose Style 1 in <strong>Header Styles (Desktop)</strong>. Header image doesn\'t appear when Style 2 is selected.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'header_image',
			)
		)
	);
	
	//Styles & Layouts
	$wp_customize->add_section(
		'pixanews-header-styles-layouts', array(
			'title'		=>	__('Header Style (Desktop)', 'pixanews'),
			'priority'	=>	30,
			'panel'		=>	'pixanews-header-settings'
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-header-style', array(
			'default' => 'style2',
			'sanitize_callback'	=>	'pixanews_sanitize_fa_style'
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Image_Radio_Control($wp_customize, 
			'pixanews-header-style', array(
				'type' => 'radio',
				'label' => esc_html__('Select Header Style', 'pixanews'),
				'section' => 'pixanews-header-styles-layouts',
				'settings' => 'pixanews-header-style',
				'choices' => array(
					'style1' => get_template_directory_uri() . '/inc/customizer/images/header-style1.png',
					'style2' => get_template_directory_uri() . '/inc/customizer/images/header-style2.png',
				)
			)
		)
	);
	
	//Colors (FOR STYLE 2 Only)
	$wp_customize->add_setting(
		'pixanews-header-bg-color', array(
			'default'	=>	'#000000',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-header-bg-color', array(
				'label'		=>	esc_html__('Header Background Color', 'pixanews'),
				'section'	=>	'pixanews-header-styles-layouts',
				'settings'	=>	'pixanews-header-bg-color',
				'priority'	=>	30,
				'active_callback' => function($control) {
					return ('style2' == $control->manager->get_setting('pixanews-header-style')->value());
				}
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-header-bg-lighter-color', array(
			'default'	=>	'#222222',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-header-bg-lighter-color', array(
				'label'		=>	esc_html__('Header Background (Lighter Shade)', 'pixanews'),
				'description'	=>	esc_html__('Background color of social icons & search bar.', 'pixanews'),
				'section'	=>	'pixanews-header-styles-layouts',
				'settings'	=>	'pixanews-header-bg-lighter-color',
				'priority'	=>	30,
				'active_callback' => function($control) {
					return ('style2' == $control->manager->get_setting('pixanews-header-style')->value());
				}
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-top-bar-text-color', array(
			'default'	=>	'#777777',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-top-bar-text-color', array(
				'label'		=>	esc_html__('Top Bar Text Color', 'pixanews'),
				'section'	=>	'pixanews-header-styles-layouts',
				'settings'	=>	'pixanews-top-bar-text-color',
				'priority'	=>	30,
				'active_callback' => function($control) {
					return (
						(true == $control->manager->get_setting('pixanews-enable-top-bar')->value())
						&&
						('style2' == $control->manager->get_setting('pixanews-header-style')->value())
					);
				}
			)	
		)
	);
	
	//social icon/text color
	$wp_customize->add_setting(
		'pixanews-header-content-color', array(
			'default'	=>	'#FFFFFF',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-header-content-color', array(
				'label'		=>	esc_html__('Social Icon Color', 'pixanews'),
				'description'	=>	esc_html__('Used by social icons, search bar.', 'pixanews'),
				'section'	=>	'pixanews-header-styles-layouts',
				'settings'	=>	'pixanews-header-content-color',
				'priority'	=>	30,
				'active_callback' => function($control) {
					return ('style2' == $control->manager->get_setting('pixanews-header-style')->value());
				}
			)	
		)
	);
	
	//Enable Top Bar
	$wp_customize->add_setting(
		'pixanews-enable-top-bar', array(
			'default'		=>	0,
			'sanitize_callback'	=>	'absint' 
		)
	);
		
	$wp_customize->add_control(
		'pixanews-enable-top-bar', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-header-styles-layouts',
			  'label' => __( 'Enable Top Bar','pixanews' ),
			  'description' => __( 'This enables an additional top bar above header containing Top Menu on the right, and Date on left.','pixanews' ),
			  'active_callback' => function($control) {
				  return ('style2' == $control->manager->get_setting('pixanews-header-style')->value());
			  }
			)	
	);
	
	$wp_customize->add_setting(
		'pixanews-enable-date', array(
			'default'		=>	1,
			'sanitize_callback'	=>	'absint' 
		)
	);
		
	$wp_customize->add_control(
		'pixanews-enable-date', array(
			  'type' => 'checkbox',
			  'section'		=>	'pixanews-header-styles-layouts',
			  'label' => __( 'Enable Date in Top Bar','pixanews' ),
			  'active_callback' => function($control) {
				  return (
					  (true == $control->manager->get_setting('pixanews-enable-top-bar')->value())
					  &&
					  ('style2' == $control->manager->get_setting('pixanews-header-style')->value())
				  );
			  },
			  
			)	
	);
	
	//Header (Mobile)
	$wp_customize->add_section(
		'pixanews-header-mobile', array(
			'title'		=>	__('Header Style (Mobile)', 'pixanews'),
			'priority'	=>	30,
			'panel'		=>	'pixanews-header-settings'
		)
	);
	
	$wp_customize->add_setting('pixahive-header-mobile-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-header-mobile-message', array(
				'label'		=>	__('Header (Mobile)', 'pixanews'),
				'description'	=>	__('For a Better User experience, PixaNews uses a smaller Mobile Header with just the logo and Menu Icon. The Search Bar, Social Icons, Complete Menu appear when the Hamburger (<span class="dashicons dashicons-menu-alt"></span>) Icon is clicked.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'pixanews-header-mobile',
			)
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-header-mobile-bg-color', array(
			'default'	=>	'#FFFFFF',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-header-mobile-bg-color', array(
				'label'		=>	esc_html__('Header Background Color', 'pixanews'),
				'section'	=>	'pixanews-header-mobile',
				'settings'	=>	'pixanews-header-mobile-bg-color',
				'priority'	=>	30,
			)	
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-header-mobile-text-color', array(
			'default'	=>	'#CCCCCC',
			'sanitize_callback'	=>	'sanitize_hex_color'
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, 'pixanews-header-mobile-text-color', array(
				'label'		=>	esc_html__('Header Content Color (Title/Icons)', 'pixanews'),
				'section'	=>	'pixanews-header-mobile',
				'settings'	=>	'pixanews-header-mobile-text-color',
				'priority'	=>	30,
			)	
		)
	);
	
	
	//Social
	$wp_customize->add_section(
		'pixanews-social-links', array(
			'title'		=>	__('Social Links', 'pixanews'),
			'priority'	=>	30,
			'panel'		=>	'pixanews-header-settings'
		)
	);
	
	$wp_customize->add_setting('pixahive-social-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-social-message', array(
				'label'		=>	__('How to Set up Social Icons in Header?', 'pixanews'),
				'description'	=>	__('PixaNews themes supports social icons via WordPress menus. Its really easy to add and the info is retained when you switch themes. Here is how you do it. <br><br><strong>Step 1. </strong>Go to Appearance > Menus. Create a New Menu. <br><strong>Step 2. </strong>Add Menu Item. Choose Custom Links. Enter your Social Profile URL. Leave the <em>Link Text</em> field blank. Repeat for all social networks you want to display.<br><strong>Step 3. </strong>Choose Menu location as Social Networks, and press Save. <br><br>PixaNews theme is smart enough and will automatically connect your social urls with correct icons. The theme supports all top social networks.', 'pixanews'),
				'priority'		=>	1,
				'section'		=>	'pixanews-social-links',
			)
		)
	);
	
}
add_action('customize_register','pixanews_header_customize_register');