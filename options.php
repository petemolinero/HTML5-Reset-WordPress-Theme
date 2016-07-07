<?php

function add_settings_to_section($page, $section, $header, $settings = array()) {
    register_setting($page, $section);

    // Register the settings section
    add_settings_section(
        $section,
        '',
        function() use(&$header) {
            echo $header;
        },
        $page
    );

    // Register all of the settings
    foreach ($settings as $setting) {
        add_settings_field(
            $setting['slug'],
            $setting['title'],
            function() use($setting, $section) {
                $checked_value = array_key_exists('checked_value', $setting) ? $setting['checked_value'] : null;
                echo get_setting_html($section, $setting['slug'], $setting['type'], $checked_value);
            },
            $page,
            $section
        );
    }
}

function get_setting_html($section, $slug, $type, $checked_value) {
    $saved_value = get_serialized_option($section, $slug);

    switch ($type) {
        case 'text':
            $html = "<input type='text' name='{$section}[{$slug}]' value='$saved_value'>";
            break;

        case 'checkbox':
            $checked = checked($saved_value, $checked_value, false);
            $html = "<input type='checkbox' name='{$section}[{$slug}]' value='$checked_value' $checked>";
            break;
    }

    return $html;
}