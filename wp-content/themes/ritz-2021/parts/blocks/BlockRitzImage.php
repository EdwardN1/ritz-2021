<?php
/**
 * Block template file: /parts/blocks/BlockRitzImage.php
 *
 * Ritz Image Block Block Template.
 *
 * @var   array $block The block settings and attributes.
 * @var   string $content The block inner HTML (empty).
 * @var   bool $is_preview True during AJAX preview.
 * @var   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-image-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-image-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ( ( isset( $block['data']['ritz_image_block_preview_image_help'] ) ) && ( $is_preview ) ) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_image_block_preview_image_help'] . '" style="width:100%; height:auto;">';

    return;
endif;

?>

<style type="text/css">
    <?php echo '#' . $id; ?> {
    /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php $image = get_field( 'image' ); ?>
    <?php
    $image_link = '';
    $target        = '';
    if ( get_field( 'open_in_a_new_tab' ) == 1 ) {
        $target = ' target="_blank"';
    }
    $link_to = get_field( 'link_to' );
    $href = '';
    if ( $link_to == 'Page' ) {
        $href = get_field( 'page' );
    }
    if ( $link_to == 'Post' ) {
        $href = get_field( 'post' );
    }
    if ( $link_to == 'Text' ) {
        $href = get_field( 'text' );
    }
    if ( $link_to == 'URL' ) {
        $href = get_field( 'url' );
    }
    if ( $link_to == 'File' ) {
        $href   = get_field( 'file' );
        $target = ' target="_blank"';
    }
    if ( $link_to == 'Popup' ) {
        $popup_content = get_sub_field( 'popup' );
        $uniqueID      = uniqid();
        if ( ! $is_preview ):
            ?>
            <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                 data-reveal data-id="<?php echo $uniqueID; ?>">
                <div class="info-box">
                    <?php
                    $popup_content = get_sub_field( 'popup' );
                    if ( $popup_content == 'Entertainment' ) {
                        echo get_field( 'entertainment', 'option' );
                    }
                    if ( $popup_content == 'Palm Court Entertainment' ) {
                        echo get_field( 'palm_court_entertainment', 'option' );
                    }
                    if ( $popup_content == 'Dress Code' ) {
                        echo get_field( 'dress_code', 'option' );
                    }
                    if ( $popup_content == 'Restaurant Sittings' ) {
                        echo get_field( 'restaurant_sittings', 'option' );
                    }
                    if ( $popup_content == 'Restaurant Terrace Sittings' ) {
                        echo get_field( 'restaurant_terrace_sittings', 'option' );
                    }
                    if ( $popup_content == 'The Ritz Garden Sittings' ) {
                        echo get_field( 'the_ritz_garden_sittings', 'option' );
                    }
                    if ( $popup_content == 'Afternoon Tea Sittings' ) {
                        echo get_field( 'afternoon_tea_sittings', 'option' );
                    }
                    if ( $popup_content == 'Palm Court Sittings' ) {
                        echo get_field( 'palm_court_sittings', 'option' );
                    }
                    ?>
                </div>
                <span class="close-reveal-modal" data-close>&times;</span>
            </div>
        <?php
        endif;
        $image_link = '<a data-open="' . $uniqueID . '" class="image-link"></a>';
        $href        = '';
    }
    if ( $link_to == 'iFrame' ) {
        $iframe_link = get_field( 'iframe_link' );
        ?>
        <?php if ( ( $iframe_link != '' ) && ( ! $is_preview ) ):
            $uniqueID = uniqid(); ?>
            <div id="<?php echo $uniqueID; ?>" class="reveal-modal" data-reveal
                 data-id="<?php echo $uniqueID; ?>">
                <div class="virtual-tour">
                    <iframe src="<?php echo $iframe_link; ?>"
                            style="width: 100%; height: 60vh;"></iframe>
                </div>
                <span class="close-reveal-modal" data-close>&times;</span>
            </div>
        <?php endif;
        if ( $iframe_link != '' ) {
            $image_link = '<a data-open="' . $uniqueID . '" class="image-link mag-reveal iframe"></a>';
        }
    }
    if ( $href != '' ) {
        $ytpos = strpos( $href, 'https://youtu.be/' );
        if ( $ytpos === 0 ) {
            $url_array = parse_url( $href );
            $videoID   = '';
            if ( is_array( $url_array ) ) {
                if ( array_key_exists( 'path', $url_array ) ) {
                    $videoID  = trim( $url_array['path'], '/' );
                    $uniqueID = uniqid();
                    ?>
                    <?php if ( ! $is_preview ): ?>
                        <div id="<?php echo $uniqueID; ?>" class="reveal-modal"
                             data-reveal data-id="<?php echo $uniqueID; ?>"
                             data-ytvideoid="<?php echo $videoID; ?>">
                            <div class="flex-video widescreen">
                                <div id="feature-video-<?php echo $uniqueID; ?>">[this
                                    div will be converted to an iframe]
                                </div>
                            </div>
                            <span class="close-reveal-modal" data-close>&times;</span>
                        </div>
                    <?php endif; ?>
                    <?php
                    $image_link = '<a data-open="' . $uniqueID . '" data-ytvideoid="' . $videoID . '" class="image-link feature-modal-btn"' . $target . '></a>';
                } else {
                    $image_link = '<a href="' . esc_url( $href ) . '" class="image-link"' . $target . '></a>';
                }
            }
        } else {
            $image_link = '<a href="' . esc_url( $href ) . '" class="image-link"' . $target . '></a>';
        }
    }
    ?>

    <?php if ( $image ) : ?>
        <?php if ( get_field( 'add_mobile_image' ) == 1 ) : ?>
            <?php $mobile_image = get_field( 'mobile_image' ); ?>
            <?php if ( $mobile_image ) : ?>
                <div class="ritz-block-image show-for-medium" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">
                    <?php echo $image_link;?>
                </div>
                <div class="ritz-block-image hide-for-medium" style="background-image: url(<?php echo esc_url( $mobile_image['url'] ); ?>)">
                    <?php echo $image_link;?>
                </div>
            <?php else : ?>
                <div class="ritz-block-image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">
                    <?php echo $image_link;?>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <div class="ritz-block-image" style="background-image: url(<?php echo esc_url( $image['url'] ); ?>)">
                <?php echo $image_link;?>
            </div>
        <?php endif; ?>
    <?php endif; ?>





</div>
