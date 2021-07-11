<?php
/**
 * The template part for displaying offcanvas content
 *
 * For more info: http://jointswp.com/docs/off-canvas-menu/
 */
?>

<div class="off-canvas position-left" id="off-canvas" data-off-canvas>

    <button class="close-button" aria-label="Close menu" type="button" data-close>
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/close.svg">
    </button>

    <div class="grid-container">
        <div class="logo text-center">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/blue-ritz-logo.svg">
        </div>
        <div class="grid-x">
            <div class="cell auto main-nav">

                <?php
                $numRows = 3;
                if (have_rows('page_links', 'option')) :
                    $i = 1;
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
                        if ($link_type == 'External URL') {
                            $href = get_sub_field('text_link');
                        }
                        if ($href != ''):
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
                                <?php if ($i == 1):
                                ?>
                                    <div class="spacer spacer-<?php echo $i;
                                ?> animate__animated animate__fadeInDown"
                                         style="height: <?php echo $spacer_height;
                                ?>px"></div>
                                <?php else:
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
                            if ($link_type == 'External URL') {
                                $href = get_sub_field('text_link');
                            }
                            if ($href != ''):
                                if (have_rows('child_pages')) :
                                    if ($i == 1) {
                                        echo '<div class="child-menu child-menu-' . $i . ' animate__animated animate__fadeInDown">';
                                    } else {
                                        $padTop = ($i - 1) * 59;
                                        //error_log('numRows = '.$numRows.' $i = '.$i);
                                        if ($i == $numRows) {
                                            $padTop = ($i - 2) * 59;
                                        }
                                        echo '<div class="child-menu child-menu-' . $i . ' animate__animated animate__fadeOutUp" style="padding-top:' . $padTop . 'px">';
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
                                        if ($link_type == 'External URL') {
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
        <div class="footer-main-links grid-x">
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
                    if ($link_type == 'External URL') {
                        $href = get_sub_field('text_link');
                    }
                    $target = '';
                    if (get_sub_field('open_in_new_tab') == 1) :
                        $target = ' target="_blank"';
                    endif;
                    ?>
                    <div class="cell shrink">
                        <h2><a href="<?php echo $href;?>"><?php the_sub_field('link_text'); ?></a></h2>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="footer-sub-links grid-x">
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
                    if ($link_type == 'External URL') {
                        $href = get_sub_field('text_link');
                    }
                    $target = '';
                    if (get_sub_field('open_in_new_tab') == 1) :
                        $target = ' target="_blank"';
                    endif;
                    ?>
                    <div class="cell shrink">
                        <a href="<?php echo $href;?>"><?php the_sub_field('link_text'); ?></a>
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
