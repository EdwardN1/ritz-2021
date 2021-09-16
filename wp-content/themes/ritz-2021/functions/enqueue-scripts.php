<?php
function site_scripts() {
	global $wp_styles; // Call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	global $template_name;

	// Adding script files in the footer
	wp_enqueue_script( 'site-js', get_template_directory_uri() . '/assets/scripts/scripts.js', array( 'jquery' ), filemtime( get_template_directory() . '/assets/scripts/js' ), true );
	wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/vendor/slick-1.8.1/slick/slick.min.js', array( 'site-js' ), filemtime( get_template_directory() . '/vendor/slick-1.8.1/slick/slick.min.js' ), true );
	wp_enqueue_script( 'waypoints-js', get_template_directory_uri() . '/vendor/waypoints/jquery.waypoints.min.js', array( 'slick-js' ), filemtime( get_template_directory() . '/vendor/waypoints/jquery.waypoints.min.js' ), true );
	wp_enqueue_script( 'bookatable', '//bda.bookatable.com/deploy/lbui.direct.min.js', array( 'waypoints-js' ), 1.1, true );
	if($template_name=='T8 Location Page') {
		//wp_enqueue_script( 'google-maps-api', 'https://maps.googleapis__x.com/maps/api/js?key=AIzaSyBxPrxmkuPdY0biO5r7F7Y3gqrbTxa3nIk', array( 'jquery' ),'', true );
		wp_enqueue_script( 'google-maps-markers', get_template_directory_uri() . '/vendor/old-google-maps/markerwithlabel.js', array( 'google-maps-api' ), filemtime( get_template_directory() . '/vendor/old-google-maps/markerwithlabel.js' ), true );
		wp_enqueue_script( 'google-maps-js', get_template_directory_uri() . '/vendor/old-google-maps/google-maps.js', array( 'google-maps-api' ), filemtime( get_template_directory() . '/vendor/old-google-maps/google-maps.js' ), true );
	}
	wp_enqueue_script( 'ritz-js', get_template_directory_uri() . '/assets/scripts/ritz.js', array( 'bookatable' ), filemtime( get_template_directory() . '/assets/scripts/ritz.js' ), true );

	wp_enqueue_script( 'azds', '//newbooking.azds.com/inline.bundle.js', array( 'ritz-js' ), 1.1, true );

	// Register stylesheets
	wp_enqueue_style( 'azds-css', 'https://newbooking.azds.com/api/hotel/ritzlondon/styles', array(), '', 'all' );
	wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/assets/styles/vendor/animate.min.css', array(), filemtime( get_template_directory() . '/assets/styles/scss' ), 'all' );
	wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/vendor/slick-1.8.1/slick/slick.css', array(), filemtime( get_template_directory() . '/vendor/slick-1.8.1/slick/slick.css' ), 'all' );
	wp_enqueue_style( 'site-css', get_template_directory_uri() . '/assets/styles/style.css', array(), filemtime( get_template_directory() . '/assets/styles/scss' ), 'all' );

	// Comment reply script for threaded comments
	if ( is_singular() and comments_open() and ( get_option( 'thread_comments' ) == 1 ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'site_scripts', 999 );