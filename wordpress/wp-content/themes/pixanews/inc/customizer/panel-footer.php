<?php
/*
* Custom Copyright Text
* Enable Additional Footer Menu
* 
*/
function pixanews_footer_customize_register($wp_customize) {

	$wp_customize->add_panel(
		'pixanews-footer-panel', array(
			'title'		=>	__('Footer Settings', 'pixanews'),
			'priority'	=>	20
		)
	);
	
	$wp_customize->add_section(
		'pixanews-footer-section', array(
			'title'		=>	__('Copyright Text', 'pixanews'),
			'panel'		=> 'pixanews-footer-panel',
			'priority'	=>	20
		)
	);
	
	$wp_customize->add_setting(
		'pixanews-copyright-text', array(
			'sanitize_callback'	=>	'sanitize_text_field', 
			'default'		=>	__('&copy; ','pixanews').esc_html(get_bloginfo('name')).__(" ", 'pixanews').date('Y'),
			
		)
	);
	
	$wp_customize->add_control(
		'pixanews-copyright-text', array(
			  'type' => 'text',
			  'section'		=>	'pixanews-footer-section',
			  'label' => __( 'Copyright Text','pixanews' ),
			  'description' => __( 'Enter your own Copyright text. Default Copyright Message is (c) Sitename and Year.','pixanews' ),
			)	
	);
		
}
add_action('customize_register','pixanews_footer_customize_register');