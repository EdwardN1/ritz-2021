<?php
// Template Name: T6 Gallery Page
global $template_name;

$template_name = 'T6 Gallery Page';

global $ritz_template_name;
$ritz_template_name = 'ritz-old-template';

get_header();
?>
<div class="content">

	<div class="inner-content">

		<main role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'old/page', 'gallery' ); ?>

			<?php endwhile; endif; ?>

		</main> <!-- end #main -->

		<?php //get_sidebar(); ?>

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>