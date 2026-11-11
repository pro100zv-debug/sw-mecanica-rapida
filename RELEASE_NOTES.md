## 1.0.3

- La animación del coche y la aguja del cuadro esperan a que la página y las fuentes terminen de cargar (máx. 3,5 s) y a que la pestaña esté visible, para que el montaje se vea completo y fluido.
- El script está excluido de las optimizaciones de LiteSpeed / WP Rocket (no se retrasa hasta la interacción).

## 1.0.2

- Nuevo shortcode `[mr_header]`: cabecera fija con logo, teléfono y «Pedir cita» (popup).
- Las tarjetas sin imagen usan automáticamente la imagen de la biblioteca de medios con el nombre estándar (cambio-aceite-filtro.webp, etc.).
- Con Yoast SEO, el AutoRepair se añade al grafo de Yoast (sin JSON-LD duplicado) y su WebPage apunta al taller.

## 1.0.1

- «Pedir cita» abre siempre el popup de Elementor con el formulario (ya no baja a #contacto).
- Aviso en el admin mientras falte el ID del popup.

## 1.0.0

- Shortcode `[mr_hero]`: hero dinámico por `?servicio=` (19 variantes), coche SVG animado, cuadro de mandos con tiempo y precio «desde».
- Shortcode `[mr_servicios]`: franja amarilla y 16 tarjetas con precio «desde» y marca «TU SERVICIO».
- Admin: Servicios y precios, Tarjetas, Ajustes. JSON-LD AutoRepair + WebPage. Purga de LiteSpeed Cache. Actualizaciones desde GitHub.
