<?php
if (has_post_thumbnail()&&!is_archive()) :
    $title = get_post(get_post_thumbnail_id(get_the_ID(),))->post_title;
    $alt = get_post_meta(get_post_thumbnail_id(get_the_ID()), '_wp_attachment_image_alt', true);
    $caption = get_post(get_post_thumbnail_id(get_the_ID(),))->post_excerpt;
    ?>
    <div class="featured-image"
         style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>)">
        <div class="overlay"></div>
        <div class="header-main show-for-large">
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
                            <div class="cell shrink link text-right"><a href="/contact-us/">CONTACT US</a></div>
                            <div class="cell shrink link text-right"><a href="https://www.theritzlondonvouchers.com/" target="_blank">GIFT VOUCHERS</a></div>
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
        <div class="header-main hide-for-large">
            <div class="grid-container">
                <div class="grid-x">
                    <div class="cell auto menu-button">
                        <a data-toggle="off-canvas"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-menu-burger-button.svg"></a>
                    </div>
                    <div class="cell shrink logo">
                        <a href="/"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/white-ritz-logo.svg"
                                    class="ritz-logo"></a>
                    </div>
                    <div class="cell auto links-social text-right">
                        <a data-toggle="off-canvas"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/bell.svg"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="featured-content">
            <div class="grid-container">
                <?php if ($caption != ''): ?>
                    <h1><?php echo '<span class="large">' . $caption . '</span><br>' . $title; ?></h1>
                <?php else: ?>
                    <h1><?php echo $title; ?></h1>
                <?php endif; ?>
                <h2><?php echo $alt; ?></h2>
            </div>
        </div>
    </div>
    <?php if (!is_front_page()): ?>
    <div class="breadcrumb-spacer">&nbsp;</div>
    <div class="breadcrumbs text-center"><?php echo get_breadcrumb(); ?></div>
<?php endif; ?>
<?php else: ?>
    <?php get_template_part('header/top', 'old-templates') ?>

<?php endif; ?>