<?php
/*-----------------------------------------------------------------
 * HEADER
-----------------------------------------------------------------*/
// site branding
if ( ! function_exists( 'igthemes_site_branding' ) ) {
	//start function
	function igthemes_site_branding() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
            echo '<div class="site-branding">';
			 the_custom_logo();
            echo '</div>';
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else { ?>
			<div class="site-branding">
				<h1 class="site-title">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </h1>
			</div>
		<?php }
	}
}
// header navigation
if ( ! function_exists( 'igthemes_header_navigation' ) ) {
	//start function
	function igthemes_header_navigation() { ?>
		<nav id="header-navigation" class="header-nav" role="navigation">
            <div class="grid-container">
            <?php if ( '' != get_bloginfo( 'description' ) ) { ?>
				<div class="site-description"><?php echo bloginfo( 'description' ); ?></div>
            <?php } ?>
			<?php wp_nav_menu( array( 'theme_location' => 'header-menu', 'menu_id' => 'header-menu', 'fallback_cb' => false ) ); ?>
            </div>
		</nav><!-- #site-navigation -->
  <?php  }
}

/*-----------------------------------------------------------------
 * BREADCRUMB
-----------------------------------------------------------------*/
if ( ! function_exists( 'igthemes_breadcrumb' ) ) {
	// start function
    function igthemes_breadcrumb() {
        if (get_theme_mod('breadcrumb')) {
	       if ( function_exists('bcn_display') && !is_home() ) { ?>
                <div class="breadcrumb" typeof="BreadcrumbList" vocab="http://schema.org/">
                    <div class="container">
                        <?php bcn_display(); ?>
                    </div>
                </div>
            <?php
	        } elseif ( function_exists('yoast_breadcrumb') ) { 
                    yoast_breadcrumb('<div class="breadcrumb"><div class="container">','</div></div>');
            } else {
                if (!is_home()) {
                    echo '<div class="breadcrumb">';
                    echo '<a href="'. esc_url(home_url('/')) .'">';
                    echo esc_html__('Home', 'store-wp');
                    echo '</a>';
                if (is_single()) {
                    the_category('&bull;');
                    if (is_singular( 'post' )) {
                        echo '<span class="current">';
                            the_title();
                        echo '</span>';
                    } 
                }
                echo '</div>';
                }
            }
        }
    }
}
/*-----------------------------------------------------------------
 * POST THUMBNAIL
-----------------------------------------------------------------*/
if ( ! function_exists( 'igthemes_post_thumbnail' ) ) {
	/**
	 * Display post thumbnail
	 *
	 * @var $size thumbnail size. thumbnail|medium|large|full|$custom
	 * @uses has_post_thumbnail()
	 * @uses the_post_thumbnail
	 */
	function igthemes_post_thumbnail( $size ) {
		if ( has_post_thumbnail() && is_singular() ) {
			the_post_thumbnail( $size, array( 'class' => 'featured-img' )  );
		} else {
            echo '<a href=" '. esc_url( get_permalink() ) .' " rel="bookmark">';
                the_post_thumbnail( $size, array( 'class' => 'featured-img' ) );
            echo '</a>';
        }
	}
}
/*----------------------------------------------------------------------
# ARCHIVE TITLE FILTER
 ----------------------------------------------------------------------*/
add_filter('get_the_archive_title', function ($title) {
    if ( is_tax() || is_category() ) {
        $title = sprintf( __( '%s', 'store-wp' ), single_cat_title( '', false ) );
    } elseif ( is_post_type_archive() ) {
        $title = sprintf( __( '%s', 'store-wp' ), post_type_archive_title( '', false ) );
    }
    return $title;
});

/*----------------------------------------------------------------------
 * Adjust a hex color brightness
 * Allows us to create hover styles for custom link colors
 *
 * @param  strong  $hex   hex color e.g. #111111.
 * @param  integer $steps factor by which to brighten/darken ranging from -255 (darken) to 255 (brighten).
 * @return string        brightened/darkened hex color
 ----------------------------------------------------------------------*/
function igthemes_adjust_color_brightness( $hex, $steps ) {
	// Steps should be between -255 and 255. Negative = darker, positive = lighter.
	$steps  = max( -255, min( 255, $steps ) );
	// Format the hex color string.
	$hex    = str_replace( '#', '', $hex );
	if ( 3 == strlen( $hex ) ) {
		$hex    = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
	}
	// Get decimal values.
	$r  = hexdec( substr( $hex, 0, 2 ) );
	$g  = hexdec( substr( $hex, 2, 2 ) );
	$b  = hexdec( substr( $hex, 4, 2 ) );
	// Adjust number of steps and keep it inside 0 to 255.
	$r  = max( 0, min( 255, $r + $steps ) );
	$g  = max( 0, min( 255, $g + $steps ) );
	$b  = max( 0, min( 255, $b + $steps ) );
	$r_hex  = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
	$g_hex  = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
	$b_hex  = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );
	return '#' . $r_hex . $g_hex . $b_hex;
}