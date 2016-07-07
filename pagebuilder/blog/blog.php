<?php
/*
Widget Name: Blog
Description: An image collage that arranges the dual images on the bottom.
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Blog extends SiteOrigin_Widget {

    function __construct() {

        $args = array(
           'public'   => true
        );

        $post_types = get_post_types( $args, 'objects' );
        $post_type_options = array();

        foreach ($post_types as $key => $type) {
            $post_type_options[$key] = $type->labels->singular_name;
        }

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'blog',

            // The name of the widget for display purposes.
            __('Blog', 'blog-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A blog widget.', 'blog-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'post_type' => array(
                    'type' => 'select',
                    'label' => __( 'Post Type', 'widget-form-fields-text-domain' ),
                    'default' => 'post',
                    'options' => $post_type_options
                ),
                'posts_per_page' => array(
                    'type' => 'number',
                    'label' => __( 'Posts Per Page', 'widget-form-fields-text-domain' ),
                    'default' => '6'
                ),
                'display_older_newer' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Display "Older" and "Newer" links', 'widget-form-fields-text-domain' ),
                    'default' => true
                ),
                'display_pagination' => array(
                    'type' => 'checkbox',
                    'label' => __( 'Display numerical pagination links', 'widget-form-fields-text-domain' ),
                    'default' => true
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
                    'blog-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/blog/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {

        return array();
    }

    function get_template_name($instance) {
        return 'blog-view';
    }

}

siteorigin_widget_register('blog', __FILE__, 'Blog');