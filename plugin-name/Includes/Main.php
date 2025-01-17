<?php

namespace PluginName\Includes;

use PluginName\Admin\Admin;
use PluginName\Admin\Settings;
use PluginName\Admin\NetworkSettings;
use PluginName\Frontend\Frontend;
use PluginName\Includes\Ajax;
use PluginName\Includes\PluginNameCPT;
use PluginName\Includes\RewriteRules;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

class Main
{
    protected string $pluginSlug;
    protected string $version;
    protected Settings $settings;

    public function __construct()
    {
        $this->version = PLUGIN_NAME_VERSION;
        $this->pluginSlug = PLUGIN_NAME_SLUG;
        $this->settings = new Settings(PLUGIN_NAME_SLUG);
    }

    private function defineHooks(): void
    {
        $isAdmin = is_admin();
        $isNetworkAdmin = is_network_admin();

        $settings = new Settings($this->pluginSlug);

        if ($isNetworkAdmin)
        {
            $networkSettings = new NetworkSettings($this->pluginSlug);
            $networkSettings->initializeHooks($isNetworkAdmin);
        }

        if ($isAdmin)
        {
            $admin = new Admin($this->pluginSlug, $this->version, $settings);
            $admin->initializeHooks($isAdmin);

            $settings->initializeHooks($isAdmin);
        } else {
            $frontend = new Frontend($this->pluginSlug, $this->version, $settings);
            $frontend->initializeHooks($isAdmin);
        }

        $rewrite = new RewriteRules();
        $rewrite->initializeHooks();

        $ajax = new Ajax($this->pluginSlug, $this->settings);
        $ajax->initializeHooks();

        $cpt = new PluginNameCPT();
        $cpt->initializeHooks();
    }

    public function run(): void
    {
        $this->defineHooks();
    }
}
