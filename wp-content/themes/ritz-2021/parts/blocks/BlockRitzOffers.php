<?php
/**
 * Block template file: /parts/blocks/BlockRitzOffers.php
 *
 * Ritz Offers Block Block Template.
 *
 * @var   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @var   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-offers-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-offers-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_offers_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

	echo '<img src="' . $block['data']['ritz_offers_block_preview_image_help'] . '" style="width:100%; height:auto;">';
	return;
endif;

?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
    /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php $include_category_filter = get_field( 'include_category_filter' ); ?>
	<?php $selection_type = get_field( 'selection_type' ); ?>
    <?php
    $postIDS = array();
    if($selection_type=='Selected Offers') {

    } else {

    }
    ?>
	<?php if ( have_rows( 'selected_offers' ) ) : ?>
		<?php while ( have_rows( 'selected_offers' ) ) : the_row(); ?>
			<?php $offer = get_sub_field( 'offer' ); ?>
			<?php if ( $offer ) : ?>
				<?php $post = $offer; ?>
				<?php setup_postdata( $post ); ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // no rows found ?>
	<?php endif; ?>
	<?php $show_all_offers_for_category = get_field( 'show_all_offers_for_category' ); ?>
	<?php if ( $show_all_offers_for_category ) : ?>
		<?php $get_terms_args = array(
			'taxonomy' => 'offercategory',
			'hide_empty' => 0,
			'include' => $show_all_offers_for_category,
		); ?>
		<?php $terms = get_terms( $get_terms_args ); ?>
		<?php if ( $terms ) : ?>
			<?php foreach ( $terms as $term ) : ?>
				<a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>