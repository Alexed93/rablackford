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
$children = '';

if ( is_page(5) || is_front_page() ):
    $children = ra_get_pages(5);
else:
    $children = ra_get_pages($post->ID);
endif;

$card_title_style = '';

if ( !is_page_template('tpl-section-A.php', 'tpl-section-B.php') ):
    $card_title_style = '';
else:
    $card_title_style = 'card__title';
endif;

$card_style = '';

if ( is_front_page() ):
    $card_style = 'card__content--home';
endif;

?>

<div class="cards test--flexbox">
    <div class="grid grid--flex">
        <?php if ( $children->have_posts() ): ?>
            <?php while ( $children->have_posts() ): ?>
                <div class="grid__item grid__item--6-12-bp3">
                    <?php $children->the_post(); ?> <?php setup_postdata($children); ?>
                    <article class="card card--grey">
                        <div class="card__content <?php echo $card_style; ?>">
                            <a href="<?php echo get_permalink(); ?>"><h1 class="<?php echo $card_title_style; ?> beta"><?php echo the_title(); ?></h1></a>

                            <?php if ( !is_page_template('tpl-section-A.php') ): ?>
                                <p><?php echo ra_get_excerpt_by_id($id); ?></p>
                                <?php
                                    // Get grand-children
                                    $grandchildren = ra_get_pages($post->ID);
                                ?>
                                <?php if ( $grandchildren->have_posts() ): ?>
                                    <ul class="card-list">
                                        <?php while ( $grandchildren->have_posts() ): ?>
                                            <?php $grandchildren->the_post(); ?> <?php setup_postdata($grandchildren); ?>
                                            <li class="card-list__item card-list__item--double">
                                                <a href="<?php echo get_permalink(); ?>" class="u-weight-medium"><?php echo the_title(); ?></a>
                                            </li>
                                         <?php endwhile; ?>
                                    </ul>
                                <?php endif; wp_reset_postdata(); ?>
                            <?php endif; ?>

                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
       <?php endif; wp_reset_postdata(); ?>
    </div>
</div>
