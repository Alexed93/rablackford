<?php

/**
 * Product Cards
 */

$category = $args['category'] ?? '';
$price = $args['price'] ?? false;

$product_list = rab_get_products_from_category_by_ID($category);

if ($product_list) : ?>
    <div class="cards test--flexbox">
        <div class="grid grid--flex">
            <?php foreach ($product_list as $item) : ?>
                <?php
                    rab_get_component(
                        'product-card',
                        [
                            'id' => $item,
                            'price' => $price
                        ]
                    );

                ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif;
