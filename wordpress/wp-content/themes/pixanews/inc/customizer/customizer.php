<?php
/**
 * Pixanews Theme Customizer
 * @package Pixanews
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pixanews_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'pixanews_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'pixanews_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'pixanews_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pixanews_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pixanews_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pixanews_customize_preview_js() {
	wp_enqueue_script( 'pixanews-customizer', get_template_directory_uri() . '/inc/customizer/js/customizer.js', array( 'customize-preview' ), _PIXANEWS_VERSION, true );
}
add_action( 'customize_preview_init', 'pixanews_customize_preview_js' );


function pixanews_customizer_assets() {
	wp_enqueue_script( 'pixanews-controls-js', get_template_directory_uri() . '/inc/customizer/js/controls.js', array( 'customize-preview' ), _PIXANEWS_VERSION, true );
	wp_enqueue_style( 'pixanews-controls-css', get_template_directory_uri() . '/inc/customizer/css/customizer.css' );
}
add_action('customize_controls_enqueue_scripts','pixanews_customizer_assets');


//Custom Controls
require_once get_template_directory()."/inc/customizer/custom-controls.php";

//Import Other sections
require_once get_template_directory()."/inc/customizer/section-colors.php";
require_once get_template_directory()."/inc/customizer/section-help-support.php";
require_once get_template_directory()."/inc/customizer/panel-basic-settings.php";
require_once get_template_directory()."/inc/customizer/panel-header.php";
require_once get_template_directory()."/inc/customizer/panel-featured-areas.php";
require_once get_template_directory()."/inc/customizer/panel-footer.php";

require_once get_template_directory()."/inc/customizer/sanitize-functions.php";
