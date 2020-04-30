<?php
/**
 * Functions and definitions
 *
 */

if ( ! function_exists( 'merch_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function merch_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on merch, use a find and replace
	 * to change 'merch' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'merch', get_template_directory() . '/languages' );

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
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'blog-list', 470, 470, true );
	add_image_size( 'blog-single', 770, 530, true );
	add_image_size( 'page-full', 1170, 530, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'merch' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'gallery', 'image', 'quote',
	) );

	/*
	 * Enable support for shortcodes in text widgets
	 * See http://codex.wordpress.org/Function_Reference/do_shortcode
	 */
	add_filter('widget_text', 'do_shortcode');

}
endif; // merch_setup
add_action( 'after_setup_theme', 'merch_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function merch_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'merch_content_width', 770 );
}
add_action( 'after_setup_theme', 'merch_content_width', 0 );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function merch_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Slideout Sidebar', 'merch' ),
		'id'            => 'slideout-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header', 'merch' ),
		'id'            => 'header-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Shop', 'merch' ),
		'id'            => 'shop-sidebar',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Left', 'merch' ),
		'id'            => 'footer-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Center', 'merch' ),
		'id'            => 'footer-center',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Right', 'merch' ),
		'id'            => 'footer-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'merch_widgets_init' );

/**
 * Load Default Fonts
 */
require get_template_directory() . '/inc/fonts.php';

/**
 * Enqueue scripts and styles.
 */
function merch_scripts() {

	global $wp_styles; // For IE stylesheet
	/**
	 * Get the theme's version number for cache busting
	 */
	$merch = wp_get_theme();

	wp_enqueue_style( 'merch-foundation-style', get_template_directory_uri() . '/app.css', array(), '5.5.2' );
	wp_enqueue_style( 'merch_fonts', merch_fonts(), array(), $merch['Version'] );
	/**
	 * Font Awesome Handle based on the standardized set
	 * @link https://github.com/grappler/wp-standard-handles
	 */
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css', array(), '4.4.0' );
	wp_enqueue_style( 'merch-flexslider', get_template_directory_uri() . '/inc/flexslider/flexslider.css', array(), '2.2.0' );
	wp_enqueue_style( 'merch-style', get_template_directory_uri() . '/style.css', array(), $merch['Version'] );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/foundation/modernizr.js', array( 'jquery' ), '2.8.3', true );
	wp_enqueue_script( 'merch-foundation', get_template_directory_uri() . '/js/foundation/foundation.min.js', array( 'jquery' ), '5.5.2', true );
	wp_enqueue_script( 'merch-combined', get_template_directory_uri() . '/js/combined.js', array( 'jquery' ), $merch['Version'], true );
	wp_enqueue_script( 'merch-init', get_template_directory_uri() . '/js/app.js', array( 'jquery' ), $merch['Version'], true );
	
	if ( is_page_template( 'template-contact.php' ) ) { // only load on the contact page template
		// Load Google API key if provided. Google requires new site to use API
		$key = sanitize_text_field( get_theme_mod( 'google_map_api_key', merch_customizer_library_get_default( 'google_map_api_key' ) ) );
		$api_key = ! empty( $key ) ? 'key=' . $key : '';
		
		wp_enqueue_script( 'rescue_googlemap',  get_template_directory_uri() . '/js/google-map.js', array('jquery'), '1.0', true );
		wp_enqueue_script('rescue_googlemap_api', 'https://maps.googleapis.com/maps/api/js?' . $api_key, array('jquery'), '1.0', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/**
	 * IE Styles
	 */
  wp_enqueue_style( 'merch-ie', get_template_directory_uri() . '/inc/css/ie.css' );
  $wp_styles->add_data( 'merch-ie', 'conditional', 'IE 9' );

}
add_action( 'wp_enqueue_scripts', 'merch_scripts', 10 );

/**
 * Load Foundation functions
 */
require get_template_directory() . '/inc/foundation.php';

/**
 * Load customizer library files
 */
// Helper library for the theme customizer.
require get_template_directory() . '/customizer/customizer-library/customizer-library.php';

// Define options for the theme customizer.
require get_template_directory() . '/customizer/customizer-options.php';

// Output inline styles based on theme customizer selections.
require get_template_directory() . '/customizer/styles.php';

// Additional filters and actions based on theme customizer selections.
require get_template_directory() . '/customizer/mods.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load home slider and video options
 */
require get_template_directory() . '/inc/home-hero.php';

/**
 * Load Image Resizing. Used for gallery format posts.
 */
require get_template_directory() . '/inc/BFI_Thumb.php';

/**
 * Load WooCommerce Files
 */
require get_template_directory() . '/woocommerce/hooks-filters/woocommerce.php';

/**
 * Plugin activation Notice
 */
require get_template_directory() . '/inc/tgm/plugin-activation.php';

/**
 * Add Retina Support
 */
require get_template_directory() . '/inc/retina.php';

/**
 * Load sticky header
 */
require get_template_directory() . '/inc/sticky-header.php';

/**
 * Load theme updater functions.
 */
function merch_updater() {
	require( get_template_directory() . '/inc/updater/theme-updater.php' );
}
add_action( 'after_setup_theme', 'merch_updater' );
