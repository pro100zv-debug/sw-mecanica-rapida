<?php
/**
 * Admin: Mecánica Rápida → Servicios / Tarjetas / Ajustes.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

final class SWMR_Admin {

	const CAP  = 'manage_options';
	const SLUG = 'swmr';

	public static function init() {
		add_action( 'admin_menu', array( __CLASS__, 'menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'register' ) );
		add_action( 'admin_enqueue_scripts', array( __CLASS__, 'assets' ) );
		add_action( 'admin_notices', array( __CLASS__, 'notice_popup' ) );
		add_action( 'add_attachment', function () { delete_transient( 'swmr_media_map' ); } );
		add_action( 'delete_attachment', function () { delete_transient( 'swmr_media_map' ); } );
		add_filter( 'plugin_action_links_' . plugin_basename( SWMR_FILE ), array( __CLASS__, 'links' ) );

		// Prices changed → purge page cache so visitors see them at once.
		foreach ( array( SWMR_Data::OPT_SERVICES, SWMR_Data::OPT_TILES, SWMR_Data::OPT_SETTINGS ) as $opt ) {
			add_action( 'update_option_' . $opt, array( __CLASS__, 'purge_cache' ) );
			add_action( 'add_option_' . $opt, array( __CLASS__, 'purge_cache' ) );
		}
	}

	public static function links( $links ) {
		array_unshift( $links, '<a href="' . esc_url( admin_url( 'admin.php?page=' . self::SLUG ) ) . '">Servicios y precios</a>' );
		return $links;
	}

	public static function notice_popup() {
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( ! $screen || false === strpos( (string) $screen->id, self::SLUG ) || SWMR_Data::settings()['popup_id'] ) {
			return;
		}
		echo '<div class="notice notice-warning"><p><strong>Mecánica Rápida:</strong> indica el ID del popup de Elementor con el formulario en <a href="' . esc_url( admin_url( 'admin.php?page=' . self::SLUG . '-settings' ) ) . '">Ajustes</a>. Hasta entonces los botones «Pedir cita» no abren nada.</p></div>';
	}

	public static function purge_cache() {
		delete_transient( 'swmr_media_map' );
		do_action( 'litespeed_purge_all' ); // LiteSpeed Cache.
		if ( function_exists( 'wp_cache_clear_cache' ) ) {
			wp_cache_clear_cache();
		}
	}

	public static function menu() {
		add_menu_page( 'Mecánica Rápida', 'Mecánica Rápida', self::CAP, self::SLUG, array( __CLASS__, 'page_services' ), 'dashicons-car', 58 );
		add_submenu_page( self::SLUG, 'Servicios y precios', 'Servicios y precios', self::CAP, self::SLUG, array( __CLASS__, 'page_services' ) );
		add_submenu_page( self::SLUG, 'Tarjetas', 'Tarjetas', self::CAP, self::SLUG . '-tiles', array( __CLASS__, 'page_tiles' ) );
		add_submenu_page( self::SLUG, 'Ajustes', 'Ajustes', self::CAP, self::SLUG . '-settings', array( __CLASS__, 'page_settings' ) );
	}

	public static function register() {
		register_setting( 'swmr_services', SWMR_Data::OPT_SERVICES, array( 'sanitize_callback' => array( __CLASS__, 'clean_services' ) ) );
		register_setting( 'swmr_tiles', SWMR_Data::OPT_TILES, array( 'sanitize_callback' => array( __CLASS__, 'clean_tiles' ) ) );
		register_setting( 'swmr_settings', SWMR_Data::OPT_SETTINGS, array( 'sanitize_callback' => array( __CLASS__, 'clean_settings' ) ) );
	}

	public static function assets( $hook ) {
		if ( false === strpos( (string) $hook, self::SLUG ) ) {
			return;
		}
		wp_enqueue_media();
		wp_add_inline_style( 'common', self::css() );
		wp_add_inline_script(
			'media-editor',
			'jQuery(function($){$(document).on("click",".swmr-pick",function(e){e.preventDefault();var t=$(this).prev("input");var f=wp.media({title:"Imagen",multiple:false,library:{type:"image"}});f.on("select",function(){t.val(f.state().get("selection").first().toJSON().url).trigger("change");});f.open();});});'
		);
	}

	private static function css() {
		return '.swmr-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(420px,1fr));gap:14px;margin-top:16px}'
			. '.swmr-card{background:#fff;border:1px solid #dcdcde;border-left:4px solid #ffed00;padding:14px 16px}'
			. '.swmr-card h2{margin:0 0 10px;font-size:15px;display:flex;justify-content:space-between;gap:8px}'
			. '.swmr-card h2 code{font-size:12px}'
			. '.swmr-row{display:grid;grid-template-columns:120px 1fr;gap:6px 10px;align-items:center;margin-bottom:6px}'
			. '.swmr-row label{font-weight:600;font-size:12px}'
			. '.swmr-row input[type=text],.swmr-row input[type=url],.swmr-row textarea{width:100%}'
			. '.swmr-two{display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px}'
			. '.swmr-two input{width:100%}'
			. '.swmr-help{background:#fff;border:1px solid #dcdcde;padding:12px 16px;margin-top:12px}';
	}

	/* ---------- Sanitizers ---------- */

	public static function clean_services( $in ) {
		$out = array();
		$def = SWMR_Data::default_services();
		foreach ( $def as $k => $row ) {
			$r         = isset( $in[ $k ] ) && is_array( $in[ $k ] ) ? $in[ $k ] : array();
			$out[ $k ] = array(
				'name'      => sanitize_text_field( $r['name'] ?? $row['name'] ),
				'eyebrow'   => sanitize_text_field( $r['eyebrow'] ?? $row['eyebrow'] ),
				'h1a'       => sanitize_text_field( $r['h1a'] ?? $row['h1a'] ),
				'h1b'       => sanitize_text_field( $r['h1b'] ?? $row['h1b'] ),
				'sub'       => sanitize_textarea_field( $r['sub'] ?? $row['sub'] ),
				'price'     => self::num( $r['price'] ?? $row['price'] ),
				'time'      => ( isset( $r['time'] ) && '' !== trim( (string) $r['time'] ) ) ? absint( $r['time'] ) : null,
				'time_from' => empty( $r['time_from'] ) ? 0 : 1,
			);
		}
		return $out;
	}

	public static function clean_tiles( $in ) {
		$out = array();
		foreach ( (array) $in as $r ) {
			if ( ! is_array( $r ) || '' === trim( (string) ( $r['name'] ?? '' ) ) ) {
				continue;
			}
			$out[] = array(
				'key'      => sanitize_key( $r['key'] ?? '' ),
				'name'     => sanitize_text_field( $r['name'] ),
				'desc'     => sanitize_text_field( $r['desc'] ?? '' ),
				'services' => implode( ',', array_filter( array_map( 'sanitize_key', explode( ',', (string) ( $r['services'] ?? '' ) ) ) ) ),
				'image'    => esc_url_raw( $r['image'] ?? '' ),
			);
		}
		return $out;
	}

	public static function clean_settings( $in ) {
		$def = SWMR_Data::default_settings();
		$out = array();
		foreach ( $def as $k => $v ) {
			$val = $in[ $k ] ?? '';
			switch ( $k ) {
				case 'same_as':
				case 'biz_desc':
					$out[ $k ] = sanitize_textarea_field( $val );
					break;
				case 'logo':
				case 'image':
					$out[ $k ] = esc_url_raw( $val );
					break;
				case 'email':
					$out[ $k ] = sanitize_email( $val );
					break;
				case 'popup_id':
					$out[ $k ] = $val ? (string) absint( $val ) : '';
					break;
				case 'jsonld':
					$out[ $k ] = empty( $val ) ? 0 : 1;
					break;
				default:
					$out[ $k ] = sanitize_text_field( $val );
			}
		}
		return $out;
	}

	private static function num( $v ) {
		$v = str_replace( ',', '.', trim( (string) $v ) );
		return '' === $v ? '' : (float) $v;
	}

	/* ---------- Pages ---------- */

	private static function head( $title, $intro ) {
		echo '<div class="wrap"><h1>' . esc_html( $title ) . '</h1>';
		settings_errors();
		echo '<p>' . wp_kses_post( $intro ) . '</p>';
	}

	public static function page_services() {
		$opt = SWMR_Data::OPT_SERVICES;
		self::head( 'Servicios y precios', 'Un bloque por cada variante del primer pantallazo. La clave es el valor de <code>?servicio=</code> en la URL final de cada grupo de anuncios de Google Ads (sin parámetro = <code>general</code>). Los precios incluyen IVA y se usan en el hero, en las tarjetas y en los datos estructurados. Tiempo en minutos; vacío = «Según modelo».' );
		echo '<form method="post" action="options.php">';
		settings_fields( 'swmr_services' );
		echo '<div class="swmr-grid">';
		foreach ( SWMR_Data::services() as $k => $s ) {
			$n = $opt . '[' . $k . ']';
			echo '<div class="swmr-card"><h2>' . esc_html( $s['name'] ) . ' <code>?servicio=' . esc_html( $k ) . '</code></h2>';
			self::field( $n . '[name]', 'Nombre', $s['name'] );
			self::field( $n . '[eyebrow]', 'Antetítulo', $s['eyebrow'] );
			self::field( $n . '[h1a]', 'H1 · parte 1', $s['h1a'] );
			self::field( $n . '[h1b]', 'H1 · contorno', $s['h1b'] );
			echo '<div class="swmr-row"><label>Subtítulo</label><textarea rows="2" name="' . esc_attr( $n . '[sub]' ) . '">' . esc_textarea( $s['sub'] ) . '</textarea></div>';
			echo '<div class="swmr-two">';
			echo '<label>Precio desde (€)<input type="text" inputmode="decimal" name="' . esc_attr( $n . '[price]' ) . '" value="' . esc_attr( (string) $s['price'] ) . '"></label>';
			echo '<label>Tiempo (min)<input type="number" min="0" name="' . esc_attr( $n . '[time]' ) . '" value="' . esc_attr( null === $s['time'] ? '' : (string) $s['time'] ) . '"></label>';
			echo '<label><br><input type="checkbox" name="' . esc_attr( $n . '[time_from]' ) . '" value="1"' . checked( ! empty( $s['time_from'] ), true, false ) . '> Tiempo «desde»</label>';
			echo '</div></div>';
		}
		echo '</div>';
		submit_button( 'Guardar servicios' );
		echo '</form></div>';
	}

	public static function page_tiles() {
		$opt = SWMR_Data::OPT_TILES;
		self::head( 'Tarjetas de servicios', 'Tarjetas del bloque <code>[mr_servicios]</code>. «Servicios» = claves separadas por comas: el precio de la tarjeta es el más bajo de ellas y la tarjeta se marca como «TU SERVICIO» cuando el visitante llega con una de esas claves. Imagen: render 3D con fondo transparente (PNG/WebP, ~600 px). Vacío = se usa automáticamente la imagen de la biblioteca con el nombre estándar (p. ej. cambio-aceite-filtro.webp).' );
		echo '<form method="post" action="options.php">';
		settings_fields( 'swmr_tiles' );
		echo '<div class="swmr-grid">';
		foreach ( array_values( SWMR_Data::tiles() ) as $i => $t ) {
			$n = $opt . '[' . $i . ']';
			echo '<div class="swmr-card"><h2>' . esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) . ' · ' . $t['name'] ) . '</h2>';
			echo '<input type="hidden" name="' . esc_attr( $n . '[key]' ) . '" value="' . esc_attr( $t['key'] ) . '">';
			self::field( $n . '[name]', 'Título', $t['name'] );
			self::field( $n . '[desc]', 'Descripción', $t['desc'] );
			self::field( $n . '[services]', 'Servicios', $t['services'] );
			echo '<div class="swmr-row"><label>Imagen 3D</label><span style="display:flex;gap:6px"><input type="url" name="' . esc_attr( $n . '[image]' ) . '" value="' . esc_attr( $t['image'] ) . '" style="flex:1"><button class="button swmr-pick">Elegir</button></span></div>';
			echo '</div>';
		}
		echo '</div>';
		submit_button( 'Guardar tarjetas' );
		echo '</form></div>';
	}

	public static function page_settings() {
		$opt = SWMR_Data::OPT_SETTINGS;
		$s   = SWMR_Data::settings();
		self::head( 'Ajustes', 'Shortcodes: <code>[mr_header]</code> (cabecera), <code>[mr_hero]</code> (primer pantallazo) y <code>[mr_servicios]</code> (franja amarilla + tarjetas). Insértalos con el widget «Shortcode» de Elementor en secciones de ancho completo y sin padding.' );
		echo '<form method="post" action="options.php">';
		settings_fields( 'swmr_settings' );
		echo '<div class="swmr-grid">';

		echo '<div class="swmr-card"><h2>Botones y contacto</h2>';
		self::field( $opt . '[cta_label]', 'Texto botón cita', $s['cta_label'] );
		self::field( $opt . '[popup_id]', 'ID popup Elementor', $s['popup_id'], 'Todos los botones «Pedir cita» (enlaces a #mr-cita, también en bloques HTML) abren este popup. Plantillas → Popups → el número de la URL al editarlo (post=123). El popup debe mostrarse en esta página (condiciones) sin disparador automático.' );
		self::field( $opt . '[call_label]', 'Texto botón llamada', $s['call_label'] );
		self::field( $opt . '[phone_display]', 'Teléfono visible', $s['phone_display'] );
		self::field( $opt . '[phone_tel]', 'Teléfono (tel:)', $s['phone_tel'] );
		self::field( $opt . '[email]', 'Email', $s['email'] );
		echo '</div>';

		echo '<div class="swmr-card"><h2>Confianza</h2>';
		self::field( $opt . '[rating]', 'Nota Google', $s['rating'], 'Ej.: 4,9. Vacío = no se muestra la línea de reseñas.' );
		self::field( $opt . '[reviews]', 'Nº reseñas', $s['reviews'] );
		self::field( $opt . '[years]', 'Años', $s['years'] );
		echo '</div>';

		echo '<div class="swmr-card"><h2>Negocio (JSON-LD)</h2>';
		echo '<div class="swmr-row"><label>Activar</label><label><input type="checkbox" name="' . esc_attr( $opt . '[jsonld]' ) . '" value="1"' . checked( ! empty( $s['jsonld'] ), true, false ) . '> Imprimir AutoRepair + WebPage (desactiva el LocalBusiness de tu plugin SEO en esta página)</label></div>';
		self::field( $opt . '[biz_name]', 'Nombre', $s['biz_name'], 'Igual que en Google Business.' );
		self::field( $opt . '[biz_alt]', 'Nombre alternativo', $s['biz_alt'] );
		echo '<div class="swmr-row"><label>Descripción</label><textarea rows="2" name="' . esc_attr( $opt . '[biz_desc]' ) . '">' . esc_textarea( $s['biz_desc'] ) . '</textarea></div>';
		self::field( $opt . '[street]', 'Dirección', $s['street'] );
		self::field( $opt . '[postal]', 'C.P.', $s['postal'] );
		self::field( $opt . '[city]', 'Ciudad', $s['city'] );
		self::field( $opt . '[region]', 'Provincia/CC.AA.', $s['region'] );
		self::field( $opt . '[lat]', 'Latitud', $s['lat'] );
		self::field( $opt . '[lng]', 'Longitud', $s['lng'] );
		self::field( $opt . '[logo]', 'Logo (URL)', $s['logo'], 'También se usa en la cabecera [mr_header].' );
		self::field( $opt . '[image]', 'Foto (URL)', $s['image'] );
		self::field( $opt . '[languages]', 'Idiomas', $s['languages'] );
		echo '<div class="swmr-row"><label>Perfiles (sameAs)</label><textarea rows="3" name="' . esc_attr( $opt . '[same_as]' ) . '">' . esc_textarea( $s['same_as'] ) . '</textarea></div>';
		echo '</div>';

		echo '<div class="swmr-card"><h2>Horario</h2>';
		self::field( $opt . '[wk_open]', 'L–V abre', $s['wk_open'] );
		self::field( $opt . '[wk_close]', 'L–V cierra', $s['wk_close'] );
		self::field( $opt . '[sat_open]', 'Sábado abre', $s['sat_open'], 'Vacío = cerrado.' );
		self::field( $opt . '[sat_close]', 'Sábado cierra', $s['sat_close'] );
		echo '</div>';

		echo '</div>';
		submit_button( 'Guardar ajustes' );
		echo '</form></div>';
	}

	private static function field( $name, $label, $value, $help = '' ) {
		echo '<div class="swmr-row"><label>' . esc_html( $label ) . '</label><span><input type="text" name="' . esc_attr( $name ) . '" value="' . esc_attr( (string) $value ) . '">';
		if ( $help ) {
			echo '<br><small>' . esc_html( $help ) . '</small>';
		}
		echo '</span></div>';
	}
}
