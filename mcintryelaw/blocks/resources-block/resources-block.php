<?php
/**
* Block Name: Resource Block
*/

$resourceBlockTitle = get_field( 'resource_block_title');
?>

<style>
.gb-container-54f50a14 {
    display: flex;
    align-items: flex-start;
    column-gap: 30px;
    row-gap: 0px;
    position: relative;
}
</style>

<section class="gb-container gb-container-e7b32892 resource-listing _rows">
   <div class="gb-container gb-container-b5abfc4e resource-listing-inner">
      <h3 class="wp-block-heading has-text-align-center"><?= $resourceBlockTitle; ?></h3>
      <div class="gb-grid-wrapper gb-query-loop-wrapper">

        <?php
        if( have_rows('resources') ):

            while( have_rows('resources') ) : the_row();

                $resourceObject = get_sub_field('resource_object');

                if ($resourceObject) {
                    $resourceID = $resourceObject->ID;
                    $resourceTitle = get_the_title($resourceID);
                    $resourceLink = get_permalink($resourceID);
                    $resourceImage = get_post_thumbnail_id($resourceID);
                    $resourceDescription = get_sub_field('resource_description');

                    if (!$resourceDescription) {
                        $resourceDescription = get_the_excerpt($resourceID);
                    }

                    if ($resourceImage) {
                        $resourceImageSrc = wp_get_attachment_url($resourceImage,'medium');
                        $resourceImageAlt = get_post_meta($resourceImage, '_wp_attachment_image_alt', true);
                    } else {
                        $resourceImageSrc = "https://placehold.co/300x300";
                        $resourceImageAlt = $resourceTitle;
                    }

                }
                ?>

                <div class="gb-container resource-item gb-container-54f50a14 ">
                   <a class="gb-container-link" href="<?= $resourceLink; ?>"></a>
                   <div class="gb-container gb-container-2d716dbb resource-image-wrapper">
                        <figure class="gb-block-image gb-block-image-71ae1c8f">
                            <img fetchpriority="high" decoding="async" width="300" height="188"
                            src="<?= $resourceImageSrc; ?>"
                            class="gb-image-71ae1c8f"
                            alt="<?= $resourceImageAlt; ?>">
                        </figure>
                   </div>
                   <div class="gb-container gb-container-048216da resource-text-wrapper">
                      <h4 class="gb-headline gb-headline-3d830c59 gb-headline-text">
                        <a href="<?= $resourceLink; ?>">
                            <?= $resourceTitle; ?>
                        </a>
                      </h4>
                      <div class="gb-headline gb-headline-e47adb7c gb-headline-text">
                        <?= $resourceDescription; ?>
                      </div>
                   </div>
                </div>

                <?php
            endwhile;
        endif;
        ?>

      </div>
   </div>
</section>