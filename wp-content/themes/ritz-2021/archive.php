<?php
/**
 * Displays archive pages if a speicifc template is not set.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-hierarchy/
 */
global $archive_side;
$archive_side = 'left';

get_header(); ?>

    <div class="content">

        <div class="inner-content grid-x grid-margin-x grid-padding-x">

            <main class="main small-12 medium-12 large-12 cell" role="main">

                <header>
                    <?php
                    ?>
		    		<h1 class="page-title" style="text-align: center; margin-bottom: 0; text-transform: uppercase;"><?php //the_archive_title(); ?><?php
                        echo single_cat_title();
		    		?></h1>
		    	</header>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                    <!-- To see additional archive styles, visit the /parts directory -->
					<?php get_template_part( 'parts/loop', 'archive-ritz' ); ?>

					<?php if ( $archive_side == 'left' ) {
                        $archive_side = 'right';
					} else {
					    $archive_side = 'left';
                    }
					?>

				<?php endwhile; ?>

					<?php //joints_page_navi(); ?>

				<?php else : ?>

					<?php //get_template_part( 'parts/content', 'missing' ); ?>

				<?php endif; ?>

            </main> <!-- end #main -->

			<?php //get_sidebar(); ?>

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>