<?php
if (has_post_thumbnail()) :
    $title = get_post(get_post_thumbnail_id(get_the_ID(),))->post_title;
    $alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
    ?>
    <div class="featured-image"
         style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>)">
        <div class="overlay"></div>
        <div class="header-main">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="cell auto menu-button">
                        <a data-toggle="off-canvas"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/menu-burger-button.svg"></a>
                    </div>
                    <div class="cell shrink logo">
                        <a href="/"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/white-ritz-logo.svg"
                                    class="ritz-logo"></a>
                    </div>
                    <div class="cell auto links-social">
                        <div class="grid-x">
                            <div class="cell auto">&nbsp;</div>
                            <div class="cell shrink link text-right"><a href="#">CONTACT US</a></div>
                            <div class="cell shrink link text-right"><a href="#">GIFT VOUCHERS</a></div>
                            <div class="cell shrink social">
                                <div class="grid-x">
                                    <div class="cell auto">&nbsp;</div>
                                    <div class="cell shrink text-right">
                                        <a href="#" target="_blank"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg"></a>
                                    </div>
                                    <div class="cell shrink text-right">
                                        <a href="#" target="_blank"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.svg"></a>
                                    </div>
                                    <div class="cell shrink text-right">
                                        <a href="#" target="_blank"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.svg"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="featured-content">
            <div class="grid-container">
                <h1><?php echo $title; ?></h1>
                <h2><?php echo $alt; ?></h2>
            </div>
        </div>
    </div>
    <?php if (!is_front_page()): ?>
    <div class="breadcrumb-spacer">&nbsp;</div>
    <div class="breadcrumbs text-center"><?php echo get_breadcrumb(); ?></div>
<?php endif; ?>
<?php
else:
    ?>
    <div class="header-spacer">&nbsp;</div>
    <div class="header-main">
        <div class="grid-container">
            <div class="grid-x">
                <div class="cell auto menu-button">
                    <a data-toggle="off-canvas"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/menu-burger-button-blue.svg"></a>
                </div>
                <div class="cell shrink logo">
                    <a href="/"><img
                                src="<?php echo get_template_directory_uri(); ?>/assets/images/blue-ritz-logo.svg"
                                class="ritz-logo"></a>
                </div>
                <div class="cell auto links-social">
                    <div class="grid-x">
                        <div class="cell auto">&nbsp;</div>
                        <div class="cell shrink link text-right"><a href="#" class="blue">CONTACT US</a></div>
                        <div class="cell shrink link text-right"><a href="#" class="blue">GIFT VOUCHERS</a></div>
                        <div class="cell shrink social">
                            <div class="grid-x">
                                <div class="cell auto">&nbsp;</div>
                                <div class="cell shrink text-right">
                                    <a href="#" target="_blank"><img
                                                src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-blue.svg"></a>
                                </div>
                                <div class="cell shrink text-right">
                                    <a href="#" target="_blank"><img
                                                src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-blue.svg"></a>
                                </div>
                                <div class="cell shrink text-right">
                                    <a href="#" target="_blank"><img
                                                src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-blue.svg"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcrumbs text-center"><?php echo get_breadcrumb(); ?></div>
<?php
endif;