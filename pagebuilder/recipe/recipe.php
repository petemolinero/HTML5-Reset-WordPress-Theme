<?php
/*
Widget Name: Recipe
Description: A single recipe
Author: Pete Molinero
Author URI: http://laternastudio.com
*/

class Recipe extends SiteOrigin_Widget {

    function __construct() {

        //Call the parent constructor with the required arguments.
        parent::__construct(
            // The unique id for your widget.
            'recipe',

            // The name of the widget for display purposes.
            __('Recipe', 'recipe-text-domain'),

            // The $widget_options array, which is passed through to WP_Widget.
            // It has a couple of extras like the optional help URL, which should link to your sites help or support page.
            array(
                'description' => __('A single recipe.', 'recipe-text-domain'),
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
                'instructions' => array(
                    'type' => 'tinymce',
                    'label' => 'Ingredients & Instructions',
                    'rows' => 20
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
                    'recipe-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/recipe/assets/recipe.css',
                    array(),
                    '1.2'
                ),
            )
        );

        $this->register_frontend_scripts(
            array(
                array(
                    'recipe-widget',
                    get_stylesheet_directory_uri() . '/pagebuilder/recipe/assets/recipe.js',
                    array(),
                    '1.2'
                ),
            )
        );
    }

    public function get_template_variables( $instance, $args ) {



        return array(
            'title' => $instance['title'],
            'instructions' => $instance['instructions'],
            'uid' => uniqid('print_')
            );
    }

    function get_template_name($instance) {
        return 'recipe-view';
    }

}

siteorigin_widget_register('recipe', __FILE__, 'Recipe');