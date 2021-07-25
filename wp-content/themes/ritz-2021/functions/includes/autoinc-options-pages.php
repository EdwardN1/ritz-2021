<?php
if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
        'page_title'	=> 'Burger Menu',
        'menu_title'	=> 'Burger Menu',
        'menu_slug' 	=> 'acf-burger-menu',
        'capability'	=> 'edit_posts',
        'redirect'		=> false,
    ));

}

if ( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
        'page_title'	=> 'Options',
        'menu_title'	=> 'Options',
        'menu_slug' 	=> 'acf-options',
        'capability'	=> 'edit_posts',
        'redirect'		=> false,
    ));

}