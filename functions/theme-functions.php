<?php
	/**
	 * under_foundation functions and definitions
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 1.0
	 * @since   1.0
	 */


	// Set the theme version variable
	$under_foundation_theme_version = '1.0';


	/**
	 * Set the content width based on the theme's design and stylesheet.
	 *
	 * @version 1.0
	 * @since   1.0
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
	 * @version 1.0
	 * @since   1.0
	 */
	if ( ! function_exists( 'under_foundation_setup' ) ) :
		function under_foundation_setup() {

			// Add default posts and comments RSS feed links to head
			add_theme_support( 'automatic-feed-links' );

			// Enable support for Post Thumbnails on posts and pages @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			// add_theme_support( 'post-thumbnails' );

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
	 * Register widgetized area and update sidebar with default widgets
	 * @return void
	 *
	 * @version 1.0
	 * @since   1.0
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
	 * @version 1.0
	 * @since   1.0
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