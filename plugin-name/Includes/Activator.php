<?php

namespace PluginName\Includes;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

class Activator
{
    private const REQUIRED_PLUGINS = array(
        //'Hello Dolly' => 'hello-dolly/hello.php',
        //'WooCommerce' => 'woocommerce/woocommerce.php'
    );

    public static function activate(bool $networkWide, array $configuration, string $configurationOptionName): void
    {
        add_network_option(get_current_network_id(), $configurationOptionName, $configuration);

        if (is_multisite()) {
            // Network-wide activation
            if ($networkWide) {
                if (!current_user_can('manage_network_plugins'))
                {
                    deactivate_plugins(plugin_basename(__FILE__));
                    wp_die('You don\'t have proper authorization to activate a plugin!');
                }
                
                /**
                 * Network setup
                 */
                // Your Network setup code comes here...

                /**
                 * Site specific setup
                 */
                // Loop through the sites
                foreach (get_sites(['fields'=>'ids']) as $blogId)
                {
                    switch_to_blog($blogId);
                    self::checkDependencies(true, $blogId);
                    self::onActivation();
                    restore_current_blog();
                }
            }
        } else {
            if (!current_user_can('activate_plugins'))
            {
                deactivate_plugins(plugin_basename(__FILE__));
                wp_die('You don\'t have proper authorization to activate a plugin!');
            }

            self::checkDependencies();
            self::onActivation();
        }
    }

    public static function activateNewSite(int $blogId): void
    {
        if (is_plugin_active_for_network('plugin-name/plugin-name.php'))
        {
            switch_to_blog($blogId);
            self::checkDependencies(true, $blogId);
            self::onActivation();
            restore_current_blog();
        }
    }

    private static function checkDependencies(bool $networkWideActivation = false, int $blogId = 0): void
    {
        foreach (self::REQUIRED_PLUGINS as $pluginName => $pluginFilePath)
        {
            if (!is_plugin_active($pluginFilePath))
            {
                // Deactivate the plugin.
                deactivate_plugins(plugin_basename(__FILE__));
                
                if ($networkWideActivation)
                {
                    wp_die("This plugin requires {$pluginName} plugin to be active on site: " . $blogId);
                }
                else
                {
                    wp_die("This plugin requires {$pluginName} plugin to be active!");
                }
            }
        }
    }
    
    /**
	 * The actual tasks performed during activation of a plugin.
	 * Should handle only stuff that happens during a single site activation,
	 * as the process will repeated for each site on a Multisite/Network installation
	 * if the plugin is activated network wide.
	 */
	public static function onActivation()
	{
		
    }
}
