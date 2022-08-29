<?php
/**
 * Block template file: /parts/blocks/BlockRitzImageGallery.php
 *
 * Ritz Image Gallery Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 * @var   bool $is_preview True during AJAX preview.
 * @var   array $block The block settings and attributes.
 */

// Create id attribute allowing for custom "anchor" value.

global $use_seven_rooms;

$id = 'ritz-image-gallery-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-image-gallery-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_image_gallery_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_image_gallery_block_preview_image_help'] . '" style="width:100%; height:auto;">';

    return;
endif;

?>

<style type="text/css">
    <?php echo '#' . $id; ?>
    {
    /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>">
    <?php
    if (get_field('restrict_to_image_category') != 1) :
        $terms = get_terms(
            array(
                'taxonomy' => 'ritzimagegallerycategory',
                'hide_empty' => true,
            )
        );
        ?>
        <div class="filter-row show-1124">
        <div class="grid-x grid-padding-x grid-padding-y">
        <div class="cell auto show-for-medium show-1190"></div>
        <div class="cell large-shrink medium-shrink small-12">
            <a class="button-filter selected small" data-filter-class="all">All</a>
        </div>
        <?php
        $i = 2;
        foreach ($terms as $term) {
            $term_name = $term->name;
            $term_class = seoUrl($term_name);
            $button_size = ' small';
            if (strlen($term_name) > 4) $button_size = ' medium';
            if (strlen($term_name) > 7) $button_size = ' large';
            ?>
            <div class="cell large-shrink medium-shrink small-12">
                <a class="button-filter<?php echo $button_size; ?>"
                   data-filter-class="<?php echo $term_class; ?>"><?php echo $term_name; ?></a>
            </div>
            <?php
            $i++;
            if ($i > 5) {
                ?>
                <div class="cell auto show-for-medium show-1190"></div>
                </div>
                </div>
                <div class="filter-row  show-1124">
                <div class="grid-x grid-padding-x grid-padding-y">
                <div class="cell auto show-for-medium"></div>
                <?php
                $i = 1;
            }
        }
        ?>
        <div class="cell auto show-for-medium"></div>
        </div>
        </div>


        <div class="filter-row hide-1124">
        <div class="grid-x grid-padding-x grid-padding-y">
        <div class="cell auto show-for-medium show-970"></div>
        <div class="cell large-shrink medium-shrink small-12">
            <a class="button-filter selected small" data-filter-class="all">All</a>
        </div>
        <?php
        $i = 2;
        foreach ($terms as $term) {
            $term_name = $term->name;
            $term_class = seoUrl($term_name);
            $button_size = ' small';
            if (strlen($term_name) > 4) $button_size = ' medium';
            if (strlen($term_name) > 7) $button_size = ' large';
            ?>
            <div class="cell large-shrink medium-shrink small-12">
                <a class="button-filter<?php echo $button_size; ?>"
                   data-filter-class="<?php echo $term_class; ?>"><?php echo $term_name; ?></a>
            </div>
            <?php
            $i++;
            if ($i > 4) {
                ?>
                <div class="cell auto show-for-medium show-970"></div>
                </div>
                </div>
                <div class="filter-row  hide-1124">
                <div class="grid-x grid-padding-x grid-padding-y">
                <div class="cell auto show-for-medium show-970"></div>
                <?php
                $i = 1;
            }
        }
        ?>
        <div class="cell auto show-for-medium show-970"></div>
        </div>
        </div>


        <div class="filter-row show-for-medium hide-910">
        <div class="grid-x grid-padding-x grid-padding-y">
        <div class="cell auto show-for-medium"></div>
        <div class="cell large-shrink medium-shrink small-12">
            <a class="button-filter selected small" data-filter-class="all">All</a>
        </div>
        <?php
        $i = 2;
        foreach ($terms as $term) {
            $term_name = $term->name;
            $term_class = seoUrl($term_name);
            $button_size = ' small';
            if (strlen($term_name) > 4) $button_size = ' medium';
            if (strlen($term_name) > 7) $button_size = ' large';
            ?>
            <div class="cell large-shrink medium-shrink small-12">
                <a class="button-filter<?php echo $button_size; ?>"
                   data-filter-class="<?php echo $term_class; ?>"><?php echo $term_name; ?></a>
            </div>
            <?php
            $i++;
            if ($i > 3) {
                ?>
                <div class="cell auto show-for-medium"></div>
                </div>
                </div>
                <div class="filter-row  show-for-medium hide-910">
                <div class="grid-x grid-padding-x grid-padding-y">
                <div class="cell auto show-for-medium"></div>
                <?php
                $i = 1;
            }
        }
        ?>
        <div class="cell auto show-for-medium"></div>
        </div>
        </div>


        <div class="filter-row show-for-medium hide-768">
        <div class="grid-x grid-padding-x grid-padding-y">
        <div class="cell auto show-for-medium"></div>
        <div class="cell large-shrink medium-shrink small-12">
            <a class="button-filter selected small" data-filter-class="all">All</a>
        </div>
        <?php
        $i = 2;
        foreach ($terms as $term) {
            $term_name = $term->name;
            $term_class = seoUrl($term_name);
            $button_size = ' small';
            if (strlen($term_name) > 4) $button_size = ' medium';
            if (strlen($term_name) > 7) $button_size = ' large';
            ?>
            <div class="cell large-shrink medium-shrink small-12">
                <a class="button-filter<?php echo $button_size; ?>"
                   data-filter-class="<?php echo $term_class; ?>"><?php echo $term_name; ?></a>
            </div>
            <?php
            $i++;
            if ($i > 2) {
                ?>
                <div class="cell auto show-for-medium"></div>
                </div>
                </div>
                <div class="filter-row  show-for-medium hide-768">
                <div class="grid-x grid-padding-x grid-padding-y">
                <div class="cell auto show-for-medium"></div>
                <?php
                $i = 1;
            }
        }
        ?>
        <div class="cell auto show-for-medium"></div>
        </div>
        </div>


        <div class="filter-row hide-for-medium">
        <div class="grid-x grid-padding-x grid-padding-y">
        <div class="cell large-shrink medium-shrink small-12">
            <a class="button-filter selected small" data-filter-class="all">All</a>
        </div>
        <?php
        $i = 2;
        foreach ($terms as $term) {
            $term_name = $term->name;
            $term_class = seoUrl($term_name);
            $button_size = ' small';
            if (strlen($term_name) > 4) $button_size = ' medium';
            if (strlen($term_name) > 7) $button_size = ' large';
            ?>
            <div class="cell large-shrink medium-shrink small-12">
                <a class="button-filter<?php echo $button_size; ?>"
                   data-filter-class="<?php echo $term_class; ?>"><?php echo $term_name; ?></a>
            </div>
            <?php
            $i++;
            if ($i > 1) {
                ?>
                </div>
                </div>
                <div class="filter-row hide-for-medium">
                <div class="grid-x grid-padding-x grid-padding-y">
                <?php
                $i = 1;
            }
        }
        ?>
        </div>
        </div>



    <?php endif; ?>
    <div class="image-grid">
        <div class="grid-x grid-margin-x grid-margin-y">
            <?php
            $args = array(
                'post_type' => 'ritzimagegallery',
                'posts_per_page' => -1
            );
            if ($is_preview) {
                $args = array(
                    'post_type' => 'ritzimagegallery',
                    'posts_per_page' => 12
                );
            }
            if (get_field('restrict_to_image_category') == 1) :
                $image_category = get_field('image_category');
                $args = array(
                    'post_type' => 'ritzimagegallery',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'ritzimagegallerycategory',
                            'field' => 'term_id',
                            'terms' => $image_category
                        )
                    ),
                    'posts_per_page' => -1
                );
                if ($is_preview) {
                    $args = array(
                        'post_type' => 'ritzimagegallery',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'ritzimagegallerycategory',
                                'field' => 'term_id',
                                'terms' => $image_category
                            )
                        ),
                        'posts_per_page' => 12
                    );
                }
            endif;


            $loop = new WP_Query($args);
            $x = 1;
            $y = 1;
            $c_1 = '<div class="cell large-4 medium-6 small-12">';
            $c_2 = '<div class="cell large-4 medium-6 small-12">';
            $c_3 = '<div class="cell large-4 medium-6 small-12">';
            $c = 1;
            ?>
            <?php while ($loop->have_posts()) : $loop->the_post(); ?>
                <?php
                ob_start();
                $postID = get_the_ID();
                $image = get_field('image', $postID);
                $uniqueID = uniqid();
                $image_category = get_field('image_category', $postID);
                $term = get_term_by('id', $image_category, 'ritzimagegallerycategory');
                $data_filter_class = seoUrl(esc_html($term->name));
                ?>
                <div class="icontainer x<?php echo $x; ?> y<?php echo $y; ?> <?php echo $data_filter_class; ?>">

                    <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal
                         data-galleryid="<?php echo $uniqueID; ?>">
                        <div class="image-gallery-container">
                            <div class="gallery-image"
                                 style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                                <span class="close-reveal-modal" data-close>&times;</span>
                            </div>
                            <div class="info">
                                <div class="grid-x">
                                    <div class="cell auto caption">
                                        <?php the_title(); ?>
                                    </div>
                                    <div class="cell shrink price">
                                        <?php the_field('price_description', $postID); ?>
                                    </div>
                                    <div class="cell shrink booking">
                                        <?php
                                        $booking_options = get_field('booking_options', $postID);
                                        $booking_link_text = get_field('booking_link_text', $postID);
                                        if ($booking_options == 'AZDS') {
                                            if (have_rows('accomodation_codes', $postID)) :
                                                $selector = '?';
                                                $query = '';
                                                while (have_rows('accomodation_codes', $postID)) : the_row();
                                                    $key = get_sub_field('key');
                                                    $value = get_sub_field('value');
                                                    $query .= $selector . $key . '=' . $value;
                                                    $selector = '&';
                                                endwhile;
                                                ?>
                                                <a href="#/booking/step-1<?php echo $query; ?>"
                                                   class="button-ritz"><?php echo $booking_link_text; ?></a>
                                            <?php
                                            endif;
                                        };

                                        if($use_seven_rooms):
                                            if ($booking_options == 'Seven Rooms') {
                                                $seven_rooms_link = '';
                                                $slugs = explode('/', get_field('seven_rooms_link', $postID));
                                                $seven_rooms_link = end($slugs);
                                                if ($seven_rooms_link) {
                                                    ?>
                                                    <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                                       data-venueid="<?php echo $seven_rooms_link; ?>"><?php echo $booking_link_text; ?></a>
                                                    <?php
                                                }
                                            };

                                            if ($booking_options == 'Bookatable') {
                                                if (have_rows('dining_codes', $postID)) :
                                                    while (have_rows('dining_codes', $postID)) : the_row();
                                                        $bookatable_restaurant = get_sub_field('restaurantid');
                                                        if ($bookatable_restaurant == '108823') {
                                                            ?>
                                                            <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                                               data-venueid="theritzrestaurant"><?php echo $booking_link_text; ?></a>
                                                            <?php
                                                        }
                                                        if ($bookatable_restaurant == '108845') {
                                                            ?>
                                                            <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                                               data-venueid="ritzafternoontea"><?php echo $booking_link_text; ?></a>
                                                            <?php
                                                        }
                                                        if ($bookatable_restaurant == '460014') {
                                                            ?>
                                                            <a id="<?php echo uniqid(); ?>-sr-res-root" class="ritz-seven-rooms button-ritz"
                                                               data-venueid="ritzgarden"><?php echo $booking_link_text; ?></a>
                                                            <?php
                                                        }
                                                    endwhile;
                                                endif;
                                            };
                                        else:
                                            if ($booking_options == 'Bookatable') {
                                                if (have_rows('dining_codes', $postID)) :
                                                    $book_data = '';
                                                    $restaurantid = '';
                                                    while (have_rows('dining_codes', $postID)) : the_row();
                                                        $restaurantid = get_sub_field('restaurantid');
                                                        $book_data = ' data-bookatable data-connectionid="' . get_sub_field('connectionid') . '"';
                                                        $book_data .= ' data-restaurantid="' . get_sub_field('restaurantid') . '"';
                                                        $book_data .= ' data-basecolor="' . get_sub_field('basecolor') . '"';
                                                        $book_data .= ' data-promotionid="' . get_sub_field('promotionid') . '"';
                                                        $book_data .= ' data-sessionid="' . get_sub_field('sessionid') . '"';
                                                        $book_data .= ' data-conversionjs="' . get_sub_field('conversionjs') . '"';
                                                        $book_data .= ' data-gaaccountnumber="' . get_sub_field('gaaccountnumber') . '"';
                                                    endwhile;
                                                    if ($book_data != '') {
                                                        ?>
                                                        <!--<a href="#" <?php /*echo $book_data; */?>
                                                       class="button-ritz"><?php /*echo $booking_link_text; */?></a>-->
                                                        <?php
                                                        echo rid_to_quadranet_link($restaurantid, $booking_link_text);
                                                    }
                                                endif;
                                            };
                                        endif;



                                        if ($booking_options == 'Email') {

                                            if (have_rows('email_options', $postID)) :

                                                while (have_rows('email_options', $postID)) : the_row();
                                                    ?>
                                                    <a href="mailto:<?php the_sub_field('email_to_address'); ?>?subject=<?php the_sub_field('subject'); ?>&body=<?php the_sub_field('body'); ?>"
                                                       class="button-ritz"><?php echo $booking_link_text; ?></a>
                                                <?php
                                                endwhile;
                                            endif;
                                        };
                                        if ($booking_options == 'Page') {
                                            $page = get_field('page', $postID);
                                            ?>
                                            <a href="<?php echo esc_url($page); ?>"><?php echo $booking_link_text; ?></a>
                                            <?php
                                        };
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                        <a data-open="<?php echo $uniqueID; ?>">OPEN IMAGE</a>
                    </div>
                    <div class="caption">
                        <?php the_title(); ?>
                    </div>
                </div>
                <?php
                $x++;
                if ($x > 3) {
                    $x = 1;
                    $y++;
                }
                if ($y > 3) {
                    $y = 1;
                }
                if ($c == 1) {
                    $c_1 .= ob_get_clean();
                }
                if ($c == 2) {
                    $c_2 .= ob_get_clean();
                }
                if ($c == 3) {
                    $c_3 .= ob_get_clean();
                }
                $c++;
                if ($c > 3) {
                    $c = 1;
                }
                ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php
            $c_1 .= '</div>';
            $c_2 .= '</div>';
            $c_3 .= '</div>';
            echo $c_1;
            echo $c_2;
            echo $c_3;
            ?>
        </div>
    </div>
</div>


