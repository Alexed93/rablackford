<?php

/**
 ***************************************************************************
 * Default Template
 ***************************************************************************
 *
 * This template is used to show a generic page. More info here:
 * http://codex.wordpress.org/Theme_Development#Index_.28index.php.29
 *
 */



// Get the header
get_header();

// Setup published date as DateTime object.
$pub_date = datetime::createfromformat('Y-m-d H:i:s', $post->post_date);

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
                <div class="grid">
                    <div class="grid__item grid__item--9-12-bp4">
                        <article class="content">
                            <?php the_content(); ?>
                        </article>
                    </div>
                    <div class="grid__item grid__item--3-12-bp4">
                        <?php get_sidebar( 'blog' ); ?>
                    </div>
                </div> <!-- .grid -->
            <?php endwhile; ?>
        <?php else: ?>
            <?php get_template_part( 'views/errors/404-posts' ); ?>
        <?php endif; ?>
    </div> <!-- .container -->
</main>

<?php get_footer(); ?>
