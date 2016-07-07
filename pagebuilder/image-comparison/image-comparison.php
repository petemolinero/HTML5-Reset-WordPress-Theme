<?php
/*
Widget Name: Image Comparison
Description: An image comparison slider.
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Image_Comparison extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'image-comparison',

            // The name of the widget for display purposes.
            __('Image Comparison', 'image-comparison-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('An image comparison.', 'image-comparison-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'original' => array(
                    'type' => 'media',
                    'label' => __( 'Choose the original image.', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => true
                ),
                'modified' => array(
                    'type' => 'media',
                    'label' => __( 'Choose the modified image.', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => true
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
                    'image-comparison-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/image-comparison/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );

        $this->register_frontend_scripts(
            array(
                array(
                    'image-comparison-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/image-comparison/js/image-comparison.js',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        $original = wp_get_attachment_image_src($instance['original'], 'full');
        $modified = wp_get_attachment_image_src($instance['modified'], 'full');

        return array(
            'original' => $original[0],
            'modified' => $modified[0]
            );
    }

    function get_template_name($instance) {
        return 'image-comparison-view';
    }

}

siteorigin_widget_register('image-comparison', __FILE__, 'Image_Comparison');