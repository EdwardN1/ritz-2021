<article id="post-<?php the_ID(); ?>" <?php post_class('t7-page-gallery-detail'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php if (have_rows('locations')) : ?>
                <?php while (have_rows('locations')) : the_row(); ?>
                    <?php the_sub_field('location_label_title'); ?>
                    <?php the_sub_field('location_heading'); ?>
                    <?php the_sub_field('location_sub_heading'); ?>
                    <?php $location_image = get_sub_field('location_image'); ?>
                    <?php if ($location_image) : ?>
                        <img src="<?php echo esc_url($location_image['url']); ?>"
                             alt="<?php echo esc_attr($location_image['alt']); ?>"/>
                    <?php endif; ?>
                    <?php the_sub_field('location_description'); ?>
                    <?php if (get_sub_field('dark_pin') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (get_sub_field('location_show_links') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (get_sub_field('location_use_two_links') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php the_sub_field('location_left_link_text'); ?>
                    <?php if (get_sub_field('location_left_use_url') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php $location_left_link = get_sub_field('location_left_link'); ?>
                    <?php if ($location_left_link) : ?>
                        <a href="<?php echo esc_url($location_left_link); ?>"><?php echo esc_html($location_left_link); ?></a>
                    <?php endif; ?>
                    <?php the_sub_field('location_left_url'); ?>
                    <?php the_sub_field('location_right_link_text'); ?>
                    <?php if (get_sub_field('location_right_use_url') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php $location_right_link = get_sub_field('location_right_link'); ?>
                    <?php if ($location_right_link) : ?>
                        <a href="<?php echo esc_url($location_right_link); ?>"><?php echo esc_html($location_right_link); ?></a>
                    <?php endif; ?>
                    <?php the_sub_field('location_right_url'); ?>
                    <?php $location = get_sub_field('location'); ?>
                    <?php if ($location) : ?>
                        <?php echo $location['address']; ?>
                        <?php echo $location['lat']; ?>
                        <?php echo $location['lng']; ?>
                        <?php echo $location['zoom']; ?>
                        <?php $optional_data_keys = array('street_number', 'street_name', 'city', 'state', 'post_code', 'country'); ?>
                        <?php foreach ($optional_data_keys as $key) : ?>
                            <?php if (isset($location[$key])) : ?>
                                <?php echo $location[$key]; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
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
            <?php the_field('breadcrumb_link_text'); ?>
            <?php $breadcrumb_link = get_field('breadcrumb_link'); ?>
            <?php if ($breadcrumb_link) : ?>
                <a href="<?php echo esc_url($breadcrumb_link); ?>"><?php echo esc_html($breadcrumb_link); ?></a>
            <?php endif; ?>
            <?php the_field('main_heading'); ?>
            <?php the_field('main_sub_heading'); ?>
            <?php the_field('main_content'); ?>
            <?php if (get_field('remove_direction_controls') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
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

        <?php endif; ?>
    </section>
</article>
