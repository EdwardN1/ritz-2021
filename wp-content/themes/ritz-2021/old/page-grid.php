<article id="post-<?php the_ID(); ?>" <?php post_class('t5-page-grid'); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
        <?php if (is_block_page()): ?>
            <?php the_content(); ?>
        <?php else: ?>
            <?php if ( get_field( 'select_a_tour' ) == 1 ) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php $virtual_tour = get_field( 'virtual_tour' ); ?>
            <?php if ( $virtual_tour ) : ?>
                <?php $url = wp_get_attachment_url( $virtual_tour ); ?>
                <a href="<?php echo esc_url( $url ); ?>">Download File</a>
            <?php endif; ?>
            <?php $mobile_virtual_tour = get_field( 'mobile_virtual_tour' ); ?>
            <?php if ( $mobile_virtual_tour ) : ?>
                <?php $url = wp_get_attachment_url( $mobile_virtual_tour ); ?>
                <a href="<?php echo esc_url( $url ); ?>">Download File</a>
            <?php endif; ?>
            <?php if ( get_field( 'use_an_iframe' ) == 1 ) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field( 'iframe_source_url' ); ?>
            <?php if ( have_rows( 'slider' ) ) : ?>
                <?php while ( have_rows( 'slider' ) ) : the_row(); ?>
                    <?php $slide_image = get_sub_field( 'slide_image' ); ?>
                    <?php if ( $slide_image ) : ?>
                        <img src="<?php echo esc_url( $slide_image['url'] ); ?>" alt="<?php echo esc_attr( $slide_image['alt'] ); ?>" />
                    <?php endif; ?>
                    <?php the_sub_field( 'slide_description' ); ?>
                    <?php the_sub_field( 'slide_title' ); ?>
                    <?php the_sub_field( 'top_offset' ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( get_field( 'use_breadcrumbs' ) == 1 ) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php if ( get_field( 'automatic_breadcrumbs' ) == 1 ) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>
            <?php the_field( 'breadcrumb_link_text' ); ?>
            <?php $breadcrumb_link = get_field( 'breadcrumb_link' ); ?>
            <?php if ( $breadcrumb_link ) : ?>
                <a href="<?php echo esc_url( $breadcrumb_link); ?>"><?php echo esc_html( $breadcrumb_link ); ?></a>
            <?php endif; ?>
            <?php the_field( 'page_title_h1' ); ?>
            <?php the_field( 'introduction' ); ?>
            <?php if ( have_rows( 'rows' ) ) : ?>
                <?php while ( have_rows( 'rows' ) ) : the_row(); ?>
                    <?php the_sub_field( 'row_type' ); ?>
                    <?php the_sub_field( 'title' ); ?>
                    <?php $image = get_sub_field( 'image' ); ?>
                    <?php if ( $image ) : ?>
                        <img src="<?php echo esc_url( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['alt'] ); ?>" />
                    <?php endif; ?>
                    <?php the_sub_field( 'heading' ); ?>
                    <?php the_sub_field( 'content' ); ?>
                    <?php if ( get_sub_field( 'add_page_link' ) == 1 ) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php $page_link = get_sub_field( 'page_link' ); ?>
                    <?php if ( $page_link ) : ?>
                        <a href="<?php echo esc_url( $page_link); ?>"><?php echo esc_html( $page_link ); ?></a>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( get_field( 'hide_booking_bar' ) == 1 ) : ?>
                <?php // echo 'true'; ?>
            <?php else : ?>
                <?php // echo 'false'; ?>
            <?php endif; ?>

        <?php endif;?>
    </section>
</article>
