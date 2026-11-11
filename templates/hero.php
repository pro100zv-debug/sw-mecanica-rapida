<?php
/**
 * Hero template. Vars: $d (service), $key, $set, $cta, $price, $t_label, $t_text, $dash, $needle.
 *
 * @package SW_Mecanica_Rapida
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$car = file_get_contents( SWMR_DIR . 'assets/img/car.svg' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
?>
<section id="inicio" class="mr-scope mr-hero" aria-labelledby="mr-hero-title" data-servicio="<?php echo esc_attr( $key ); ?>">
	<div class="mr-hero__grid" aria-hidden="true"></div>
	<div class="mr-hero__glow" aria-hidden="true"></div>
	<div class="mr-hero__lights" aria-hidden="true"><i></i><i></i><i></i></div>

	<div class="mr-hero__top">
		<div class="mr-hero__copy">
			<p class="mr-hero__eyebrow"><span aria-hidden="true"></span><?php echo esc_html( $d['eyebrow'] ); ?></p>
			<h1 id="mr-hero-title" class="mr-hero__title">
				<span class="mr-hero__title-solid"><?php echo esc_html( $d['h1a'] ); ?></span>
				<span class="mr-hero__title-outline"><?php echo esc_html( $d['h1b'] ); ?></span>
			</h1>
			<p class="mr-hero__sub"><?php echo esc_html( $d['sub'] ); ?></p>
			<div class="mr-hero__ctas">
				<a class="mr-btn mr-btn--primary" href="<?php echo esc_attr( $cta ); ?>"><?php echo esc_html( $set['cta_label'] ); ?> <span aria-hidden="true">↗</span></a>
				<a class="mr-btn mr-btn--ghost" href="tel:<?php echo esc_attr( $set['phone_tel'] ); ?>"><?php echo esc_html( $set['call_label'] ); ?> <span aria-hidden="true">→</span></a>
			</div>
			<div class="mr-hero__trust">
				<?php if ( '' !== trim( $set['rating'] ) ) : ?>
					<span class="mr-hero__rating"><span class="mr-hero__stars" aria-hidden="true">★★★★★</span><?php echo esc_html( $set['rating'] ); ?><?php echo '' !== trim( $set['reviews'] ) ? ' · ' . esc_html( $set['reviews'] ) . ' reseñas' : ''; ?> en Google</span>
				<?php endif; ?>
				<span class="mr-hero__facts">
					<?php if ( '' !== trim( $set['years'] ) ) : ?><span><?php echo esc_html( $set['years'] ); ?> años</span><?php endif; ?>
					<span>Todas las marcas</span>
					<span>Precio cerrado</span>
				</span>
			</div>
		</div>

		<div class="mr-hero__side">
			<div class="mr-hud">
				<div class="mr-hud__panel">
					<div class="mr-hud__top">
						<span class="mr-hud__on"><i aria-hidden="true"></i>MOTOR · ON</span>
						<span class="mr-hud__brand">AUTOMAGIA</span>
						<span class="mr-hud__lamps" aria-hidden="true"><svg width="14" height="14" viewBox="0 0 32 32" fill="none" stroke="#FFED00" stroke-width="2.4"><path d="M16 4c4 6 7 9.5 7 13.5a7 7 0 0 1-14 0C9 13.5 12 10 16 4z"/></svg><svg width="14" height="14" viewBox="0 0 32 32" fill="none" stroke="#5a5a5a" stroke-width="2.4"><rect x="4" y="10" width="24" height="16" rx="2"/></svg><svg width="14" height="14" viewBox="0 0 32 32" fill="none" stroke="#5a5a5a" stroke-width="2.4"><circle cx="16" cy="16" r="11"/></svg></span>
					</div>
					<div class="mr-hud__row">
						<div class="mr-dial" aria-hidden="true">
							<svg viewBox="0 0 120 120">
								<defs><radialGradient id="mr-dial-bg" cx="50%" cy="45%" r="60%"><stop offset="0" stop-color="#1a1a12"/><stop offset="1" stop-color="#050505"/></radialGradient></defs>
								<circle cx="60" cy="60" r="57" fill="url(#mr-dial-bg)" stroke="#2e2e2e" stroke-width="1.5"/>
								<circle cx="60" cy="60" r="48" fill="none" stroke="#1f1f1f" stroke-width="5" stroke-dasharray="226.2 400" transform="rotate(135 60 60)"/>
								<circle class="mr-dial__arc" cx="60" cy="60" r="48" fill="none" stroke="#FFED00" stroke-width="5" stroke-linecap="round" transform="rotate(135 60 60)" style="stroke-dasharray: <?php echo esc_attr( $dash ); ?> 400"/>
								<line x1="24.6" y1="95.4" x2="22.5" y2="97.5" stroke="#3a3a3a" stroke-width=".8"/><line x1="19.8" y1="89.8" x2="17.4" y2="91.6" stroke="#3a3a3a" stroke-width=".8"/><line x1="15.9" y1="83.6" x2="13.3" y2="85.0" stroke="#3a3a3a" stroke-width=".8"/><line x1="12.9" y1="76.8" x2="10.1" y2="77.9" stroke="#3a3a3a" stroke-width=".8"/><line x1="11.0" y1="69.8" x2="8.0" y2="70.3" stroke="#3a3a3a" stroke-width=".8"/><line x1="10.1" y1="62.5" x2="7.1" y2="62.6" stroke="#3a3a3a" stroke-width=".8"/><line x1="10.2" y1="55.1" x2="7.3" y2="54.8" stroke="#3a3a3a" stroke-width=".8"/><line x1="11.5" y1="47.9" x2="8.6" y2="47.1" stroke="#3a3a3a" stroke-width=".8"/><line x1="13.8" y1="40.9" x2="11.0" y2="39.7" stroke="#3a3a3a" stroke-width=".8"/><line x1="17.1" y1="34.3" x2="14.5" y2="32.8" stroke="#3a3a3a" stroke-width=".8"/><line x1="21.3" y1="28.3" x2="19.0" y2="26.4" stroke="#3a3a3a" stroke-width=".8"/><line x1="26.4" y1="23.0" x2="24.4" y2="20.7" stroke="#3a3a3a" stroke-width=".8"/><line x1="32.2" y1="18.4" x2="30.6" y2="15.9" stroke="#3a3a3a" stroke-width=".8"/><line x1="38.6" y1="14.8" x2="37.3" y2="12.1" stroke="#3a3a3a" stroke-width=".8"/><line x1="45.5" y1="12.2" x2="44.6" y2="9.3" stroke="#3a3a3a" stroke-width=".8"/><line x1="52.7" y1="10.5" x2="52.2" y2="7.6" stroke="#3a3a3a" stroke-width=".8"/><line x1="60.0" y1="10.0" x2="60.0" y2="7.0" stroke="#3a3a3a" stroke-width=".8"/><line x1="67.3" y1="10.5" x2="67.8" y2="7.6" stroke="#3a3a3a" stroke-width=".8"/><line x1="74.5" y1="12.2" x2="75.4" y2="9.3" stroke="#3a3a3a" stroke-width=".8"/><line x1="81.4" y1="14.8" x2="82.7" y2="12.1" stroke="#3a3a3a" stroke-width=".8"/><line x1="87.8" y1="18.4" x2="89.4" y2="15.9" stroke="#3a3a3a" stroke-width=".8"/><line x1="93.6" y1="23.0" x2="95.6" y2="20.7" stroke="#3a3a3a" stroke-width=".8"/><line x1="98.7" y1="28.3" x2="101.0" y2="26.4" stroke="#3a3a3a" stroke-width=".8"/><line x1="102.9" y1="34.3" x2="105.5" y2="32.8" stroke="#3a3a3a" stroke-width=".8"/><line x1="106.2" y1="40.9" x2="109.0" y2="39.7" stroke="#3a3a3a" stroke-width=".8"/><line x1="108.5" y1="47.9" x2="111.4" y2="47.1" stroke="#3a3a3a" stroke-width=".8"/><line x1="109.8" y1="55.1" x2="112.7" y2="54.8" stroke="#3a3a3a" stroke-width=".8"/><line x1="109.9" y1="62.5" x2="112.9" y2="62.6" stroke="#3a3a3a" stroke-width=".8"/><line x1="109.0" y1="69.8" x2="112.0" y2="70.3" stroke="#3a3a3a" stroke-width=".8"/><line x1="107.1" y1="76.8" x2="109.9" y2="77.9" stroke="#3a3a3a" stroke-width=".8"/><line x1="104.1" y1="83.6" x2="106.7" y2="85.0" stroke="#3a3a3a" stroke-width=".8"/><line x1="100.2" y1="89.8" x2="102.6" y2="91.6" stroke="#3a3a3a" stroke-width=".8"/><line x1="95.4" y1="95.4" x2="97.5" y2="97.5" stroke="#3a3a3a" stroke-width=".8"/><line x1="29.6" y1="90.4" x2="22.5" y2="97.5" stroke="#d8d8d8" stroke-width="2.2" stroke-linecap="round"/><text x="36.7" y="86.3" text-anchor="middle" class="mr-dial__num">0</text><line x1="13.9" y1="69.2" x2="8.0" y2="70.3" stroke="#6a6a6a" stroke-width="1.4" stroke-linecap="round"/><line x1="20.3" y1="43.5" x2="11.0" y2="39.7" stroke="#d8d8d8" stroke-width="2.2" stroke-linecap="round"/><text x="29.5" y="50.4" text-anchor="middle" class="mr-dial__num">30</text><line x1="33.9" y1="20.9" x2="30.6" y2="15.9" stroke="#6a6a6a" stroke-width="1.4" stroke-linecap="round"/><line x1="60.0" y1="17.0" x2="60.0" y2="7.0" stroke="#d8d8d8" stroke-width="2.2" stroke-linecap="round"/><text x="60.0" y="30.0" text-anchor="middle" class="mr-dial__num">60</text><line x1="86.1" y1="20.9" x2="89.4" y2="15.9" stroke="#6a6a6a" stroke-width="1.4" stroke-linecap="round"/><line x1="99.7" y1="43.5" x2="109.0" y2="39.7" stroke="#d8d8d8" stroke-width="2.2" stroke-linecap="round"/><text x="90.5" y="50.4" text-anchor="middle" class="mr-dial__num">90</text><line x1="106.1" y1="69.2" x2="112.0" y2="70.3" stroke="#E14B3B" stroke-width="1.4" stroke-linecap="round"/><line x1="90.4" y1="90.4" x2="97.5" y2="97.5" stroke="#E14B3B" stroke-width="2.2" stroke-linecap="round"/><text x="83.3" y="86.3" text-anchor="middle" class="mr-dial__num">120</text>
								<g class="mr-dial__needle" style="--mr-n: <?php echo esc_attr( $needle ); ?>deg; transform: rotate(<?php echo esc_attr( $needle ); ?>deg)"><path d="M58.6 62 L60 12 L61.4 62 Z" fill="#FF4D3A"/></g>
								<circle cx="60" cy="60" r="7" fill="#141414" stroke="#FFED00" stroke-width="1.5"/>
								<text x="60" y="97" text-anchor="middle" class="mr-dial__unit">MIN</text>
							</svg>
						</div>
						<div class="mr-hud__reads">
							<div class="mr-hud__read">
								<span class="mr-hud__label"><?php echo esc_html( $t_label ); ?></span>
								<span class="mr-hud__time"><?php echo esc_html( $t_text ); ?></span>
							</div>
							<div class="mr-hud__read mr-hud__read--price">
								<span class="mr-hud__label">PRECIO DESDE</span>
								<span class="mr-hud__pricewrap"><span class="mr-hud__price"><?php echo esc_html( $price ); ?></span><span class="mr-hud__iva">IVA incl.</span></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="mr-hero__stage-row">
		<div class="mr-stage">
			<div class="mr-stage__halo" aria-hidden="true"></div>
			<div class="mr-stage__rulers" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span><span></span></div>
			<div class="mr-stage__road" aria-hidden="true"></div>
			<div class="mr-stage__car">
				<?php echo $car; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static SVG shipped with the plugin. ?>
				<span class="mr-stage__scan" aria-hidden="true"></span>
			</div>
		</div>
	</div>
</section>
<script data-no-optimize="1" data-no-defer="1" data-no-minify="1" data-cfasync="false" nowprocket>
(function () {
	var hero = document.getElementById('inicio');
	if (!hero || hero.classList.contains('mr-go')) { return; }
	hero.classList.add('mr-wait');
	var started = false;
	function go() {
		if (started) { return; }
		started = true;
		var done = false;
		function start() {
			if (done) { return; }
			done = true;
			hero.classList.remove('mr-wait');
			hero.classList.add('mr-go');
		}
		// Two frames so the browser has painted the static first screen before the assembly starts.
		requestAnimationFrame(function () { requestAnimationFrame(start); });
		setTimeout(start, 120);
	}
	function whenVisible(cb) {
		if (document.visibilityState === 'visible') { cb(); return; }
		document.addEventListener('visibilitychange', function onVis() {
			if (document.visibilityState === 'visible') { document.removeEventListener('visibilitychange', onVis); cb(); }
		});
	}
	var loaded = new Promise(function (res) {
		if (document.readyState === 'complete') { res(); } else { window.addEventListener('load', res, { once: true }); }
	});
	var fonts = (document.fonts && document.fonts.ready) ? document.fonts.ready : Promise.resolve();
	var cap = new Promise(function (res) { setTimeout(res, 3500); });
	Promise.race([Promise.all([loaded, fonts]), cap]).then(function () { whenVisible(go); });
})();
</script>
