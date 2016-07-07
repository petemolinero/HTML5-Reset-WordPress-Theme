<?php
/*
Widget Name: Title Area
Description: The title area of a page
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Title_Area extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'title-area',

            // The name of the widget for display purposes.
            __('Title Area', 'title-area-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A title area for a page.', 'title-area-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'title' => array(
                    'type' => 'text',
                    'label' => 'Title',
                ),
                'description' => array(
                    'type' => 'tinymce',
                    'label' => 'Description',
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
                    'title-area-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/title-area/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        return array(
            'title' => $instance['title'],
            'description' => $instance['description']
            );
    }

    function get_template_name($instance) {
        return 'title-area-view';
    }

}

siteorigin_widget_register('title-area', __FILE__, 'Title_Area');