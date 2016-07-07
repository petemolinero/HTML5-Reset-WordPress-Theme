<?php
/*
Widget Name: Fixed Menu
Description: A menu that can't scroll above the top of the screen
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Fixed_Menu extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'fixed-menu',

            // The name of the widget for display purposes.
            __('Fixed Menu', 'fixed-menu-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A menu that can\'t scroll above the top of the screen', 'fixed-menu-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'text' => array(
                    'type' => 'tinymce',
                    'label' => 'Text',
                    'rows' => 10
                )
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function initialize() {
        $this->register_frontend_styles(
            array(
                array(
                    'fixed-menu-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/fixed-menu/assets/fixed-menu.css',
                    array(),
                    '1.2'
                ),
            )
        );

        $this->register_frontend_scripts(
            array(
                array(
                    'fixed-menu-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/fixed-menu/assets/fixed-menu.js',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        return array(
            'text' => $instance['text']
            );
    }

    function get_template_name($instance) {
        return 'fixed-menu-view';
    }

}

siteorigin_widget_register('fixed-menu', __FILE__, 'Fixed_Menu');