<?php
/**
* Block Name: Video Block
*/
include_once( get_theme_file_path("/inc/functions/get-make-your-case-video-embed.php") );
$videoID = get_field('video_id');
$videoEmbed = get_make_your_case_video_embed($videoID);
?>

<div class="s-media _overlay">
    <div class="responsive-iframe-wrapper">
        <?= $videoEmbed; ?>
    </div>
</div>
