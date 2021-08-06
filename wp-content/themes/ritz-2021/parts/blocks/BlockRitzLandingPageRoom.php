<?php
/**
 * Block template file: /parts/blocks/BlockRitzLandingPageRoom.php
 *
 * Ritz Landing Page Room Block Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-landing-page-room-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-landing-page-room-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_landing_page_room_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_landing_page_room_block_preview_image_help'] . '" style="width:100%; height:auto;">';
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
    <div class="grid-x">
        <?php
        $image_position = get_field('image_position');
        $img_div = '';
        $content_div = '';
        $image = get_field('image');
        ob_start();
        ?>
        <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">

        </div>
        <?php
        $img_div = ob_get_contents();
        ob_end_clean();
        ob_start();
        ?>
        <div class="background">
            <div class="title">
                <h3><?php the_field('title'); ?></h3>
            </div>
            <div class="content">
                <?php the_field('content'); ?>
            </div>
            <div class="price">
                <?php the_field('price'); ?>
            </div>
            <div class="links">
                <div class="grid-x">
                    <div class="cell auto text-center">
                        <?php
                        $link_to = get_field('link_to');
                        $target = '';
                        $left_link = '';
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
                            $left_link = '<a href="' . esc_url($href) . '" class="link button-underlined"' . $target . '>' . $link_title . '</a>';
                        }
                        ?>
                        <?php echo $left_link; ?>
                    </div>
                    <div class="cell auto text-center">
                        <?php
                        $booking_options = get_field('booking_options');
                        $booking_link_text = get_field('booking_link_text');
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
                        if ($booking_options == 'Bookatable') {
                            if (have_rows('dining_codes')) :
                                $book_data = '';
                                while (have_rows('dining_codes')) : the_row();
                                    $book_data = ' data-bookatable data-connectionid="' . get_sub_field('connectionid') . '"';
                                    $book_data .= ' data-restaurantid="' . get_sub_field('restaurantid') . '"';
                                    $book_data .= ' data-basecolor="' . get_sub_field('basecolor') . '"';
                                    $book_data .= ' data-promotionid="' . get_sub_field('promotionid') . '"';
                                    $book_data .= ' data-sessionid="' . get_sub_field('sessionid') . '"';
                                    $book_data .= ' data-conversionjs="' . get_sub_field('conversionjs') . '"';
                                    $book_data .= ' data-gaaccountnumber="' . get_sub_field('gaaccountnumber') . '"';
                                endwhile;
                                if ($book_data != '') {
                                    ?>
                                    <a href="#" <?php echo $book_data; ?>
                                       class="button-ritz"><?php echo $booking_link_text; ?></a>
                                    <?php
                                }
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
                        };
                        if ($booking_options == 'Page') {
                            $page = get_field('page');
                            ?>
                            <a href="<?php echo esc_url($page); ?>"><?php echo $booking_link_text; ?></a>
                            <?php
                        };
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $content_div = ob_get_contents();
        ob_end_clean();
        $leftClass = 'large-shrink medium-shrink';
        $rightClass = 'large-auto medium-auto';
        $topClass = 'left';
        if ($image_position == 'Left') {
            $leftClass = 'large-auto medium-auto';
            $rightClass = 'large-shrink medium-shrink';
            $topClass = 'right';
        }
        ?>
        <div class="cell <?php echo $leftClass; ?> small-12 left show-for-medium">
            <?php
            if ($image_position == 'Left') :
                echo $img_div;
            else:
                echo $content_div;
            endif;
            ?>
        </div>
        <div class="cell <?php echo $rightClass; ?> small-12 right show-for-medium">
            <?php
            if ($image_position == 'Right'):
                echo $img_div;
            else:
                echo $content_div;
            endif;
            ?>
        </div>
        <div class="cell small-12 <?php echo $topClass; ?> hide-for-medium">
            <?php
            echo $content_div;
            ?>
        </div>
        <div class="cell small-12 hide-for-medium">
            <?php
            echo $img_div;
            ?>
        </div>
    </div>

</div>