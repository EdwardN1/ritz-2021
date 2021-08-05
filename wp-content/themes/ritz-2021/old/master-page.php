<article id="post-<?php the_ID(); ?>" <?php post_class('master-page'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php if (have_rows('rows')): ?>
                <?php while (have_rows('rows')) : the_row(); ?>
                    <?php if (get_row_layout() == 'row_divider') : ?>
                        <?php if (get_sub_field('include_horizontal_line') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('remove_bottom_margin') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'content_editor') : ?>
                        <?php if (get_sub_field('include_top_divider') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('content'); ?>
                    <?php elseif (get_row_layout() == 'home_page_image_slider') : ?>
                        <?php if (get_sub_field('add_booking_bar') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('make_first_slide_heading_h1_tag') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
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
                    <?php elseif (get_row_layout() == 'careers_image_slider') : ?>
                        <?php if (have_rows('slides')) : ?>
                            <?php while (have_rows('slides')) : the_row(); ?>
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php the_sub_field('caption'); ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'full_width_panel') : ?>
                        <?php the_sub_field('content'); ?>
                        <?php if (get_sub_field('reveal_content_on_mouseover') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('make_headings_visible') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php $image = get_sub_field('image'); ?>
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php if (get_sub_field('use_lighter_image_overlay') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('panel_footer'); ?>
                        <?php if (get_sub_field('include_link') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('link_text'); ?>
                        <?php the_sub_field('link_type'); ?>
                        <?php the_sub_field('url'); ?>
                        <?php $page_link = get_sub_field('page_link'); ?>
                        <?php if ($page_link) : ?>
                            <a href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($page_link); ?></a>
                        <?php endif; ?>
                        <?php the_sub_field('youtube_link'); ?>
                    <?php elseif (get_row_layout() == 'two_panel_row') : ?>
                        <?php // The image_select field type is not supported in this version of the plugin. ?>
                        <?php // Contact http://www.hookturn.io to request support for this field type. ?>
                        <?php if (get_sub_field('scale_to_screen_width') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (have_rows('columns')) : ?>
                            <?php while (have_rows('columns')) : the_row(); ?>
                                <?php if (have_rows('content')) : ?>
                                    <?php while (have_rows('content')) : the_row(); ?>
                                        <?php the_sub_field('content_position'); ?>
                                        <?php the_sub_field('content'); ?>
                                        <?php if (get_sub_field('reveal_content_on_mouseover') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php if (get_sub_field('animate_text_on_scroll') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php if (get_sub_field('make_headings_visible') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php if (get_sub_field('include_link') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php the_sub_field('link_text'); ?>
                                        <?php the_sub_field('link_type'); ?>
                                        <?php the_sub_field('url'); ?>
                                        <?php $page_link = get_sub_field('page_link'); ?>
                                        <?php if ($page_link) : ?>
                                            <a href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($page_link); ?></a>
                                        <?php endif; ?>
                                        <?php the_sub_field('youtube_link'); ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php the_sub_field('type'); ?>
                                <?php the_sub_field('colour'); ?>
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php if (get_sub_field('animate_on_scroll') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php if (get_sub_field('remove_image_overlay') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php if (get_sub_field('use_lighter_overlay') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php the_sub_field('youtube_video_link'); ?>
                                <?php if (get_sub_field('add_footer') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php the_sub_field('panel_footer'); ?>
                                <?php the_sub_field('text_colour'); ?>
                                <?php the_sub_field('heading_font'); ?>
                                <?php the_sub_field('heading_font_h3'); ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'grid_row') : ?>
                        <?php // The image_select field type is not supported in this version of the plugin. ?>
                        <?php // Contact http://www.hookturn.io to request support for this field type. ?>
                        <?php if (get_sub_field('include_ritz_ribbon_top') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('top_ribbon_description'); ?>
                        <?php if (get_sub_field('hide_ribbon_icon') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('include_ritz_ribbon_bottom') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('bottom_ribbon_description'); ?>
                        <?php $image = get_sub_field('image'); ?>
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php if (get_sub_field('link_to_a_tour') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('select_a_360_tour'); ?>
                        <?php if (get_sub_field('dark_icon') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (get_sub_field('center_360_icon') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('gr_heading'); ?>
                        <?php the_sub_field('content'); ?>
                    <?php elseif (get_row_layout() == 'three_panel_row') : ?>
                        <?php the_sub_field('title'); ?>
                        <?php if (have_rows('panels')) : ?>
                            <?php while (have_rows('panels')) : the_row(); ?>
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php the_sub_field('description'); ?>
                                <?php the_sub_field('youtube_video_link'); ?>
                                <?php the_sub_field('link_text'); ?>
                                <?php the_sub_field('link_type'); ?>
                                <?php the_sub_field('url'); ?>
                                <?php $page_link = get_sub_field('page_link'); ?>
                                <?php if ($page_link) : ?>
                                    <a href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($page_link); ?></a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'multi_panel_row') : ?>
                        <?php // The image_select field type is not supported in this version of the plugin. ?>
                        <?php // Contact http://www.hookturn.io to request support for this field type. ?>
                        <?php if (get_sub_field('scale_to_screen_width') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (have_rows('panels')) : ?>
                            <?php while (have_rows('panels')) : the_row(); ?>
                                <?php if (have_rows('content')) : ?>
                                    <?php while (have_rows('content')) : the_row(); ?>
                                        <?php the_sub_field('content_position'); ?>
                                        <?php the_sub_field('content'); ?>
                                        <?php if (get_sub_field('animate_text_on_scroll') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php if (get_sub_field('include_link') == 1) : ?>
                                            <?php // echo 'true'; ?>
                                        <?php else : ?>
                                            <?php // echo 'false'; ?>
                                        <?php endif; ?>
                                        <?php the_sub_field('link_text'); ?>
                                        <?php the_sub_field('link_type'); ?>
                                        <?php the_sub_field('url'); ?>
                                        <?php $page_link = get_sub_field('page_link'); ?>
                                        <?php if ($page_link) : ?>
                                            <a href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($page_link); ?></a>
                                        <?php endif; ?>
                                        <?php the_sub_field('youtube_link'); ?>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                                <?php the_sub_field('type'); ?>
                                <?php $image = get_sub_field('image'); ?>
                                <?php if ($image) : ?>
                                    <img src="<?php echo esc_url($image['url']); ?>"
                                         alt="<?php echo esc_attr($image['alt']); ?>"/>
                                <?php endif; ?>
                                <?php if (get_sub_field('animate_image_on_scroll') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php the_sub_field('colour'); ?>
                                <?php the_sub_field('text_colour'); ?>
                                <?php the_sub_field('heading_font_h2'); ?>
                                <?php the_sub_field('heading_font_h3'); ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'landing_page_panel') : ?>
                        <?php $image = get_sub_field('image'); ?>
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php the_sub_field('title'); ?>
                        <?php the_sub_field('description'); ?>
                        <?php if (get_sub_field('exclude_price') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php the_sub_field('price_description'); ?>
                        <?php the_sub_field('price'); ?>
                        <?php if (get_sub_field('exclude_left_link') == 1) : ?>
                            <?php // echo 'true'; ?>
                        <?php else : ?>
                            <?php // echo 'false'; ?>
                        <?php endif; ?>
                        <?php if (have_rows('left_link')) : ?>
                            <?php while (have_rows('left_link')) : the_row(); ?>
                                <?php the_sub_field('left_link_text'); ?>
                                <?php the_sub_field('left_link_type'); ?>
                                <?php $left_link = get_sub_field('left_link'); ?>
                                <?php if ($left_link) : ?>
                                    <a href="<?php echo esc_url($left_link); ?>"><?php echo esc_html($left_link); ?></a>
                                <?php endif; ?>
                                <?php $left_link_term = get_sub_field('left_link_term'); ?>
                                <?php if ($left_link_term) : ?>
                                    <?php $get_terms_args = array(
                                        'taxonomy' => 'category',
                                        'hide_empty' => 0,
                                        'include' => $left_link_term,
                                    ); ?>
                                    <?php $terms = get_terms($get_terms_args); ?>
                                    <?php if ($terms) : ?>
                                        <?php foreach ($terms as $term) : ?>
                                            <a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php the_sub_field('left_link_url'); ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                        <?php if (have_rows('right_link')) : ?>
                            <?php while (have_rows('right_link')) : the_row(); ?>
                                <?php the_sub_field('right_link_text'); ?>
                                <?php the_sub_field('right_link_type'); ?>
                                <?php if (have_rows('accommodation_codes')) : ?>
                                    <?php while (have_rows('accommodation_codes')) : the_row(); ?>
                                        <?php the_sub_field('key'); ?>
                                        <?php the_sub_field('value'); ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>
                                <?php the_sub_field('right_link'); ?>
                                <?php if (get_sub_field('open_in_new_tab') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php if (get_sub_field('at_change_parameters') == 1) : ?>
                                    <?php // echo 'true'; ?>
                                <?php else : ?>
                                    <?php // echo 'false'; ?>
                                <?php endif; ?>
                                <?php the_sub_field('at_connection_id'); ?>
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
                                <?php $right_link = get_sub_field('right_link'); ?>
                                <?php if ($right_link) : ?>
                                    <a href="<?php echo esc_url($right_link); ?>"><?php echo esc_html($right_link); ?></a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'popup_icon_strip') : ?>
                        <?php the_sub_field('heading'); ?>
                        <?php if (have_rows('popups')) : ?>
                            <?php while (have_rows('popups')) : the_row(); ?>
                                <?php the_sub_field('title'); ?>
                                <?php $icon = get_sub_field('icon'); ?>
                                <?php if ($icon) : ?>
                                    <img src="<?php echo esc_url($icon['url']); ?>"
                                         alt="<?php echo esc_attr($icon['alt']); ?>"/>
                                <?php endif; ?>
                                <?php the_sub_field('popup_content'); ?>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <?php // no rows found ?>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'strap_line') : ?>
                        <?php the_sub_field('message'); ?>
                        <?php the_sub_field('link_text'); ?>
                        <?php the_sub_field('link_type'); ?>
                        <?php the_sub_field('url'); ?>
                        <?php $page_link = get_sub_field('page_link'); ?>
                        <?php if ($page_link) : ?>
                            <a href="<?php echo esc_url($page_link); ?>"><?php echo esc_html($page_link); ?></a>
                        <?php endif; ?>
                    <?php elseif (get_row_layout() == 'footer_promotion') : ?>
                        <?php // warning: layout 'footer_promotion' has no sub fields ?>
                    <?php elseif (get_row_layout() == 'raw_code') : ?>
                        <pre><code><?php echo esc_html(get_sub_field('code_block')); ?></code></pre>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <?php // no layouts found ?>
            <?php endif; ?>
            <?php if (get_field('remove_follow_us_from_header') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (get_field('remove_reservations_link_in_header') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (get_field('remove_booking_bar') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (get_field('use_alternate_social_media') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('facebook_link'); ?>
            <?php the_field('instagram_link'); ?>
            <?php the_field('twitter_link'); ?>
            <?php the_field('youtube_link'); ?>
            <?php the_field('linkedin_link'); ?>
            <?php if (get_field('redirect_bookable') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php $restaurant_redirect_page = get_field('restaurant_redirect_page'); ?>
            <?php if ($restaurant_redirect_page) : ?>
                <a href="<?php echo esc_url($restaurant_redirect_page); ?>"><?php echo esc_html($restaurant_redirect_page); ?></a>
            <?php endif; ?>
            <?php $tea_redirect_page = get_field('tea_redirect_page'); ?>
            <?php if ($tea_redirect_page) : ?>
                <a href="<?php echo esc_url($tea_redirect_page); ?>"><?php echo esc_html($tea_redirect_page); ?></a>
            <?php endif; ?>
            <?php $garden_bar_redirect_page = get_field('garden_bar_redirect_page'); ?>
            <?php if ($garden_bar_redirect_page) : ?>
                <a href="<?php echo esc_url($garden_bar_redirect_page); ?>"><?php echo esc_html($garden_bar_redirect_page); ?></a>
            <?php endif; ?>
            <?php if (get_field('add_top_info_bar') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (have_rows('geo_targetted_layout')) : ?>
                <?php while (have_rows('geo_targetted_layout')) : the_row(); ?>
                    <?php // The geot_field field type is not supported in this version of the plugin. ?>
                    <?php // Contact http://www.hookturn.io to request support for this field type. ?>
                    <?php if (get_sub_field('make_default_content') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (have_rows('rows_g')): ?>
                        <?php while (have_rows('rows_g')) : the_row(); ?>
                            <?php if (get_row_layout() == 'row_divider') : ?>
                                <?php // warning: layout 'row_divider' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'content_editor') : ?>
                                <?php // warning: layout 'content_editor' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'home_page_image_slider') : ?>
                                <?php // warning: layout 'home_page_image_slider' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'careers_image_slider') : ?>
                                <?php // warning: layout 'careers_image_slider' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'full_width_panel') : ?>
                                <?php // warning: layout 'full_width_panel' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'two_panel_row') : ?>
                                <?php // warning: layout 'two_panel_row' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'three_panel_row') : ?>
                                <?php // warning: layout 'three_panel_row' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'multi_panel_row') : ?>
                                <?php // warning: layout 'multi_panel_row' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'popup_icon_strip') : ?>
                                <?php // warning: layout 'popup_icon_strip' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'strap_line') : ?>
                                <?php // warning: layout 'strap_line' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'footer_promotion') : ?>
                                <?php // warning: layout 'footer_promotion' has no sub fields ?>
                            <?php elseif (get_row_layout() == 'raw_code') : ?>
                                <?php // warning: layout 'raw_code' has no sub fields ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <?php // no layouts found ?>
                    <?php endif; ?>
                    <?php if (get_sub_field('remove_follow_us_from_header') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (get_sub_field('remove_reservations_link_in_header') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (get_sub_field('remove_booking_bar') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (get_sub_field('use_alternate_social_media') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php the_sub_field('facebook_link'); ?>
                    <?php the_sub_field('twitter_link'); ?>
                    <?php the_sub_field('instagram_link'); ?>
                    <?php the_sub_field('youtube_link'); ?>
                    <?php the_sub_field('linkedin_link'); ?>
                    <?php if (get_sub_field('customize_google_tracking_code') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <pre><code><?php echo esc_html(get_sub_field('custom_tracking_code')); ?></code></pre>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>

        <?php endif; ?>
    </section>
</article>
