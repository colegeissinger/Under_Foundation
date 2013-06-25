/**
 * @package Under_Foundation
 * @author Cole Geissinger <cole@colegeissinger.com>
 *
 * @version 1.0
 * @since   1.0
 */
jQuery( document ).ready( function( $ ) {
	$( document ).keydown( function( e ) {
		var url = false;
		if ( e.which === 37 ) {  // Left arrow key code
			url = $( '.previous-image a' ).attr( 'href' );
		}
		else if ( e.which === 39 ) {  // Right arrow key code
			url = $( '.entry-attachment a' ).attr( 'href' );
		}
		if ( url && ( ! $( 'textarea, input' ).is( ':focus' ) ) ) {
			window.location = url;
		}
	} );
} );