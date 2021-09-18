<?php
/**
 * Block template file: /parts/blocks/BlockRitzPageContentWithSidebar.php
 *
 * Ritz Page Content With Sidebar Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @var bool $is_preview True during AJAX preview.
 * @var array $block The block settings and attributes.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-page-content-with-sidebar-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-page-content-with-sidebar-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<?php
if ( ( isset( $block['data']['ritz_page_content_with_sidebar_block_preview_image_help'] ) ) && ( $is_preview ) ) :    /* rendering in inserter preview  */

	echo '<img src="' . $block['data']['ritz_page_content_with_sidebar_block_preview_image_help'] . '" style="width:100%; height:auto;">';

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
    <div class="page-content-desktop show-for-large">
        <div class="grid-x">
            <div class="cell shrink">
                <div class="left">
					<?php the_field( 'content' ); ?>
					<?php if ( get_field( 'price_line' ) != '' ): ?>
                        <div class="price-line">
							<?php the_field( 'price_line' ); ?>
                        </div>
					<?php else: ?>
                        <!--<p>&nbsp;</p>-->
					<?php endif; ?>
					<?php $booking_type = get_field( 'booking_type' ); ?>

					<?php if ( $booking_type != 'None' ): ?>
                        <div class="booking-line">
							<?php
							$booking_link_text = get_field( 'booking_button_text' );
							if ( $booking_type == 'Restaurant' ) {
								if ( have_rows( 'the_ritz_restaurant' ) ) :
									$book_data = '';
									while ( have_rows( 'the_ritz_restaurant' ) ) : the_row();
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
							}
							if ( $booking_type == 'Tea' ) {
								if ( have_rows( 'afternoon_tea' ) ) :
									$book_data = '';
									while ( have_rows( 'afternoon_tea' ) ) : the_row();
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
							}
							if ( $booking_type == 'Garden' ) {
								if ( have_rows( 'the_ritz_garden' ) ) :
									$book_data = '';
									while ( have_rows( 'the_ritz_garden' ) ) : the_row();
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
							}
							if ( $booking_type == 'Accomodation' ) {
								if ( have_rows( 'accomodation_codes' ) ) :
									$selector = '?';
									$query     = '';
									while ( have_rows( 'accomodation_codes' ) ) : the_row();
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
							}
							if ( $booking_type == 'Page Link' ) {
								$page = get_field( 'page_link' );
								?>
                                <a href="<?php echo esc_url( $page ); ?>"
                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
								<?php
							}
							if ( $booking_type == 'Email' ) {
								if ( have_rows( 'email_options' ) ) :
									while ( have_rows( 'email_options' ) ) : the_row();
										?>
                                        <a href="mailto:<?php the_sub_field( 'email_to_address' ); ?>?subject=<?php the_sub_field( 'subject' ); ?>&body=<?php the_sub_field( 'body' ); ?>"
                                           class="button-ritz"><?php echo $booking_link_text; ?></a>
									<?php
									endwhile;
								endif;
							};

							?>
                        </div>
					<?php endif; ?>

					<?php if ( have_rows( 'footer_lines' ) ) : ?>
						<?php if ( $booking_type == 'None' ): ?>
                            <div class="footer-lines short-top">
								<?php while ( have_rows( 'footer_lines' ) ) : the_row(); ?>
									<?php the_sub_field( 'line' ); ?><br>
								<?php endwhile; ?>
                            </div>
						<?php else: ?>
                            <div class="footer-lines">
								<?php while ( have_rows( 'footer_lines' ) ) : the_row(); ?>
									<?php the_sub_field( 'line' ); ?><br>
								<?php endwhile; ?>
                            </div>
						<?php endif; ?>
					<?php endif; ?>
                </div>
            </div>
            <div class="cell shrink">
                <div class="right">
					<?php if ( have_rows( 'sidebar' ) ) : ?>
						<?php while ( have_rows( 'sidebar' ) ) :
							the_row(); ?>
							<?php $heading = get_sub_field( 'heading' ); ?>
							<?php if ( have_rows( 'bullets' ) ) : ?>
                            <div class="bullets">
                                <h2><?php echo $heading; ?></h2>
                                <ul>
									<?php while ( have_rows( 'bullets' ) ) : the_row(); ?>
										<?php $link_to = get_sub_field( 'link_to' );
										$bullet_text   = get_sub_field( 'bullet_text' );
										$target        = '';
										if ( get_sub_field( 'open_in_a_new_tab' ) == 1 ) {
											$target = ' target="_blank"';
										}
										$href = '';
										if ( $link_to == 'Page' ) {
											$href = get_sub_field( 'page' );
										}
										if ( $link_to == 'Post' ) {
											$href = get_sub_field( 'post' );
										}
										if ( $link_to == 'Text' ) {
											$href = get_sub_field( 'text' );
										}
										if ( $link_to == 'URL' ) {
											$href = get_sub_field( 'url' );
										}
										if ( $link_to == 'File' ) {
											$href   = get_sub_field( 'file' );
											$target = ' target="_blank"';
										}
										if ( $link_to == 'Popup' ) {
											$popup_content = get_sub_field( 'popup' );
											$uniqueID      = uniqid();
											if ( ! $is_preview ):
												?>
                                                <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                     data-reveal data-id="<?php echo $uniqueID; ?>">
                                                    <div class="info-box">
														<?php
														$popup_content = get_sub_field( 'popup' );
														if ( $popup_content == 'Entertainment' ) {
															echo get_field( 'entertainment', 'option' );
														}
														if ( $popup_content == 'Palm Court Entertainment' ) {
															echo get_field( 'palm_court_entertainment', 'option' );
														}
														if ( $popup_content == 'Dress Code' ) {
															echo get_field( 'dress_code', 'option' );
														}
														if ( $popup_content == 'Restaurant Sittings' ) {
															echo get_field( 'restaurant_sittings', 'option' );
														}
														if ( $popup_content == 'Restaurant Terrace Sittings' ) {
															echo get_field( 'restaurant_terrace_sittings', 'option' );
														}
														if ( $popup_content == 'The Ritz Garden Sittings' ) {
															echo get_field( 'the_ritz_garden_sittings', 'option' );
														}
														if ( $popup_content == 'Afternoon Tea Sittings' ) {
															echo get_field( 'afternoon_tea_sittings', 'option' );
														}
														if ( $popup_content == 'Palm Court Sittings' ) {
															echo get_field( 'palm_court_sittings', 'option' );
														}
														?>
                                                    </div>
                                                    <span class="close-reveal-modal" data-close>&times;</span>
                                                </div>
											<?php
											endif;
											$bullet_text = '<a data-open="' . $uniqueID . '" class="link">' . $bullet_text . '</a>';
											$href        = '';
										}
										if ( $href != '' ) {
											$bullet_text = '<a href="' . esc_url( $href ) . '" class="link"' . $target . '>' . $bullet_text . '</a>';
										} ?>
                                        <li><?php echo $bullet_text; ?></li>
									<?php endwhile; ?>
                                </ul>
                            </div>
						<?php endif; ?>


							<?php if ( have_rows( 'buttons' ) ) : ?>
                            <div class="buttons">
								<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
									<?php
									$left_title   = get_sub_field( 'title' );
									$left_content = get_sub_field( 'content' );
									$link_to      = get_sub_field( 'link_to' );
									$target       = '';
									if ( get_sub_field( 'open_in_a_new_tab' ) == 1 ) {
										$target = ' target="_blank"';
									}
									$title = get_sub_field( 'title' );
									$href  = '';
									if ( $link_to == 'Page' ) {
										$href = get_sub_field( 'page' );
									}
									if ( $link_to == 'Post' ) {
										$href = get_sub_field( 'post' );
									}
									if ( $link_to == 'Text' ) {
										$href = get_sub_field( 'text' );
									}
									if ( $link_to == 'URL' ) {
										$href = get_sub_field( 'url' );
									}
									if ( $href != '' ) {
										$ytpos = strpos( $href, 'https://youtu.be/' );
										if ( $ytpos === 0 ) {
											$url_array = parse_url( $href );
											$videoID   = '';
											if ( is_array( $url_array ) ) {
												if ( array_key_exists( 'path', $url_array ) ) {
													$videoID  = trim( $url_array['path'], '/' );
													$uniqueID = uniqid();
													?>
													<?php if ( ! $is_preview ): ?>
                                                        <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                             data-reveal data-id="<?php echo $uniqueID; ?>"
                                                             data-ytvideoid="<?php echo $videoID; ?>">
                                                            <div class="flex-video widescreen">
                                                                <div id="feature-video-<?php echo $uniqueID; ?>">[this
                                                                    div will be converted to an iframe]
                                                                </div>
                                                            </div>
                                                            <span class="close-reveal-modal" data-close>&times;</span>
                                                        </div>
													<?php endif; ?>
													<?php
													echo '<div class="button-row"><div class="button-container"><a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="link button-underlined long feature-modal-btn"' . $target . '>' . $title . '</a></div></div>';
												} else {
													echo '<div class="button-row"><div class="button-container"><a href="' . esc_url( $href ) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
												}
											}
										} else {
											echo '<div class="button-row"><div class="button-container"><a href="' . esc_url( $href ) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
										}
									}
									if ( $link_to == 'Gallery' ) {
										$uniqueID = uniqid();
										if ( have_rows( 'image_gallery' ) ) {
											?>
											<?php if ( ! $is_preview ): ?>
                                                <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal
                                                     data-galleryid="<?php echo $uniqueID; ?>">
                                                    <div class="gallery-container">
                                                        <div id="gallery-slick-<?php echo $uniqueID; ?>"
                                                             class="gallery-slick">
															<?php
															while ( have_rows( 'image_gallery' ) ) : the_row();
																$image = get_sub_field( 'image' );
																?>
                                                                <div class="gallery-image"
                                                                     style="background-image: url(<?php echo $image['url']; ?>);"></div>
															<?php
															endwhile;
															?>
                                                        </div>
                                                    </div>
                                                    <span class="close-reveal-modal" data-close>&times;</span>
                                                </div>
											<?php endif; ?>
                                            <div class="button-row">
                                                <div class="button-container"><a data-open="<?php echo $uniqueID; ?>"
                                                                                 class="link button-underlined long"><?php echo $title; ?> </a>
                                                </div>
                                            </div>
											<?php
										}
									}
									if ( $link_to == 'iFrame' ) {
										$iframe_link = get_sub_field( 'iframe_link' );
										?>
										<?php if ( ( $iframe_link != '' ) && ( ! $is_preview ) ):
											$uniqueID = uniqid(); ?>
                                            <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal
                                                 data-id="<?php echo $uniqueID; ?>">
                                                <div class="virtual-tour">
                                                    <iframe src="<?php echo $iframe_link; ?>"
                                                            style="width: 100%; height: 60vh;"></iframe>
                                                </div>
                                                <span class="close-reveal-modal" data-close>&times;</span>
                                            </div>
										<?php endif;
										if ( $iframe_link != '' ) {
											?>
                                            <div class="button-row">
                                                <div class="button-container">
                                                    <a data-open="<?php echo $uniqueID; ?>"
                                                       class="link button-underlined long"><?php echo $title; ?></a>
                                                </div>
                                            </div>
											<?php
										}
									}
									?>
								<?php endwhile; ?>
                            </div>
						<?php endif; ?>
						<?php endwhile; ?>
					<?php endif; ?>
                </div>
            </div>
        </div>


    </div>
    <div class="page-content-mobile hide-for-large">
		<?php if ( get_field( 'price_line' ) != '' ): ?>
            <div class="price-line text-center" style="padding-top: 25px; padding-bottom: 4px;">
				<?php the_field( 'price_line' ); ?>
            </div>
		<?php endif; ?>
		<?php $booking_type = get_field( 'booking_type' ); ?>
		<?php if ( $booking_type != 'None' ): ?>
            <div class="booking-line">
				<?php
				$booking_link_text = get_field( 'booking_button_text' );
				if ( $booking_type == 'Restaurant' ) {
					if ( have_rows( 'the_ritz_restaurant' ) ) :
						$book_data = '';
						while ( have_rows( 'the_ritz_restaurant' ) ) : the_row();
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
				}
				if ( $booking_type == 'Tea' ) {
					if ( have_rows( 'afternoon_tea' ) ) :
						$book_data = '';
						while ( have_rows( 'afternoon_tea' ) ) : the_row();
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
				}
				if ( $booking_type == 'Garden' ) {
					if ( have_rows( 'the_ritz_garden' ) ) :
						$book_data = '';
						while ( have_rows( 'the_ritz_garden' ) ) : the_row();
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
				}
				if ( $booking_type == 'Accomodation' ) {
					if ( have_rows( 'accomodation_codes' ) ) :
						$selector = '?';
						$query     = '';
						while ( have_rows( 'accomodation_codes' ) ) : the_row();
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
				}
				if ( $booking_type == 'Page Link' ) {
					$page = get_field( 'page_link' );
					?>
                    <a href="<?php echo esc_url( $page ); ?>" class="button-ritz"><?php echo $booking_link_text; ?></a>
					<?php
				}
				if ( $booking_type == 'Email' ) {
					if ( have_rows( 'email_options' ) ) :
						while ( have_rows( 'email_options' ) ) : the_row();
							?>
                            <a href="mailto:<?php the_sub_field( 'email_to_address' ); ?>?subject=<?php the_sub_field( 'subject' ); ?>&body=<?php the_sub_field( 'body' ); ?>"
                               class="button-ritz"><?php echo $booking_link_text; ?></a>
						<?php
						endwhile;
					endif;
				};

				?>
            </div>
		<?php endif; ?>

        <div class="page-sidebar">
			<?php if ( have_rows( 'sidebar' ) ) : ?>
			<?php while ( have_rows( 'sidebar' ) ) :
			the_row(); ?>
			<?php $heading = get_sub_field( 'heading' ); ?>
			<?php if ( have_rows( 'bullets' ) ) : ?>
            <div class="bullets">
                <ul class="accordion" data-accordion data-allow-all-closed="true">
                    <li class="accordion-item" data-accordion-item><a
                                class="accordion-title"><?php echo $heading; ?></a>
                        <div class="accordion-content" data-tab-content>
                            <ul>
								<?php while ( have_rows( 'bullets' ) ) : the_row(); ?>
									<?php $link_to = get_sub_field( 'link_to' );
									$bullet_text   = get_sub_field( 'bullet_text' );
									$target        = '';
									if ( get_sub_field( 'open_in_a_new_tab' ) == 1 ) {
										$target = ' target="_blank"';
									}
									$href = '';
									if ( $link_to == 'Page' ) {
										$href = get_sub_field( 'page' );
									}
									if ( $link_to == 'Post' ) {
										$href = get_sub_field( 'post' );
									}
									if ( $link_to == 'Text' ) {
										$href = get_sub_field( 'text' );
									}
									if ( $link_to == 'URL' ) {
										$href = get_sub_field( 'url' );
									}
									if ( $link_to == 'File' ) {
										$href   = get_sub_field( 'file' );
										$target = ' target="_blank"';
									}
                                    if ( $link_to == 'Popup' ) {
                                        $popup_content = get_sub_field( 'popup' );
                                        $uniqueID      = uniqid();
                                        if ( ! $is_preview ):
                                            ?>
                                            <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                                                 data-reveal data-id="<?php echo $uniqueID; ?>">
                                                <div class="info-box">
                                                    <?php
                                                    $popup_content = get_sub_field( 'popup' );
                                                    if ( $popup_content == 'Entertainment' ) {
                                                        echo get_field( 'entertainment', 'option' );
                                                    }
                                                    if ( $popup_content == 'Palm Court Entertainment' ) {
                                                        echo get_field( 'palm_court_entertainment_normal', 'option' );
                                                    }
                                                    if ( $popup_content == 'Palm Court Entertainment (Christmas)' ) {
                                                        echo get_field( 'palm_court_entertainment', 'option' );
                                                    }
                                                    if ( $popup_content == 'Dress Code' ) {
                                                        echo get_field( 'dress_code', 'option' );
                                                    }
                                                    if ( $popup_content == 'Restaurant Sittings' ) {
                                                        echo get_field( 'restaurant_sittings', 'option' );
                                                    }
                                                    if ( $popup_content == 'Restaurant Terrace Sittings' ) {
                                                        echo get_field( 'restaurant_terrace_sittings', 'option' );
                                                    }
                                                    if ( $popup_content == 'The Ritz Garden Sittings' ) {
                                                        echo get_field( 'the_ritz_garden_sittings', 'option' );
                                                    }
                                                    if ( $popup_content == 'Afternoon Tea Sittings' ) {
                                                        echo get_field( 'afternoon_tea_sittings', 'option' );
                                                    }
                                                    if ( $popup_content == 'Palm Court Sittings' ) {
                                                        echo get_field( 'palm_court_sittings', 'option' );
                                                    }
                                                    ?>
                                                </div>
                                                <span class="close-reveal-modal" data-close>&times;</span>
                                            </div>
                                        <?php
                                        endif;
                                        $bullet_text = '<a data-open="' . $uniqueID . '" class="link">' . $bullet_text . '</a>';
                                        $href        = '';
                                    }
									if ( $href != '' ) {
										$bullet_text = '<a href="' . esc_url( $href ) . '" class="link"' . $target . '>' . $bullet_text . '</a>';
									} ?>
                                    <li><?php echo $bullet_text; ?></li>
								<?php endwhile; ?>
                            </ul>
                    </li>
                </ul>
            </div>

        </div>
	<?php endif; ?>
	<?php if ( have_rows( 'buttons' ) ) : ?>
        <div class="buttons">
			<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
				<?php
				$left_title   = get_sub_field( 'title' );
				$left_content = get_sub_field( 'content' );
				$link_to      = get_sub_field( 'link_to' );
				$target       = '';
				if ( get_sub_field( 'open_in_a_new_tab' ) == 1 ) {
					$target = ' target="_blank"';
				}
				$title = get_sub_field( 'title' );
				$href  = '';
				if ( $link_to == 'Page' ) {
					$href = get_sub_field( 'page' );
				}
				if ( $link_to == 'Post' ) {
					$href = get_sub_field( 'post' );
				}
				if ( $link_to == 'Text' ) {
					$href = get_sub_field( 'text' );
				}
				if ( $link_to == 'URL' ) {
					$href = get_sub_field( 'url' );
				}
				if ( $href != '' ) {
					$ytpos = strpos( $href, 'https://youtu.be/' );
					if ( $ytpos === 0 ) {
						$url_array = parse_url( $href );
						$videoID   = '';
						if ( is_array( $url_array ) ) {
							if ( array_key_exists( 'path', $url_array ) ) {
								$videoID  = trim( $url_array['path'], '/' );
								$uniqueID = uniqid();
								?>
                                <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal
                                     data-id="<?php echo $uniqueID; ?>" data-ytvideoid="<?php echo $videoID; ?>">
                                    <div class="flex-video widescreen">
                                        <div id="feature-video-<?php echo $uniqueID; ?>">[this div will be converted to
                                            an iframe]
                                        </div>
                                    </div>
                                    <span class="close-reveal-modal" data-close>&times;</span>
                                </div>
								<?php
								echo '<div class="button-row"><div class="button-container"><a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="link button-underlined long feature-modal-btn"' . $target . '>' . $title . '</a></div></div>';
							} else {
								echo '<div class="button-row"><div class="button-container"><a href="' . esc_url( $href ) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
							}
						}
					} else {
						echo '<div class="button-row"><div class="button-container"><a href="' . esc_url( $href ) . '" class="link button-underlined long"' . $target . '>' . $title . '</a></div></div>';
					}
				}
				/*if ( $link_to == 'Gallery' ) {
					$uniqueID = uniqid();
					if ( have_rows( 'image_gallery' ) ) {
						*/ ?><!--
                        <div id="<?php /*echo $uniqueID; */ ?>" class="reveal-modal" data-reveal
                             data-galleryid="<?php /*echo $uniqueID; */ ?>">
                            <div class="gallery-container">
                                <div id="gallery-slick-<?php /*echo $uniqueID; */ ?>" class="gallery-slick">
									<?php
				/*									while ( have_rows( 'image_gallery' ) ) : the_row();
														$image = get_sub_field( 'image' );
														*/ ?>
                                        <div class="gallery-image"
                                             style="background-image: url(<?php /*echo $image['url']; */ ?>);"></div>
									<?php
				/*									endwhile;
													*/ ?>
                                </div>
                            </div>
                            <span class="close-reveal-modal" data-close>&times;</span>
                        </div>
                        <div class="button-row">
                            <div class="button-container"><a data-open="<?php /*echo $uniqueID; */ ?>"
                                                             class="link button-underlined long"><?php /*echo $title; */ ?> </a>
                            </div>
                        </div>
						--><?php
				/*					}
								}*/
				if ( $link_to == 'iFrame' ) {
					$iframe_link = get_sub_field( 'iframe_link' );
					if ( $iframe_link != '' ) {
						?>
                        <div class="button-row">
                            <div class="button-container">
                                <!--<a data-open="<?php /*echo $uniqueID; */ ?>"
                                   class="link button-underlined long"><?php /*echo $title; */ ?></a>-->
                                <a href="<?php echo $iframe_link; ?>" target="_blank"
                                   class="link button-underlined long"><?php echo $title; ?></a>
                            </div>
                        </div>
						<?php
					}
				}

				?>
			<?php endwhile; ?>
        </div>
	<?php endif; ?>
	<?php endwhile; ?>
	<?php endif; ?>

        <div class="page-content">
			<?php
			$content    = get_field( 'content' );
			$paragraphs = explode( '</p>', $content );
			$count      = count( $paragraphs );
			$output     = '<div class="visible">';
			for ( $i = 0; $i < $count; $i ++ ) {
				$output .= $paragraphs[ $i ];
				if ( $i == 1 ) {
					$output .= '</div><div class="read-more-content" id="read-more-content" data-toggler data-animate="slide-in-down slide-out-up" style="display: none;">';
				}
			}
			$output .= '</div>';
			echo $output;
			?>
        </div>
		<?php if ( get_field( 'price_line' ) != '' ): ?>
            <div class="price-line">
				<?php the_field( 'price_line' ); ?>
            </div>
		<?php else: ?>
            <!--<p>&nbsp;</p>-->
		<?php endif; ?>
		<?php if ( $count > 3 ): ?>
            <div class="read-more">
                <button data-toggle="read-more-content" href="#"><span class="more">READ MORE</span><span class="less">READ LESS</span></button>
            </div>
		<?php endif; ?>
		<?php if ( have_rows( 'footer_lines' ) ) : ?>
            <div class="footer-lines">
				<?php while ( have_rows( 'footer_lines' ) ) : the_row(); ?>
					<?php echo preg_replace( '/<a href="mailto:(.+?)>.+?<\/a>/i', '<a href="mailto:$1>HERE</a>', get_sub_field( 'line' ) ); ?>&nbsp;
				<?php endwhile; ?>
            </div>
		<?php endif; ?>
    </div>
</div>


