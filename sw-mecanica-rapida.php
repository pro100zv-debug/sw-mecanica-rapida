<?php
/**
 * Plugin Name:       SW Mecánica Rápida
 * Description:       Landing de mecánica rápida: hero dinámico según ?servicio= (coche animado + cuadro de mandos), tarjetas de servicios con precios «desde» y datos estructurados JSON-LD. Precios y textos en Mecánica Rápida → Servicios.
 * Version:           1.0.4
 * Author:            SergioWeb
 * Author URI:        https://sergioweb.es/
 * Requires at least: 5.8
 * Requires PHP:      7.4
 * License:           GPL-2.0-or-later
 * Text Domain:       sw-mecanica-rapida
 * Update URI:        https://github.com/pro100zv-debug/sw-mecanica-rapida
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'SWMR_VERSION', '1.0.4' );
define( 'SWMR_FILE', __FILE__ );
define( 'SWMR_DIR', plugin_dir_path( __FILE__ ) );
define( 'SWMR_URL', plugin_dir_url( __FILE__ ) );

/* ---------- Updates from GitHub ---------- */

if ( is_readable( SWMR_DIR . 'plugin-update-checker/plugin-update-checker.php' ) ) {
	require_once SWMR_DIR . 'plugin-update-checker/plugin-update-checker.php';

	$swmr_updater = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
		'https://github.com/pro100zv-debug/sw-mecanica-rapida/',
		__FILE__,
		'sw-mecanica-rapida'
	);
	$swmr_updater->setBranch( 'main' );
	// Only releases that already have the zip attached (built by GitHub Actions).
	$swmr_updater->getVcsApi()->enableReleaseAssets(
		'/sw-mecanica-rapida\.zip($|[?&#])/i',
		\YahnisElsts\PluginUpdateChecker\v5p7\Vcs\Api::REQUIRE_RELEASE_ASSETS
	);
}

require_once SWMR_DIR . 'includes/class-swmr-data.php';
require_once SWMR_DIR . 'includes/class-swmr-front.php';

if ( is_admin() ) {
	require_once SWMR_DIR . 'includes/class-swmr-admin.php';
	SWMR_Admin::init();
}

SWMR_Front::init();
