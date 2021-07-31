<?php
/**
 * Block template file: /parts/blocks/BlockRitzPageContentWithSidebar.php
 *
 * Ritz Page Content With Sidebar Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'ritz-page-content-with-sidebar-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-ritz-page-content-with-sidebar-block';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<?php
if ((isset($block['data']['ritz_page_content_with_sidebar_block_preview_image_help'])) && ($is_preview)) :    /* rendering in inserter preview  */

    echo '<img src="' . $block['data']['ritz_page_content_with_sidebar_block_preview_image_help'] . '" style="width:100%; height:auto;">';
    return;
endif;

?>

<style type="text/css">
    <?php echo '#' . $id; ?> {
    /* Add styles that use ACF values here */
    }
</style>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
    <?php the_field( 'content' ); ?>
    <?php if ( have_rows( 'sidebar' ) ) : ?>
        <?php while ( have_rows( 'sidebar' ) ) : the_row(); ?>
            <?php the_sub_field( 'heading' ); ?>
            <?php if ( have_rows( 'bullets' ) ) : ?>
                <?php while ( have_rows( 'bullets' ) ) : the_row(); ?>
                    <?php the_sub_field( 'bullet_text' ); ?>
                    <?php the_sub_field( 'link_to' ); ?>
                    <?php if ( get_sub_field( 'open_in_a_new_tab' ) == 1 ) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php $page = get_sub_field( 'page' ); ?>
                    <?php if ( $page ) : ?>
                        <a href="<?php echo esc_url( $page); ?>"><?php echo esc_html( $page ); ?></a>
                    <?php endif; ?>
                    <?php $post = get_sub_field( 'post' ); ?>
                    <?php if ( $post ) : ?>
                        <a href="<?php echo esc_url( $post); ?>"><?php echo esc_html( $post ); ?></a>
                    <?php endif; ?>
                    <?php the_sub_field( 'text' ); ?>
                    <?php the_sub_field( 'url' ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
            <?php if ( have_rows( 'buttons' ) ) : ?>
                <?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                    <?php the_sub_field( 'link_to' ); ?>
                    <?php the_sub_field( 'title' ); ?>
                    <?php if ( get_sub_field( 'open_in_a_new_tab' ) == 1 ) : ?>
                        <?php // echo 'true'; ?>
                    <?php else : ?>
                        <?php // echo 'false'; ?>
                    <?php endif; ?>
                    <?php $page = get_sub_field( 'page' ); ?>
                    <?php if ( $page ) : ?>
                        <a href="<?php echo esc_url( $page); ?>"><?php echo esc_html( $page ); ?></a>
                    <?php endif; ?>
                    <?php $post = get_sub_field( 'post' ); ?>
                    <?php if ( $post ) : ?>
                        <a href="<?php echo esc_url( $post); ?>"><?php echo esc_html( $post ); ?></a>
                    <?php endif; ?>
                    <?php the_sub_field( 'text' ); ?>
                    <?php the_sub_field( 'url' ); ?>
                <?php endwhile; ?>
            <?php else : ?>
                <?php // no rows found ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>