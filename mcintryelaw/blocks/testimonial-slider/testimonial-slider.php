<?php
/**
* Block Name: Testimonial Slider
*/
include_once( get_theme_file_path("/inc/functions/get-youtube-id.php") );
include_once( get_theme_file_path("/inc/functions/get-image-properties.php") );

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
      <div class="s-testimonials__item">
        <p class="s-testimonials__item-inner">Over <span class="_blue">90 years</span> of combined experience</p>
      </div>
      <div class="s-testimonials__item">
        <p class="s-testimonials__item-inner"><span class="_blue"><?= esc_html($googleReviewScore ?: '5.0'); ?></span>
          <span class="_orange">★★★★★</span> Google Reviews
        </p>
      </div>
      <div class="s-testimonials__item">
        <p class="s-testimonials__item-inner">We work on a contingency fee basis. <span class="_blue">No fee unless we win.</span></p>
      </div>
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

        $videoPosterImageSrc = isset($videoPosterImageAttributes['src']) ? esc_url($videoPosterImageAttributes['src']) : '';
        $videoPosterImageAlt = isset($videoPosterImageAttributes['alt']) ? esc_attr($videoPosterImageAttributes['alt']) : '';
        $videoPosterImageTitle = isset($videoPosterImageAttributes['title']) ? esc_attr($videoPosterImageAttributes['title']) : '';
        ?>
        <?php if ($youTubeID): ?>
        <div class="sl-testimonials__item" data-open-modal="modal-default" onclick="handler(&quot;<?= $youTubeID; ?>&quot;)">
          <img class="sl-testimonials__img" src="<?= $videoPosterImageSrc; ?>" title="<?= $videoPosterImageTitle; ?>" alt="<?= $videoPosterImageAlt; ?>"/>
          <svg class="svg svg-play" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#play"></use>
          </svg>
        </div>
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
