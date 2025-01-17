<?php

/**
 * The plugin bootstrap file
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           PluginName
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Name
 * Plugin URI:        http://example.com/plugin-name-uri/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Author URI:        http://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-name
 * Domain Path:       /Languages
 */

namespace PluginName;

use PluginName\Includes\Activator;
use PluginName\Includes\Deactivator;
use PluginName\Includes\Main;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

require_once plugin_dir_path(__FILE__) . 'Autoloader.php';

define('PLUGIN_NAME_VERSION', '1.0.0');
define('PLUGIN_NAME_SLUG', 'plugin-name');

$configuration = array(
    'version'       => PLUGIN_NAME_VERSION,
    'db-version'    => 0
);

$configurationOptionName = PLUGIN_NAME_SLUG . '-configuration';

register_activation_hook(__FILE__, function($networkWide) use($configuration, $configurationOptionName) {Activator::activate($networkWide, $configuration, $configurationOptionName);});

add_action('wpmu_new_blog', function($blogId) {Activator::activateNewSite($blogId);});

register_deactivation_hook(__FILE__, function($networkWide) {Deactivator::deactivate($networkWide);});

function runPlugin(): void
{
    $plugin = new Main();
    $plugin->run();
}

runPlugin();
