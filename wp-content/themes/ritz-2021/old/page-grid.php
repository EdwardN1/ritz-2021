<article id="post-<?php the_ID(); ?>" <?php post_class( 't5-page-grid' ); ?> role="article" itemscope itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
		<?php if ( is_block_page() ): ?>
			<?php the_content(); ?>
		<?php else: ?>

            <div class="text-center"><?php the_field( 'introduction' ); ?></div>
			<?php
			$reduced = '';
			if ( get_field( 'reduced_top_padding') == 1 ) {
			    error_log('reduced');
				$reduced = ' reduced';
			}
			?>
			<?php if ( have_rows( 'rows' ) ) : ?>
				<?php while ( have_rows( 'rows' ) ) : the_row(); ?>
					<?php $title = get_sub_field( 'title' ); ?>
					<?php if ( $title != '' ): ?>
                        <div class="block-ritz-underlined-title-block"><?php echo $title; ?></div>
					<?php endif; ?>
                    <div class="block-ritz-two-column-experience-block<?php echo $reduced; ?>">
						<?php $image_position = get_sub_field( 'row_type' ); ?>
						<?php $image = get_sub_field( 'image' ); ?>
                        <div class="grid-x show-for-medium">
                            <div class="cell large-6 medium-6 small-12">
								<?php
								if ( ( $image_position == 'Image Left' ) || ( ( $image_position == 'Full Width' ) ) ) {
									?>
                                    <div class="left">
                                        <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">

                                        </div>
                                    </div>
									<?php
								} else {
									?>
                                    <div class="left">
										<?php $heading = get_sub_field( 'heading' ); ?>
										<?php if ( $heading != '' ): ?>
                                            <div class="heading"><h3><?php echo $heading; ?></h3></div>
										<?php endif; ?>
                                        <div class="content"><?php the_sub_field( 'content' ); ?></div>
										<?php $page_link = get_sub_field( 'page_link' ); ?>
										<?php if ( $page_link ) : ?>
                                            <div class="link"><a class="button-underlined" href="<?php echo esc_url( $page_link ); ?>">Read More</a></div>
										<?php endif; ?>
                                    </div>
									<?php
								}
								?>
                            </div>
                            <div class="cell large-6 medium-6 small-12">
								<?php
								if ( $image_position == 'Image Right' ) {
									?>
                                    <div class="right">
                                        <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">

                                        </div>
                                    </div>
									<?php
								} else {
									?>
                                    <div class="right">
										<?php $heading = get_sub_field( 'heading' ); ?>
										<?php if ( $heading != '' ): ?>
                                            <div class="heading"><h3><?php echo $heading; ?></h3></div>
										<?php endif; ?>
                                        <div class="content"><?php the_sub_field( 'content' ); ?></div>
										<?php $page_link = get_sub_field( 'page_link' ); ?>
										<?php if ( $page_link ) : ?>
                                            <div class="link"><a class="button-underlined" href="<?php echo esc_url( $page_link ); ?>">Read More</a></div>
										<?php endif; ?>
                                    </div>
									<?php
								}
								?>
                            </div>
                        </div>

                        <div class="grid-x hide-for-medium">
                            <div class="cell large-6 medium-6 small-12">
                                <div class="left">
		                            <?php $heading = get_sub_field( 'heading' ); ?>
		                            <?php if ( $heading != '' ): ?>
                                        <div class="heading"><h3><?php echo $heading; ?></h3></div>
		                            <?php endif; ?>
                                    <div class="content"><?php the_sub_field( 'content' ); ?></div>
		                            <?php $page_link = get_sub_field( 'page_link' ); ?>
		                            <?php if ( $page_link ) : ?>
                                        <div class="link"><a class="button-underlined" href="<?php echo esc_url( $page_link ); ?>">Read More</a></div>
		                            <?php endif; ?>
                                </div>
                            </div>
                            <div class="cell large-6 medium-6 small-12">
                                <div class="right">
                                    <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
				<?php endwhile; ?>
			<?php endif; ?>
		<?php endif; ?>
    </section>
</article>
