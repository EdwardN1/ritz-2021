<?php
/**
 * The template for displaying the footer.
 *
 * Comtains closing divs for header.php.
 *
 * For more info: https://developer.wordpress.org/themes/basics/template-files/#template-partials
 */
?>

<div class="grid-container">
    <div class="ritz-full-width-text-banner-block">
        <div class="background text-center">
            <div class="heading">
                <h3>
					<?php the_field( 'footer_banner_heading', 'option' ); ?>
                </h3>
            </div>
            <div class="content">
				<?php the_field( 'footer_banner_content', 'option' ); ?>
            </div>
            <div class="link">
				<?php
				$link    = '';
				$link_to = get_field( 'footer_banner_link_to', 'option' );
				$target  = '';
				if ( get_field( 'footer_banner_open_in_a_new_tab', 'option' ) == 1 ) {
					$target = ' target="_blank"';
				}
				$link_title = get_field( 'footer_banner_link_title', 'option' );
				$href       = '';
				if ( $link_to == 'Page' ) {
					$href = get_field( 'footer_banner_page', 'option'  );
				}
				if ( $link_to == 'Post' ) {
					$href = get_field( 'footer_banner_post', 'option'  );
				}
				if ( $link_to == 'Text' ) {
					$href = get_field( 'footer_banner_text', 'option'  );
				}
				if ( $link_to == 'URL' ) {
					$href = get_field( 'footer_banner_url', 'option'  );
				}
				if ( $href != '' ) {
					$link = '<a href="' . esc_url( $href ) . '" class="link button-underlined long"' . $target . '>' . $link_title . '</a>';
				}
				?>
				<?php echo $link; ?>
            </div>
        </div>

    </div>
</div>

<!-- Place <div> tag where you want the feed to appear -->
<div class="grid-container curator">
    <!-- Place <div> tag where you want the feed to appear -->
    <h2>Follow Us</h2>
    <div id="curator-feed-default-feed-layout"><a href="https://curator.io" target="_blank" class="crt-logo crt-tag">Powered by Curator.io</a></div>
    <!-- The Javascript can be moved to the end of the html page before the </body> tag -->
    <script type="text/javascript">
        /* curator-feed-default-feed-layout */
        (function () {
            var i, e, d = document, s = "script";
            i = d.createElement("script");
            i.async = 1;
            i.src = "https://cdn.curator.io/published/678fb0f1-abb8-4448-9f19-2775d5cfa7c4.js";
            e = d.getElementsByTagName(s)[0];
            e.parentNode.insertBefore(i, e);
        })();
    </script>
</div>
<footer class="footer" role="contentinfo">


    <div class="show-for-large grid-container">
        <div class="grid-x">
            <div class="cell auto logo text-left">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/white-ritz-logo.svg'; ?>">
            </div>
            <div class="cell shrink contact">
                150 PICCADILLY, LONDON W1J 9BR<br>
                TELEPHONE: +44 (0) 20 7493 8181
            </div>
            <div class="cell shrink numbers">
                <p>THE RITZ HOTEL (LONDON) LTD<br>
                    REGISTERED IN ENGLAND NO.64203<br>
                    VAT REGISTRATION 773 8638 79<br>
                </p>
                <p class="source-org copyright">&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>.</p>
            </div>
            <div class="cell shrink social">
                <div class="grid-container">
                    <div class="grid-x">
                        <div class="cell auto">
                            <a href="https://www.facebook.com/theritzlondon" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/facebook.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="https://instagram.com/theritzlondon" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/instagram.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="https://twitter.com/theritzlondon" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/twitter.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="https://www.youtube.com/user/TheRitzLondon" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/youtube.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="https://www.linkedin.com/company/the-ritz-london" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/linkedin.svg' ?>"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cell shrink warrant">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/white-warrant.svg' ?>"/>
            </div>
            <div class="cell auto leading text-right">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/white-leading.svg' ?>"/>
            </div>
        </div>

    </div>

    <div class="show-for-medium hide-for-large">
        <div class="grid-x">
            <div class="cell auto">
                <div class="logo">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/white-ritz-logo.svg'; ?>">
                </div>
            </div>
            <div class="cell shrink">
                <div class="contact">
                    150 PICCADILLY, LONDON W1J 9BR<br>
                    TELEPHONE: +44 (0) 20 7493 8181
                </div>
                <div class="social">
                    <div class="grid-x">
                        <div class="cell auto">
                            <a href="" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/facebook.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/instagram.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/twitter.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/youtube.svg' ?>"></a>
                        </div>
                        <div class="cell auto">
                            <a href="" class="social-icon" target="_blank"><img
                                        src="<?php echo get_template_directory_uri() . '/assets/images/linkedin.svg' ?>"></a>
                        </div>
                    </div>
                </div>
                <div class="numbers">
                    <p>THE RITZ HOTEL (LONDON) LTD<br>
                        REGISTERED IN ENGLAND NO.64203<br>
                        VAT REGISTRATION 773 8638 79<br>
                    </p>
                    <p class="source-org copyright">&copy; <?php echo date( 'Y' ); ?> THE RITZ HOTEL (LONDON) LTD.</p>
                </div>
            </div>
            <div class="cell auto">
                <div class="warrant">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/white-warrant.svg' ?>"/>
                </div>
                <div class="leading">
                    <img src="<?php echo get_template_directory_uri() . '/assets/images/white-leading.svg' ?>"/>
                </div>
            </div>
        </div>
    </div>

    <div class="hide-for-medium">
        <div class="logo">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/white-ritz-logo.svg'; ?>">
        </div>
        <div class="contact text-center">
            150 PICCADILLY, LONDON W1J 9BR<br>
            TELEPHONE: +44 (0) 20 7493 8181
        </div>
        <div class="social">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="cell auto">
                        <a href="" class="social-icon" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/facebook.svg' ?>"></a>
                    </div>
                    <div class="cell auto">
                        <a href="" class="social-icon" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/instagram.svg' ?>"></a>
                    </div>
                    <div class="cell auto">
                        <a href="" class="social-icon" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/twitter.svg' ?>"></a>
                    </div>
                    <div class="cell auto">
                        <a href="" class="social-icon" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/youtube.svg' ?>"></a>
                    </div>
                    <div class="cell auto">
                        <a href="" class="social-icon" target="_blank"><img
                                    src="<?php echo get_template_directory_uri() . '/assets/images/linkedin.svg' ?>"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="numbers text-center">
            <p>THE RITZ HOTEL (LONDON) LTD<br>
                REGISTERED IN ENGLAND NO.64203 VAT<br>
                REGISTRATION 773 8638 79<br>
            </p>
            <p class="source-org copyright">&copy; <?php echo date( 'Y' ); ?> THE RITZ HOTEL (LONDON) LTD.</p>
        </div>
        <div class="grid-x">
            <div class="cell auto warrant">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/white-warrant.svg' ?>"/>
            </div>
            <div class="cell auto leading">
                <img src="<?php echo get_template_directory_uri() . '/assets/images/white-leading.svg' ?>"/>
            </div>
        </div>
    </div>


    <div class="inner-footer grid-x grid-margin-x grid-padding-x" style="display: none;">

        <div class="small-12 medium-12 large-12 cell">
            <nav role="navigation">
				<?php joints_footer_links(); ?>
            </nav>
        </div>

        <div class="small-12 medium-12 large-12 cell">
            <p class="source-org copyright">&copy; <?php echo date( 'Y' ); ?> THE RITZ HOTEL (LONDON) LTD.</p>
        </div>

    </div> <!-- end #inner-footer -->

</footer> <!-- end .footer -->

</div>  <!-- end .off-canvas-content -->

</div> <!-- end .off-canvas-wrapper -->

<script type="text/javascript">
    var BOOKING_SETTINGS = {
        "hotel": "ritzlondon",
        "theme": "luxury",
        "lang": "en",
        "emergency": {
            "email": "reservations@theritzlondon.com",
            "phone": "4402073002222"
        }
    };
</script>
<booking-layout></booking-layout>


<?php wp_footer(); ?>

</body>

</html> <!-- end page -->