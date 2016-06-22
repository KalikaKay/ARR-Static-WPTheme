/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	//Lip color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	//Header Shadow - Checkbox Version
	wp.customize( 'header_shadow', function( value ) {
		value.bind( function( to ) {
			if ( '' === to ) {
				$( '.site-header' ).css( {
					'text-shadow' : '0 0 0'
				} );
			} else {
				$( '.site-header' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-header' ).css( {
					'text-shadow': '2px 2px 4px #000000'
				} );
			}

		} );
	} );

	//Hair Color
	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-header' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-header' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-header' ).css( {
					'background-color': to
				} );
			}

		} );
	} );



} )( jQuery );
