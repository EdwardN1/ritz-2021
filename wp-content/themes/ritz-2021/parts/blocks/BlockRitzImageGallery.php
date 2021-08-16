<?php
/**
 * Block template file: /parts/blocks/BlockRitzImageGallery.php
 *
 * Ritz Image Gallery Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 * @var   bool $is_preview True during AJAX preview.
 * @var   array $block The block settings and attributes.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-image-gallery-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-image-gallery-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_image_gallery_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_image_gallery_block_preview_image_help'] . '" style="width:100%; height:auto;">';

    return;
endif;

?>

<style type="text/css">
    <?php echo '#' . $id; ?>
    {
    /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <?php
    $terms = get_terms(
        array(
            'taxonomy' => 'ritzimagegallerycategory',
            'hide_empty' => true,
        )
    );
    $i = 2;
    ?>
    <div class="filter-row">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell auto show-for-medium"></div>
            <div class="cell large-shrink medium-shrink small-12">
                <a class="button-filter selected small" data-filter-class="all">All</a>
            </div>
            <?php
            foreach ($terms

            as $term) {
            $term_name = $term->name;
            $term_class = seoUrl($term_name);
            $button_size = ' small';
            if (strlen($term_name) > 4) $button_size = ' medium';
            if (strlen($term_name) > 7) $button_size = ' large';
            ?>
            <div class="cell large-shrink medium-shrink small-12">
                <a class="button-filter<?php echo $button_size; ?>"
                   data-filter-class="<?php echo $term_class; ?>"><?php echo $term_name; ?></a>
            </div>
            <?php
            $i++;
            if ($i > 5) {
            ?>
            <div class="cell auto show-for-medium"></div>
        </div>
    </div>
    <div class="filter-row">
        <div class="grid-x grid-padding-x grid-padding-y">
            <div class="cell auto show-for-medium"></div>
            <?php
            $i = 1;
            }
            }
            ?>
            <div class="cell auto show-for-medium"></div>
        </div>
    </div>
    <div class="image-grid">
        <div class="grid-x grid-margin-x grid-margin-y">
            <?php
            $args = array(
                'post_type' => 'ritzimagegallery',
                'posts_per_page' => -1
            );
            if($is_preview) {
                $args = array(
                    'post_type' => 'ritzimagegallery',
                    'posts_per_page' => 12
                );
            }

            $loop = new WP_Query($args);
            $x = 1;
            $y = 1;
            $c_1 = '<div class="cell large-4 medium-6 small-12">';
            $c_2 = '<div class="cell large-4 medium-6 small-12">';
            $c_3 = '<div class="cell large-4 medium-6 small-12">';
            $c = 1;
            ?>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <?php
                ob_start();
                ?>
                <div class="icontainer x<?php echo $x; ?> y<?php echo $y; ?>">
                    <?php
                    $postID = get_the_ID();
                    $image = get_field('image', $postID);
                    $uniqueID = uniqid();
                    ?>
                    <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal data-galleryid="<?php echo $uniqueID; ?>">
                        <div class="image-gallery-container">
                            <div class="gallery-image" style="background-image: url(<?php echo esc_url($image['url']); ?>)"></div>
                            <div class="info">
                                <div class="grid-x">
                                    <div class="cell auto caption">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="cell shrink price">
                                        <?php the_field('price_description',$postID);?>
                                    </div>
                                    <div class="cell shrink booking">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="close-reveal-modal" data-close>&times;</span>
                    </div>
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                        <a data-open="<?php echo $uniqueID;?>">OPEN IMAGE</a>
                    </div>
                    <div class="caption">
                        <?php the_title(); ?>
                    </div>
                </div>
                <?php
                $x++;
                if ($x > 3) {
                    $x = 1;
                    $y++;
                }
                if ($y > 3) {
                    $y = 1;
                }
                if ($c == 1) {
                    $c_1 .= ob_get_clean();
                }
                if ($c == 2) {
                    $c_2 .= ob_get_clean();
                }
                if ($c == 3) {
                    $c_3 .= ob_get_clean();
                }
                $c++;
                if ($c > 3) {
                    $c = 1;
                }
                ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php
            $c_1 .= '</div>';
            $c_2 .= '</div>';
            $c_3 .= '</div>';
            echo $c_1;
            echo $c_2;
            echo $c_3;
            ?>
        </div>
    </div>
</div>


