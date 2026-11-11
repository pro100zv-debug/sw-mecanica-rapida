<?php
/**
 * Default data, option storage and helpers.
 *
 * Prices and texts live in the WordPress database (options), never in the plugin files,
 * so updating the plugin from GitHub never overwrites what was edited in the admin.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class SWMR_Data {

	const OPT_SERVICES = 'swmr_services';
	const OPT_TILES    = 'swmr_tiles';
	const OPT_SETTINGS = 'swmr_settings';

	/** Hero variants. Key = value of ?servicio= in the Google Ads final URL. Prices include IVA. */
	public static function default_services() {
		return array(
			'general' => array(
				'name'      => 'Mecánica rápida',
				'eyebrow'   => 'Taller de mecánica rápida · Sevilla',
				'h1a'       => 'Mecánica rápida',
				'h1b'       => 'en Sevilla',
				'sub'       => 'Aceite, frenos, neumáticos, batería y aire acondicionado en un solo taller. Precio cerrado antes de empezar.',
				'price'     => 30,
				'time'      => 10,
				'time_from' => 1,
			),
			'aceite' => array(
				'name'      => 'Cambio de aceite y filtro',
				'eyebrow'   => 'Cambio de aceite',
				'h1a'       => 'Cambio de aceite y filtro',
				'h1b'       => 'en Sevilla',
				'sub'       => 'El aceite que pide tu fabricante, filtro nuevo y revisión de niveles incluida.',
				'price'     => 30,
				'time'      => 60,
				'time_from' => 0,
			),
			'filtros' => array(
				'name'      => 'Cambio de filtros de aire, habitáculo y combustible',
				'eyebrow'   => 'Cambio de filtros',
				'h1a'       => 'Cambio de filtros',
				'h1b'       => 'del coche',
				'sub'       => 'Aire, habitáculo y combustible. Menos consumo y aire limpio dentro del coche.',
				'price'     => 12,
				'time'      => null,
				'time_from' => 0,
			),
			'caja' => array(
				'name'      => 'Cambio de aceite de caja de cambios',
				'eyebrow'   => 'Aceite de caja',
				'h1a'       => 'Cambio de aceite',
				'h1b'       => 'de caja de cambios',
				'sub'       => 'Manual, automática, DSG y CVT. Evita tirones y alarga la vida de la caja.',
				'price'     => 60,
				'time'      => null,
				'time_from' => 0,
			),
			'revision' => array(
				'name'      => 'Revisión del coche',
				'eyebrow'   => 'Revisión y mantenimiento',
				'h1a'       => 'Revisión del coche',
				'h1b'       => 'en Sevilla',
				'sub'       => 'Motor, frenos, suspensión, luces y niveles. Te decimos qué urge y qué puede esperar.',
				'price'     => 60,
				'time'      => null,
				'time_from' => 0,
			),
			'preitv' => array(
				'name'      => 'Revisión pre-ITV',
				'eyebrow'   => 'Revisión pre-ITV',
				'h1a'       => 'Revisión pre-ITV',
				'h1b'       => 'en Sevilla',
				'sub'       => 'Lo revisamos y lo corregimos antes, para que pases la ITV a la primera.',
				'price'     => 60,
				'time'      => 60,
				'time_from' => 1,
			),
			'diagnosis' => array(
				'name'      => 'Diagnosis electrónica multimarca',
				'eyebrow'   => 'Diagnosis electrónica',
				'h1a'       => 'Diagnosis del coche',
				'h1b'       => 'por ordenador',
				'sub'       => '¿Testigo encendido? Leemos la avería en todas las marcas antes de cambiar nada.',
				'price'     => 30,
				'time'      => 30,
				'time_from' => 0,
			),
			'frenos' => array(
				'name'      => 'Cambio de pastillas y discos de freno',
				'eyebrow'   => 'Frenos',
				'h1a'       => 'Cambio de pastillas',
				'h1b'       => 'y discos de freno',
				'sub'       => '¿Chirría o vibra al frenar? Revisamos pastillas, discos y líquido de frenos.',
				'price'     => 60,
				'time'      => 120,
				'time_from' => 0,
			),
			'neumaticos' => array(
				'name'      => 'Montaje y equilibrado de neumáticos',
				'eyebrow'   => 'Neumáticos',
				'h1a'       => 'Cambio de neumáticos',
				'h1b'       => 'en Sevilla',
				'sub'       => 'Neumáticos nuevos o los tuyos: montaje y equilibrado en el día.',
				'price'     => 25,
				'time'      => 20,
				'time_from' => 1,
			),
			'pinchazo' => array(
				'name'      => 'Reparación de pinchazos',
				'eyebrow'   => 'Pinchazos',
				'h1a'       => 'Reparación',
				'h1b'       => 'de pinchazos',
				'sub'       => 'Comprobamos si se puede reparar con seguridad y lo dejamos listo en minutos.',
				'price'     => 15,
				'time'      => 10,
				'time_from' => 0,
			),
			'alineacion' => array(
				'name'      => 'Alineación y equilibrado de ruedas',
				'eyebrow'   => 'Alineación y equilibrado',
				'h1a'       => 'Alineación y equilibrado',
				'h1b'       => 'de ruedas',
				'sub'       => '¿El coche se va hacia un lado o vibra el volante? Lo ajustamos con precisión.',
				'price'     => 25,
				'time'      => 60,
				'time_from' => 0,
			),
			'bateria' => array(
				'name'      => 'Cambio de batería',
				'eyebrow'   => 'Batería',
				'h1a'       => 'Cambio de batería',
				'h1b'       => 'del coche',
				'sub'       => 'Comprobamos tu batería y la cambiamos al momento, también Start&Stop.',
				'price'     => 49,
				'time'      => 30,
				'time_from' => 0,
			),
			'aire' => array(
				'name'      => 'Recarga de aire acondicionado',
				'eyebrow'   => 'Aire acondicionado',
				'h1a'       => 'Recarga de aire acondicionado',
				'h1b'       => 'del coche',
				'sub'       => '¿Tu aire no enfría? Buscamos fugas y recargamos el gas R134a y R1234yf.',
				'price'     => 85,
				'time'      => 60,
				'time_from' => 0,
			),
			'amortiguadores' => array(
				'name'      => 'Cambio de amortiguadores',
				'eyebrow'   => 'Suspensión',
				'h1a'       => 'Cambio de',
				'h1b'       => 'amortiguadores',
				'sub'       => 'Más estabilidad y menos distancia de frenado. Delanteros y traseros.',
				'price'     => 60,
				'time'      => null,
				'time_from' => 0,
			),
			'escape' => array(
				'name'      => 'Reparación de tubo de escape',
				'eyebrow'   => 'Tubo de escape',
				'h1a'       => 'Reparación del',
				'h1b'       => 'tubo de escape',
				'sub'       => 'Silenciador, flexible y catalizador, con presupuesto al momento.',
				'price'     => 30,
				'time'      => null,
				'time_from' => 0,
			),
			'distribucion' => array(
				'name'      => 'Cambio de correa de distribución',
				'eyebrow'   => 'Distribución',
				'h1a'       => 'Cambio de correa',
				'h1b'       => 'de distribución',
				'sub'       => 'Kit completo y bomba de agua cuando toca. Precio cerrado para tu modelo.',
				'price'     => 240,
				'time'      => null,
				'time_from' => 0,
			),
			'escobillas' => array(
				'name'      => 'Cambio de escobillas limpiaparabrisas',
				'eyebrow'   => 'Escobillas',
				'h1a'       => 'Cambio de escobillas',
				'h1b'       => 'limpiaparabrisas',
				'sub'       => 'Escobillas nuevas, montadas en minutos.',
				'price'     => 10,
				'time'      => null,
				'time_from' => 0,
			),
			'bombillas' => array(
				'name'      => 'Cambio de bombillas',
				'eyebrow'   => 'Bombillas',
				'h1a'       => 'Cambio de bombillas',
				'h1b'       => 'del coche',
				'sub'       => 'Faros, intermitentes y pilotos: los cambiamos al momento.',
				'price'     => 2,
				'time'      => null,
				'time_from' => 0,
			),
			'refrigerante' => array(
				'name'      => 'Cambio de líquido refrigerante',
				'eyebrow'   => 'Líquido refrigerante',
				'h1a'       => 'Cambio de líquido',
				'h1b'       => 'refrigerante',
				'sub'       => 'Vaciado y relleno del circuito para evitar sobrecalentamientos.',
				'price'     => 10,
				'time'      => null,
				'time_from' => 0,
			),
		);
	}

	/** Service cards (block 2). "services" = comma list of service keys; price = lowest of them. */
	public static function default_tiles() {
		return array(
			array(
				'key'      => 'aceite',
				'name'     => 'Cambio de aceite y filtro',
				'desc'     => 'El aceite que pide tu fabricante y filtro nuevo.',
				'services' => 'aceite',
				'image'    => '',
			),
			array(
				'key'      => 'filtros',
				'name'     => 'Cambio de filtros',
				'desc'     => 'Aire, habitáculo y combustible.',
				'services' => 'filtros',
				'image'    => '',
			),
			array(
				'key'      => 'caja',
				'name'     => 'Aceite de caja de cambios',
				'desc'     => 'Manual, automática, DSG y CVT.',
				'services' => 'caja',
				'image'    => '',
			),
			array(
				'key'      => 'revision',
				'name'     => 'Revisión del coche',
				'desc'     => 'Motor, frenos, luces y niveles.',
				'services' => 'revision',
				'image'    => '',
			),
			array(
				'key'      => 'preitv',
				'name'     => 'Revisión pre-ITV',
				'desc'     => 'Lo dejamos listo para pasar la ITV a la primera.',
				'services' => 'preitv',
				'image'    => '',
			),
			array(
				'key'      => 'diagnosis',
				'name'     => 'Diagnosis electrónica',
				'desc'     => '¿Testigo encendido? Todas las marcas.',
				'services' => 'diagnosis',
				'image'    => '',
			),
			array(
				'key'      => 'frenos',
				'name'     => 'Pastillas y discos de freno',
				'desc'     => 'Pastillas, discos y líquido de frenos.',
				'services' => 'frenos',
				'image'    => '',
			),
			array(
				'key'      => 'neumaticos',
				'name'     => 'Cambio de neumáticos',
				'desc'     => 'Montaje y equilibrado en el día.',
				'services' => 'neumaticos',
				'image'    => '',
			),
			array(
				'key'      => 'pinchazo',
				'name'     => 'Reparación de pinchazos',
				'desc'     => 'Comprobamos y reparamos con seguridad.',
				'services' => 'pinchazo',
				'image'    => '',
			),
			array(
				'key'      => 'alineacion',
				'name'     => 'Alineación y equilibrado',
				'desc'     => 'Si el coche se va hacia un lado o vibra el volante.',
				'services' => 'alineacion',
				'image'    => '',
			),
			array(
				'key'      => 'bateria',
				'name'     => 'Cambio de batería',
				'desc'     => 'Comprobación y cambio, también Start&Stop.',
				'services' => 'bateria',
				'image'    => '',
			),
			array(
				'key'      => 'aire',
				'name'     => 'Recarga de aire acondicionado',
				'desc'     => 'Recarga de gas y detección de fugas.',
				'services' => 'aire',
				'image'    => '',
			),
			array(
				'key'      => 'amortiguadores',
				'name'     => 'Amortiguadores',
				'desc'     => 'Delanteros y traseros, montaje incluido.',
				'services' => 'amortiguadores',
				'image'    => '',
			),
			array(
				'key'      => 'escape',
				'name'     => 'Tubo de escape',
				'desc'     => 'Silenciador, flexible y catalizador.',
				'services' => 'escape',
				'image'    => '',
			),
			array(
				'key'      => 'distribucion',
				'name'     => 'Correa de distribución',
				'desc'     => 'Kit completo y bomba de agua cuando toca.',
				'services' => 'distribucion',
				'image'    => '',
			),
			array(
				'key'      => 'pequenos',
				'name'     => 'Escobillas, bombillas y líquidos',
				'desc'     => 'Pequeños cambios, hechos al momento.',
				'services' => 'escobillas,bombillas,refrigerante',
				'image'    => '',
			),
		);
	}

	/** Fallback line icons for cards without an uploaded 3D image. */
	public static function icons() {
		return array(
			'aceite' => '<path d="M16 4c4 6 7 9.5 7 13.5a7 7 0 0 1-14 0C9 13.5 12 10 16 4z"/><path d="M12.5 18.5a3.5 3.5 0 0 0 3.5 3.5"/>',
			'filtros' => '<rect x="9" y="5" width="14" height="22" rx="2"/><path d="M9 10h14M9 22h14M13 10v12M16 10v12M19 10v12"/>',
			'caja' => '<circle cx="8" cy="7" r="2"/><circle cx="16" cy="7" r="2"/><circle cx="24" cy="7" r="2"/><circle cx="8" cy="25" r="2"/><circle cx="16" cy="25" r="2"/><path d="M8 9v14M16 9v14M24 9v7H8"/>',
			'revision' => '<rect x="7" y="6" width="18" height="22" rx="2"/><path d="M12 6V4h8v2"/><path d="M11.5 17l3 3 6-6.5"/>',
			'preitv' => '<path d="M16 4l10 4v7c0 6.5-4.3 11-10 13-5.7-2-10-6.5-10-13V8z"/><path d="M11.5 16l3 3 6-6.5"/>',
			'diagnosis' => '<rect x="4" y="7" width="24" height="16" rx="2"/><path d="M8 15h4l2-4 3 8 2-4h5"/><path d="M12 27h8M16 23v4"/>',
			'frenos' => '<circle cx="16" cy="16" r="11"/><circle cx="16" cy="16" r="3.5"/><circle cx="16" cy="9" r=".8"/><circle cx="23" cy="16" r=".8"/><circle cx="16" cy="23" r=".8"/><circle cx="9" cy="16" r=".8"/><path d="M22 5.5a12.5 12.5 0 0 1 5 6" stroke-width="2.6"/>',
			'neumaticos' => '<circle cx="16" cy="16" r="12"/><circle cx="16" cy="16" r="6"/><path d="M16 4v4M16 24v4M4 16h4M24 16h4M7.5 7.5l2.8 2.8M21.7 21.7l2.8 2.8M7.5 24.5l2.8-2.8M21.7 10.3l2.8-2.8"/>',
			'pinchazo' => '<circle cx="14" cy="18" r="10"/><circle cx="14" cy="18" r="4.5"/><path d="M22 4l6 6M25 7l-6 6"/>',
			'alineacion' => '<rect x="5" y="6" width="5" height="20" rx="1.5"/><rect x="22" y="6" width="5" height="20" rx="1.5"/><path d="M10 16h12M13 13l-3 3 3 3M19 13l3 3-3 3"/>',
			'bateria' => '<rect x="4" y="10" width="24" height="16" rx="2"/><path d="M9 10V7h4v3M19 10V7h4v3M8 18h4M10 16v4M20 18h4"/>',
			'aire' => '<path d="M16 3v26M4.7 9.5l22.6 13M4.7 22.5l22.6-13M12.5 5.5L16 8l3.5-2.5M12.5 26.5L16 24l3.5 2.5"/>',
			'amortiguadores' => '<path d="M16 3v4M16 25v4M11 7h10M11 25h10"/><path d="M11 9l10 2.5-10 2.5 10 2.5-10 2.5 10 2.5-10 2.5"/>',
			'escape' => '<path d="M3 20h6"/><rect x="9" y="15" width="14" height="10" rx="5"/><path d="M23 20h4l2-3"/><path d="M25 10c1-1.5 2.5-1.5 3.5 0M23 6c1-1.5 2.5-1.5 3.5 0"/>',
			'distribucion' => '<circle cx="10" cy="20" r="6"/><circle cx="23" cy="10" r="4"/><circle cx="10" cy="20" r="1.5"/><circle cx="23" cy="10" r="1"/><path d="M5.5 16L20 7M14.5 24.5L26.5 12.5"/>',
			'pequenos' => '<path d="M16 4a8 8 0 0 0-5 14.2c1 .9 1.5 2 1.5 3.3V23h7v-1.5c0-1.3.5-2.4 1.5-3.3A8 8 0 0 0 16 4z"/><path d="M13 27h6"/>',
		);
	}

	public static function default_settings() {
		return array(
			'phone_display'  => '629 244 444',
			'phone_tel'      => '+34629244444',
			'popup_id'       => '',
			'cta_label'      => 'Pedir cita online',
			'call_label'     => 'Llámanos',
			'rating'         => '',
			'reviews'        => '',
			'years'          => '15',
			'biz_name'       => 'Automagia',
			'biz_alt'        => 'Automagia Talleres Mecánicos',
			'biz_desc'       => 'Taller de mecánica rápida multimarca en Sevilla: cambio de aceite, frenos, neumáticos, aire acondicionado, pre-ITV y diagnosis electrónica.',
			'email'          => 'automagia.es@gmail.com',
			'street'         => 'Av. Fernández Murube, 40',
			'city'           => 'Sevilla',
			'region'         => 'Andalucía',
			'postal'         => '41007',
			'lat'            => '37.387347',
			'lng'            => '-5.944113',
			'wk_open'        => '08:00',
			'wk_close'       => '18:00',
			'sat_open'       => '09:00',
			'sat_close'      => '14:00',
			'logo'           => '',
			'image'          => '',
			'same_as'        => "https://automagia.es/\nhttps://www.instagram.com/talleres_mecanicos_automagia/\nhttps://www.facebook.com/taller.de.automagia",
			'languages'      => 'es,en,uk,ru',
			'jsonld'         => 1,
		);
	}

	/**
	 * One-time fix of saved texts: the workshop is not in "Sevilla Este".
	 * Replaces it with "Sevilla" in saved services and settings.
	 */
	public static function migrate() {
		if ( get_option( 'swmr_fix_sevilla' ) ) {
			return;
		}
		$fix = function ( $v ) use ( &$fix ) {
			if ( is_array( $v ) ) {
				return array_map( $fix, $v );
			}
			return is_string( $v ) ? str_replace( array( 'en Sevilla Este', 'Sevilla Este' ), array( 'en Sevilla', 'Sevilla' ), $v ) : $v;
		};
		foreach ( array( 'swmr_services', 'swmr_settings', 'swmr_tiles' ) as $opt ) {
			$val = get_option( $opt, null );
			if ( null !== $val && false !== $val ) {
				$new = $fix( $val );
				if ( $new !== $val ) {
					update_option( $opt, $new );
				}
			}
		}
		update_option( 'swmr_fix_sevilla', 1, false );
	}

	public static function services() {
		$saved = get_option( self::OPT_SERVICES );
		$def   = self::default_services();
		if ( ! is_array( $saved ) ) {
			return $def;
		}
		foreach ( $def as $k => $row ) {
			$def[ $k ] = isset( $saved[ $k ] ) && is_array( $saved[ $k ] ) ? array_merge( $row, $saved[ $k ] ) : $row;
		}
		return $def;
	}

	public static function tiles() {
		$saved = get_option( self::OPT_TILES );
		return is_array( $saved ) && $saved ? $saved : self::default_tiles();
	}

	/** Media-library file names (without extension) used when a card has no image set. */
	public static function default_files() {
		return array(
			'aceite' => 'cambio-aceite-filtro',
			'filtros' => 'cambio-filtros-coche',
			'caja' => 'aceite-caja-cambios',
			'revision' => 'revision-coche',
			'preitv' => 'revision-pre-itv',
			'diagnosis' => 'diagnosis-electronica-coche',
			'frenos' => 'pastillas-discos-freno',
			'neumaticos' => 'cambio-neumaticos',
			'pinchazo' => 'reparacion-pinchazos',
			'alineacion' => 'alineacion-equilibrado-ruedas',
			'bateria' => 'cambio-bateria-coche',
			'aire' => 'recarga-aire-acondicionado-coche',
			'amortiguadores' => 'cambio-amortiguadores',
			'escape' => 'tubo-escape',
			'distribucion' => 'correa-distribucion',
			'pequenos' => 'escobillas-bombillas-liquidos',
		);
	}

	/**
	 * Card image URL: the one set in Tarjetas, else the media-library image whose slug
	 * matches the default file name (e.g. cambio-aceite-filtro.webp). Cached for 12 h.
	 */
	public static function tile_image( $tile ) {
		if ( ! empty( $tile['image'] ) ) {
			return $tile['image'];
		}
		$files = self::default_files();
		if ( empty( $tile['key'] ) || empty( $files[ $tile['key'] ] ) ) {
			return '';
		}
		$map = get_transient( 'swmr_media_map' );
		if ( ! is_array( $map ) ) {
			$map = array();
			foreach ( $files as $k => $slug ) {
				$ids = get_posts(
					array(
						'post_type'      => 'attachment',
						'post_status'    => 'inherit',
						'name'           => $slug,
						'posts_per_page' => 1,
						'fields'         => 'ids',
						'no_found_rows'  => true,
					)
				);
				$map[ $k ] = $ids ? (string) wp_get_attachment_url( $ids[0] ) : '';
			}
			set_transient( 'swmr_media_map', $map, 12 * HOUR_IN_SECONDS );
		}
		return isset( $map[ $tile['key'] ] ) ? $map[ $tile['key'] ] : '';
	}

	/** True on the page that holds the [mr_hero] / [mr_servicios] shortcodes (also inside Elementor data). */
	public static function is_landing() {
		if ( ! is_singular() ) {
			return false;
		}
		$id      = get_queried_object_id();
		$content = (string) get_post_field( 'post_content', $id ) . (string) get_post_meta( $id, '_elementor_data', true );
		return false !== strpos( $content, 'mr_hero' ) || false !== strpos( $content, 'mr_servicios' );
	}

	public static function settings() {
		$saved = get_option( self::OPT_SETTINGS );
		return array_merge( self::default_settings(), is_array( $saved ) ? $saved : array() );
	}

	/** Active service key from ?servicio= (only known keys), else "general". */
	public static function current_key() {
		static $key = null;
		if ( null !== $key ) {
			return $key;
		}
		$key  = 'general';
		$want = isset( $_GET['servicio'] ) ? sanitize_key( wp_unslash( $_GET['servicio'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if ( $want && array_key_exists( $want, self::services() ) ) {
			$key = $want;
		}
		return $key;
	}

	/**
	 * URL for every "Pedir cita" button. The plugin's script opens the Elementor popup
	 * set in Ajustes when a link to #mr-cita is clicked (also links pasted as HTML in Elementor).
	 */
	public static function cta_url() {
		return '#mr-cita';
	}

	public static function price_text( $price ) {
		$p = (float) $price;
		return ( floor( $p ) == $p ? number_format_i18n( $p, 0 ) : number_format_i18n( $p, 2 ) ) . ' €';
	}

	/** Lowest price among the services of a card. */
	public static function tile_price( $tile, $services ) {
		$min = null;
		foreach ( array_filter( array_map( 'trim', explode( ',', (string) $tile['services'] ) ) ) as $k ) {
			if ( isset( $services[ $k ] ) && '' !== $services[ $k ]['price'] && null !== $services[ $k ]['price'] ) {
				$p   = (float) $services[ $k ]['price'];
				$min = null === $min ? $p : min( $min, $p );
			}
		}
		return $min;
	}
}
