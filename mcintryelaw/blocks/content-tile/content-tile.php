<?php
/**
* Block Name: Content Tile
*/

$contentColumns = get_field("content_columns");
$includeDescription = get_field("include_description");
$includeDescriptionClass = "";

if ($includeDescription) {
    $includeDescriptionClass = "_include-description";
} 
?>

<section class="s-tiles">
    <?php if( have_rows('content_tiles') ): ?>
        <div class="s-tiles__list <?= $contentColumns; ?> <?= $includeDescriptionClass; ?>">
            <?php while( have_rows('content_tiles') ): the_row();
                $selectedPost = get_sub_field('page-post');
                if( $selectedPost ):

                    $contentImage = get_sub_field("content_image");
                    if ($contentImage) {
                        $contentImageURL = $contentImage['sizes']['one-quarter'];
                        $contentImageAlt = $contentImage['alt'];
                    } else {
                        $contentImage = get_post_thumbnail_id( $selectedPost->ID );
                        $contentImageURL = get_the_post_thumbnail_url($selectedPost->ID,'tiles');
                        $contentImageAlt = get_post_meta($contentImage, '_wp_attachment_image_alt', true);
                    }

                    $customTitle = get_sub_field("custom_title");
                    if ($customTitle) {
                        $contentTitle = $customTitle;
                    } else {
                        $contentTitle = esc_html( get_the_title( $selectedPost->ID ) );
                    }

                    if ($includeDescription) {
                        $contentDescription = get_sub_field("content_description");
                        if (!$contentDescription) {
                            $contentDescription = esc_html( get_the_excerpt( $selectedPost->ID ) );
                        }
                    }
                    ?>

                    <a class="s-tiles__item" href="<?php echo esc_url( get_permalink( $selectedPost->ID ) ); ?>">
                        <div class="s-tiles__item-inner">    
                            <?php if($contentImage): ?>
                            <img class="s-tiles__item-img" src="<?= $contentImageURL; ?>" alt="<?= $contentImageAlt; ?>"/>
                            <?php endif; ?>
                            <div class="s-tiles__item-hover">
                            </div>
                            <div class="s-tiles__item-info">
                                <h4 class="s-tiles__item-title"><?= $contentTitle; ?></h4>
                                <svg class="svg svg-b-angle-wr" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#b-angle-wr"></use>
                                </svg>
                            </div>
                        </div>
                        <?php if($includeDescription): ?>
                        <div class="s-tiles__item-description">
                            <?= $contentDescription; ?>
                        </div>
                        <?php endif; ?>
                    </a>

                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>No content selected.</p>
    <?php endif; ?>
</section>
