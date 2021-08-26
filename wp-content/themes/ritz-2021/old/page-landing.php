<article id="post-<?php the_ID(); ?>" <?php post_class( 't2-page-landing' ); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
		<?php if ( is_block_page() ): ?>
			<?php the_content(); ?>
		<?php else: ?>
            <h1 class="text-center text-uppercase"><?php the_field( 'page_heading_h1' ); ?></h1>
            <div class="text-center page-summary"><?php the_field( 'page_summary' ); ?></div>
			<?php $image_position = 'Left' ?>
			<?php if ( have_rows( 'rows' ) ) : ?>
				<?php while ( have_rows( 'rows' ) ) : the_row(); ?>
                    <div class="block-ritz-landing-page-room-block">
                        <div class="grid-x">
							<?php
							if ( $image_position == 'Right' ) {
								$image_position = 'Left';
							} else {
								$image_position = 'Right';
							}
							$img_div     = '';
							$content_div = '';
							$image       = get_sub_field( 'image' );
							ob_start();
							?>
                            <div class="image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">

                            </div>
							<?php
							$img_div = ob_get_contents();
							ob_end_clean();
							ob_start();
							?>
                            <div class="background">
                                <div class="title">
                                    <h3><?php the_sub_field( 'heading' ); ?></h3>
                                </div>
                                <div class="content">
									<?php the_sub_field( 'sub_heading' ); ?>
                                </div>
                                <div class="price">
									<?php the_sub_field( 'price_description' ) ?>&nbsp;<?php the_sub_field( 'price' ); ?>
                                </div>
                                <div class="links">
                                    <div class="grid-x">
                                        <div class="cell auto text-center">
											<?php
											$link_to   = get_sub_field( 'left_link_type' );
											$left_link = '';

											$link_title = get_sub_field( 'left_link_text' );
											$href       = '';
											if($link_to == 'Category Link') {
											    $href = '/category/press-releases';
                                            }
											if ( $link_to == 'Page Link' ) {
												$href = get_sub_field( 'left_link' );
											}
											if ( $link_to == 'URL' ) {
												$href = get_sub_field( 'left_link_url' );
											}
											if ( $href != '' ) {
												$left_link = '<a href="' . esc_url( $href ) . '" class="link button-underlined">' . $link_title . '</a>';
											}
											?>
											<?php echo $left_link; ?>
                                        </div>
                                        <div class="cell auto text-center">
											<?php
											$booking_options   = get_sub_field( 'right_link_type' );
											$booking_link_text = get_sub_field( 'right_link_text' );
											if ( $booking_options == 'Book Accommodation' ) {
												if ( have_rows( 'accommodation_codes' ) ) :
													$selector = '?';
													$query     = '';
													while ( have_rows( 'accommodation_codes' ) ) : the_row();
														$key      = get_sub_field( 'key' );
														$value    = get_sub_field( 'value' );
														$query    .= $selector . $key . '=' . $value;
														$selector = '&';
													endwhile;
													?>
                                                    <a href="#/booking/step-1<?php echo $query; ?>"
                                                       class="button-ritz"><?php echo $booking_link_text; ?></a>
												<?php else: ?>
                                                    <a href="#/booking/step-1<?php echo $query; ?>"
                                                       class="button-ritz"><?php echo $booking_link_text; ?></a>
												<?php endif;
											};
											$book_data = '';
											if ( $booking_options == 'Afternoon Tea' ) {
												if ( get_sub_field( 'at_change_parameters' ) == 1 ) {
													$book_data = ' data-bookatable data-connectionid="' . get_sub_field( 'at_connection_id' ) . '"';
													$book_data .= ' data-restaurantid="' . get_sub_field( 'at_restaurantid' ) . '"';
													$book_data .= ' data-basecolor="022e46"';
													$book_data .= ' data-promotionid="' . get_sub_field( 'at_promotionid' ) . '"';
													$book_data .= ' data-sessionid="' . get_sub_field( 'at_sessionid' ) . '"';
													$book_data .= ' data-conversionjs="' . get_sub_field( 'at_conversionjs' ) . '"';
													$book_data .= ' data-gaaccountnumber="UA-10196183-1"';
												} else {
													$book_data = ' data-bookatable data-connectionid="UK-THERITZLONDONGROUP:15903"';
													$book_data .= ' data-restaurantid="108845"';
													$book_data .= ' data-basecolor="022e46"';
													$book_data .= ' data-conversionjs="https://www.theritzlondon.com/Afternoon-Tea/Table-Booking"';
													$book_data .= ' data-gaaccountnumber="UA-10196183-1"';
												}
											};
											if ( $booking_options == 'Restaurant' ) {
												if ( get_sub_field( 'res_change_parameters' ) == 1 ) {
													$book_data = ' data-bookatable data-connectionid="' . get_sub_field( 'res_connectionid' ) . '"';
													$book_data .= ' data-restaurantid="' . get_sub_field( 'res_restaurantid' ) . '"';
													$book_data .= ' data-basecolor="022e46"';
													$book_data .= ' data-promotionid="' . get_sub_field( 'res_promotionid' ) . '"';
													$book_data .= ' data-sessionid="' . get_sub_field( 'res_sessionid' ) . '"';
													$book_data .= ' data-conversionjs="' . get_sub_field( 'res_conversionjs' ) . '"';
													$book_data .= ' data-gaaccountnumber="UA-10196183-1"';
												} else {
													$book_data = ' data-bookatable data-connectionid="UK-THERITZLONDONGROUP:15903';
													$book_data .= ' data-restaurantid="108823"';
													$book_data .= ' data-basecolor="022e46"';
													$book_data .= ' data-conversionjs="https://www.theritzlondon.com/Restaurant/Table-Booking"';
													$book_data .= ' data-gaaccountnumber="UA-10196183-1"';
												}
											};

											if ( $book_data != '' ) {
												?>
                                                <a href="#" <?php echo $book_data; ?>
                                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
												<?php
											}
											if ( $booking_options == 'URL' ) {
												?>
                                                <a href="<?php the_sub_field( 'right_link' ); ?>"
                                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
												<?php
											};
											if ( $booking_options == 'Link' ) {
												$page = get_sub_field( 'right_page_link' );
												?>
                                                <a href="<?php echo esc_url( $page ); ?>"><?php echo $booking_link_text; ?></a>
												<?php
											};
											?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<?php
							$content_div = ob_get_contents();
							ob_end_clean();
							$leftClass  = 'large-shrink medium-shrink';
							$rightClass = 'large-auto medium-auto';
							$topClass   = 'left';
							if ( $image_position == 'Left' ) {
								$leftClass  = 'large-auto medium-auto';
								$rightClass = 'large-shrink medium-shrink';
								$topClass   = 'right';
							}
							?>
                            <div class="cell <?php echo $leftClass; ?> small-12 left show-for-medium">
								<?php
								if ( $image_position == 'Left' ) :
									echo $img_div;
								else:
									echo $content_div;
								endif;
								?>
                            </div>
                            <div class="cell <?php echo $rightClass; ?> small-12 right show-for-medium">
								<?php
								if ( $image_position == 'Right' ):
									echo $img_div;
								else:
									echo $content_div;
								endif;
								?>
                            </div>
                            <div class="cell small-12 <?php echo $topClass; ?> hide-for-medium">
								<?php
								echo $content_div;
								?>
                            </div>
                            <div class="cell small-12 hide-for-medium">
								<?php
								echo $img_div;
								?>
                            </div>
                        </div>

                    </div>

				<?php endwhile; ?>
			<?php endif; ?>

		<?php endif; ?>
    </section>
</article>
