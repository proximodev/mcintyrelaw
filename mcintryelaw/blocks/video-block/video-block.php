<?php
/**
* Block Name: Video Block
*/
include_once( get_theme_file_path("/inc/functions/get-youtube-id.php") );
include_once( get_theme_file_path("/inc/functions/get-image-properties.php") );

$youTubeID = "";
$youTubeURL = get_field('youtube_url');
$imageObject = get_field( 'image_object');
$imageSize = get_field( 'image_size');

$videoPosterImageAttributes = get_image_properties($imageObject, $imageSize);
$videoPosterImageSrc = isset($videoPosterImageAttributes['src']) ? esc_url($videoPosterImageAttributes['src']) : '';
$videoPosterImageAlt = isset($videoPosterImageAttributes['alt']) ? esc_attr($videoPosterImageAttributes['alt']) : '';
$videoPosterImageTitle = isset($videoPosterImageAttributes['title']) ? esc_attr($videoPosterImageAttributes['title']) : '';

$youTubeID = get_youtube_id_from_url($youTubeURL);

?>

<div class="s-media _overlay">
    <div class="s-media__inner _video" data-open-modal="modal-default" data-yt-src="https://www.youtube.com/embed/<?= $youTubeID; ?>?autoplay=1" onclick="handler(&quot;<?= $youTubeID; ?>&quot;)">
      <img src="<?= $videoPosterImageSrc; ?>" alt="<?= $videoPosterImageAlt; ?>" title="<?= $videoPosterImageTitle; ?>"/>
      <svg class="svg svg-play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#play"></use>
      </svg>
    </div>
</div>
