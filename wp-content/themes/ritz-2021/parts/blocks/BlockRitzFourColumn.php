<?php
/**
 * Block template file: /parts/blocks/BlockRitzFourColumn.php
 *
 * Ritz Four Column Block Block Template.
 *
 * @var array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @var bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-four-column-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-four-column-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_four_column_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_four_column_block_preview_image_help'] . '" style="width:100%; height:auto;">';
    return;
endif;

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
    $left_title = '';
    $left_content = '';
    $left_link = '';
    $left_img_url = '';
    $right_title = '';
    $right_content = '';
    $right_link = '';
    $right_img_url = '';
    if (have_rows('left_panel')) :
        while (have_rows('left_panel')) : the_row();
            $left_title = get_sub_field('title');
            $left_content = get_sub_field('content');
            $link_to = get_sub_field('link_to');
            $target = '';
            if (get_sub_field('open_in_a_new_tab') == 1) {
                $target = ' target="_blank"';
            }
            $link_title = get_sub_field('link_title');
            $href = '';
            if ($link_to == 'Page') {
                $href = get_sub_field('page');
            }
            if ($link_to == 'Post') {
                $href = get_sub_field('post');
            }
            if ($link_to == 'Text') {
                $href = get_sub_field('text');
            }
            if ($link_to == 'URL') {
                $href = get_sub_field('url');
            }
            if ($href != '') {
                $left_link = '<a href="' . esc_url($href) . '" class="link button-underlined"' . $target . '>' . $link_title . '</a>';
            }
            $image = get_sub_field('image');
            $left_img_url = esc_url($image['url']);
        endwhile;
    endif;
    if (have_rows('right_panel')) :
        while (have_rows('right_panel')) : the_row();
            $right_title = get_sub_field('title');
            $right_content = get_sub_field('content');
            $link_to = get_sub_field('link_to');
            $target = '';
            if (get_sub_field('open_in_a_new_tab') == 1) {
                $target = ' target="_blank"';
            }
            $link_title = get_sub_field('link_title');
            $href = '';
            if ($link_to == 'Page') {
                $href = get_sub_field('page');
            }
            if ($link_to == 'Post') {
                $href = get_sub_field('post');
            }
            if ($link_to == 'Text') {
                $href = get_sub_field('text');
            }
            if ($link_to == 'URL') {
                $href = get_sub_field('url');
            }
            if ($href != '') {
                $right_link = '<a href="' . esc_url($href) . '" class="link button-underlined"' . $target . '>' . $link_title . '</a>';
            }
            $image = get_sub_field('image');
            $right_img_url = esc_url($image['url']);
        endwhile;
    endif;
    ?>
    <div class="grid-x grid-margin-x">
        <div class="cell large-6 medium-6 small-12 left-pane">
            <div class="grid-x">
                <div class="cell large-6 medium-12 small-12">
                    <div class="background">
                        <div class="v-align">
                            <div class="v-content">
                                <div class="heading">
                                    <h3><?php echo $left_title; ?></h3>
                                </div>
                                <div class="content">
                                    <?php echo $left_content; ?>
                                </div>
                                <div class="link">
                                    <?php echo $left_link; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell large-6 medium-12 small-12">
                    <div class="image" style="background-image: url(<?php echo $left_img_url; ?>)"></div>
                </div>
            </div>
        </div>
        <div class="cell large-6 medium-6 small-12 right-pane">
            <div class="grid-x">
                <div class="cell large-6 medium-12 small-12">
                    <div class="background">
                        <div class="v-align">
                            <div class="v-content">
                                <div class="heading">
                                    <h3><?php echo $right_title; ?></h3>
                                </div>
                                <div class="content">
                                    <?php echo $right_content; ?>
                                </div>
                                <div class="link">
                                    <?php echo $right_link; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="cell large-6 medium-12 small-12">
                    <div class="image" style="background-image: url(<?php echo $right_img_url; ?>)"></div>
                </div>
            </div>
        </div>
    </div>

</div>

