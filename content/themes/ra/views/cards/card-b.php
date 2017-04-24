<?php

/**
 ***************************************************************************
 * Partial: Card
 ***************************************************************************
 *
 * This partial is used to define the base styling and layout of a card
 *
 *
 */

// Get children
$children = ra_get_pages($post->ID);

?>

<div class="cards test--flexbox">
    <div class="grid grid--flex">
        <?php if ( $children->have_posts() ): ?>
            <?php while ( $children->have_posts() ): ?>
                <div class="grid__item grid__item--6-12-bp2">
                    <?php $children->the_post(); ?> <?php setup_postdata($children); ?>
                    <article class="card card--grey">
                        <div class="card__content">
                            <a href="<?php echo get_permalink(); ?>" class="u-display-inline"><h1 class="card__title beta"><?php echo the_title(); ?></h1></a>
                            <p class="u-zero-bottom"><?php echo get_the_excerpt($id); ?></p>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
       <?php endif; wp_reset_postdata(); ?>
    </div>
</div>
