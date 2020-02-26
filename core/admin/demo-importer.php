<?php

/* --------------------------------------------------------------------------
 * Filter for changing importer description info in options panel
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_wbc_filter_desc' ) ):
    function zante_wbc_filter_desc( $description ) {

    $php_version = PHP_VERSION;
    if ($php_version >= '7.3.0') {
      $php_version_class = 'success';
    } else {
      $php_version_class = 'failure';
    }
    $max_execution_time = ini_get('max_execution_time');
    if ($max_execution_time >= '600') {
      $max_execution_time_class = 'success';
    } else {
      $max_execution_time_class = 'failure';
    }

    $memory_limit = ini_get('memory_limit');
    $memory_limit_str = str_replace('M', '', $memory_limit);
    if ($memory_limit_str >= '128') {
      $memory_limit_class = 'success';
    } else {
      $memory_limit_class = 'failure';
    }

    $post_max_size = ini_get('post_max_size');
    $post_max_size_str = str_replace('M', '', $post_max_size);
    if ($post_max_size_str >= '32') {
      $post_max_size_class = 'success';
    } else {
      $post_max_size_class = 'failure';
    }

    $upload_max_filesize = ini_get('upload_max_filesize');
    $upload_max_filesize_str = str_replace('M', '', $upload_max_filesize);
    if ($upload_max_filesize_str >= '32') {
      $upload_max_filesize_class = 'success';
    } else {
      $upload_max_filesize_class = 'failure';
    }

    $message = wp_kses( sprintf( __( 'Important notes: </strong> <br><br>
    - Use this panel to import content from theme demo example(s). If you want to try multiple demos, please use %s plugin to reset your WordPress installation after each import and try another demo afterwards. <br>- Import process will take time needed to download all attachments from the demo web site.', 'zante' ), '<a href="https://wordpress.org/plugins/wordpress-database-reset/" target="_blank">WordPress Database Reset</a>' ), wp_kses_allowed_html( 'post' ) );


    $message .= wp_kses( sprintf( __( '<br>- If the import stalls and fails to respond after a few minutes you are suffering from PHP configuration limits that are set too low to complete the process. More Details about WordPress requirements can be found %s', 'zante' ), '<a href="https://wordpress.org/about/requirements/" target="_blank">here</a>' ), wp_kses_allowed_html( 'post' ) );

    $message .= esc_html__(' You should contact your hosting provider and ask them to increase those limits to a minimum as follows:', 'zante');

   /* --------------------------------------------------------------------------
    * Check Reqiurements
    * @since  1.0.3
    ---------------------------------------------------------------------------*/
    $message .='
    <table class="requirements">
          <thead>
            <th width="40%">'.esc_html__('REQUIREMENT', 'zante').'</th>
            <th>'.esc_html__('REQUIRED VALUE', 'zante').'</th>
            <th width="10%"></th>
            <th>'.esc_html__('CURRENT VALUE', 'zante').'</th>
          </thead>
          <tr class="requirement">
            <td>'.esc_html__('PHP Version', 'zante').'</td>
            <td class="required-value"> 7.3.0 </td>
            <td></td>
            <td class="current-value '.$php_version_class.'">'.$php_version.'</td>
          </tr>
          <tr class="requirement">
            <td>'.esc_html__('max_execution_time', 'zante').' </td>
            <td class="required-value"> 600 </td>
            <td></td>
            <td class="current-value '.$max_execution_time_class.'">'.$max_execution_time.'</td>
          </tr>

         <tr class="requirement">
            <td>'.esc_html__('memory_limit', 'zante').'</td>
            <td class="required-value">128M</td>
            <td></td>
            <td class="current-value '.$memory_limit_class.'">'.$memory_limit.'</td>
        </tr>

        <tr class="requirement">
          <td>'.esc_html__('post_max_size', 'zante').'</td>
          <td class="required-value"> 32M </td>
          <td></td>
          <td class="current-value '.$post_max_size_class.'">'.$post_max_size.'</td>
        </tr>

        <tr class="requirement">
          <td>'.esc_html__('upload_max_filesize', 'zante').'</td>
          <td class="required-value"> 32M </td>
          <td></td>
          <td class="current-value '.$upload_max_filesize_class.'">'.$upload_max_filesize.'</td>
        </tr>

    </table>';

        return $message;
    }
endif;

add_filter( 'wbc_importer_description', 'zante_wbc_filter_desc', 10, 2 );


/* --------------------------------------------------------------------------
 * Demos title filter
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_wbc_filter_demo_title' ) ):
    function zante_wbc_filter_demo_title( $path ) {

        switch ( $path ) {
            case 'zante1': $title = esc_html__( 'Zante Home Version 1', 'zante' ); break;
            case 'zante2': $title = esc_html__( 'Zante Home Version 2', 'zante' ); break;
            case 'zante3': $title = esc_html__( 'Zante Home Version 3', 'zante' ); break;
            case 'zante4': $title = esc_html__( 'Zante Home Version 4', 'zante' ); break;
        default: break;
        }
        return $title;
    }
endif;

add_filter( 'wbc_importer_directory_title', 'zante_wbc_filter_demo_title' );


/* --------------------------------------------------------------------------
 * Way to set menu, import revolution slider, and set home page.
 * @since  1.0.0
 ---------------------------------------------------------------------------*/
if ( !function_exists( 'zante_menu_revolutionslider_homepage_setup' ) ) {
    function zante_menu_revolutionslider_homepage_setup( $demo_active_import , $demo_directory_path ) {
        reset( $demo_active_import );
        $current_key = key( $demo_active_import );

        /* --------------------------------------------------------------------------
        * Import Rev Slider
        * @since  1.0.0
        ---------------------------------------------------------------------------*/
        if ( class_exists( 'RevSlider' ) ) {
            $wbc_sliders_array = array(
                'zante1' => array('rev-slider-1.zip','rev-slider-restaurant.zip', 'rev-slider-spa.zip', 'rev-slider-gallery.zip'),
                'zante2' => array('rev-slider-2.zip','rev-slider-restaurant.zip', 'rev-slider-spa.zip', 'rev-slider-gallery.zip'),
                'zante3' => array('rev-slider-3.zip','rev-slider-restaurant.zip', 'rev-slider-spa.zip', 'rev-slider-gallery.zip'),
                'zante4' => array('rev-slider-4.zip','rev-slider-restaurant.zip', 'rev-slider-spa.zip', 'rev-slider-gallery.zip'),
            );

            if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
                $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

                if( is_array( $wbc_slider_import ) ){
                    foreach ($wbc_slider_import as $slider_zip) {
                        if ( !empty($slider_zip) && file_exists( $demo_directory_path.$slider_zip ) ) {
                            $slider = new RevSlider();
                            $slider->importSliderFromPost( true, true, $demo_directory_path.$slider_zip );
                        }
                    }
                }else{
                    if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                        $slider = new RevSlider();
                        $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
                    }
                }
            }
        }

		     /* --------------------------------------------------------------------------
         * Set Menus
         * @since  1.0.0
         ---------------------------------------------------------------------------*/
    		$wbc_menu_array = array( 'zante1', 'zante2', 'zante3', 'zante4' );
    		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {

    			$main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

    			if ( isset( $main_menu->term_id ) ) {
    				set_theme_mod( 'nav_menu_locations', array(
    						'zante_main_menu' => $main_menu->term_id,
    					)
    				);
    			} else {

              exit();
          }
    		}

        /* --------------------------------------------------------------------------
         * Set Home Page
         * @since  1.0.0
         ---------------------------------------------------------------------------*/
        $wbc_home_pages = array(
            'zante1' => 'Home Page',
            'zante2' => 'Home Page 2',
            'zante3' => 'Home Page 3',
            'zante4' => 'Home Page 4',
        );
        if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
            $page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }

    }

    add_action( 'wbc_importer_after_content_import', 'zante_menu_revolutionslider_homepage_setup', 10, 2 );

}
