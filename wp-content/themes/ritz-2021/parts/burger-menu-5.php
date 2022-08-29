<?php
global $use_seven_rooms;
$current_page_id = get_queried_object_id();
global $no_menu_page;
?>
<div class="grid-x show-for-large">
    <div class="cell auto main-nav">
        <?php if (have_rows('page_links', 'option')) : ?>
            <ul id="ritz-main-menu-vertical" class="vertical dropdown menu" data-dropdown-menu -menu>
                <?php
                $pi = 1;
                while (have_rows('page_links', 'option')) : the_row();
                    $link_type = get_sub_field('link_type');
                    $target = '';
                    $currentpage = false;
                    if (get_sub_field('open_in_new_tab') == 1) :
                        $target = ' target="_blank"';
                    endif;
                    $link_text = get_sub_field('link_text');
                    $href = '';
                    if ($link_type == 'Page') {
                        $href = get_sub_field('page');
                    }
                    if ($link_type == 'Post') {
                        $href = get_sub_field('post');
                    }
                    if ($link_type == 'External URL') {
                        $href = get_sub_field('external_url');
                    }
                    if ($link_type == 'Text') {
                        $href = get_sub_field('text_link');
                    }
                    if ($href != '') {
                        if (!is_front_page()) {
                            $href_postID = url_to_postid($href);
                            if ($href_postID != 0) {
                                if ($href_postID == $current_page_id) {
                                    $currentpage = true;
                                } else {
                                    if (have_rows('child_pages')) :
                                        while (have_rows('child_pages')) : the_row();
                                            $jxhref = '';
                                            if ($link_type == 'Page') {
                                                $jxhref = get_sub_field('page_link');
                                            }
                                            if ($link_type == 'Post') {
                                                $jxhref = get_sub_field('post_link');
                                            }
                                            if ($link_type == 'External URL') {
                                                $jxhref = get_sub_field('external_url');
                                            }
                                            if ($link_type == 'Text') {
                                                $jxhref = get_sub_field('text_link');
                                            }
                                            if ($jxhref != ''):
                                                $jxhref_postID = url_to_postid($jxhref);
                                                if ($jxhref_postID == $current_page_id) {
                                                    $currentpage = true;
                                                }
                                            endif;
                                        endwhile;
                                    endif;
                                }
                            }
                        }
                        $currentpage_class = '';
                        if ($currentpage) {
                            $currentpage_class = ' active_menu_item';
                        }
                        $parent_data = ' data-parent-number="' . $pi . '"';
                        $parent_data_is = ' data-parent-number-is="' . $pi . '"';
                        $pi++;
                        ?>
                        <?php if (have_rows('child_pages')) : ?>
                            <li class="menu-item-has-children<?php echo $currentpage_class; ?>"<?php echo $parent_data; ?>>
                                <a href="<?php echo esc_url($href); ?>"<?php echo $target; ?>><?php echo esc_html($link_text); ?></a>
                                <ul class="menu vertical nested"<?php echo $parent_data_is; ?>>
                                    <li>
                                        <a href="<?php echo esc_url($href); ?>"<?php echo $target; ?>>Overview</a>
                                    </li>

                                    <?php while (have_rows('child_pages')) : the_row(); ?>
                                        <?php
                                        $link_text = get_sub_field('link_text');
                                        $link_type = get_sub_field('link_type');
                                        $target = '';
                                        if (get_sub_field('open_in_new_tab') == 1) :
                                            $target = ' target="_blank"';
                                        endif;
                                        $jhref = '';
                                        if ($link_type == 'Page') {
                                            $jhref = get_sub_field('page_link');
                                        }
                                        if ($link_type == 'Post') {
                                            $jhref = get_sub_field('post_link');
                                        }
                                        if ($link_type == 'External URL') {
                                            $jhref = get_sub_field('external_url');
                                        }
                                        if ($link_type == 'Text') {
                                            $jhref = get_sub_field('text_link');
                                        }
                                        if ($jhref != '') {
                                            ?>
                                            <li>
                                                <a href="<?php echo esc_url($jhref); ?>"<?php echo $target; ?>><?php echo esc_html($link_text); ?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                    <?php endwhile; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="menu-item-has-children"<?php echo $parent_data; ?>>
                                <a href="<?php echo esc_url($href); ?>"<?php echo $target; ?>><?php echo esc_html($link_text); ?></a>
                                <ul class="menu vertical nested">
                                    <li>
                                        <a href="<?php echo esc_url($href); ?>"<?php echo $target; ?>>Overview</a>
                                    </li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php
                    }
                endwhile;
                ?>
            </ul>
        <?php endif; ?>

    </div>

    <script>
        jQuery(document).ready(function ($) {
            $('#ritz-main-menu-vertical').on('show.zf.dropdownMenu', function (ev, $el) {
                let $parentNumber = $el.data('parent-number-is');
                let $parentMenu = $('#ritz-main-menu-vertical').find('[data-parent-number="' + $parentNumber + '"]');
                let numberofSubMenuItems = $el.children().length;
                let minHeight = (numberofSubMenuItems * 40) + ($parentNumber * 45) - 60;
                window.console.log(minHeight + ' minimum height');
                $('#ritz-main-menu-vertical').css('min-height', minHeight);

            });

        });
    </script>

    <div class="cell shrink special-offer">
        <div class="inner">
            <?php if (have_rows('special_offer', 'option')) : ?>
                <?php while (have_rows('special_offer', 'option')) : the_row(); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <div class="image"<?php if ($image) : ?>
                        style="background-image: url(<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>);"
                    <?php endif; ?>></div>
                    <h2 class="text-center"><?php the_sub_field('line_1'); ?></h2>
                    <h2 class="text-center"
                        style="padding-bottom: 5px; padding-top: 0;"><?php the_sub_field('line_2'); ?></h2>
                    <h2 class="text-center"
                        style="padding-top: 0; padding-bottom: 5px;"><?php the_sub_field('line_3'); ?></h2>
                    <div class="grid-x" style="padding-top: 25px;">
                        <div class="cell auto text-center">
                            <a href="<?php echo get_sub_field('page_link'); ?>"
                               class="button-underline"><?php the_sub_field('link_text'); ?></a>
                        </div>

                        <?php $booking_type = get_sub_field('booking_type'); ?>
                        <?php if ($booking_type == 'AZDS'): ?>
                            <?php if (have_rows('accomodation_codes')) :
                                $selector = '?';
                                $query = '';
                                while (have_rows('accomodation_codes')) : the_row();
                                    $key = get_sub_field('key');
                                    $value = get_sub_field('value');
                                    $query .= $selector . $key . '=' . $value;
                                    $selector = '&';
                                endwhile;
                                ?>
                                <div class="cell auto text-center">
                                    <a href="#/booking/step-1<?php echo $query; ?>"
                                       class="button-ritz">BOOK NOW</a>
                                </div>
                            <?php else : ?>
                                <div class="cell auto text-center">
                                    <a href="#/booking/step-1" class="button-white">BOOK
                                        NOW</a>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if ($use_seven_rooms): ?>
                            <?php
                            if ($booking_type == 'Seven Rooms') {
                                $seven_rooms_link = '';
                                $slugs = explode('/', get_field('seven_rooms_link'));
                                $seven_rooms_link = end($slugs);
                                if ($seven_rooms_link) {
                                    ?>
                                    <div class="cell auto text-center">
                                        <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                           data-venueid="<?php echo $seven_rooms_link; ?>">BOOK NOW</a>
                                    </div>
                                    <?php
                                }
                            };
                            if ($booking_type == 'Bookatable'){
                                if (have_rows('dining_codes')) :
                                    while (have_rows('dining_codes')) : the_row();
                                        $bookatable_restaurant = get_sub_field('restaurantid');
                                        if ($bookatable_restaurant == '108823') {
                                            ?>
                                            <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                               data-venueid="theritzrestaurant">BOOK NOW</a>
                                            <?php
                                        }
                                        if ($bookatable_restaurant == '108845') {
                                            ?>
                                            <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                               data-venueid="ritzafternoontea">BOOK NOW</a>
                                            <?php
                                        }
                                        if ($bookatable_restaurant == '460014') {
                                            ?>
                                            <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                               data-venueid="ritzgarden">BOOK NOW</a>
                                            <?php
                                        }
                                    endwhile;
                                endif;
                            }
                            ?>
                        <?php else: ?>
                            <?php if ($booking_type == 'Bookatable'): ?>
                                <?php if (have_rows('dining_codes')) :
                                    $book_data = '';
                                    while (have_rows('dining_codes')) : the_row();
                                        $restaurantid = get_sub_field('restaurantid');
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
                                        <div class="cell auto text-center">
                                            <?php echo rid_to_quadranet_link($restaurantid, 'BOOK NOW'); ?>
                                            <!--<a href="#" <?php /*echo $book_data; */ ?>
                                           class="button-ritz">BOOK NOW</a>-->
                                        </div>
                                        <?php
                                    }
                                endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
