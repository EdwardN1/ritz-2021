<?php
global $archive_side;
?>
<?php if($archive_side=='left'): ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="article">
    <div class="grid-container">
	<div class="block-ritz-underlined-title-block"><?php the_date('d-m-Y', '', ''); ?></div>
        <div class="block-ritz-two-column-experience-block">
            <div class="grid-x">
                <div class="cell large-6 medium-6 small-12" style="padding-right: 2em;">
                    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	                <?php the_content('<a class="button-underlined" href="'.get_the_permalink().'">' . __( 'Read more', 'jointswp' ) . '</a>'); ?>

                </div>
                <div class="cell large-6 medium-6 small-12">
                    <div class="image" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'full');?>);">

                    </div>

                </div>
            </div>
        </div>
    </div>
</article>
<?php else:?>
    <article id="post-<?php the_ID(); ?>" <?php post_class( '' ); ?> role="article">
        <div class="grid-container">
            <div class="block-ritz-underlined-title-block"><?php the_date('d-m-Y', '', ''); ?></div>
            <div class="block-ritz-two-column-experience-block">
                <div class="grid-x">
                    <div class="cell large-6 medium-6 small-12">
                        <div class="image" style="background-image: url(<?php echo get_the_post_thumbnail_url(get_the_ID(),'full');?>);">

                        </div>

                    </div>
                    <div class="cell large-6 medium-6 small-12" style="padding-left: 2em;">
                        <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
	                    <?php the_content('<a class="button-underlined" href="'.get_the_permalink().'">' . __( 'Read more', 'jointswp' ) . '</a>'); ?>

                    </div>
                </div>
            </div>
        </div>
    </article>

<?php endif;?>
