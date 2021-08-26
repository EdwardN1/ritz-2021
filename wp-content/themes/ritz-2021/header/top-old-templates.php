<?php global $template_name; ?>
<?php $header_select = $template_name;?>

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
                                    <a href="https://www.facebook.com/theritzlondon" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg"></a>
                                </div>
                                <div class="cell shrink text-right">
                                    <a href="https://instagram.com/theritzlondon" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.svg"></a>
                                </div>
                                <div class="cell shrink text-right">
                                    <a href="https://twitter.com/theritzlondon" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.svg"></a>
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
                    <a href="/contact/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bell.svg"></a>
                </div>
            </div>
        </div>
    </div>

<?php if(is_block_page()) $header_select = ''; ?>
<?php switch ( $header_select ): ?>
<?php case 'T3 Detail Page': ?>
		<?php get_template_part( 'old/header', 'detail' ); ?>
		<?php break; ?>
<?php case 'T5 Grid Page': ?>
		<?php get_template_part( 'old/header', 'grid' ); ?>
		<?php break; ?>
	<?php default: ?>
        <div class="header-spacer">&nbsp;</div>
        <div class="header-main show-for-large">
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
                            <div class="cell shrink link text-right"><a href="/contact-us/" class="blue">CONTACT US</a></div>
                            <div class="cell shrink link text-right"><a href="https://www.theritzlondonvouchers.com/" target="_blank" class="blue">GIFT VOUCHERS</a></div>
                            <div class="cell shrink social">
                                <div class="grid-x">
                                    <div class="cell auto">&nbsp;</div>
                                    <div class="cell shrink text-right">
                                        <a href="https://www.facebook.com/theritzlondon" target="_blank"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook-blue.svg"></a>
                                    </div>
                                    <div class="cell shrink text-right">
                                        <a href="https://instagram.com/theritzlondon" target="_blank"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram-blue.svg"></a>
                                    </div>
                                    <div class="cell shrink text-right">
                                        <a href="https://twitter.com/theritzlondon" target="_blank"><img
                                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter-blue.svg"></a>
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
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/mobile-menu-burger-button-blue.svg"></a>
                    </div>
                    <div class="cell shrink logo">
                        <a href="/"><img
                                    src="<?php echo get_template_directory_uri(); ?>/assets/images/blue-ritz-logo.svg"
                                    class="ritz-logo"></a>
                    </div>
                    <div class="cell auto links-social text-right">
                        <a data-toggle="off-canvas"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/bell-blue.svg"></a>
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="breadcrumbs text-center"><?php /*echo get_breadcrumb(); */?></div>-->
	<?php endswitch; ?>

<?php if ( ! is_front_page() ): ?>
    <div class="breadcrumb-spacer">&nbsp;</div>
    <div class="breadcrumbs text-center"><?php echo get_breadcrumb(); ?></div>
<?php endif; ?>