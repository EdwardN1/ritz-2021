<?php
function get_breadcrumb()
{

    global $post;

    $trail = '

';

    $page_title = get_the_title($post->ID);
    $content = get_the_content($post->ID);
    $h1_pattern = "~>(.*)</h1>~";
    $header_matches = array();
    preg_match( $h1_pattern, $content, $header_matches );
    if ( count( $header_matches ) > 1 ){
        $page_title = $header_matches[1];
    }

    if ($post->post_parent) {
        $parent_id = $post->post_parent;

        while ($parent_id) {
            $page = get_post($parent_id);
            $title = get_the_title($page->ID);
            $content = get_the_content($page->ID);
            $h1_pattern = "~<h1>(.*)</h1>~";
            $header_matches = array();
            preg_match( $h1_pattern, $content, $header_matches );
            if ( count( $header_matches ) > 1 ){
                $title = $header_matches[1];
            }
            $breadcrumbs[] = '<a href="'.get_the_permalink($page->ID).'">' . $title . ' > </a> ';
            $parent_id = $page->post_parent;
        }

        $breadcrumbs = array_reverse($breadcrumbs);
        foreach ($breadcrumbs as $crumb) $trail .= $crumb;
    }

    $trail = '<a href="/">HOME > </a> '.$trail;

    $trail .= $page_title;
    $trail .= '

';

    return $trail;

}