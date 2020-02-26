<?php

add_action( 'admin_enqueue_scripts', 'zante_load_admin_scripts' );

/* --------------------------------------------------------------------------
 * Load CSS & JS in admin
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
function zante_load_admin_scripts() {
	zante_load_admin_css();
	zante_load_admin_js();
}

/* --------------------------------------------------------------------------
 * Load CSS in admin
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
function zante_load_admin_css() {

	global $pagenow, $typenow;

	wp_enqueue_style( 'zante-global', get_template_directory_uri() . '/assets/css/admin/global.css', false, ZANTE_THEME_VERSION, 'screen, print' );
}

/* --------------------------------------------------------------------------
 * Load JS in admin
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
function zante_load_admin_js() {

	global $pagenow, $typenow;

	wp_enqueue_script( 'zante-global', get_template_directory_uri().'/assets/js/admin/global.js', array( 'jquery' ), ZANTE_THEME_VERSION );

	if( $pagenow == 'widgets.php' ){
        wp_enqueue_media();
				wp_enqueue_script( 'zante-admin-js', get_template_directory_uri() . '/assets/js/admin/widgets.js', '', '', true );
	}
}
