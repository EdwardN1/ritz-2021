<?php
/**
 * Block template file: /parts/blocks/BlockRitzTwoColumnExperience.php
 *
 * Ritz Two Column Experience Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @var bool $is_preview True during AJAX preview.
 * @var array $block The block settings and attributes.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-two-column-experience-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-two-column-experience-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_two_column_experience_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_two_column_experience_block_preview_image_help'] . '" style="width:100%; height:auto;">';

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
    <?php $image_position = get_field('image_position'); ?>
    <?php $image = get_field('image'); ?>
    <?php $mobile_image = get_field('mobile_image'); ?>
    <?php $image_iframe_link = get_field('image_iframe_link'); ?>
    <?php $booking_options = get_field('second_link_type'); ?>
    <?php $booking_link_text = get_field('second_link_text'); ?>
    <?php $right_link = ''; ?>
    <?php $page_link = get_field('page_link'); ?>
    <?php $image_link = ''; ?>
    <?php if ($page_link) $image_link = '<a href="' . $page_link . '" class="image-link"></a>'; ?>
    <?php if (($booking_options != 'None') && ($booking_options != '')): ?>
        <?php ob_start(); ?>
        <?php
        if ($booking_options == 'AZDS') {
            if (have_rows('accomodation_codes')) :
                $selector = '?';
                $query = '';
                while (have_rows('accomodation_codes')) : the_row();
                    $key = get_sub_field('key');
                    $value = get_sub_field('value');
                    $query .= $selector . $key . '=' . $value;
                    $selector = '&';
                endwhile;
                ?>
                <a href="#/booking/step-1<?php echo $query; ?>"
                   class="button-ritz"><?php echo $booking_link_text; ?></a>
            <?php
            endif;
        };
        if ($booking_options == 'Seven Rooms') {
            $seven_rooms_link = '';
            $slugs = explode('/', get_field('seven_rooms_link'));
            $seven_rooms_link = end($slugs);
            if ($seven_rooms_link) {
                ?>
                <a id="<?php echo uniqid(); ?>-sr-res-root"
                   class="ritz-seven-rooms button-ritz"
                   data-venueid="<?php echo $seven_rooms_link; ?>"><?php echo $booking_link_text; ?></a>
                <?php
            }
        };
        if ($booking_options == 'Bookatable') {
            if (have_rows('dining_codes', $post->ID)) :
                while (have_rows('dining_codes', $post->ID)) :
                    the_row();
                    $bookatable_restaurant = get_sub_field('restaurantid');
                    if ($bookatable_restaurant == '108823') {
                        ?>
                        <a id="<?php echo uniqid(); ?>-sr-res-root"
                           class="ritz-seven-rooms button-ritz"
                           data-venueid="theritzrestaurant"><?php echo $booking_link_text; ?></a>
                        <?php
                    }
                    if ($bookatable_restaurant == '108845') {
                        ?>
                        <a id="<?php echo uniqid(); ?>-sr-res-root"
                           class="ritz-seven-rooms button-ritz"
                           data-venueid="ritzafternoontea"><?php echo $booking_link_text; ?></a>
                        <?php
                    }
                    if ($bookatable_restaurant == '460014') {
                        ?>
                        <a id="<?php echo uniqid(); ?>-sr-res-root"
                           class="ritz-seven-rooms button-ritz"
                           data-venueid="ritzgarden"><?php echo $booking_link_text; ?></a>
                        <?php
                    }
                endwhile;

            endif;
        };
        if ($booking_options == 'Email') {

            if (have_rows('email_options')) :

                while (have_rows('email_options')) : the_row();
                    ?>
                    <a href="mailto:<?php the_sub_field('email_to_address'); ?>?subject=<?php the_sub_field('subject'); ?>&body=<?php the_sub_field('body'); ?>"
                       class="button-ritz"><?php echo $booking_link_text; ?></a>
                <?php
                endwhile;
            endif;
        }
    ;
        if ($booking_options == 'Page') {
            $page = get_field('second_link');
            ?>
            <a href="<?php echo esc_url($page); ?>" class="button-ritz"><?php echo $booking_link_text; ?></a>
            <?php
        };
        $right_link = ob_get_clean();
        ?>
    <?php endif; ?>


    <div class="grid-x show-for-medium">
        <div class="cell large-6 medium-6 small-12">
            <?php if (($image_iframe_link != '') && (!$is_preview)): ?>
                <?php $uniqueID = uniqid(); ?>
                <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal data-id="<?php echo $uniqueID; ?>">
                    <div class="virtual-tour">
                        <iframe src="<?php echo $image_iframe_link; ?>" style="width: 100%; height: 60vh;"></iframe>
                    </div>
                    <span class="close-reveal-modal" data-close>&times;</span>
                </div>
            <?php endif; ?>
            <?php
            if ($image_position == 'Left') {
                ?>
                <div class="left">
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                        <?php if ($image_iframe_link != ''): ?>
                            <a data-open="<?php echo $uniqueID; ?>" class="mag-reveal iframe"></a>
                        <?php else: ?>
                            <?php echo $image_link; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <?php
            } else {
                ?>
                <div class="left">
                    <?php $heading = get_field('heading'); ?>
                    <?php if ($heading != ''): ?>
                        <div class="heading"><h3><?php echo $heading; ?></h3></div>
                    <?php endif; ?>
                    <div class="content"><?php the_field('content'); ?></div>
                    <?php
                    if ($page_link) {
                        if (($booking_options == 'None') || ($booking_options == '')) {
                            ?>
                            <div class="link"><a class="button-underlined"
                                                 href="<?php echo esc_url($page_link); ?>"><?php the_field('page_link_text'); ?></a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="grid-x">
                                <div class="cell shrink link"><a class="button-underlined"
                                                                 href="<?php echo esc_url($page_link); ?>"><?php the_field('page_link_text'); ?></a>
                                </div>
                                <div class="cell shrink link"><?php echo $right_link; ?></div>
                            </div>
                            <?php
                        }
                    } else {
                        if (($booking_options != 'None') && ($booking_options != '')) {
                            ?>
                            <div class="link"><?php echo $right_link; ?></div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="cell large-6 medium-6 small-12">
            <?php
            if ($image_position == 'Right') {
                ?>
                <div class="right">
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                        <?php if ($image_iframe_link != ''): ?>
                            <a data-open="<?php echo $uniqueID; ?>" class="mag-reveal iframe"></a>
                        <?php else: ?>
                            <?php echo $image_link; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="right">
                    <?php $heading = get_field('heading'); ?>
                    <?php if ($heading != ''): ?>
                        <div class="heading"><h3><?php echo $heading; ?></h3></div>
                    <?php endif; ?>
                    <div class="content"><?php the_field('content'); ?></div>
                    <?php if ($page_link) {
                        if (($booking_options == 'None') || ($booking_options == '')) {
                            ?>
                            <div class="link"><a class="button-underlined"
                                                 href="<?php echo esc_url($page_link); ?>"><?php the_field('page_link_text'); ?></a>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="grid-x">
                                <div class="cell shrink link"><a class="button-underlined"
                                                                 href="<?php echo esc_url($page_link); ?>"><?php the_field('page_link_text'); ?></a>
                                </div>
                                <div class="cell shrink link"><?php echo $right_link; ?></div>
                            </div>
                            <?php
                        }
                    } else {
                        if (($booking_options != 'None') && ($booking_options != '')) {
                            /*error_log('$booking_options != None');
                            error_log('$booking_options = |'.$booking_options.'|');*/
                            ?>
                            <div class="link"><?php echo $right_link; ?></div>
                            <?php
                        }
                    } ?>
                </div>
                <?php
            }
            ?>
        </div>
    </div>

    <div class="grid-x hide-for-medium">
        <div class="cell large-6 medium-6 small-12">
            <div class="left">
                <?php $heading = get_field('heading'); ?>
                <?php if ($heading != ''): ?>
                    <div class="heading"><h3><?php echo $heading; ?></h3></div>
                <?php endif; ?>
                <div class="content"><?php the_field('content'); ?></div>
                <?php if ($page_link) {
                    if (($booking_options == 'None') || ($booking_options == '')) {
                        ?>
                        <div class="link"><a class="button-underlined"
                                             href="<?php echo esc_url($page_link); ?>"><?php the_field('page_link_text'); ?></a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="grid-x">
                            <div class="cell shrink link"><a class="button-underlined"
                                                             href="<?php echo esc_url($page_link); ?>"><?php the_field('page_link_text'); ?></a>
                            </div>
                            <div class="cell shrink link"><?php echo $right_link; ?></div>
                        </div>
                        <?php
                    }
                } else {
                    if (($booking_options != 'None') && ($booking_options != '')) {
                        /*error_log('$booking_options != None');
                        error_log('$booking_options = |'.$booking_options.'|');*/
                        ?>
                        <div class="link"><?php echo $right_link; ?></div>
                        <?php
                    }
                } ?>
            </div>
        </div>
        <div class="cell large-6 medium-6 small-12">
            <div class="right">
                <?php if ((get_field('add_mobile_image') == 1) && ($mobile_image)) : ?>
                <div class="image" style="background-image: url(<?php echo esc_url($mobile_image['url']); ?>)">
                    <?php else: ?>
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                        <?php endif; ?>
                        <?php if ($image_iframe_link != ''): ?>
                            <a href="<?php echo $image_iframe_link; ?>" class="mag-reveal iframe" target="_blank"></a>
                        <?php else: ?>
                            <?php echo $image_link; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
