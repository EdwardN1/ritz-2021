<?php
add_action( 'template_redirect', 'menus_redirect_page' );

function menus_redirect_page() {
    if (isset($_SERVER['HTTPS']) &&
        ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
        isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
        $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
        $protocol = 'https://';
    }
    else {
        $protocol = 'http://';
    }

    $currenturl = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $currenturl_relative = wp_make_link_relative($currenturl);


    $urlto = $currenturl;


    if (have_rows('restaurant_menus', 'option')) :
        //error_log('got options');
        while (have_rows('restaurant_menus', 'option')) : the_row();
            $redirect_address = get_sub_field('redirect_address');
            $menu_file = get_sub_field('menu_file');
            if(trim($currenturl_relative,'/')==$redirect_address) {
                $urlto = $menu_file;
                break;
            }


        endwhile;
    endif;

    if ($currenturl != $urlto) exit( wp_redirect( $urlto ) );

}

add_shortcode( 'menu_uploader', 'menu_uploader_callback' );

function menu_uploader_callback(){
    return '<form action="' . get_stylesheet_directory_uri() . '/functions/process_menu_upload.php" method="post" enctype="multipart/form-data">
	Your Photo: <input type="file" name="profilepicture" size="25" />
	<input type="submit" name="submit" value="Submit" />
	</form>';
}