<?php
/**
 * The template for displaying 404 (page not found) pages.
 *
 * For more info: https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header(); ?>

    <div class="content">

        <div class="inner-content grid-x grid-margin-x grid-padding-x">

            <main class="main small-12 medium-12 large-12 cell" role="main">

                <article class="content-not-found">
                    <div class="grid-container">
                        <header class="article-header">
                            <h1 style="text-align: center; text-transform: uppercase;"><?php _e('Page Not Found', 'jointswp'); ?></h1>
                        </header> <!-- end article header -->

                        <section class="entry-content">

                            <div id="two-columns-block_610d1279b08b0" class="ritz-block-two-columns">

                                <div class="grid-x show-for-medium">
                                    <div class="cell large-4 medium-5 text-center">
                                        <div class="left container">
                                            <div class="animated-container animate__animated animate__fadeInUp">
                                                <div class="heading">
                                                    <h2 class="h3">
                                                        WELCOME TO THE RITZ </h2>
                                                </div>
                                                <div class="content">
                                                    <p>We are London’s most iconic hotel. A five star haven on
                                                        Piccadilly that is famous the world over for its historic
                                                        elegance, impeccable service, impressive suites, and legendary
                                                        Afternoon Tea.</p>
                                                </div>
                                                <div class="link">
                                                    <a href="https://www.theritzlondon.com/about-the-ritz/"
                                                       class="link button-underlined long">Read Our Welcome</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell large-8 medium-7">
                                        <div class="image-container animated-background">
                                            <div class="image animated"
                                                 style="background-image: url(https://www.theritzlondon.com/wp-content/uploads/2022/09/The-hotel-lobby.jpg)">
                                                <a href="https://www.theritzlondon.com/about-the-ritz/"
                                                   class="image-link"></a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="hide-for-medium">
                                    <div class="top container text-center">
                                        <div class="heading">
                                            <h2 class="h3">
                                                WELCOME TO THE RITZ </h2>
                                        </div>
                                        <div class="content">
                                            <p>We are London’s most iconic hotel. A five star haven on Piccadilly that
                                                is famous the world over for its historic elegance, impeccable service,
                                                impressive suites, and legendary Afternoon Tea.</p>
                                        </div>
                                        <div class="link">
                                            <a href="https://www.theritzlondon.com/about-the-ritz/"
                                               class="link button-underlined long">Read Our Welcome</a></div>
                                    </div>
                                    <div>
                                        <div class="image"
                                             style="background-image: url(https://www.theritzlondon.com/wp-content/uploads/2022/09/The-hotel-lobby.jpg)">
                                            <a href="https://www.theritzlondon.com/about-the-ritz/"
                                               class="image-link"></a></div>
                                    </div>
                                </div>

                            </div>


                        </section> <!-- end article section -->

                        <div style="padding-top: 3em;">
                            <h2 class="h3" style="text-transform: uppercase;">Popular pages at The Ritz Hotel London</h2>
                            <ul style="margin: 0;">
                                <li><a href="/">Home Page</a> </li>
                                <li><a href="/about-the-ritz/">About the Ritz</a> </li>
                                <li><a href="/dine-with-us/">Dine with us</a> </li>
                                <li><a href="/book-a-room/">Book a room</a> </li>
                            </ul>
                        </div>

                        <!--<section class="search">

                            <p><?php /*get_search_form(); */?></p>

                        </section>--> <!-- end search section -->
                    </div>

                </article> <!-- end article -->

            </main> <!-- end #main -->

        </div> <!-- end #inner-content -->

    </div> <!-- end #content -->

<?php get_footer(); ?>