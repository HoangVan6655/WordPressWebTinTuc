<?php 
/**
 * Pixanews functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pixanews
 */

if ( ! defined( '_PIXANEWS_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_PIXANEWS_VERSION', '1.0.2.4' );
}

if ( ! function_exists( 'pixanews_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function pixanews_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Pixanews, use a find and replace
		 * to change 'pixanews' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'pixanews', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'pixanews' ),
				'menu-top' => esc_html__( 'Top', 'pixanews' ),
				'mobile' => esc_html__( 'Mobile Menu', 'pixanews' ),
				'social' => esc_html__( 'Social Networks', 'pixanews' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'pixanews_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
		
		add_image_size( 'pixanews-thumbnail-4x3', '600', '450', true );
		add_image_size( 'pixanews-thumbnail-4x4', '600', '600', true );
		
	}
endif;
add_action( 'after_setup_theme', 'pixanews_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function pixanews_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'pixanews_content_width', 768 );
}
add_action( 'after_setup_theme', 'pixanews_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function pixanews_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'pixanews' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'pixanews' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 1', 'pixanews' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'pixanews' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 2', 'pixanews' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'pixanews' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Widgets Area 3', 'pixanews' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'pixanews' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<div class="widget-title">',
			'after_title'   => '</div>',
		)
	);
}
add_action( 'widgets_init', 'pixanews_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function pixanews_scripts() {
	wp_enqueue_style( 'pixanews-style', get_stylesheet_uri(), array(), _PIXANEWS_VERSION );
		
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/lib/bootstrap/bootstrap.min.css'); 
	wp_enqueue_style('fontawesome', get_template_directory_uri() . '/lib/font-awesome/css/all.min.css'); 
	wp_enqueue_style('acme-ticker-css', get_template_directory_uri() . '/lib/acmeticker/css/style.min.css'); 
	wp_enqueue_style('owl-carousel-css', get_template_directory_uri() . '/lib/owl-carousel/dist/assets/owl.carousel.min.css'); 
	wp_enqueue_style('owl-carousel-theme-css', get_template_directory_uri() . '/lib/owl-carousel/dist/assets/owl.theme.default.min.css'); 
	wp_enqueue_style('sidr-dark-css', get_template_directory_uri() . '/lib/sidr/stylesheets/jquery.sidr.dark.min.css'); 
	wp_enqueue_style('pixanews-primary-font', '//fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;600;700;900&display=swap' );
	wp_enqueue_style('pixanews-secondary-font', '//fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap' );
	wp_enqueue_style('pixanews-core', get_template_directory_uri() . '/design-files/core/core.css'); 
	wp_enqueue_style('pixanews-header', get_template_directory_uri() . '/design-files/header/'.esc_html(get_theme_mod('pixanews-header-style','style2')).'/header.css'); 
	wp_enqueue_style('pixanews-blog-style1', get_template_directory_uri() . '/design-files/blog-style/blog-style1.css'); 
	wp_enqueue_style('pixanews-single', get_template_directory_uri() . '/design-files/single/single.css');
	wp_enqueue_style('pixanews-sidebar', get_template_directory_uri() . '/design-files/sidebar/sidebar.css'); 
	wp_enqueue_style('pixanews-footer', get_template_directory_uri() . '/design-files/footer/footer.css'); 
	wp_enqueue_style('pixanews-featured-modules', get_template_directory_uri() . '/design-files/featured-modules/featured-modules.css'); 

	
	wp_enqueue_script( 'pixanews-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _PIXANEWS_VERSION, true );
	wp_enqueue_script( 'acme-ticker', get_template_directory_uri() . '/lib/acmeticker/js/acmeticker.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/lib/owl-carousel/dist/owl.carousel.js', array('jquery'), '2.3.4', true );
	wp_enqueue_script( 'sidr', get_template_directory_uri() . '/lib/sidr/jquery.sidr.min.js', array('jquery'), '2.2.1', true );
	wp_enqueue_script( 'pixanews-theme-js', get_template_directory_uri() . '/js/theme.js', array('sidr','owl-carousel'), _PIXANEWS_VERSION, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'pixanews_scripts' );

/**
 * Filter the excerpt length to 50 words.
 *
 * @param int $length Excerpt length.
 * @return int 
 */
function pixanews_excerpt_length( $length ) {
		if (!is_admin() ) { 
			return 30; 
		} 
		return $length;

}
add_filter( 'excerpt_length', 'pixanews_excerpt_length', 999 );

function pixanews_excerpt_more( $more ) {
	if (!is_admin() ) {
		return '....'; 
	} 
	return $more;

}
add_filter( 'excerpt_more', 'pixanews_excerpt_more' );

/**
 * Function to wrap the entire site in a container and bootstrap row.
 *
 */
function pixanews_after_header_divs() {
	?><div class="container">
		<div class="row"><?php
}
add_action('pixanews_after_header','pixanews_after_header_divs'); 

function pixanews_before_footer_divs() {
	?></div><!--#.row-->
	</div><!--.container--><?php
}
add_action( 'pixanews_before_footer', 'pixanews_before_footer_divs' );

/**
 * Function to wrap the entire site in a container and bootstrap row.
 *
 */
function pixanews_before_loop_divs() {
	?>
		<div class="row grid-row"><?php
}
add_action('pixanews_before_loop','pixanews_before_loop_divs'); 

function pixanews_after_loop_divs() {
	?></div><!--#.grid-row--><?php
}
add_action( 'pixanews_after_loop', 'pixanews_after_loop_divs' );

/**
 * Featured Ticker, Carousel & Other Modules
 */
function pixanews_insert_ticker() {
		get_template_part( 'template-parts/featured-modules/acme-ticker' );
}
add_action('pixanews_after_header','pixanews_insert_ticker'); 
 
function pixanews_insert_carousel() {
	if (is_home())
		get_template_part( 'template-parts/featured-modules/owl-carousel' );
}
add_action('pixanews_after_header','pixanews_insert_carousel'); 

function pixanews_insert_featured_modules() {
	if (is_home()) :
		$i = 0;
		for ($i = 1; $i < 8; $i++) :
			pixanews_display_featured_module( get_theme_mod( 'pixanews-fa-style-'.$i, 'style1' ), get_theme_mod('pixanews-fa-enable-'.$i, 0) ,get_theme_mod( 'pixanews-fa-cat-'.$i, 0 ), get_theme_mod( 'pixanews-fa-show-title-'.$i, true ), get_theme_mod( 'pixanews-fa-random-order-'.$i, 0 ));
		endfor;
	endif;	
}
add_action('pixanews_after_header','pixanews_insert_featured_modules'); 


/**
 * Function to alter the width of sidebar and content area based on diff pages.
 *
 */
function pixanews_sidebar_setting() {
	if (is_search())	
		$setting = get_theme_mod('pixanews-primary-width-search', 'right-sidebar');
	if (is_single())
		$setting = get_theme_mod('pixanews-primary-width-single-post', 'right-sidebar');
	if (is_page())
		$setting = get_theme_mod('pixanews-primary-width-page', 'right-sidebar');
	if (is_archive())
		$setting = get_theme_mod('pixanews-primary-width-archives', 'right-sidebar');
	if (is_home())
		$setting = get_theme_mod('pixanews-primary-width-home', 'right-sidebar');	 
	return $setting;
}
	
function pixanews_primary_width() {
	$setting = pixanews_sidebar_setting();
		
	switch ($setting) {
		case 'no-sidebar':
			$class = 'col-md-12';
			break;
		case 'right-sidebar':
			$class = 'col-md-8';
			break;
		case 'right-sidebar-narrow':
			$class = 'col-md-9';
			break;
		case 'no-sidebar-narrow-primary':
			$class = 'col-md-8 offset-md-2 offset-sm-0 offset-lg-2';
			break;	
		default:
			$class = 'col-md-8';
			break;					
	}
	echo esc_html($class); 
}
add_action('pixanews_primary_width_class','pixanews_primary_width');

function pixanews_secondary_width() {
	$setting = pixanews_sidebar_setting();
	
	switch ($setting) {
		case 'no-sidebar':
			$class = 'd-none';
			break;
		case 'no-sidebar-narrow-primary':
			$class = 'd-none';
			break;	
		case 'right-sidebar':
			$class = 'col-md-4';
			break;
		case 'right-sidebar-narrow':
			$class = 'col-md-3';
			break;
		default:
			$class = 'col-md-4';
			break;					
	}
	echo esc_html($class); 
}
add_action('pixanews_secondary_width_class','pixanews_secondary_width');


/**
 * LessCSS PHP Color Darken/Lighten
 */
function pixanews_darken_color($color_code,$percentage_adjuster = 0) {
	$percentage_adjuster = round($percentage_adjuster/100,2);
	if(preg_match("/#/",$color_code)) {
		$hex = str_replace("#","",$color_code);
		$r = (strlen($hex) == 3)? hexdec(substr($hex,0,1).substr($hex,0,1)):hexdec(substr($hex,0,2));
		$g = (strlen($hex) == 3)? hexdec(substr($hex,1,1).substr($hex,1,1)):hexdec(substr($hex,2,2));
		$b = (strlen($hex) == 3)? hexdec(substr($hex,2,1).substr($hex,2,1)):hexdec(substr($hex,4,2));
		$r = round($r - ($r*$percentage_adjuster));
		$g = round($g - ($g*$percentage_adjuster));
		$b = round($b - ($b*$percentage_adjuster));
 
		return "#".str_pad(dechex( max(0,min(255,$r)) ),2,"0",STR_PAD_LEFT)
			.str_pad(dechex( max(0,min(255,$g)) ),2,"0",STR_PAD_LEFT)
			.str_pad(dechex( max(0,min(255,$b)) ),2,"0",STR_PAD_LEFT);
	}
}

/**
 * Implement the Custom Colors feature.
 */
function pixanews_colors_override(){ ?>
 <style>
 	:root {
		 --pixanews-primary: <?php echo esc_html(get_theme_mod('pixanews-primary-color','#f9095d')); ?>;
		 --pixanews-primary-text: <?php echo esc_html(get_theme_mod('pixanews-primary-text-color','#f9ffe7')); ?>;
		 --pixanews-background-main: <?php echo esc_html("#".get_theme_mod('background_color','ffffff')); ?>;
		 --pixanews-background-darker: <?php echo esc_html(get_theme_mod('pixanews-background-darker-color','#eeeeee')); ?>;
		 
		 --pixanews-secondary: <?php echo esc_html(get_theme_mod('pixanews-secondary-color','#4a58d9')); ?>;
		 --pixanews-secondary-text: <?php echo esc_html(get_theme_mod('pixanews-secondary-text-color','#FFFFFF')); ?>;
		 --pixanews-secondary-dark: <?php echo esc_html(get_theme_mod('pixanews-secondary-dark-color','#5241c1')); ?>;
		 
		 --pixanews-text-dark: <?php echo esc_html(get_theme_mod('pixanews-text-dark-color','#111')); ?>;
		 --pixanews-text: <?php echo esc_html(get_theme_mod('pixanews-text-color','#555')); ?>;
		 --pixanews-text-light: <?php echo esc_html(get_theme_mod('pixanews-text-light-color','#777')); ?>;
		 
		 --pixanews-header-background: <?php echo esc_html(get_theme_mod('pixanews-header-bg-color','#000000')); ?>;
		 --pixanews-header-text: <?php echo esc_html(get_theme_mod('pixanews-header-content-color','#FFFFFF')); ?>;
		 --pixanews-header-lighter: <?php echo esc_html(get_theme_mod('pixanews-header-bg-lighter-color','#222222')); ?>;
		 --pixanews-top-bar-text: <?php echo esc_html(get_theme_mod('pixanews-top-bar-text-color','#777777')); ?>;
		 
		 --pixanews-mobile-header-background: <?php echo esc_html(get_theme_mod('pixanews-header-mobile-bg-color','#000000')); ?>;
		 --pixanews-mobile-header-text: <?php echo esc_html(get_theme_mod('pixanews-header-mobile-text-color','#CCCCCC')); ?>;
	 }
 </style>
<?php 
}
add_action( 'wp_head', 'pixanews_colors_override' );

/**
 * Implement the Custom Colors feature.
 */
function pixanews_logo_max_height(){ ?>
 <style>
	 #masthead #site-branding .custom-logo {
		 max-height: <?php echo esc_html(get_theme_mod('pixanews-logo-max-height', 90))."px"; ?> !important;
	 }
 </style>
<?php 
}
add_action( 'wp_head', 'pixanews_logo_max_height' );


/*
* Get Blog Posts Layout for Archive, Home & Tax Pages
*
*/ 
function pixanews_blog_layout_setting() {
	if (is_search())	
		$setting = get_theme_mod('pixanews-search-results-layout', 'style1');
	if (is_archive())
		$setting = get_theme_mod('pixanews-archives-layout', 'style1');
	if (is_home()) 
		$setting = get_theme_mod('pixanews-home-layout', 'style1');	
	
	return $setting;
}

function pixanews_blog_layout_display() {
	$layout = pixanews_blog_layout_setting();
	
	get_template_part( 'template-parts/blog-style/content', $layout );
}
add_action('pixanews_blog_layout','pixanews_blog_layout_display');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the Featured Modules
 */
require get_template_directory() . '/inc/display-featured-modules.php';

/**
 * Implement the Multiple Masthead Styles
 */
require get_template_directory() . '/inc/display-masthead.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

