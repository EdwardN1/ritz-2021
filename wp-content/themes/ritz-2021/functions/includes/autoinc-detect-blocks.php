<?php
function is_block_page()
{
    global $post;
    if (function_exists('has_blocks')) {
        if (has_blocks($post->ID)) {
            return true;
        }
    }

    return false;
}