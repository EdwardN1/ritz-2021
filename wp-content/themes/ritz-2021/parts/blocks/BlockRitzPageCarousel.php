<?php
/**
 * Block template file: /parts/blocks/BlockRitzPageCarousel.php
 *
 * Ritz Page Carousel Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @var bool $is_preview True during AJAX preview.
 * @var array $block The block settings and attributes.
 */


// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-page-carousel-block-' . $block['id'];
if ( ! empty( $block['anchor'] ) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-page-carousel-block';
if ( ! empty( $block['className'] ) ) {
	$classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
	$classes .= ' align' . $block['align'];
}
?>

<?php
if ( ( isset( $block['data']['ritz_page_carousel_block_preview_image_help'] ) ) && ( $is_preview ) ) :    /* rendering in inserter preview  */

	echo '<img src="' . $block['data']['ritz_page_carousel_block_preview_image_help'] . '" style="width:100%; height:auto;">';

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

<?php if ( $is_preview ): ?>
	<?php if ( have_rows( 'slides' ) ) : ?>
        <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
            <div class="heading text-center"><?php the_field( 'heading' ); ?></div>
            <div class="ritz-page-carousel grid-x">
				<?php while ( have_rows( 'slides' ) ) : the_row(); ?>
                    <div class="carousel-slide text-center cell large-4 medium-6 small-12">
						<?php $page = get_sub_field( 'page' ); ?>
						<?php $image = get_sub_field( 'image' ); ?>
						<?php if ( $image ) : ?>
                            <div class="image"
                                 style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)"></div>
						<?php endif; ?>
                        <div class="slide-content">
                            <div class="aligner">
                                <div class="slide-heading"><?php the_sub_field( 'slide_heading' ); ?></div>
                                <div class="slide-link"><a
                                            href="<?php echo esc_url( $page ); ?>"
                                            class="button-underlined"><?php the_sub_field( 'link_text' ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php endwhile; ?>
            </div>
        </div>
	<?php endif; ?>
	<?php return; ?>
<?php endif; ?>

<?php if ( have_rows( 'slides' ) ) : ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
        <div class="heading text-center"><?php the_field( 'heading' ); ?></div>
        <div class="ritz-page-carousel">
			<?php while ( have_rows( 'slides' ) ) : the_row(); ?>
                <div class="carousel-slide text-center">
					<?php $page = get_sub_field( 'page' ); ?>
					<?php $href = get_sub_field( 'text' ); ?>
					<?php
					$link = '';
                    $link_title = get_sub_field('link_text');
                    $linkLen = '';
                    if(strlen($link_title)<=8) {
                        $linkLen = 'short';
                    }
                    if(strlen($link_title)>=13) {
                        $linkLen = 'long';
                    }
					if ( get_sub_field( 'link_type') == 'Text' ) {
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
                                        <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal data-id="<?php echo $uniqueID; ?>" data-ytvideoid="<?php echo $videoID; ?>">
                                            <div class="flex-video widescreen">
                                                <div id="feature-video-<?php echo $uniqueID; ?>">[this div will be converted to an iframe]</div>
                                            </div>
                                            <span class="close-reveal-modal" data-close>&times;</span>
                                        </div>
										<?php
										$link = '<a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="link button-underlined feature-modal-btn '.$linkLen.'">' . $link_title . '</a>';
										$imageLink = '<a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="image-link feature-modal-btn '.$linkLen.'"></a>';
									} else {
										$link = '<a href="' . esc_url( $href ) . '" class="button-underlined '.$linkLen.'">' . $link_title . '</a>';
										$imageLink = '<a href="' . esc_url( $href ) . '" class="image-link"></a>';
									}
								}
							} else {
								$link = '<a href="' . esc_url( $page ) . '" class="button-underlined '.$linkLen.'">' . $link_title . '</a>';
								$imageLink = '<a href="' . esc_url( $page ) . '" class="image-link"></a>';
							}
						}
					} else {
						$link = '<a href="' . esc_url( $page ) . '" class="button-underlined '.$linkLen.'">' . $link_title . '</a>';
						$imageLink = '<a href="' . esc_url( $page ) . '" class="image-link"></a>';
					}
					?>

					<?php $image = get_sub_field( 'image' ); ?>
					<?php if ( $image ) : ?>
                        <div class="image"
                             style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)"><?php echo $imageLink;?></div>
					<?php endif; ?>
                    <div class="slide-content">
                        <div class="aligner">
                            <div class="slide-heading"><?php the_sub_field( 'slide_heading' ); ?></div>
                            <div class="slide-link"><?php echo $link; ?></div>
                        </div>
                    </div>

                </div>
			<?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>