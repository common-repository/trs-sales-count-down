<?php
/**
 * This file is the has all the settings and options for the plugin.
 *
 * @file settings.php
 * @package WooSalesCountDown
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Sales Count Down - Settings', 'trs' ); ?></h1>
		<form action="options.php" method="post">
			<?php
			settings_errors();
			settings_fields( '_trs_sales_count_down' );
			do_settings_sections( '_trs_sales_count_down' );
			?>
			<table class="form-table">
				<tr>
					<th>
						<label for="_trs_sales_count_down__count_down_position"><?php esc_html_e( 'Count Down Position', 'trs' ); ?></label>
					</th>
					<td><?php $value = esc_attr( get_option( '_trs_sales_count_down__count_down_position' ) ); ?>
						<select name="_trs_sales_count_down__count_down_position" id="_trs_sales_count_down__count_down_position">
							<option <?php selected( $value, 'below_add_to_cart', true ); ?> value="below_add_to_cart"><?php esc_html_e( 'Below Add to Cart', 'trs' ); ?></option>
							<option <?php selected( $value, 'above_title', true ); ?> value="above_title"><?php esc_html_e( 'Above the Title', 'trs' ); ?></option>
							<option <?php selected( $value, 'below_title', true ); ?> value="below_title"><?php esc_html_e( 'Below the Title', 'trs' ); ?></option>
							<option <?php selected( $value, 'below_price', true ); ?> value="below_price"><?php esc_html_e( 'Below the Price', 'trs' ); ?></option>
							<option <?php selected( $value, 'below_short_desc', true ); ?> value="below_short_desc"><?php esc_html_e( 'Below Short Description', 'trs' ); ?></option>
						</select>
					</td>
				</tr>

				<tr>
					<th>
						<label for="_trs_sales_count_down__style_type"><?php esc_html_e( 'Select Style Type', 'trs' ); ?></label>
					</th>
					<td><?php $value = esc_attr( get_option( '_trs_sales_count_down__style_type' ) ); ?>
						<select name="_trs_sales_count_down__style_type" id="_trs_sales_count_down__style_type">
							<option <?php selected( $value, 'simple', true ); ?> value="simple"><?php esc_html_e( 'Simple', 'trs' ); ?></option>
                            <option <?php selected( $value, 'nobe', true ); ?> value="nobe"><?php esc_html_e( 'Nobe', 'trs' ); ?></option>
                            <option <?php selected( $value, 'flyout', true ); ?> value="flyout"><?php esc_html_e( 'Flyout', 'trs' ); ?></option>
                            <option <?php selected( $value, 'fancy', true ); ?> value="fancy"><?php esc_html_e( 'Fancy', 'trs' ); ?></option>
                            <option <?php selected( $value, 'whiteblock', true ); ?> value="whiteblock"><?php esc_html_e( 'White Block', 'trs' ); ?></option>
                            <option <?php selected( $value, 'flipmodern', true ); ?> value="flipmodern"><?php esc_html_e( 'Flip Modern', 'trs' ); ?></option>
						</select>

						<div class="style-image-wrapper" style="padding: 10px 0;">
							<div id="flyout" class="hidden">
								<img src="<?php echo esc_attr( plugins_url( 'assets/images/fly-out-styles.png', TRS_Sales_Count_Down::$plugin_file_base ) ); ?>" alt="Flyout style">
							</div>
							<div id="fancy" class="hidden">
								<img src="<?php echo esc_attr( plugins_url( 'assets/images/fancy-style.png', TRS_Sales_Count_Down::$plugin_file_base ) ); ?>" alt="Fancy style">
							</div>
                            <div id="simple" class="hidden">
                                <img src="<?php echo esc_attr( plugins_url( 'assets/images/simple-style.png', TRS_Sales_Count_Down::$plugin_file_base ) ); ?>" alt="Simple style">
                            </div>
                            <div id="nobe" class="hidden">
                                <img src="<?php echo esc_attr( plugins_url( 'assets/images/nobe-style.png', TRS_Sales_Count_Down::$plugin_file_base ) ); ?>" alt="Nobe style">
                            </div>
                            <div id="whiteblock" class="hidden">
                                <img src="<?php echo esc_attr( plugins_url( 'assets/images/white-block.png', TRS_Sales_Count_Down::$plugin_file_base ) ); ?>" alt="White Block style">
                            </div>
                            <div id="flipmodern" class="hidden">
                                <img src="<?php echo esc_attr( plugins_url( 'assets/images/flip-modern.png', TRS_Sales_Count_Down::$plugin_file_base ) ); ?>" alt="Flip Modern style">
                            </div>
						</div>
					</td>
				</tr>

				<tr>
					<th>
						<label for="_trs_sales_count_down__display_on_listing_page"><?php esc_html_e( 'Display on Listing Page', 'trs' ); ?></label>
					</th>
					<td><?php $value = esc_attr( get_option( '_trs_sales_count_down__display_on_listing_page' ) ); ?>
						<select name="_trs_sales_count_down__display_on_listing_page" id="_trs_sales_count_down__display_on_listing_page">
							<option <?php selected( $value, 'yes', true ); ?> value="yes"><?php esc_html_e( 'Yes', 'trs' ); ?></option>
							<option <?php selected( $value, 'no', true ); ?> value="no"><?php esc_html_e( 'No', 'trs' ); ?></option>
						</select>
					</td>
				</tr>

				<tr>
					<th>
						<label for="_trs_sales_count_down__display_after_expiring"><?php esc_html_e( 'Display after Expiring?', 'trs' ); ?></label>
					</th>
					<td><?php $value = esc_attr( get_option( '_trs_sales_count_down__display_after_expiring' ) ); ?>
						<select name="_trs_sales_count_down__display_after_expiring" id="_trs_sales_count_down__display_after_expiring">
							<option <?php selected( $value, 'no', true ); ?> value="no"><?php esc_html_e( 'No', 'trs' ); ?></option>
							<option <?php selected( $value, 'yes', true ); ?> value="yes"><?php esc_html_e( 'Yes', 'trs' ); ?></option>
						</select>
					</td>
				</tr>

				<tr>
					<th>
						<label for="_trs_sales_count_down__display_progress_bar"><?php esc_html_e( 'Display Progress bar?', 'trs' ); ?></label>
					</th>
					<td><?php $value = esc_attr( get_option( '_trs_sales_count_down__display_progress_bar' ) ); ?>
						<select name="_trs_sales_count_down__display_progress_bar" id="_trs_sales_count_down__display_progress_bar">
							<option <?php selected( $value, 'no', true ); ?> value="no"><?php esc_html_e( 'No', 'trs' ); ?></option>
							<option <?php selected( $value, 'yes', true ); ?> value="yes"><?php esc_html_e( 'Yes', 'trs' ); ?></option>
						</select>
					</td>
				</tr>

				<tr class="show_if_display_progress_bar">
					<th>
						<label for="_trs_sales_count_down__progress_bar_text"><?php esc_html_e( 'Progress bar text', 'trs' ); ?></label>
					</th>
					<td><?php $value = esc_attr( get_option( '_trs_sales_count_down__progress_bar_text' ) ); ?>
						<input type="text" class="_trs_sales_count_down__progress_bar_text" placeholder="Only 49 left in stock" id="_trs_sales_count_down__progress_bar_text" name="_trs_sales_count_down__progress_bar_text" value="<?php echo esc_attr( $value ); ?>">
						<span class="help"><?php esc_attr_e( 'You can write any text that you want to display for Progress Bar.', 'trs' ); ?></span>
					</td>
				</tr>

				<tr class="show_if_display_progress_bar">
					<th>
						<label for="_trs_sales_count_down__progress_bar_primary_color"><?php esc_html_e( 'Progress bar primary color', 'trs' ); ?></label>
					</th>
					<td>
						<?php
						$value     = esc_attr( get_option( '_trs_sales_count_down__progress_bar_primary_color' ) );
							$value = empty( $value ) ? '#75b800' : $value;
						?>
						<input type="text" class="_trs_sales_count_down__progress_bar_primary_color" id="_trs_sales_count_down__progress_bar_primary_color" name="_trs_sales_count_down__progress_bar_primary_color" value="<?php echo esc_attr( $value ); ?>">
					</td>
				</tr>

				<tr class="show_if_display_progress_bar">
					<th>
						<label for="_trs_sales_count_down__progress_bar_secondary_color"><?php esc_html_e( 'Progress bar secondary color', 'trs' ); ?></label>
					</th>
					<td>
						<?php
							$value = esc_attr( get_option( '_trs_sales_count_down__progress_bar_secondary_color' ) );
							$value = empty( $value ) ? '#eeeeee' : $value;
						?>
						<input type="text" class="_trs_sales_count_down__progress_bar_secondary_color" id="_trs_sales_count_down__progress_bar_secondary_color" name="_trs_sales_count_down__progress_bar_secondary_color" value="<?php echo esc_attr( $value ); ?>">
					</td>
				</tr>

				<tr class="show_if_display_progress_bar">
					<th>
						<label for="_trs_sales_count_down__progress_bar_percentage"><?php esc_html_e( 'Display Progress percentage', 'trs' ); ?></label>
					</th>
					<td><?php $value = esc_attr( get_option( '_trs_sales_count_down__progress_bar_percentage' ) ); ?>
						<select name="_trs_sales_count_down__progress_bar_percentage" id="_trs_sales_count_down__progress_bar_percentage">
							<option <?php selected( $value, '10%', true ); ?> value="10%"><?php esc_html_e( '10%', 'trs' ); ?></option>
							<option <?php selected( $value, '20%', true ); ?> value="20%"><?php esc_html_e( '20%', 'trs' ); ?></option>
							<option <?php selected( $value, '30%', true ); ?> value="30%"><?php esc_html_e( '30%', 'trs' ); ?></option>
							<option <?php selected( $value, '40%', true ); ?> value="40%"><?php esc_html_e( '40%', 'trs' ); ?></option>
							<option <?php selected( $value, '50%', true ); ?> value="50%"><?php esc_html_e( '50%', 'trs' ); ?></option>
							<option <?php selected( $value, '60%', true ); ?> value="60%"><?php esc_html_e( '60%', 'trs' ); ?></option>
							<option <?php selected( $value, '70%', true ); ?> value="70%"><?php esc_html_e( '70%', 'trs' ); ?></option>
							<option <?php selected( $value, '80%', true ); ?> value="80%"><?php esc_html_e( '80%', 'trs' ); ?></option>
							<option <?php selected( $value, '90%', true ); ?> value="90%"><?php esc_html_e( '90%', 'trs' ); ?></option>
							<option <?php selected( $value, '100%', true ); ?> value="100%"><?php esc_html_e( '100%', 'trs' ); ?></option>
						</select>
					</td>
				</tr>

                <tr>
                    <th>
                        <label for="_trs_sales_count_down__time_zone"><?php esc_html_e( 'Time Zone Setting', 'trs' ); ?></label>
                    </th>
                    <td><?php $value = esc_attr( get_option( '_trs_sales_count_down__time_zone' ) ); ?>
                        <select name="_trs_sales_count_down__time_zone" id="_trs_sales_count_down__time_zone">
                            <option></option>
                            <option <?php selected( $value, 'Etc/GMT+12', true ); ?> value="Etc/GMT+12">(GMT-12:00) International Date Line West</option>
                            <option <?php selected( $value, 'Pacific/Midway', true ); ?> value="Pacific/Midway">(GMT-11:00) Midway Island, Samoa</option>
                            <option <?php selected( $value, 'Pacific/Honolulu', true ); ?> value="Pacific/Honolulu">(GMT-10:00) Hawaii</option>
                            <option <?php selected( $value, 'US/Alaska', true ); ?> value="US/Alaska">(GMT-09:00) Alaska</option>
                            <option <?php selected( $value, 'America/Los_Angeles', true ); ?> value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                            <option <?php selected( $value, 'America/Tijuana', true ); ?> value="America/Tijuana">(GMT-08:00) Tijuana, Baja California</option>
                            <option <?php selected( $value, 'US/Arizona', true ); ?> value="US/Arizona">(GMT-07:00) Arizona</option>
                            <option <?php selected( $value, 'America/Chihuahua', true ); ?> value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                            <option <?php selected( $value, 'US/Mountain', true ); ?> value="US/Mountain">(GMT-07:00) Mountain Time (US & Canada)</option>
                            <option <?php selected( $value, 'America/Managua', true ); ?> value="America/Managua">(GMT-06:00) Central America</option>
                            <option <?php selected( $value, 'US/Central', true ); ?> value="US/Central">(GMT-06:00) Central Time (US & Canada)</option>
                            <option <?php selected( $value, 'America/Mexico_City', true ); ?> value="America/Mexico_City">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                            <option <?php selected( $value, 'Canada/Saskatchewan', true ); ?> value="Canada/Saskatchewan">(GMT-06:00) Saskatchewan</option>
                            <option <?php selected( $value, 'America/Bogota', true ); ?> value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                            <option <?php selected( $value, 'US/Eastern', true ); ?> value="US/Eastern">(GMT-05:00) Eastern Time (US & Canada)</option>
                            <option <?php selected( $value, 'US/East-Indiana', true ); ?> value="US/East-Indiana">(GMT-05:00) Indiana (East)</option>
                            <option <?php selected( $value, 'Canada/Atlantic', true ); ?> value="Canada/Atlantic">(GMT-04:00) Atlantic Time (Canada)</option>
                            <option <?php selected( $value, 'America/Caracas', true ); ?> value="America/Caracas">(GMT-04:00) Caracas, La Paz</option>
                            <option <?php selected( $value, 'America/Manaus', true ); ?> value="America/Manaus">(GMT-04:00) Manaus</option>
                            <option <?php selected( $value, 'America/Santiago', true ); ?> value="America/Santiago">(GMT-04:00) Santiago</option>
                            <option <?php selected( $value, 'Canada/Newfoundland', true ); ?> value="Canada/Newfoundland">(GMT-03:30) Newfoundland</option>
                            <option <?php selected( $value, 'America/Sao_Paulo', true ); ?> value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                            <option <?php selected( $value, 'America/Argentina/Buenos_Aires', true ); ?> value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires, Georgetown</option>
                            <option <?php selected( $value, 'America/Godthab', true ); ?> value="America/Godthab">(GMT-03:00) Greenland</option>
                            <option <?php selected( $value, 'America/Montevideo', true ); ?> value="America/Montevideo">(GMT-03:00) Montevideo</option>
                            <option <?php selected( $value, 'America/Noronha', true ); ?> value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                            <option <?php selected( $value, 'Atlantic/Cape_Verde', true ); ?> value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                            <option <?php selected( $value, 'Atlantic/Azores', true ); ?> value="Atlantic/Azores">(GMT-01:00) Azores</option>
                            <option <?php selected( $value, 'Africa/Casablanca', true ); ?> value="Africa/Casablanca">(GMT+00:00) Casablanca, Monrovia, Reykjavik</option>
                            <option <?php selected( $value, 'Etc/Greenwich', true ); ?> value="Etc/Greenwich">(GMT+00:00) Greenwich Mean Time : Dublin, Edinburgh, Lisbon, London</option>
                            <option <?php selected( $value, '"Europe/Amsterdam', true ); ?> value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                            <option <?php selected( $value, 'Europe/Belgrade', true ); ?> value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                            <option <?php selected( $value, 'Europe/Brussels', true ); ?> value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                            <option <?php selected( $value, 'Europe/Sarajevo', true ); ?> value="Europe/Sarajevo">(GMT+01:00) Sarajevo, Skopje, Warsaw, Zagreb</option>
                            <option <?php selected( $value, 'Africa/Lagos', true ); ?> value="Africa/Lagos">(GMT+01:00) West Central Africa</option>
                            <option <?php selected( $value, 'Asia/Amman', true ); ?> value="Asia/Amman">(GMT+02:00) Amman</option>
                            <option <?php selected( $value, 'Europe/Athens', true ); ?> value="Europe/Athens">(GMT+02:00) Athens, Bucharest, Istanbul</option>
                            <option <?php selected( $value, 'Asia/Beirut', true ); ?> value="Asia/Beirut">(GMT+02:00) Beirut</option>
                            <option <?php selected( $value, 'Africa/Cairo', true ); ?> value="Africa/Cairo">(GMT+02:00) Cairo</option>
                            <option <?php selected( $value, 'Africa/Harare', true ); ?> value="Africa/Harare">(GMT+02:00) Harare, Pretoria</option>
                            <option <?php selected( $value, 'Europe/Helsinki', true ); ?> value="Europe/Helsinki">(GMT+02:00) Helsinki, Kyiv, Riga, Sofia, Tallinn, Vilnius</option>
                            <option <?php selected( $value, 'Asia/Jerusalem', true ); ?> value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                            <option <?php selected( $value, 'Europe/Minsk', true ); ?> value="Europe/Minsk">(GMT+02:00) Minsk</option>
                            <option <?php selected( $value, 'Africa/Windhoek', true ); ?> value="Africa/Windhoek">(GMT+02:00) Windhoek</option>
                            <option <?php selected( $value, 'Asia/Kuwait', true ); ?> value="Asia/Kuwait">(GMT+03:00) Kuwait, Riyadh, Baghdad</option>
                            <option <?php selected( $value, 'Europe/Moscow', true ); ?> value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>

                            <option <?php selected( $value, 'Africa/Nairobi', true ); ?> value="Africa/Nairobi">(GMT+03:00) Nairobi</option>
                            <option <?php selected( $value, 'Asia/Tbilisi', true ); ?> value="Asia/Tbilisi">(GMT+03:00) Tbilisi</option>
                            <option <?php selected( $value, 'Asia/Tehran', true ); ?> value="Asia/Tehran">(GMT+03:30) Tehran</option>
                            <option <?php selected( $value, 'Asia/Muscat', true ); ?> value="Asia/Muscat">(GMT+04:00) Abu Dhabi, Muscat</option>
                            <option <?php selected( $value, 'Asia/Baku', true ); ?> value="Asia/Baku">(GMT+04:00) Baku</option>
                            <option <?php selected( $value, 'Asia/Yerevan', true ); ?> value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                            <option <?php selected( $value, 'Asia/Kabul', true ); ?> value="Asia/Kabul">(GMT+04:30) Kabul</option>
                            <option <?php selected( $value, 'Asia/Yekaterinburg', true ); ?> value="Asia/Yekaterinburg">(GMT+05:00) Yekaterinburg</option>
                            <option <?php selected( $value, 'Asia/Karachi', true ); ?> value="Asia/Karachi">(GMT+05:00) Islamabad, Karachi, Tashkent</option>
                            <option <?php selected( $value, 'Asia/Calcutta', true ); ?> value="Asia/Calcutta">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                            <option <?php selected( $value, 'Asia/Calcutta', true ); ?> value="Asia/Calcutta">(GMT+05:30) Sri Jayawardenapura</option>
                            <option <?php selected( $value, 'Asia/Katmandu', true ); ?> value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                            <option <?php selected( $value, 'Asia/Almaty', true ); ?> value="Asia/Almaty">(GMT+06:00) Almaty, Novosibirsk</option>
                            <option <?php selected( $value, 'Asia/Dhaka', true ); ?> value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                            <option <?php selected( $value, 'Asia/Rangoon', true ); ?> value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                            <option <?php selected( $value, 'Asia/Bangkok', true ); ?> value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                            <option <?php selected( $value, 'Asia/Krasnoyarsk', true ); ?> value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                            <option <?php selected( $value, 'Asia/Hong_Kong', true ); ?> value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                            <option <?php selected( $value, 'Asia/Kuala_Lumpur', true ); ?> value="Asia/Kuala_Lumpur">(GMT+08:00) Kuala Lumpur, Singapore</option>
                            <option <?php selected( $value, 'Asia/Irkutsk', true ); ?> value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                            <option <?php selected( $value, 'Australia/Perth', true ); ?> value="Australia/Perth">(GMT+08:00) Perth</option>

                            <option <?php selected( $value, 'Asia/Taipei', true ); ?> value="Asia/Taipei">(GMT+08:00) Taipei</option>
                            <option <?php selected( $value, 'Asia/Tokyo', true ); ?> value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                            <option <?php selected( $value, 'Asia/Seoul', true ); ?> value="Asia/Seoul">(GMT+09:00) Seoul</option>
                            <option <?php selected( $value, 'Asia/Yakutsk', true ); ?> value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                            <option <?php selected( $value, 'Australia/Adelaide', true ); ?> value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                            <option <?php selected( $value, 'Australia/Darwin', true ); ?> value="Australia/Darwin">(GMT+09:30) Darwin</option>
                            <option <?php selected( $value, 'Australia/Brisbane', true ); ?> value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                            <option <?php selected( $value, 'Australia/Canberra', true ); ?> value="Australia/Canberra">(GMT+10:00) Canberra, Melbourne, Sydney</option>
                            <option <?php selected( $value, 'Australia/Hobart', true ); ?> value="Australia/Hobart">(GMT+10:00) Hobart</option>
                            <option <?php selected( $value, 'Pacific/Guam', true ); ?> value="Pacific/Guam">(GMT+10:00) Guam, Port Moresby</option>
                            <option <?php selected( $value, 'Asia/Vladivostok', true ); ?> value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                            <option <?php selected( $value, 'Asia/Magadan', true ); ?> value="Asia/Magadan">(GMT+11:00) Magadan, Solomon Is., New Caledonia</option>
                            <option <?php selected( $value, 'Pacific/Auckland', true ); ?> value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                            <option <?php selected( $value, 'Pacific/Fiji', true ); ?> value="Pacific/Fiji">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                            <option <?php selected( $value, 'Pacific/Tongatapu', true ); ?> value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                        </select>
                        <p>Not implemented on all styles. Only implements on certain styles.</p>
                    </td>
                </tr>
			</table>
			<?php submit_button(); ?>
		</form>
	</div>
<?php

