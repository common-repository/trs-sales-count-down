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

wp_enqueue_style( 'flip-clock' );
wp_enqueue_style( 'modern-flip-main' );
wp_enqueue_style( 'progress-bar-style1' );
wp_enqueue_script('modern-flipclock');
wp_enqueue_script('modern-flipclock-countdown');

$dates    = $this->calculate_dates(false);
$settings = $this->get_vars();

if ($this->is_expired()){
    $y = '0';
    $m = '0';
    $d = '0';
    $h = '0';
    $i = '0';
    $s = '0';
}else {
    $y = $dates->y;
    $m = $dates->m;
    $d = $dates->d;
    $h = $dates->h;
    $i = $dates->i;
    $s = $dates->s;
}


?>

<div class="flipmodern-style-and-progress-bar-wrapper">
    <div class="trs-flipmodern-countdown">
        <div class="countdown countdown-<?php echo $product->get_id(); ?>"></div>
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
        $('.trs-flipmodern-countdown > .countdown-<?php echo $product->get_id(); ?>').countdown100({

            endtimeYear: <?php echo $y; ?>,
            endtimeMonth: <?php echo $m; ?>,
            endtimeDate: <?php echo $d; ?>,
            endtimeHours: <?php echo $h; ?>,
            endtimeMinutes: <?php echo $i; ?>,
            endtimeSeconds: <?php echo $s; ?>,
            timeZone: ""

        });

        // progress bar css.
        $('.flipmodern-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.bar').css('background', '<?php echo esc_attr( $settings['progress_bar_secondary_color'] ); ?>');
        $('.flipmodern-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('background', '<?php echo esc_attr( $settings['progress_bar_primary_color'] ); ?>');
        $('.flipmodern-style-and-progress-bar-wrapper .progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('width', '<?php echo esc_attr( $settings['progress_bar_percentage'] ); ?>');
    });
</script>
