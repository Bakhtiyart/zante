<?php
/* --------------------------------------------------------------------------
* Register the required plugins for this theme.
* @since  1.0.0
---------------------------------------------------------------------------*/

// Include the TGM_Plugin_Activation class.

require_once dirname(__FILE__) . '/../../include/tgm/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'zante_required_plugins');

function zante_required_plugins()
{
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => esc_html__('Eagle Core', 'zante') ,
            'slug' => 'eagle-core',
            'source' => 'https://api.eagle-themes.com/download/zante/16an13jo/eagle-core.zip',
            'required' => true,
            'version' => '1.0.9',
        ) ,
        array(
            'name' => esc_html__('Eagle Demo Importer', 'zante') ,
            'slug' => 'eagle-demo-importer',
            'source' => 'https://api.eagle-themes.com/download/zante/16an13jo/eagle-demo-importer.zip',
            'required' => true,
            'version' => '1.0',
        ) ,
        array(
            'name' => esc_html__('Eagle Booking', 'zante') ,
            'slug' => 'eagle-booking',
            'source' => 'https://api.eagle-themes.com/download/zante/16an13jo/eagle-booking.zip',
            'required' => true,
            'version' => '1.2.3',
        ) ,
        array(
            'name' => esc_html__('Revolution Slider', 'zante') ,
            'slug' => 'revslider',
            'source' => 'https://api.eagle-themes.com/download/zante/16an13jo/revslider.zip',
            'required' => true,
            'version' => '6.1.5',
        ) ,
        array(
            'name' => esc_html__('WPBakery Page Builder', 'zante') ,
            'slug' => 'js_composer',
            'source' => 'https://api.eagle-themes.com/download/zante/16an13jo/js_composer.zip',
            'required' => true,
            'version' => '6.0.5',
        ) ,
        array(
            'name' => esc_html__('Envato Market', 'zante') ,
            'slug' => 'envato-market',
            'source' => 'https://api.eagle-themes.com/download/zante/16an13jo/envato-market.zip',
            'required' => true,
            'version' => '2.0.3',
        ) ,
        array(
            'name' => esc_html__('MailChimp for WordPress', 'zante') ,
            'slug' => 'mailchimp-for-wp',
            'required' => true,
        ) ,
        array(
            'name' => esc_html__('Contact Form 7', 'zante') ,
            'slug' => 'contact-form-7',
            'required' => true,
        ) ,
    );

    // Change this to your theme text domain, used for internationalising strings

    $theme_text_domain = 'zante';
    /**
     * Array of configuration settings. Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'domain' => $theme_text_domain, // Text domain - likely want to be the same as your theme.
        'default_path' => '', // Default absolute path to pre-packaged plugins
        'menu' => 'tgmpa-install-plugins', // Menu slug
        'has_notices' => true, // Show admin notices or not
        'is_automatic' => false, // Automatically activate plugins after installation or not
        'message' => '', // Message to output right before the plugins table
        'strings' => array(
            'page_title' => esc_html__('Install Required Plugins', 'zante') ,
            'menu_title' => esc_html__('Install Plugins', 'zante') ,
            'installing' => esc_html__('Installing Plugin: %s', 'zante') , // %1$s = plugin name
            'oops' => esc_html__('Something went wrong with the plugin API.', 'zante') ,
            'notice_can_install_required' => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'zante') , // %1$s = plugin name(s)
            'notice_can_install_recommended' => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'zante') , // %1$s = plugin name(s)
            'notice_cannot_install' => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'zante') , // %1$s = plugin name(s)
            'notice_can_activate_required' => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'zante') , // %1$s = plugin name(s)
            'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'zante') , // %1$s = plugin name(s)
            'notice_cannot_activate' => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'zante') , // %1$s = plugin name(s)
            'notice_ask_to_update' => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'zante') , // %1$s = plugin name(s)
            'notice_cannot_update' => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'zante') , // %1$s = plugin name(s)
            'install_link' => _n_noop('Begin installing plugin', 'Begin installing plugins', 'zante') ,
            'activate_link' => _n_noop('Activate installed plugin', 'Activate installed plugins', 'zante') ,
            'return' => __('Return to Required Plugins Installer', 'zante') ,
            'plugin_activated' => __('Plugin activated successfully.', 'zante') ,
            'complete' => __('All plugins installed and activated successfully. %s', 'zante') , // %1$s = dashboard link
            'nag_type' => 'updated'

            // Determines admin notice type - can only be 'updated' or 'error'

        )
    );
    tgmpa($plugins, $config);
}
