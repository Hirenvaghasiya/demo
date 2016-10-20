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

    // Header text color.
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
            }
        } );
    } );

    // Header style
    wp.customize( 'header_background_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-header, .main-navigation' ).css( 'background-color', to );
        } );
    } );
    wp.customize( 'header_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-description, .header-nav a' ).css( 'color', to );
        } );
    } );
    wp.customize( 'header_link_normal', function( value ) {
        value.bind( function( to ) {
            $( '.site-title a, .main-navigation a' ).css( 'color', to );
        } );
    } );
    wp.customize( 'header_link_hover', function( value ) {
        value.bind( function( to ) {
            $( '.header-nav' ).css( 'background-color', to );
        } );
    } );
    // Body style
    wp.customize( 'body_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-content p' ).css( 'color', to );
        } );
    } );
    wp.customize( 'body_link_normal', function( value ) {
        value.bind( function( to ) {
            $( '.site-content a' ).css( 'color', to );
        } );
    } );
    wp.customize( 'body_headings_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-content h1,.site-content h2,.site-content h3,.site-content h4,.site-content h5,.site-content h6, h2.entry-title a' ).css( 'color', to );
        } );
    } );
    // Footer style
     wp.customize( 'footer_background_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer, .site-info, .scroll-top' ).css( 'background-color', to );
        } );
    } );
    wp.customize( 'footer_text_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer' ).css( 'color', to );
        } );
    } );
    wp.customize( 'footer_link_normal', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer a' ).css( 'color', to );
        } );
    } );
    wp.customize( 'footer_headings_color', function( value ) {
        value.bind( function( to ) {
            $( '.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6' ).css( 'color', to );
        } );
    } );
    //Buttons style
    wp.customize( 'button_background_normal', function( value ) {
        value.bind( function( to ) {
            $( '.site .button,.site input[type="button"],.site input[type="reset"], .site input[type="submit"]' ).css( 'background-color', 'border-color', to );
        } );
    } );
    wp.customize( 'button_text_normal', function( value ) {
        value.bind( function( to ) {
            $('.site .button,.site input[type="button"],.site input[type="reset"], .site input[type="submit"]' ).css( 'color', to );
        } );
    } );
//end
} )( jQuery );
