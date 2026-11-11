<?php
/**
 * Service cards template. Vars: $services, $tiles, $icons, $key, $set, $cta.
 *
 * @package SW_Mecanica_Rapida
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$diag_price = isset( $services['diagnosis'] ) ? SWMR_Data::price_text( $services['diagnosis']['price'] ) : '';
$marquee    = array( 'Cambio de aceite', 'Frenos', 'Neumáticos', 'Aire acondicionado', 'Pre-ITV', 'Diagnosis multimarca', 'Batería', 'Distribución' );
?>
<div class="mr-scope mr-road" aria-hidden="true">
	<div class="mr-road__track">
		<?php for ( $i = 0; $i < 2; $i++ ) : ?>
			<?php foreach ( $marquee as $m ) : ?>
				<span><?php echo esc_html( mb_strtoupper( $m ) ); ?> ◆</span>
			<?php endforeach; ?>
		<?php endfor; ?>
	</div>
</div>

<section id="servicios" class="mr-scope mr-services" aria-labelledby="mr-services-title">
	<div class="mr-wrap">
		<div class="mr-head">
			<div class="mr-head__main">
				<p class="mr-eyebrow">01 / Mecánica rápida</p>
				<h2 id="mr-services-title" class="mr-h2">Servicios de<br>mecánica rápida<br><span class="mr-y">en Sevilla.</span></h2>
			</div>
			<div class="mr-head__aside">
				<p class="mr-head__text">En nuestro taller de mecánica rápida en Sevilla Este ves el precio desde el primer momento y pides cita en dos clics. Todas las marcas.</p>
				<div class="mr-facts">
					<span>Precio cerrado</span>
					<?php if ( '' !== trim( $set['years'] ) ) : ?><span><?php echo esc_html( $set['years'] ); ?> años</span><?php endif; ?>
					<span>Multimarca</span>
				</div>
			</div>
		</div>

		<div class="mr-tiles">
			<?php
			$n = 0;
			foreach ( $tiles as $t ) :
				$n++;
				$keys   = array_filter( array_map( 'trim', explode( ',', (string) $t['services'] ) ) );
				$active = in_array( $key, $keys, true );
				$min    = SWMR_Data::tile_price( $t, $services );
				$icon   = isset( $icons[ $t['key'] ] ) ? $icons[ $t['key'] ] : '';
				$img    = SWMR_Data::tile_image( $t );
				?>
				<a class="mr-tile<?php echo $active ? ' is-active' : ''; ?>" href="<?php echo esc_attr( $cta ); ?>" data-servicio="<?php echo esc_attr( $t['key'] ); ?>">
					<span class="mr-tile__card" aria-hidden="true"></span>
					<span class="mr-tile__media" aria-hidden="true">
						<?php if ( $img ) : ?>
							<img src="<?php echo esc_url( $img ); ?>" alt="" width="300" height="300" loading="lazy" decoding="async">
						<?php else : ?>
							<span class="mr-tile__ph"><svg viewBox="0 0 32 32" fill="none" stroke="#FFED00" stroke-width="1.1" stroke-linecap="round" stroke-linejoin="round"><?php echo $icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- static icon markup. ?></svg></span>
						<?php endif; ?>
					</span>
					<span class="mr-tile__top">
						<span class="mr-tile__num"><?php echo esc_html( str_pad( (string) $n, 2, '0', STR_PAD_LEFT ) ); ?></span>
						<?php if ( $active ) : ?><span class="mr-tile__badge">TU SERVICIO</span><?php endif; ?>
					</span>
					<h3 class="mr-tile__title"><?php echo esc_html( $t['name'] ); ?></h3>
					<span class="mr-tile__desc"><?php echo esc_html( $t['desc'] ); ?></span>
					<span class="mr-tile__foot">
						<span class="mr-tile__pricebox">
							<?php if ( null !== $min ) : ?>
								<span class="mr-tile__from">DESDE</span>
								<span class="mr-tile__price"><?php echo esc_html( SWMR_Data::price_text( $min ) ); ?></span>
							<?php else : ?>
								<span class="mr-tile__from">PRECIO</span>
								<span class="mr-tile__price mr-tile__price--ask">Consultar</span>
							<?php endif; ?>
						</span>
						<span class="mr-tile__go" aria-hidden="true">↗</span>
					</span>
				</a>
			<?php endforeach; ?>
		</div>

		<div class="mr-ribbon">
			<div class="mr-ribbon__text">
				<p class="mr-ribbon__title">¿No sabes qué le pasa a tu coche?</p>
				<p class="mr-ribbon__sub">Hacemos diagnosis multimarca<?php echo $diag_price ? ' desde ' . esc_html( $diag_price ) : ''; ?> y te damos el precio cerrado antes de tocar nada.</p>
			</div>
			<div class="mr-ribbon__ctas">
				<a class="mr-btn mr-btn--primary mr-btn--sm" href="<?php echo esc_attr( $cta ); ?>"><?php echo esc_html( $set['cta_label'] ); ?> <span aria-hidden="true">↗</span></a>
				<a class="mr-btn mr-btn--ghost mr-btn--sm" href="tel:<?php echo esc_attr( $set['phone_tel'] ); ?>"><?php echo esc_html( $set['call_label'] ); ?> <span aria-hidden="true">→</span></a>
			</div>
		</div>
	</div>
</section>
