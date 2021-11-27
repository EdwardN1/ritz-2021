<div id="ritz-main-image-gallery" class="main-image-gallery">
    <?php $preloadImages = ''; ?>
    <?php $preloadImageArray = array(); ?>
    <?php while ( have_rows( 'image_gallery' ) ) : the_row(); ?>
        <?php $slide = get_sub_field( 'slide' ); ?>
        <?php $responsive_image = get_sub_field( 'responsive_image' ); ?>
        <?php $mobile_image = get_sub_field( 'mobile_image' ); ?>
        <?php if ( $slide ) : ?>
            <?php //error_log('Loaded section'); ?>
            <div class="slider-slide">
                <?php
                $huge_heading      = get_sub_field( 'huge_heading' );
                $slide_heading     = get_sub_field( 'slide_heading' );
                $slide_sub_heading = get_sub_field( 'slide_sub_heading' );
                $slide_background  = '';
                if ( $slide_heading == '' ) {
                    if ( $slide_sub_heading == '' ) {
                        $slide_background = ' top-gradient';
                    }
                }
                if ( $slide_sub_heading == '' ) {
                    if ( $slide_heading == '' ) {
                        $slide_background = ' top-gradient';
                    }
                }
                $link_to = get_sub_field( 'link_to' );
                $target  = '';
                if ( get_sub_field( 'open_in_a_new_tab' ) == 1 ) {
                    $target = ' target="_blank"';
                }
                $link_open  = '';
                $link_close = '';
                if ( $link_to == 'Page' ) {
                    $link_open  = '<a href="' . esc_url( get_sub_field( 'page' ) ) . '"' . $target . ' class="slide-link">';
                    $link_close = '</a>';
                }
                if ( $link_to == 'Post' ) {
                    $link_open = '<a href="' . esc_url( get_sub_field( 'post' ) ) . '"' . $target . ' class="slide-link">';;
                    $link_close = '</a>';
                }
                if ( $link_to == 'Text' ) {
                    $link_open  = '<a href="' . esc_url( get_sub_field( 'text' ) ) . '"' . $target . ' class="slide-link">';
                    $link_close = '</a>';
                }
                if ( $link_to == 'URL' ) {
                    $link_open  = '<a href="' . esc_url( get_sub_field( 'url' ) ) . '"' . $target . ' class="slide-link">';
                    $link_close = '</a>';
                }
                ?>

                <?php echo $link_open; ?>
                <?php if ( ( get_sub_field( 'add_mobile_image' ) != 1 ) || ( ! $mobile_image ) ) : ?>
                    <?php if ( get_sub_field( 'use_responsive_image' ) == 1 ): ?>
                        <div class="slide-container hide-for-large">
                            <div class="responsive-container">
                                <?php echo $responsive_image; ?>
                                <?php
                                $doc = new DOMDocument();
                                $doc->loadHTML( $responsive_image );
                                $xpath = new DOMXPath( $doc );
                                $src   = $xpath->evaluate( "string(//img/@src)" );
                                if ( $src != '' ) {
                                    $preloadImages       .= 'url(' . $src . ') ';
                                    $preloadImageArray[] = $src;
                                }
                                ?>
                                <?php $responsive_image = null; ?>
                            </div>
                            <div class="slide-overlay<?php echo $slide_background; ?>">
                                &nbsp;
                            </div>
                            <div class="slide-info">
                                <?php if ( $huge_heading != '' ): ?>
                                    <div class="slide-huge">
                                        <div class="huge-heading"><?php echo $huge_heading; ?></div>
                                    </div>
                                <?php endif; ?>
                                <h2 class="h1"><?php echo $slide_heading; ?></h2>
                                <div class="sub-heading h2"><?php echo $slide_sub_heading; ?></div>
                            </div>
                        </div>
                        <div class="slide-container show-for-large" style="background-image: url(<?php echo esc_url( $slide['url'] ); ?>)">
                            <div class="slide-overlay<?php echo $slide_background; ?>">
                                &nbsp;
                            </div>

                            <div class="slide-info">
                                <?php if ( $huge_heading != '' ): ?>
                                    <div class="slide-huge">
                                        <div class="huge-heading"><?php echo $huge_heading; ?></div>
                                    </div>
                                <?php endif; ?>
                                <h2 class="h1"><?php echo $slide_heading; ?></h2>
                                <div class="sub-heading h2"><?php echo $slide_sub_heading; ?></div>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="slide-container" style="background-image: url(<?php echo esc_url( $slide['url'] ); ?>)">
                            <div class="slide-overlay<?php echo $slide_background; ?>">
                                &nbsp;
                            </div>

                            <div class="slide-info">
                                <?php if ( $huge_heading != '' ): ?>
                                    <div class="slide-huge">
                                        <div class="huge-heading"><?php echo $huge_heading; ?></div>
                                    </div>
                                <?php endif; ?>
                                <h2 class="h1"><?php echo $slide_heading; ?></h2>
                                <div class="sub-heading h2"><?php echo $slide_sub_heading; ?></div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="slide-container show-for-medium" style="background-image: url(<?php echo esc_url( $slide['url'] ); ?>)">
                        <div class="slide-overlay<?php echo $slide_background; ?>">
                            &nbsp;
                        </div>

                        <div class="slide-info">
                            <?php if ( $huge_heading != '' ): ?>
                                <div class="slide-huge">
                                    <div class="huge-heading"><?php echo $huge_heading; ?></div>
                                </div>
                            <?php endif; ?>
                            <h2 class="h1"><?php echo $slide_heading; ?></h2>
                            <div class="sub-heading h2"><?php echo $slide_sub_heading; ?></div>
                        </div>
                    </div>
                    <div class="slide-container hide-for-medium" style="background-image: url(<?php echo esc_url( $mobile_image['url'] ); ?>)">
                        <div class="slide-overlay<?php echo $slide_background; ?>">
                            &nbsp;
                        </div>

                        <div class="slide-info">
                            <?php if ( $huge_heading != '' ): ?>
                                <div class="slide-huge">
                                    <div class="huge-heading"><?php echo $huge_heading; ?></div>
                                </div>
                            <?php endif; ?>
                            <h2 class="h1"><?php echo $slide_heading; ?></h2>
                            <div class="sub-heading h2"><?php echo $slide_sub_heading; ?></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php echo $link_close; ?>

            </div>
        <?php endif; ?>
    <?php endwhile; ?>

</div>