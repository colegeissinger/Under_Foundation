<?php
	/**
	 * Jetpack Compatibility File
	 * See: http://jetpack.me/
	 *
	 * @package Under_Foundation
	 * @author Cole Geissinger <cole@colegeissinger.com>
	 *
	 * @version 1.0
	 * @since   1.0
	 */

	/**
	 * Add theme support for Infinite Scroll. @link http://jetpack.me/support/infinite-scroll/
	 * @return void
	 *
	 * @version 1.0
	 * @since   1.0
	 */
	function under_foundation_jetpack_setup() {
		add_theme_support( 'infinite-scroll', array(
			'container' => 'content',
			'footer'    => 'page',
		) );
	}
	add_action( 'after_setup_theme', 'under_foundation_jetpack_setup' );
