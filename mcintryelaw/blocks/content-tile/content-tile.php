<?php
/**
* Block Name: Content Tile
*/

$contentColumns = get_field("content_columns");
$includeDescription = get_field("include_description");
$contentTitleSize = get_field( 'content_title_size');
$tileSource = get_field( 'tile_source');

$includeDescriptionClass = "";
if (!$contentTitleSize) { $contentTitleSize = "h3"; }
if (!$tileSource) { $tileSource = "manual"; }

if ($includeDescription) {
    $includeDescriptionClass = "_include-description";
}

?>

<?php if ($tileSource=="manual"): ?>
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
                                    <<?= $contentTitleSize; ?> class="s-tiles__item-title"><?= $contentTitle; ?></<?= $contentTitleSize; ?>>
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

<?php elseif ($tileSource=="practice-area"): ?>

    <section class="s-tiles">
        <div class="s-tiles__list <?= $contentColumns; ?> <?= $includeDescriptionClass; ?>">
        <?php
        $practiceAreaTypeObj = get_field('practice_area_type');

        if ($practiceAreaTypeObj) {
            $practiceAreaTypeName = ($practiceAreaTypeObj->name);
            $practiceAreaTypeID = ($practiceAreaTypeObj->term_id);
            $args = array(
                'post_type' => 'practice-area',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'practice-area-types',
                        'field' => 'term_id',
                        'terms' => $practiceAreaTypeID,
                    ),
                ),
                'meta_query'     => array(
                    'relation' => 'OR',
                    array(
                        'key'     => 'short_title',
                        'compare' => 'EXISTS',
                    ),
                    array(
                        'key'     => 'short_title',
                        'compare' => 'NOT EXISTS',
                    ),
                ),
                'orderby'        => array(
                    'short_title'       => 'ASC',
                    'title' => 'ASC'
                ),
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) { $query->the_post();

                    $postID = get_the_ID();
                    $contentLink = esc_url( get_permalink());
                    $contentImage = get_post_thumbnail_id($postID);
                    $contentImageURL = get_the_post_thumbnail_url($postID,'tiles');
                    $contentImageAlt = get_post_meta($contentImage, '_wp_attachment_image_alt', true);

                    if (get_field('short_title', $postID)) {
                        $contentTitle = get_field('short_title', $postID);
                    } else {
                        $contentTitle = get_the_title();
                    }

                    if ($includeDescription) {
                        $contentDescription = get_field('short_description', $postID);
                    }

                    ?>

                     <a class="s-tiles__item" href="<?= $contentLink; ?>">
                        <div class="s-tiles__item-inner">
                            <?php if($contentImage): ?>
                            <img class="s-tiles__item-img" src="<?= $contentImageURL; ?>" alt="<?= $contentImageAlt; ?>"/>
                            <?php endif; ?>
                            <div class="s-tiles__item-hover">
                            </div>
                            <div class="s-tiles__item-info">
                                <<?= $contentTitleSize; ?> class="s-tiles__item-title"><?= $contentTitle; ?></<?= $contentTitleSize; ?>>
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

                <?php
                }
            } else {
                echo '<p>No practice areas found.</p>';
            }

            // Reset post data
            wp_reset_postdata();
        }
        ?>
        </div>
    </section>
<?php endif; ?>

<?php
if ($tileSource == "practice-area111") {

    $tileSource = get_field( 'tile_source');
    $practiceAreaTypeObj = get_field('practice_area_type');

    if ($practiceAreaTypeObj) {

        $practiceAreaTypeName = ($practiceAreaTypeObj->name);
        $practiceAreaTypeID = ($practiceAreaTypeObj->term_id);

        $args = array(
            'post_type' => 'practice-area',
            'posts_per_page' => -1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'practice-area-types',
                    'field' => 'term_id',
                    'terms' => $practiceAreaTypeID,
                ),
            ),
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            echo '<ul>';
            while ($query->have_posts()) {
                $query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            echo '</ul>';
        } else {
            echo '<p>No practice areas found.</p>';
        }

        // Reset post data
        wp_reset_postdata();
    }

}


