<article id="post-<?php the_ID(); ?>" <?php post_class('t1-page-home'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php if (have_rows('home_page_row')): ?>
                <?php while (have_rows('home_page_row')) : the_row(); ?>
                    <?php if (get_row_layout() == 'hero_section') : ?>
                        <?php if (have_rows('slides')) : ?>
                            <?php while (have_rows('slides')) : the_row(); ?>
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php the_sub_field('main_heading'); ?>
                                <?php the_sub_field('sub_heading'); ?>
                                <?php $link = get_sub_field('link'); ?>
                                <?php if ($link) : ?>
                                    <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($link); ?></a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'two_box_row') : ?>
                        <?php $two_box_image = get_sub_field('two_box_image'); ?>
                        <?php if ($two_box_image) : ?>
                            <img src="<?php echo esc_url($two_box_image['url']); ?>"
                                 alt="<?php echo esc_attr($two_box_image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php the_sub_field('two_box_heading_text'); ?>
                        <?php the_sub_field('two_box_subheading_text'); ?>
                        <?php the_sub_field('two_box_message'); ?>
                        <?php $two_box_link = get_sub_field('two_box_link'); ?>
                        <?php if ($two_box_link) : ?>
                            <a href="<?php echo esc_url($two_box_link); ?>"><?php echo esc_html($two_box_link); ?></a>
                        <?php endif; ?>
                        <?php the_sub_field('two_box_link_text'); ?>
                        <?php if (get_sub_field('two_box_fade_up_text') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('two_box_zoom_image') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('two_box_reset_effects') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'three_box_row') : ?>
                        <?php $three_box_left_image = get_sub_field('three_box_left_image'); ?>
                        <?php if ($three_box_left_image) : ?>
                            <img src="<?php echo esc_url($three_box_left_image['url']); ?>"
                                 alt="<?php echo esc_attr($three_box_left_image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php if (get_sub_field('three_box_left_white_text') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('three_box_left_heading'); ?>
                        <?php the_sub_field('three_box_left_sub_heading'); ?>
                        <?php $three_box_left_link = get_sub_field('three_box_left_link'); ?>
                        <?php if ($three_box_left_link) : ?>
                            <a href="<?php echo esc_url($three_box_left_link); ?>"><?php echo esc_html($three_box_left_link); ?></a>
                        <?php endif; ?>
                        <?php the_sub_field('three_box_left_link_text'); ?>
                        <?php $three_box_top_right_image = get_sub_field('three_box_top_right_image'); ?>
                        <?php if ($three_box_top_right_image) : ?>
                            <img src="<?php echo esc_url($three_box_top_right_image['url']); ?>"
                                 alt="<?php echo esc_attr($three_box_top_right_image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php the_sub_field('three_box_top_right_heading'); ?>
                        <?php the_sub_field('three_box_top_right_message'); ?>
                        <?php $three_box_top_right_link = get_sub_field('three_box_top_right_link'); ?>
                        <?php if ($three_box_top_right_link) : ?>
                            <a href="<?php echo esc_url($three_box_top_right_link); ?>"><?php echo esc_html($three_box_top_right_link); ?></a>
                        <?php endif; ?>
                        <?php the_sub_field('three_box_top_right_link_text'); ?>
                        <?php $three_box_bottom_right_image = get_sub_field('three_box_bottom_right_image'); ?>
                        <?php if ($three_box_bottom_right_image) : ?>
                            <img src="<?php echo esc_url($three_box_bottom_right_image['url']); ?>"
                                 alt="<?php echo esc_attr($three_box_bottom_right_image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php the_sub_field('three_box_bottom_right_heading'); ?>
                        <?php the_sub_field('three_box_bottom_right_sub_heading'); ?>
                        <?php $three_box_bottom_right_link = get_sub_field('three_box_bottom_right_link'); ?>
                        <?php if ($three_box_bottom_right_link) : ?>
                            <a href="<?php echo esc_url($three_box_bottom_right_link); ?>"><?php echo esc_html($three_box_bottom_right_link); ?></a>
                        <?php endif; ?>
                        <?php the_sub_field('three_box_bottom_right_link_text'); ?>
                        <?php if (get_sub_field('three_box_fade_up_text') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('three_box_zoom_images') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('three_box_reset_effects') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <?php // no layouts found ?>
            <?php endif; ?>
            <?php if (have_rows('geo_targeted_rows')) : ?>
                <?php while (have_rows('geo_targeted_rows')) : the_row(); ?>
                    <?php // The geot_field field type is not supported in this version of the plugin. ?>
                    <?php // Contact http://www.hookturn.io to request support for this field type. ?>
                    <?php if (get_sub_field('make_default_content') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (have_rows('home_page_row')): ?>
                        <?php while (have_rows('home_page_row')) : the_row(); ?>
                            <?php if (get_row_layout() == 'hero_section') : ?>
                                <?php if (have_rows('slides')) : ?>
                                    <?php while (have_rows('slides')) : the_row(); ?>
                                        <?php $image = get_sub_field('image'); ?>
                                        <?php if ($image) : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>"
                                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                                        <?php endif; ?>
                                        <?php the_sub_field('main_heading'); ?>
                                        <?php the_sub_field('sub_heading'); ?>
                                        <?php $link = get_sub_field('link'); ?>
                                        <?php if ($link) : ?>
                                            <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($link); ?></a>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>
                            <?php elseif (get_row_layout() == 'two_box_row') : ?>
                                <?php $two_box_image = get_sub_field('two_box_image'); ?>
                                <?php if ($two_box_image) : ?>
                                    <img src="<?php echo esc_url($two_box_image['url']); ?>"
                                         alt="<?php echo esc_attr($two_box_image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php the_sub_field('two_box_heading_text'); ?>
                                <?php the_sub_field('two_box_subheading_text'); ?>
                                <?php the_sub_field('two_box_message'); ?>
                                <?php $two_box_link = get_sub_field('two_box_link'); ?>
                                <?php if ($two_box_link) : ?>
                                    <a href="<?php echo esc_url($two_box_link); ?>"><?php echo esc_html($two_box_link); ?></a>
                                <?php endif; ?>
                                <?php the_sub_field('two_box_link_text'); ?>
                                <?php if (get_sub_field('two_box_fade_up_text') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php if (get_sub_field('two_box_zoom_image') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php if (get_sub_field('two_box_reset_effects') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                            <?php elseif (get_row_layout() == 'three_box_row') : ?>
                                <?php $three_box_left_image = get_sub_field('three_box_left_image'); ?>
                                <?php if ($three_box_left_image) : ?>
                                    <img src="<?php echo esc_url($three_box_left_image['url']); ?>"
                                         alt="<?php echo esc_attr($three_box_left_image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php if (get_sub_field('three_box_left_white_text') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php the_sub_field('three_box_left_heading'); ?>
                                <?php the_sub_field('three_box_left_sub_heading'); ?>
                                <?php $three_box_left_link = get_sub_field('three_box_left_link'); ?>
                                <?php if ($three_box_left_link) : ?>
                                    <a href="<?php echo esc_url($three_box_left_link); ?>"><?php echo esc_html($three_box_left_link); ?></a>
                                <?php endif; ?>
                                <?php the_sub_field('three_box_left_link_text'); ?>
                                <?php $three_box_top_right_image = get_sub_field('three_box_top_right_image'); ?>
                                <?php if ($three_box_top_right_image) : ?>
                                    <img src="<?php echo esc_url($three_box_top_right_image['url']); ?>"
                                         alt="<?php echo esc_attr($three_box_top_right_image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php the_sub_field('three_box_top_right_heading'); ?>
                                <?php the_sub_field('three_box_top_right_message'); ?>
                                <?php $three_box_top_right_link = get_sub_field('three_box_top_right_link'); ?>
                                <?php if ($three_box_top_right_link) : ?>
                                    <a href="<?php echo esc_url($three_box_top_right_link); ?>"><?php echo esc_html($three_box_top_right_link); ?></a>
                                <?php endif; ?>
                                <?php the_sub_field('three_box_top_right_link_text'); ?>
                                <?php $three_box_bottom_right_image = get_sub_field('three_box_bottom_right_image'); ?>
                                <?php if ($three_box_bottom_right_image) : ?>
                                    <img src="<?php echo esc_url($three_box_bottom_right_image['url']); ?>"
                                         alt="<?php echo esc_attr($three_box_bottom_right_image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php the_sub_field('three_box_bottom_right_heading'); ?>
                                <?php the_sub_field('three_box_bottom_right_sub_heading'); ?>
                                <?php $three_box_bottom_right_link = get_sub_field('three_box_bottom_right_link'); ?>
                                <?php if ($three_box_bottom_right_link) : ?>
                                    <a href="<?php echo esc_url($three_box_bottom_right_link); ?>"><?php echo esc_html($three_box_bottom_right_link); ?></a>
                                <?php endif; ?>
                                <?php the_sub_field('three_box_bottom_right_link_text'); ?>
                                <?php if (get_sub_field('three_box_fade_up_text') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php if (get_sub_field('three_box_zoom_images') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php if (get_sub_field('three_box_reset_effects') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                            <?php elseif (get_row_layout() == 'offers_row') : ?>
                                <?php the_sub_field('offers_row_title'); ?>
                                <?php if (have_rows('offers_row_offers')) : ?>
                                    <?php while (have_rows('offers_row_offers')) : the_row(); ?>
                                        <?php $image = get_sub_field('image'); ?>
                                        <?php if ($image) : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>"
                                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                                        <?php endif; ?>
                                        <?php the_sub_field('heading'); ?>
                                        <?php the_sub_field('description'); ?>
                                        <?php $page_link = get_sub_field('page_link'); ?>
                                        <?php if ($page_link) : ?>
                                            <a href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($page_link); ?></a>
                                        <?php endif; ?>
                                        <?php the_sub_field('page_link_text'); ?>
                                        <?php the_sub_field('booking_link_text'); ?>
                                        <?php the_sub_field('booking_link_type'); ?>
                                        <?php the_sub_field('booking_link'); ?>
                                        <?php if (get_sub_field('open_in_new_tab') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php if (get_sub_field('afternoon_tea_change_parameters') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php the_sub_field('at_connectionid'); ?>
                                        <?php the_sub_field('at_conversionjs'); ?>
                                        <?php the_sub_field('at_restaurantid'); ?>
                                        <?php the_sub_field('at_sessionid'); ?>
                                        <?php the_sub_field('at_promotionid'); ?>
                                        <?php if (get_sub_field('res_change_parameters') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php the_sub_field('res_connectionid'); ?>
                                        <?php the_sub_field('res_conversionjs'); ?>
                                        <?php the_sub_field('res_restaurantid'); ?>
                                        <?php the_sub_field('res_sessionid'); ?>
                                        <?php the_sub_field('res_promotionid'); ?>
                                        <?php $offer_type_checked_values = get_sub_field('offer_type'); ?>
                                        <?php if ($offer_type_checked_values) : ?>
                                            <?php foreach ($offer_type_checked_values as $offer_type_value): ?>
                                                <?php echo esc_html($offer_type_value); ?>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <?php // no layouts found ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>

        <?php endif; ?>
    </section>
</article>
