<?php
function secondary_logo_technicks_customizer_setting($wp_customize) {
// add a setting
    $wp_customize->add_setting('technicks_secondary_logo');
// Add a control to upload the hover logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'technicks_secondary_logo', array(
        'label' => 'Upload Secondary Logo',
        'section' => 'title_tagline', //this is the section where the custom-logo from WordPress is
        'settings' => 'technicks_secondary_logo',
        'priority' => 8 // show it just below the custom-logo
    )));
}

add_action('customize_register', 'secondary_logo_technicks_customizer_setting');