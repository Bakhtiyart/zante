<?php
/* --------------------------------------------------------------------------
* Theme Options.
* @since  1.0.0
---------------------------------------------------------------------------*/
if (! class_exists('Redux')) {
    return;
}

$opt_name = 'zante_settings';

$theme = wp_get_theme();

//Load demo importer
if (class_exists('zante_demo_importer')) {
    add_action('redux/extensions/'. $opt_name .'/before', array('zante_demo_importer', 'zante_register_extension_loader'), 0);
}

/*-----------------------------------------------------------------------------------*/
//  Redux Framework options
/*-----------------------------------------------------------------------------------*/
$args = array(
    'opt_name'             => $opt_name,
    'display_name'         => THEME_NAME,
    'display_version'      => ZANTE_THEME_VERSION,
    'menu_type'            => 'menu',
    'allow_sub_menu'       => true,
    'menu_title'           => esc_html__('Zante', 'zante'),
    'page_title'           => esc_html__('Zante Options', 'zante'),
    'google_api_key'       => '',
    'google_update_weekly' => false,
    'async_typography'     => true,
    'admin_bar'            => true,
    'admin_bar_icon'       => 'zante-icon',
    'admin_bar_priority'   => '100',
    'global_variable'      => '',
    'dev_mode'             => false,
    'update_notice'        => false,
    'customizer'           => true,
    'allow_tracking'       => false,
    'ajax_save'            => true,
    'page_priority'        => '75',
    'page_parent'          => 'themes.php',
    'page_permissions'     => 'manage_options',
    'menu_icon'            =>  get_template_directory_uri().'/assets/images/admin/menu_icon.png',
    'last_tab'             => '',
    'page_icon'            => 'icon-themes',
    'page_slug'            => 'zante_options',
    'save_defaults'        => true,
    'default_show'         => false,
    'default_mark'         => '',
    'show_import_export'   => true,
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => false,
    'output_tag'           => true,
    'database'             => '',
    'system_info'          => false,
    'footer_credit'        => ' ',
);

$GLOBALS['redux_notice_check'] = 1;

/*-----------------------------------------------------------------------------------*/
//  Footer social icons
/*-----------------------------------------------------------------------------------*/
$args['share_icons'][] = array(
    'url'   => 'https://www.facebook.com/eaglethemescom/',
    'title' => 'Like us on Facebook',
    'icon'  => 'el-icon-facebook'
);

$args['share_icons'][] = array(
    'url'   => 'https://www.instagram.com/eaglethemes/',
    'title' => 'eagle-themes.com',
    'icon'  => 'el el-instagram'
);

$args['share_icons'][] = array(
    'url'   => 'https://eagle-themes.com/',
    'title' => 'eagle-themes.com',
    'icon'  => 'el el-link'
);

$args['intro_text'] = '';
$args['footer_text'] = '';

/*-----------------------------------------------------------------------------------*/
//  Initialize Redux
/*-----------------------------------------------------------------------------------*/
Redux::setArgs($opt_name, $args);

/*-----------------------------------------------------------------------------------*/
//  Load Custom CSS
/*-----------------------------------------------------------------------------------*/
if (!function_exists('zante_redux_custom_css')) :
    function zante_redux_custom_css()
    {
        wp_register_style('zante-redux-custom', get_template_directory_uri().'/assets/css/admin/options.css', array( 'redux-admin-css' ), ZANTE_THEME_VERSION, 'all');
        wp_enqueue_style('zante-redux-custom');
    }
endif;

add_action('redux/page/zante_settings/enqueue', 'zante_redux_custom_css');

/*-----------------------------------------------------------------------------------*/
// Remove redux framework admin page
/*-----------------------------------------------------------------------------------*/
if (!function_exists('zante_remove_redux_page')) :
    function zante_remove_redux_page()
    {
        remove_submenu_page('tools.php', 'redux-about');
    }
endif;

add_action('admin_menu', 'zante_remove_redux_page', 99);

/*-----------------------------------------------------------------------------------*/
// Add Sidebar generator custom field to redux
/*-----------------------------------------------------------------------------------*/
if (!function_exists('zante_sidgen_field_path')) :
    function zante_sidgen_field_path($field)
    {
        return get_template_directory() . '/include/custom-fields/field_sidgen.php';
    }
endif;

add_filter("redux/zante_settings/field/class/sidgen", "zante_sidgen_field_path");


/*-----------------------------------------------------------------------------------*/
// Remove plugin redirect
/*-----------------------------------------------------------------------------------*/
if (! function_exists('remove_redux_plugin_redirect')) {
    function remove_redux_plugin_redirect()
    {
        ReduxFramework::$_as_plugin = false;
    }
}

add_action('redux/construct', 'remove_redux_plugin_redirect');

/*-----------------------------------------------------------------------------------*/
// Start Options Fields
/*-----------------------------------------------------------------------------------*/
/* Header */
Redux::setSection(
    $opt_name,
    array(
    'icon'             => ' el-icon-lines',
    'title'            => esc_html__('Header', 'zante'),
    'fields'           => array(

    array(
        'id'          => 'logo',
        'type'        => 'media',
        'url'         => false,
        'title'       => esc_html__('Logo', 'zante'),
        'default'     => array( 'url' => esc_url(get_template_directory_uri().'/assets/images/logo.svg') ),
    ),

    array(
        'id'          => 'logo_light',
        'type'        => 'media',
        'url'         => false,
        'title'       => esc_html__('Light Logo (Optional)', 'zante'),
        'subtitle'    => esc_html__('Logo for the transparent header.', 'zante'),
        'default'     => array( 'url' => esc_url(get_template_directory_uri().'/assets/images/logo-white.svg') ),
    ),

    array(
      'id'          => 'header_sticky',
      'type'        => 'switch',
      'title'       => esc_html__('Sticky Header', 'zante'),
      'subtitle'    => esc_html__("This option can be overridden on each page's layout option.", 'zante'),
      'default'     => true,
    ),

    array(
      'id'          => 'header_transparent',
      'type'        => 'switch',
      'title'       => esc_html__('Enable Transparent Header', 'zante'),
      'subtitle'    => esc_html__("This option can be overridden on each page's layout option.", 'zante'),
      'default'     => false,
    ),

    array(
      'id'          => 'logo_height',
      'type'        => 'text',
      'class'       => 'small-text',
      'title'       => esc_html__('Logo Height', 'zante'),
      'desc'        => esc_html__('Note: Logo Height value is in px.', 'zante'),
      'default'     => '32',
    ),

    array(
        'id'          => 'logo_padding',
        'type'        => 'text',
        'class'       => 'small-text',
        'title'       => esc_html__('Logo Top/Bottom Padding', 'zante'),
        'desc'        => esc_html__('Note: Padding value is in px. (min. 1px)', 'zante'),
        'default'     => '0',
    ),

    array(
      'id'          => 'logo_margin_top',
      'type'        => 'text',
      'class'       => 'small-text',
      'title'       => esc_html__('Logo Margin Top (Deprecated - Use Padding)', 'zante'),
      'desc'        => esc_html__('Note: Logo margin value is in px.', 'zante'),
      'default'     => '',
    ),

    array(
      'id'          => 'header_bg',
      'type'        => 'color',
      'title'       => esc_html__('Background Color', 'zante'),
      'transparent' => false,
      'default'     => '',
    ),

    array(
      'id'          => 'header_border',
      'type'        => 'color',
      'title'       => esc_html__('Bottom Border Color', 'zante'),
      'transparent' => false,
      'default'     => '',
    ),

    array(
      'id'          => 'menu_color',
      'type'        => 'link_color',
      'title'       => esc_html__('Main Menu Color', 'zante'),
      'default'     => array(
          'regular' => '',
          'hover'   => '',
          'active'  => '',
      ),
    ),

    array(
      'id'          => 'submenu_bg',
      'type'        => 'color',
      'title'       => esc_html__('Sub Menu Background Color', 'zante'),
      'transparent' => false,
      'default'     => '',
    ),

    array(
      'id'          => 'submenu_hover_bg',
      'type'        => 'color',
      'title'       => esc_html__('Sub Menu Background Hover Color', 'zante'),
      'transparent' => false,
      'default'     => '',
    ),

    array(
      'id'          => 'submenu_border',
      'type'        => 'color',
      'title'       => esc_html__('Sub Menu Border Color', 'zante'),
      'transparent' => false,
      'default'     => '',
    ),

    array(
      'id'          => 'submenu_color',
      'type'        => 'link_color',
      'title'       => esc_html__('Sub Menu Color', 'zante'),
      'default'     => array(
          'regular' => '',
          'hover'   => '',
          'active'  => '',
      ),

    ),

    array(
    'id'          => 'topbar',
    'type'        => 'switch',
    'title'       => esc_html__('Enable Top Bar', 'zante'),
    'subtitle'    => esc_html__("This option can be overridden on each page's layout option", 'zante'),
    'default'     => false
    ),
    array(
    'id'          => 'topbar_transparent',
    'type'        => 'switch',
    'title'       => esc_html__('Transparent Top Bar', 'zante'),
    'subtitle'    => esc_html__("This option can be overridden on each page's layout option", 'zante'),
    'default'     => false,
    'required'    => array( 'topbar', '=', true ),
    ),

    array(
    'id'          => 'topbar_bg',
    'type'        => 'color',
    'title'       => esc_html__('Top Bar Background Color', 'zante'),
    'default'     => '',
    'transparent' => false,
    'required'    => array( 'topbar', '=', true ),
    ),

    array(
    'id'          => 'topbar_border',
    'type'        => 'color',
    'title'       => esc_html__('Top Bar Border Color', 'zante'),
    'default'     => '',
    'transparent' => false,
    'required'    => array( 'topbar', '=', true ),
    ),

    array(
    'id'          => 'topbar_color',
    'type'        => 'link_color',
    'title'       => esc_html__('Top Bar Color', 'zante'),
    'default'     => array(
    'regular' => '',
    'hover'   => '',
    'active'  => '',
    ),
    'required'    => array( 'topbar', '=', true ),
    ),

    array(
    'id'          => 'topbar_welcome_mssg',
    'type'        => 'text',
    'title'       => esc_html__('Welcome Message', 'zante'),
    'subtitle'    => esc_html__('Please enter your welcome message', 'zante'),
    'required'    => array( 'topbar', '=', true ),
    ),

    array(
    'id'          => 'topbar_phone',
    'type'        => 'text',
    'title'       => esc_html__('Phone', 'zante'),
    'subtitle'    => esc_html__('Please enter your phone number', 'zante'),
    'required'    => array( 'topbar', '=', true ),
    ),
    array(
    'id'          => 'topbar_phone_link',
    'type'        => 'text',
    'title'       => esc_html__('Phone Link', 'zante'),
    'subtitle'    => esc_html__('Please enter your phone number link', 'zante'),
    'required'    => array( 'topbar', '=', true ),
    ),

    array(
    'id'          => 'topbar_email',
    'type'        => 'text',
    'title'       => esc_html__('Email', 'zante'),
    'subtitle'    => esc_html__('Please enter your Email', 'zante'),
    'required'    => array( 'topbar', '=', true ),
    ),

    array(
    'id'         => 'topbar_mobile_elements',
    'type'       => 'checkbox',
    'multi'      => true,
    'title'      => esc_html__('Hide on Mobile', 'zante'),
    'subtitle'   => esc_html__('Hide or show top bar elements when viewing on a mobile device.', 'zante'),
    'options'    => array(
        'topbar_welcome_mssg_mobile' => esc_html__('Welcome Message', 'zante'),
        'topbar_phone_mobile'     => esc_html__('Phone', 'zante'),
        'topbar_email_mobile'   => esc_html__('Email', 'zante'),
    ),
    'required'    => array( 'topbar', '=', true ),
    'default' => array(
        'topbar_welcome_mssg_mobile' => '1',
        'topbar_phone_mobile' => '0',
        'topbar-email_mobile' => '0'
    )

    ),

     )
    )
);



/* Typography */
Redux::setSection(
    $opt_name,
    array(

    'icon'             => 'el-icon-fontsize',
    'title'            => esc_html__('Typography', 'zante'),
    'desc'             => esc_html__('Manage fonts and typography settings', 'zante'),
    'fields'           => array(

        array(
            'id'          => 'main_font',
            'type'        => 'typography',
            'title'       => esc_html__('Main text font', 'zante'),
            'google'      => true,
            'font-backup' => false,
            'font-size'   => false,
            'color'       => false,
            'line-height' => false,
            'text-align'  => false,
            'units'       =>'px',
            'subtitle'    => esc_html__('This is your main font, used for standard text', 'zante'),
            'default'     => array(
                'google'       => true,
                'font-weight'  => '400',
                'font-family'  => 'Lato',
                'subsets'      => 'latin-ext'
            ),
            'preview'     => array(
                'always_display' => true,
                'font-size'      => '14px',
                'line-height'    => '26px',
                'text'           => 'This is an example of how a simple paragraph of text will look like on your website.'
            )
        ),

        array(
            'id'          => 'h_font',
            'type'        => 'typography',
            'title'       => esc_html__('Headings font', 'zante'),
            'google'      => true,
            'font-backup' => false,
            'font-size'   => false,
            'all_styles'  => true,
            'color'       => false,
            'line-height' => false,
            'text-align'  => false,
            'units'       =>'px',
            'subtitle'    => esc_html__('This is a font used for titles and headings', 'zante'),
            'default'     => array(
                'google'       => true,
                'font-weight'  => '700',
                'font-family'  => 'Nunito',
                'subsets'      => 'latin-ext',
            ),
            'preview'     => array(
                'always_display' => true,
                'font-size'      => '14px',
                'line-height'    => '50px',
                'text'           => 'THIS IS AN EXAMPLE OF HOW A TITLES AND HEADINGS WILL LOOK LIKE ON YOUR SITE'
            )

        ),

        array(
            'id'          => 'nav_font',
            'type'        => 'typography',
            'title'       => esc_html__('Navigation font', 'zante'),
            'google'      => true,
            'font-backup' => false,
            'font-size'   => false,
            'color'       => false,
            'line-height' => false,
            'text-align'  => false,
            'units'       =>'px',
            'subtitle'    => esc_html__('This is a font used for main website navigation', 'zante'),
            'default'     => array(
                'font-weight'  => '900',
                'font-family'  => 'Roboto',
                'subsets'      => 'latin-ext'
            ),

            'preview'     => array(
                'always_display' => true,
                'font-size'      => '14px',
                'text'           => 'HOME &nbsp;&nbsp; ROOMS &nbsp;&nbsp; ABOUT &nbsp;&nbsp;BLOG &nbsp;&nbsp;CONTACT'
            )

            ),

        array(
            'id'          => 'font_size',
            'type'        => 'spinner',
            'title'       => esc_html__('Main text font size', 'zante'),
            'subtitle'    => esc_html__('This is your default text font size', 'zante'),
            'default'     => '15',
            'min'         => '10',
            'step'        => '1',
            'max'         => '22',
        ),


        array(
            'id'          => 'font_size_nav',
            'type'        => 'spinner',
            'title'       => esc_html__('Navigation font size', 'zante'),
            'subtitle'    => esc_html__('Applies to main website navigation', 'zante'),
            'default'     => '15',
            'min'         => '10',
            'step'        => '1',
            'max'         => '20',
        ),


        array(
            'id'         => 'font_size_h1',
            'type'       => 'spinner',
            'title'      => esc_html__('H1 font size', 'zante'),
            'subtitle'   => esc_html__('Applies to H1 elements', 'zante'),
            'default'    => '34',
            'min'        => '20',
            'step'       => '1',
            'max'        => '60',
        ),

        array(
            'id'         => 'font_size_h2',
            'type'       => 'spinner',
            'title'      => esc_html__('H2 font size', 'zante'),
            'subtitle'   => esc_html__('Applies to H2 elements', 'zante'),
            'default'    => '30',
            'min'        => '18',
            'step'       => '1',
            'max'        => '55',
        ),

        array(
            'id'         => 'font_size_h3',
            'type'       => 'spinner',
            'title'      => esc_html__('H3 font size', 'zante'),
            'subtitle'   => esc_html__('Applies to H3 elements', 'zante'),
            'default'    => '26',
            'min'        => '16',
            'step'       => '1',
            'max'        => '45',
        ),

        array(
            'id'         => 'font_size_h4',
            'type'       => 'spinner',
            'title'      => esc_html__('H4 font size', 'zante'),
            'subtitle'   => esc_html__('Applies to H4 elements', 'zante'),
            'default'    => '22',
            'min'        => '14',
            'step'       => '1',
            'max'        => '40',
        ),

        array(
            'id'         => 'font_size_h5',
            'type'       => 'spinner',
            'title'      => esc_html__('H5 font size', 'zante'),
            'subtitle'   => esc_html__('Applies to H5 elements', 'zante'),
            'default'    => '20',
            'min'        => '12',
            'step'       => '1',
            'max'        => '30',
        ),

        array(
            'id'         => 'font_size_h6',
            'type'       => 'spinner',
            'title'      => esc_html__('H6 font size', 'zante'),
            'subtitle'   => esc_html__('Applies to H6 elements', 'zante'),
            'default'    => '18',
            'min'        => '10',
            'step'       => '1',
            'max'        => '20',
        ),

     )
    )
);


/* Stylings */
Redux::setSection(
    $opt_name,
    array(

    'icon'             => 'el-icon-brush',
    'title'            => esc_html__('Color Scheme', 'zante'),
    'fields'           => array(

        array(
            'id'          => 'primary_color',
            'type'        => 'link_color',
            'title'       => esc_html__('Primary Color', 'zante'),
            'title'       => esc_html__('Main Color Scheme', 'zante'),
            'default'     => array(
                'regular' => '#deb666',
                'hover'   => '#b69854',
                'active'  => '#b69854',
            ),
        ),

        array(
            'id'          => 'body_background_color',
            'type'        => 'color',
            'title'       => esc_html__('Body Background Color', 'zante'),
            'transparent' => false,
            'default'     => '#ffffff',
        ),

        array(
            'id'          => 'body_text_color',
            'type'        => 'color',
            'title'       => esc_html__('Body Text Color', 'zante'),
            'transparent' => false,
            'default'     => '#858a99',
        ),

        array(
            'id'          => 'heading_color',
            'type'        => 'color',
            'title'       => esc_html__('Heading Color', 'zante'),
            'transparent' => false,
            'default'     => '#606060',
        ),

     )
    )
);

/* Settings */
Redux::setSection(
    $opt_name,
    array(

    'icon'            => 'el-icon-cog',
    'title'           => esc_html__('Settings', 'zante'),
    'desc'            => esc_html__('These are some additional miscellaneous theme settings', 'zante'),
    'fields'          => array(

      array(
          'id'         => 'layout',
          'type'       => 'button_set',
          'title'      => esc_html__('Layout', 'zante'),
          'subtitle'   => esc_html__('Choose your site layout', 'zante'),
          'multi'      => false,
          'options'    => array(
              'wide'   => 'Wide',
              'boxed'  => 'Boxed',
           ),
          'default'    => 'wide'
      ),

      array(
            'id'         => 'boxed_bg',
            'type'       => 'media',
            'title'      => esc_html__('Background Image', 'zante'),
            'subtitle'   => esc_html__('Upload your background image', 'zante'),
            'default'    => array( 'url' => esc_url(get_template_directory_uri().'/assets/images/boxed_bg.jpg') ),
            'required'   => array( 'layout', '=', 'boxed' )
        ),

        array(
            'id'         => 'preloader',
            'type'       => 'switch',
            'title'      => esc_html__('Preloader', 'zante'),
            'subtitle'   => esc_html__('Enable Preloader', 'zante'),
            'default'    => false
        ),

        array(
            'id'         => 'preloader_home',
            'type'       => 'switch',
            'title'      => esc_html__('Preloader only on Home Page', 'zante'),
            'subtitle'   => esc_html__('Enable Preloader on Home Page', 'zante'),
            'required'   => array( 'preloader', '=', true ),
            'default'    => false
        ),

        array(
            'id'           => 'preloader_style',
            'type'         => 'radio',
            'title'        => esc_html__('Preloader Style', 'zante'),
            'options'      => array(
                'style1'   => esc_html__('Style 1', 'zante'),
                'style2'   => esc_html__('Style 2', 'zante'),
                'style3'   => esc_html__('Style 3', 'zante')
            ),
            'default'      => 'style1',
            'required'   => array( 'preloader', '=', true ),
        ),

        array(
            'id'         => 'preloader_color',
            'type'       => 'color',
            'title'      => esc_html__('Preloader Color', 'zante'),
            'default'    => '#deb666',
            'transparent'=> false,
            'required'   => array( 'preloader', '=', true )
        ),

        array(
            'id'         => 'gradient_overlay',
            'type'       => 'switch',
            'title'      => esc_html__('Gradient Overlay', 'zante'),
            'subtitle'   => esc_html__('Show gradient overlay', 'zante'),
            'default'    => true
        ),

        array(
            'id'         => 'back-to-top',
            'type'       => 'switch',
            'title'      => esc_html__('Back to Top Button', 'zante'),
            'subtitle'      => esc_html__('Enable the back to top button on your pages', 'zante'),
            'default'    => true
        ),

        array(
            'id'         => 'back-to-top-mobile',
            'type'       => 'switch',
            'title'      => esc_html__('Back to Top Button on Mobile', 'zante'),
            'subtitle'   => esc_html__('Enable the back to top button when viewing on a mobile device.', 'zante'),
            'default'    => true
        ),

        array(
            'id'         => 'back-to-top-side',
            'type'       => 'button_set',
            'title'      => esc_html__('Back to Top Button Side', 'zante'),
            'subtitle'      => esc_html__('Choose the side to display the back to top button', 'zante'),
            'multi'      => false,
            'options'    => array(
                'left'   => 'Left',
                'right'  => 'Right',
             ),
            'default'    => 'right',
            'required'   => array( 'back-to-top', '=', true )
        ),

     )
    )
);


/* Footer */
Redux::setSection(
    $opt_name,
    array(

    'icon'             => 'el el-minus',
    'title'            => esc_html__('Footer', 'zante'),
    'desc'             => esc_html__('Manage default settings for your Footer', 'zante'),
    'fields'           => array(

      array(
          'id'        => 'footer_layout',
          'type'      => 'image_select',
          'title'     => esc_html__('Footer Columns', 'zante'),
          'subtitle'  => esc_html__('Choose number of columns to display in footer area', 'zante'),
          'desc'  => wp_kses(sprintf(__('Each column represents one Footer Sidebar in <a href="%s" target="_blank">Apperance -> Widgets</a> settings.', 'zante'), admin_url('widgets.php')), wp_kses_allowed_html('post')),
          'options'   => array(
              '1_12'   => array( 'title' => esc_html__('1 Column', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/footer-column-1.png' ),
              '2_6'    => array( 'title' => esc_html__('2 Columns', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/footer-column-2.png' ),
              '3_4'    => array( 'title' => esc_html__('3 Columns', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/footer-column-3.png' ),
              '4_3'    => array( 'title' => esc_html__('4 Columns', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/footer-column-4.png' ),
          ),
          'default'   => '4_3',
          //'required' => array( 'footer_widgets', '=', true )
      ),

        array(
            'id'          => 'footer_bg',
            'type'        => 'color',
            'title'       => esc_html__('Footer Background Color', 'zante'),
            'default'     => '#ffffff',
            'transparent' => false,
        ),

        array(
            'id'          => 'footer_border',
            'type'        => 'color',
            'title'       => esc_html__('Footer Border Color', 'zante'),
            'default'     => '#f0f0f0',
            'transparent' => false,

        ),

        array(
            'id'          => 'footer_text_color',
            'type'        => 'color',
            'title'       => esc_html__('Footer Primary Color', 'zante'),
            'default'     => '#858a99',
            'transparent' => false,
        ),

        array(
            'id'          => 'footer_links_color',
            'type'        => 'link_color',
            'title'       => esc_html__('Footer Links Color', 'zante'),
            'default'     => array(
                'regular' => '#858a99',
                'hover'   => '#deb666',
                'active'  => '#deb666',
            ),
        ),

      array(
          'id'          => 'footer_copyright_bg',
          'type'        => 'color',
          'title'       => esc_html__('Copyright Background Color', 'zante'),
          'default'     => '#fff',
          'transparent' => false,
      ),

      array(
          'id' => 'footer_copyright',
          'type' => 'text',
          'title' => __('Footer Copyright Section Text', 'zante'),
          'subtitle' => __('Please enter the copyright section text. e.g. &copy; 2018 Hotel Zante. All Rights Reserved', 'zante'),
      ),


        array(
            'id'          => 'footer_copyright_text_color',
            'type'        => 'color',
            'title'       => esc_html__('Footer Copyright Text Color', 'zante'),
            'subtitle'    => esc_html__('Choose a color for your copyright text', 'zante'),
            'default'     => '#858a99',
            'transparent' => false,
        ),

        array(
            'id'          => 'footer_facebook_link',
            'type'        => 'text',
            'title'       => esc_html__('Facebook Link', 'zante'),
            'subtitle'    => esc_html__('Please enter your Facebook URL', 'zante'),
        ),

        array(
            'id'          => 'footer_twitter_link',
            'type'        => 'text',
            'title'       => esc_html__('Twitter Link', 'zante'),
            'subtitle'    => esc_html__('Please enter your Twitter URL', 'zante'),
        ),

        array(
            'id'          => 'footer_youtube_link',
            'type'        => 'text',
            'title'       => esc_html__('Youtube Link', 'zante'),
            'subtitle'    => esc_html__('Please enter your Youtube URL', 'zante'),
        ),

        array(
            'id'          => 'footer_instagram_link',
            'type'        => 'text',
            'title'       => esc_html__('Instagram Link', 'zante'),
            'subtitle'    => esc_html__('Please enter your Instagram URL', 'zante'),
        ),

        array(
            'id'          => 'footer_pinterest_link',
            'type'        => 'text',
            'title'       => esc_html__('Pinterest Link', 'zante'),
            'subtitle'    => esc_html__('Please enter your Pinterest URL', 'zante'),
        ),

        array(
            'id'          => 'footer_linkedin_link',
            'type'        => 'text',
            'title'       => esc_html__('Linkedin Link', 'zante'),
            'subtitle'    => esc_html__('Please enter your Linkedin URL', 'zante'),
        ),
     )
    )
);


/* Blog */
Redux::setSection(
    $opt_name,
    array(

    'icon'             => 'el el-th-list',
    'title'            => esc_html__('Blog', 'zante'),
    'desc'             => esc_html__('Manage your Blog', 'zante'),
    'fields'           => array(

    array(
    'id'          => 'blog_sidebar',
    'type'        => 'image_select',
    'title'       => esc_html__('Sidebar', 'zante'),
    'subtitle'    => esc_html__('Select sidebar side for blog pages (index, search, category, tags)', 'zante'),
    'options'     => array(
        'left'    => array( 'title' => esc_html__('Left', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/sidebar-left.png' ),
        'none'    => array( 'title' => esc_html__('None', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/sidebar-none.png' ),
        'right'   => array( 'title' => esc_html__('Right', 'zante'),    'img' =>  get_template_directory_uri().'/assets/images/admin/sidebar-right.png' ),
    ),
    'default'     => 'right',
    ),

    array(
    'id'          => 'post_excerpt_limit',
    'type'        => 'text',
    'class'       => 'small-text',
    'title'       => esc_html__('Excerpt limit', 'zante'),
    'subtitle'    => esc_html__('Specify your excerpt limit', 'zante'),
    'desc'        => esc_html__('Note: Value represents number of characters', 'zante'),
    'default'     => '300',
    'validate'    => 'numeric',
    ),

    array(
    'id'         => 'blog_page_header',
    'type'       => 'switch',
    'title'      => esc_html__('Archive Page Header', 'zante'),
    'subtitle'      => esc_html__('Enable the page header for archive pages (index, single, search, category, tags)', 'zante'),
    'default'    => true
    ),

    array(
    'id'          => 'single_post_tags',
    'type'        => 'switch',
    'title'       => esc_html__('Tags', 'zante'),
    'subtitle'    => esc_html__('Check if you want to display tags', 'zante'),
    'default'     => false
    ),

    array(
    'id'          => 'single_post_share',
    'type'        => 'switch',
    'title'       => esc_html__('Share Buttons', 'zante'),
    'subtitle'    => esc_html__('Check if you want to display share buttons', 'zante'),
    'default'     => false
    ),

    array(
    'id'          => 'single_post_author',
    'type'        => 'switch',
    'title'       => esc_html__('About Author', 'zante'),
    'subtitle'    => esc_html__('Check if you want to display the about author area', 'zante'),
    'default'     => true
    ),


     )

    )
);

/* Page */
Redux::setSection(
    $opt_name,
    array(

    'icon'             => 'el el-file',
    'title'            => esc_html__('Page', 'zante'),
    'desc'             => esc_html__('Manage your Page', 'zante'),
    'fields'           => array(


      array(
          'id'         => 'page_header',
          'type'       => 'button_set',
          'title'      => esc_html__('Page Header', 'zante'),
          'subtitle'   => esc_html__('Choose Page Header Style', 'zante'),
          'multi'      => false,
          'options'    => array(
              'color'  => 'Color Background',
              'image'  => 'Image Background',
           ),
          'default'    => 'image'
      ),

      array(
            'id'         => 'page_header_image_bg',
            'type'       => 'media',
            'title'      => esc_html__('Background Image', 'zante'),
            'subtitle'   => esc_html__('Upload your background image', 'zante'),
            'default'    => array( 'url' => esc_url(get_template_directory_uri().'/assets/images/page-header-bg.jpg') ),
            'required'   => array( 'page_header', '=', 'image' )
        ),

        array(
              'id'         => 'page_header_color_bg',
              'type'        => 'color',
              'title'       => esc_html__('Page Header Background Color', 'zante'),
              'transparent' => false,
              'default'     => '#deb666',
              'required'   => array( 'page_header', '=', 'color' )
          ),

        array(
          'id'          => 'breadcrumb_page',
          'type'        => 'switch',
          'title'       => esc_html__('Display Breadcrumb', 'zante'),
          'subtitle'    => esc_html__('Check if you want to display breadcrumb area on pages', 'zante'),
          'default'     => true,
      ),

        array(
        'id'          => 'page_sidebar',
        'type'        => 'image_select',
        'title'       => esc_html__('Sidebar', 'zante'),
        'subtitle'    => esc_html__('Select sidebar side for pages', 'zante'),
        'options'     => array(
            'left'    => array( 'title' => esc_html__('Left', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/sidebar-left.png' ),
            'none'    => array( 'title' => esc_html__('None', 'zante'), 'img' =>  get_template_directory_uri().'/assets/images/admin/sidebar-none.png' ),
            'right'   => array( 'title' => esc_html__('Right', 'zante'),    'img' =>  get_template_directory_uri().'/assets/images/admin/sidebar-right.png' ),
        ),
        'default'     => 'none',
    ),

     )
    )
);

/* Google Map */
Redux::setSection(
    $opt_name,
    array(

    'icon'            => 'el el-map-marker',
    'title'           => esc_html__('Google Map', 'zante'),
    'fields'          => array(

        array(
            'id'         => 'google_map_api_key',
            'type'       => 'text',
            'title'      => esc_html__('API Key', 'zante'),
            'desc'   => wp_kses(sprintf(__('<a href="%s" target="_blank">Getting Google Maps API Key</a>.', 'zante'), 'https://docs.eagle-themes.com/kb/getting-google-maps-api-key/'), wp_kses_allowed_html('post')),
        ),

     )
    )
);

/* Additional code */
Redux::setSection(
    $opt_name,
    array(

        'icon'        => 'el-icon-css',
        'title'       => esc_html__('Additional Code', 'zante'),
        'desc'        =>  esc_html__('These options are for advanced users only, so use it with caution.', 'zante'),
        'fields'      => array(

        array(
            'id'         => 'additional_css',
            'type'       => 'ace_editor',
            'title'      => esc_html__('Additional CSS', 'zante'),
            'subtitle'   => esc_html__('Use this field to add CSS code and modify the default theme styling', 'zante'),
            'mode'       => 'css',
            'theme'      => 'monokai',
            'default'    => ''
        ),

        array(
            'id'         => 'additional_js',
            'type'       => 'ace_editor',
            'title'      => esc_html__('Additional JavaScript', 'zante'),
            'subtitle'   => esc_html__('Use this field to add JavaScript code', 'zante'),
            'desc'       => esc_html__('Note: Please use clean execution JavaScript code without "script" tags', 'zante'),
            'mode'       => 'javascript',
            'theme'      => 'monokai',
            'default'    => ''
        )
     )
    )
);


/* Translation */
$translate_options[] = array(
    'id'                 => 'translation_type',
    'type'               => 'button_set',
    'title'              => esc_html__('Translation Type', 'zante'),
    'subtitle'   => wp_kses(sprintf(__('Please note: Built-in translation has been deprecated, please use a string translation plugin to translate the theme.<a href="%s" target="_blank"> How to translate the theme</a>.', 'zante'), 'https://docs.eagle-themes.com/kb/zante/theme-translation/'), wp_kses_allowed_html('post')),
    'multi'      => false,
    'options'    => array(
        'builtin'  => 'Theme Built-in (Deprecated)',
        'plugin'  => 'Plugin (WPML or Polylang)',
     ),

     'default'    => 'builtin'
);

$translate_options[] = array(
  'id'         => 'top_bar_language_switcher',
  'type'       => 'checkbox',
  'multi'      => false,
  'title'      => esc_html__('Display Language Switcher in the top bar for', 'zante'),
  'subtitle'   => esc_html__('Make sure that you have installed and you have activated the specific plugin.', 'zante'),
  'options'    => array(
      'wpml' => esc_html__('WPML', 'zante'),
      'polylang'     => esc_html__('Polylang', 'zante'),
  ),
  'required'   => array( 'translation_type', '=', 'plugin' )
);

$translate_options[] = array(
  'id'         => 'footer_language_switcher',
  'type'       => 'checkbox',
  'multi'      => false,
  'title'      => esc_html__('Display Language Switcher in the footer for', 'zante'),
  'subtitle'   => esc_html__('Make sure that you have installed and you have activated the specific plugin.', 'zante'),
  'options'    => array(
      'wpml' => esc_html__('WPML', 'zante'),
      'polylang'     => esc_html__('Polylang', 'zante'),
  ),
  'required'   => array( 'translation_type', '=', 'plugin' )
);


$translate_strings = zante_get_translate_options();

foreach ($translate_strings as $string_key => $string) {
    $translate_options[] = array(
        'id'             => 'tr_'.$string_key,
        'type'           => 'text',
        'title'          => esc_html($string['text']),
        'subtitle'       => isset($string['desc']) ? $string['desc'] : '',
        'default'        => '',
        'required'   => array( 'translation_type', '=', 'builtin' )
    );
}

Redux::setSection(
    $opt_name,
    array(

        'icon'           => 'el-icon-globe-alt',
        'title'          => esc_html__('Translation', 'zante'),
        'desc'   => wp_kses(__('- Select Theme Builtin to quickly translate or change the text in this theme. If you want to remove the text completely instead of modifying it, you can use <strong>"-1"</strong> as a value for particular field translation. <br/><br/>- Select Plugin for a multilingual website and use multilanguage plugins (such as WPML or Polylang) and manual translation with .po and .mo files located inside the "languages" folder.', 'zante'), wp_kses_allowed_html('post')),
        'fields'         => $translate_options
    )
);


/* Performance */
Redux::setSection(
    $opt_name,
    array(

    'icon'            => 'el-icon-dashboard',
    'title'           => esc_html__('Performance', 'zante'),
    'desc'            => esc_html__('Use these options to put your theme to a high speed as well as save your server resources!', 'zante'),
    'fields'          => array(

        array(
            'id'         => 'disable_img_sizes',
            'type'       => 'checkbox',
            'multi'      => true,
            'title'      => esc_html__('Disable additional image sizes', 'zante'),
            'subtitle'   => esc_html__('By default, theme generates additional image size for each of the layouts it offers. You can use this option to avoid creating additional sizes if you are not using particular layout in order to save your server space.', 'zante'),
            'options'    => array(
                'zante_image_size_480_480'     => esc_html__('480 x 480', 'zante'),
                'zante_image_size_400_800'     => esc_html__('400 x 800', 'zante'),
                'zante_image_size_720_520'     => esc_html__('720 x 520', 'zante'),
                'zante_image_size_1170_650'   => esc_html__('1170 x 650', 'zante'),
                'zante_image_size_1920_800'   => esc_html__('1920 x 800', 'zante'),
            ),

            'default' => array()
        ),
     )
    )
);

/**
 * Message set home page as static page
*/
if (get_option('show_on_front') != 'page') {
    $info = array(
                'id' => 'home_setup_info',
                'type' => 'info',
                'style' => 'critical',
                'title' => esc_html__('Important note:', 'zante'),
                'subtitle' => wp_kses_post(sprintf(__('Your front page is currently set to display <strong>"latest posts"</strong>. In order to use these options, you need to set your front page option as <strong>"static page"</strong> inside <a href="%s" target="_blank">Settings => Reading</a>.', 'zante'), admin_url('options-reading.php'))),
            );
} else {
    $info = array();
}
