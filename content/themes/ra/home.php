<?php

/**
 ***************************************************************************
 * Home Template
 ***************************************************************************
 *
 * This template is used to show the posts landing, assuming its not already
 * the Front Page of the site, in which case `front-page.php` would take
 * priority.
 *
 */



// Get the header
get_header();

// Define fields from static 'blog' page in WordPress based on page ID
$title   = get_the_title( 74 );
$excerpt = ra_get_excerpt_by_id( 74 );
?>

<?php get_template_part('views/globals/breadcrumbs'); ?>

<main class="section">
    <div class="container">
        <div class="container--introduction | u-push-bottom@2">
            <?php if ( $title ): ?>
                <h1 class="headline"><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $excerpt ): ?>
                <p class="introduction_text"><?php echo $excerpt; ?></p>
            <?php endif; ?>
        </div>
        <?php get_template_part( 'views/post/index' ) ?>
   </div> <!-- .container -->
</main>

<?php get_footer(); ?>
