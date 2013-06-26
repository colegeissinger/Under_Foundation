<?php
	/**
	 * under_foundation functions and definitions
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 0.1
	 * @since   0.1
	 */


	// Set the theme version variable
	$under_foundation_theme_version = '0.1';


	/**
	 * Set the content width based on the theme's design and stylesheet.
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */


	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	if ( ! function_exists( 'under_foundation_setup' ) ) :
		function under_foundation_setup() {

			/**
			 * Make theme available for translation
			 * Translations can be filed in the /languages/ directory
			 * If you're building a theme based on Under_Foundation, use a find and replace
			 * to change 'under_foundation' to the name of your theme in all the template files
			 */
			load_theme_textdomain( 'under_foundation', get_template_directory() . '/languages' );

			// Add default posts and comments RSS feed links to head
			add_theme_support( 'automatic-feed-links' );

			// Enable support for Post Thumbnails on posts and pages @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			add_theme_support( 'post-thumbnails' );

			// Add our WordPress Menus
			register_nav_menus( array(
				'primary' => __( 'Primary Menu', 'under_foundation' ),
			) );

			// Enable support for Post Formats
			add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
		}
	endif;
	add_action( 'after_setup_theme', 'under_foundation_setup' );


	/**
	 * Setup the WordPress core custom background feature.
	 *
	 * Use add_theme_support to register support for WordPress 3.4+
	 * as well as provide backward compatibility for WordPress 3.3
	 * using feature detection of wp_get_theme() which was introduced
	 * in WordPress 3.4.
	 *
	 * @todo Remove the 3.3 support when WordPress 3.6 is released.
	 *
	 * Hooks into the after_setup_theme action.
	 */
	function under_foundation_register_custom_background() {
		$args = array(
			'default-color' => 'ffffff',
			'default-image' => '',
		);

		$args = apply_filters( 'under_foundation_custom_background_args', $args );

		if ( function_exists( 'wp_get_theme' ) ) {
			add_theme_support( 'custom-background', $args );
		} else {
			define( 'BACKGROUND_COLOR', $args['default-color'] );
			if ( ! empty( $args['default-image'] ) )
				define( 'BACKGROUND_IMAGE', $args['default-image'] );
			add_custom_background();
		}
	}
	add_action( 'after_setup_theme', 'under_foundation_register_custom_background' );


	/**
	 * Register widgetized area and update sidebar with default widgets
	 * @return void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	function under_foundation_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Sidebar', 'under_foundation' ),
			'id'            => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		) );
	}
	add_action( 'widgets_init', 'under_foundation_widgets_init' );


	/**
	 * Enqueue scripts and styles
	 * @return void
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	function under_foundation_scripts() {
		global $under_foundation_theme_version;

		// Load our stylesheets
		wp_enqueue_style( 'under_foundation-style', get_template_directory_uri() . '/css/app.css', null, $under_foundation_theme_version );

		// Load our Scripts
		wp_enqueue_script( 'under_foundation-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $under_foundation_theme_version, true );
		wp_enqueue_script( 'under_foundation-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), $under_foundation_theme_version, true );

		// Load only when viewing single.php & comments are enabled and threaded comments is enabled
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		// Load only when viewing single.php & the attachment file is an image
		if ( is_singular() && wp_attachment_is_image() )
			wp_enqueue_script( 'under_foundation-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), $under_foundation_theme_version );
	}
	add_action( 'wp_enqueue_scripts', 'under_foundation_scripts' );
	
	
	
	
	<?php
/**
 * Under_Foundation functions and definitions
 *
 * @package Under_Foundation
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'under_foundation_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function under_foundation_setup() {

	

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'under_foundation' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
}
endif; // under_foundation_setup
add_action( 'after_setup_theme', 'under_foundation_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for WordPress 3.3
 * using feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * @todo Remove the 3.3 support when WordPress 3.6 is released.
 *
 * Hooks into the after_setup_theme action.
 */
function under_foundation_register_custom_background() {
	$args = array(
		'default-color' => 'ffffff',
		'default-image' => '',
	);

	$args = apply_filters( 'under_foundation_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		if ( ! empty( $args['default-image'] ) )
			define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_custom_background();
	}
}
add_action( 'after_setup_theme', 'under_foundation_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function under_foundation_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'under_foundation' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'under_foundation_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function under_foundation_scripts() {
	wp_enqueue_style( 'under_foundation-style', get_stylesheet_uri() );

	wp_enqueue_script( 'under_foundation-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'under_foundation-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'under_foundation-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'under_foundation_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

