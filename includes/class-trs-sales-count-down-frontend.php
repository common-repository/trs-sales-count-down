<?php
/**
 * This file has all the code that will run on the front end. So, this file is treated as for front end settings.
 *
 * @file class-trs-sales-count-down-frontend.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'TRS_Sales_Count_Down_Frontend' ) ) {
	/**
	 * The class that will handles all front end related stuffs.
	 * Class TRS_Sales_Count_Down_Frontend
	 */
	class TRS_Sales_Count_Down_Frontend {

		/**
		 * Hooking all the required things in the constructor.
		 * TRS_Sales_Count_Down_Frontend constructor.
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'wp', array( $this, 'hook_display_count_down_on_single_page' ) );

			add_action( 'woocommerce_loop_add_to_cart_link', array( $this, 'display_count_down_on_listing_page' ), 10, 3 );
		}

		/**
		 * The hook that will call another hook to show the count down on the required location.
		 */
		public function hook_display_count_down_on_single_page() {
			$settings = $this->get_vars();

			if ( 'below_title' === $settings['count_down_position'] ) {
				add_action( 'woocommerce_single_product_summary', array( $this, 'display_count_down_on_single_page' ), 7 );
			} elseif ( 'above_title' === $settings['count_down_position'] ) {
				add_action( 'woocommerce_single_product_summary', array( $this, 'display_count_down_on_single_page' ), 2 );
			} elseif ( 'below_price' === $settings['count_down_position'] ) {
				add_action( 'woocommerce_single_product_summary', array( $this, 'display_count_down_on_single_page' ), 15 );
			} elseif ( 'below_short_desc' === $settings['count_down_position'] ) {
				add_action( 'woocommerce_single_product_summary', array( $this, 'display_count_down_on_single_page' ), 20 );
			} elseif ( 'below_add_to_cart' === $settings['count_down_position'] ) {
				add_action( 'woocommerce_after_add_to_cart_form', array( $this, 'display_count_down_on_single_page' ), 10 );
			}
		}

		/**
		 * The actual function that will display the count down on single page.
		 */
		public function display_count_down_on_single_page() {
		    global $post;

			if ( $this->is_sale_dates_empty() ) {
				return;
			}

			$settings = $this->get_vars();

			if ( $this->is_expired() ) {
				if ( empty( $settings['displays_after_expiring'] ) || 'no' === $settings['displays_after_expiring'] ) {
					return;
				}
			}

			ob_start();

			if ( 'flyout' === $settings['style'] ) {
				include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/flyout.php';
			} elseif ( 'fancy' === $settings['style'] ) {
				include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/fancy.php';
			}else if ( 'simple' === $settings['style'] ){
			    include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/simple.php';
            }else if ( 'nobe' === $settings['style'] ){
                include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/nobe.php';
            }else if ( 'whiteblock' === $settings['style'] ){
                include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/whiteblock.php';
            }else if ( 'flipmodern' === $settings['style'] ){
                include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/flipmodern.php';
            }

			echo ob_get_clean(); // phpcs:ignore
		}

		/**
		 * Displays the count down on listing / loop page.
		 *
		 * @param string     $add_to_cart_html The add to cart button html.
		 * @param WC_Product $product Current Product.
		 * @param array      $args Arguments array.
		 * @return string
		 */
		public function display_count_down_on_listing_page( $add_to_cart_html, $product, $args ) {
			if ( $this->is_sale_dates_empty() ) {
				return $add_to_cart_html;
			}

			$settings = $this->get_vars();

			if ( empty( $settings['display_on_listing'] ) || 'no' === $settings['display_on_listing'] ) {
				return $add_to_cart_html;
			}

			if ( $this->is_expired() ) {
				if ( empty( $settings['displays_after_expiring'] ) || 'no' === $settings['displays_after_expiring'] ) {
					return $add_to_cart_html;
				}
			}

			ob_start();

			if ( 'flyout' === $settings['style'] ) {
				include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/flyout.php';
			} elseif ( 'fancy' === $settings['style'] ) {
				include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/fancy.php';
			}else if ( 'simple' === $settings['style'] ){
                include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/simple.php';
            }else if ( 'nobe' === $settings['style'] ){
                include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/nobe.php';
            }else if ( 'whiteblock' === $settings['style'] ){
                include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/whiteblock.php';
            }else if ( 'flipmodern' === $settings['style'] ){
                include TRS_Sales_Count_Down::$plugin_path . 'contents/count-down/flipmodern.php';
            }

			$after = ob_get_clean();

			return $add_to_cart_html . $after;
		}

		/**
		 * Enqueuing the required scripts and styles.
		 */
		public function enqueue_scripts() {
			/**
			 * Progress Bars
			 */
			wp_register_style( 'progress-bar-style1', plugins_url( 'assets/css/progress-bar-style1.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), '1.0' );

            /**
			 * Flyout Style
			 */
			wp_register_style( 'flyout-countdown-style', plugins_url( 'assets/css/flyout/style.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), '1.0' );

            /**
             * White Block Style
             */
            wp_register_style( 'white-block-countdown-countdown', plugins_url( 'assets/css/whiteblock/style.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), time() );

            /**
             * Flip Modern Style
             */
            wp_register_style( 'flip-clock', plugins_url( 'assets/css/flip-modern/flipclock.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), time() );
            wp_register_style( 'modern-flip-main', plugins_url( 'assets/css/flip-modern/main.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), time() );
            wp_register_script( 'modern-flipclock', plugins_url('assets/js/modern-flipclock.min.js', TRS_Sales_Count_Down::$plugin_file_base), array('jquery'), '1.0', true);
            wp_register_script( 'modern-flipclock-countdown', plugins_url('assets/js/countdowntime.js', TRS_Sales_Count_Down::$plugin_file_base), array('jquery'), '1.0', true);


            /**
			 * Fancy Style
			 */
			wp_register_style( 'fancy-countdown-style', plugins_url( 'assets/css/fancy/style.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), '1.0' );

			/**
             * Simple Style
             */
            wp_register_style( 'simple-countdown-countdown', plugins_url( 'assets/css/simple/style.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), '1.0' );

		    /**
             * Nobe Style
             */
            wp_register_style( 'nobe-countdown-countdown', plugins_url( 'assets/css/nobe/style.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), time() );

		    /**
             * jQuery CountDown JS
             */
            wp_register_script( 'jquery-countdown', plugins_url('assets/js/jquery.countdown.js', TRS_Sales_Count_Down::$plugin_file_base), array('jquery'), '1.0', true);

            /**
             * Frontend JS
             */
            wp_register_script( 'trs_sales_count_down-frontend', plugins_url('assets/js/frontend.js', TRS_Sales_Count_Down::$plugin_file_base), array('jquery', 'jquery-countdown'), '1.0', true);
            wp_enqueue_script('trs_sales_count_down-frontend');
        }

		/**
		 * Get settings for the count down.
		 *
		 * @return array
		 */
		private function get_vars() {
			global $post;

			$override_count_down_settings = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__override_global_settings', true ) );

			if ( 'yes' === $override_count_down_settings ) {
				$style                   = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__style_type', true ) );
				$display_on_listing      = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__display_on_listing_page', true ) );
				$display_after_expiring  = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__display_after_expiring', true ) );
				$count_down_position     = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__count_down_position', true ) );
				$display_progress_bar    = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__display_progress_bar', true ) );
				$progress_bar_text       = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__progress_bar_text', true ) );
				$bar_primary_color       = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__progress_bar_primary_color', true ) );
				$bar_secondary_color     = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__progress_bar_secondary_color', true ) );
				$progress_bar_percentage = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__progress_bar_percentage', true ) );
			} else {
				$style                   = esc_attr( get_option( '_trs_sales_count_down__style_type' ) );
				$display_on_listing      = esc_attr( get_option( '_trs_sales_count_down__display_on_listing_page' ) );
				$display_after_expiring  = esc_attr( get_option( '_trs_sales_count_down__display_after_expiring' ) );
				$count_down_position     = esc_attr( get_option( '_trs_sales_count_down__count_down_position' ) );
				$display_progress_bar    = esc_attr( get_option( '_trs_sales_count_down__display_progress_bar' ) );
				$progress_bar_text       = esc_attr( get_option( '_trs_sales_count_down__progress_bar_text' ) );
				$bar_primary_color       = esc_attr( get_option( '_trs_sales_count_down__progress_bar_primary_color' ) );
				$bar_secondary_color     = esc_attr( get_option( '_trs_sales_count_down__progress_bar_secondary_color' ) );
				$progress_bar_percentage = esc_attr( get_option( '_trs_sales_count_down__progress_bar_percentage' ) );
			}

			$sale_start = '';
			$sale_ends  = '';

			$date = get_post_meta( $post->ID, '_sale_price_dates_from', true );
			if ( $date ) {
				$sale_start = date_i18n( 'Y-m-d H:i:s', $date );
			}

			$date = get_post_meta( $post->ID, '_sale_price_dates_to', true );
			if ( $date ) {
				$sale_ends = date_i18n( 'Y-m-d H:i:s', $date );
			}

			return [
				'override_global_settings'     => $override_count_down_settings,
				'style'                        => $style,
				'sale_start'                   => $sale_start,
				'sale_ends'                    => $sale_ends,
				'display_on_listing'           => $display_on_listing,
				'displays_after_expiring'      => $display_after_expiring,
				'count_down_position'          => $count_down_position,
				'progress_bar_text'            => $progress_bar_text,
				'display_progress_bar'         => $display_progress_bar,
				'progress_bar_primary_color'   => $bar_primary_color,
				'progress_bar_secondary_color' => $bar_secondary_color,
				'progress_bar_percentage'      => $progress_bar_percentage,
			];
		}

		/**
		 * Checks if the sale dates are empty or the product is not on sale.
		 *
		 * @return bool
		 */
		private function is_sale_dates_empty() {
			$data = $this->get_vars();

			if ( empty( $data['sale_start'] ) || empty( $data['sale_ends'] ) ) {
				return true;
			}

			return false;
		}

		/**
		 * Checks if the sale date is expired or not.
		 *
		 * @return bool
		 */
		private function is_expired() {
			$dates = $this->calculate_dates();

			if ( 0 === $dates->days && 0 === $dates->hours && 0 === $dates->minutes && 0 === $dates->seconds ) {
				return true;
			}

			return false;
		}

        private function get_time_zone()
        {
            $tz = esc_attr( get_option('_trs_sales_count_down__time_zone') );

            if ( empty( $tz ) ){
                return date_default_timezone_get();
            }

            return $tz;
		}

        /**
         * This functions does the heavy lifting. Calculating Dates.
         * @param WC_Product $product The product of the product.
         * @param bool $subtract_one_month_as_per_native_js Do we need to subtract one month from the months as per native JS months starts from 0.
         * @return bool|object
         */
		private function calculate_dates($subtract_one_month_as_per_native_js = true) {
			if ( $this->is_sale_dates_empty() ) {
				return false;
			}

			$time_zone = $this->get_time_zone();

			$settings = $this->get_vars();

			$_now       = \Carbon\Carbon::now( $time_zone );
			$sales_ends = \Carbon\Carbon::createFromFormat( 'Y-m-d H:i:s', ( $settings['sale_ends'] ), $time_zone );

			$month   = intval( $sales_ends->format( 'm' ) );
			$minutes = \Carbon\Carbon::now( $time_zone )->diffInMinutes( Carbon\Carbon::parse( $sales_ends ), false );
			$seconds = \Carbon\Carbon::now( $time_zone )->diffInSeconds( Carbon\Carbon::parse( $sales_ends ), false );
			$hours   = \Carbon\Carbon::now( $time_zone )->diffInHours( Carbon\Carbon::parse( $sales_ends ), false );
			$days    = \Carbon\Carbon::now( $time_zone )->diffInDays( Carbon\Carbon::parse( $sales_ends ), false );

			if ($month > 0 && $subtract_one_month_as_per_native_js){
			    $month = $month - 1;
            }

			return (object) [
				'y'       => $sales_ends->format( 'Y' ),
				'm'       => $month,
				'd'       => intval( $sales_ends->format( 'd' ) ),
				'h'       => $sales_ends->format( 'H' ),
				'i'       => $sales_ends->format( 'i' ),
				's'       => $sales_ends->format( 's' ),

				'days'    => ( $days <= 0 ) ? 0 : $days,
				'hours'   => ( $hours <= 0 ) ? 0 : $hours,
				'minutes' => ( $minutes <= 0 ) ? 0 : $minutes,
				'seconds' => ( $seconds <= 0 ) ? 0 : $seconds,
			];
		}
	}

	new TRS_Sales_Count_Down_Frontend();
}
