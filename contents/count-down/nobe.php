<?php
/**
 * This file is the template / design for nobe style.
 *
 * @file nobe.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

wp_enqueue_style( 'nobe-countdown-countdown' );
wp_enqueue_style( 'progress-bar-style1' );
wp_enqueue_script('jquery-countdown');

$dates    = $this->calculate_dates(false);
$settings = $this->get_vars();

$formatted_date = $dates->y . '/' . $dates->m . '/' . $dates->d . ' ' . $dates->h . ':' . $dates->i . ':' . $dates->s;
?>

<div class="nobe-style-and-progress-bar-wrapper">
    <div class="trs-nobe-countdown">
        <div data-countdown="<?php echo $formatted_date; ?>" id='tiles'>
            <span class="days">Days</span>
            <span class="hours">Hours</span>
            <span class="minutes">Mins</span>
            <span class="seconds">Secs</span>
        </div>
        <ul class="labels">
            <li>Days</li>
            <li>Hours</li>
            <li>Mins</li>
            <li>Secs</li>
        </ul>
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
        $('.nobe-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.bar').css('background', '<?php echo esc_attr( $settings['progress_bar_secondary_color'] ); ?>');
        $('.nobe-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('background', '<?php echo esc_attr( $settings['progress_bar_primary_color'] ); ?>');
        $('.nobe-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('width', '<?php echo esc_attr( $settings['progress_bar_percentage'] ); ?>');
    });
</script>
