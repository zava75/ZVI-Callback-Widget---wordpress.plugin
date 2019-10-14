<?php
//if uninstall isnt called exit here
//if(!defined(WP_UNINSTALL_PLUGIN) exit();

if (
	! defined( 'WP_UNINSTALL_PLUGIN' )
	||
	! WP_UNINSTALL_PLUGIN
	||
	dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) )
) {
	status_header( 404 );
	exit;
}

//start deleting all sored options
delete_option( 'zvi_callback_title' );
delete_option( 'zvi_callback_subtitle' );
delete_option( 'zvi_callback_color' );
delete_option( 'zvi_callback_color_hover' );
delete_option( 'zvi_callback_email' );
delete_option( 'zvi_callback_url' );
delete_option( 'zvi_callback_shortcode' );
delete_option( 'zvi_callback_img' );
delete_option( 'zvi_callback_telegram_id' );
delete_option( 'zvi_callback_telegram_token' );
delete_option( 'zvi_callback_telegram_send' );
delete_option( 'zvi_callback_left' );
delete_option( 'zvi_callback_color_text' );