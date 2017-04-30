<?php

/**
 ***************************************************************************
 * Partial: Posts Index
 ***************************************************************************
 *
 * Display the information within the Posts listing template.
 *
 */



/**
 * Gain access to $post data
 */
global $post;

?>

<?php if ( have_posts() ): ?>
    <div class="grid">
        <div class="grid__item grid__item--9-12-bp4">
            <?php while ( have_posts() ): the_post(); ?>
                <?php get_template_part('views/post/show'); ?>
            <?php endwhile; ?>
            <?php get_template_part('views/globals/pagination'); ?>
        </div>
        <div class="grid__item grid__item--3-12-bp4">
            <?php get_sidebar('blog'); ?>
        </div>
    </div>
<?php else: ?>
    <?php get_template_part( 'views/errors/404-posts' ); ?>
<?php endif; ?>
