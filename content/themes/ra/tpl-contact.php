<?php

/**
 ***************************************************************************
 * Template Name: Contact
 ***************************************************************************
 */



// Get the header
get_header();

// Get fields from CMS
$address = get_field('postal_address', 'options');

if( $address ):
    $addr = false;
    $addr_count = count($address);

    foreach($address as $k => $i):
        if($k + 1 == $addr_count):
        $addr .= $i['line'];
        else:
        $addr .= $i['line'] . ', ';
        endif;
    endforeach;
endif;

?>

<?php get_template_part( 'views/globals/breadcrumbs' ); ?>

<main class="section">
    <div class="container">
        <div class="grid">
            <div class="grid__item grid__item--9-12-bp4">
                <div class="content">
                    <div class="container--introduction">
                        <h1 class="headline"><?php echo get_the_title(); ?></h1>
                        <p class="introduction_text"><?php echo get_the_excerpt(); ?></p>
                    </div>
                    <?php the_content(); ?>
                    <?php if($addr): ?>
                        <figure class="flexible | u-push-bottom">
                            <iframe height="250" width="500" src="https://maps.google.it/maps?q=<?php echo urlencode($addr); ?>&output=embed" style="border:0;" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
                        </figure>
                    <?php endif; ?>
                </div>
            </div>

            <div class="grid__item grid__item--3-12-bp4">
                <?php get_sidebar('contact'); ?>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>
