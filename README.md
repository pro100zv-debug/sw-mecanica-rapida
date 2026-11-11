# SW Mecánica Rápida

Plugin de WordPress para la landing de mecánica rápida de **Automagia** (Sevilla).

- **`[mr_header]`** — cabecera fija: logo, teléfono y botón «Pedir cita».
- **`[mr_hero]`** — primer pantallazo dinámico. Cambia antetítulo, H1, subtítulo, tiempo y precio según el parámetro `?servicio=` de la URL (una página, un texto por grupo de anuncios de Google Ads). Incluye el coche que se monta en pantalla (SVG animado con CSS, sin librerías) y el cuadro de mandos con el tiempo aproximado y el precio «desde».
- **`[mr_servicios]`** — franja amarilla + tarjetas de servicios con precio «desde». La tarjeta del servicio con el que llega el visitante se marca como «TU SERVICIO».
- **JSON-LD** `AutoRepair` + `WebPage` con todos los servicios y precios, generado desde los mismos datos que se muestran.

## Uso

1. Instalar y activar el plugin.
2. **Mecánica Rápida → Servicios y precios**: textos y precios de cada variante (precios con IVA).
3. **Mecánica Rápida → Tarjetas**: títulos, descripciones e imágenes 3D de las tarjetas.
4. **Mecánica Rápida → Ajustes**: teléfono, ID del popup de Elementor (todos los botones «Pedir cita» abren el formulario en popup), nota de Google, datos del negocio y horario.
5. En Elementor, sección de ancho completo sin padding → widget **Shortcode** → `[mr_hero]`; debajo otra sección con `[mr_servicios]`.

### URLs para Google Ads

| Grupo de anuncios | URL final |
|---|---|
| Mecánica rápida / Taller Sevilla / Cerca de mí | `https://mecanica-rapida.automagia.es/` |
| Cambio de aceite | `/?servicio=aceite` |
| Frenos | `/?servicio=frenos` |
| Neumáticos | `/?servicio=neumaticos` |
| … | ver claves en *Servicios y precios* |

Una clave desconocida o la URL sin parámetro muestran la versión general.

### Notas

- Los datos se guardan en la base de datos (opciones de WordPress): actualizar el plugin no los sobrescribe.
- Al guardar se purga la caché de LiteSpeed Cache. En LiteSpeed, **no** añadir `servicio` a *Drop Query String*.
- El popup de Elementor debe estar disponible en la página (condición de visualización = esta página, sin disparador automático).
- Fuentes: Saira y Montserrat desde los Global Fonts de Elementor (carga local).

## Actualizaciones

Push a `main` con una `Version:` nueva en `sw-mecanica-rapida.php` → GitHub Actions crea la etiqueta, la Release y el zip; WordPress muestra la actualización en *Plugins*.

---
Desarrollo: [SergioWeb](https://sergioweb.es/)
