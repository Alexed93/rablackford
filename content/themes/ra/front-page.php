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
$shop_intro = get_field('show_shop_introduction');
$shop_id = get_option( 'woocommerce_shop_page_id' );
$latest_news = get_field('show_latest_news');

$content = get_the_content();

?>

<main class="section u-zero-bottom u-zero-pad-bottom">
    <div class="container u-space-top cf">
        <div class="home-intro__wrap">
            <div class="home-intro__icons">
                <a href="http://solidfuel.co.uk/approved-coal-wood-merchants/" class="u-float-left">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/acm--large.png" title="Approved Coal Merchant" alt="Approved Coal Merchant" class="acm-home">
                </a>
                <a href="#" class="u-float-left">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/80years.png" title="Celebrating 80 years of business" alt="Celebrating 80 years of business" class="u-push-left/2 celebration celebration--home">
                </a>
            </div>
            <div class="home-intro">
                <h1 class="headline"><?php echo $intro_title; ?></h1>
                <p class="introduction_text"><?php echo $intro_para; ?></p>
            </div>
        </div>
    </div>

    <?php if ($content) : ?>
        <div class="container u-space-top">
            <article class="content">
                <?php echo $content; ?>
            </article>
        </div>
    <?php endif; ?>

    <div class="container">

        <?php get_template_part( 'views/cards/card-introductory' ); ?>

        <?php if ($shop_intro && $shop_id) :

            rab_get_component(
                'card-introductory',
                [
                    'id' => $shop_id,
                    'style' => 'green'
                ]
            );

        endif; ?>

        <?php if ($latest_news) :
            $blog_id = get_option( 'page_for_posts' );
            $blog_url = get_permalink($blog_id);
            $latest_post = wp_get_recent_posts(
                [
                    'numberposts' => 2,
                    'post_status' => 'publish'
                ]
            );

            if ($blog_url && !is_wp_error($latest_post)) : ?>
                <article class="card card--grey">
                    <div class="card__content">
                        <a href="<?php echo $blog_url; ?>"><h1 class="beta">Latest News</h1></a>

                        <?php foreach ($latest_post as $latest) :

                            $latest_id = $latest['ID'];

                            $type = ra_term_links($latest_id, 'category' , false );

                            ?>
                            <p class="zeta | meta | u-push-bottom/2 u-push-top@2">Posted <?php echo get_the_date('jS F Y', $latest_id); ?> in <?php echo $type; ?></p>
                            <h2 class="gamma"><a href="<?php the_permalink($latest_id); ?>"><?php echo wp_kses_post($latest['post_title']); ?></a></h2>
                            <?php if ($latest['post_excerpt']) : ?>
                                <p>
                                    <?php echo wp_kses_post($latest['post_excerpt']); ?>
                                </p>
                            <?php endif; ?>

                        <?php endforeach; ?>
                    </div>
                </article>
            <?php endif; ?>
        <?php endif; ?>

        <?php
            rab_get_component(
                'product-categories',
                [
                    'parent' => 30
                ]
            );
        ?>



        <?php get_template_part( 'views/cards/card-featured' ); ?>
    </div>

    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/frontpic.svg" title="RA Blackford and son" alt="RA Blackford and son" class="u-width-100 u-push-top@2">

</main>

<?php get_footer(); ?>
