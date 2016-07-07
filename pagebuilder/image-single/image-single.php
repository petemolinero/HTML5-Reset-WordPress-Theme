<?php
/*
Widget Name: Image Single
Description: A single image.
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Image_Single extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'image-single',

            // The name of the widget for display purposes.
            __('Image (single)', 'image-single-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A single image widget.', 'image-single-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'image-1' => array(
                    'type' => 'media',
                    'label' => __( 'Choose the image..', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => true
                ),
                'image_size' => array(
                    'type' => 'select',
                    'label' => 'Choose the image resolution (larger images need higher resolution)',
                    'default' => 'large',
                    'options' => array(
                        'original' => 'Original',
                        'large' => 'Hi Quality',
                        'medium' => 'Mid Quality',
                        'thumbnail' => 'Low Quality',
                    )
                ),
                'disable_bot_padding' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Disable bottom padding', 'widget-form-fields-text-domain' ),
                    'default' => false
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
                    'image-single-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/image-single/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        $images = array();

        $image_id = $instance['image-1' ];
        $image_attributes = wp_get_attachment_image_src( $image_id, $instance['image_size'] );
        $images[] = ( $image_attributes ) ? $image_attributes[0] : '';

        return array(
            'images' => $images,
            'disable_bot_padding' => $instance['disable_bot_padding']
            );
    }

    function get_template_name($instance) {
        return 'image-single-view';
    }

}

siteorigin_widget_register('image-single', __FILE__, 'Image_Single');