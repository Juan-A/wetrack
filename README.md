<p align="center"><a href="https://en.gravatar.com/" target="_blank"><img src="https://wetrack.juanhc.dev/images/static/wetrack.svg" width="200" alt="Wetrack Logo"></a></p>


## Descripción de componentes de la aplicación

### Controladores (`/app/Http/Controllers`)

Los controladores son los módulos de la aplicación que controlan la lógica de la aplicación (decidir qué hacer con las peticiones HTTP y procesar la información para su gestión con la base de datos).

- `AlbumController`: controlador que maneja los eventos relativos a los álbumes.

| Función | Utilidad o Desempeño |
| --- | --- |
| `view()` | Únicamente se encarga de invocar al controlador de Spotify, obtener un álbum a partir de un ID dado en la url y enviarlo a la vista. |

- `DashController`: controla los eventos relacionados al dashboard del usuario.

| Función | Utilidad o Desempeño |
| --- | --- |
| `index()` | Invoca al controlador de las reviews, obtiene el número de reviews y la media de las calificaciones que ha dado un usuario. |
| `myReviews()` | Invoca al controlador de las reviews y obtiene las reseñas del usuario logueado. Devuelve la vista «myreview» |
| `about()` | Devuelve la vista «about» |

- `ReviewController`: controla los eventos relacionados con las reviews, pasa información a otras funciones.

| Función | Utilidad o Desempeño |
| --- | --- |
| `getReviews($spotifyTrackId)` | Devuelve un array con las reviews de la canción indicada por parámetro (también devuelve el usuario que hizo cada una). |
| `store($request)` | Recibe un post con la calificación, la reseña y el ID de canción, si el usuario no ha opinado antes de la canción, crea una nueva, de lo contrario la edita. |
| `topCommented()` | Devuelve un array con las canciones más comentadas en orden descendente. |
| `topRated()` | Devuelve un array con las canciones con mejor nota media en orden descendente. |
| `getUserReviews()` | Devuelve las reviews del usuario autenticado en la aplicación. |
| `countUserReviews()` | Devuelve el número de reviews del usuario autenticado. |
| `averageUserRating()` | Devuelve la nota media de todas las reviews de un usuario. |
| `destroy($review)` | Elimina la reseña indicada por parámetro (en la URL), comprueba que el usuario autor sea el que borra la review. |

- `SearchController`: controla los eventos relacionados con la búsqueda y la búsqueda en vivo.

| Función | Utilidad o Desempeño |
| --- | --- |
| `index()` | Recibiendo un parámetro GET llamado «query» y «page» invoca al controlador de Spotify y llama a la función de búsqueda, indicando término y página a devolver. Devuelve una vista a la que le pasa esa información. |
| `liveSearch()` | Es parecida a la función anterior, con la salvedad de que no indico página y muestro menos resultados. Devuelvo un JSON. Actúa como endpoint de una API. |

- `SpotifyController`: se trata de uno de los controladores más importantes de la aplicación. Gestiona la lógica/comunicación con la API de Spotify.

| Función | Utilidad o Desempeño |
| --- | --- |
| `__construct()` | Es el constructor de la clase del controlador. Inicializa las variables de URI de redirección y credenciales de la API. |
| `landingPage()` | Invoca al controlador de reviews, y desde este obtiene los top comentados y valorados. Devuelve la vista «welcome» con esos datos, además de con los más escuchados en el top global mediante la función «getGlobalTrends()» del controlador de Spotify. |
| `getPubToken()` | Implica toda la lógica para obtener el token de uso público (usuarios sin autenticar con spotify). Busca el usuario con ID 1 (usuario interno) y en el caso de tener un token caducado (caducan a la hora), obtenemos uno nuevo (los almacenamos en base de datos). |
| `getGlobalTrends()` | Obtiene una playlist de tendencias globales de Spotify. Reordeno los resultados en un array y los devuelvo como tal. |
| `search($query, $isAuth, $page)` | Recibe como parámetros término de búsqueda, si el usuario está autenticado y la página de resultados. Es la función que se encarga de controlar la búsqueda estática (que no en vivo). Distingue entre usuarios autenticados con Spotify y los que no. En el caso de que esté autenticado con Spotify se muestran los resultados disponibles en el país del usuario. Decodifico un JSON y lo devuelvo como array. |
| `liveSearch($query, $isAuth, $numResults)` | Recibe como parámetros término de búsqueda, si el usuario está autenticado y el número de resultados a devolver en la búsqueda en vivo. Se encarga de controlar la búsqueda en vivo. Distingue entre usuarios autenticados y no autenticados. Decodifico un JSON y lo devuelvo como array. |
| `getTrack($id, $isAuth)` | Recibiendo como parámetros el Id de la canción en Spotify y si el usuario está autenticado, devuelve un array con los resultados. Distingue entre usuario autenticado y no autenticado; si la canción no está disponible en el país del perfil de Spotify del usuario, no muestra la canción. El número de parámetros viene definido en las variables de entorno. |
| `getAlbum($id, $isAuth)` | Recibiendo como parámetros el Id del álbum de Spotify y si el usuario está autenticado, devuelve un array con los resultados. El número de resultados viene definido en las variables de entorno. Distingue entre usuarios autenticados y no autenticados. |
| `getAlbumTracks($id, $isAuth)` | Recibe ID de álbum a consultar y si el usuario está autenticado o no. Esta función se encarga de devolver una lista de las canciones del álbum indicado. Distingue entre usuario autenticado y no autenticado. |
| `login()` | En esta función definimos los «scopes» o permisos a solicitar al usuario al autenticarse con Spotify en nuestra aplicación. Incluimos la URL de redirección en la petición. Redireccionamos al usuario al «gate» de Spotify en el que se le solicitan credenciales y autorización al usuario. |
| `authorize()` | Esta función será a la que nos redireccione Spotify cuando el usuario se haya autenticado y dado permisos. Empezará a comprobar si el usuario con el correo asociado está registrado en nuestra aplicación (si lo está, accede directamente), y si no lo está, crea el usuario en la base de datos. Almacena los tokens de usuario en la base de datos, asociándolos al ID de usuario. |
| `refreshToken()` | Como se ha dicho anteriormente, los tokens caducan a la hora (incluidos los del usuario), por lo que si un usuario lleva autenticado con Spotify más de una hora, necesitaré renovarlos; esta función se invoca desde «getUser()» que de momento es la única habilitada para obtener los datos del usuario. |
| `getUser()` | Obtiene los datos del perfil del usuario autenticado (correo, país, imagen de perfil, nombre...). |

- `TrackController`: Controla los eventos relativos a las páginas de las canciones.

| Función | Utilidad o Desempeño |
| --- | --- |
| `show($request)` | Se encarga de recibir como parámetro el ID de Spotify de la canción mediante la URL. Invoca al controlador de Spotify para obtener los datos de la canción y haciendo consultas a la base de datos obtenemos las reseñas y calculamos la media de estas; las pasamos a la vista junto al avatar (que obtenemos invocando a la librería que hemos usado para obtener los «Gravatar»). |

### Modelos

- `Review`: define el comportamiento de la tabla `reviews` en la base de datos; defino como campos insertables `user_id`, `spotify_id`, `review` y `calification`.
  - `user()`: una reseña puede pertenecer a un usuario.
  - `track()`: una reseña puede ser de una canción.

- `SpotifyToken`: define el comportamiento de la tabla `spotify_tokens`. Los campos rellenables serán `token`, `user`, `authToken` y `refreshToken`.
  - `user()`: Un token puede pertenecer a un usuario.

- `Track`: define el comportamiento de la tabla `tracks`.
  - Defino como campos rellenables `spotify_id`, `name`, `json`, `description`.
  - Hago un cast para decir a Laravel que el campo `json` se trate como un array.
  - Digo que la clave primaria será `spotify_id` (Laravel por defecto toma el campo id, pero en nuestro caso no existe o no nos interesa que sea ese).
  - El campo de la clave primaria no es autoincremental.
  - La clave primaria es un campo string.
  - `review()`: una canción puede tener muchas reseñas.

### Políticas

Tenemos la capacidad de determinar políticas para validar las acciones que ciertos usuarios son capaces de realizar. En resumidas cuentas, es una medida de seguridad añadida para evitar acciones no autorizadas.

- Políticas de «reviews»
  - `update()`: un usuario será capaz de actualizar una reseña siempre y cuando sea el propietario de esta.
  - `delete()`: un usuario será capaz de eliminar una reseña siempre y cuando sea el propietario de esta.

### Migraciones de la base de datos

Con el sistema incorporado en **Laravel**, *Eloquent*, podemos definir la estructura de una base de datos de una forma versionable (es fácil realizar un seguimiento de las modificaciones) y compatible con varios motores de bases de datos, como *SQLite* o *MariaDB* de una forma bastante visual y con PHP (un lenguaje que puede resultarnos más ameno).

Hemos creado las siguientes migraciones (no contaremos la de los usuarios, por ser creadas por defecto con *Breeze* de **Laravel**):

- Tabla `spotify_tokens` (Almacena los tokens de acceso a **Spotify** de los usuarios):
  - Campo `Id` auto-incremental.
  - Campo `authToken` de tipo string, que puede ser nulo; almacena el token de autenticación del usuario.
  - Campo `refreshToken` de tipo string, que puede ser nulo; Almacena el token de actualización de token del usuario.
  - Campo `user`, que referencia a la tabla de usuarios; se trata de un ID. Cuando el usuario se elimina, se elimina su tupla correspondiente; Almacena el id del usuario referenciado.
  - Laravel crea automáticamente campos de fecha de creación y actualización de la tupla.

- Tabla `tracks` (Almacena canciones que han tenido o tienen reseñas):
  - Campo `spotify_id`: de tipo string, que actuará como clave primaria. No es auto-incremental; Almacena una cadena que contiene el ID de la canción en **Spotify**.
  - Campo `name`: de tipo «tiny» string para los nombres de usuarios.
  - Campo `json`: de tipo «json» (eloquent adapta el tipo final según el motor de base de datos). Puede ser nulo.
  - Campo `description`: de tipo texto, que puede ser nulo; A futuro, se pensaba usar para tener la posibilidad de añadir descripciones manualmente a las canciones.
  - Laravel crea automáticamente campos de fecha de creación y actualización de la tupla.

- Tabla `reviews` (Almacena las reviews de los usuarios):
  - Campo `Id`: auto-incremental, clave primaria.
  - Campo `spotify_id`: referencia a otra tabla, el campo `spotify_id` de la tabla `tracks`. La review es eliminada si la tupla de la canción es eliminada.
  - Campo `review`: con un máximo de 500 caracteres, puede ser nula. Almacena la reseña.
  - Campo `calification`: almacena un decimal con 3 posiciones (1 entera, 2 decimales); puede ser nula.
  - Laravel crea automáticamente campos de fecha de creación y actualización de la tupla.

### Semillas

Como datos iniciales de la aplicación, necesitaré un usuario **internal** al que asigaré los token de acceso a usuarios no registrados con spotify (o sin registrar).

Creo un usuario, y también le creo una tupla con su ID en la tabla de *tokens*.

```php
<?php
public function run(): void
{
    // User::factory(10)->create();

    User::factory()->create([
        'name' => 'internal',
        'email' => 'internal@admin.local',
    ]);
    SpotifyToken::create([
        'user' => 1,
    ]);
}
```
### Vistas de la aplicación

- `resources/views/album/index.blade.php`: La vista correspondiente a la página en la que se muestra un álbum.
- `resources/views/auth/*`: todos los archivos relativos a la autenticación; estas vistas venían por defecto con Laravel Breeze, pero se han modificado y adaptado para DaisyUI.
- `resources/views/components/application-logo.blade.php`: ha sido el único archivo de su directorio que ha sido modificado, ha sido para incluir el logotipo de nuestra aplicación en el resto de pantallas de la aplicación, de una forma estándar.
- `resources/views/layouts/navigation.blade.php`: Este se trata de la barra de navegación superior, en que se encuentran la búsqueda en vivo, logo y menús de navegación/acceso de la aplicación.
- `resources/views/layouts/footer.blade.php`: Este se trata del footer de la aplicación, aquí se encuentran el logotipo y enlance a políticas de la aplicación.
- `resources/views/profile/*`: se encuentran todos los archivos relativos a la edición del perfil de usuario en el dashboard. Estos venían con Laravel Breeze, pero se han personalizado y adaptado para funcionar con DaisyUI.
- `resources/views/search/index.blade.php`: se trata de la página de búsqueda, en ella están el formulario de búsqueda principal, una animación de carga oculta a la espera de un submit, y la lista de álbumes y canciones, con paginación incluida.
- `resources/views/track/index.blade.php`: es la vista que utilizamos para mostrar una canción, valorarla y comentarla. Se mostrará la nota media en su «ficha principal» (ubicada en lo más alto) y más abajo los formularios y lista de comentarios. Incluye enlaces a Spotify.
- `resources/views/about.blade.php`: Es la página donde mostramos la política de privacidad, cookies y de uso de la aplicación, además de la atribución de derechos.
- `resources/views/dashboard.blade.php`: página principal del panel del usuario, aquí se mostrarán estadísticas del usuario en la aplicación y otros dos botones (a modo de accesos directos), para acceder a la modificación del perfil y las valoraciones del usuario autenticado.
- `resources/views/myreviews.blade.php`: sección en la que muestro al usuario todas sus reseñas en la web. Paginación incluida.
- `resources/views/profile.blade.php`: Página de prueba para mostrar el perfil de Spotify de un usuario.
- `resources/views/welcome.blade.php`: Página principal/landing de la aplicación. Muestra un top de canciones globales, top comentadas y top valoradas.

## Hecho con:

### Laravel PHP Framework
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

### Tailwind CSS
<p align="center"><a href="https://tailwindcss.com/" target="_blank"><img src="https://raw.githubusercontent.com/tailwindlabs/tailwindcss/HEAD/.github/logo-dark.svg" width="400" alt="Tailwind Logo"></a></p>

### Daisy UI
<p align="center"><a href="https://daisyui.com/" target="_blank"><img src="https://raw.githubusercontent.com/saadeghi/daisyui-images/master/images/daisyui-logo/favicon-192.png" width="150" alt="DaisyUI Logo"></a></p>

### Spotify API
<p align="center"><a href="https://developer.spotify.com/documentation/web-api/" target="_blank"><img src="https://developer.spotify.com/images/spotify-for-developers-logo.svg#s4d-logo" width="400" alt="Spotify API Logo"></a></p>

### Gravatar and Creative Orange (for the Gravatar API)
<p align="center"><a href="https://en.gravatar.com/" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Gravatar_logo.svg" width="200" alt="Gravatar Logo"></a></p>

### PACE.js (for the loading bar)
<a href='https://github.com/CodeByZach/pace'>Repository</a>

## De la propiedad intelectual
Los derechos de autor de la aplicación pertenecen a **Juan Antonio Herrero**, en ningún caso al centro o institución de enseñanza, tal y como lo regula la LPI (**Ley de propiedad Intelectual**, Real Decreto Legislativo 1/1996, de 12 de abril), que no especifica nada al respecto de los trabajos realizados por alumnos en centros de enseñanza, y por lo tanto, se entiende que los derechos de autor de los trabajos realizados por los alumnos son de su propiedad, salvo normativa interna de la institución que lo regule).

* La difusión de este trabajo es libre, siempre y cuando se respeten los derechos de autor y se cite la fuente original.

* No se permite la copia, modificación o distribución de este trabajo con fines comerciales, sólo de forma educativa o de divulgación.

La aplicación ha sido desarrollada como proyecto final del ciclo superior de **Desarrollo de Aplicaciones Web**.
