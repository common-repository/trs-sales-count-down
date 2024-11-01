<?php
/**
 * This file has all the code that will run on the backend. So, this file is treated as for backend functionalities.
 *
 * @file class-trs-sales-count-down-backend.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'TRS_Sales_Count_Down_Backend' ) ) {
	/**
	 * The class for the backend operation.
	 * Class TRS_Sales_Count_Down_Backend
	 */
	class TRS_Sales_Count_Down_Backend {

		/**
		 * To hook all the backend related options/settings and other things.
		 * TRS_Sales_Count_Down_Backend constructor.
		 */
		public function __construct() {
			add_action( 'woocommerce_product_options_general_product_data', array( $this, 'add_custom_fields_on_general_tab' ) ); // After all General default fields.
			add_action( 'woocommerce_process_product_meta', array( $this, 'save_fields' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );

			add_action( 'admin_menu', array( $this, 'create_plugin_settings_page' ) );
			add_action( 'admin_init', array( $this, 'register_settings_for_plugin' ) );
		}

		/**
		 * Enqueuing the required scripts / styles.
		 */
		public function enqueue() {
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script( 'wp-color-picker' );

			wp_register_style( 'trs_sales_count_down_backend', plugins_url( 'assets/css/backend.css', TRS_Sales_Count_Down::$plugin_file_base ), array(), '1.0' );
			wp_enqueue_style( 'trs_sales_count_down_backend' );

			wp_register_script( 'trs_sales_count_down_backend', plugins_url( 'assets/js/backend.js', TRS_Sales_Count_Down::$plugin_file_base ), array( 'jquery' ), '1.0', true );
			wp_enqueue_script( 'trs_sales_count_down_backend' );
		}

		/**
		 * Adding some Plugin settings related fields on Woocommerce General Tab.
		 */
		public function add_custom_fields_on_general_tab() {
			global $post;

			echo '<div class="option_group trs_sales_count_down_options">';
			echo wp_sprintf( '%s %s %s', '<strong style="margin: 3px 6px; padding: 8px; display: block; text-shadow: 2px 2px 3px lightgrey">', __( 'Sales Count Down Options', 'trs' ), '</strong>' ); // phpcs:ignore

			// Do we need to display Sales Count Down?
			woocommerce_wp_select(
				array(
					'id'          => '_trs_sales_count_down__override_global_settings',
					'label'       => __( 'Override Global Settings', 'woocommerce' ),
					'options'     => array(
						'no'  => __( 'No', 'woocommerce' ),
						'yes' => __( 'Yes', 'woocommerce' ),
					),
					'desc_tip'    => true,
					'description' => __( 'Do you want to over ride global settings?', 'woothemes' ),

				)
			);

			echo '<div class="sales_count_down_options">';

			// Count Down Position.
			woocommerce_wp_select(
				array(
					'id'          => '_trs_sales_count_down__count_down_position',
					'label'       => __( 'Count Down Position', 'woocommerce' ),
					'options'     => array(
						'below_add_to_cart' => __( 'Below Add to Cart', 'woocommerce' ),
						'above_title'       => __( 'Above the Title', 'woocommerce' ),
						'below_title'       => __( 'Below the Title', 'woocommerce' ),
						'below_price'       => __( 'Below the Price', 'woocommerce' ),
						'below_short_desc'  => __( 'Below Short Description', 'woocommerce' ),
					),
					'desc_tip'    => true,
					'description' => __( 'Only works on Single Product Page. Select the position where you want to display the count down.', 'woothemes' ),
				)
			);

			// Style Type.
			woocommerce_wp_select(
				array(
					'id'          => '_trs_sales_count_down__style_type',
					'label'       => __( 'Select Style', 'woocommerce' ),
					'options'     => array(
						'simple' => __( 'Simple', 'woocommerce' ),
						'nobe' => __( 'Nobe', 'woocommerce' ),
						'flyout' => __( 'Fly Out', 'woocommerce' ),
						'fancy'  => __( 'Fancy', 'woocommerce' ),
						'whiteblock'  => __( 'White Block', 'woocommerce' ),
						'flipmodern'  => __( 'Flip Modern', 'woocommerce' ),
					),
					'desc_tip'    => true,
					'description' => __( 'Select the Style for the Sales Count Down', 'woothemes' ),
				)
			);

			echo '<div id="style-wrapper">';
			echo '<div id="flyout" class="hidden"><img src="' . esc_attr( plugins_url( 'assets/images/fly-out-styles.png', TRS_Sales_Count_Down::$plugin_file_base ) ) . '" width=100 alt="Fly Out Style"/></div>';
			echo '<div id="fancy" class="hidden"><img src="' . esc_attr( plugins_url( 'assets/images/fancy-style.png', TRS_Sales_Count_Down::$plugin_file_base ) ) . '" width=100 alt="Fly Out Style"/></div>';
			echo '<div id="simple" class="hidden"><img src="' . esc_attr( plugins_url( 'assets/images/simple-style.png', TRS_Sales_Count_Down::$plugin_file_base ) ) . '" width=100 alt="Simple Style"/></div>';
			echo '<div id="nobe" class="hidden"><img src="' . esc_attr( plugins_url( 'assets/images/nobe-style.png', TRS_Sales_Count_Down::$plugin_file_base ) ) . '" width=100 alt="Nobe Style"/></div>';
			echo '<div id="whiteblock" class="hidden"><img src="' . esc_attr( plugins_url( 'assets/images/white-block.png', TRS_Sales_Count_Down::$plugin_file_base ) ) . '" width=100 alt="White Block Style"/></div>';
			echo '<div id="flipmodern" class="hidden"><img src="' . esc_attr( plugins_url( 'assets/images/flip-modern.png', TRS_Sales_Count_Down::$plugin_file_base ) ) . '" width=100 alt="Flip Modern Style"/></div>';
			echo '</div>';

			// Display on Listing Page.
			woocommerce_wp_select(
				array(
					'id'          => '_trs_sales_count_down__display_on_listing_page',
					'label'       => __( 'Display on Listing page?', 'woocommerce' ),
					'options'     => array(
						'yes' => __( 'Yes', 'woocommerce' ),
						'no'  => __( 'No', 'woocommerce' ),
					),
					'desc_tip'    => true,
					'description' => __( 'Do you want to display the sales count down for this product on listing page?', 'woothemes' ),
				)
			);

			// Display count down after expiring.
			woocommerce_wp_select(
				array(
					'id'          => '_trs_sales_count_down__display_after_expiring',
					'label'       => __( 'Displays after Expiring', 'woocommerce' ),
					'options'     => array(
						'no'  => __( 'No', 'woocommerce' ),
						'yes' => __( 'yes', 'woocommerce' ),
					),
					'desc_tip'    => true,
					'description' => __( 'Only works if Sale is expried. Do you want to count down should displays even after time expires?', 'woothemes' ),
				)
			);

			woocommerce_wp_select(
				array(
					'id'          => '_trs_sales_count_down__display_progress_bar',
					'label'       => __( 'Display Progress bar?', 'woocommerce' ),
					'options'     => array(
						'no'  => __( 'No', 'woocommerce' ),
						'yes' => __( 'Yes', 'woocommerce' ),
					),
					'desc_tip'    => true,
					'description' => __( 'Do you want to display the progress bar?', 'woothemes' ),
				)
			);

			// progress bar text.
			woocommerce_wp_text_input(
				array(
					'id'          => '_trs_sales_count_down__progress_bar_text',
					'label'       => __( 'Progress Bar Text', 'woocommerce' ),
					'placeholder' => 'Only 49 left in stock',
					'desc_tip'    => true,
					'description' => __( 'You can write any text that you want to display for Progress Bar.', 'woocommerce' ),
				)
			);

			// progress bar primary color.
			$primary_color = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__progress_bar_primary_color', true ) );
			woocommerce_wp_text_input(
				array(
					'id'          => '_trs_sales_count_down__progress_bar_primary_color',
					'label'       => __( 'Progress Bar Color', 'woocommerce' ),
					'placeholder' => '#75b800',
					'value'       => empty( $primary_color ) ? '#75b800' : $primary_color,
					'desc_tip'    => false,
					'description' => __( 'Select the primary color for the progress bar.', 'woocommerce' ),
				)
			);

			// progress bar secondary color.
			$secondary_color = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__progress_bar_secondary_color', true ) );
			woocommerce_wp_text_input(
				array(
					'id'          => '_trs_sales_count_down__progress_bar_secondary_color',
					'label'       => __( 'Progress Bar Secondary Color', 'woocommerce' ),
					'placeholder' => '#eeeeee',
					'value'       => empty( $secondary_color ) ? '#eeeeee' : $secondary_color,
					'desc_tip'    => false,
					'description' => __( 'Select the secondary color for the progress bar.', 'woocommerce' ),
				)
			);

			// progress bar percentage.
			$progress_percentage = esc_attr( get_post_meta( $post->ID, '_trs_sales_count_down__progress_bar_percentage', true ) );
			woocommerce_wp_select(
				array(
					'id'          => '_trs_sales_count_down__progress_bar_percentage',
					'label'       => __( 'Progress bar percentage', 'woocommerce' ),
					'options'     => array(
						'10%' => __( '10%', 'woocommerce' ),
						'20%' => __( '20', 'woocommerce' ),
						'30%' => __( '30', 'woocommerce' ),
						'40%' => __( '40', 'woocommerce' ),
						'50%' => __( '50', 'woocommerce' ),
						'60%' => __( '60', 'woocommerce' ),
						'70%' => __( '70', 'woocommerce' ),
						'80%' => __( '80', 'woocommerce' ),
						'90%' => __( '90', 'woocommerce' ),
					),
					'desc_tip'    => true,
					'description' => __( 'Select the progress percentage', 'woothemes' ),
				)
			);

			echo '</div> <!-- sales_count_down_options ends -->';
			echo '</div><!-- Options group ends -->';
		}

		/**
		 * Saving the custom fields.
		 *
		 * @param int $post_id The current post ID.
		 */
		public function save_fields( $post_id ) {
			$override_countdown = filter_input( INPUT_POST, '_trs_sales_count_down__override_global_settings' );
			update_post_meta( $post_id, '_trs_sales_count_down__override_global_settings', esc_attr( $override_countdown ) );

			$style_type = filter_input( INPUT_POST, '_trs_sales_count_down__style_type' );
			update_post_meta( $post_id, '_trs_sales_count_down__style_type', esc_attr( $style_type ) );

			$display_on_listing = filter_input( INPUT_POST, '_trs_sales_count_down__display_on_listing_page' );
			update_post_meta( $post_id, '_trs_sales_count_down__display_on_listing_page', esc_attr( $display_on_listing ) );

			$display_after_expiring = filter_input( INPUT_POST, '_trs_sales_count_down__display_after_expiring' );
			update_post_meta( $post_id, '_trs_sales_count_down__display_after_expiring', esc_attr( $display_after_expiring ) );

			$count_down_position = filter_input( INPUT_POST, '_trs_sales_count_down__count_down_position' );
			update_post_meta( $post_id, '_trs_sales_count_down__count_down_position', esc_attr( $count_down_position ) );

			$display_progress_bar = filter_input( INPUT_POST, '_trs_sales_count_down__display_progress_bar' );
			update_post_meta( $post_id, '_trs_sales_count_down__display_progress_bar', esc_attr( $display_progress_bar ) );

			$progress_bar_text = filter_input( INPUT_POST, '_trs_sales_count_down__progress_bar_text' );
			update_post_meta( $post_id, '_trs_sales_count_down__progress_bar_text', esc_attr( $progress_bar_text ) );

			$progress_bar_primary_color = filter_input( INPUT_POST, '_trs_sales_count_down__progress_bar_primary_color' );
			update_post_meta( $post_id, '_trs_sales_count_down__progress_bar_primary_color', esc_attr( $progress_bar_primary_color ) );

			$progress_bar_secondary_color = filter_input( INPUT_POST, '_trs_sales_count_down__progress_bar_secondary_color' );
			update_post_meta( $post_id, '_trs_sales_count_down__progress_bar_secondary_color', esc_attr( $progress_bar_secondary_color ) );

			$progress_bar_percentage = filter_input( INPUT_POST, '_trs_sales_count_down__progress_bar_percentage' );
			update_post_meta( $post_id, '_trs_sales_count_down__progress_bar_percentage', esc_attr( $progress_bar_percentage ) );
		}

		/**
		 * Initialize the plugin setting page in admin menu.
		 */
		public function create_plugin_settings_page() {
			add_menu_page(
				__( 'Sales Count Down - Settings', 'trs' ),
				__( 'Sales Count Down', 'trs' ),
				'manage_options',
				'trs-sales-count-down-settings',
				array( $this, 'plugin_setting_page_content' ),
				'dashicons-clock',
				65
			);
		}

		/**
		 * Callback / contents for the plugin settings page.
		 */
		public function plugin_setting_page_content() {
			ob_start();
			require_once TRS_Sales_Count_Down::$plugin_path . DIRECTORY_SEPARATOR . 'contents' . DIRECTORY_SEPARATOR . 'settings.php';
			echo ob_get_clean(); // phpcs:ignore
		}

		/**
		 * Plugin options that will store into database.
		 */
		public function register_settings_for_plugin() {
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__count_down_position' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__style_type' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__display_on_listing_page' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__display_after_expiring' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__display_progress_bar' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__progress_bar_text' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__progress_bar_primary_color' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__progress_bar_secondary_color' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__progress_bar_percentage' );
			register_setting( '_trs_sales_count_down', '_trs_sales_count_down__time_zone' );
		}
	}

	new TRS_Sales_Count_Down_Backend();
}
