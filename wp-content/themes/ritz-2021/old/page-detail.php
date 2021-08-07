<article id="post-<?php the_ID(); ?>" <?php post_class('t3-page-detail'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <h1 class="text-center text-uppercase"><?php the_field('main_heading'); ?></h1>
            <div class="text-center page-summary text-uppercase"><?php the_field('main_sub_heading'); ?></div>

            <div class="block-ritz-page-content-with-sidebar-block">
                <div class="page-content-desktop show-for-large" style="padding-top: 50px; width: 945px; padding-bottom: 50px;">
                    <div class="grid-x">
                        <div class="cell large-8">
                            <div class="left">
                                <?php the_field('main_content'); ?>
                            </div>
                        </div>
                        <div class="cell large-4">
                            <div class="right">
                                <?php $heading = get_field('features_heading'); ?>
                                <?php if (have_rows('feature_items')) : ?>
                                    <div class="bullets">
                                        <h2><?php echo $heading; ?></h2>
                                        <ul>
                                            <?php while (have_rows('feature_items')) : the_row(); ?>
                                                <?php $link_to = get_sub_field('link_type');
                                                $bullet_text = get_sub_field('description');
                                                $target = '';
                                                if (get_sub_field('open_in_new_window') == 1) {
                                                    $target = ' target="_blank"';
                                                }
                                                $href = '';
                                                if ($link_to == 'Page Link') {
                                                    $href = get_sub_field('link');
                                                }
                                                if ($link_to == 'File') {
                                                    $href = get_sub_field('file');
                                                }
                                                if ($link_to == 'Popup') {
                                                    $href = '#';//get_sub_field('text');
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

                                <?php if (get_field('use_lightbox_links') == 1) : ?>
                                    <div class="buttons">
                                        <?php /*$left_title = get_sub_field('lb_left_link_description');
                                    $left_content = get_sub_field('content');*/
                                        $link_to = get_field('lb_left_link_type');
                                        /*$target = '';
                                        if (get_sub_field('open_in_a_new_tab') == 1) {
                                            $target = ' target="_blank"';
                                        }*/
                                        $title = get_field('lb_left_link_description');
                                        $href = '';
                                        if ($link_to == 'Gallery') {
                                            $href = '#';
                                        }
                                        if ($link_to == 'YouTube') {
                                            $href = get_field('lb_left_youtube_link');
                                        }

                                        if ($href != '') {
                                            echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long">' . $title . '</a></div></div>';
                                        } else {
                                            echo '<div class="button-row"><div class="button-container"><a href="#" class="link button-underlined long">' . $title . '</a></div></div>';
                                        }
                                        ?>
                                    </div>
                                    <?php if (get_field('lb_show_right_link') == 1) : ?>
                                        <div class="buttons">
                                            <?php /*$left_title = get_sub_field('lb_left_link_description');
                                    $left_content = get_sub_field('content');*/
                                            $link_to = get_field('link_to');
                                            /*$target = '';
                                            if (get_sub_field('open_in_a_new_tab') == 1) {
                                                $target = ' target="_blank"';
                                            }*/
                                            $title = get_field('lb_right_link_description');
                                            $href = '';
                                            if ($link_to == 'Gallery') {
                                                $href = '#';
                                            }
                                            if ($link_to == 'YouTube') {
                                                $href = get_field('lb_right_youtube_link');
                                            }

                                            if ($href != '') {
                                                echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long">' . $title . '</a></div></div>';
                                            } else {
                                                echo '<div class="button-row"><div class="button-container"><a href="#" class="link button-underlined long">' . $title . '</a></div></div>';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php if (get_field('include_price') == 1) : ?>
                        <div class="price-line">
                            <?php the_field('price_description'); ?>&nbsp;<?php the_field('price'); ?>
                        </div>
                    <?php endif; ?>
                    <?php $booking_type = get_field('bottom_link_type'); ?>

                    <?php if (get_field('hide_bottom_link') != 1) : ?>
                        <div class="booking-line">
                            <?php
                            $booking_link_text = get_field('bottom_description');
                            if ($booking_type == 'Restaurant') {
                                if (get_field('res_change_parameters') == 1) {
                                    $book_data = ' data-bookatable data-connectionid="' . get_field('res_connectionid') . '"';
                                    $book_data .= ' data-restaurantid="' . get_field('res_restaurantid') . '"';
                                    $book_data .= ' data-basecolor="022e46"';
                                    $book_data .= ' data-promotionid="' . get_field('res_promotionid') . '"';
                                    $book_data .= ' data-sessionid="' . get_field('res_sessionid') . '"';
                                    $book_data .= ' data-conversionjs="' . get_field('res_conversionjs') . '"';
                                    $book_data .= ' data-gaaccountnumber="UA-10196183-1"';
                                } else {
                                    $book_data = ' data-bookatable data-connectionid="UK-THERITZLONDONGROUP:15903';
                                    $book_data .= ' data-restaurantid="108823"';
                                    $book_data .= ' data-basecolor="022e46"';
                                    $book_data .= ' data-conversionjs="https://www.theritzlondon.com/Restaurant/Table-Booking"';
                                    $book_data .= ' data-gaaccountnumber="UA-10196183-1"';
                                }
                            }
                            if ($booking_type == 'Afternoon Tea') {
                                if (get_field('afternoon_tea_change_parameters') == 1) {
                                    $book_data = ' data-bookatable data-connectionid="' . get_field('at_connectionid') . '"';
                                    $book_data .= ' data-restaurantid="' . get_field('at_restaurantid') . '"';
                                    $book_data .= ' data-basecolor="022e46"';
                                    $book_data .= ' data-promotionid="' . get_field('at_promotionid') . '"';
                                    $book_data .= ' data-sessionid="' . get_field('at_sessionid') . '"';
                                    $book_data .= ' data-conversionjs="' . get_field('at_conversionjs') . '"';
                                    $book_data .= ' data-gaaccountnumber="UA-10196183-1"';
                                } else {
                                    $book_data = ' data-bookatable data-connectionid="UK-THERITZLONDONGROUP:15903"';
                                    $book_data .= ' data-restaurantid="108845"';
                                    $book_data .= ' data-basecolor="022e46"';
                                    $book_data .= ' data-conversionjs="https://www.theritzlondon.com/Afternoon-Tea/Table-Booking"';
                                    $book_data .= ' data-gaaccountnumber="UA-10196183-1"';
                                }
                            }
                            if ($book_data != '') {
                                ?>
                                <a href="#" <?php echo $book_data; ?>
                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
                                <?php
                            }
                            if ($booking_type == 'Book Accommodation') {
                                if (have_rows('accommodation_codes')) :
                                    $selector = '?';
                                    $query = '';
                                    while (have_rows('accommodation_codes')) : the_row();
                                        $key = get_field('key');
                                        $value = get_field('value');
                                        $query .= $selector . $key . '=' . $value;
                                        $selector = '&';
                                    endwhile;
                                    ?>
                                    <a href="#/booking/step-1<?php echo $query; ?>"
                                       class="button-ritz"><?php echo $booking_link_text; ?></a>
                                <?php
                                endif;
                            }
                            if ($booking_type == 'Link') {
                                $page = get_field('bottom_link');
                                ?>
                                <a href="<?php echo esc_url($page); ?>"
                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
                                <?php
                            }
                            if ($booking_type == 'URL') {
                                $url = get_field('bottom_url');
                                ?>
                                <a href="<?php echo esc_url($url); ?>"
                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
                                <?php
                            };

                            ?>
                        </div>
                    <?php endif; ?>

                    <?php /*if (have_rows('footer_lines')) : */ ?><!--
                    <div class="footer-lines">
                        <?php /*while (have_rows('footer_lines')) : the_row(); */ ?>
                            <?php /*the_sub_field('line'); */ ?><br>
                        <?php /*endwhile; */ ?>
                    </div>
                --><?php /*endif; */ ?>

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
                                <a href="<?php echo esc_url($page); ?>"
                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
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
                        <?php
                        $content = get_field('content');
                        $paragraphs = explode('</p>', $content);
                        $count = count($paragraphs);
                        $output = '<div class="visible">';
                        for ($i = 0; $i < $count; $i++) {
                            $output .= $paragraphs[$i];
                            if ($i == 1) {
                                $output .= '</div><div class="read-more-content" id="read-more-content" data-toggler data-animate="slide-in-down slide-out-up" style="display: none;">';
                            }
                        }
                        $output .= '</div>';
                        echo $output;
                        ?>
                    </div>

                    <div class="price-line">
                        <?php the_field('price_line'); ?>
                    </div>

                    <div class="read-more">
                        <button data-toggle="read-more-content" href="#">READ MORE</button>
                    </div>

                    <?php if (have_rows('footer_lines')) : ?>
                        <div class="footer-lines">
                            <?php while (have_rows('footer_lines')) : the_row(); ?>
                                <?php the_sub_field('line'); ?>&nbsp;
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        <?php endif; ?>
    </section>
</article>
