<?php
/**
* Block Name: People Block
*/

$blockHeader = get_field( 'block_header');

$people_query = new WP_Query(array(
    'post_type' => 'people',
    'posts_per_page' => -1
));
?>

<section class="sl-attorneys">
    <?php if($blockHeader): ?>
    <h2 class="sl-attorneys__title"><?= $blockHeader ?></h2>
    <?php endif; ?>

    <p class="sl-attorneys__text">We believe in one on one interaction with our clients and keeping them fully informed with the legal process. As communication is critical, we spend an extensive amount of time with our clients to ensure they understand every aspect of their case.</p>

    <div class="sl-attorneys__inner">
        <div class="sl-attorneys__prev">
            <svg class="svg svg-b-angle-rl" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                <use xlink:href="assets/images/_set.svg#b-angle-rl"></use>
            </svg>
        </div>
        <div class="sl-attorneys__list">

            <?php
            if ($people_query->have_posts()) :
                while ($people_query->have_posts()) : $people_query->the_post();

                    $post_id = get_the_ID();
                    $personTitle = get_field('person_title', $post_id);
                    $personShortBio = get_field('person_short_bio', $post_id);
                    $personImage = get_post_thumbnail_id($post_id);

                    if ($personImage) {
                        $personImageSrc = get_the_post_thumbnail_url(get_the_ID(),'medium');
                        $personImageAlt = get_post_meta($personImage, '_wp_attachment_image_alt', true);
                    } else {
                        $personImageSrc = "https://placehold.co/300x300";
                    }
                    ?>

                    <a href="<?= get_permalink(); ?>">
                        <div class="sl-attorneys__item">
                            <img class="sl-attorneys__img" src="<?= $personImageSrc; ?>" alt="<?= $personImageAlt; ?>"/>
                            <h5 class="sl-attorneys__item-title"><?= get_the_title(); ?></h5>
                        </div>
                    </a>

                    <?php
                endwhile;
            else :
                echo '<p>No people found.</p>';
            endif;

            // Reset post data to avoid conflicts
            wp_reset_postdata();
            ?>

        </div>
    <div class="sl-attorneys__next">
        <svg class="svg svg-b-angle-rr" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <use xlink:href="assets/images/_set.svg#b-angle-rr"></use>
        </svg>
    </div>
    </div><a class="gb-button b-medium" href="/about/team">MEET OUR FULL TEAM</a>
</section>

