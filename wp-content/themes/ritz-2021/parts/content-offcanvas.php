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
        <div class="grid-x">
            <div class="cell auto main-nav">
                <?php if (have_rows('page_links', 'option')) : ?>
                    <?php $i = 1; ?>
                    <?php while (have_rows('page_links', 'option')) : the_row(); ?>
                        <?php
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
                        ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <div class="cell auto sub-nav">
                <?php
                if (have_rows('page_links', 'option')) :
                    $i = 1;
                    while (have_rows('page_links', 'option')) : the_row();
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
                            <div class="child-<?php echo $i; ?>">
                            <?php
                            if (have_rows('child_pages')) {
                                while (have_rows('child_pages')) : the_row();
                                    $child_link_text = get_sub_field('link_text');
                                    $child_target = '';
                                    if (get_sub_field('open_in_new_tab') == 1) :
                                        $child_target = ' target="_blank"';
                                    endif;
                                    $child_link_type = get_sub_field('link_type');
                                    $child_href = '';
                                    if ($child_link_type == 'Page') {
                                        $child_href = get_sub_field('page');
                                    }
                                    if ($child_link_type == 'Post') {
                                        $child_href = get_sub_field('post');
                                    }
                                    if ($child_link_type == 'External URL') {
                                        $child_href = get_sub_field('external_url');
                                    }
                                    if ($child_link_type == 'External URL') {
                                        $child_href = get_sub_field('text_link');
                                    }
                                    if ($child_href != '') {
                                        ?>
                                        <h2 class="child-page-link">
                                            <a href="<?php echo esc_url($child_href); ?>"<?php echo $child_target; ?>><?php echo esc_html($child_link_text); ?></a>
                                        </h2>
                                        <?php
                                    }

                                endwhile;
                            }
                            $i++;
                        endif;

                        ?>
                        </div>
                    <?php
                    endwhile;
                endif; ?>
            </div>
            <div class="cell auto special-offer">

            </div>
        </div>
    </div>

</div>
