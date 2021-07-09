<?php
/**
 * The template for displaying the header
 *
 * This is the template that displays all of the <head> section
 *
 */
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
        <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
        <link href="<?php echo get_template_directory_uri(); ?>/assets/images/apple-icon-touch.png"
              rel="apple-touch-icon"/>
    <?php } ?>

    <!--<link rel="pingback" href="<?php /*bloginfo('pingback_url'); */ ?>">-->

    <?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

<div class="off-canvas-wrapper">

    <!-- Load off-canvas container. Feel free to remove if not using. -->
    <?php get_template_part('parts/content', 'offcanvas'); ?>

    <div class="off-canvas-content" data-off-canvas-content>

        <header class="header" role="banner">

            <div class="blue-top show-for-large">

            </div>

            <?php

            if (has_post_thumbnail()) {
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
                                                    <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg"></a>
                                                </div>
                                                <div class="cell shrink text-right">
                                                    <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.svg"></a>
                                                </div>
                                                <div class="cell shrink text-right">
                                                    <a href="#" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.svg"></a>
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
                            <h1><?php the_field('page_heading'); ?></h1>
                            <h2><?php the_field('page_sub_heading'); ?></h2>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

            <!-- This navs will be applied to the topbar, above all content
                 To see additional nav styles, visit the /parts directory -->
            <?php get_template_part('parts/nav', 'offcanvas-topbar'); ?>

        </header> <!-- end .header -->