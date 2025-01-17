<?php

namespace PluginName\Includes;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

class Deactivator
{
    public static function deactivate(bool $networkWide): void
    {
        if (is_multisite() && $networkWide)
		{
            if (!current_user_can('manage_network_plugins'))
            {
                wp_die('You don\'t have proper authorization to deactivate a plugin!');
            }

            foreach (get_sites(['fields'=>'ids']) as $blogId)
            {
                switch_to_blog($blogId);
                self::onDeactivation();
                restore_current_blog();
            }
		} else {
            if (!current_user_can('activate_plugins'))
            {
                wp_die('You don\'t have proper authorization to deactivate a plugin!');
            }

			self::onDeactivation();
		}
    }

    /**
	 * The actual tasks performed during deactivation of a plugin.
	 * Should handle only stuff that happens during a single site deactivation,
	 * as the process will repeated for each site on a Multisite/Network installation
	 * if the plugin is deactivated network wide.
	 */
	public static function onDeactivation()
	{

	}
}
