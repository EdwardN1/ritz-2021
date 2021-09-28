<?php
/**
 * Block template file: /var/www/clients/client29/web282/web/wp-content/themes/ritz-2021/parts/blocks/BlockRitzTwoColumn.php
 *
 * Two Columns Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 * @var bool $is_preview True during AJAX preview.
 * @var array $block The block settings and attributes.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'two-columns-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'ritz-block-two-columns';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

    <style type="text/css">
        .js .tmce-active .wp-editor-area {
            color: #000000 !important;
        }

        <?php echo '#' . $id; ?>
        {
        /* Add styles that use ACF values here */
        }
    </style>

    <div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
        <?php
        $animated = get_field('animated');
        $animated_text_container_class = '';
        $animated_background_class = ' class="image-container animated-background"';
        if ($animated == 1) {
            $animated_text_container_class = 'class="animated-container"';
            $animated_background_class = ' class="image-container animated-background"';
        }

        $link = '';
        $image_link = '';
        $link_to = get_field('link_to');
        $target = '';
        if (get_field('open_in_a_new_tab') == 1) {
            $target = ' target="_blank"';
        }
        $link_title = get_field('link_title');
        $linkLen = '';
        if(strlen($link_title)<=7) {
            $linkLen = 'short';
        }
        if(strlen($link_title)>=13) {
            $linkLen = 'long';
        }
        $href = '';
        if ($link_to == 'Page') {
            $href = get_field('page');
        }
        if ($link_to == 'Post') {
            $href = get_field('post');
        }
        if ($link_to == 'Text') {
            $href = get_field('text');
        }
        if ($link_to == 'URL') {
            $href = get_field('url');
        }
        if ($href != '') {

            $ytpos = strpos($href, 'https://youtu.be/');
            if ($ytpos === 0) {
                $url_array = parse_url($href);
                $videoID = '';
                if (is_array($url_array)) {
                    if (array_key_exists('path', $url_array)) {
                        $videoID = trim($url_array['path'], '/');
                        $uniqueID = uniqid();
                        if(!$is_preview):
                        ?>
                        <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal
                             data-id="<?php echo $uniqueID; ?>" data-ytvideoid="<?php echo $videoID; ?>">
                            <div class="flex-video widescreen">
                                <div id="feature-video-<?php echo $uniqueID; ?>">[this div will be converted to an
                                    iframe]
                                </div>
                            </div>
                            <span class="close-reveal-modal" data-close>&times;</span>
                        </div>
                        <?php
                        endif;
                        $link = '<a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="link button-underlined feature-modal-btn '.$linkLen.'"' . $target . '>' . $link_title . '</a>';
	                    $image_link = '<a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="image-link"' . $target . '></a>';
                    } else {
                        $link = '<a href="' . esc_url($href) . '" class="link button-underlined '.$linkLen.'"' . $target . '>' . $link_title . '</a>';
	                    $image_link = '<a href="' . esc_url($href) . '" class="image-link"' . $target . '></a>';
                    }
                }
            } else {
                $link = '<a href="' . esc_url($href) . '" class="link button-underlined '.$linkLen.'"' . $target . '>' . $link_title . '</a>';
	            $image_link = '<a href="' . esc_url($href) . '" class="image-link"' . $target . '></a>';
            }
        }
        ?>
        <?php $image_position = get_field('image_position'); ?>

        <?php
        /**
         * Image Position Left and Top
         */
        ?>


        <?php if ($image_position == '1'): //left and top   ?>
            <div class="grid-x show-for-medium">
                <div class="cell large-8 medium-7">
                    <?php $image = get_field('image'); ?>
                    <div<?php echo $animated_background_class; ?>>
                        <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                            <?php echo $image_link;?>
                        </div>
                    </div>
                </div>
                <div class="cell large-4 medium-5 text-center">
                    <div class="right container text-center">
                        <div <?php echo $animated_text_container_class; ?>>
                            <div class="heading">
                                <h3>
                                    <?php the_field('title'); ?>
                                </h3>
                            </div>
                            <div class="content">
                                <?php the_field('content'); ?>
                            </div>
                            <div class="link">
                                <?php echo $link; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hide-for-medium">
                <div>
                    <?php
                    if(get_field('add_image_to_display_on_mobile')==1) {
                        $image = get_field('mobile_image');
                        if(!$image) {
                            $image = get_field('image');
                        }
                    } else {
                        $image = get_field('image');
                    }
                    ?>
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
	                    <?php echo $image_link;?>
                    </div>
                </div>
                <div class="bottom container text-center">
                    <div class="heading">
                        <h3>
                            <?php the_field('title'); ?>
                        </h3>
                    </div>
                    <div class="content">
                        <?php the_field('content'); ?>
                    </div>
                    <div class="link">
                        <?php echo $link; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        /**
         * Image Position Left and Bottom
         */
        ?>


        <?php if ($image_position == '2'): //left and bottom   ?>
            <div class="grid-x show-for-medium">
                <div class="cell large-8 medium-7">
                    <?php $image = get_field('image'); ?>
                    <div<?php echo $animated_background_class; ?>>
                        <div class="image"
                             style="background-image: url(<?php echo esc_url($image['url']); ?>)">
	                        <?php echo $image_link;?>
                        </div>
                    </div>
                </div>
                <div class="cell large-4 medium-5 text-center">
                    <div class="right container text-center">
                        <div <?php echo $animated_text_container_class; ?>>
                            <div class="heading">
                                <h3>
                                    <?php the_field('title'); ?>
                                </h3>
                            </div>
                            <div class="content">
                                <?php the_field('content'); ?>
                            </div>
                            <div class="link">
                                <?php echo $link; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hide-for-medium">
                <div class="top container text-center">
                    <div class="heading">
                        <h3>
                            <?php the_field('title'); ?>
                        </h3>
                    </div>
                    <div class="content">
                        <?php the_field('content'); ?>
                    </div>
                    <div class="link">
                        <?php echo $link; ?>
                    </div>
                </div>
                <div>
                    <?php
                    if(get_field('add_image_to_display_on_mobile')==1) {
                        $image = get_field('mobile_image');
                        if(!$image) {
                            $image = get_field('image');
                        }
                    } else {
                        $image = get_field('image');
                    }
                    ?>
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
	                    <?php echo $image_link;?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        /**
         * Image Position Right and Top
         */
        ?>

        <?php if ($image_position == '3'): //right and top?>
            <div class="grid-x show-for-medium">
                <div class="cell large-4 medium-5 text-center">
                    <div class="left container">
                        <div <?php echo $animated_text_container_class; ?>>
                            <div class="heading">
                                <h3>
                                    <?php the_field('title'); ?>
                                </h3>
                            </div>
                            <div class="content">
                                <?php the_field('content'); ?>
                            </div>
                            <div class="link">
                                <?php echo $link; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell large-8 medium-7">
                    <?php $image = get_field('image'); ?>
                    <div<?php echo $animated_background_class; ?>>
                        <div class="image"
                             style="background-image: url(<?php echo esc_url($image['url']); ?>)">
	                        <?php echo $image_link;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hide-for-medium">
                <div>
                    <?php
                    if(get_field('add_image_to_display_on_mobile')==1) {
                        $image = get_field('mobile_image');
                        if(!$image) {
                            $image = get_field('image');
                        }
                    } else {
                        $image = get_field('image');
                    }
                    ?>
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
	                    <?php echo $image_link;?>
                    </div>
                </div>
                <div class="bottom container text-center">
                    <div class="heading">
                        <h3>
                            <?php the_field('title'); ?>
                        </h3>
                    </div>
                    <div class="content">
                        <?php the_field('content'); ?>
                    </div>
                    <div class="link">
                        <?php echo $link; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php
        /**
         * Image Position Left and Top
         */
        ?>

        <?php if ($image_position == '4')://right and bottom?>
            <div class="grid-x show-for-medium">
                <div class="cell large-4 medium-5 text-center">
                    <div class="left container">
                        <div <?php echo $animated_text_container_class; ?>>
                            <div class="heading">
                                <h3>
                                    <?php the_field('title'); ?>
                                </h3>
                            </div>
                            <div class="content">
                                <?php the_field('content'); ?>
                            </div>
                            <div class="link">
                                <?php echo $link; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell large-8 medium-7">
                    <?php $image = get_field('image'); ?>
                    <div<?php echo $animated_background_class; ?>>
                        <div class="image"
                             style="background-image: url(<?php echo esc_url($image['url']); ?>)">
	                        <?php echo $image_link;?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hide-for-medium">
                <div class="top container text-center">
                    <div class="heading">
                        <h3>
                            <?php the_field('title'); ?>
                        </h3>
                    </div>
                    <div class="content">
                        <?php the_field('content'); ?>
                    </div>
                    <div class="link">
                        <?php echo $link; ?>
                    </div>
                </div>
                <div>
                    <?php
                    if(get_field('add_image_to_display_on_mobile')==1) {
                        $image = get_field('mobile_image');
                        if(!$image) {
                            $image = get_field('image');
                        }
                    } else {
                        $image = get_field('image');
                    }
                    ?>
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
	                    <?php echo $image_link;?>
                    </div>
                </div>
            </div>
        <?php endif; ?>


    </div>

<?php
if (isset($block['data']['ritz_two_column_block_preview_image_help'])) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_two_column_block_preview_image_help'] . '" style="width:100%; height:auto;">';


endif;