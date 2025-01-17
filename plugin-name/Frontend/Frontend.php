<?php

namespace PluginName\Frontend;

use PluginName\Admin\Settings;
use PluginName\Frontend\Shortcodes;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

class Frontend
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
        if (!$isAdmin)
        {
            add_action('wp_enqueue_scripts', array($this, 'enqueueStyles'), 10);
            add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'), 10);
            add_action('init', array($this, 'initShortcodes'), 10);
        }
    }

    public function initShortcodes(): void
    {
        $sc = new Shortcodes();
        $sc->registerShortcodes();
    }

    public function enqueueStyles(): void
    {
        $styleId = $this->pluginSlug . '-frontend';
        $styleFileName = 'plugin-name-frontend.css';
        $styleUrl = plugin_dir_url(__FILE__) . 'css/' . $styleFileName;
        if (wp_register_style($styleId, $styleUrl, array(), $this->version, 'all') === false)
        {
            exit(esc_html__('Style could not be registered: ', 'communal-marketplace') . $styleUrl);
        }

        /**
         * If you enque the style here, it will be loaded on every page on the frontend.
         * To load only with a shortcode, move the wp_enqueue_style to the callback function of the add_shortcode.
         */
        wp_enqueue_style($styleId);
    }

    public function enqueueScripts(): void
    {
        $scriptId = $this->pluginSlug . '-frontend';
        $scripFileName = 'plugin-name-frontend.js';
        $scriptUrl = plugin_dir_url(__FILE__) . 'js/' . $scripFileName;
        if (wp_register_script($scriptId, $scriptUrl, array('jquery'), $this->version, false) === false)
        {
            exit(esc_html__('Script could not be registered: ', 'plugin-name') . $scriptUrl);
        }

        /**
         * If you enque the script here, it will be loaded on every page on the frontend.
         * To load only with a shortcode, move the wp_enqueue_script to the callback function of the add_shortcode.
         * If you use the wp_localize_script function, you should place it under the wp_enqueue_script.
         */
        wp_enqueue_script($scriptId);
    }
}
