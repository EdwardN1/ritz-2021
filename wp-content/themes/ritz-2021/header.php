<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section
 *
 */

global $ritz_template_name;
?>

<!doctype html>

<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8">

    <!-- Force IE to use the latest rendering engine available -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta class="foundation-mq">

    <!-- If Site Icon isn't set in customizer -->
    <?php if (!function_exists('has_site_icon') || !has_site_icon()) { ?>
        <!-- Icons & Favicons -->
        <link rel="apple-touch-icon" sizes="180x180"
              href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32"
              href="<?php echo get_template_directory_uri(); ?>/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16"
              href="<?php echo get_template_directory_uri(); ?>/favicon-16x16.png">
        <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/safari-pinned-tab.svg" color="#5bbad5">
    <?php } ?>

    <!--<link rel="pingback" href="<?php /*bloginfo('pingback_url'); */ ?>">-->

    <?php wp_head(); ?>

</head>

<body <?php body_class($ritz_template_name); ?>>

<div class="off-canvas-wrapper">

    <!-- Load off-canvas container. Feel free to remove if not using. -->
    <?php get_template_part('parts/content', 'offcanvas'); ?>

    <div class="off-canvas-content" data-off-canvas-content>

        <header class="header" role="banner">

            <div class="blue-bottom hide-for-large">
                <div class="grid-container">
                    <div class="grid-x">
                        <div class="cell auto">
                            &nbsp;
                        </div>
                        <div class="cell shrink reservations">
                            <a href="#/booking/step-1" id="book-nav" class="stay-with-us top-button book-now-button">Stay
                                with us</a>
                        </div>
                        <div class="cell shrink dining">
                            <a class="dine-with-us top-button" data-toggle="bookings-panel-mobile">Dine with
                                us</a>
                            <div class="dropdown-pane top" id="bookings-panel-mobile" data-dropdown
                                 data-close-on-click="true" data-auto-focus="true">
                                <div class="booking-line">
                                    <a id="mobile-header-sr-res-root" class="ritz-seven-rooms" data-venueid="theritzrestaurant">The Ritz Restaurant</a>
                                </div>
                                <div class="booking-line">
                                    <a id="mobile-header-sr-res-tea-root" class="ritz-seven-rooms" data-venueid="ritzafternoontea">Afternoon Tea</a>
                                </div>
                                <!--<div class="booking-line">
                                            <a id="mobile-header-sr-res-garden-root" class="ritz-seven-rooms" data-venueid="ritzgarden">The Ritz Garden</a>
                                        </div>-->
                                <?php if (have_rows('addition_dining_links', 'option')) : ?>
                                    <?php while (have_rows('addition_dining_links', 'option')) : the_row(); ?>
                                        <?php $page = get_sub_field('page'); ?>
                                        <?php if ($page) : ?>
                                            <div class="booking-line">
                                                <a href="<?php echo esc_url($page); ?>"><?php the_sub_field('link_text'); ?></a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endwhile; ?>
                                <?php else : ?>
                                    <?php // no rows found ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="cell auto">
                            &nbsp;
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-main-new">
                <div class="grid-container show-for-large">
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
                        <div class="cell auto booking-section">
                            <div class="grid-x">
                                <div class="cell auto">
                                    &nbsp;
                                </div>
                                <div class="cell shrink reservations">
                                    <a href="#/booking/step-1" id="book-nav" class="stay-with-us top-button book-now-button">Stay
                                        with us</a>
                                </div>
                                <div class="cell shrink dining">
                                    <a class="dine-with-us top-button" data-toggle="bookings-panel">Dine with us</a>
                                    <div class="dropdown-pane" id="bookings-panel" data-dropdown data-close-on-click="true"
                                         data-auto-focus="true">
                                        <div class="booking-line">
                                            <a id="header-sr-res-root" class="ritz-seven-rooms" data-venueid="theritzrestaurant">The Ritz Restaurant</a>
                                        </div>
                                        <div class="booking-line">
                                            <a id="header-sr-res-tea-root" class="ritz-seven-rooms" data-venueid="ritzafternoontea">Afternoon Tea</a>
                                        </div>
                                        <!--<div class="booking-line">
                                            <a id="header-sr-res-garden-root" class="ritz-seven-rooms" data-venueid="ritzgarden">The Ritz Garden</a>
                                        </div>-->
                                        <?php if ( have_rows( 'addition_dining_links', 'option' ) ) : ?>
                                            <?php while ( have_rows( 'addition_dining_links', 'option' ) ) : the_row(); ?>
                                                <?php $page = get_sub_field( 'page' ); ?>
                                                <?php if ( $page ) : ?>
                                                    <div class="booking-line">
                                                        <a href="<?php echo esc_url( $page ); ?>"><?php the_sub_field( 'link_text' ); ?></a>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php else : ?>
                                            <?php // no rows found ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-container hide-for-large">
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
                            <a href="/contact-us/"><img
                                        src="<?php echo get_template_directory_uri(); ?>/assets/images/bell-blue.svg"></a>
                        </div>
                    </div>
                </div>
            </div>


            <?php if ( have_rows( 'image_gallery' ) ) : ?>

                <?php get_template_part( 'header/part', 'image-gallery' ) ?>
            <?php else : ?>
                <?php //get_template_part( 'header/top', 'featured-image' ) ?>
            <?php endif; ?>

            <?php if ( ! is_front_page() ): ?>
                <div class="breadcrumb-spacer">&nbsp;</div>
                <div class="breadcrumbs text-center"><?php echo get_breadcrumb(); ?></div>
            <?php endif; ?>

        </header> <!-- end .header -->