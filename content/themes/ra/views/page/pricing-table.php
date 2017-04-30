<?php

/**
 ***************************************************************************
 * Partial: Pricing-table
 ***************************************************************************
 *
 * This partial is used to define the markup for pricing tables found on a standard page template
 * .
 *
 */

// Get ACF fields

$pricing_tables = get_field( 'pricing_tables' );

?>

<?php if( $pricing_tables ): ?>
    <?php foreach( $pricing_tables as $pricing_table): ?>

        <div class="table__container">
            <h2><?php echo $pricing_table['table_title']; ?></h2>

            <?php
                $weight_row = $pricing_table['weight_row'];
            ?>


            <table class="pricing">
                <tr class="pricing__toprow">
                    <th>Weight</th>
                    <th colspan="3">Price (£)</th>
                </tr>
                <tr class=pricing__headers>
                    <td></td>
                    <td>25kg</td>
                    <td>50kg</td>
                    <td>Cost</td>
                </tr>

                <?php
                    if( $weight_row ):
                        foreach( $weight_row as $weight_data ):
                            $weight_title = $weight_data['weight'];
                            $price_25kg = $weight_data['pp_25kg'];
                            $price_50kg = $weight_data['pp_50kg'];
                            $total = $weight_data['total_cost'];
                ?>

                <tr class="pricing__row">
                    <th><?php echo $weight_title ?></th>

                    <?php if( $price_25kg ): ?>
                        <td><?php echo $price_25kg ?></td>
                    <?php else: ?>
                        <td>-</td>
                    <?php endif; ?>

                    <?php if( $price_50kg ): ?>
                        <td><?php echo $price_50kg ?></td>
                    <?php else: ?>
                        <td>-</td>
                    <?php endif; ?>

                    <td><?php echo $total ?></td>

                        <?php endforeach; ?>
                    <?php endif; ?>
                </tr>
            </table>
        </div>

    <?php endforeach; ?>
<?php endif; ?>


