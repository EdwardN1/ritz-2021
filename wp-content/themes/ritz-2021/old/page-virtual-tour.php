<article id="post-<?php the_ID(); ?>" <?php post_class('t12-page-virtual-tour'); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <iframe src="https://media.theritzlondon.com/" style="width: 100%; height: 75vh;"></iframe>

        <?php endif;?>
    </section>
</article>
