<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */

$current_page_id = get_queried_object_id();
$no_menu_page    = true;
$i               = 0;
if ( is_front_page() ):
	$no_menu_page == true;
else:
	if ( have_rows( 'page_links', 'option' ) ) :
		$currentpage_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		while ( have_rows( 'page_links', 'option' ) ) : the_row();
			$href      = '';
			$link_type = get_sub_field( 'link_type' );
			if ( $link_type == 'Page' ) {
				$href = get_sub_field( 'page' );
			}
			if ( $link_type == 'Post' ) {
				$href = get_sub_field( 'post' );
			}
			if ( $link_type == 'External URL' ) {
				$href = get_sub_field( 'external_url' );
			}
			if ( $link_type == 'Text' ) {
				$href = get_sub_field( 'text_link' );
			}
			if ( $href == $currentpage_link ) {
				$no_menu_page = false;
			}
			if ( have_rows( 'child_pages' ) ) :
				while ( have_rows( 'child_pages' ) ) : the_row();
					$c_href      = '';
					$c_link_type = get_sub_field( 'link_type' );
					if ( $c_link_type == 'Page' ) {
						$c_href = get_sub_field( 'page_link' );
					}
					if ( $c_link_type == 'Post' ) {
						$c_href = get_sub_field( 'post_link' );
					}
					if ( $c_link_type == 'External URL' ) {
						$c_href = get_sub_field( 'external_url' );
					}
					if ( $c_link_type == 'Text' ) {
						$c_href = get_sub_field( 'text_link' );
					}
					if ( $c_href == $currentpage_link ) {
						$no_menu_page = false;
					}
				endwhile;
			endif;
		endwhile;
	endif;
endif;
?>

<div class="off-canvas position-left" id="off-canvas" data-off-canvas>

    <button class="close-button" aria-label="Close menu" type="button" data-close>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/close.svg">
    </button>

    <div class="grid-container">
        <div class="logo text-center">
            <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Blue_Ritz_Logo_New_Vector.svg" style="width: 100px; height: 76px;"></a>
        </div>

        <div class="mobile-menu hide-for-large">

			<?php if ( have_rows( 'page_links', 'option' ) ) : ?>
                <ul class="vertical menu accordion-menu" data-accordion-menu data-submenu-toggle="true">
					<?php while ( have_rows( 'page_links', 'option' ) ) : the_row(); ?>
                        <li>
							<?php
							$link_type = get_sub_field( 'link_type' );
							$isActive  = '';
							$target    = '';
							if ( get_sub_field( 'open_in_new_tab' ) == 1 ) :
								$target = ' target="_blank"';
							endif;
							$link_text   = get_sub_field( 'link_text' );
							$href        = '#';
							$actual_link = ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" ) . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							if ( $link_type == 'Page' ) {
								$href = get_sub_field( 'page' );
								if ( $actual_link == $href ) {
									$isActive = ' is-active';
								}
							}
							if ( $link_type == 'Post' ) {
								$href = get_sub_field( 'post' );
							}
							if ( $link_type == 'External URL' ) {
								$href = get_sub_field( 'external_url' );
							}
							if ( $link_type == 'Text' ) {
								$href = get_sub_field( 'text_link' );
							}

							?>
                            <!--<a href="<?php /*echo $href; */?>"<?php /*echo $target; */?>
                               class="top-level-link"><?php /*the_sub_field( 'link_text' ); */?></a>-->
                            <a href="<?php echo $href;?>" class="top-level-link"><?php the_sub_field( 'link_text' ); ?></a>
							<?php if ( have_rows( 'child_pages' ) ) :
								$childItems = '<li><a href="'.$href.'"'.$target.' class="sub-level-link">Overview</a></li>';
								while ( have_rows( 'child_pages' ) ) : the_row();
									$c_link_type = get_sub_field( 'link_type' );
									$c_target    = '';
									if ( get_sub_field( 'open_in_new_tab' ) == 1 ) :
										$c_target = ' target="_blank"';
									endif;
									$c_link_text = get_sub_field( 'link_text' );
									$c_href      = '#';
									if ( $c_link_type == 'Page' ) {
										$c_href = get_sub_field( 'page_link' );
										if ( $actual_link == $c_href ) {
											$isActive = ' is-active';
										}
									}
									if ( $c_link_type == 'Post' ) {
										$c_href = get_sub_field( 'post_link' );
									}
									if ( $c_link_type == 'External URL' ) {
										$c_href = get_sub_field( 'external_url' );
									}
									if ( $c_link_type == 'Text' ) {
										$c_href = get_sub_field( 'text_link' );
									}
									$childItems .= '<li><a href="' . $c_href . '"' . $c_target . ' class="sub-level-link">' . $c_link_text . '</a></li>';
									?>

								<?php endwhile; ?>
                                <ul class="menu vertical nested<?php echo $isActive; ?>">
									<?php echo $childItems; ?>
                                </ul>
							<?php endif; ?>
                        </li>
					<?php endwhile; ?>
                </ul>
			<?php endif; ?>

            <div class="footer-main-links">
				<?php if ( have_rows( 'footer_main_links', 'option' ) ) : ?>
					<?php while ( have_rows( 'footer_main_links', 'option' ) ) : the_row(); ?>
						<?php
						$link_type = get_sub_field( 'link_type' );
						$href      = '#';
						if ( $link_type == 'Page' ) {
							$href = get_sub_field( 'page' );
						}
						if ( $link_type == 'Post' ) {
							$href = get_sub_field( 'post' );
						}
						if ( $link_type == 'External URL' ) {
							$href = get_sub_field( 'external_url' );
						}
						if ( $link_type == 'Text' ) {
							$href = get_sub_field( 'text_link' );
						}
						$target = '';
						if ( get_sub_field( 'open_in_new_tab' ) == 1 ) :
							$target = ' target="_blank"';
						endif;
						?>
                        <div>
                            <a href="<?php echo $href; ?>"><?php the_sub_field( 'link_text' ); ?></a>
                        </div>
					<?php endwhile; ?>
				<?php endif; ?>
            </div>
            <div class="footer-sub-links">
				<?php if ( have_rows( 'footer_sub_links', 'option' ) ) : ?>
					<?php while ( have_rows( 'footer_sub_links', 'option' ) ) : the_row(); ?>
						<?php
						$link_type = get_sub_field( 'link_type' );
						$href      = '#';
						if ( $link_type == 'Page' ) {
							$href = get_sub_field( 'page' );
						}
						if ( $link_type == 'Post' ) {
							$href = get_sub_field( 'post' );
						}
						if ( $link_type == 'External URL' ) {
							$href = get_sub_field( 'external_url' );
						}
						if ( $link_type == 'Text' ) {
							$href = get_sub_field( 'text_link' );
						}
						$target = '';
						if ( get_sub_field( 'open_in_new_tab' ) == 1 ) :
							$target = ' target="_blank"';
						endif;
						?>
                        <div>
                            <a href="<?php echo $href; ?>"><?php the_sub_field( 'link_text' ); ?></a>
                        </div>
					<?php endwhile; ?>
				<?php endif; ?>
            </div>
        </div>

		<?php
		get_template_part( 'parts/burger', 'menu-5' );
		?>
        <div class="footer-main-links grid-x show-for-large">
			<?php if ( have_rows( 'footer_main_links', 'option' ) ) : ?>
				<?php while ( have_rows( 'footer_main_links', 'option' ) ) : the_row(); ?>
					<?php
					$link_type = get_sub_field( 'link_type' );
					$href      = '#';
					if ( $link_type == 'Page' ) {
						$href = get_sub_field( 'page' );
					}
					if ( $link_type == 'Post' ) {
						$href = get_sub_field( 'post' );
					}
					if ( $link_type == 'External URL' ) {
						$href = get_sub_field( 'external_url' );
					}
					if ( $link_type == 'Text' ) {
						$href = get_sub_field( 'text_link' );
					}
					$target = '';
					if ( get_sub_field( 'open_in_new_tab' ) == 1 ) :
						$target = ' target="_blank"';
					endif;
					?>
                    <div class="cell shrink">
                        <h3><a href="<?php echo $href; ?>"><?php the_sub_field( 'link_text' ); ?></a></h3>
                    </div>
				<?php endwhile; ?>
			<?php endif; ?>
        </div>
        <div class="footer-sub-links grid-x show-for-large">
			<?php if ( have_rows( 'footer_sub_links', 'option' ) ) : ?>
				<?php while ( have_rows( 'footer_sub_links', 'option' ) ) : the_row(); ?>
					<?php
					$link_type = get_sub_field( 'link_type' );
					$href      = '#';
					if ( $link_type == 'Page' ) {
						$href = get_sub_field( 'page' );
					}
					if ( $link_type == 'Post' ) {
						$href = get_sub_field( 'post' );
					}
					if ( $link_type == 'External URL' ) {
						$href = get_sub_field( 'external_url' );
					}
					if ( $link_type == 'Text' ) {
						$href = get_sub_field( 'text_link' );
					}
					$target = '';
					if ( get_sub_field( 'open_in_new_tab' ) == 1 ) :
						$target = ' target="_blank"';
					endif;
					?>
                    <div class="cell shrink">
                        <a href="<?php echo $href; ?>"><?php the_sub_field( 'link_text' ); ?></a>
                    </div>
				<?php endwhile; ?>
			<?php endif; ?>
        </div>
    </div>
	<?php if ( have_rows( 'page_links', 'option' ) ) : ?>
        <script>
            jQuery(document).ready(function ($) {
                if($('.sub-nav .inner .child-menu.animate__fadeInDown').length) {
                    $('.sub-nav .inner .child-menu.animate__fadeInDown').each(function (){
                        let $fmh = $(this).outerHeight();
                        $('.sub-nav .inner').css('min-height',$fmh+'px');
                    })
                }
				<?php
				if ( $i == 0 ) {
					$i = count( get_field( 'page_links', 'option' ) ) + 1;
				}
				for($x = 1;$x <= $i - 1;$x ++) {
				?>
                $('.parent-<?php echo $x; ?>').on('click', function (e) {
                        if ($('.child-menu-<?php echo $x; ?>').length) {
                            e.preventDefault();
                        }
                        let $oh = $('.child-menu-<?php echo $x; ?>').outerHeight();
                        if ($('.child-menu-<?php echo $x; ?>').hasClass('animate__fadeOutUp')) {
                            $('.child-menu').removeClass('animate__fadeInDown');
                            $('.child-menu').addClass('animate__fadeOutUp');
                            $('.spacer').removeClass('animate__fadeInDown');
                            $('.spacer').addClass('animate__fadeOutUp');
                            setTimeout(function () {
                                $('.child-menu-<?php echo $x; ?>').removeClass('animate__fadeOutUp');
                                $('.child-menu-<?php echo $x; ?>').addClass('animate__fadeInDown');
                                $('.spacer-<?php echo $x; ?>').removeClass('animate__fadeOutUp');
                                $('.spacer-menu-<?php echo $x; ?>').addClass('animate__fadeInDown');
                                $('.sub-nav .inner').css('min-height',$oh+'px');
                            }, 500);

                        }
                    }
                )
				<?php
				}
				?>

            });
        </script>
	<?php endif; ?>
</div>
