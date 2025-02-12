<?php
/**
* Block Name: Video Block
*/
include_once( get_theme_file_path("/inc/functions/get-youtube-id.php") );
include_once( get_theme_file_path("/inc/functions/get-image-properties.php") );
include_once( get_theme_file_path("/inc/functions/get-youtube-title.php") );

$youTubeID = "";
$youTubeURL = get_field('youtube_url');
$imageObject = get_field( 'image_object');
$imageSize = get_field( 'image_size');
$getImageFromYoutube = get_field('get_image_from_youtube');

$youTubeID = get_youtube_id_from_url($youTubeURL);
$videoTitle = getYoutubeVideoTitle($youTubeID);

if ($getImageFromYoutube) {
    if ($imageSize == "full-width") {
        $imageSize = "maxresdefault.jpg";
    } else {
        $imageSize = "hqdefault.jpg";
    }
    $videoPosterImageSrc = "https://img.youtube.com/vi/" . $youTubeID . "/" . $imageSize;
    $videoPosterImageAlt = $videoTitle;
    $videoPosterImageTitle = $videoTitle;

} else {
    if ($imageSize == "full") { $imageSize = "full-width"; }

    $imageObject = get_sub_field( 'image_object');
    $videoPosterImageAttributes = get_image_properties($imageObject, "tiles");
    $videoPosterImageSrc = isset($videoPosterImageAttributes['src']) ? esc_url($videoPosterImageAttributes['src']) : '';
    $videoPosterImageAlt = isset($videoPosterImageAttributes['alt']) ? esc_attr($videoPosterImageAttributes['alt']) : '';
    $videoPosterImageTitle = isset($videoPosterImageAttributes['title']) ? esc_attr($videoPosterImageAttributes['title']) : '';
}
?>

<div class="s-media _overlay">
    <div class="s-media__inner _video" data-open-modal="modal-default" data-yt-src="https://www.youtube.com/embed/<?= $youTubeID; ?>?autoplay=1" onclick="handler(&quot;<?= $youTubeID; ?>&quot;)">
      <img src="<?= $videoPosterImageSrc; ?>" alt="<?= $videoPosterImageAlt; ?>" title="<?= $videoPosterImageTitle; ?>"/>
      <svg class="svg svg-play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#play"></use>
      </svg>
    </div>
</div>
