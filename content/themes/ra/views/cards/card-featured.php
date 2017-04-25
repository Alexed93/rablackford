<?php

/**
 ***************************************************************************
 * Partial: Card
 ***************************************************************************
 *
 * This partial is used to define the base styling and layout of a featured card
 *
 *
 */

$card_title = get_field('cardfeatured_title', 'options');
$card_text = get_field('cardfeatured_text', 'options');
$card_btn = get_field('cardfeatured_button', 'options');
$card_btnlink = get_field('cardfeatured_link', 'options');

?>

<?php if ( $card_title ): ?>
    <div class="card card--featured | u-align-center">
        <div class="card__content">
            <?php if( $card_title ): ?>
                <h1 class="beta"><?php echo $card_title; ?></h1>
            <?php endif; ?>
            <?php if( $card_text ): ?>
                <p><?php echo $card_text; ?></p>
            <?php endif; ?>
            <a href="<?php echo $card_btnlink; ?>" class="btn btn--primary">
                <?php echo $card_btn; ?>
            </a>
        </div>
    </div>
<?php endif; ?>
