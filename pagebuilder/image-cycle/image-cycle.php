<?php
/*
Widget Name: Image Cycle
Description: Cycle through multiple images
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Image_Cycle extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'image-cycle',

            // The name of the widget for display purposes.
            __('Image Cycle', 'image-cycle-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A simple image cycler.', 'image-cycle-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'images' => array(
                    'type' => 'repeater',
                    'label' => __('Any number of images', 'so-widgets-bundle'),
                    'item_name' => __('Images', 'so-widgets-bundle'),
                    'fields' => array(
                        'image' => array(
                            'type' => 'media',
                            'library' => 'image',
                            'label' => 'Image'
                        ),
                    ),
                ),
            ),

            //The $base_folder path string.
            plugin_dir_path(__FILE__)
        );
    }

    function initialize() {
        $this->register_frontend_styles(
            array(
                array(
                    'image-cycle-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/image-cycle/assets/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
        $this->register_frontend_scripts(
            array(
                array(
                    'image-cycle-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/image-cycle/assets/image-cycle.js',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        $images = array();

        foreach ($instance['images'] as $image) {
            $image_id = $image['image'];
            $image_attributes = wp_get_attachment_image_src( $image_id, 'medium-large' );
            $images[] = ( $image_attributes ) ? $image_attributes[0] : '';
        }

        return array(
            'images' => $images,
            );
    }

    function get_template_name($instance) {
        return 'image-cycle-view';
    }

}

siteorigin_widget_register('image-cycle', __FILE__, 'Image_Cycle');