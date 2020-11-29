<?php

/**
 ***************************************************************************
 * Template Name: Full Width (no sidebar)
 ***************************************************************************
 *
 */



// Get the header
get_header();

?>

<?php get_template_part( 'views/globals/breadcrumbs' ); ?>

<main class="section">
    <div class="container">
        <?php if ( have_posts() ): ?>
            <?php while ( have_posts() ): ?>
                <?php the_post(); ?>
                <div class="container--introduction | u-push-bottom@2">
                    <h1 class="headline"><?php the_title(); ?></h1>
                    <?php if ( $post->post_excerpt ): ?>
                        <p class="introduction_text"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                </div>
                <?php
                if (is_cart()) :
                    $notice = get_field('basket_message', 'options');

                    if ($notice) : ?>
                        <div class="card card--featured | u-push-bottom@2">
                            <div class="card__content | u-align-center">
                                <?php echo apply_filters('the_content', $notice); ?>
                            </div>
                        </div>
                    <?php endif;
                endif; ?>
                <div class="grid">
                    <div class="grid__item">
                        <article class="content content--full">
                            <?php the_content(); ?>
                            <?php if( get_field('pricing_tables') ): ?>
                                <?php get_template_part( 'views/page/pricing-table' ); ?>
                            <?php endif; ?>
                        </article>
                    </div>
                </div> <!-- .grid -->
            <?php endwhile; ?>
        <?php else: ?>
            <?php get_template_part( 'views/errors/404-page' ); ?>
        <?php endif; ?>
    </div> <!-- .container -->
</main>

<?php get_footer(); ?>
