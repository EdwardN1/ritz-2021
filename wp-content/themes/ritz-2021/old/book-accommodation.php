<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <div class="t4-offers">
                <h1 class="text-center"><?php the_field('page_title_h1'); ?></h1>

                <p class="text-center intro"><?php the_field('introduction_text'); ?></p>
                <?php if (get_field('include_extended_description') == 1) : ?>
                    <p class="text-center extended-intro"><?php the_field('extended_description'); ?></p>
                <?php endif; ?>

                <?php if (get_field('hide_filters') != 1) : ?>
                    <?php // echo 'true'; ?>
                <?php endif; ?>
                <?php if (have_rows('offers')) : ?>
                    <div class="grid-x offers grid-padding-x grid-margin-y">
                        <?php while (have_rows('offers')) : the_row(); ?>

                            <?php
                            $offer_type_checked_values = get_sub_field('offer_type');
                            $cell_class = '';
                            ?>

                            <?php if ($offer_type_checked_values) : ?>
                                <?php foreach ($offer_type_checked_values as $offer_type_value): ?>
                                    <?php $cell_class = ' '.str_replace(' ', '-', strtolower(esc_html($offer_type_value))); ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="cell large-4 medium-6 small-12<?php echo $cell_class;?>">
                                <?php $image = get_sub_field('image'); ?>
                                <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)"></div>
                                <div class="heading"><?php the_sub_field('heading'); ?></div>
                                <div class="description"><?php the_sub_field('description'); ?></div>
                                <div class="links">
                                    <div class="grid-x">
                                        <div class="cell auto page-link">
                                            <?php $page_link = get_sub_field('page_link'); ?>
                                            <?php if ($page_link) : ?>
                                                <a href="<?php echo esc_url($page_link); ?>" class="button-underlined long"><?php the_sub_field('page_link_text'); ?></a>
                                            <?php endif; ?>
                                        </div>
                                        <div class="cell auto booking-link">
                                            <?php
                                            $booking_link_type = get_sub_field('booking_link_type');

                                            if ($booking_link_type == 'URL') {
                                                $target = '';
                                                if (get_sub_field('open_in_new_tab') == 1) :
                                                    $target = ' target=_blank';
                                                endif;
                                                ?>
                                                <a href="<?php the_sub_field('booking_link'); ?>" class="button-ritz"<?php echo $target; ?>><?php the_sub_field('booking_link_text'); ?></a>
                                                <?php
                                            }

                                            if ($booking_link_type == 'Afternoon Tea') {
                                                $connectionid = 'UK-THERITZLONDONGROUP:15903';
                                                $conversionjs = 'https://www.theritzlondon.com/Afternoon-Tea/Table-Booking';
                                                $restaurantid = '108845';
                                                if (get_sub_field('afternoon_tea_change_parameters') == 1) {
                                                    ?>
                                                    <a data-bookatable data-connectionid="<?php the_sub_field('at_connectionid'); ?>"
                                                       data-restaurantid="<?php the_sub_field('at_restaurantid'); ?>"
                                                       data-conversionjs="<?php the_sub_field('at_conversionjs'); ?>" data-sessionid="<?php the_sub_field('at_sessionid'); ?>"
                                                       data-promotionid="<?php the_sub_field('at_promotionid'); ?>" data-basecolor="022e46"
                                                       data-gaaccountnumber="UA-10196183-1" class="button-ritz"><?php the_sub_field('booking_link_text'); ?></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a data-bookatable data-connectionid="<?php echo $connectionid; ?>" data-restaurantid="<?php echo $restaurantid; ?>"
                                                       data-conversionjs="<?php echo $conversionjs; ?>" data-basecolor="022e46"
                                                       data-gaaccountnumber="UA-10196183-1" class="button-ritz"><?php the_sub_field('booking_link_text'); ?></a>
                                                    <?php
                                                }
                                            }

                                            if ($booking_link_type == 'Restaurant') {
                                                $connectionid = 'UK-THERITZLONDONGROUP:15903';
                                                $conversionjs = 'https://www.theritzlondon.com/Restaurant/Table-Booking';
                                                $restaurantid = '108823';
                                                $sessionid = 'Dinner';
                                                if (get_sub_field('res_change_parameters') == 1) {
                                                    ?>
                                                    <a data-bookatable data-connectionid="<?php the_sub_field('res_connectionid'); ?>"
                                                       data-restaurantid="<?php the_sub_field('res_restaurantid'); ?>"
                                                       data-conversionjs="<?php the_sub_field('res_conversionjs'); ?>" data-sessionid="<?php the_sub_field('res_sessionid'); ?>"
                                                       data-promotionid="<?php the_sub_field('res_promotionid'); ?>" data-basecolor="022e46"
                                                       data-gaaccountnumber="UA-10196183-1" class="button-ritz"><?php the_sub_field('booking_link_text'); ?></a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a data-bookatable data-connectionid="<?php echo $connectionid; ?>" data-restaurantid="<?php echo $restaurantid; ?>"
                                                       data-conversionjs="<?php echo $conversionjs; ?>" data-sessionid="<?php echo $sessionid; ?>" data-basecolor="022e46"
                                                       data-gaaccountnumber="UA-10196183-1" class="button-ritz"><?php the_sub_field('booking_link_text'); ?></a>
                                                    <?php
                                                }
                                            }

                                            if ($booking_link_type == 'Book Accommodation') {
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
                                                       class="button-ritz"><?php the_sub_field('booking_link_text'); ?></a>
                                                <?php
                                                endif;
                                            }

                                            ?>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else : ?>
                    <?php // no rows found ?>
                <?php endif; ?>
            </div>

        <?php endif; ?>
    </section> <!-- end article section -->


    <?php //comments_template(); ?>

</article> <!-- end article -->