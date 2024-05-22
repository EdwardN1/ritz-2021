<div id="ritz-main-video">
    <?php
    $presto_video_number = get_field('presto_player_video_number');
    if($presto_video_number) {
        echo do_shortcode('[presto_player id='.get_field('presto_player_video_number').']');
    }
    ?>
</div>
