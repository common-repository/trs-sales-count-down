<?php
/**
 * This file is the template / design for fancy countdown style.
 *
 * @file fancy.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

wp_enqueue_style( 'fancy-countdown-style' );
wp_enqueue_style( 'progress-bar-style1' );

$dates    = $this->calculate_dates(false);
$settings = $this->get_vars();

$formatted_date = $dates->y . '/' . $dates->m . '/' . $dates->d . ' ' . $dates->h . ':' . $dates->i . ':' . $dates->s;

?>
<div class="fancy-style-and-progress-bar-wrapper">
    <div class="wrapper">
        <div data-countdown="<?php echo $formatted_date; ?>" class="clockdiv" id="clockdiv-<?php echo esc_attr( $product->get_id() ); ?>">
            <div>
                <span class="days"></span>
                <div class="smalltext">Days</div>
            </div>
            <div>
                <span class="hours"></span>
                <div class="smalltext">Hours</div>
            </div>
            <div>
                <span class="minutes"></span>
                <div class="smalltext">Minutes</div>
            </div>
            <div>
                <span class="seconds"></span>
                <div class="smalltext">Seconds</div>
            </div>
        </div>
    </div>

    <?php if ( 'yes' === esc_attr( $settings['display_progress_bar'] ) ) : ?>
        <div class="progress-bar-wrapper progress-bar-<?php echo esc_attr( $product->get_id() ); ?>">
            <div class="progress-bar">
			<span class="bar">
				<span class="progress"></span>
			</span>
            </div>
            <p><?php echo esc_attr( $settings['progress_bar_text'] ); ?></p>
        </div>
    <?php endif; ?>
</div>

<script>
	jQuery(document).ready(function ($) {
        // progress bar css.
		$('.fancy-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.bar').css('background', '<?php echo esc_attr( $settings['progress_bar_secondary_color'] ); ?>');
		$('.fancy-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('background', '<?php echo esc_attr( $settings['progress_bar_primary_color'] ); ?>');
		$('.fancy-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('width', '<?php echo esc_attr( $settings['progress_bar_percentage'] ); ?>');
	});
</script>
<?php

