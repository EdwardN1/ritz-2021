<div id="ritz-main-image-gallery" class="main-image-gallery">
	<?php while (have_rows('slides')) : the_row(); ?>
		<?php $slide = get_sub_field('image'); ?>
		<?php if ($slide) : ?>
			<?php //error_log('Loaded section'); ?>
			<div class="slider-slide">
				<?php
				$slide_background = ' top-gradient';
				?>
				<div class="slide-container" style="background-image: url(<?php echo esc_url($slide['url']); ?>)">
					<div class="slide-overlay<?php echo $slide_background;?>">
						&nbsp;
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
</div>