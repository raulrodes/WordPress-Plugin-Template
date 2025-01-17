<?php

namespace PluginName\Includes;

class PluginNameCPT{

    public function initializeHooks(): void
    {
        add_action('init', [$this, 'plugin_name_register_post_type']);
    }

    public function plugin_name_register_post_type() {
        $args = [
            'label'  => esc_html__( 'Plugin Name', 'plugin-name' ),
            'labels' => [
                'menu_name'          => esc_html__( 'Plugin Name', 'plugin-name' ),
                'name_admin_bar'     => esc_html__( 'Plugin Name', 'plugin-name' ),
                'add_new'            => esc_html__( 'Add Plugin Name', 'plugin-name' ),
                'add_new_item'       => esc_html__( 'Add new Plugin Name', 'plugin-name' ),
                'new_item'           => esc_html__( 'New Plugin Name', 'plugin-name' ),
                'edit_item'          => esc_html__( 'Edit Plugin Name', 'plugin-name' ),
                'view_item'          => esc_html__( 'View Plugin Name', 'plugin-name' ),
                'update_item'        => esc_html__( 'View Plugin Name', 'plugin-name' ),
                'all_items'          => esc_html__( 'All Plugin Name', 'plugin-name' ),
                'search_items'       => esc_html__( 'Search Plugin Name', 'plugin-name' ),
                'parent_item_colon'  => esc_html__( 'Parent Plugin Name', 'plugin-name' ),
                'not_found'          => esc_html__( 'No Plugin Name found', 'plugin-name' ),
                'not_found_in_trash' => esc_html__( 'No Plugin Name found in Trash', 'plugin-name' ),
                'name'               => esc_html__( 'Plugin Names', 'plugin-name' ),
                'singular_name'      => esc_html__( 'Plugin Name', 'plugin-name' ),
            ],
            'public'              => true,
            'exclude_from_search' => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => false,
            'show_in_rest'        => false,
            'capability_type'     => 'page',
            'hierarchical'        => false,
            'has_archive'         => false,
            'query_var'           => true,
            'can_export'          => true,
            'rewrite_no_front'    => true,
            'show_in_menu'        => true,
            'supports' => [
                'title',
                #'editor',
                'thumbnail',
                'custom-fields',
            ],
            'taxonomies' => [
                'category',
            ],
            'rewrite' => [ 'with_front' => false, 'slug' => 'plugin-name' ]
        ];

        register_post_type( 'plugin-name', $args );
    }
}
