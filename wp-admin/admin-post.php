<?php
if ( ! defined( 'WP_ADMIN' ) ) {
	define( 'WP_ADMIN', true );
}

if ( defined('ABSPATH') )
	require_once(ABSPATH . 'wp-load.php');
else
	require_once( dirname( dirname( __FILE__ ) ) . '/wp-load.php' );

send_origin_headers();

require_once(ABSPATH . 'wp-admin/includes/admin.php');

nocache_headers();

do_action( 'admin_init' );

$action = empty( $_REQUEST['action'] ) ? '' : $_REQUEST['action'];

if ( ! wp_validate_auth_cookie() ) {
	if ( empty( $action ) ) {
		
		do_action( 'admin_post_nopriv' );
	} else {
		
		do_action( "admin_post_nopriv_{$action}" );
	}
} else {
	if ( empty( $action ) ) {

		do_action( 'admin_post' );
	} else {
		
		do_action( "admin_post_{$action}" );
	}
}
