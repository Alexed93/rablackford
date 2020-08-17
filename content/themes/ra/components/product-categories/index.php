<?php

/**
 * Product Categories
 */

$slim = $args['slim'] ?? false;
$parent = $args['parent'] ?? '';

$card_style = '';
$card_title_style = '';

if ($slim) {
    $card_title_style = 'card__title';
}

$cat_args = [
    'hide_empty' => false
];

if ($parent !== '') {
    $cat_args['parent'] = $parent;
}


$prod_categories = get_terms('product_cat', $cat_args);

//var_dump($prod_categories);

if ($prod_categories) : ?>
    <div class="cards test--flexbox">
        <div class="grid grid--flex">
            <?php
            foreach ($prod_categories as $cat) :

                $cat_id = $cat->term_id;
                $acf_cat_id = 'category_' . $cat_id;
                $cat_excerpt = get_field('excerpt', $acf_cat_id);

                // dont show default category
                if ($cat_id != 18) :

                ?>

                <div class="grid__item grid__item--6-12-bp3">
                    <article class="card card--grey">
                        <div class="card__content <?php echo $card_style; ?>">
                            <a href="<?php echo get_term_link($cat_id); ?>"><h1 class="<?php echo $card_title_style; ?> beta"><?php echo $cat->name; ?></h1></a>

                            <?php

                                // show manual excerpt;
                                echo wpautop($cat_excerpt);

                                //if (!$slim) :

                                    // show either child categories or products
                                    $cat_args = [
                                        'hide_empty' => false,
                                        'parent' => $cat_id
                                    ];

                                    $cat_list = get_terms('product_cat', $cat_args);

                                    if (!is_wp_error($cat_list) && !empty($cat_list)) :
                                        ?>
                                            <ul class="card-list">
                                                <?php foreach ($cat_list as $cat) :
                                                    $cat_id = $cat->term_id;
                                                    ?>
                                                    <li class="card-list__item card-list__item--double">
                                                        <a href="<?php echo get_term_link($cat_id); ?>" class="u-weight-medium"><?php echo $cat->name; ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php
                                    endif;

                                    if (is_wp_error($cat_list) || empty($cat_list)) :
                                        // fall back to product list if no categories
                                        $product_list = rab_get_products_from_category_by_ID($cat_id);

                                        if ($product_list) : ?>
                                            <ul class="card-list">
                                                <?php foreach ($product_list as $product_id) : ?>
                                                    <li class="card-list__item card-list__item--double">
                                                        <a href="<?php echo get_permalink($product_id); ?>" class="u-weight-medium"><?php echo get_the_title($product_id); ?></a>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php endif;
                                    endif;

                                //endif; ?>

                        </div>
                    </article>
                </div>


                <?php

                endif;
            endforeach;
            ?>
        </div>
    </div>
<?php endif;
