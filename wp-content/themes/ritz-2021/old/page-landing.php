<article id="post-<?php the_ID(); ?>" <?php post_class('t4-page-landing'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php the_field('page_heading_h1'); ?>
            <?php the_field('page_summary'); ?>
            <?php if (have_rows('rows')) : ?>
                <?php while (have_rows('rows')) : the_row(); ?>
                    <?php the_sub_field('heading'); ?>
                    <?php the_sub_field('sub_heading'); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <?php the_sub_field('price_description'); ?>
                    <?php the_sub_field('price'); ?>
                    <?php if (get_sub_field('exclude_price') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php if (get_sub_field('exclude_left_link') == 1) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
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
                    <?php $right_page_link = get_sub_field('right_page_link'); ?>
                    <?php if ($right_page_link) : ?>
                        <a href="<?php echo esc_url($right_page_link); ?>"><?php echo esc_html($right_page_link); ?></a>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php the_field('booking_bar'); ?>
            <?php if (get_field('force_accommodation_button_to_bottom') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (get_field('hide_booking_bar') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>

        <?php endif; ?>
    </section>
</article>
