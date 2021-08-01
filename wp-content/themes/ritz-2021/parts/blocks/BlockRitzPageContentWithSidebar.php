<?php
/**
 * Block template file: /parts/blocks/BlockRitzPageContentWithSidebar.php
 *
 * Ritz Page Content With Sidebar Block Block Template.
 *
 * @param array $block The block settings and attributes.
 * @param string $content The block inner HTML (empty).
 * @param bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-page-content-with-sidebar-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-page-content-with-sidebar-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_page_content_with_sidebar_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_page_content_with_sidebar_block_preview_image_help'] . '" style="width:100%; height:auto;">';
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
    <div class="page-content-desktop show-for-large">
        <div class="grid-x">
            <div class="cell shrink">
                <div class="left">
                    <?php the_field('content'); ?>
                </div>
            </div>
            <div class="cell shrink">
                <div class="right">
                    <?php if (have_rows('sidebar')) : ?>
                        <?php while (have_rows('sidebar')) :
                            the_row(); ?>
                            <?php $heading = get_sub_field('heading'); ?>
                            <?php if (have_rows('bullets')) : ?>
                            <div class="bullets">
                                <h2><?php echo $heading; ?></h2>
                                <ul>
                                    <?php while (have_rows('bullets')) : the_row(); ?>
                                        <?php $link_to = get_sub_field('link_to');
                                        $bullet_text = get_sub_field('bullet_text');
                                        $target = '';
                                        if (get_sub_field('open_in_a_new_tab') == 1) {
                                            $target = ' target="_blank"';
                                        }
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
                                            $bullet_text = '<a href="' . esc_url($href) . '" class="link"' . $target . '>' . $bullet_text . '</a>';
                                        } ?>
                                        <li><?php echo $bullet_text; ?></li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                        <?php endif; ?>


                            <?php if (have_rows('buttons')) : ?>
                            <div class="buttons">
                                <?php while (have_rows('buttons')) : the_row(); ?>
                                    <?php $left_title = get_sub_field('title');
                                    $left_content = get_sub_field('content');
                                    $link_to = get_sub_field('link_to');
                                    $target = '';
                                    if (get_sub_field('open_in_a_new_tab') == 1) {
                                        $target = ' target="_blank"';
                                    }
                                    $title = get_sub_field('title');
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
                                        echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
                                    } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="price-line">
            <?php the_field('price_line'); ?>
        </div>
        <?php $booking_type = get_field('booking_type'); ?>

        <?php if ($booking_type != 'None'): ?>
            <div class="booking-line">
                <?php
                $booking_link_text = get_field('booking_button_text');
                if ($booking_type == 'Restaurant') {
                    if (have_rows('the_ritz_restaurant')) :
                        $book_data = '';
                        while (have_rows('the_ritz_restaurant')) : the_row();
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
                }
                if ($booking_type == 'Tea') {
                    if (have_rows('afternoon_tea')) :
                        $book_data = '';
                        while (have_rows('afternoon_tea')) : the_row();
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
                }
                if ($booking_type == 'Garden') {
                    if (have_rows('the_ritz_garden')) :
                        $book_data = '';
                        while (have_rows('the_ritz_garden')) : the_row();
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
                }
                if ($booking_type == 'Accomodation') {
                    if (have_rows('accomodation_codes')) :
                        $selector = '?';
                        $query = '';
                        while (have_rows('accomodation_codes')) : the_row();
                            $key = get_sub_field('key');
                            $value = get_sub_field('value');
                            $query .= $selector . '$key' . '=' . $value;
                            $selector = '&';
                        endwhile;
                        ?>
                        <a href="#/booking/step-1<?php echo $query; ?>"
                           class="button-ritz"><?php echo $booking_link_text; ?></a>
                    <?php
                    endif;
                }
                if ($booking_type == 'Page Link') {
                    $page = get_field('page_link');
                    ?>
                    <a href="<?php echo esc_url($page); ?>" class="button-ritz"><?php echo $booking_link_text; ?></a>
                    <?php
                }
                if ($booking_type == 'Email') {
                    if (have_rows('email_options')) :
                        while (have_rows('email_options')) : the_row();
                            ?>
                            <a href="mailto:<?php the_sub_field('email_to_address'); ?>?subject=<?php the_sub_field('subject'); ?>&body=<?php the_sub_field('body'); ?>"
                               class="button-ritz"><?php echo $booking_link_text; ?></a>
                        <?php
                        endwhile;
                    endif;
                };

                ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('footer_lines')) : ?>
            <div class="footer-lines">
                <?php while (have_rows('footer_lines')) : the_row(); ?>
                    <?php the_sub_field('line'); ?><br>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
    <div class="page-content-mobile hide-for-large">

        <?php $booking_type = get_field('booking_type'); ?>
        <?php if ($booking_type != 'None'): ?>
            <div class="booking-line">
                <?php
                $booking_link_text = get_field('booking_button_text');
                if ($booking_type == 'Restaurant') {
                    if (have_rows('the_ritz_restaurant')) :
                        $book_data = '';
                        while (have_rows('the_ritz_restaurant')) : the_row();
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
                }
                if ($booking_type == 'Tea') {
                    if (have_rows('afternoon_tea')) :
                        $book_data = '';
                        while (have_rows('afternoon_tea')) : the_row();
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
                }
                if ($booking_type == 'Garden') {
                    if (have_rows('the_ritz_garden')) :
                        $book_data = '';
                        while (have_rows('the_ritz_garden')) : the_row();
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
                }
                if ($booking_type == 'Accomodation') {
                    if (have_rows('accomodation_codes')) :
                        $selector = '?';
                        $query = '';
                        while (have_rows('accomodation_codes')) : the_row();
                            $key = get_sub_field('key');
                            $value = get_sub_field('value');
                            $query .= $selector . '$key' . '=' . $value;
                            $selector = '&';
                        endwhile;
                        ?>
                        <a href="#/booking/step-1<?php echo $query; ?>"
                           class="button-ritz"><?php echo $booking_link_text; ?></a>
                    <?php
                    endif;
                }
                if ($booking_type == 'Page Link') {
                    $page = get_field('page_link');
                    ?>
                    <a href="<?php echo esc_url($page); ?>" class="button-ritz"><?php echo $booking_link_text; ?></a>
                    <?php
                }
                if ($booking_type == 'Email') {
                    if (have_rows('email_options')) :
                        while (have_rows('email_options')) : the_row();
                            ?>
                            <a href="mailto:<?php the_sub_field('email_to_address'); ?>?subject=<?php the_sub_field('subject'); ?>&body=<?php the_sub_field('body'); ?>"
                               class="button-ritz"><?php echo $booking_link_text; ?></a>
                        <?php
                        endwhile;
                    endif;
                };

                ?>
            </div>
        <?php endif; ?>

        <div class="page-sidebar">
            <?php if (have_rows('sidebar')) : ?>
            <?php while (have_rows('sidebar')) :
            the_row(); ?>
            <?php $heading = get_sub_field('heading'); ?>
            <?php if (have_rows('bullets')) : ?>
            <div class="bullets">
                <ul class="accordion" data-accordion data-allow-all-closed="true">
                    <li class="accordion-item" data-accordion-item><a
                                class="accordion-title"><?php echo $heading; ?></a>
                        <div class="accordion-content" data-tab-content>
                            <ul>
                                <?php while (have_rows('bullets')) : the_row(); ?>
                                    <?php $link_to = get_sub_field('link_to');
                                    $bullet_text = get_sub_field('bullet_text');
                                    $target = '';
                                    if (get_sub_field('open_in_a_new_tab') == 1) {
                                        $target = ' target="_blank"';
                                    }
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
                                        $bullet_text = '<a href="' . esc_url($href) . '" class="link"' . $target . '>' . $bullet_text . '</a>';
                                    } ?>
                                    <li><?php echo $bullet_text; ?></li>
                                <?php endwhile; ?>
                            </ul>
                    </li>
            </div>
            </ul>
        </div>
        <?php endif; ?>
        <?php if (have_rows('buttons')) : ?>
            <div class="buttons">
                <?php while (have_rows('buttons')) : the_row(); ?>
                    <?php $left_title = get_sub_field('title');
                    $left_content = get_sub_field('content');
                    $link_to = get_sub_field('link_to');
                    $target = '';
                    if (get_sub_field('open_in_a_new_tab') == 1) {
                        $target = ' target="_blank"';
                    }
                    $title = get_sub_field('title');
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
                        echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
                    } ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php endwhile; ?>
        <?php endif; ?>

        <div class="page-content">
            <?php the_field('content'); ?>
        </div>

        <div class="price-line">
            <?php the_field('price_line'); ?>
        </div>

        <div class="read-more">

        </div>

        <?php if (have_rows('footer_lines')) : ?>
            <div class="footer-lines">
                <?php while (have_rows('footer_lines')) : the_row(); ?>
                    <?php the_sub_field('line'); ?><br>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
</div>

