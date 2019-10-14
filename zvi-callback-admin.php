<?php
// Проверяет установлена const ABSPATH
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// post setings widget
if ( current_user_can( 'administrator' ) ) {

	if ( isset( $_POST['zvi_hidden'] ) && $_POST['zvi_hidden'] == 'Y' ) {

		$zvi_callback_title = ! empty( $_POST['zvi_callback_title'] ) ? sanitize_text_field( $_POST['zvi_callback_title'] ) : esc_html__( 'Feedback', 'zvi-callback-widget' );
		update_option( 'zvi_callback_title', $zvi_callback_title );

		$zvi_callback_subtitle = isset( $_POST['zvi_callback_subtitle'] ) ? sanitize_text_field( $_POST['zvi_callback_subtitle'] ) : '';
		update_option( 'zvi_callback_subtitle', $zvi_callback_subtitle );

		$zvi_callback_telegram_id = isset( $_POST['zvi_callback_telegram_id'] ) ? sanitize_text_field( $_POST['zvi_callback_telegram_id'] ) : '';
		update_option( 'zvi_callback_telegram_id', $zvi_callback_telegram_id );

		$zvi_callback_telegram_token = ! empty( $_POST['zvi_callback_telegram_token'] ) ? sanitize_text_field( $_POST['zvi_callback_telegram_token'] ) : '';
		update_option( 'zvi_callback_telegram_token', $zvi_callback_telegram_token );


		$zvi_callback_color = ! empty( $_POST['zvi_callback_color'] ) ? sanitize_text_field( $_POST['zvi_callback_color'] ) : 'FFCD2A';
		update_option( 'zvi_callback_color', $zvi_callback_color );

		$zvi_callback_color_hover = ! empty( $_POST['zvi_callback_color_hover'] ) ? sanitize_text_field( $_POST['zvi_callback_color_hover'] ) : 'FFD753';
		update_option( 'zvi_callback_color_hover', $zvi_callback_color_hover );

		$zvi_callback_color_text = ! empty( $_POST['zvi_callback_color_text'] ) ? sanitize_text_field( $_POST['zvi_callback_color_text'] ) : '333';
		update_option( 'zvi_callback_color_text', $zvi_callback_color_text );

		$zvi_callback_img = ! empty( $_POST['zvi_callback_img'] ) ? sanitize_text_field( $_POST['zvi_callback_img'] ) : '3';
		update_option( 'zvi_callback_img', $zvi_callback_img );

		$zvi_callback_email = ! empty( $_POST['zvi_callback_email'] ) ? sanitize_email( $_POST['zvi_callback_email'] ) : get_option( 'admin_email' );
		update_option( 'zvi_callback_email', $zvi_callback_email );

		$zvi_callback_url = ! empty( $_POST['zvi_callback_url'] ) ? esc_url( $_POST['zvi_callback_url'] ) : get_site_url();
		update_option( 'zvi_callback_url', $zvi_callback_url );

		$zvi_callback_shortcode = isset( $_POST['zvi_callback_shortcode'] ) ? esc_attr( str_replace( '\\', '', $_POST['zvi_callback_shortcode'] ) ) : '';
		update_option( 'zvi_callback_shortcode', $zvi_callback_shortcode );

		$zvi_callback_telegram_send = isset( $_POST['zvi_callback_telegram_send'] ) ? '1' : '';
		update_option( 'zvi_callback_telegram_send', $zvi_callback_telegram_send );

		$zvi_callback_left = isset( $_POST['zvi_callback_left'] ) ? '0' : '';
		update_option( 'zvi_callback_left', $zvi_callback_left );

		?>
        <div class="updated"><p>
                <strong><?php echo esc_html__( 'Update widget settings', 'zvi-callback-widget' ); ?></strong>
            </p></div>
		<?php
	} else {
		$zvi_callback_title          = get_option( 'zvi_callback_title' ) ? get_option( 'zvi_callback_title' ) : esc_html__( 'Feedback', 'zvi-callback-widget' );
		$zvi_callback_subtitle       = get_option( 'zvi_callback_subtitle' ) ? get_option( 'zvi_callback_subtitle' ) : '';
		$zvi_callback_telegram_id    = get_option( 'zvi_callback_telegram_id' ) ? get_option( 'zvi_callback_telegram_id' ) : '';
		$zvi_callback_telegram_token = get_option( 'zvi_callback_telegram_token' ) ? get_option( 'zvi_callback_telegram_token' ) : '';
		$zvi_callback_color          = get_option( 'zvi_callback_color' ) ? get_option( 'zvi_callback_color' ) : 'FFCD2A';
		$zvi_callback_color_hover    = get_option( 'zvi_callback_color_hover' ) ? get_option( 'zvi_callback_color_hover' ) : 'FFD753';
		$zvi_callback_color_text     = get_option( 'zvi_callback_color_text' ) ? get_option( 'zvi_callback_color_text' ) : '333';
		$zvi_callback_img            = get_option( 'zvi_callback_img' ) ? get_option( 'zvi_callback_img' ) : '3';
		$zvi_callback_email          = get_option( 'zvi_callback_email' ) ? get_option( 'zvi_callback_email' ) : get_option( 'admin_email' );
		$zvi_callback_url            = get_option( 'zvi_callback_url' ) ? get_option( 'zvi_callback_url' ) : get_site_url();
		$zvi_callback_shortcode      = get_option( 'zvi_callback_shortcode' );
		$zvi_callback_telegram_send  = get_option( 'zvi_callback_telegram_send' );
		$zvi_callback_left           = get_option( 'zvi_callback_left' );
	}
	function get_zvi_callback_img( $value ) {
		if ( get_option( 'zvi_callback_img' ) == $value ) {
			echo 'selected="selected"';
		} else {
			return;
		}
	}

	?>
    <!--form admin widget-->
    <div class="wr">
        <div class="zvi-box welcome-panel">
            <h1><?php echo esc_html__( 'WP ZVI Callback Widget Settings', 'zvi-callback-widget' ); ?></h1>
            <h3><?php echo esc_html__( 'Need help in setting up and finalizing a plugin or website, write to us, we will be happy to help you!', 'zvi-callback-widget' ); ?></h3>
            <hr>
            <div>
                <a href="mailto:zvi@gmail.com" target="_blank"><img
                            src="<?php echo plugins_url( 'img/email.png', __FILE__ ); ?>" alt=""></a>
                <a href="https://www.facebook.com/vadimzatsarinny" target="_blank"><img
                            src="<?php echo plugins_url( 'img/facebook.png', __FILE__ ); ?>" alt=""></a>
                <a href="skype:vadim.zatsarinny" target="_blank"><img
                            src="<?php echo plugins_url( 'img/skype.png', __FILE__ ); ?>" alt=""></a>
                <a href="https://t.me/@zvi1975" target="_blank"><img
                            src="<?php echo plugins_url( 'img/telegram.png', __FILE__ ); ?>" alt=""></a>
                <a href="tel:380984135594" target="_blank"><img
                            src="<?php echo plugins_url( 'img/viber.png', __FILE__ ); ?>" alt=""></a>
                <a href="https://wa.me/380984135594" target="_blank"><img
                            src="<?php echo plugins_url( 'img/whatsapp.png', __FILE__ ); ?>" alt=""></a>
            </div>
            <p><b><?php echo esc_html__( 'Web Studio F1 Website', 'zvi-callback-widget' ); ?> <u> <a
                                href="https://studio-f1.in.ua/" target="_blank">studio-f1.in.ua</a></u>
                    E-mail: <u><a href="mailto:zvi@gmail.com" target="_blank">zvi1975@gmail.com</a></u></b></p>
            <hr>
            <div class="sos">
                <h3><?php echo esc_html__( 'Attention! Noticed incorrect language translation write to us, we will fix it or use the plug-in for translation', 'zvi-callback-widget' ); ?>
                    Loco Translate</h3>
            </div>

        </div>
        <form class="zvi-form-admin" name="nice_loader_settings_form" method="post"
              action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI'] ); ?>">


            <input type="hidden" name="zvi_hidden" value="Y">

            <div class="admin-row">
                <br>
                <h3><?php echo esc_html__( 'Header Callback', 'zvi-callback-widget' ); ?></h3>
                <hr>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Form header', 'zvi-callback-widget' ); ?></span>
                            <input type="text" name="zvi_callback_title" value="<?php echo $zvi_callback_title ?>"
                                   placeholder="<?php echo esc_html__( $zvi_callback_title ); ?>"
                                   maxlength="60"
                                   required>
                        </label>
                    </p>
                </div>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Subtitle form', 'zvi-callback-widget' ); ?></span>
                            <input type="text" name="zvi_callback_subtitle"
                                   value="<?php echo esc_html__( $zvi_callback_subtitle ); ?>"
                                   maxlength="250">
                        </label>
                    </p>
                </div>
            </div>
            <div class="admin-row">
                <br>
                <h3><?php echo esc_html__( 'Appearance Callback', 'zvi-callback-widget' ); ?></h3>
                <hr>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Color Callback', 'zvi-callback-widget' ); ?></span>
                            <input class="jscolor" name="zvi_callback_color"
                                   value="<?php echo $zvi_callback_color; ?>">
                        </label>
                    </p>
                </div>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Color Callback hover', 'zvi-callback-widget' ); ?></span>
                            <input class="jscolor" name="zvi_callback_color_hover"
                                   value="<?php echo $zvi_callback_color_hover; ?>">
                        </label>
                    </p>
                </div>
                <div class="admin-col-6">
                    <p>
                        <b><?php echo esc_html__( 'Widget position on the left side (By default, By default, the widget on the right side)', 'zvi-callback-widget' ); ?></b>
                    </p>
                    <input type="checkbox" <?php if ( get_option( 'zvi_callback_left' ) === '0' ) {
						echo 'checked';
					} ?> name="zvi_callback_left" id=""/>
                    <br>
                    <p class="zvi-callback-form-control">
                    <h3><?php echo esc_html__( 'Select the widget icon (by default, this is the No. 3 male consultant)', 'zvi-callback-widget' ); ?></h3>
                    <img src="<?php echo plugin_dir_url( __FILE__ ) . '/img/admin.png'; ?> ">
                    <select name="zvi_callback_img" class="form-control">
                        <option value="1" <?php get_zvi_callback_img( '1' ); ?> ><?php echo esc_html__( 'Icon Callback 1', 'zvi-callback-widget' ); ?></option>
                        <option value="2" <?php get_zvi_callback_img( '2' ); ?> ><?php echo esc_html__( 'Icon Callback 2', 'zvi-callback-widget' ); ?></option>
                        <option value="3" <?php get_zvi_callback_img( '3' ); ?> ><?php echo esc_html__( 'Icon Callback 3', 'zvi-callback-widget' ); ?></option>
                        <option value="4" <?php get_zvi_callback_img( '4' ); ?> ><?php echo esc_html__( 'Icon Callback 4', 'zvi-callback-widget' ); ?></option>
                        <option value="5" <?php get_zvi_callback_img( '5' ); ?> ><?php echo esc_html__( 'Icon Callback 5', 'zvi-callback-widget' ); ?></option>
                        <option value="6" <?php get_zvi_callback_img( '6' ); ?> ><?php echo esc_html__( 'Icon Callback 6', 'zvi-callback-widget' ); ?></option>
                        <option value="7" <?php get_zvi_callback_img( '7' ); ?> ><?php echo esc_html__( 'Icon Callback 7', 'zvi-callback-widget' ); ?></option>
                        <option value="8" <?php get_zvi_callback_img( '8' ); ?> ><?php echo esc_html__( 'Icon Callback 8', 'zvi-callback-widget' ); ?></option>
                        <option value="9" <?php get_zvi_callback_img( '9' ); ?> ><?php echo esc_html__( 'Icon Callback 9', 'zvi-callback-widget' ); ?></option>
                        <option value="10" <?php get_zvi_callback_img( '10' ); ?> ><?php echo esc_html__( 'Icon Callback 10', 'zvi-callback-widget' ); ?></option>
                        <option value="11" <?php get_zvi_callback_img( '11' ); ?> ><?php echo esc_html__( 'Icon Callback 11', 'zvi-callback-widget' ); ?></option>
                        <option value="12" <?php get_zvi_callback_img( '12' ); ?> ><?php echo esc_html__( 'Icon Callback 12', 'zvi-callback-widget' ); ?></option>
                        <option value="13" <?php get_zvi_callback_img( '13' ); ?> ><?php echo esc_html__( 'Icon Callback 13', 'zvi-callback-widget' ); ?></option>
                        <option value="14" <?php get_zvi_callback_img( '14' ); ?> ><?php echo esc_html__( 'Icon Callback 14', 'zvi-callback-widget' ); ?></option>
                    </select>
                    </p>
                </div>

                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Color Callback hover Text', 'zvi-callback-widget' ); ?></span>
                            <input class="jscolor" name="zvi_callback_color_text"
                                   value="<?php echo $zvi_callback_color_text; ?>">
                        </label>
                    </p>
                </div>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                    </p>
                </div>
            </div>
            <div class="admin-row">
                <br>
                <h3><?php echo esc_html__( 'Form Settings Callback', 'zvi-callback-widget' ); ?></h3>
                <hr>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'E-mail admin for the default form (Default E-mail administrator)', 'zvi-callback-widget' ); ?></span>
                            <input type="email" name="zvi_callback_email" value="<?php echo $zvi_callback_email ?>"
                                   placeholder="<?php echo $zvi_callback_email ?>">
                        </label>
                    </p>
                </div>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Url Pages after submitting the form (By default, the main page)', 'zvi-callback-widget' ); ?></span>
                            <input type="url" name="zvi_callback_url" value="<?php echo $zvi_callback_url ?>"
                                   placeholder="<?php echo $zvi_callback_url ?>">
                        </label>
                    </p>
                </div>
            </div>
            <div class="admin-row">
                <br>
                <h3><?php echo esc_html__( 'Settings when using Contact Form 7 Callback', 'zvi-callback-widget' ); ?></h3>
                <p><?php echo esc_html__( 'When using Contact Form 7, paste the shortcode of your form in the next field. for example [contact-form-7 id="6" title="Contact form 1"]. 
                 Attention! When you insert shortcode Contact Form 7, the standard form will be disabled.', 'zvi-callback-widget' ); ?></p>
                <hr>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Contact Form 7 Shortcode: ', 'zvi-callback-widget' ); ?></span>
                            <input type="text" name="zvi_callback_shortcode"
                                   value="<?php echo $zvi_callback_shortcode ?>"
                                   placeholder="[contact-form-7 id=&quot;1&quot; title=&quot;Contact form 1&quot;]">
                        </label>
                    </p>
                </div>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                    </p>
                </div>
            </div>

            <div class="admin-row">
                <br>
                <h3><?php echo esc_html__( 'Settings for integration with Telegram', 'zvi-callback-widget' ); ?></h3>
                <p><?php echo esc_html__( 'Telegram API only works with the default form (does not work with Contact Form 7).
To connect, enter the chat id and token, activate the Telegram bot before connecting. Read instructions', 'zvi-callback-widget' ); ?></p>
                <p><?php echo esc_html__( 'Send only to Telegram (By default, Send to the Default Form and Telegram)', 'zvi-callback-widget' ); ?></p>
                <input type="checkbox" <?php if ( get_option( 'zvi_callback_telegram_send' ) ) {
					echo 'checked';
				} ?> name="zvi_callback_telegram_send" id=""/>
                <hr>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Chat ID Telegram: ', 'zvi-callback-widget' ); ?></span>
                            <input type="text" name="zvi_callback_telegram_id"
                                   value="<?php echo $zvi_callback_telegram_id ?>"
                                   placeholder="<?php echo $zvi_callback_telegram_id ?>" maxlength="60">
                        </label>
                    </p>
                </div>
                <div class="admin-col-6">
                    <p class="zvi-callback-form-control">
                        <label>
                            <span><?php echo esc_html__( 'Token Telegram', 'zvi-callback-widget' ); ?></span>
                            <input type="text" name="zvi_callback_telegram_token"
                                   value="<?php echo $zvi_callback_telegram_token ?>"
                                   placeholder="<?php echo $zvi_callback_telegram_token ?>" maxlength="250">
                        </label>
                    </p>
                </div>
            </div>

            <div class="admin-row">
                <div class="admin-col-6">
                    <p class="submit">
                        <input type="submit" class="button button-primary button-large" name="Submit"
                               value="<?php echo esc_html__( 'Save Settings', 'zvi-callback-widget' ); ?>"/>
                    </p>
                </div>
                <div class="admin-col-6"></div>
            </div>

        </form>
    </div>
    <!--end form widget-->
<?php } ?>
