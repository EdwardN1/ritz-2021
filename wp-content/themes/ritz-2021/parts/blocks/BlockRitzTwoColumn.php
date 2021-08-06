<?php
/**
 * Block template file: /var/www/clients/client29/web282/web/wp-content/themes/ritz-2021/parts/blocks/BlockRitzTwoColumn.php
 *
 * Two Columns Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
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
        $link = '<a href="' . esc_url($href) . '" class="link button-underlined"' . $target . '>' . $link_title . '</a>';
    }
    ?>
    <?php $image_position = get_field('image_position'); ?>
    <?php if ($image_position == '1'): //left and top?>
        <div class="grid-x show-for-medium">
            <div class="cell large-8 medium-7">
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

                </div>
            </div>
            <div class="cell large-4 medium-5 text-center">
                <div class="right container text-center">
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
        <div class="hide-for-medium">
            <div>
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

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
    <?php if ($image_position == '2'): //left and bottom?>
        <div class="grid-x show-for-medium">
            <div class="cell large-8 medium-7">
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

                </div>
            </div>
            <div class="cell large-4 medium-5 text-center">
                <div class="right container text-center">
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
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if ($image_position == '3'): //right and top?>
        <div class="grid-x show-for-medium">
            <div class="cell large-4 medium-5 text-center">
                <div class="left container">
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
            <div class="cell large-8 medium-7">
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

                </div>
            </div>
        </div>
        <div class="hide-for-medium">
            <div>
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

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
    <?php if ($image_position == '4')://right and bottom?>
        <div class="grid-x show-for-medium">
            <div class="cell large-4 medium-5 text-center">
                <div class="left container">
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
            <div class="cell large-8 medium-7">
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

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
                <?php $image = get_field('image'); ?>
                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

                </div>
            </div>
        </div>
    <?php endif; ?>


</div>

<?php
if( isset( $block['data']['ritz_two_column_block_preview_image_help'] )  ) :    /* rendering in inserter preview  */

    echo '<img src="'. $block['data']['ritz_two_column_block_preview_image_help'] .'" style="width:100%; height:auto;">';


endif;