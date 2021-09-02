<article id="post-<?php the_ID(); ?>" <?php post_class( 't8-page-location' ); ?> role="article" itemscope
         itemtype="http://schema.org/WebPage">

    <section class="entry-content grid-container" itemprop="text">
		<?php if ( is_block_page() ): ?>
			<?php the_content(); ?>
		<?php else: ?>
            <div class="map-wrapper">
                <div id="map-info-box">&nbsp;</div>
                <div class="acf-map" id="acfMap">
					<?php
					$desktop = '';
					if ( have_rows( 'locations' ) ):
						while ( have_rows( 'locations' ) ) :
							the_row();
							$location             = get_sub_field( 'location' );
							$location_label_title = get_sub_field( 'location_label_title' );
							$location_heading     = get_sub_field( 'location_heading' );
							$location_sub_heading = get_sub_field( 'location_sub_heading' );
							$location_image       = get_sub_field( 'location_image' );
							$location_description = get_sub_field( 'location_description' );

							$location_show_links      = get_sub_field( 'location_show_links' );
							$location_use_two_links   = get_sub_field( 'location_use_two_links' );
							$location_left_link_text  = get_sub_field( 'location_left_link_text' );
							$location_left_use_url    = get_sub_field( 'location_left_use_url' );
							$location_left_link       = get_sub_field( 'location_left_link' );
							$location_left_url        = get_sub_field( 'location_left_url' );
							$location_right_link_text = get_sub_field( 'location_right_link_text' );
							$location_right_use_url   = get_sub_field( 'location_right_use_url' );
							$location_right_link      = get_sub_field( 'location_right_link' );
							$location_right_url       = get_sub_field( 'location_right_url' );
							$dark_pin                 = get_sub_field( 'dark_pin' );

							$labelClass   = 'map-labels gotham--18 fixed caps white';
							$labeIcon     = get_template_directory_uri() . '/assets/images/google-pin-white.png';
							$labelAnchorX = 160;
							$labelAnchorY = 65;

							if ( $dark_pin ) {
								$labelClass   = 'map-labels gotham--18 fixed caps blue';
								$labeIcon     = get_template_directory_uri() . '/assets/images/google-pin.png';
								$labelAnchorX = 160;
								$labelAnchorY = 75;
							}

							?>
                            <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng'] ?>" data-title="<?php echo $location_label_title; ?>"
                                 data-icon="<?php echo $labeIcon; ?>"
                                 data-class="<?php echo $labelClass; ?>" data-anchorX="<?php echo $labelAnchorX; ?>" data-anchorY="<?php echo $labelAnchorY; ?>">
                                <h3><?php echo $location_heading; ?></h3>
                                <div class="marker-sub-heading"><em><?php echo $location_sub_heading; ?></em></div>
                                <div class="marker-image"><img src="<?php echo $location_image['url']; ?>"></div>
                                <div class="marker-description"><?php echo $location_description; ?></div>
								<?php if ( $location_show_links ) { ?>
                                    <div class="landing-links grid-x">
										<?php
										$leftHREF   = $location_left_link;
										$leftTARGET = '';
										if ( $location_left_use_url ) {
											$leftHREF   = $location_left_url;
											$leftTARGET = ' target="_blank"';
										}
										$leftSPAN = ' no-border';
										if ( $location_use_two_links ) {
											$leftSPAN = '';
										}
										?>
                                        <div class="cell auto text-center">
                                            <a href="<?php echo $leftHREF; ?>"<?php echo $leftTARGET; ?> class="button-underline"><?php echo $location_left_link_text; ?></a>
                                        </div>
										<?php
										if ( $location_use_two_links ) :
											$rightHREF = $location_right_link;
											$rightTARGET = '';
											if ( $location_right_use_url ) {
												$rightHREF   = $location_right_url;
												$rightTARGET = ' target="_blank"';
											}
											?>
                                            <div class="cell auto text-center">
                                                <a href="<?php echo $rightHREF; ?>"<?php echo $rightTARGET; ?> class="button-ritz"><?php echo $location_right_link_text; ?></a>
                                            </div>
										<?php endif; ?>
                                    </div>
								<?php } ?>

                            </div>
						<?php endwhile; ?>
					<?php endif; ?>

                </div>
            </div>
            <div class="grid-container main-content">
                <div class="grid-x grid-padding-x">
                    <div class="cell large-6 medium-6 small-12 show-for-large">
                        <div class="get-directions">
                            <h4>DIRECTIONS TO THE RITZ</h4>
                            <p>
                                <input type="text" ID="start-point" placeholder="Enter post code">
                                <input type="button" value="Go" ID="get-directions">
                            </p>
                            <h4>TRAVEL BY:</h4>
                        </div>
                        <span class="transit-mode garamond--13 fixed caps" data-mode="TRANSIT">BY PUBLIC TRANSPORT</span>
                        <span class="transit-mode garamond--13 fixed caps selected" data-mode="DRIVING">BY CAR</span>
                        <span class="transit-mode garamond--13 fixed caps" data-mode="BICYCLING">BY CYCLING</span>
                        <span class="transit-mode garamond--13 fixed caps" data-mode="WALKING">BY WALKING</span>
                    </div>
                    <div class="cell large-6 medium-6 small-12">
                        <h1><?php the_field('main_heading');?></h1>
                        <h2><?php the_field('main_sub_heading');?></h2>
                        <div><?php the_field('main_content');?></div>
                    </div>
                </div>
            </div>
            <?php if ( have_rows( 'offer_tiles' ) ) : ?>
                <div class="block-ritz-page-carousel-block">
                    <div class="heading text-center"><?php the_field( 'offers_heading' ); ?></div>
                    <div class="ritz-page-carousel">
                        <?php while ( have_rows( 'offer_tiles' ) ) : the_row(); ?>
                            <div class="carousel-slide text-center">
                                <?php $page = get_sub_field( 'offer_link' ); ?>
                                <?php $href = get_sub_field( 'url' ); ?>
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
                                if ( get_sub_field( 'external_link') == 1 ) {
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
                                                    $link = '<a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="link button-underlined feature-modal-btn '.$linkLen.'">READ MORE</a>';
                                                } else {
                                                    $link = '<a href="' . esc_url( $href ) . '" class="button-underlined '.$linkLen.'">READ MORE</a>';
                                                }
                                            }
                                        } else {
                                            $link = '<a href="' . esc_url( $page ) . '" class="button-underlined '.$linkLen.'">READ MORE</a>';
                                        }
                                    }
                                } else {
                                    $link = '<a href="' . esc_url( $page ) . '" class="button-underlined '.$linkLen.'">READ MORE</a>';
                                }
                                ?>

                                <?php $image = get_sub_field( 'offer_image' ); ?>
                                <?php if ( $image ) : ?>
                                    <div class="image"
                                         style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)"></div>
                                <?php endif; ?>
                                <div class="slide-content">
                                    <div class="aligner">
                                        <div class="slide-heading"><?php echo $link_title; ?></div>
                                        <div class="slide-link"><?php echo $link; ?></div>
                                    </div>
                                </div>

                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </section>
</article>
