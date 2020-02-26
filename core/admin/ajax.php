<?php
/* --------------------------------------------------------------------------
 * Hide update notification and update theme version
 * @since  1.0.0
 ---------------------------------------------------------------------------*/

add_action('wp_ajax_zante_update_version', 'zante_update_version');

if(!function_exists('zante_update_version')):
function zante_update_version(){
	update_option('ZANTE_THEME_VERSION', ZANTE_THEME_VERSION);
	die();
}
endif;

/* --------------------------------------------------------------------------
 * Hide welcome notification
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
add_action('wp_ajax_zante_hide_welcome', 'zante_hide_welcome');

if(!function_exists('zante_hide_welcome')):
function zante_hide_welcome(){
	update_option('zante_welcome_box_displayed', true);
	die();
}
endif;
