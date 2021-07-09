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