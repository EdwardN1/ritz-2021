<?php
function tch_gutenberg_scripts() {

    wp_enqueue_script(
        'be-editor',
        get_stylesheet_directory_uri() . '/assets/scripts/editor/js/editor.js',
        array( 'wp-blocks', 'wp-dom' ),
        filemtime( get_stylesheet_directory() . '/assets/scripts/editor/js/editor.js' ),
        true
    );

    wp_enqueue_style(
        'be-css',
        get_stylesheet_directory_uri() . '/assets/styles/admin.css',
        [ 'wp-edit-blocks' ],
        filemtime( get_stylesheet_directory_uri() . '/assets/styles/admin.css' )
    );
}
add_action( 'enqueue_block_editor_assets', 'tch_gutenberg_scripts' );