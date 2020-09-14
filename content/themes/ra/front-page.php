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

<main class="section u-zero-bottom u-zero-pad-bottom">
    <div class="container u-space-top cf">
        <a href="http://solidfuel.co.uk/approved-coal-wood-merchants/" class="u-float-left">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/acm--large.png" title="Approved Coal Merchant" alt="Approved Coal Merchant" class="acm-home">
        </a>
        <a href="#" class="u-float-left">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/80years.png" title="Celebrating 80 years of business" alt="Celebrating 80 years of business" class="u-push-left/2 celebration celebration--home">
        </a>
        <div class="home-intro">
            <h1 class="headline"><?php echo $intro_title; ?></h1>
            <p class="introduction_text"><?php echo $intro_para; ?></p>
        </div>
    </div>

    <div class="container">

        <?php
            rab_get_component(
                'product-categories',
                [
                    'parent' => 30
                ]
            );
        ?>

        <?php get_template_part( 'views/cards/card-introductory' ); ?>

        <?php get_template_part( 'views/cards/card-featured' ); ?>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/frontpic.svg" title="RA Blackford and son" alt="RA Blackford and son" class="u-width-100 u-push-top@2">

</main>

<?php get_footer(); ?>
