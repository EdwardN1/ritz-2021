<?php
// Template Name: T11 Sitemap
global $template_name;

$template_name = 'T11 Sitemap';
get_header();
?>
<div class="content">

	<div class="inner-content">

		<main role="main">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php get_template_part( 'old/page', 'sitemap' ); ?>

			<?php endwhile; endif; ?>

		</main> <!-- end #main -->

		<?php //get_sidebar(); ?>

	</div> <!-- end #inner-content -->

</div> <!-- end #content -->

<?php get_footer(); ?>