## 1.0.10

- Imágenes de las tarjetas con texto alternativo: el «Texto alternativo» de la biblioteca de medios o, si está vacío, el nombre del servicio.

## 1.0.9

- «Sevilla Este» sustituido por «Sevilla» en los textos (el taller no está en Sevilla Este). Los textos ya guardados en el panel se corrigen solos una vez.
- Instagram por defecto: talleres_mecanicos_automagia.

## 1.0.8

- Quitada la línea fina bajo el primer bloque, encima de la franja amarilla.

## 1.0.7

- Franja amarilla: ya no se corta en recto por arriba (sin la línea amarilla recta encima).
- Móvil: franja un poco más inclinada.

## 1.0.6

- Imagen de «Alineación y equilibrado» más grande, al tamaño visual de las demás tarjetas.
- Idiomas por defecto: es, en, uk, ru.

## 1.0.5

- Todos los botones «Pedir cita» usan el enlace `#mr-cita`; el plugin abre el popup de Elementor indicado en Ajustes. Sirve también para los bloques pegados como HTML en Elementor.

## 1.0.4

- Los estilos del plugin se cargan en el `<head>` de la página de la landing (antes se añadían al final y la página se veía un instante sin estilos).

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
