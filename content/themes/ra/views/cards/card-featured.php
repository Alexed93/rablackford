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
$card_buttontext = get_field('cardfeatured_button', 'options');
$card_button = get_field('cardfeatured_buttonquestion', 'options');
$card_file = get_field('cardfeatured_filequestion', 'options');

if ( $card_button ):
    $card_btnlink = get_field('cardfeatured_link', 'options');
endif;

if ( $card_file ):
    $card_file = get_field('cardfeatured_file', 'options');
    $card_fileurl = $card_file['url'];
endif;

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
            <?php if ( $card_button || $card_fileurl ): ?>
                <a href="<?php echo $card_btnlink; ?><?php echo $card_fileurl; ?>" class="btn btn--primary">
                    <?php echo $card_buttontext; ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
