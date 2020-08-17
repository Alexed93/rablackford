<?php

/**
 ***************************************************************************
 * Partial: Card-introductory
 ***************************************************************************
 *
 * This partial is used to define the base styling and layout of an introductory card
 * Converted to component for added flexibility
 *
 *
 */

$id = $args['id'] ?? get_the_ID();

$card_title = get_field('cardintro_title', $id);
$card_text = get_field('cardintro_text', $id);
$card_image = get_field('cardintro_image', $id);

$background = '';

if ( is_front_page() ):
    $background = 'card--grey';
else:
    $background = 'card--green';
endif;

?>

<?php if ( $card_title ): ?>
    <div class="card card--introductory cf | <?php echo $background; ?>">
        <div class="card__content">
            <?php if( $card_title ): ?>
                <h1 class="beta"><?php echo $card_title; ?></h1>
            <?php endif; ?>
            <?php if( $card_text ): ?>
                <p><?php echo $card_text; ?></p>
            <?php endif; ?>
        </div>
        <?php if( $card_image ): ?>
            <div class="card__image" style="background-image: url('<?php echo $card_image['sizes']['large']; ?>')"></div>
        <?php endif; ?>
    </div>
<?php endif; ?>
