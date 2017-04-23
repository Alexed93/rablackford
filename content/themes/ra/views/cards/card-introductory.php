<?php

/**
 ***************************************************************************
 * Partial: Card-introductory
 ***************************************************************************
 *
 * This partial is used to define the base styling and layout of an introductory card
 *
 *
 */

$card_title = get_field('cardintro_title');
$card_text = get_field('cardintro_text');
$card_image = get_field('cardintro_image');

?>

<div class="card cf">
    <div class="card__content">
        <h1 class="beta"><?php echo $card_title; ?></h1>
        <p><?php echo $card_text; ?></p>
    </div>
    <div class="card__image" style="background-image: url('<?php echo $card_image['sizes']['large']; ?>')"></div>
</div>
