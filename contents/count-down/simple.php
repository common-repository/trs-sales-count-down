<?php
/**
 * This file is the template / design for simple style.
 *
 * @file simple.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

wp_enqueue_style( 'simple-countdown-countdown' );
wp_enqueue_style( 'progress-bar-style1' );

wp_enqueue_script('jquery-countdown');

$dates    = $this->calculate_dates(false);
$settings = $this->get_vars();

$formatted_date = $dates->y . '/' . $dates->m . '/' . $dates->d . ' ' . $dates->h . ':' . $dates->i . ':' . $dates->s;

?>

<div class="trs-simple-count-down-and-progress-bar-wrapper">
    <ul class="simple-countdown" data-countdown="<?php echo $formatted_date; ?>">
        <li>
            <span class="days">00</span>
            <p class="days_ref">days</p>
        </li>
        <li class="seperator">.</li>
        <li>
            <span class="hours">00</span>
            <p class="hours_ref">hours</p>
        </li>
        <li class="seperator">:</li>
        <li>
            <span class="minutes">00</span>
            <p class="minutes_ref">minutes</p>
        </li>
        <li class="seperator">:</li>
        <li>
            <span class="seconds">00</span>
            <p class="seconds_ref">seconds</p>
        </li>
    </ul>

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
        $('.trs-simple-count-down-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.bar').css('background', '<?php echo esc_attr( $settings['progress_bar_secondary_color'] ); ?>');
        $('.trs-simple-count-down-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('background', '<?php echo esc_attr( $settings['progress_bar_primary_color'] ); ?>');
        $('.trs-simple-count-down-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('width', '<?php echo esc_attr( $settings['progress_bar_percentage'] ); ?>');
    });
</script>
<?php


