<?php
/**
 * Block template file: /parts/blocks/BlockRitzOffers.php
 *
 * Ritz Offers Block Block Template.
 *
 * @param string $content The block inner HTML (empty).
 * @param   (int|string) $post_id The post ID this block is saved to.
 *
 * @var   bool $is_preview True during AJAX preview.
 * @var   array $block The block settings and attributes.
 */

global $use_seven_rooms;

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-offers-block-' . $block['id'];
if (!empty($block['anchor'])) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-offers-block';
if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_offers_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_offers_block_preview_image_help'] . '" style="width:100%; height:auto;">';

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
    <?php $include_category_filter = get_field('include_category_filter'); ?>
    <?php $selection_type = get_field('selection_type'); ?>
    <?php
    $termIDS = array();
    $offersGrid = '';
    if ($selection_type == 'Selected Offers') {
        if (have_rows('selected_offers')) :
            ob_start();
            while (have_rows('selected_offers')) :
                the_row();
                $offer = get_sub_field('offer');
                if ($offer) :
                    $post = $offer;
                    setup_postdata($post);
                    $categoryID = get_field('categories', $post->ID);
                    $term = get_term_by('id', $categoryID, 'offercategory');
                    $termClass = '';
                    if ($term) :
                        $termClass = ' ' . seoUrl(esc_html($term->name));
                        if (!in_array($categoryID, $termIDS)) {
                            $termIDS[] = $categoryID;
                        }
                    endif;
                    ?>
                    <?php $image = get_field('image', $post->ID); ?>
                    <?php $page = get_field('page', $post->ID); ?>
                    <div class="cell large-4 medium-6 small-12<?php echo $termClass; ?>">
                        <div class="image" style="background-image: url(<?php echo esc_url($image['url']); ?>)">
                            <?php if ($page) : ?>
                                <a href="<?php echo esc_url($page); ?>" class="image-link"></a>
                            <?php endif; ?>
                        </div>
                        <div class="heading"><?php echo get_the_title($post->ID); ?></div>
                        <div class="description"><?php the_field('description', $post->ID); ?></div>
                        <div class="buttons-row">
                            <div class="grid-x grid-padding-x">
                                <div class="cell auto text-right">
                                    <?php if ($page) : ?>
                                        <a href="<?php echo esc_url($page); ?>"
                                           class="button-underlined long"><?php the_field('page_link_text', $post->ID); ?></a>
                                    <?php endif; ?>
                                </div>
                                <div class="cell auto text-left">
                                    <?php
                                    $booking_options = get_field('booking_type', $post->ID);
                                    $booking_link_text = get_field('booking_link_text', $post->ID);
                                    if ($booking_options == 'AZDS') {
                                        if (have_rows('azds', $post->ID)) :
                                            $selector = '?';
                                            $query = '';
                                            while (have_rows('azds', $post->ID)) : the_row();
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

                                    if ($use_seven_rooms):
                                        if ($booking_options == 'Seven Rooms') {
                                            $seven_rooms_link = '';
                                            $slugs = explode('/', get_field('seven_rooms_link',$post->ID));
                                            $seven_rooms_link = end($slugs);
                                            if ($seven_rooms_link) {
                                                ?>
                                                <a id="<?php echo uniqid(); ?>-sr-res-root"
                                                   class="ritz-seven-rooms button-ritz"
                                                   data-venueid="<?php echo $seven_rooms_link; ?>"><?php echo $booking_link_text; ?></a>
                                                <?php
                                            }
                                        }

                                        if ( $booking_options == 'URL' ) {
                                            $url = get_field( 'book_url',$post->ID );
                                            ?>
                                            <a href="<?php echo esc_url( $url ); ?>"
                                               class="button-ritz" target="_blank"><?php echo $booking_link_text; ?></a>
                                            <?php
                                        }

                                        if ($booking_options == 'Bookatable') {
                                            if (have_rows('bookatable', $post->ID)) :
                                                while (have_rows('bookatable', $post->ID)) :
                                                    the_row();
                                                    $bookatable_restaurant = get_sub_field('restaurantid');
                                                    if ($bookatable_restaurant == '108823') {
                                                        ?>
                                                        <a id="<?php echo uniqid(); ?>-sr-res-root"
                                                           class="ritz-seven-rooms button-ritz"
                                                           data-venueid="theritzrestaurant"><?php echo $booking_link_text; ?></a>
                                                        <?php
                                                    }
                                                    if ($bookatable_restaurant == '108845') {
                                                        ?>
                                                        <a id="<?php echo uniqid(); ?>-sr-res-root"
                                                           class="ritz-seven-rooms button-ritz"
                                                           data-venueid="ritzafternoontea"><?php echo $booking_link_text; ?></a>
                                                        <?php
                                                    }
                                                    if ($bookatable_restaurant == '460014') {
                                                        ?>
                                                        <a id="<?php echo uniqid(); ?>-sr-res-root"
                                                           class="ritz-seven-rooms button-ritz"
                                                           data-venueid="ritzgarden"><?php echo $booking_link_text; ?></a>
                                                        <?php
                                                    }
                                                endwhile;
                                            endif;
                                        };
                                    else:
                                        if ($booking_options == 'Bookatable') {
                                            if (have_rows('bookatable', $post->ID)) :
                                                $book_data = '';
                                                $restaurantid = '';
                                                while (have_rows('bookatable', $post->ID)) : the_row();
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
                                                    <!--<a href="#" <?php /*echo $book_data; */ ?>
                                                   class="button-ritz"><?php /*echo $booking_link_text; */ ?></a>-->
                                                    <?php echo rid_to_quadranet_link($restaurantid, $booking_link_text); ?>
                                                    <?php
                                                }
                                            endif;
                                        };

                                        if ( $booking_options == 'URL' ) {
                                            $url = get_field( 'book_url',$post->ID );
                                            ?>
                                            <a href="<?php echo esc_url( $url ); ?>"
                                               class="button-ritz" target="_blank"><?php echo $booking_link_text; ?></a>
                                            <?php
                                        }
                                    endif;


                                    if ($booking_options == 'Email') {
                                        ?>
                                        <a href="mailto:<?php echo get_field('email_address', $post->ID); ?>"
                                           class="button-ritz"><?php echo $booking_link_text; ?></a>
                                        <?php
                                    }


                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    wp_reset_postdata();
                endif;
            endwhile;
            $offersGrid = ob_get_clean();
            if ($include_category_filter) {
                if ($termIDS) {
                    ?>
                    <div class="filter-row">
                        <div class="grid-x grid-padding-x">
                            <div class="cell auto show-for-medium"></div>
                            <div class="cell large-shrink medium-shrink small-12">
                                <a class="button-filter selected small" data-filter-class="all">All</a>
                            </div>
                            <?php
                            foreach ($termIDS as $term_ID) {
                                $term = get_term_by('id', $term_ID, 'offercategory');
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
                            }
                            ?>
                            <div class="cell auto show-for-medium"></div>
                        </div>
                    </div>
                    <?php
                }
            }
            echo '<div class="offers-grid"><div class="grid-x grid-margin-x grid-margin-y">' . $offersGrid . '</div></div>';
        endif;
    } else {

    }
    ?>

</div>