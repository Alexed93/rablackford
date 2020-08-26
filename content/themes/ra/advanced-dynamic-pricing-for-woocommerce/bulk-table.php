<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * @var string $header_html
 * @var array  $table_header
 * @var array  $rows
 * @var string $footer_html
 */


?>
<div class='clear'></div>

<div class="bulk_table">
    <div class="wdp_pricing_table_caption">Pricing</div>
    <table class="wdp_pricing_table pricing">
        <thead>
        <tr class="pricing__toprow">
			<?php foreach ( $table_header as $label ): ?>
                <td><?php echo $label ?></td>
			<?php endforeach; ?>
        </tr>
        </thead>

        <tbody>
		<?php foreach ( $rows as $row ): ?>
            <tr class="pricing__row">
				<?php foreach ( $row as $html ): ?>
                    <td><?php echo $html ?></td>
				<?php endforeach; ?>
            </tr>
		<?php endforeach; ?>
        </tbody>
    </table>
    <span class="wdp_pricing_table_footer"><?php echo $footer_html; ?></span>
    <br>
</div>
