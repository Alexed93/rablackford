<?php

/**
 ***************************************************************************
 * Front Page Template
 ***************************************************************************
 *
 * This template is used to show the front page of a WordPress website,
 * regardless of whether or not its a Static Page or Posts landing.
 * More info can be found here:
 * http://codex.wordpress.org/Creating_a_Static_Front_Page
 *
 */



// Get the header
get_header();

$intro_title = get_field('intro_title');
$intro_para = get_field('intro_para');

?>

<main class="section">
    <div class="container u-space-top cf">
        <a href="http://solidfuel.co.uk/approved-coal-wood-merchants/" class="u-float-left">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/img/acm--large.png" title="Approved Coal Merchant" alt="Approved Coal Merchant" class="acm-home">
        </a>
        <div class="home-intro u-float-left">
            <h1 class="headline"><?php echo $intro_title; ?></h1>
            <p class="introduction_text"><?php echo $intro_para; ?></p>
        </div>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/dist/img/frontpic.svg" title="RA Blackford and son" alt="RA Blackford and son" class="u-push-bottom@2 u-width-100 u-push-top@2">

    <div class="container">
        <?php get_template_part( 'views/cards/card-introductory' ); ?>
        <?php get_template_part( 'views/cards/card' ); ?>
        <?php get_template_part( 'views/cards/card-featured' ); ?>
    </div>
</main>

<?php get_footer(); ?>
