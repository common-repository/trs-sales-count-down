<?php
/**
 * This file is the template / design for white block style.
 *
 * @file whiteblock.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

wp_enqueue_style( 'white-block-countdown-countdown' );
wp_enqueue_style( 'progress-bar-style1' );
wp_enqueue_script('jquery-countdown');

$dates    = $this->calculate_dates(false);
$settings = $this->get_vars();

$formatted_date = $dates->y . '/' . $dates->m . '/' . $dates->d . ' ' . $dates->h . ':' . $dates->i . ':' . $dates->s;
?>

<div class="whiteblock-style-and-progress-bar-wrapper">
    <div class="trs-whiteblock-countdown">
        <div class="main-wrapper" data-countdown="<?php echo $formatted_date; ?>" id='tiles'>
            <div class="countdown-item">
                <span class="days time"></span>
                <span class="label">D</span>
            </div>
            <div class="countdown-item">
                <span class="hours time"></span>
                <span class="label">H</span>
            </div>
            <div class="countdown-item">
                <span class="minutes time"></span>
                <span class="label">M</span>
            </div>
            <div class="countdown-item">
                <span class="seconds time"></span>
                <span class="label">S</span>
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
        $('.whiteblock-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.bar').css('background', '<?php echo esc_attr( $settings['progress_bar_secondary_color'] ); ?>');
        $('.whiteblock-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('background', '<?php echo esc_attr( $settings['progress_bar_primary_color'] ); ?>');
        $('.whiteblock-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('width', '<?php echo esc_attr( $settings['progress_bar_percentage'] ); ?>');
    });
</script>
