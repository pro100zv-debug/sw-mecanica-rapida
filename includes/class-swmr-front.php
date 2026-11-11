<?php
/**
 * Front end: [mr_hero] and [mr_servicios] shortcodes, styles and JSON-LD.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class SWMR_Front {

	/** True once a shortcode rendered on this request (JSON-LD is printed only then). */
	private static $used = false;

	public static function init() {
		add_shortcode( 'mr_hero', array( __CLASS__, 'hero' ) );
		add_shortcode( 'mr_servicios', array( __CLASS__, 'servicios' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'register_assets' ) );
		add_action( 'wp_footer', array( __CLASS__, 'jsonld' ), 20 );
	}

	public static function register_assets() {
		wp_register_style( 'swmr', SWMR_URL . 'assets/css/mr.css', array(), SWMR_VERSION );
	}

	private static function use_assets() {
		self::$used = true;
		wp_enqueue_style( 'swmr' );
	}

	private static function render( $template, $vars ) {
		extract( $vars, EXTR_SKIP ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
		ob_start();
		include SWMR_DIR . 'templates/' . $template . '.php';
		return ob_get_clean();
	}

	/** [mr_hero] — full first screen. */
	public static function hero() {
		self::use_assets();
		$services = SWMR_Data::services();
		$key      = SWMR_Data::current_key();
		$d        = $services[ $key ];
		$set      = SWMR_Data::settings();

		$time     = ( '' === $d['time'] || null === $d['time'] ) ? null : max( 0, (int) $d['time'] );
		$has_time = null !== $time;
		$frac     = $has_time ? min( $time / 120, 1 ) : 0;
		if ( ! $has_time ) {
			$t_label = 'TIEMPO';
			$t_text  = 'Según modelo';
		} else {
			$t_label = ! empty( $d['time_from'] ) ? 'TIEMPO MÍNIMO' : 'TIEMPO APROX.';
			$t_text  = ( $time >= 60 && 0 === $time % 60 ) ? ( $time / 60 ) . ' H' : $time . ' MIN';
		}

		return self::render(
			'hero',
			array(
				'd'       => $d,
				'key'     => $key,
				'set'     => $set,
				'cta'     => SWMR_Data::cta_url(),
				'price'   => '' === (string) $d['price'] ? 'Consultar' : SWMR_Data::price_text( $d['price'] ),
				't_label' => $t_label,
				't_text'  => $t_text,
				'dash'    => number_format( $frac * 226.2, 1, '.', '' ),
				'needle'  => number_format( -135 + $frac * 270, 1, '.', '' ),
			)
		);
	}

	/** [mr_servicios] — road strip + service cards + diagnosis ribbon. */
	public static function servicios() {
		self::use_assets();
		$services = SWMR_Data::services();
		return self::render(
			'servicios',
			array(
				'services' => $services,
				'tiles'    => SWMR_Data::tiles(),
				'icons'    => SWMR_Data::icons(),
				'key'      => SWMR_Data::current_key(),
				'set'      => SWMR_Data::settings(),
				'cta'      => SWMR_Data::cta_url(),
			)
		);
	}

	/** AutoRepair + WebPage JSON-LD, built from the same data the page shows. */
	public static function jsonld() {
		$set = SWMR_Data::settings();
		if ( ! self::$used || empty( $set['jsonld'] ) ) {
			return;
		}
		$url    = trailingslashit( home_url( '/' ) );
		$offers = array();
		foreach ( SWMR_Data::services() as $k => $s ) {
			if ( 'general' === $k || '' === (string) $s['price'] ) {
				continue;
			}
			$offers[] = array(
				'@type'              => 'Offer',
				'itemOffered'        => array( '@type' => 'Service', 'name' => $s['name'] ),
				'priceSpecification' => array( '@type' => 'PriceSpecification', 'minPrice' => (float) $s['price'], 'priceCurrency' => 'EUR' ),
			);
		}
		$hours = array();
		if ( $set['wk_open'] && $set['wk_close'] ) {
			$hours[] = array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => array( 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday' ), 'opens' => $set['wk_open'], 'closes' => $set['wk_close'] );
		}
		if ( $set['sat_open'] && $set['sat_close'] ) {
			$hours[] = array( '@type' => 'OpeningHoursSpecification', 'dayOfWeek' => 'Saturday', 'opens' => $set['sat_open'], 'closes' => $set['sat_close'] );
		}
		$biz = array_filter(
			array(
				'@type'                     => 'AutoRepair',
				'@id'                       => $url . '#taller',
				'name'                      => $set['biz_name'],
				'alternateName'             => $set['biz_alt'],
				'description'               => $set['biz_desc'],
				'url'                       => $url,
				'telephone'                 => $set['phone_tel'],
				'email'                     => $set['email'],
				'image'                     => $set['image'],
				'logo'                      => $set['logo'],
				'address'                   => array(
					'@type'           => 'PostalAddress',
					'streetAddress'   => $set['street'],
					'addressLocality' => $set['city'],
					'addressRegion'   => $set['region'],
					'postalCode'      => $set['postal'],
					'addressCountry'  => 'ES',
				),
				'geo'                       => ( $set['lat'] && $set['lng'] ) ? array( '@type' => 'GeoCoordinates', 'latitude' => (float) $set['lat'], 'longitude' => (float) $set['lng'] ) : null,
				'openingHoursSpecification' => $hours,
				'areaServed'                => array( '@type' => 'City', 'name' => $set['city'] ),
				'knowsLanguage'             => array_values( array_filter( array_map( 'trim', explode( ',', $set['languages'] ) ) ) ),
				'sameAs'                    => array_values( array_filter( array_map( 'trim', preg_split( '/\R/', (string) $set['same_as'] ) ) ) ),
				'hasOfferCatalog'           => array( '@type' => 'OfferCatalog', 'name' => 'Servicios de mecánica rápida', 'itemListElement' => $offers ),
			)
		);
		$graph = array(
			'@context' => 'https://schema.org',
			'@graph'   => array(
				$biz,
				array(
					'@type'      => 'WebPage',
					'@id'        => $url . '#webpage',
					'url'        => $url,
					'name'       => wp_get_document_title(),
					'inLanguage' => 'es-ES',
					'about'      => array( '@id' => $url . '#taller' ),
				),
			),
		);
		echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $graph, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
