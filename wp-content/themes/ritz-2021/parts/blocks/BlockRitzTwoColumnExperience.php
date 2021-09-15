<?php
/**
 * Block template file: /parts/blocks/BlockRitzTwoColumnExperience.php
 *
 * Ritz Two Column Experience Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @var bool $is_preview True during AJAX preview.
 * @var array $block The block settings and attributes.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-two-column-experience-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-two-column-experience-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<?php
if ( ( isset( $block['data']['ritz_two_column_experience_block_preview_image_help'] ) ) && ( $is_preview ) ) :    /* rendering in inserter preview  */

	echo '<img src="' . $block['data']['ritz_two_column_experience_block_preview_image_help'] . '" style="width:100%; height:auto;">';

	return;
endif;

?>

<style type="text/css">
    .js .tmce-active .wp-editor-area {
        color: #000000 !important;
    }

    <?php echo '#' . $id; ?>
    {
    /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php $image_position = get_field( 'image_position' ); ?>
	<?php $image = get_field( 'image' ); ?>
	<?php $mobile_image = get_field( 'mobile_image' ); ?>
	<?php $image_iframe_link = get_field( 'image_iframe_link' ); ?>
    <div class="grid-x show-for-medium">
        <div class="cell large-6 medium-6 small-12">
			<?php if ( ( $image_iframe_link != '' ) && ( ! $is_preview ) ): ?>
				<?php $uniqueID = uniqid(); ?>
                <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal data-id="<?php echo $uniqueID; ?>">
                    <div class="virtual-tour">
                        <iframe src="<?php echo $image_iframe_link; ?>" style="width: 100%; height: 60vh;"></iframe>
                    </div>
                    <span class="close-reveal-modal" data-close>&times;</span>
                </div>
			<?php endif; ?>
			<?php
			if ( $image_position == 'Left' ) {
				?>
                <div class="left">
                    <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">
						<?php if ( $image_iframe_link != '' ): ?>
                            <a data-open="<?php echo $uniqueID; ?>" class="mag-reveal iframe"></a>
						<?php endif; ?>
                    </div>
                </div>

				<?php
			} else {
				?>
                <div class="left">
					<?php $heading = get_field( 'heading' ); ?>
					<?php if ( $heading != '' ): ?>
                        <div class="heading"><h3><?php echo $heading; ?></h3></div>
					<?php endif; ?>
                    <div class="content"><?php the_field( 'content' ); ?></div>
					<?php $page_link = get_field( 'page_link' ); ?>
					<?php if ( $page_link ) : ?>
                        <div class="link"><a class="button-underlined" href="<?php echo esc_url( $page_link ); ?>"><?php the_field( 'page_link_text' ); ?></a></div>
					<?php endif; ?>
                </div>
				<?php
			}
			?>
        </div>
        <div class="cell large-6 medium-6 small-12">
			<?php
			if ( $image_position == 'Right' ) {
				?>
                <div class="right">
                    <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">
						<?php if ( $image_iframe_link != '' ): ?>
                            <a data-open="<?php echo $uniqueID; ?>" class="mag-reveal iframe"></a>
						<?php endif; ?>
                    </div>
                </div>
				<?php
			} else {
				?>
                <div class="right">
					<?php $heading = get_field( 'heading' ); ?>
					<?php if ( $heading != '' ): ?>
                        <div class="heading"><h3><?php echo $heading; ?></h3></div>
					<?php endif; ?>
                    <div class="content"><?php the_field( 'content' ); ?></div>
					<?php $page_link = get_field( 'page_link' ); ?>
					<?php if ( $page_link ) : ?>
                        <div class="link"><a class="button-underlined" href="<?php echo esc_url( $page_link ); ?>"><?php the_field( 'page_link_text' ); ?></a></div>
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
				<?php $heading = get_field( 'heading' ); ?>
				<?php if ( $heading != '' ): ?>
                    <div class="heading"><h3><?php echo $heading; ?></h3></div>
				<?php endif; ?>
                <div class="content"><?php the_field( 'content' ); ?></div>
				<?php $page_link = get_field( 'page_link' ); ?>
				<?php if ( $page_link ) : ?>
                    <div class="link"><a class="button-underlined" href="<?php echo esc_url( $page_link ); ?>"><?php the_field( 'page_link_text' ); ?></a></div>
				<?php endif; ?>
            </div>
        </div>
        <div class="cell large-6 medium-6 small-12">
            <div class="right">
				<?php if ( ( get_field( 'add_mobile_image' ) == 1 ) && ( $mobile_image ) ) : ?>
                <div class="image" style="background-image: url(<?php echo esc_url( $mobile_image['url'] ); ?>)">
					<?php else: ?>
                    <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">
						<?php endif; ?>
						<?php if ( $image_iframe_link != '' ): ?>
                            <a href="<?php echo $image_iframe_link; ?>" class="mag-reveal iframe" target="_blank"></a>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
