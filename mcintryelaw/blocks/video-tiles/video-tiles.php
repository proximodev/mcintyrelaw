<?php
/**
 * Block Name: Video Block
 */
include_once( get_theme_file_path("/inc/functions/get-youtube-id.php") );
include_once( get_theme_file_path("/inc/functions/get-image-properties.php") );
include_once( get_theme_file_path("/inc/functions/get-youtube-title.php") );

$videoCount = 0;
$additionalClass = "";
$viewAllClass = "";
$tileLayoutClass = " three-col"; // Default class
$tileStyleClass = " light-blue-bg"; // Default class

$tileHeader = get_field('tile_header');

if (!empty($block['className'])) {
    $additionalClass .= ' ' . esc_attr($block['className']);
}

$tileLayout = get_field('tile_layout');
if (!empty($tileLayout)) {
    $tileLayoutClass = " " . esc_attr($tileLayout);
}

$tileStyle = get_field('tile_style');
if (!empty($tileStyle)) {
    $tileStyleClass = " " . esc_attr($tileStyle);
}

if ($tileLayout == "three-col") {
    $hideViewMoreButton = false;
} else {
    $hideViewMoreButton = true;
}


if ($hideViewMoreButton) {
    $viewAllClass = " view-all";
}

$getImagesFromYoutube = get_field('get_images_from_youtube');
$getTitlesFromYoutube = get_field('get_titles_from_youtube');
?>

<section class="s-videos<?= esc_attr($tileStyleClass . $additionalClass); ?>">
  <div class="container">

    <?php if (!empty($tileHeader)): ?>
      <h2 class="s-videos__title"><?= $tileHeader; ?></h2>
    <?php endif; ?>

    <div class="s-videos__list-wrapper<?= esc_attr($viewAllClass); ?>">
      <div class="s-videos__list<?= esc_attr($tileLayoutClass); ?>">

        <?php if (have_rows('video_tiles')): ?>
          <?php while (have_rows('video_tiles')): the_row();
            $videoCount++;
            $youTubeID = "";
            $youTubeURL = get_sub_field('youtube_url') ?: '';
            $youTubeID = !empty($youTubeURL) ? get_youtube_id_from_url($youTubeURL) : '';

            $videoTitle = "";
            if ($getTitlesFromYoutube && !empty($youTubeID)) {
                $videoTitle = getYoutubeVideoTitle($youTubeID) ?: '';
            } else {
                $videoTitle = get_sub_field('video_title') ?: '';
            }

            $videoPosterImageSrc = "";
            $videoPosterImageAlt = esc_attr($videoTitle);
            $videoPosterImageTitle = esc_attr($videoTitle);

            if ($getImagesFromYoutube && !empty($youTubeID)) {
                $videoPosterImageSrc = "https://i.ytimg.com/vi/" . esc_attr($youTubeID) . "/sddefault.jpg";
            } else {
                $imageObject = get_sub_field('image_object');
                $videoPosterImageAttributes = (!empty($imageObject)) ? get_image_properties($imageObject, "tiles") : [];

                $videoPosterImageSrc = isset($videoPosterImageAttributes['src']) ? esc_url($videoPosterImageAttributes['src']) : '';
                $videoPosterImageAlt = isset($videoPosterImageAttributes['alt']) ? esc_attr($videoPosterImageAttributes['alt']) : esc_attr($videoTitle);
                $videoPosterImageTitle = isset($videoPosterImageAttributes['title']) ? esc_attr($videoPosterImageAttributes['title']) : esc_attr($videoTitle);
            }
            ?>

            <div class="s-videos__item">
              <div class="s-videos__item-inner">
                <div class="s-media _overlay">
                  <div class="s-media__inner _video"
                       data-open-modal="modal-default"
                       data-yt-src="https://www.youtube.com/embed/<?= esc_attr($youTubeID); ?>?autoplay=1"
                       onclick="handler('<?= esc_js($youTubeID); ?>')">
                    <img src="<?= esc_url($videoPosterImageSrc); ?>"
                         alt="<?= esc_attr($videoPosterImageAlt); ?>"
                         title="<?= esc_attr($videoPosterImageTitle); ?>" />
                    <svg class="svg svg-play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <use xlink:href="<?= esc_url(get_stylesheet_directory_uri() . '/assets/images/_set.svg#play'); ?>"></use>
                    </svg>
                  </div>
                </div>
                <div class="s-videos__item-info">
                  <h5 class="s-videos__item-title"><?= esc_html($videoTitle); ?></h5>
                </div>
              </div>
            </div>

          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>

    <?php if (($videoCount > 3) && (!$hideViewMoreButton)): ?>
      <div class="s-videos__btn-wrapper">
        <div class="gb-button js-more">View more</div>
      </div>
    <?php endif; ?>

  </div>
</section>
