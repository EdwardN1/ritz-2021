<article id="post-<?php the_ID(); ?>" <?php post_class('t12-page-virtual-tour'); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php $desktop_tour = get_field( 'desktop_tour' ); ?>
            <?php if ( $desktop_tour ) : ?>
                <?php $url = wp_get_attachment_url( $desktop_tour ); ?>
                <a href="<?php echo esc_url( $url ); ?>">Download File</a>
            <?php endif; ?>
            <?php $mobile_tour = get_field( 'mobile_tour' ); ?>
            <?php if ( $mobile_tour ) : ?>
                <?php $url = wp_get_attachment_url( $mobile_tour ); ?>
                <a href="<?php echo esc_url( $url ); ?>">Download File</a>
            <?php endif; ?>

        <?php endif;?>
    </section>
</article>
