<?php
/*
Widget Name: Image Collage Side
Description: An image collage that arranges the dual images on the side.
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Image_Collage_Side extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'image-collage-side',

            // The name of the widget for display purposes.
            __('Image Collage (side)', 'image-collage-side-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('An image collage (side) widget.', 'image-collage-side-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'image-1' => array(
                    'type' => 'media',
                    'label' => __( 'Choose the large image in the collage.', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => true
                ),
                'image-2' => array(
                    'type' => 'media',
                    'label' => __( 'Choose the top small image in the collage.', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => true
                ),
                'image-3' => array(
                    'type' => 'media',
                    'label' => __( 'Choose the bottom small image in the collage.', 'widget-form-fields-text-domain' ),
                    'choose' => __( 'Choose image', 'widget-form-fields-text-domain' ),
                    'update' => __( 'Set image', 'widget-form-fields-text-domain' ),
                    'library' => 'image',
                    'fallback' => true
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
                    'image-collage-side-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/image-collage-side/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        $images = array();

        for ($i=0; $i < 3; $i++) {
            $image_id = $instance['image-' . strval( $i + 1 ) ];
            $image_attributes = wp_get_attachment_image_src( $image_id, 'image-collage' );
            $images[] = ( $image_attributes ) ? $image_attributes[0] : '';
        }

        return array(
            'images' => $images,
            'disable_bot_padding' => $instance['disable_bot_padding']
            );
    }

    function get_template_name($instance) {
        return 'image-collage-side-view';
    }

}

siteorigin_widget_register('image-collage-side', __FILE__, 'Image_Collage_Side');