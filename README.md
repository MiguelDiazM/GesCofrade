# 🙌 GesCofrade

**GesCofrade** es un software de gestión integral para **hermandades y cofradías**, desarrollado por un equipo de estudiantes del Grado Superior de Desarrollo de Aplicaciones Web 🎓. Facilita la organización de eventos, la administración interna y el seguimiento de procesiones.

## ✨ Características principales

- 👥 Gestión de miembros y cuotas
- 📬 Gestión de correspondencia e inventario
- 📍 Seguimiento GPS en tiempo real durante procesiones
- 🛠️ Modelado 3D de altares, pasos y vestimentas
- 🎨 Interfaz personalizable por hermandad (escudos, colores, etc.)
- 💻📱 Compatibilidad con escritorio, web y app móvil

## 🧰 Tecnologías utilizadas

- **Frontend:** HTML, CSS, JavaScript 🎨
- **Backend:** PHP 🐘
- **Base de datos:** MySQL 🗃️

## 🗂️ Estructura del proyecto

```plaintext
GesCofrade/
├── public/                # Todos los elementos publicos.
  ├── assets/                # Todos los recursos que se usarán en las páginas
    ├── css/                   # Todos los ficheros css
    ├── js/                    # Todos los ficheros js
    ├── img/                   # Todas las imagenes
    ├── fonts/                 # Fuentes usadas
  ├── index.php              # Pagina principal de la web
├── app/                   # Todos los elementos privados
  ├── controllers/           # Todos los scripts para dar funcionalidad a las páginas
  ├── models/                # Script de generación de la BBDD
  ├── views/                 # Todas las vistas de la web
├──config/                 # Contiene ficheros de configuración generales
  ├── bootstrap/             # Contiene los ficheros bootstrap necesarios
  ├── database.php           # Contiene la conexión con la BBDD
├── cypress                # Contiene las pruebas E2E
└── README.md
