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
    <div class="container">
        <div class="container--introduction">
            <h1 class="headline"><?php echo $intro_title; ?></h1>
            <p class="gamma"><?php echo $intro_para; ?></p>
        </div>
    </div>
    <!-- .container -->
</main>

<?php get_footer(); ?>
