<article id="post-<?php the_ID(); ?>" <?php post_class('t3-page-detail'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php if (have_rows('slides')) : ?>
                <?php while (have_rows('slides')) : the_row(); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if (get_field('use_breadcrumb_link') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (get_field('automatic_breadcrumbs') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('breadcrumb_link_text'); ?>
            <?php $breadcrumb_link = get_field('breadcrumb_link'); ?>
            <?php if ($breadcrumb_link) : ?>
                <a href="<?php echo esc_url($breadcrumb_link); ?>"><?php echo esc_html($breadcrumb_link); ?></a>
            <?php endif; ?>
            <?php the_field('main_heading'); ?>
            <?php the_field('main_sub_heading'); ?>
            <?php the_field('main_content'); ?>
            <?php if (get_field('include_price') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('price_description'); ?>
            <?php the_field('price'); ?>
            <?php the_field('features_heading'); ?>
            <?php if (have_rows('feature_items')) : ?>
                <?php while (have_rows('feature_items')) : the_row(); ?>
                    <?php // The image_select field type is not supported in this version of the plugin. ?>
                    <?php // Contact http://www.hookturn.io to request support for this field type. ?>
                    <?php the_sub_field('description'); ?>
                    <?php the_sub_field('link_type'); ?>
                    <?php $link = get_sub_field('link'); ?>
                    <?php if ($link) : ?>
                        <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($link); ?></a>
                    <?php endif; ?>
                    <?php $file = get_sub_field('file'); ?>
                    <?php if ($file) : ?>
                        <a href="<?php echo esc_url($file['url']); ?>"><?php echo esc_html($file['filename']); ?></a>
                    <?php endif; ?>
                    <?php the_sub_field('url'); ?>
                    <?php if (get_sub_field('open_in_new_window') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php the_sub_field('popup_content'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php the_field('top_description'); ?>
            <?php if (get_field('top_external_link') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php $top_link = get_field('top_link'); ?>
            <?php if ($top_link) : ?>
                <a href="<?php echo esc_url($top_link); ?>"><?php echo esc_html($top_link); ?></a>
            <?php endif; ?>
            <?php the_field('top_url'); ?>
            <?php if (get_field('top_new_tab') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (get_field('hide_bottom_link') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('bottom_description'); ?>
            <?php the_field('bottom_link_type'); ?>
            <?php if (have_rows('accommodation_codes')) : ?>
                <?php while (have_rows('accommodation_codes')) : the_row(); ?>
                    <?php the_sub_field('key'); ?>
                    <?php the_sub_field('value'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if (get_field('afternoon_tea_change_parameters') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('at_connectionid'); ?>
            <?php the_field('at_conversionjs'); ?>
            <?php the_field('at_restaurantid'); ?>
            <?php the_field('at_sessionid'); ?>
            <?php the_field('at_promotionid'); ?>
            <?php if (get_field('res_change_parameters') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('res_connectionid'); ?>
            <?php the_field('res_conversionjs'); ?>
            <?php the_field('res_restaurantid'); ?>
            <?php the_field('res_sessionid'); ?>
            <?php the_field('res_promotionid'); ?>
            <?php $bottom_link = get_field('bottom_link'); ?>
            <?php if ($bottom_link) : ?>
                <a href="<?php echo esc_url($bottom_link); ?>"><?php echo esc_html($bottom_link); ?></a>
            <?php endif; ?>
            <?php the_field('bottom_url'); ?>
            <?php if (get_field('bottom_new_tab') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (get_field('bottom_file')) : ?>
                <a href="<?php the_field('bottom_file'); ?>">Download File</a>
            <?php endif; ?>
            <?php the_field('offers_heading'); ?>
            <?php if (have_rows('offer_tiles')) : ?>
                <?php while (have_rows('offer_tiles')) : the_row(); ?>
                    <?php $offer_image = get_sub_field('offer_image'); ?>
                    <?php if ($offer_image) : ?>
                        <img src="<?php echo esc_url($offer_image['url']); ?>"
                             alt="<?php echo esc_attr($offer_image['alt']); ?>"/>
                    <?php endif; ?>
                    <?php if (get_sub_field('external_link') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php $offer_link = get_sub_field('offer_link'); ?>
                    <?php if ($offer_link) : ?>
                        <a href="<?php echo esc_url($offer_link); ?>"><?php echo esc_html($offer_link); ?></a>
                    <?php endif; ?>
                    <?php the_sub_field('url'); ?>
                    <?php the_sub_field('link_text'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if (get_field('use_lightbox_links') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('lb_left_link_description'); ?>
            <?php the_field('lb_left_link_type'); ?>
            <?php if (have_rows('lb_left_link_gallery')) : ?>
                <?php while (have_rows('lb_left_link_gallery')) : the_row(); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <?php the_sub_field('title'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php the_field('lb_left_youtube_link'); ?>
            <?php if (get_field('lb_show_right_link') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('lb_right_link_description'); ?>
            <?php the_field('lb_right_link_type'); ?>
            <?php if (have_rows('lb_right_link_gallery')) : ?>
                <?php while (have_rows('lb_right_link_gallery')) : the_row(); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <?php the_sub_field('title'); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php the_field('lb_right_youtube_link'); ?>
            <?php the_field('footnote'); ?>
            <?php if (get_field('hide_booking_bar') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field('booking_bar'); ?>

        <?php endif; ?>
    </section>
</article>
