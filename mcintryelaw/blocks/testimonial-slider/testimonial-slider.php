<?php
/**
* Block Name: Testimonial Slider
*/
include( get_theme_file_path("/inc/functions/get-youtube-id.php") );
include( get_theme_file_path("/inc/functions/get-image-properties.php") );

$testimonialHeader = get_field( 'testimonial_header');
$testimonialDescription = get_field( 'testimonial_description');
$googleReviewScore = get_field( 'google_review_score');
?>

<section class="s-testimonials">
  <div class="s-testimonials__top">
    <div class="s-testimonials__info">
      <h2 class="s-testimonials__title"><?= $testimonialHeader; ?></h2>
      <p class="s-testimonials__text"><?= $testimonialDescription; ?></p>
    </div>
    <div class="s-testimonials__list">
      <h5 class="s-testimonials__item">
        <p class="s-testimonials__item-inner">Over <span class="_blue">90 years</span> of combined experience</p>
      </h5>
      <h5 class="s-testimonials__item">
        <p class="s-testimonials__item-inner"><span class="_blue"><?= $googleReviewScore; ?> </span>
          <span class="_orange">★★★★★</span> Google Reviews
        </p>
      </h5>
      <h5 class="s-testimonials__item">
        <p class="s-testimonials__item-inner">We work on a contingency fee basis. <span class="_blue">No fee unless we win.</span></p>
      </h5>
    </div>
  </div>

  <?php if( have_rows('testimonials') ): ?>
  <div class="sl-testimonials">
    <div class="sl-testimonials__list">
      <?php while( have_rows('testimonials') ): the_row();
        $videoPosterImage = get_sub_field('video_poster_image');
        $youTubeURL = get_sub_field('youtube_url');

        $youTubeID = get_youtube_id_from_url($youTubeURL);
        $videoPosterImageAttributes = get_image_properties($videoPosterImage, 'full-width');

        $videoPosterImageSrc = $videoPosterImageAttributes['src'];
        $videoPosterImageAlt = $videoPosterImageAttributes['alt'];
        $videoPosterImageTitle = $videoPosterImageAttributes['title'];
      ?>

      <?php if ($youTubeID): ?>
      <div class="sl-testimonials__item" data-open-modal="modal-default" onclick="handler(&quot;<?= $youTubeID; ?>&quot;)">
        <img class="sl-testimonials__img" src="<?= $videoPosterImageSrc; ?>" title="<?= $videoPosterImageTitle; ?>" alt="<?= $videoPosterImageAlt; ?>"/>
        <svg class="svg svg-play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#play"></use>
        </svg>
      </div>
      <?php else: ?>
      <p>Error: YouTube URL not found</p>
      <?php endif; ?>

      <?php endwhile; ?>
    </div>

    <div class="sl-testimonials__arrows">
      <div class="sl-testimonials__prev">
        <svg class="svg svg-b-angle-wl" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#b-angle-wl"></use>
        </svg>
      </div>
      <div class="sl-testimonials__next">
        <svg class="svg svg-b-angle-wr" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#b-angle-wr"></use>
        </svg>
      </div>
    </div>
  </div>
  <?php endif; ?>
</section>
