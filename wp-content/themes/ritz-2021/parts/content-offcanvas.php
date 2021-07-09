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
                            </h3>
                        <?php
                        endif;
                        $i++;
                    endwhile;
                endif;
                ?>
            </div>
            <div class="cell auto sub-nav">
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
                        echo '<div class="">'.get_sub_field('link_text').'</div>';
                        if ($href != ''):
                            if (have_rows('child_pages')) :
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
                                            <a href="<?php echo esc_url($href); ?>"<?php echo $target; ?>
                                               class="parent-<?php echo $i; ?>"><?php echo esc_html($link_text); ?></a>
                                        </h2>
                                    <?php
                                    endif;
                                endwhile;
                            endif;
                        endif;                        /** if ($href != ''): **/
                        $i++;
                    endwhile;
                endif;
                ?>
            </div>
            <div class="cell auto special-offer">

            </div>
        </div>
    </div>

</div>
