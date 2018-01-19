<?php

if (!function_exists('azalea_eltdf_register_sidebars')) {
    /**
     * Function that registers theme's sidebars
     */
    function azalea_eltdf_register_sidebars() {

        register_sidebar(array(
            'name' => esc_html__('Sidebar', 'azaleawp'),
            'id' => 'sidebar',
            'description' => esc_html__('Default Sidebar', 'azaleawp'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<div class="eltdf-widget-title-holder"><h4 class="eltdf-widget-title">',
            'after_title' => '</h4></div>'
        ));
    }

    add_action('widgets_init', 'azalea_eltdf_register_sidebars', 1);
}

if (!function_exists('azalea_eltdf_add_support_custom_sidebar')) {
    /**
     * Function that adds theme support for custom sidebars. It also creates AzaleaEltdfSidebar object
     */
    function azalea_eltdf_add_support_custom_sidebar() {
        add_theme_support('AzaleaEltdfSidebar');
        if (get_theme_support('AzaleaEltdfSidebar')) new AzaleaEltdfSidebar();
    }

    add_action('after_setup_theme', 'azalea_eltdf_add_support_custom_sidebar');
}