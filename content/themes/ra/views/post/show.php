<?php

/**
 ***************************************************************************
 * Partial: Posts Show
 ***************************************************************************
 *
 * Display the Post's single.php information.
 *
 */



/**
 * Gain access to $post data
 */
global $post, $article;

$type = ra_term_links($post->ID, 'category' , false );

?>

<div class="article__body">
    <div class="content">
        <p class="zeta | meta | u-push-bottom">Posted <?php echo get_the_date('jS F Y'); ?> in <?php echo $type; ?></p>
        <h1 class="gamma"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <?php if ( $post->post_excerpt ): ?>
            <p>
                <?php echo get_the_excerpt(); ?>
            </p>
        <?php endif; ?>
    </div>
</div>
