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
function pixanews_help_support_customize_register( $wp_customize ) {
	
	$wp_customize->add_section(
		'pixanews-help-support', array(
			'title'		=>	__('Theme Support & Docs', 'pixanews'),
			'priority'	=>	10,
		)
	);
	
	$wp_customize->add_setting('pixahive-welcome-message', array(
		'sanitize_callback'	=>	'sanitize_text_field' 
		)
	);
	
	$wp_customize->add_control(
		new pixanews_Custom_Notice_Control(
			$wp_customize, 'pixahive-welcome-message', array(
				'label'		=>	__('Thank you for choosing PixaNews theme by PixaHive.', 'pixanews'),
				'description'	=>	__('PixaNews theme is a brilliant theme in the making. We need your help make it even more better. If you have any feature suggestions, you are more than welcome. <br /> We are providing 100% free support with this theme without the need of upgrading to any pro version. <a href="https://pixahive.com/themes/pixanews/" target="_blank">Read Documentation / Contact Us</a> for support, requests, suggestions or just to say how awesome this theme is. To know what your site should look like, <a href="https://theme-demos.pixahive.com/pixanews/" target="_blank">view Theme Demo</a>.', 'pixanews'),
				'priority'		=>	10,
				'section'		=>	'pixanews-help-support',
				'input_attrs' => array('class'=>'help-msg'),
			)
		)
	);
	
}
add_action('customize_register', 'pixanews_help_support_customize_register');