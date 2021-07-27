<?php

/*add_filter('block_categories', function ($categories, $post) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'ritzblocks',
                'title' => __('Ritz Blocks', 'ritzblocks'),
            ),
        )
    );
}, 10, 2);*/

add_filter('block_categories', 'reorderBlocks', 99, 2);

function reorderBlocks($categories, $post)
{
    $retCats = array();
    $ritzBlocks = array(
        'slug' => 'ritzblocks',
        'title' => __('Ritz Blocks', 'ritzblocks'),
    );
    $retCats[0] = $ritzBlocks;
    foreach ($categories as $category) {
        $retCats[] = $category;
    }
    return $retCats;
}

add_action('acf/init', 'register_ritz_two_columns_block');
function register_ritz_two_columns_block()
{

    if (function_exists('acf_register_block_type')) {

// Register Two Columns block
        acf_register_block_type(array(
            'name' => 'two-columns',
            'title' => __('Ritz Two Column Block'),
            'description' => __('A Custom Ritz Two Column Block.'),
            'category' => 'ritzblocks',
            'icon' => file_get_contents(get_template_directory() . '/assets/images/ritz-icon.svg'),
            'keywords' => array('two', 'columns'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
// 'align'				=> 'wide',
            'render_template' => get_template_directory() . '/parts/blocks/BlockRitzTwoColumn.php',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'ritz_two_column_block_preview_image_help' => get_template_directory_uri() . '/assets/images/ritz-block-two-column.png',
                    )
                )
            ),
// 'render_callback'	=> 'two_columns_block_render_callback',
// 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/two-columns/two-columns.css',
// 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/two-columns/two-columns.js',
// 'enqueue_assets' 	=> 'two_columns_block_enqueue_assets',
        ));

    }

}

add_action('acf/init', 'register_ritz_four_column_block_block');
function register_ritz_four_column_block_block()
{

    if (function_exists('acf_register_block_type')) {

        // Register Ritz Four Column Block block
        acf_register_block_type(array(
            'name' => 'ritz-four-column-block',
            'title' => __('Ritz Four Column Block'),
            'description' => __('A Custom Ritz Four Column Block.'),
            'category' => 'ritzblocks',
            'icon' => file_get_contents(get_template_directory() . '/assets/images/ritz-icon.svg'),
            'keywords' => array('ritz', 'four', 'column', 'block'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            // 'align'				=> 'wide',
            'render_template' => '/parts/blocks/BlockRitzFourColumn.php',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'ritz_four_column_block_preview_image_help' => get_template_directory_uri() . '/assets/images/ritz-block-four-column.png',
                    )
                )
            ),
            // 'render_callback'	=> 'ritz_four_column_block_block_render_callback',
            // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/ritz-four-column-block/ritz-four-column-block.css',
            // 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/ritz-four-column-block/ritz-four-column-block.js',
            // 'enqueue_assets' 	=> 'ritz_four_column_block_block_enqueue_assets',
        ));

    }

}

add_action('acf/init', 'register_ritz_full_width_text_banner_block');
function register_ritz_full_width_text_banner_block()
{

    if (function_exists('acf_register_block_type')) {

        // Register Ritz Four Column Block block
        acf_register_block_type(array(
            'name' => 'ritz-full-width-text-banner-block',
            'title' => __('Ritz Full Width Text Banner Block'),
            'description' => __('A Custom Ritz Full Width Text Banner Block.'),
            'category' => 'ritzblocks',
            'icon' => file_get_contents(get_template_directory() . '/assets/images/ritz-icon.svg'),
            'keywords' => array('ritz', 'full', 'width', 'text', 'banner', 'block'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            // 'align'				=> 'wide',
            'render_template' => '/parts/blocks/BlockRitzFullWidthTextBanner.php',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'ritz_full_width_text_banner_block_preview_image_help' => get_template_directory_uri() . '/assets/images/ritz-full-width-text-banner.png',
                    )
                )
            ),
            // 'render_callback'	=> 'ritz_four_column_block_block_render_callback',
            // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/ritz-four-column-block/ritz-four-column-block.css',
            // 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/ritz-four-column-block/ritz-four-column-block.js',
            // 'enqueue_assets' 	=> 'ritz_four_column_block_block_enqueue_assets',
        ));

    }

}

add_action('acf/init', 'register_ritz_landing_page_room_block');
function register_ritz_landing_page_room_block()
{

    if (function_exists('acf_register_block_type')) {

        // Register Ritz Four Column Block block
        acf_register_block_type(array(
            'name' => 'ritz-landing-page-room-block',
            'title' => __('Ritz Landing Page Room Block'),
            'description' => __('A Custom Ritz Landing Page Room Block.'),
            'category' => 'ritzblocks',
            'icon' => file_get_contents(get_template_directory() . '/assets/images/ritz-icon.svg'),
            'keywords' => array('ritz', 'landing', 'Room', 'block'),
            'post_types' => array('post', 'page'),
            'mode' => 'auto',
            // 'align'				=> 'wide',
            'render_template' => '/parts/blocks/BlockRitzLandingPageRoom.php',
            'example' => array(
                'attributes' => array(
                    'mode' => 'preview',
                    'data' => array(
                        'ritz_landing_page_room_block_preview_image_help' => get_template_directory_uri() . '/assets/images/ritz-landing-page-room.png',
                    )
                )
            ),
            // 'render_callback'	=> 'ritz_four_column_block_block_render_callback',
            // 'enqueue_style' 		=> get_template_directory_uri() . '/template-parts/blocks/ritz-four-column-block/ritz-four-column-block.css',
            // 'enqueue_script' 	=> get_template_directory_uri() . '/template-parts/blocks/ritz-four-column-block/ritz-four-column-block.js',
            // 'enqueue_assets' 	=> 'ritz_four_column_block_block_enqueue_assets',
        ));

    }

}