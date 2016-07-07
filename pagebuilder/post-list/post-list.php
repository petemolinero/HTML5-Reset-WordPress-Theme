<?php
/*
Widget Name: Post List
Description: A list of links to posts
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Post_List extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'post-list',

            // The name of the widget for display purposes.
            __('Post List', 'post-list-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('Get a list of posts', 'post-list-text-domain'),
                'help'        => 'http://laternastudio.com',
            ),

            //The $control_options array, which is passed through to WP_Widget
            array(
            ),

            //The $form_options array, which describes the form fields used to configure SiteOrigin widgets. We'll explain these in more detail later.
            array(
                'posts' => array(
                    'type' => 'posts',
                    'label' => __('Some posts query', 'widget-form-fields-text-domain'),
                ),
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

    public function get_template_variables( $instance, $args ) {

    $post_selector_pseudo_query = $instance['posts'];

    // Process the post selector pseudo query.
    $processed_query = siteorigin_widget_post_selector_process_query( $post_selector_pseudo_query );

    // Use the processed post selector query to find posts.
    $query_result = new WP_Query( $processed_query );

        return array(
            "posts" => $query_result
            );
    }

    function initialize() {
        $this->register_frontend_styles(
            array(
                array(
                    'post-list-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/post-list/css/style.css',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    function get_template_name($instance) {
        return 'post-list-view';
    }

}

siteorigin_widget_register('post-list', __FILE__, 'Post_List');