<?php
/**
* Block Name: Media Block
* _rounded
*/

$mediaType = get_field( 'media_type');
$roundedBorders = get_field( 'rounded_borders');
$roundedClass = "";
$loomSrc = "";
if ($roundedBorders) {
    $roundedClass = "_rounded";
}

if ($mediaType=="image") {
    $imageSource = get_field( 'image_source');
} else {

    $imageSource = get_field( 'poster_image');
    if(!( $imageSource ) ) {
        $imageSource = get_field( 'image_source');
    }

    if ($mediaType == "youtube") {

        // Get the Youtube ID
        $youTubeEmbed = get_field( 'youtube_url');
        if ($youTubeEmbed) {
            preg_match('/src="(.+?)"/', $youTubeEmbed, $matches_url );
            $src = $matches_url[1];
            preg_match('/embed(.*?)?feature/', $src, $matches_id );
            $youtubeID = $matches_id[1];
            $youtubeID = str_replace( str_split( '?/' ), '', $youtubeID );
            //echo 'youtubeID:' . $youtubeID;
        } else {
            $youtubeID = "";
        }

    } elseif ($mediaType == "loom") {

        // Get Loom Embed URL
        $loomEmbed = get_field( 'loom_embed');
        if ($loomEmbed) {
            // Remove special characters
            $loomEmbed = iconv('UTF-8', 'ASCII//TRANSLIT', $loomEmbed);
            // Use preg_match to find iframe src.
            preg_match('/src="(.+?)"/', $loomEmbed, $matches_url);
            $loomSrc = $matches_url[1];

} else {
             $loomSrc = "";
         }

    }

}

/** Get the image or poster image **/
if( !empty( $imageSource ) ):
    $imgSrc = $imageSource['sizes']['full-width'];
    $imgAlt = esc_attr($imageSource['alt']);
    $imgTitle = esc_attr($imageSource['title']);
else:
    $imgSrc = get_stylesheet_directory_uri() . "/assets/images/placeholder-1080x720.png";
    $imgAlt = "Placeholder Alt";
    $imgTitle = "Placeholder Title";
endif;

?>

<?php if ($mediaType=="youtube" && ($youtubeID)): ?>

<div class="s-media _overlay">
    <div class="s-media__inner _video <?= $roundedClass ?>" data-open-modal="modal-default" data-yt-src="https://www.youtube.com/embed/<?= $youtubeID; ?>?autoplay=1" onclick="handler(&quot;<?= $youtubeID; ?>&quot;)">
      <img src="<?= $imgSrc; ?>" alt="<?= $imgAlt; ?>"/>
      <svg class="svg svg-play-green" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#play-green"></use>
      </svg>
    </div>
</div>

<?php elseif ($mediaType=="loom" && ($loomSrc)): ?>

<div class="s-media _overlay">
    <div class="s-media__inner _video <?= $roundedClass ?>" data-open-modal="modal-default" data-src="<?= $loomSrc; ?>&autoplay=1&amp;hide_owner=true&amp;hide_share=true&amp;hide_title=true&amp;hideEmbedTopBar=true">
      <img src="<?= $imgSrc; ?>" alt="<?= $imgAlt; ?>"/>
      <svg class="svg svg-play-green" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#play-green"></use>
      </svg>
    </div>
</div>

<?php elseif ($mediaType=="image"): ?>

<div class="s-media">
    <div class="s-media__inner _image <?= $roundedClass ?>" data-open-modal="modal-default" data-img-src="<?= $imgSrc; ?>">
      <img src="<?= $imgSrc; ?>" alt="<?= $imgAlt; ?>"/>
    </div>
</div>

<?php else: ?>

<div class="s-media">
    <div class="s-media__inner <?= $roundedClass ?>" data-open-modal="modal-default" data-img-src="<?= $imgSrc; ?>">
      <p>No Media Selected: <?= $mediaType; ?></p>
    </div>
</div>

<?php endif; ?>