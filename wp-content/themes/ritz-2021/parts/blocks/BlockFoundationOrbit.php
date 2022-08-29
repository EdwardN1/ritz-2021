<?php
/**
 * Block template file: template-parts/blocks/BlockFoundationOrbit.php
 *
 * foundationOrbit Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'foundationOrbit-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-foundationOrbit';
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

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <?php
    if (have_rows('slides')) :
        $show_controls = get_field('show_controls');
        $show_bullets = get_field('show_bullets');
        $timer_delay = get_field('timer_delay');
        $auto_play = get_field('auto_play');
        $infinite = get_field('infinite');
        $responds_to_swipe = get_field('responds_to_swipe');
        $pause_on_hover = get_field('pause_on_hover');
        $data_options = ' data-anim-in-from-right="fade-in"  data-anim-out-to-right="fade-out" data-anim-in-from-left="fade-in" data-anim-out-to-left="fade-out" ';
        if($timer_delay != 5000) $data_options .= 'data-timer-delay="'.$timer_delay.'" ';
        if($auto_play != 1) $data_options .= 'data-auto-play="false" ';
        if($infinite != 1) $data_options .= 'data-infinite-wrap="false" ';
        if($responds_to_swipe != 1) $data_options .= 'data-swipe="false" ';
        if($pause_on_hover != 1) $data_options .= 'data-pause-on-hover="false" ';
        ?>

        <div class="orbit" role="region" aria-label="Pictures" data-orbit=""<?php echo $data_options;?>>
            <div class="orbit-wrapper">
                <?php
                if (get_field('show_controls') == 1) :
                    ?>
                    <div class="orbit-controls">
                        <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
                        <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
                    </div>
                <?php endif; ?>
                <?php
                $bullets = '';
                $slides = '';
                $activeClass = 'is-active ';
                $dataSlide = 0;
                while (have_rows('slides')) :
                    the_row();
                    $image = get_sub_field('image');
                    $caption = get_sub_field('caption');
                    $link = get_sub_field('link');
                    $add_caption = get_sub_field('add_caption');
                    $position = get_sub_field('position');
                    $caption_class='';
                    if($position=='Top') $caption_class = ' position-top';
                    if($position=='Top Left') $caption_class = ' position-top-left';
                    if($position=='Bottom Left') $caption_class = ' position-bottom-left';
                    if($position=='Top RIght') $caption_class = ' position-top-right';
                    if($position=='Bottom Right') $caption_class = ' position-bottom-right';
                    if($position=='Centre') $caption_class = ' position-centre';
                    $add_link = get_sub_field('add_link');
                    if ($image) :
                        $slides .= '<li class="' . $activeClass . 'orbit-slide">';
                        $slides .= '<figure class="orbit-figure">';
                        if(($add_link==1)&&($link!='')) {
                            $slides .= '<a href="'.$link.'">';
                            $slides .= '<img class="orbit-image" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"/>';
                            $slides .= '</a>';
                        } else {
                            $slides .= '<img class="orbit-image" src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"/>';
                        }
                        if(($add_caption==1)&&($caption!='')) {
                            $slides .= '<figcaption class="orbit-caption'.$caption_class.'">' . $caption . '</figcaption>';
                        }
                        $slides .= '</figure>';
                        $slides .= '</li>';
                        $extraSpan = '<span class="show-for-sr" data-slide-active-label>Current Slide</span>';
                        if ($activeClass != ''):
                            $activeClass = ' class="is-active"';
                        endif;
                        $bullets .= '<button' . $activeClass . ' data-slide="' . $dataSlide . '">';
                        $bullets .= '<span class="show-for-sr">' . tch_NumToOrdinalWord($dataSlide + 1) . ' slide details.</span>';
                        $bullets .= $extraSpan;
                        $bullets .= '</button>';
                        $dataSlide++;
                        $activeClass = '';
                        $extraSpan = '';
                    endif;
                endwhile;
                ?>
                <ul class="orbit-container">
                    <?php echo $slides; ?>
                </ul>
                <?php if (get_field('show_bullets') == 1) : ?>
                    <nav class="orbit-bullets">
                        <?php echo $bullets; ?>
                    </nav>
                <?php endif; ?>
            </div>
        </div>
    <?php
    endif;
    ?>
</div>