<?php

/**
 * @constant VIP_GO_ENV The name of the current VIP Go environment. Falls back to `false`.
 */
if ( ! defined( 'VIP_GO_ENV' ) ) {
	define( 'VIP_GO_ENV', false );
}

// For backwards compatibility - always true.
if ( ! defined( 'WPCOM_IS_VIP_ENV' ) ) {
    define( 'WPCOM_IS_VIP_ENV', false );
}

$hostname = gethostname();
define( 'WPCOM_SANDBOXED', false !== strpos( $hostname, '_web_dev_' ) );

if ( WPCOM_SANDBOXED ) {
	require __DIR__ . '/vip-helpers/sandbox.php';
}

// Load our development and environment helpers
require_once( __DIR__ . '/vip-helpers/vip-utils.php' );
require_once( __DIR__ . '/vip-helpers/vip-caching.php' );
require_once( __DIR__ . '/vip-helpers/vip-roles.php' );
require_once( __DIR__ . '/vip-helpers/vip-permastructs.php' );
require_once( __DIR__ . '/vip-helpers/vip-mods.php' );
require_once( __DIR__ . '/vip-helpers/vip-media.php' );
require_once( __DIR__ . '/vip-helpers/vip-elasticsearch.php' );
require_once( __DIR__ . '/vip-helpers/vip-stats.php' );
require_once( __DIR__ . '/vip-helpers/vip-deprecated.php' );
require_once( __DIR__ . '/vip-helpers/vip-syndication-cache.php' );

// Load WP_CLI helpers
if ( defined( 'WP_CLI' ) && WP_CLI ) {
    require_once( __DIR__ . '/vip-helpers/vip-wp-cli.php' );
}

// Add Automattic's custom header
add_action( 'send_headers', function() {
	if ( ! defined( 'WP_INSTALLING' ) || ! WP_INSTALLING ) {
		header( "X-hacker: If you're reading this, you should visit automattic.com/jobs and apply to join the fun, mention this header." );
	}
} );

do_action( 'vip_loaded' );
