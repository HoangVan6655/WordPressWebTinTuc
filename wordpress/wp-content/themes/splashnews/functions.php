<?php
function splashnews_enqueue_child_styles() {
    $min = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
    $parent_style = 'darknews-style';

    
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap' . $min . '.css');
    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style(
        'splashnews',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'bootstrap', $parent_style ),
        wp_get_theme()->get('Version') );


}
add_action( 'wp_enqueue_scripts', 'splashnews_enqueue_child_styles' );


//default settings
function splashnews_filter_default_theme_options($defaults) {
   
    $defaults['global_site_layout_setting']    = 'boxed';
    $defaults['global_site_mode_setting']    = 'aft-default-mode';
    $defaults['show_popular_tags_section'] = 0;
    $defaults['select_main_banner_order'] = 'order-3';
    $defaults['secondary_color'] = '#1164F0';

    return $defaults;
}

add_filter('darknews_filter_default_theme_options', 'splashnews_filter_default_theme_options', 1);



function splashnews_custom_header_setup($default_custom_header){
    $default_custom_header['default-text-color'] = '000000';
    return $default_custom_header;
}
add_filter('darknews_custom_header_args', 'splashnews_custom_header_setup', 1);

/*
 * Load Post carousel
 */

require get_stylesheet_directory() . '/inc/widgets/widget-posts-grid.php';


/* Register site widgets */
if (!function_exists('splashnews_widgets')) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function splashnews_widgets() {

        register_widget('SplashNews_Featured_Post');



    }
endif;
add_action('widgets_init', 'splashnews_widgets');