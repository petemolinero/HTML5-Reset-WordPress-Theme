<?php
/*
Widget Name: Share Buttons
Description: Add share buttons.
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Share_Buttons extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'share-buttons',

            // The name of the widget for display purposes.
            __('Share Buttons', 'share-buttons-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Facebook and Twitter sharing buttons.', 'share-buttons-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'display_heading' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Display Heading', 'widget-form-fields-text-domain' ),
                    'default' => true
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
                    'share-buttons-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/share-buttons/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    function get_template_name($instance) {
        return 'share-buttons-view';
    }

}

siteorigin_widget_register('share-buttons', __FILE__, 'Share_Buttons');