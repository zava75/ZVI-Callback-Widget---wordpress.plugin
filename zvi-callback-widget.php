<?php
/*
Plugin Name: ZVI Callback Widget
Plugin URI:  http://studio-f1.in.ua/project03.html
Description: ZVI CallBack widget WordPress. Customize CallBack widget WordPress (+ Support Contact Form 7 +Bot Telegram)
Version: 1.0
Text Domain: zvi-callback-widget
Domain Path: /languages
Author: Zatsarinny Vadim
Author URI: http://studio-f1.in.ua/contact.html
*/

register_activation_hook( __FILE__, 'zvi_callback_activate' );
// callback function registr prugin ZVI Callback Widget
function zvi_callback_activate() {
	// Set value default value form Callback
	$zvi_callback_title = get_option( 'zvi_callback_title' ) ? get_option( 'zvi_callback_title' ) : __( 'Feedback', 'zvi-callback-widget' );
	update_option( 'zvi_callback_title', $zvi_callback_title );
	$zvi_callback_color = get_option( 'zvi_callback_color' ) ? get_option( 'zvi_callback_color' ) : 'FFCD2A';
	update_option( 'zvi_callback_color', $zvi_callback_color );
	$zvi_callback_color_hover = get_option( 'zvi_callback_color_hover' ) ? get_option( 'zvi_callback_color_hover' ) : 'FFD753';
	update_option( 'zvi_callback_color_hover', $zvi_callback_color_hover );
	$zvi_callback_color_text = get_option( 'zvi_callback_color_text' ) ? get_option( 'zvi_callback_color_text' ) : '333';
	update_option( 'zvi_callback_color_text', $zvi_callback_color_text );
	$zvi_callback_img = get_option( 'zvi_callback_img' ) ? get_option( 'zvi_callback_img' ) : '3';
	update_option( 'zvi_callback_img', $zvi_callback_img );
	$zvi_callback_email = get_option( 'zvi_callback_email' ) ? get_option( 'zvi_callback_email' ) : get_option( 'admin_email' );
	update_option( 'zvi_callback_email', $zvi_callback_email );
	$zvi_callback_url = get_option( 'zvi_callback_url' ) ? get_option( 'zvi_callback_url' ) : get_site_url();
	update_option( 'zvi_callback_url', $zvi_callback_url );
	$zvi_callback_subtitle = get_option( 'zvi_callback_subtitle' ) ? get_option( 'zvi_callback_subtitle' ) : '';
	update_option( 'zvi_callback_subtitle', $zvi_callback_subtitle );
	$zvi_callback_telegram_id = get_option( 'zvi_callback_telegram_id' ) ? get_option( 'zvi_callback_telegram_id' ) : '';
	update_option( 'zvi_callback_telegram_id', $zvi_callback_telegram_id );
	$zvi_callback_telegram_token = get_option( 'zvi_callback_telegram_token' ) ? get_option( 'zvi_callback_telegram_token' ) : '';
	update_option( 'zvi_callback_telegram_token', $zvi_callback_telegram_token );
	$zvi_callback_telegram_send = get_option( 'zvi_callback_telegram_send' ) ? get_option( 'zvi_callback_telegram_send' ) : '';
	update_option( 'zvi_callback_telegram_send', $zvi_callback_telegram_send );
	$zvi_callback_left = get_option( 'zvi_callback_left' ) ? get_option( 'zvi_callback_left' ) : '';
	update_option( 'zvi_callback_left', $zvi_callback_left );
}

//Translations load plugin ENG RUS
add_action( 'plugins_loaded', 'zvi_callback_widget_translations' );

function zvi_callback_widget_translations() {
	load_plugin_textdomain( 'zvi-callback-widget', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

//*  Include menu plugin
add_action( 'admin_menu', 'zvi_callback_loader_menu' );

function zvi_callback_loader_menu() {
	add_menu_page( 'ZVI Callback Widget', 'ZVI Callback Widget', 'administrator', 'zvi-callback-settings', 'zvi_callback_admin', 'dashicons-admin-settings' );
}

//  include file admin forms
function zvi_callback_admin() {
	include_once( 'zvi-callback-admin.php' );
}

add_action( 'wp_footer', 'zvi_widget_scripts' );
function zvi_widget_scripts() {
	wp_enqueue_style( 'zvi_widget_css', plugins_url( 'css/zvi-widget.css', __FILE__ ) );
	wp_enqueue_script( 'jquery' ); //
	wp_enqueue_script( 'zvi_widget_js', plugins_url( 'js/zvi-widget.js', __FILE__ ), array( 'jquery' ), null, true );
	wp_localize_script( 'zvi_widget_js', 'zviCallback', [
		'url'   => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'zvi' ),
	] );
}

add_action( 'admin_enqueue_scripts', 'zvi_widget_admin_scripts' );
function zvi_widget_admin_scripts() {
	wp_enqueue_style( 'zvi_widget_admin_css', plugins_url( 'css/zvi-widget-admin.css', __FILE__ ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'zvi_widget_colorpicker_js', plugin_dir_url( __FILE__ ) . 'js/jqColorPicker.min.js', array( 'jquery' ) , null, true );
}

//load bottom and form callback front
add_action( 'wp_footer', 'zvi_layout_widget' );
function zvi_layout_widget() { ?>
    <div class="callback_overlay"></div>
    <div id="zviform" class="callback_popup text-center">
        <div class="callback_close-btn">&times;</div>
        <h2 id="zvih2"><?php echo get_option( 'zvi_callback_title' ); ?></h2>
		<?php
		$zvi_callback_subtitle = get_option( 'zvi_callback_subtitle' );
		if ( ! empty( $zvi_callback_subtitle ) ) {
			echo '<p>' . $zvi_callback_subtitle . '</p>';
		} ?>
		<?php
		$zvi_callback_shortcode = get_option( 'zvi_callback_shortcode' );
		// if contact-form-7  >> load contact-form-7
		if ( $zvi_callback_shortcode && $zvi_callback_shortcode != '[contact-form-7 404 "Not Found"]' ) {
			echo do_shortcode( '' . htmlspecialchars_decode( $zvi_callback_shortcode ) . '' );
		} else {
			?>
            <form id="callback_form">
                <!-- Hidden Required Fields -->
                <input type="hidden" name="url"
                       value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                <!-- END Hidden Required Fields -->
                <input class="zviinput" id="name" type="text" name="name"
                       placeholder="<?php echo( sprintf( esc_html__( 'Name', 'zvi-callback-widget' ) ) ); ?>"
                       required><br>
                <input class="zviinput" id="tel" type="tel" name="tel"
                       placeholder="<?php echo( sprintf( esc_html__( 'Phone', 'zvi-callback-widget' ) ) ); ?>"
                       required><br>
                <button><?php echo( sprintf( esc_html__( 'Send', 'zvi-callback-widget' ) ) ); ?></button>
            </form>
			<?php
		}
		?>
    </div>
    <a id="callback_button" class="callback_button" href="#form_pop">
        <div class="phon" <?php if ( get_option( 'zvi_callback_left' ) === '0' ) {
			echo 'style="left:' . get_option( 'zvi_callback_left' ) . '!important;' . ' transform-origin: initial;"';
		} else {
			echo 'style="transform-origin: initial;"';
		} ?>
        >
            <div class="circl"
                 style="background-color: #<?php echo get_option( 'zvi_callback_color_hover' ); ?>!important;  transform-origin: initial;"></div>
            <div class="circl-fill"
                 style="background-color: #<?php echo get_option( 'zvi_callback_color_hover' ); ?>!important; transform-origin: initial;"></div>
            <div class="img-circl-text"
                 style="background-color: #<?php echo get_option( 'zvi_callback_color' ); ?>!important;"><span
                        style="color: #<?php echo get_option( 'zvi_callback_color_text' ); ?>!important;"><?php echo( sprintf( esc_html__( 'CALL', 'zvi-callback-widget' ) ) ); ?>
                    <br><?php echo( sprintf( esc_html__( 'BUTTON', 'zvi-callback-widget' ) ) ); ?></span></div>
            <div class="img-circl"
                 style="background-image: url(<?php echo plugin_dir_url( __FILE__ ) . '/img/' . get_option( 'zvi_callback_img' ) . '.png' ?> ); background-color: #<?php echo get_option( 'zvi_callback_color' ); ?>!important;  transform-origin: initial;"></div>
        </div>
    </a>
<?php }

// if contact_form7 redirect
if ( get_option( 'zvi_callback_url' ) && get_option( 'zvi_callback_shortcode' ) ) {
	add_action( 'wp_footer', 'zvi_contact_form7_redirect' );
	function zvi_contact_form7_redirect() {
		echo "<script> 
                 document.addEventListener( 'wpcf7submit', function( event ) { location = '" . get_option( 'zvi_callback_url' ) . "';})
                 </script>";
	}
}

// ajax form post
add_action( 'wp_ajax_nopriv_zvi_callback_post', 'zvi_callback_post' );
add_action( 'wp_ajax_zvi_callback_post', 'zvi_callback_post' );
function zvi_callback_post() {
	if ( wp_verify_nonce( $_POST['security'], 'zvi' ) ) {
		$title       = get_option( 'zvi_callback_title' ) ? get_option( 'zvi_callback_title' ) : 'Feedback';
		$admin_email = get_option( 'zvi_callback_email' ) ? get_option( 'zvi_callback_email' ) : get_option( 'admin_email' );
		$blogname    = get_option( 'blogname' );

		$sendToCheck    = get_option( 'zvi_callback_telegram_send' );
		$url            = esc_url( $_POST['url'] );
		$name           = sanitize_text_field( $_POST["name"] );
		$tel            = sanitize_text_field( $_POST["tel"] );
		$callback_title = get_option( 'zvi_callback_title' );

		$chat_id   = get_option( 'zvi_callback_telegram_id' );
		$token     = get_option( 'zvi_callback_telegram_token' );
		$l_name    = sprintf( esc_html__( 'Name', 'zvi-callback-widget' ) );
		$l_phone   = sprintf( esc_html__( 'Phone', 'zvi-callback-widget' ) );
		$l_message = sprintf( esc_html__( 'Message from the site', 'zvi-callback-widget' ) );
		$l_url     = sprintf( esc_html__( 'Site URL', 'zvi-callback-widget' ) );

		if ( !empty($token) && !empty($chat_id) ) {
			$messageTelegram = urlencode( $callback_title . "\n" . $l_name . " : " . $name . "\n" . $l_phone . " : " . $tel . "\n" . $l_message . " : " . $blogname . "\n" . $l_url . " : " . $url );
			// Send Form bot Telegram
			$sendToTelegram = fopen( "https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$messageTelegram}", "r" );
		}
		if ( empty($sendToCheck) ) {
			$message = $callback_title . "\n" . $l_name . " : " . $name . "\n" . $l_phone . " : " . $tel . "\n" . $l_message . " : " . $blogname . "\n" . $l_url . " : " . $url;
			// Send Form  Email
			if ( mail( $admin_email, $title, $message, "Content-type: text/plain; charset=\"utf-8\"\nFrom: $admin_email" ) ) {
				$url_redirect = get_option( 'zvi_callback_url' ) ? get_option( 'zvi_callback_url' ) : get_site_url();
				echo $url_redirect;
				wp_die();
			} else {
				wp_die( 0 );
			}
		} else {
			$url_redirect = get_option( 'zvi_callback_url' ) ? get_option( 'zvi_callback_url' ) : get_site_url();
			echo $url_redirect;
			wp_die();
		}
	} else {
		wp_die( 0 );
	}
}

?>
