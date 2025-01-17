<?php

namespace PluginName\Frontend;

class Shortcodes
{
    public function registerShortcodes()
    {
        add_shortcode('sc_name', [$this, 'sc_func']);
    }

    public function sc_func($atts)
    {
        $atrs = shortcode_atts(['att1' => '', 'att2' => ''], $atts);

        return $atrs['att1'].$atrs['att2'];
    }
}