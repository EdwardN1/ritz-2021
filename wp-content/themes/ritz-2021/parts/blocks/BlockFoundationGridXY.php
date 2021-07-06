<?php
/**
 * Block template file: /var/www/clients/client74/web174/web/wp-content/themes/locketts_2020/parts/blocks/BlockFoundationGridXY.php
 *
 * Foundation Xy Grid Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'foundation-xy-grid-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-foundation-xy-grid';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
    <?php echo '#' . $id; ?>
    {
    /* Add styles that use ACF values here */
    }
</style>

<?php
$full_width = get_field('full_width');
$fluid = get_field('fluid');
$full = get_field('full');
$spacing = get_field('spacing');
$custom_styles = get_field('custom_styles');
$css_classes = get_field('css_classes');
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <?php
    if (!$full_width == 1):
    $gc_classes = '';
    if ($fluid == 1) {
        $gc_classes .= ' fluid';
    }
    if ($full == 1) {
        $gc_classes .= ' full';
    }
    if($css_classes != '') {
        $gc_classes .= ' '.$css_classes;
    }
    $gc_styles = '';
    if($custom_styles != '') {
        $gc_styles = ' style="'.$custom_styles.'"';
    }
    ?>

    <div class="grid-container<?php echo $gc_classes; ?>"<?php echo $gc_styles;?>>
        <?php endif; ?>

        <?php if (have_rows('Columns')) : ?>
            <?php
            $gx_classes = '';
            if ($spacing == 'margin') {
                $gx_classes = ' grid-margin-x';
            }
            if ($spacing == 'padding') {
                $gx_classes = ' grid-padding-x';
            }
            ?>
            <div class="grid-x grid-padding-y<?php echo $gx_classes; ?>">
                <?php
                while (have_rows('Columns')) : the_row();

                    $image = get_sub_field('image');
                    $image_description = get_sub_field('image_description');
                    $image_link = get_sub_field('image_link');
                    $image_link_description = get_sub_field('image_link_description');
                    $video = get_sub_field('video');
                    $aspect_ratio = get_sub_field('aspect_ratio');
                    $global_size = get_sub_field('global_size');
                    $large_size = get_sub_field('large_size');
                    $medium_size = get_sub_field('medium_size');
                    $small_size = get_sub_field('small_size');
                    $cell_custom_styles = get_sub_field('custom_styles');
                    $cell_css_classes = get_sub_field('css_classes');

                    $type = get_sub_field('type');
                    $content = get_sub_field('content');
                    if ($type == 'Video') {
                        $reb_class = '';
                        if ($aspect_ratio == 'Vertical') {
                            $reb_class = ' vertical';
                        }
                        if ($aspect_ratio == 'Panorama') {
                            $reb_class = ' panorama';
                        }
                        if ($aspect_ratio == 'Square') {
                            $reb_class = ' square';
                        }
                        $content = '<div class="responsive-embed' . $reb_class . '">';
                        $content .= '<iframe width="420" height="315" src=';
                        $content .= $video;
                        $content .= '" frameborder="0" allowfullscreen></iframe>';
                        $content .= '</div>';
                    }
                    if ($image) {
                        $cellFooter = '';
                        if(($image_description!='')) {
                            $cellFooter .= '<div class="image-description"><div class="container">';
                            $cellFooter .= '<span>'.$image_description.'</span>';
                            if($image_link!='') {
                               if($image_link_description=='') $image_link_description = $image_link;
                                $cellFooter .= '<a href="'.$image_link.'">'.$image_link_description.'</a>';
                            }
                            $cellFooter .= '</div></div>';
                        } else {
                            if($image_link!='') {
                                $cellFooter .= '<div class="image-description"><div class="container">';
                                if($image_link_description=='') $image_link_description = $image_link;
                                $cellFooter .= '<a href="'.$image_link.'">'.$image_link_description.'</a>';
                                $cellFooter .= '</div></div>';
                            }
                        }
                        $content = '<div class="cell-type-image">';
                        $content .= '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"/>';
                        $content .= $cellFooter;
                        $content .= '</div>';
                    }

                    $cell_classes = 'cell';
                    if($global_size=='Auto') {
                        $cell_classes .= ' auto';
                    } else {
                        if($global_size=='Shrink') {
                            $cell_classes .= ' shrink';
                        } else {
                            if($large_size !='none') $cell_classes .= ' large-'.$large_size;
                            if($medium_size !='none') $cell_classes .= ' medium-'.$medium_size;
                            if($small_size !='none') $cell_classes .= ' small-'.$small_size;
                        }
                    }
                    if($cell_css_classes != '') {
                        $cell_classes .= ' '.$cell_css_classes;
                    }
                    if($cell_custom_styles != '') {
                        $cell_custom_styles = ' style="'.$cell_custom_styles.'"';
                    }
                    ?>
                <div class="<?php echo $cell_classes;?>"<?php echo $cell_custom_styles;?>>
                    <?php echo $content;?>
                </div>
                <?php
                endwhile; ?>
            </div>
        <?php else : ?>
            <?php // no rows found ?>
        <?php endif; ?>

        <?php if (!$full_width == 1){ ?>
    </div>
<?php } ?>
</div>