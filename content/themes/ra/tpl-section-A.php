<?php

/**
 ***************************************************************************
 * Template Name: Section A
 ***************************************************************************
 */



// Get the header
get_header();

?>

<?php get_template_part( 'views/globals/breadcrumbs' ); ?>

<main class="section">
    <div class="container">
        <div class="container--introduction">
            <h1 class="headline"><?php echo get_the_title(); ?></h1>
            <p class="introduction_text"><?php echo get_the_excerpt(); ?></p>
        </div>
        <?php get_template_part( 'views/cards/card-introductory' ); ?>
        <?php get_template_part( 'views/cards/card' ); ?>
        <?php get_template_part( 'views/cards/card-featured' ); ?>
    </div>
</main>

<?php get_footer(); ?>
