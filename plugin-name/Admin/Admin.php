<?php

namespace PluginName\Admin;

use PluginName\Admin\Settings;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

class Admin
{
    private string $pluginSlug;
    private string $version;
    private Settings $settings;

    public function __construct(string $pluginSlug, string $version, Settings $settings)
    {
        $this->pluginSlug = $pluginSlug;
        $this->version = $version;
        $this->settings = $settings;
    }

    public function initializeHooks(bool $isAdmin): void
    {
        if ($isAdmin)
        {
            add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'), 10);
            add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'), 10);
        }
    }

    public function enqueueStyles(string $hook): void
    {
        $styleId = $this->pluginSlug . '-admin';
        $styleFileName = 'plugin-name-admin.css';
        $styleUrl = plugin_dir_url(__FILE__) . 'css/' . $styleFileName;
        if (wp_register_style($styleId, $styleUrl, array(), $this->version, 'all') === false)
        {
            exit(esc_html__('Style could not be registered: ', 'plugin-name') . $styleUrl);
        }
        
        /**
         * If you enque the style here, it will be loaded on every Admin page.
         */
        wp_enqueue_style($styleId);
    }

    public function enqueueScripts(string $hook): void
    {
        $scriptId = $this->pluginSlug . '-admin';
        $scripFileName = 'plugin-name-admin.js';
        $scriptUrl = plugin_dir_url(__FILE__) . 'js/' . $scripFileName;
        if (wp_register_script($scriptId, $scriptUrl, array('jquery'), $this->version, false) === false)
        {
            exit(esc_html__('Script could not be registered: ', 'plugin-name') . $scriptUrl);
        }
        
        /**
         * If you enque the script here, it will be loaded on every Admin page.
         */
        wp_enqueue_script($scriptId);
    }
}
