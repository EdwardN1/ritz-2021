<div id="ritz-main-image-gallery" class="main-image-gallery">
	<?php while (have_rows('slider')) : the_row(); ?>
		<?php $slide = get_sub_field('slide_image'); ?>
		<?php if ($slide) : ?>
			<?php //error_log('Loaded section'); ?>
			<div class="slider-slide">
				<?php
				$slide_heading = get_sub_field('slide_title');
				$slide_sub_heading = get_sub_field('slide_title');
				$slide_background = '';
				if($slide_heading == '') {
					if($slide_sub_heading == '') {
						$slide_background = ' top-gradient';
					}
				}
				if($slide_sub_heading == '') {
					if($slide_heading == '') {
						$slide_background = ' top-gradient';
					}
				}
				?>
				<div class="slide-container" style="background-image: url(<?php echo esc_url($slide['url']); ?>)">
					<div class="slide-overlay<?php echo $slide_background;?>">
						&nbsp;
					</div>
					<div class="slide-info">
						<h2 class="h1"><?php echo $slide_heading; ?></h2>
						<div class="sub-heading h2"><?php echo $slide_sub_heading; ?></div>
					</div>
				</div>
			</div>
		<?php endif; ?>
	<?php endwhile; ?>
</div>
