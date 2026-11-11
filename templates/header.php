<?php
/**
 * Header template. Vars: $set, $cta.
 *
 * @package SW_Mecanica_Rapida
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="mr-scope mr-header">
	<div class="mr-header__in">
		<a class="mr-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( ! empty( $set['logo'] ) ) : ?>
				<img src="<?php echo esc_url( $set['logo'] ); ?>" alt="<?php echo esc_attr( $set['biz_alt'] ? $set['biz_alt'] : $set['biz_name'] ); ?>" width="48" height="48">
			<?php endif; ?>
			<span class="mr-header__name"><span><?php echo esc_html( mb_strtoupper( $set['biz_name'] ) ); ?></span><small>MECÁNICA RÁPIDA · <?php echo esc_html( mb_strtoupper( $set['city'] ) ); ?></small></span>
		</a>
		<div class="mr-header__actions">
			<a class="mr-header__tel" href="tel:<?php echo esc_attr( $set['phone_tel'] ); ?>" aria-label="<?php echo esc_attr( 'Llamar al ' . $set['phone_display'] ); ?>">
				<svg aria-hidden="true" width="16" height="16" viewBox="0 0 32 32" fill="none" stroke="#FFED00" stroke-width="2.2" stroke-linejoin="round"><path d="M7 4h5l2 6-3 2a16 16 0 0 0 9 9l2-3 6 2v5a2 2 0 0 1-2 2A23 23 0 0 1 5 6a2 2 0 0 1 2-2z"/></svg>
				<span><?php echo esc_html( $set['phone_display'] ); ?></span>
			</a>
			<a class="mr-btn mr-btn--primary mr-header__cta" href="<?php echo esc_attr( $cta ); ?>">Pedir cita <span aria-hidden="true">↗</span></a>
		</div>
	</div>
</header>
