<article id="post-<?php the_ID(); ?>" <?php post_class('t7-page-gallery-detail'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php the_field('gallery_title'); ?>
            <?php $main_gallery_page_link = get_field('main_gallery_page_link'); ?>
            <?php if ($main_gallery_page_link) : ?>
                <a href="<?php echo esc_url($main_gallery_page_link); ?>"><?php echo esc_html($main_gallery_page_link); ?></a>
            <?php endif; ?>
            <?php if (get_field('restrict_slide_height') == 1) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if (have_rows('slide_type')): ?>
                <?php while (have_rows('slide_type')) : the_row(); ?>
                    <?php if (get_row_layout() == 'room_slide') : ?>
                        <?php $image = get_sub_field('image'); ?>
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php the_sub_field('slide_title'); ?>
                        <?php the_sub_field('rates_from_price'); ?>
                    <?php elseif (get_row_layout() == 'ordinary_slide') : ?>
                        <?php $image = get_sub_field('image'); ?>
                        <?php if ($image) : ?>
                            <img src="<?php echo esc_url($image['url']); ?>"
                                 alt="<?php echo esc_attr($image['alt']); ?>"/>
                        <?php endif; ?>
                        <?php the_sub_field('slide_title'); ?>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else: ?>
                <?php // no layouts found ?>
            <?php endif; ?>


        <?php endif; ?>
    </section>
</article>
