<?php
/**
 * Block template file: /parts/blocks/BlockRitzFourColumn.php
 *
 * Ritz Four Column Block Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-full-width-text-banner-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'ritz-full-width-text-banner-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_full_width_text_banner_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_full_width_text_banner_block_preview_image_help'] . '" style="width:100%; height:auto;">';
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

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <div class="background text-center">
        <div class="heading">
            <h3>
                <?php the_field( 'heading' ); ?>
            </h3>
        </div>
        <div class="content">
            <?php the_field( 'content' ); ?>
        </div>
        <div class="link">
            <?php
            $link = '';
            $link_to = get_field('link_to');
            $target = '';
            if (get_field('open_in_a_new_tab') == 1) {
                $target = ' target="_blank"';
            }
            $link_title = get_field('link_title');
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
                $link = '<a href="' . esc_url($href) . '" class="link button-underlined long"' . $target . '>' . $link_title . '</a>';
            }
            ?>
            <?php echo $link;?>
        </div>
    </div>

</div>