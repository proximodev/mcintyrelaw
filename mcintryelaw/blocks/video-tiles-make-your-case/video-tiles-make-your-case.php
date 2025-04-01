<?php
/**
 * Block Name: Video Block (Make Your Case)
 */
include_once( get_theme_file_path("/inc/functions/get-make-your-case-video-embed.php") );

$videoCount = 0;
$tileLayoutClass = " three-col"; // Default class
$tileStyleClass = " light-blue-bg"; // Default class
$video_tiles = get_field('video_tiles');

if (!empty($video_tiles) && is_array($video_tiles)) {
    $first_row = $video_tiles[0];
    $videoID = $first_row['video_id'];
    $videoTitle = $first_row['video_title'];

    $videoEmbed = get_make_your_case_video_embed($videoID);
    ?>

    <section class="gb-container gb-container-fc554309 s-video light-blue-bg">
       <div class="gb-container gb-container-5b8bde73 container">
          <?php if ($videoTitle): ?>
          <h2 class="wp-block-heading has-text-align-center"><?= $videoTitle; ?></h2>
          <?php endif; ?>
          <div class="s-media _overlay">
             <div class="responsive-iframe-wrapper">
                <?= $videoEmbed; ?>
             </div>
          </div>
       </div>
    </section>

    <?php
    }
?>

<section class="s-videos<?= esc_attr($tileStyleClass); ?>">
  <div class="container">

    <h2 class="s-videos__title">Up Next</h2>

    <div class="s-videos__list-wrapper">
      <div class="s-videos__list<?= esc_attr($tileLayoutClass); ?>">

        <?php if (have_rows('video_tiles')): ?>
          <?php while (have_rows('video_tiles')): the_row();
            $videoCount++;
            $videoID = "";
            $videoID = get_sub_field('video_id') ?: '';

            $videoTitle = "";
            $videoTitle = get_sub_field('video_title') ?: '';
            $videoEmbed = get_make_your_case_video_embed($videoID);
            ?>

            <?php if ($videoCount > 1): ?>
            <div class="s-videos__item">
              <div class="s-videos__item-inner">
                <div class="s-media _overlay">
                  <div class="responsive-iframe-wrapper">
                    <?= $videoEmbed; ?>
                  </div>
                </div>
                <div class="s-videos__item-info">
                  <h5 class="s-videos__item-title"><?= esc_html($videoTitle); ?></h5>
                </div>
              </div>
            </div>
            <?php endif; ?>

          <?php endwhile; ?>
        <?php endif; ?>
      </div>
    </div>

    <?php if (($videoCount > 4)): ?>
      <div class="s-videos__btn-wrapper">
        <div class="gb-button js-more">View more</div>
      </div>
    <?php endif; ?>

  </div>
</section>
