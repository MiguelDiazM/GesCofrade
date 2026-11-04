# GesCofrade

**GesCofrade** es una aplicación web de gestión para **hermandades y cofradías**. Permite a cada hermandad registrarse, gestionar su censo de hermanos y llevar el control de su inventario de enseres desde un panel privado.

Proyecto final desarrollado en equipo por estudiantes del Grado Superior de Desarrollo de Aplicaciones Web.

---

## Índice

1. [Funcionalidades](#funcionalidades)
2. [Tecnologías](#tecnologías)
3. [Arquitectura](#arquitectura)
4. [Estructura del proyecto](#estructura-del-proyecto)
5. [Modelo de datos](#modelo-de-datos)
6. [Seguridad](#seguridad)
7. [Requisitos](#requisitos)
8. [Instalación](#instalación)
9. [Puesta en marcha](#puesta-en-marcha)
10. [Tests E2E con Cypress](#tests-e2e-con-cypress)
11. [Solución de problemas](#solución-de-problemas)
12. [Limitaciones conocidas y hoja de ruta](#limitaciones-conocidas-y-hoja-de-ruta)
13. [Equipo](#equipo)
14. [Documentación adicional](#documentación-adicional)

---

## Funcionalidades

### Implementadas

| Módulo | Descripción |
|---|---|
| **Página pública** | Presentación del producto, planes de suscripción y opiniones de clientes. |
| **Registro de hermandad** | Alta de una hermandad (nombre, ciudad y tipo: penitencia o gloria). Crea automáticamente dos cuentas de acceso. |
| **Inicio y cierre de sesión** | Autenticación con contraseña cifrada y sesión de PHP. |
| **Panel (dashboard)** | Resumen con el número de hermanos y de elementos de inventario de la hermandad, y acceso a los módulos. |
| **Hermanos** | Listado, búsqueda, alta, edición y baja de hermanos. Un hermano puede pertenecer a varias hermandades; al darlo de baja solo deja la hermandad actual. |
| **Inventario** | Listado, búsqueda, alta, edición y baja de los enseres de la hermandad. |
| **Modo claro / oscuro** | Cambio de tema en el panel. |

Cada hermandad solo ve y modifica sus propios datos.

### En desarrollo

Los módulos **Cuotas**, **Correspondencia**, **Cortejo**, **Diseño 3D** y **Ajustes** aparecen en el menú del panel y muestran una página de "en desarrollo".

---

## Tecnologías

| Capa | Tecnología |
|---|---|
| Backend | PHP 8.2 con PDO (consultas preparadas) |
| Base de datos | MariaDB 10.4 / MySQL |
| Frontend | HTML5, CSS3 y JavaScript sin frameworks |
| Tests E2E | Cypress 14 |
| Entorno local | XAMPP (Apache + PHP + MariaDB) |

No se utiliza ningún framework de PHP ni gestor de dependencias del lado del servidor: el proyecto funciona copiándolo en el directorio de Apache.

---

## Arquitectura

La aplicación sigue una separación sencilla inspirada en MVC:

- **Vistas** (`app/views/`, `public/index.php`): páginas PHP que generan el HTML. Las vistas privadas comprueban la sesión antes de mostrar nada.
- **Controladores** (`app/controllers/`): reciben los formularios por `POST`, validan los datos, ejecutan las consultas y redirigen a la vista correspondiente. También exponen las funciones de lectura que usan las vistas (`mostrarHermanos()`, `mostrarInventario()`, `mostrarNombreHermandad()`).
- **Modelo** (`app/models/gesCofrade_bd.sql`): script de creación de la base de datos con datos de ejemplo.
- **Configuración** (`config/database.php`): conexión PDO y gestión global de errores.

### Flujo de una petición

```text
Formulario (vista)  ──POST──▶  Controlador  ──PDO──▶  MySQL
        ▲                          │
        └──── redirección con ─────┘
              mensajes ?err_*=
```

Los errores de validación se devuelven a la vista como parámetros `err_*` en la URL, y la vista los muestra escapados.

---

## Estructura del proyecto

```text
GesCofrade/
├── app/
│   ├── controllers/
│   │   ├── dashboardLogic.php    # Nombre de la hermandad para el panel
│   │   ├── hermanosLogic.php     # Alta, edición, baja y listado de hermanos
│   │   ├── inventarioLogic.php   # Alta, edición, baja y listado de inventario
│   │   ├── loginLogic.php        # Inicio de sesión
│   │   ├── logout.php            # Cierre de sesión
│   │   └── signupLogic.php       # Registro de hermandades
│   ├── models/
│   │   └── gesCofrade_bd.sql     # Esquema de la base de datos y datos de ejemplo
│   └── views/
│       ├── dashboard.php
│       ├── desarrollo.php        # Página para módulos en desarrollo
│       ├── hermanos.php
│       ├── inventario.php
│       ├── login.php
│       └── signup.php
├── config/
│   └── database.php              # Conexión a la base de datos
├── cypress/
│   ├── e2e/                      # Tests end-to-end
│   └── support/                  # Comandos personalizados (cy.login)
├── other/                        # Documentación, prototipos de Figma y diagramas
├── public/
│   ├── assets/                   # CSS, JavaScript, imágenes y fuentes
│   └── index.php                 # Página de inicio pública
├── cypress.config.js
├── package.json                  # Dependencias de desarrollo (Cypress)
└── README.md
```

---

## Modelo de datos

| Tabla | Clave primaria | Descripción |
|---|---|---|
| `hermandad` | `id_hermandad` | Hermandades registradas: nombre, tipo y ubicación. |
| `usuarios` | `id_usuario` | Cuentas de acceso. Cada usuario pertenece a una hermandad (`id_hermandad`, clave foránea con borrado en cascada). El nombre de usuario es único. |
| `hermanos` | `DNI` | Censo de hermanos. `id_hermandad` es un array JSON con las hermandades a las que pertenece (por ejemplo `[1,4]`). |
| `inventario` | `referencia` | Enseres de cada hermandad (`id_hermandad`, clave foránea con borrado en cascada). |
| `modulos` | `id_modulo` | Reservada para los módulos contratables. Todavía no se usa. |

```text
hermandad 1 ──── N usuarios
hermandad 1 ──── N inventario
hermandad N ──── N hermanos   (array JSON en hermanos.id_hermandad)
```

Al registrar una hermandad se crean dos usuarios:

- `<nombre>_<ciudad>`
- `admin_<nombre>_<ciudad>`

Los espacios se sustituyen por `_` y los dos comparten la contraseña elegida en el registro. El nombre generado no puede superar los 50 caracteres.

---

## Seguridad

| Medida | Implementación |
|---|---|
| Contraseñas | Cifradas con `password_hash()` y comprobadas con `password_verify()`. |
| Inyección SQL | Todas las consultas usan sentencias preparadas de PDO. |
| Control de acceso | Las vistas privadas y las operaciones de escritura exigen sesión iniciada. |
| Aislamiento entre hermandades | La hermandad se obtiene siempre de la sesión, nunca del formulario, y todas las consultas filtran por ella. |
| XSS | Toda la salida dinámica se escapa con `htmlspecialchars()`. |
| CSRF | Los formularios de hermanos e inventario incluyen un token de sesión que se valida con `hash_equals()`. |
| Sesiones | El identificador de sesión se regenera al iniciar sesión; al cerrarla se eliminan los datos y la cookie. |
| Gestión de errores | Las excepciones no capturadas se registran en el log y el usuario solo ve un mensaje genérico. |
| Integridad del registro | La hermandad y sus usuarios se crean en una única transacción. |

---

## Requisitos

- [XAMPP](https://www.apachefriends.org/) 8.2 o superior (Apache, PHP 8.2 y MariaDB 10.4).
- Git.
- [Node.js](https://nodejs.org/) 18 o superior, **solo** para ejecutar los tests.

---

## Instalación

### 1. Clonar el repositorio en el directorio de Apache

El proyecto debe quedar en la carpeta `GesCofrade`, porque los tests usan la URL `https://localhost/GesCofrade`.

```bash
cd C:/xampp/htdocs
git clone https://github.com/MiguelDiazM/GesCofrade.git GesCofrade
```

### 2. Arrancar Apache y MySQL

Abre el **XAMPP Control Panel** y pulsa **Start** en **Apache** y en **MySQL**.

### 3. Crear la base de datos

El script `app/models/gesCofrade_bd.sql` crea la base de datos `gescofrade`, sus tablas y los datos de ejemplo.

**Opción A: phpMyAdmin**

1. Abre `http://localhost/phpmyadmin`.
2. Ve a la pestaña **Importar**.
3. Selecciona `app/models/gesCofrade_bd.sql` y pulsa **Importar**.

**Opción B: línea de comandos**

```bash
C:/xampp/mysql/bin/mysql.exe -u root --default-character-set=utf8mb4 < app/models/gesCofrade_bd.sql
```

> Si la base de datos `gescofrade` ya existe, el script fallará al crear las tablas. Para reinstalarla desde cero, haz antes una copia de seguridad y elimínala con `DROP DATABASE gescofrade;`.

### 4. Configurar la conexión

Los datos de conexión están en `config/database.php`. Por defecto coinciden con una instalación estándar de XAMPP:

```php
$_host = "localhost";
$_bd = "gescofrade";
$_usuario = "root";
$_contrasenia = "";
```

Si tu MySQL usa otro usuario o contraseña, cámbialos en ese archivo.

---

## Puesta en marcha

Con Apache y MySQL en marcha, abre:

```text
http://localhost/GesCofrade/public/index.php
```

### Usuarios de prueba

Los datos de ejemplo incluyen varias hermandades y sus usuarios. Para probar la aplicación, usa:

| Usuario | Contraseña | Hermandad |
|---|---|---|
| `admin_admin` | `admin` | `admin` (id 13, con hermanos e inventario de ejemplo) |

También puedes registrar una hermandad nueva desde **Registrarse** e iniciar sesión con el usuario generado.

---

## Tests E2E con Cypress

Los tests recorren la aplicación en un navegador real:

| Spec | Qué comprueba |
|---|---|
| `LoginAuth.cy.js` | Inicio y cierre de sesión, error con contraseña incorrecta y redirección al login en páginas privadas. |
| `RegisterAuth.cy.js` | Registro de una hermandad e inicio de sesión con su usuario, y rechazo de nombres demasiado largos. |
| `hermanos.cy.js` | Alta, edición y baja de un hermano. |
| `inventory.cy.js` | Alta, edición y baja de un elemento de inventario. |

### Preparación

```bash
npm install
```

Los tests acceden por `https://localhost/GesCofrade`. XAMPP trae HTTPS activado por defecto con un certificado autofirmado, que Cypress acepta.

### Ejecución

Interfaz gráfica:

```bash
npx cypress open
```

Toda la suite en modo consola:

```bash
npx cypress run
```

Un spec concreto:

```bash
npx cypress run --spec cypress/e2e/hermanos.cy.js
```

### Datos que generan los tests

- Los tests de hermanos e inventario usan un identificador único en cada ejecución y borran el registro que crean.
- El test de registro crea una hermandad nueva en cada ejecución (con nombre `cy` seguido de una marca de tiempo) y no la elimina.

---

## Solución de problemas

| Síntoma | Causa probable y solución |
|---|---|
| Error 404 al abrir la aplicación | La carpeta no está en `htdocs` o no se llama `GesCofrade`. Comprueba la ruta de la URL. |
| `ERROR: No se puede conectar a la BBDD` | MySQL no está arrancado, la base de datos no se ha importado o los datos de `config/database.php` no son correctos. |
| "Se ha producido un error inesperado" | El detalle del error está en `C:/xampp/apache/logs/error.log`. |
| No se puede iniciar sesión con un usuario recién registrado | El usuario es `<nombre>_<ciudad>`, con los espacios cambiados por `_`. Respeta mayúsculas y tildes. |
| Los tests no encuentran `https://localhost/GesCofrade` | Comprueba que Apache tiene el módulo SSL activo y que el proyecto está en `htdocs/GesCofrade`. |

---

## Limitaciones conocidas y hoja de ruta

### Limitaciones actuales

- La relación entre hermanos y hermandades se guarda como un array JSON, sin claves foráneas.
- No hay roles: el usuario `admin_` y el usuario normal tienen los mismos permisos.
- La validación de formatos (DNI, teléfono) es básica.
- Las credenciales de la base de datos están en `config/database.php`, pensadas para desarrollo local.

### Mejoras previstas

- Tabla intermedia `hermano_hermandad` con integridad referencial.
- Roles y permisos por usuario.
- Configuración de la base de datos fuera del código versionado.
- Validación completa de formularios en el backend.
- Desarrollo de los módulos pendientes: cuotas, correspondencia, cortejo, diseño 3D y ajustes.

---

## Equipo

Proyecto desarrollado en equipo por:

- **Miguel Díaz** ([@MiguelDiazM](https://github.com/MiguelDiazM)): backend, diseño de la base de datos, estructura del proyecto, gestión de Pull Requests y planificación en Jira.
- **Ángel Núñez Guerrero** ([@angeelng](https://github.com/angeelng))
- **Álvaro de la Torre Palomo** ([@alvarodltorre](https://github.com/alvarodltorre))
- **Aitor** ([@Aitoritis](https://github.com/Aitoritis))

---

## Documentación adicional

La carpeta `other/` contiene material complementario del proyecto:

- `other/documentation/`: documentación del proyecto, seguimiento semanal, preparación del entorno y guía de uso de Git del equipo.
- `other/figma/`: prototipos de las pantallas.
- `other/information/`: diagrama del proyecto (formato Dia).

La fuente Roboto se distribuye bajo la licencia SIL Open Font License (`public/assets/fonts/OFL.txt`).
