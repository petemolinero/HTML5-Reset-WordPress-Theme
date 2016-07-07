<?php
/*
Widget Name: Embed Video
Description: An embedded Vimeo or Youtube Video
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Embed_Video extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'embed-video',

            // The name of the widget for display purposes.
            __('Embed Video', 'embed-video-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A single image widget.', 'embed-video-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'video_url' => array(
                    'type' => 'link',
                    'label' => __( 'Video Url', 'widget-form-fields-text-domain' )
                ),
                'host' => array(
                    'type' => 'select',
                    'label' => 'Select Host',
                    'default' => 'YouTube',
                    'options' => array(
                        'youtube' => 'YouTube',
                        'vimeo' => 'Vimeo'
                    )
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
                    'embed-video-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/embed-video/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        if ($instance['host'] == 'youtube') {
            parse_str(parse_url($instance['video_url'], PHP_URL_QUERY), $url_vars);
            $video_id = $url_vars['v'];
        } else {
            $video_id = substr(parse_url($instance['video_url'], PHP_URL_PATH), 1);
        }

        return array(
            'video_id' => $video_id,
            'host' => $instance['host']
            );
    }

    function get_template_name($instance) {
        return 'embed-video-view';
    }

}

siteorigin_widget_register('embed-video', __FILE__, 'Embed_Video');