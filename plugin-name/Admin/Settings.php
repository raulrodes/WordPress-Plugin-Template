<?php

namespace PluginName\Admin;

use PluginName\Admin\SettingsBase;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

class Settings extends SettingsBase
{
    private string $pluginSlug;
    private string $menuSlug;

    public function __construct(string $pluginSlug)
    {
        $this->pluginSlug = $pluginSlug;
        $this->menuSlug = $this->pluginSlug;
    }

    public function initializeHooks(bool $isAdmin): void
    {
        // Admin
        if ($isAdmin)
        {
            add_action('admin_menu', array($this, 'setupSettingsMenu'), 10);
        }
    }

    public function setupSettingsMenu(): void
    {
        add_menu_page(
            'Plugin Name Options',                      // Page title: The title to be displayed in the browser window for this page.
            'Plugin Name',                              // Menu title: The text to be used for the menu.
            'manage_options',                           // Capability: The capability required for this menu to be displayed to the user.
            $this->menuSlug,                            // Menu slug: The slug name to refer to this menu by. Should be unique for this menu page.
            array($this, 'renderSettingsPageContent'),  // Callback: The name of the function to call when rendering this menu's page
            'dashicons-smiley',                         // Icon
            81                                          // Position: The position in the menu order this item should appear.
        );
    }

    public function renderSettingsPageContent(string $activeTab = ''): void
    {
        if (!current_user_can('manage_options'))
        {
            return;
        }

        settings_errors($this->pluginSlug);

        ?>
        <div class="wrap">

            <h2><?php esc_html_e('Plugin Name Options', 'plugin-name'); ?></h2>

            <?php $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'general_options'; ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo $this->menuSlug; ?>&tab=general_options" class="nav-tab <?php echo $activeTab === 'general_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('General', 'plugin-name'); ?></a>
            </h2>



        </div>
        <?php
    }
}
