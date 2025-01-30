<?php
/**
* Block Name: Video Block
*/
include_once( get_theme_file_path("/inc/functions/get-youtube-id.php") );
include_once( get_theme_file_path("/inc/functions/get-image-properties.php") );
include_once( get_theme_file_path("/inc/functions/get-youtube-title.php") );

$additionalClass = "";
$getImagesFromYoutube = get_field('get_images_from_youtube');
$getTitlesFromYoutube = get_field('get_titles_from_youtube');
$displayFeaturedVideo = get_field('display_featured_video');
$tileHeader = get_field('tile_header');
$videoCount = 0;

if( !empty($block['className']) ) {
    $additionalClass .= ' ' . $block['className'];
}
?>

<section class="s-videos<?= $additionalClass; ?>">
  <div class="container">

    <?php if($tileHeader): ?>
    <h2 class="s-videos__title"><?= $tileHeader; ?></h2>
    <?php endif; ?>

    <div class="s-videos__list-wrapper">
      <div class="s-videos__list">

        <?php if( have_rows('video_tiles') ): ?>
          <?php while( have_rows('video_tiles') ): the_row();
            $videoCount = $videoCount + 1;
            $youTubeID = "";
            $youTubeURL = get_sub_field('youtube_url');
            $youTubeID = get_youtube_id_from_url($youTubeURL);

            if ($getTitlesFromYoutube) {
                $videoTitle = getYoutubeVideoTitle($youTubeID);
            } else {
                $videoTitle = get_sub_field('video_title');
            }

            if ($getImagesFromYoutube) {
                $videoPosterImageSrc = "https://i.ytimg.com/vi/" . $youTubeID . "/sddefault.jpg";
                $videoPosterImageAlt = $videoTitle;
                $videoPosterImageTitle = $videoTitle;
            } else {
                $imageObject = get_sub_field( 'image_object');
                $videoPosterImageAttributes = get_image_properties($imageObject, "tiles");
                $videoPosterImageSrc = isset($videoPosterImageAttributes['src']) ? esc_url($videoPosterImageAttributes['src']) : '';
                $videoPosterImageAlt = isset($videoPosterImageAttributes['alt']) ? esc_attr($videoPosterImageAttributes['alt']) : '';
                $videoPosterImageTitle = isset($videoPosterImageAttributes['title']) ? esc_attr($videoPosterImageAttributes['title']) : '';
            }
            ?>

            <div class="s-videos__item">
              <div class="s-videos__item-inner">
                <div class="s-media _overlay">
                    <div class="s-media__inner _video" data-open-modal="modal-default" data-yt-src="https://www.youtube.com/embed/<?= $youTubeID; ?>?autoplay=1" onclick="handler(&quot;<?= $youTubeID; ?>&quot;)">
                      <img src="<?= $videoPosterImageSrc; ?>" alt="<?= $videoPosterImageAlt; ?>" title="<?= $videoPosterImageTitle; ?>"/>
                      <svg class="svg svg-play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#play"></use>
                      </svg>
                    </div>
                </div>
                <div class="s-videos__item-info">
                  <h5 class="s-videos__item-title"><?= $videoTitle; ?></h5>
                </div>
              </div>
            </div>

          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($videoCount > 3): ?>
    <div class="s-videos__btn-wrapper">
      <div class="gb-button js-more">View more</div>
    </div>
    <?php endif; ?>

  </div>
</section>
