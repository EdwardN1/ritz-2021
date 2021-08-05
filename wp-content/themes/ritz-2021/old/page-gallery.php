<article id="post-<?php the_ID(); ?>" <?php post_class('t6-page-gallery'); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php the_field('heading_h1'); ?>
            <?php the_field('description'); ?>
            <?php if (have_rows('tiles')) : ?>
                <?php while (have_rows('tiles')) : the_row(); ?>
                    <?php the_sub_field('heading_h2'); ?>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if ($image) : ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <?php endif; ?>
                    <?php $gallery_link = get_sub_field('gallery_link'); ?>
                    <?php if ($gallery_link) : ?>
                        <a href="<?php echo esc_url($gallery_link); ?>"><?php echo esc_html($gallery_link); ?></a>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>

        <?php endif; ?>
    </section>
</article>
