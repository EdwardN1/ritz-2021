<article id="post-<?php the_ID(); ?>" <?php post_class('t3-page-detail'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <h1 class="text-center text-uppercase"><?php the_field('main_heading'); ?></h1>
            <div class="text-center page-summary text-uppercase"><?php the_field('main_sub_heading'); ?></div>
            <div>
                <div class="block-ritz-page-content-with-sidebar-block">
                    <div class="page-content-desktop show-for-large"
                         style="padding-top: 50px; width: 945px; padding-bottom: 50px;">
                        <div class="grid-x">
                            <?php
                            $full_width = true;
                            if (have_rows('feature_items')) {
                                $full_width = false;
                            }
                            if (get_field('use_lightbox_links') == 1) {
                                $full_width = false;
                            }
                            $full_width = false;
                            if ($full_width):
                                ?>
                                <div class="cell large-12 medium-12 small-12">
                                    <?php the_field('main_content'); ?>
                                </div>
                            <?php else: ?>
                                <div class="cell large-8 medium-6 small-12">
                                    <div class="left">
                                        <?php the_field('main_content'); ?>
                                    </div>
                                    <?php if (get_field('include_price') == 1) : ?>
                                        <div class="price-line">
                                            <?php the_field('price_description'); ?>&nbsp;<?php the_field('price'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="cell large-4 medium-6 small-12">
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
                                                            $file = get_sub_field('file');
                                                            $href = esc_url($file['url']);
                                                        }
                                                        if ($link_to == 'Popup') {
                                                            $href = '';
                                                            $uniqueID = uniqid(); ?>
                                                            <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                                 data-reveal data-id="<?php echo $uniqueID; ?>">
                                                                <div class="info-box">
                                                                    <div class="content">
                                                                        <?php
                                                                        $popup_content = get_sub_field('popup_content');
                                                                        if (strpos($popup_content, '[entertainment]') !== false) {
                                                                            echo get_field('entertainment', 'option');
                                                                        } else {
                                                                            if (strpos($popup_content, '[dresscode]') !== false) {
                                                                                echo get_field('dress_code', 'option');
                                                                            } else {
                                                                                echo $popup_content;
                                                                            }
                                                                        }

                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <span class="close-reveal-modal"
                                                                      data-close>&times;</span>
                                                            </div>
                                                            <?php
                                                            $bullet_text = '<a data-open="' . $uniqueID . '" class="link">' . $bullet_text . '</a>';
                                                        }
                                                        if ($link_to == 'URL') {
                                                            $href = get_sub_field('url');
                                                        }
                                                        if ($href != '') {
                                                            $bullet_text = '<a href="' . esc_url($href) . '" class="link" ' . $target . '>' . $bullet_text . '</a>';
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
                                                if ($link_to == 'YouTube') {
                                                    $href = get_field('lb_left_youtube_link');
                                                }

                                                if ($href != '') {
                                                    $ytpos = strpos($href, 'https://youtu.be/');
                                                    if ($ytpos === 0) {
                                                        $url_array = parse_url($href);
                                                        $videoID = '';
                                                        if (is_array($url_array)) {
                                                            if (array_key_exists('path', $url_array)) {
                                                                $videoID = trim($url_array['path'], '/');
                                                                $uniqueID = uniqid();
                                                                ?>
                                                                <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                                     data-reveal data-id="<?php echo $uniqueID; ?>"
                                                                     data-ytvideoid="<?php echo $videoID; ?>">
                                                                    <div class="flex-video widescreen">
                                                                        <div id="feature-video-<?php echo $uniqueID; ?>">
                                                                            [this div will be converted to an iframe]
                                                                        </div>
                                                                    </div>
                                                                    <span class="close-reveal-modal"
                                                                          data-close>&times;</span>
                                                                </div>
                                                                <?php
                                                                echo '<div class="button-row"><div class="button-container"><a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="link button-underlined long feature-modal-btn"' . $target . '>' . $title . '</a></div></div>';
                                                            } else {
                                                                echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
                                                            }
                                                        }
                                                    } else {
                                                        echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
                                                    }
                                                }

                                                if ($link_to == 'Gallery') {
                                                    $uniqueID = uniqid();
                                                    if (have_rows('lb_left_link_gallery')) {
                                                        ?>
                                                        <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                             data-reveal data-galleryid="<?php echo $uniqueID; ?>">
                                                            <div class="gallery-container">
                                                                <div id="gallery-slick-<?php echo $uniqueID; ?>"
                                                                     class="gallery-slick">
                                                                    <?php
                                                                    while (have_rows('lb_left_link_gallery')) : the_row();
                                                                        $image = get_sub_field('image');
                                                                        ?>
                                                                        <div class="gallery-image"
                                                                             style="background-image: url(<?php echo $image['url']; ?>);"></div>
                                                                    <?php
                                                                    endwhile;
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <span class="close-reveal-modal" data-close>&times;</span>
                                                        </div>
                                                        <div class="button-row">
                                                            <div class="button-container"><a
                                                                        data-open="<?php echo $uniqueID; ?>"
                                                                        class="link button-underlined long"><?php echo $title; ?> </a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }

                                                ?>
                                            </div>
                                            <?php if (get_field('lb_show_right_link') == 1) : ?>
                                                <div class="buttons">
                                                    <?php /*$left_title = get_sub_field('lb_left_link_description');
                                    $left_content = get_sub_field('content');*/
                                                    $link_to = get_field('lb_right_link_type');
                                                    /*$target = '';
                                                    if (get_sub_field('open_in_a_new_tab') == 1) {
                                                        $target = ' target="_blank"';
                                                    }*/
                                                    $title = get_field('lb_right_link_description');
                                                    $href = '';
                                                    if ($href != '') {
                                                        $ytpos = strpos($href, 'https://youtu.be/');
                                                        if ($ytpos === 0) {
                                                            $url_array = parse_url($href);
                                                            $videoID = '';
                                                            if (is_array($url_array)) {
                                                                if (array_key_exists('path', $url_array)) {
                                                                    $videoID = trim($url_array['path'], '/');
                                                                    $uniqueID = uniqid();
                                                                    ?>
                                                                    <div id="<?php echo $uniqueID; ?>"
                                                                         class="reveal-modal" data-reveal
                                                                         data-id="<?php echo $uniqueID; ?>"
                                                                         data-ytvideoid="<?php echo $videoID; ?>">
                                                                        <div class="flex-video widescreen">
                                                                            <div id="feature-video-<?php echo $uniqueID; ?>">
                                                                                [this div will be converted to an
                                                                                iframe]
                                                                            </div>
                                                                        </div>
                                                                        <span class="close-reveal-modal" data-close>&times;</span>
                                                                    </div>
                                                                    <?php
                                                                    echo '<div class="button-row"><div class="button-container"><a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="link button-underlined long feature-modal-btn"' . $target . '>' . $title . '</a></div></div>';
                                                                } else {
                                                                    echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
                                                                }
                                                            }
                                                        } else {
                                                            echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
                                                        }
                                                    }

                                                    if ($link_to == 'Gallery') {
                                                        $uniqueID = uniqid();
                                                        if (have_rows('lb_right_link_gallery')) {
                                                            ?>
                                                            <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                                 data-reveal data-galleryid="<?php echo $uniqueID; ?>">
                                                                <div class="gallery-container">
                                                                    <div id="gallery-slick-<?php echo $uniqueID; ?>"
                                                                         class="gallery-slick">
                                                                        <?php
                                                                        while (have_rows('lb_right_link_gallery')) : the_row();
                                                                            $image = get_sub_field('image');
                                                                            ?>
                                                                            <div class="gallery-image"
                                                                                 style="background-image: url(<?php echo $image['url']; ?>);"></div>
                                                                        <?php
                                                                        endwhile;
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <span class="close-reveal-modal"
                                                                      data-close>&times;</span>
                                                            </div>
                                                            <div class="button-row">
                                                                <div class="button-container"><a
                                                                            data-open="<?php echo $uniqueID; ?>"
                                                                            class="link button-underlined long"><?php echo $title; ?> </a>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $mob_right_gallery_id = $uniqueID;
                                                            $mob_right_gallery_title = $title;
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php $booking_type = get_field('bottom_link_type'); ?>

                        <?php if ((get_field('hide_bottom_link') != 1) && (get_field('bottom_description') != '')) : ?>
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
                    </div>
                    <div class="page-content-mobile hide-for-large">

                        <?php $booking_type = get_field('bottom_link_type'); ?>
                        <?php if (get_field('hide_bottom_link') != 1): ?>
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

                        <div class="page-sidebar">
                            <?php $heading = get_field('features_heading'); ?>
                            <?php if (have_rows('feature_items')) : ?>
                            <div class="bullets">
                                <ul class="accordion" data-accordion data-allow-all-closed="true">
                                    <li class="accordion-item" data-accordion-item><a
                                                class="accordion-title"><?php echo $heading; ?></a>
                                        <div class="accordion-content" data-tab-content>
                                            <ul>
                                                <?php while (have_rows('feature_items')) :
                                                    the_row(); ?>
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
                                                        $href = '';
                                                        $uniqueID = uniqid(); ?>
                                                        <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                             data-reveal data-id="<?php echo $uniqueID; ?>">
                                                            <div class="info-box">
                                                                <?php
                                                                $popup_content = get_sub_field('popup_content');
                                                                if (strpos($popup_content, '[entertainment]') !== false) {
                                                                    echo get_field('entertainment', 'option');
                                                                } else {
                                                                    if (strpos($popup_content, '[dresscode]') !== false) {
                                                                        echo get_field('dress_code', 'option');
                                                                    } else {
                                                                        echo $popup_content;
                                                                    }
                                                                }
                                                                ?>
                                                            </div>
                                                            <span class="close-reveal-modal" data-close>&times;</span>
                                                        </div>
                                                        <?php
                                                        $bullet_text = '<a data-open="' . $uniqueID . '" class="link">' . $bullet_text . '</a>';
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
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                        <?php if (get_field('use_lightbox_links') == 1) : ?>
                            <div class="buttons">
                                <?php /*$left_title = get_sub_field('title');
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
                                    $link_to = get_field('lb_right_link_type');
                                    /*$target = '';
                                    if (get_sub_field('open_in_a_new_tab') == 1) {
                                        $target = ' target="_blank"';
                                    }*/
                                    $title = get_field('lb_right_link_description');
                                    $href = '';
                                    if ($link_to == 'YouTube') {
                                        $href = get_field('lb_right_youtube_link');
                                    }
                                    if ($link_to == 'Gallery') {
                                        ?>
                                        <div class="button-row">
                                            <div class="button-container"><a
                                                        data-open="<?php echo $mob_right_gallery_id; ?>"
                                                        class="link button-underlined long"><?php echo $mob_right_gallery_title; ?> </a>
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        if ($href != '') {
                                            echo '<div class="button-row"><div class="button-container"><a href="' . esc_url($href) . '" class="link button-underlined long">' . $title . '</a></div></div>';
                                        } else {
                                            echo '<div class="button-row"><div class="button-container"><a href="#" class="link button-underlined long">' . $title . '</a></div></div>';
                                        }
                                    }

                                    ?>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>


                        <div class="page-content">
                            <?php the_field('main_content'); ?>
                            <?php
                            /*$content = get_field('main_content');
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
                            echo $output;*/
                            ?>
                        </div>

                        <?php if (get_field('include_price') == 1) : ?>
                            <div class="price-line">
                                <?php the_field('price_description'); ?>&nbsp;<?php the_field('price'); ?>
                            </div>
                        <?php endif; ?>

                        <!--<div class="read-more">
                            <button data-toggle="read-more-content">READ MORE</button>
                        </div>-->

                        <?php if (have_rows('footer_lines')) : ?>
                            <div class="footer-lines">
                                <?php while (have_rows('footer_lines')) : the_row(); ?>
                                    <?php the_sub_field('line'); ?>&nbsp;
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div>
                <?php if (have_rows('offer_tiles')) : ?>
                    <div class="block-ritz-page-carousel-block">
                        <div class="heading text-center"><?php the_field('offers_heading'); ?></div>
                        <div class="ritz-page-carousel">
                            <?php while (have_rows('offer_tiles')) : the_row(); ?>
                                <div class="carousel-slide text-center">
                                    <?php
                                    $href = '';
                                    $target = '';
                                    if (get_sub_field('external_link') == 1) {
                                        $target = ' target="_blank"';
                                        $href = get_sub_field('url');
                                    } else {
                                        $href = get_sub_field('offer_link');
                                    }
                                    if ($href != '') : ?>

                                        <?php $image = get_sub_field('offer_image'); ?>
                                        <?php if ($image) : ?>
                                            <div class="image"
                                                 style="background-image: url(<?php echo esc_url($image['url']); ?>)"></div>
                                        <?php endif; ?>
                                        <div class="slide-content">
                                            <div class="aligner">
                                                <div class="slide-heading"><?php the_sub_field('link_text'); ?></div>
                                                <div class="slide-link"><a
                                                            href="<?php echo esc_url($href); ?>"
                                                            class="button-underlined short"><?php the_sub_field('link_text'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>
</article>
