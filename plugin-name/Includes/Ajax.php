<?php

namespace PluginName\Includes;

if (!defined('ABSPATH')) exit;

class Ajax
{
    public $pluginSlug;
    
    public $version;

    public function __construct($pluginSlug, $version)
    {
        $this->pluginSlug = $pluginSlug;
        $this->version = $version;
    }

    public function initializeHooks(): void
    {
        add_action('wp_ajax_fncNoResponse', array($this, 'fncNoResponse'), 10);
        add_action('wp_ajax_nopriv_fncNoResponse', array($this, 'fncNoResponse'), 10);

        add_action('wp_ajax_fncJsonResponse', array($this, 'fncJsonResponse'), 10);
        add_action('wp_ajax_nopriv_fncJsonResponse', array($this, 'fncJsonResponse'), 10);

        add_action('wp_ajax_fncHtmlResponse', array($this, 'fncHtmlResponse'), 10);
        add_action('wp_ajax_nopriv_fncHtmlResponse', array($this, 'fncHtmlResponse'), 10);
    }

    public function fncNoResponse(): void
    {
        // do some stuff

        wp_die();
    }

    public function fncJsonResponse(): void
    {
        // do some stuff
        $data = '';

        print_r(json_encode($data));
        wp_die();
    }

    public function fncHtmlResponse(): void
    {
        // do some stuff
        $html = '';

        print_r($html);
        wp_die();
    }
}
