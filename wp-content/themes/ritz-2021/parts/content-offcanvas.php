<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */

$current_page_id = get_queried_object_id();
$no_menu_page = true;
if (is_front_page()):
    $no_menu_page == true;
else:
    if (have_rows('page_links', 'option')) :
        $currentpage_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        while (have_rows('page_links', 'option')) : the_row();
            $href = '';
            $link_type = get_sub_field('link_type');
            if ($link_type == 'Page') {
                $href = get_sub_field('page');
            }
            if ($link_type == 'Post') {
                $href = get_sub_field('post');
            }
            if ($link_type == 'External URL') {
                $href = get_sub_field('external_url');
            }
            if ($link_type == 'Text') {
                $href = get_sub_field('text_link');
            }
            if ($href == $currentpage_link) $no_menu_page = false;
            if (have_rows('child_pages')) :
                while (have_rows('child_pages')) : the_row();
                    $c_href = '';
                    $c_link_type = get_sub_field('link_type');
                    if ($c_link_type == 'Page') {
                        $c_href = get_sub_field('page_link');
                    }
                    if ($c_link_type == 'Post') {
                        $c_href = get_sub_field('post_link');
                    }
                    if ($c_link_type == 'External URL') {
                        $c_href = get_sub_field('external_url');
                    }
                    if ($c_link_type == 'Text') {
                        $c_href = get_sub_field('text_link');
                    }
                    if ($c_href == $currentpage_link) $no_menu_page = false;
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
            <a href="/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/blue-ritz-logo.svg"></a>
        </div>

        <div class="mobile-menu hide-for-large">

            <?php if (have_rows('page_links', 'option')) : ?>
                <ul class="vertical menu accordion-menu" data-accordion-menu data-submenu-toggle="true">
                    <?php while (have_rows('page_links', 'option')) : the_row(); ?>
                        <li>
                            <?php
                            $link_type = get_sub_field('link_type');
                            $isActive = '';
                            $target = '';
                            if (get_sub_field('open_in_new_tab') == 1) :
                                $target = ' target="_blank"';
                            endif;
                            $link_text = get_sub_field('link_text');
                            $href = '#';
                            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            if ($link_type == 'Page') {
                                $href = get_sub_field('page');
                                if ($actual_link == $href) {
                                    $isActive = ' is-active';
                                }
                            }
                            if ($link_type == 'Post') {
                                $href = get_sub_field('post');
                            }
                            if ($link_type == 'External URL') {
                                $href = get_sub_field('external_url');
                            }
                            if ($link_type == 'Text') {
                                $href = get_sub_field('text_link');
                            }

                            ?>
                            <a href="<?php echo $href; ?>"<?php echo $target; ?>
                               class="top-level-link"><?php the_sub_field('link_text'); ?></a>
                            <?php if (have_rows('child_pages')) :
                                $childItems = '';
                                while (have_rows('child_pages')) : the_row();
                                    $c_link_type = get_sub_field('link_type');
                                    $c_target = '';
                                    if (get_sub_field('open_in_new_tab') == 1) :
                                        $c_target = ' target="_blank"';
                                    endif;
                                    $c_link_text = get_sub_field('link_text');
                                    $c_href = '#';
                                    if ($c_link_type == 'Page') {
                                        $c_href = get_sub_field('page_link');
                                        if ($actual_link == $c_href) {
                                            $isActive = ' is-active';
                                        }
                                    }
                                    if ($c_link_type == 'Post') {
                                        $c_href = get_sub_field('post_link');
                                    }
                                    if ($c_link_type == 'External URL') {
                                        $c_href = get_sub_field('external_url');
                                    }
                                    if ($c_link_type == 'Text') {
                                        $c_href = get_sub_field('text_link');
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
                <?php if (have_rows('footer_main_links', 'option')) : ?>
                    <?php while (have_rows('footer_main_links', 'option')) : the_row(); ?>
                        <?php
                        $link_type = get_sub_field('link_type');
                        $href = '#';
                        if ($link_type == 'Page') {
                            $href = get_sub_field('page_link');
                        }
                        if ($link_type == 'Post') {
                            $href = get_sub_field('post_link');
                        }
                        if ($link_type == 'External URL') {
                            $href = get_sub_field('external_url');
                        }
                        if ($link_type == 'Text') {
                            $href = get_sub_field('text_link');
                        }
                        $target = '';
                        if (get_sub_field('open_in_new_tab') == 1) :
                            $target = ' target="_blank"';
                        endif;
                        ?>
                        <div>
                            <a href="<?php echo $href; ?>"><?php the_sub_field('link_text'); ?></a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="footer-sub-links">
                <?php if (have_rows('footer_sub_links', 'option')) : ?>
                    <?php while (have_rows('footer_sub_links', 'option')) : the_row(); ?>
                        <?php
                        $link_type = get_sub_field('link_type');
                        $href = '#';
                        if ($link_type == 'Page') {
                            $href = get_sub_field('page_link');
                        }
                        if ($link_type == 'Post') {
                            $href = get_sub_field('post_link');
                        }
                        if ($link_type == 'External URL') {
                            $href = get_sub_field('external_url');
                        }
                        if ($link_type == 'Text') {
                            $href = get_sub_field('text_link');
                        }
                        $target = '';
                        if (get_sub_field('open_in_new_tab') == 1) :
                            $target = ' target="_blank"';
                        endif;
                        ?>
                        <div>
                            <a href="<?php echo $href; ?>"><?php the_sub_field('link_text'); ?></a>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>

        <div class="grid-x show-for-large">
            <div class="cell auto main-nav">

                <?php
                $numRows = 3;
                $currentpage_set = false;
                if (have_rows('page_links', 'option')) :
                    $i = 1;
                    $currentpage_index = 1;
                    $currentpage = false;
                    while (have_rows('page_links', 'option')) : the_row();
                        $link_type = get_sub_field('link_type');
                        $target = '';
                        if (get_sub_field('open_in_new_tab') == 1) :
                            $target = ' target="_blank"';
                        endif;
                        $link_text = get_sub_field('link_text');
                        $href = '';
                        if ($link_type == 'Page') {
                            $href = get_sub_field('page');
                        }
                        if ($link_type == 'Post') {
                            $href = get_sub_field('post');
                        }
                        if ($link_type == 'External URL') {
                            $href = get_sub_field('external_url');
                        }
                        if ($link_type == 'Text') {
                            $href = get_sub_field('text_link');
                        }
                        if ($href != ''):
                            if (!is_front_page()) {
                                $href_postID = url_to_postid($href);
                                if ($href_postID != 0) {
                                    if ($href_postID == $current_page_id) {
                                        $currentpage = true;
                                    } else {
                                        if (have_rows('child_pages')) :
                                            while (have_rows('child_pages')) : the_row();
                                                $jxhref = '';
                                                if ($link_type == 'Page') {
                                                    $jxhref = get_sub_field('page_link');
                                                }
                                                if ($link_type == 'Post') {
                                                    $jxhref = get_sub_field('post_link');
                                                }
                                                if ($link_type == 'External URL') {
                                                    $jxhref = get_sub_field('external_url');
                                                }
                                                if ($link_type == 'Text') {
                                                    $jxhref = get_sub_field('text_link');
                                                }
                                                if ($jxhref != ''):
                                                    $jxhref_postID = url_to_postid($jxhref);
                                                    if ($jxhref_postID == $current_page_id) {
                                                        $currentpage = true;
                                                    }
                                                endif;
                                            endwhile;
                                        endif;
                                    }
                                }
                            }
                            //if ($currentpage) error_log('Current Page is True');
                            ?>
                            <h3 class="menu-page-link">
                                <a href="<?php echo esc_url($href); ?>"<?php echo $target; ?>
                                   class="parent-<?php echo $i; ?>"><?php echo esc_html($link_text); ?></a>
                                <?php
                                $spacer_height = 0;
                                if (get_sub_field("child_pages")) {
                                    $spacer_height = count(get_sub_field("child_pages")) * 28;
                                }
                                ?>
                                <?php if (($no_menu_page)&&($i==1)):
                                    ?>
                                    <div class="spacer spacer-<?php echo $i;
                                    ?> animate__animated animate__fadeInDown"
                                         style="height: <?php echo $spacer_height;
                                         ?>px"></div>
                                <?php else:
                                    if (($currentpage)&&(!$currentpage_set)):
                                        $currentpage = false;
                                        $currentpage_index = $i;
                                        $currentpage_set = true;
                                        ?>
                                        <div class="spacer spacer-<?php echo $i;
                                        ?> animate__animated animate__fadeInDown"
                                             style="height: <?php echo $spacer_height;
                                             ?>px"></div>
                                    <?php
                                    endif;
                                    ?>
                                    <div class="spacer spacer-<?php echo $i;
                                    ?> animate__animated animate__fadeOutUp"
                                         style="height: <?php echo $spacer_height;
                                         ?>px"></div>
                                <?php endif;
                                ?>
                            </h3>
                        <?php
                        endif;
                        $i++;
                    endwhile;
                    $numRows = $i - 1;
                endif;
                ?>

            </div>
            <div class="cell auto sub-nav">
                <div class="inner">
                    <?php
                    if (have_rows('page_links', 'option')) :
                        $i = 1;
                        while (have_rows('page_links', 'option')) : the_row();
                            $link_type = get_sub_field('link_type');
                            $href = '';
                            if ($link_type == 'Page') {
                                $href = get_sub_field('page');
                            }
                            if ($link_type == 'Post') {
                                $href = get_sub_field('post');
                            }
                            if ($link_type == 'External URL') {
                                $href = get_sub_field('external_url');
                            }
                            if ($link_type == 'Text') {
                                $href = get_sub_field('text_link');
                            }
                            if ($href != ''):
                                if (have_rows('child_pages')) :
                                    if (($no_menu_page)&&($i==1)) {
                                        echo '<div class="child-menu child-menu-' . $i . ' animate__animated animate__fadeInDown">';
                                    } else {
                                        $padTop = ($i - 1) * 59;
                                        //error_log('numRows = '.$numRows.' $i = '.$i);
                                        if ($i == $numRows) {
                                            $padTop = ($i - 2) * 59;
                                        }
                                        if ($currentpage_index == $i) {
                                            echo '<div class="child-menu child-menu-' . $i . ' animate__animated animate__fadeInDown" style="padding-top:' . $padTop . 'px">';
                                        } else {
                                            echo '<div class="child-menu child-menu-' . $i . ' animate__animated animate__fadeOutUp" style="padding-top:' . $padTop . 'px">';
                                        }

                                    }

                                    while (have_rows('child_pages')) : the_row();

                                        $link_text = get_sub_field('link_text');
                                        $link_type = get_sub_field('link_type');
                                        //echo '<h2>'.$link_text.' link: '.get_sub_field('page').'</h2>';
                                        $target = '';
                                        if (get_sub_field('open_in_new_tab') == 1) :
                                            $target = ' target="_blank"';
                                        endif;
                                        $jhref = '';
                                        if ($link_type == 'Page') {
                                            $jhref = get_sub_field('page_link');
                                        }
                                        if ($link_type == 'Post') {
                                            $jhref = get_sub_field('post_link');
                                        }
                                        if ($link_type == 'External URL') {
                                            $jhref = get_sub_field('external_url');
                                        }
                                        if ($link_type == 'Text') {
                                            $jhref = get_sub_field('text_link');
                                        }
                                        if ($jhref != ''):
                                            ?>
                                            <h2 class="menu-page-link">
                                                <a href="<?php echo esc_url($jhref); ?>"<?php echo $target; ?>
                                                   class=""><?php echo esc_html($link_text); ?></a>
                                            </h2>
                                        <?php
                                        endif;
                                    endwhile;
                                    echo '</div>';
                                endif;
                            endif;
                            /** if ($href != ''): **/
                            $i++;
                        endwhile;
                    endif;
                    ?>
                </div>
            </div>
            <div class="cell auto special-offer">
                <div class="inner">
                    <?php if (have_rows('special_offer', 'option')) : ?>
                        <?php while (have_rows('special_offer', 'option')) : the_row(); ?>
                            <?php $image = get_sub_field('image'); ?>
                            <div class="image"<?php if ($image) : ?>
                                style="background-image: url(<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>);"
                            <?php endif; ?>></div>
                            <h2 class="text-center"><?php the_sub_field('line_1'); ?></h2>
                            <h3 class="text-center"><?php the_sub_field('line_2'); ?></h3>
                            <h2 class="text-center"><?php the_sub_field('line_3'); ?></h2>
                            <div class="grid-x">
                                <div class="cell auto text-center">
                                    <a href="<?php $page_link = get_sub_field('page_link'); ?>"
                                       class="button-underline"><?php the_sub_field('link_text'); ?></a>
                                </div>
                                <div class="cell auto text-center">
                                    <a href="<?php $page_link = get_sub_field('page_link'); ?>" class="button-white">BOOK
                                        NOW</a>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="footer-main-links grid-x show-for-large">
            <?php if (have_rows('footer_main_links', 'option')) : ?>
                <?php while (have_rows('footer_main_links', 'option')) : the_row(); ?>
                    <?php
                    $link_type = get_sub_field('link_type');
                    $href = '#';
                    if ($link_type == 'Page') {
                        $href = get_sub_field('page');
                    }
                    if ($link_type == 'Post') {
                        $href = get_sub_field('post');
                    }
                    if ($link_type == 'External URL') {
                        $href = get_sub_field('external_url');
                    }
                    if ($link_type == 'Text') {
                        $href = get_sub_field('text_link');
                    }
                    $target = '';
                    if (get_sub_field('open_in_new_tab') == 1) :
                        $target = ' target="_blank"';
                    endif;
                    ?>
                    <div class="cell shrink">
                        <h2><a href="<?php echo $href; ?>"><?php the_sub_field('link_text'); ?></a></h2>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="footer-sub-links grid-x show-for-large">
            <?php if (have_rows('footer_sub_links', 'option')) : ?>
                <?php while (have_rows('footer_sub_links', 'option')) : the_row(); ?>
                    <?php
                    $link_type = get_sub_field('link_type');
                    $href = '#';
                    if ($link_type == 'Page') {
                        $href = get_sub_field('page');
                    }
                    if ($link_type == 'Post') {
                        $href = get_sub_field('post');
                    }
                    if ($link_type == 'External URL') {
                        $href = get_sub_field('external_url');
                    }
                    if ($link_type == 'Text') {
                        $href = get_sub_field('text_link');
                    }
                    $target = '';
                    if (get_sub_field('open_in_new_tab') == 1) :
                        $target = ' target="_blank"';
                    endif;
                    ?>
                    <div class="cell shrink">
                        <a href="<?php echo $href; ?>"><?php the_sub_field('link_text'); ?></a>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        jQuery(document).ready(function ($) {
            <?php
            for($x = 1;$x <= $i - 1;$x++) {
            ?>
            $('.parent-<?php echo $x; ?>').on('click', function (e) {
                    if ($('.child-menu-<?php echo $x; ?>').hasClass('animate__fadeOutUp')) {
                        e.preventDefault();
                        $('.child-menu').removeClass('animate__fadeInDown');
                        $('.child-menu').addClass('animate__fadeOutUp');
                        $('.spacer').removeClass('animate__fadeInDown');
                        $('.spacer').addClass('animate__fadeOutUp');
                        setTimeout(function () {
                            $('.child-menu-<?php echo $x; ?>').removeClass('animate__fadeOutUp');
                            $('.child-menu-<?php echo $x; ?>').addClass('animate__fadeInDown');
                            $('.spacer-<?php echo $x; ?>').removeClass('animate__fadeOutUp');
                            $('.spacer-menu-<?php echo $x; ?>').addClass('animate__fadeInDown');
                        }, 500);

                    }
                }
            )
            <?php
            }
            ?>

        });
    </script>

</div>
