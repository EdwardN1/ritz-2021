<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */

global $template_name;

$template_name = 'Default';

get_header(); ?>

    <div class="content">

        <div class="inner-content">

            <main role="main">

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php if ( is_block_page() ): ?>

						<?php get_template_part( 'parts/loop', 'page' ); ?>

					<?php else: ?>
						<?php if ( have_rows( 'rows' ) ) : ?>
							<?php while ( have_rows( 'rows' ) ) : the_row(); ?>
								<?php if ( get_sub_field( 'full_width' ) == 1 ) : ?>
                                    <div class="grid-container">
										<?php the_sub_field( 'full_width_content' ); ?>
                                    </div>
								<?php else : ?>
                                    <div class="grid-container">
                                        <div class="grid-x grid-padding-x">
                                            <div class="cell large-6 medium-6 small-12"><?php the_sub_field( 'column_1_content' ); ?></div>
                                            <div class="cell large-6 medium-6 small-12"><?php the_sub_field( 'column_2_content' ); ?></div>
                                        </div>
                                    </div>
								<?php endif; ?>

							<?php endwhile; ?>
						<?php else : ?>
							<?php get_template_part( 'parts/loop', 'page' ); ?>
						<?php endif; ?>
					<?php endif; ?>

				<?php endwhile; endif; ?>

            </main> <!-- end #main -->

			<?php //get_sidebar(); ?>

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>