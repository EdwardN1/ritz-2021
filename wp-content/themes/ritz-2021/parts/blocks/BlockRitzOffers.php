<?php
/**
 * Block template file: /parts/blocks/BlockRitzOffers.php
 *
 * Ritz Offers Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @var   bool $is_preview True during AJAX preview.
 * @var   array $block The block settings and attributes.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-offers-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
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
if ( ( isset( $block['data']['ritz_offers_block_preview_image_help'] ) ) && ( $is_preview ) ) :    /* rendering in inserter preview  */

	echo '<img src="' . $block['data']['ritz_offers_block_preview_image_help'] . '" style="width:100%; height:auto;">';

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
	<?php $include_category_filter = get_field( 'include_category_filter' ); ?>
	<?php $selection_type = get_field( 'selection_type' ); ?>
	<?php
	$termIDS    = array();
	$offersGrid = '';
	if ( $selection_type == 'Selected Offers' ) {
		if ( have_rows( 'selected_offers' ) ) :
			ob_start();
			while ( have_rows( 'selected_offers' ) ) :
				the_row();
				$offer = get_sub_field( 'offer' );
				if ( $offer ) :
					$post = $offer;
					setup_postdata( $post );
					$categoryID = get_field( 'categories' );
					$term       = get_term_by( 'id', $categoryID, 'offercategory' );
					$termClass  = '';
					if ( $term ) :
						$termClass = ' ' . seoUrl( esc_html( $term->name ) );
						if ( ! in_array( $categoryID, $termIDS ) ) {
							$termIDS[] = $categoryID;
						}
					endif;
					?>
					<?php $image = get_field( 'image' ); ?>
                    <div class="cell large-4 medium-4 small-12<?php echo $termClass; ?>">
                        <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)"></div>
                        <div class="heading"><?php the_title(); ?></div>
                        <div class="description"><?php the_field( 'description' ); ?></div>
                        <div class="buttons-row">
                            <div class="grid-x grid-padding-x">
                                <div class="cell auto text-right">
									<?php $page = get_field( 'page' ); ?>
									<?php if ( $page ) : ?>
                                        <a href="<?php echo esc_url( $page ); ?>" class="button-underlined long"><?php the_field( 'page_link_text' ); ?></a>
									<?php endif; ?>
                                </div>
                                <div class="cell auto text-left">
									<?php
									$booking_options   = get_field( 'booking_type' );
									$booking_link_text = get_field( 'booking_link_text' );
									if ( $booking_options == 'AZDS' ) {
										if ( have_rows( 'azds' ) ) :
											$selector = '?';
											$query     = '';
											while ( have_rows( 'azds' ) ) : the_row();
												$key      = get_sub_field( 'key' );
												$value    = get_sub_field( 'value' );
												$query    .= $selector . $key . '=' . $value;
												$selector = '&';
											endwhile;
											?>
                                            <a href="#/booking/step-1<?php echo $query; ?>"
                                               class="button-ritz"><?php echo $booking_link_text; ?></a>
										<?php
										endif;
									};
									if ( $booking_options == 'Bookatable' ) {
										if ( have_rows( 'bookatable' ) ) :
											$book_data = '';
											while ( have_rows( 'bookatable' ) ) : the_row();
												$book_data = ' data-bookatable data-connectionid="' . get_sub_field( 'connectionid' ) . '"';
												$book_data .= ' data-restaurantid="' . get_sub_field( 'restaurantid' ) . '"';
												$book_data .= ' data-basecolor="' . get_sub_field( 'basecolor' ) . '"';
												$book_data .= ' data-promotionid="' . get_sub_field( 'promotionid' ) . '"';
												$book_data .= ' data-sessionid="' . get_sub_field( 'sessionid' ) . '"';
												$book_data .= ' data-conversionjs="' . get_sub_field( 'conversionjs' ) . '"';
												$book_data .= ' data-gaaccountnumber="' . get_sub_field( 'gaaccountnumber' ) . '"';
											endwhile;
											if ( $book_data != '' ) {
												?>
                                                <a href="#" <?php echo $book_data; ?>
                                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
												<?php
											}
										endif;
									};
									?>
                                </div>
                            </div>
                        </div>
                    </div>
					<?php
					wp_reset_postdata();
				endif;
			endwhile;
			$offersGrid = ob_get_clean();
			if ( $include_category_filter ) {
				if ( $termIDS ) {
					?>
                    <div class="filter-row">
                        <div class="grid-x"><div class="cell auto"></div><div class="filter-cell selected"><a data-filter-class="all">All</a></div>
							<?php
							foreach ( $termIDS as $term_ID ) {
								$term       = get_term_by( 'id', $term_ID, 'offercategory' );
								$term_name  = $term->name;
								$term_class = seoUrl( $term_name );
								?>
                                   <div class="cell shrink">
                                       <div class="filter-cell">
                                           <a data-filter-class="<?php echo $term_class;?>"><?php echo $term_name;?></a>
                                       </div>
                                   </div>
								<?php
							}
							?>
                        </div>
                    </div>
					<?php
				}
			}
			echo '<div class="grid-x">' . $offersGrid . '</div>';
		endif;
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
			'taxonomy'   => 'offercategory',
			'hide_empty' => 0,
			'include'    => $show_all_offers_for_category,
		); ?>
		<?php $terms = get_terms( $get_terms_args ); ?>
		<?php if ( $terms ) : ?>
			<?php foreach ( $terms as $term ) : ?>
                <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
			<?php endforeach; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>