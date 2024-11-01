<?php
/**
 * This file is the template / design for fly out style.
 *
 * @file flyout.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

wp_enqueue_style( 'flyout-countdown-style' );
wp_enqueue_style( 'progress-bar-style1' );

$dates    = $this->calculate_dates( $product );
$settings = $this->get_vars();

?>
<div class="trs-flyout-style-wrapper">
    <section class="wrapper wrapper-<?php echo esc_attr( $product->get_id() ); ?>">
        <section id="countdown-container-<?php echo esc_attr( $product->get_id() ); ?>" class="countdown-container">
            <article id="js-countdown" class="countdown">
                <section id="js-days" class="number js-days"></section>
                <section id="js-separator" class="separator js-separator">:</section>
                <section id="js-hours" class="number js-hours"></section>
                <section id="js-separator" class="separator js-separator">:</section>
                <section id="js-minutes" class="number js-minutes"></section>
                <section id="js-separator" class="separator js-separator">:</section>
                <section id="js-seconds" class="number js-seconds"></section>
            </article>
        </section>
    </section>
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


<script>
	jQuery(document).ready(function ($) {
		let mainElement = '.wrapper-' + <?php echo esc_attr( $product->get_id() ); ?> ;

		$(function () {
			let targetDate = new Date(<?php echo esc_attr( $dates->y ); ?>, <?php echo esc_attr( $dates->m ); ?>, <?php echo esc_attr( $dates->d ); ?>, <?php echo esc_attr( $dates->h ); ?>, <?php echo esc_attr( $dates->i ); ?>, <?php echo esc_attr( $dates->s ); ?>, 1000);

			var t = Date.parse(targetDate) - Date.parse(new Date());
			var seconds = Math.floor((t / 1000) % 60);
			var minutes = Math.floor((t / 1000 / 60) % 60);
			var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
			var days = Math.floor(t / (1000 * 60 * 60 * 24));
			let _time = {
				'total': t,
				'days': days,
				'hours': hours,
				'minutes': minutes,
				'seconds': seconds
			};
			startCountdown(_time);
		});
		var interval;

		function daysBetween(date1, date2, prodId) {
			//Get 1 day in milliseconds
			var one_day = 1000 * 60 * 60 * 24;

			// Convert both dates to milliseconds
			var date1_ms = date1.getTime();
			var date2_ms = date2.getTime();

			// Calculate the difference in milliseconds
			var difference_ms = date2_ms - date1_ms;


			// Convert back to days and return
			let days = Math.floor(difference_ms / one_day);
			if (days < 1)
				return 0;

			return days;
		}

		function secondsDifference(date1, date2, prodId) {
			//Get 1 day in milliseconds
			var one_day = 1000 * 60 * 60 * 24;

			// Convert both dates to milliseconds
			var date1_ms = date1.getTime();
			var date2_ms = date2.getTime();
			var difference_ms = date2_ms - date1_ms;
			var difference = difference_ms / one_day;
			var offset = difference - Math.floor(difference);


			return offset * (60 * 60 * 24);
		}


		function startCountdown(_time) {
			$('#input-container').hide();
			$('.countdown-container-<?php echo esc_attr( $product->get_id() ); ?>').show();

			displayValue(mainElement + ' #js-days', _time.days);
			displayValue(mainElement + ' #js-hours', _time.hours);
			displayValue(mainElement + ' #js-minutes', _time.minutes);
			displayValue(mainElement + ' #js-seconds', _time.seconds);

			interval = setInterval(function () {
				if (_time.seconds > 0) {
					_time.seconds--;
					displayValue(mainElement + ' #js-seconds', _time.seconds);
				} else {
					// Seconds is zero - check the minutes
					if (_time.minutes > 0) {
						_time.minutes--;
						_time.seconds = 59;
						updateValues('minutes', _time);
					} else {
						// Minutes is zero, check the hours
						if (_time.hours > 0) {
							_time.hours--;
							_time.minutes = 59;
							_time.seconds = 59;
							updateValues('hours', _time);
						} else {
							// Hours is zero
							_time.days--;
							_time.hours = 23;
							_time.minutes = 59;
							_time.seconds = 59;
							updateValues('days', _time);
						}
						// $('#js-countdown').addClass('remove');
						// $('#js-next-container').addClass('bigger');
					}
				}
			}, 1000);


			if (_time.total < 1) {
				$(mainElement + ' #js-days').html('00');
				$(mainElement + ' #js-hours').html('00');
				$(mainElement + ' #js-minutes').html('00');
				$(mainElement + ' #js-seconds').html('00');

				clearInterval(interval);
			}
		}


		function updateValues(context, _time) {
			if (context === 'days') {
				displayValue(mainElement + ' #js-days', _time.days);
				displayValue(mainElement + ' #js-hours', _time.hours);
				displayValue(mainElement + ' #js-minutes', _time.minutes);
				displayValue(mainElement + ' #js-seconds', _time.seconds);
			} else if (context === 'hours') {
				displayValue(mainElement + ' #js-hours', _time.hours);
				displayValue(mainElement + ' #js-minutes', _time.minutes);
				displayValue(mainElement + ' #js-seconds', _time.seconds);
			} else if (context === 'minutes') {
				displayValue(mainElement + ' #js-minutes', _time.minutes);
				displayValue(mainElement + ' #js-seconds', _time.seconds);
			}
		}

		function displayValue(target, value) {
			var newDigit = $('<span></span>');
			$(newDigit).text(pad(value))
				.addClass('new');
			$(target).prepend(newDigit);
			$(target).find('.current').addClass('old').removeClass('current');
			setTimeout(function () {
				$(target).find('.old').remove();
				$(target).find('.new').addClass('current').removeClass('new');
			}, 900);
		}

		function pad(number) {
			return ("0" + number).slice(-2);
		}

		// progress bar css.
		$('.progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.bar').css('background', '<?php echo esc_attr( $settings['progress_bar_secondary_color'] ); ?>');
		$('.progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('background', '<?php echo esc_attr( $settings['progress_bar_primary_color'] ); ?>');
		$('.progress-bar-<?php echo esc_attr( $product->get_id() ); ?>').find('.progress').css('width', '<?php echo esc_attr( $settings['progress_bar_percentage'] ); ?>');
	});
</script>
