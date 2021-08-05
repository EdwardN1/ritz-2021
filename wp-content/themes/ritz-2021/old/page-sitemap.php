<article id="post-<?php the_ID(); ?>" <?php post_class('t11-page-sitemap'); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>

        <?php endif;?>
    </section>
</article>
