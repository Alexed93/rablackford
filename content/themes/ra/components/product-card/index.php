<?php

$prod_id = $args['id'] ?? '';

if ($prod_id) {
    $product = wc_get_product($prod_id);

}

$url =  get_permalink($prod_id);
$title = get_the_title($prod_id);
$excerpt = ra_get_excerpt_by_id($prod_id);

$card_title_style = 'card__title';

if ($product) :?>
    <div class="grid__item grid__item--6-12-bp3">
        <article class="card card--grey">
            <div class="card__content">
                <a href="<?php echo esc_url($url); ?>"><h1 class="<?php echo $card_title_style; ?> beta"><?php echo $title; ?></h1></a>

                <?php

                    // show manual excerpt;
                    echo wpautop($excerpt);

                ?>

            </div>
        </article>
    </div>
<?php endif;
