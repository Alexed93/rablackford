<?php

$prod_id = $args['id'] ?? '';
$price = $args['price'] ?? false;

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

                <div>
                    <?php
                    // show price if requested by parent
                    if ($price) :
                        $price_html = $product->get_price_html();
                        $weight = $product->get_weight();

                        $weight_html = ' per bag';

                        if ($weight) {
                            $weight_html = ' per ' . wc_format_weight($weight) . ' bag';
                        }

                        $bulk_html = '';
                        $has_bulk_discounts = ra_product_has_bulk_discount($product);

                        if ($has_bulk_discounts) {
                            $bulk_html = ' - bulk discounts available';
                        }

                        if ($price_html) : ?>
                            <p>
                                <span class="price"><?php echo $price_html . $weight_html . $bulk_html; ?></span>
                            </p>
                        <?php endif;

                    endif;
                    ?>
                </div>
            </div>
        </article>
    </div>
<?php endif;
