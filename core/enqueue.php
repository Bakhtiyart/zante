<?php
/* --------------------------------------------------------------------------
 * Load Frontend CSS & JS
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
add_action( 'wp_enqueue_scripts', 'zante_load_scripts' );

function zante_load_scripts() {
	zante_load_css();
	zante_load_js();
}


/* --------------------------------------------------------------------------
 * Load Frontend CSS
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
function zante_load_css() {

	// ENQUEUE GOOGLE FONTS
	if ( class_exists( 'Redux' ) ) {
		if ( $fonts_link = zante_generate_fonts_link()   ) {
		 wp_enqueue_style( 'zante-fonts', $fonts_link, false, ZANTE_THEME_VERSION );
		}
	}
		// CSS LIBRARIES
		$styles = array(
			'bootstrap' => 'bootstrap.min.css',
			'default' => 'default.css',
			'bootstrap-select' => 'bootstrap-select.min.css',
			'magnific-popup' => 'magnific-popup.css',
			'owl-carousel' => 'owl.carousel.min.css',
			'animate' => 'animate.min.css',
			'font-awesome' => 'font-awesome.min.css',
			'flaticon' => 'flaticon.css',
			'main' => 'main.css',
			'responsive' => 'responsive.css'
		);

		// ENQUEUE ALL REQUIRED CSS
		foreach ( $styles as $id => $style ) {
			wp_enqueue_style( 'zante-' . $id, get_template_directory_uri() . '/assets/css/' . $style, false, ZANTE_THEME_VERSION );
		}

	 // ENQUEUE DYNAMIC & CUSTOM CSS
	 wp_register_style( 'dynamic', false );
	 wp_enqueue_style( 'dynamic' );
	 wp_add_inline_style( 'dynamic', zante_generate_css() );

}

/* --------------------------------------------------------------------------
 * Load Frontend JS
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
function zante_load_js() {

	// COMMENTS JS
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    // JS LIBRARIES
    $scripts = array(
        'bootstrap' => 'bootstrap.min.js',
        'bootstrap-select' => 'bootstrap-select.min.js',
        'isotope' => 'isotope.pkgd.min.js',
        'jpushmenu' => 'jPushMenu.js',
        'countdown' => 'jquery.countdown.min.js',
        'countup' => 'countup.min.js',
        'inview' => 'jquery.inview.min.js',
        'magnific-popup' => 'jquery.magnific-popup.min.js',
        'moment' => 'moment.min.js',
        'morphext' => 'morphext.min.js',
				'owl.carousel' => 'owl.carousel.min.js',
        'owlthumbs' => 'owl.carousel.thumbs.min.js',
        'wow' => 'wow.min.js',
        'main' => 'main.js'
    );

		// ENQUEUE PRE-PACKAGED JS LIBRARIES
    wp_enqueue_script( array( 'imagesloaded', 'masonry' ) );

		// ENQUEUE ALL REQUIRED JS
    foreach ( $scripts as $id => $script ) {
        wp_enqueue_script( 'zante-'.$id, get_template_directory_uri().'/assets/js/'. $script, array( 'jquery' ), ZANTE_THEME_VERSION, true );
    }

	  // ENQUEUE GOOGLE MAP
		if (!empty(zante_get_option('google_map_api_key'))) {
			wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key='.zante_get_option('google_map_api_key').'');
		}

		// ENQUEUE DYNAMIC JS
		wp_localize_script( 'zante-main', 'zante_js_settings', zante_get_js_settings() );

}
