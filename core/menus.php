<?php

/* --------------------------------------------------------------------------
 * Register Menus
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
add_action('init', 'zante_register_menus');

if (!function_exists('zante_register_menus')) :
    function zante_register_menus() {
      register_nav_menus(
        array(
          'zante_main_menu' => esc_html__('Main Menu', 'zante'),
        )
      );
    }
endif;
 
