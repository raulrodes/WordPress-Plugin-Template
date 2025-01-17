<?php

namespace PluginName\Includes;

class RewriteRules {
    private array $rewrite_rules;

    public function initializeHooks()
    {
        add_action('init', [$this, 'add_rewrite_rules'], 10);
    }

    public function init_rewrite_rules() {
        $this->rewrite_rules = array(
            '^plugin-name/([^/]*)/?' => 'index.php?page=$matches[1]',
            '^plugin-name/([^/]*)/([^/]*)/?' => 'index.php?page=$matches[1]&param1=$matches[2]',
            '^plugin-name/([^/]*)/([^/]*)/([^/]*)/?' => 'index.php?page=$matches[1]&param1=$matches[2]&param2=$matches[3]',
        );
    }

    public function add_rewrite_rules() {
        $this->init_rewrite_rules();

        foreach ( $this->rewrite_rules as $key => $var ) {
            add_rewrite_rule($key, $var, 'top');
        }
    }

}