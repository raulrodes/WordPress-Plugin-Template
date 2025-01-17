<?php

namespace PluginName\Admin;

use PluginName\Admin\SettingsBase;

// If this file is called directly, abort.
if (!defined('ABSPATH')) exit;

class NetworkSettings extends SettingsBase
{
    private string $pluginSlug;
    private string $menuSlug;
    private string $generalOptionGroup;
    private string $generalSettingsSectionId;
    private string $generalPage;
    private string $networkGeneralOptionName;
    private array $networkGeneralOptions;

    public function __construct(string $pluginSlug)
    {
        $this->pluginSlug = $pluginSlug;
        $this->menuSlug = $this->pluginSlug;

        /**
         * General
         */
        $this->generalOptionGroup = $pluginSlug . '-network-general-option-group';
        $this->generalSettingsSectionId = $pluginSlug . '-network-general-section';
        $this->generalPage = $pluginSlug . '-network-general';
        $this->networkGeneralOptionName = $pluginSlug . '-network-general';
    }

    public function initializeHooks(bool $isNetworkAdmin): void
    {
        if ($isNetworkAdmin)
        {
            add_action('network_admin_menu', array($this, 'setupNetworkSettingsMenu'));
            add_action('network_admin_edit_plugin_name_update_network_options', array($this, 'plugin_name_update_network_options'));
        }
    }

    /**
     * This function introduces the plugin options into the Network Main menu.
     */
    public function setupNetworkSettingsMenu(): void
    {
        add_menu_page(
            'Plugin Name Network Options',                      // Page title: The title to be displayed in the browser window for this page.
            'Plugin Name',                                      // Menu title: The text to be used for the menu.
            'manage_network_options',                           // Capability: The capability required for this menu to be displayed to the user.
            $this->menuSlug,                                    // Menu slug: The slug name to refer to this menu by. Should be unique for this menu page.
            array($this, 'renderNetworkSettingsPageContent'),   // Callback: The name of the function to call when rendering this menu's page
            'dashicons-smiley',                                 // Icon
            81                                                  // Position: The position in the menu order this item should appear.
        );
    }

    public function renderNetworkSettingsPageContent(string $activeTab = ''): void
    {
        if (!current_user_can('manage_network_options'))
        {
            return;
        }

        ?>

        <div class="wrap">

            <h2><?php esc_html_e('Plugin Name Network Options', 'plugin-name'); ?></h2>

            <?php $activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'general_options'; ?>

            <h2 class="nav-tab-wrapper">
                <a href="?page=<?php echo $this->menuSlug; ?>&tab=general_options" class="nav-tab <?php echo $activeTab === 'general_options' ? 'nav-tab-active' : ''; ?>"><?php esc_html_e('General', 'plugin-name'); ?></a>
            </h2>


        </div><!-- /.wrap -->
        <?php
    }
}
