<?php
/**
 * Block template file: /parts/blocks/BlockRitzPopupButtonRow.php
 *
 * Ritz Popup Button Row Block Block Template.
 *
 * @var   array $block The block settings and attributes.
 * @var   string $content The block inner HTML (empty).
 * @var   bool $is_preview True during AJAX preview.
 * @var   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-popup-button-row-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-popup-button-row-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<?php
if ( ( isset( $block['data']['ritz_popup_button_row_block_preview_image_help'] ) ) && ( $is_preview ) ) :    /* rendering in inserter preview  */

	echo '<img src="' . $block['data']['ritz_popup_button_row_block_preview_image_help'] . '" style="width:100%; height:auto;">';

	return;
endif;

?>

<style type="text/css">
    <?php echo '#' . $id; ?>
    {
    /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php $heading = get_field( "heading" ); ?>
	<?php if ( have_rows( 'buttons' ) ) : ?>
		<?php if ( $heading != '' ): ?>
            <div class="heading"><?php echo $heading; ?></div>
		<?php endif; ?>
        <div class="grid-x grid-padding-x">
			<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
				<?php $uniqueID = uniqid(); ?>
				<?php $content = get_sub_field( 'content' ); ?>
				<?php if ( ! $is_preview ): ?>
                    <div id="<?php echo $uniqueID; ?>" class="reveal-modal button-popup" data-reveal data-id="<?php echo $uniqueID; ?>">
                        <div class="info-box">
							<?php echo $content; ?>
                        </div>
                        <span class="close-reveal-modal" data-close>&times;</span>
                    </div>
				<?php endif; ?>
                <div class="cell large-auto medium-6 small-12 text-center">
					<?php $title = get_sub_field( 'title' ); ?>
                    <div class="button-container">
                        <a data-open="<?php echo $uniqueID; ?>" class="link button-underlined long feature-modal-btn"><?php echo $title; ?></a>
                    </div>
                </div>

			<?php endwhile; ?>
        </div>
	<?php else : ?>
		<?php // no rows found ?>
	<?php endif; ?>
</div>