<?php
/**
* Block Name: People Block
*/

$blockHeader = get_field( 'block_header');
$blockHeaderSize = get_field( 'block_header_size');
if (!$blockHeaderSize) {
    $blockHeaderSize = "h2";
}
$blockDescription = get_field( 'block_description');
$buttonLabel = get_field( 'button_label');
$buttonURL = get_field( 'button_url');
?>
<section class="sl-attorneys">
    <?php if($blockHeader): ?>
    <<?= $blockHeaderSize; ?> class="sl-attorneys__title"><?= $blockHeader; ?></<?= $blockHeaderSize; ?>>
    <?php endif; ?>

    <?php if($blockDescription): ?>
    <p class="sl-attorneys__text"><?= $blockDescription; ?></p>
    <?php endif; ?>

    <div class="sl-attorneys__inner">
        <div class="sl-attorneys__prev">
            <svg class="svg svg-b-angle-rl" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#b-angle-rl"></use>
            </svg>
        </div>
        <div class="sl-attorneys__list">
            <?php
            $featured_people = get_field('people');
            if( $featured_people ): ?>
                <?php foreach( $featured_people as $featured_person ):

                    $personLink = get_permalink( $featured_person->ID );
                    $personName = get_the_title( $featured_person->ID );
                    $personImage = get_post_thumbnail_id( $featured_person->ID );

                    if ($personImage) {
                        $personImageSrc = get_the_post_thumbnail_url($featured_person->ID,'medium');
                        $personImageAlt = get_post_meta($personImage, '_wp_attachment_image_alt', true);
                    } else {
                        $personImageSrc = "https://placehold.co/300x300";
                        $personImageAlt = $personName;
                    }
                    ?>
                    <a href="<?= $personLink; ?>">
                        <div class="sl-attorneys__item">
                            <img class="sl-attorneys__img" src="<?= $personImageSrc; ?>" alt="<?= $personImageAlt; ?>"/>
                            <p class="sl-attorneys__item-title"><?= $personName; ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No people found.</p>
            <?php endif; ?>

        </div>
    <div class="sl-attorneys__next">
        <svg class="svg svg-b-angle-rr" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <use xlink:href="<?= get_stylesheet_directory_uri() ?>/assets/images/_set.svg#b-angle-rr"></use>
        </svg>
    </div>
    </div>
    <a class="gb-button b-medium" href="<?= $buttonURL; ?>"><?= $buttonLabel; ?></a>
</section>

