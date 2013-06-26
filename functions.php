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


	// Set some variables
	$under_foundation_theme_functions_uri = get_template_directory() . '/functions/';


	/**
	 * Load our theme functions
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	require $under_foundation_theme_functions_uri . 'theme-functions.php';


	/**
	 * Implement the Custom Header feature.
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	require $under_foundation_theme_functions_uri . 'custom-header.php';


	/**
	 * Custom template tags for this theme.
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	require $under_foundation_theme_functions_uri . 'template-tags.php';


	/**
	 * Custom functions that act independently of the theme templates.
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	require $under_foundation_theme_functions_uri . 'extras.php';


	/**
	 * Customizer additions.
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	require $under_foundation_theme_functions_uri . 'customizer.php';


	/**
	 * Load Jetpack compatibility file.
	 *
	 * @version 0.1
	 * @since   0.1
	 */
	require $under_foundation_theme_functions_uri . 'jetpack.php';

