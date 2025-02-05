<?php
/**
* Block Name: Gallery Block
*/
include_once( get_theme_file_path("/inc/functions/get-image-properties.php") );

$themeURI = get_stylesheet_directory_uri();
$galleryHeader = get_field( 'gallery_header');
$galleryDescription = get_field( 'gallery_description');
$galleryImages = get_field('gallery_images');

?>

<section class="sl-gallery is-style-full-width">
  <div class="sl-gallery__wrapper">
    <?php if($galleryHeader): ?>
    <h2 class="sl-gallery__title"><?= $galleryHeader; ?></h2>
    <?php endif; ?>
    <?php if($galleryDescription): ?>
    <p class="sl-gallery__text"><?= $galleryDescription; ?></p>
    <?php endif; ?>

    <div class="sl-gallery__inner">
      <div class="sl-gallery__prev">
        <svg class="svg svg-b-angle-rl" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <use xlink:href="<?= $themeURI; ?>/assets/images/_set.svg#b-angle-rl"></use>
        </svg>
      </div>

      <?php if( $galleryImages ): ?>
      <div class="sl-gallery__list">

        <?php foreach( $galleryImages as $galleryImage ):

            $galleryImageAttributes = get_image_properties($galleryImage, "full-width");
            $galleryImageSrc = isset($galleryImageAttributes['src']) ? esc_url($galleryImageAttributes['src']) : '';
            $galleryImageAlt = isset($galleryImageAttributes['alt']) ? esc_attr($galleryImageAttributes['alt']) : '';
            $galleryImageTitle = isset($galleryImageAttributes['title']) ? esc_attr($galleryImageAttributes['title']) : '';
            ?>

            <div class="sl-gallery__item">
              <div class="sl-gallery__item-inner">
                <img class="sl-gallery__img" src="<?= $galleryImageSrc; ?>" alt="<?= $galleryImageAlt; ?>" title="<?= $galleryImageTitle; ?>"/>
              </div>
            </div>

        <?php endforeach; ?>
      </div>
      <?php else: ?>
          <p>No images are assigned to this gallery.</p>
      <?php endif; ?>

      <div class="sl-gallery__next">
        <svg class="svg svg-b-angle-rr" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <use xlink:href="<?= $themeURI; ?>/assets/images/_set.svg#b-angle-rr"></use>
        </svg>
      </div>
    </div>
  </div>
</section>