# 🐾 El Latido del Lince — ONG de Conservación del Lince Ibérico

Plataforma web completa para la gestión interna de una ONG dedicada a la conservación del Lince Ibérico (*Lynx pardinus*). Permite coordinar eventos de voluntariado, gestionar donaciones y administrar usuarios, todo desde una interfaz moderna y responsiva.

## ✅ Estado del Proyecto

**Proyecto finalizado.** Todas las funcionalidades están implementadas y operativas.

## 🚀 Características

- **Página de inicio**: Presentación de la misión de la ONG, información sobre el lince y llamada a la acción.
- **Sistema de usuarios**: Registro con validación, inicio de sesión seguro, roles (admin / usuario) y edición de perfil con foto.
- **Gestión de donaciones**: Donaciones identificadas y anónimas con seguimiento del objetivo de recaudación activo.
- **Quedadas y voluntariado**: Listado de eventos disponibles, inscripción/baja con control automático de aforo.
- **Panel de administración**: Gestión completa de usuarios y quedadas con estadísticas globales.
- **Página del lince**: Sección informativa sobre la biología, amenazas y acciones de conservación de la especie.
- **Sistema de recompensas**: Medallas por nivel de donación (bronce, plata y oro).

## 🛠️ Tecnologías Utilizadas

- **Frontend**: HTML5, Tailwind CSS, JavaScript (vanilla).
- **Backend**: PHP 8.2 — arquitectura MVC nativa sin frameworks.
- **Base de datos**: MariaDB 10.4 (MySQL) con MySQLi y PreparedStatements.
- **Iconos**: FontAwesome 6.
- **Tipografía**: Google Fonts (Inter, Playfair Display).

## 📂 Estructura del Proyecto

```text
ONG/
├── Controlador/          # Lógica de negocio: login, registro, inscripciones, donaciones, admin...
├── Modelo/               # Acceso a datos: consultas SQL con PreparedStatements
├── vista/                # Vistas HTML/PHP: todas las páginas de la aplicación
├── Partes/               # Componentes reutilizables: header.php y footer.php
├── assets/               # Imágenes, recursos multimedia
├── conexion/             # Inicialización de la conexión MySQLi
└── index.php             # Página principal / punto de entrada
```

## ⚙️ Instalación

1. **Requisitos**: Tener instalado [XAMPP](https://www.apachefriends.org/es/index.html) con PHP 8.2 y MariaDB 10.4.
2. **Ubicación**: Clona o descarga el repositorio en `C:\xampp\htdocs\ONG`.
3. **Base de datos**: Abre phpMyAdmin, crea una base de datos llamada `bdong` e importa el archivo `bdong.sql` incluido en el repositorio.
4. **Conexión**: Verifica que `conexion/conexion_base_datos.php` apunta a tu servidor local.
5. **Servidor**: Inicia **Apache** y **MySQL** desde el Panel de Control de XAMPP.
6. **Acceso**: Abre el navegador y navega a `http://localhost/ONG/`.

## 🔐 Seguridad implementada

- Contraseñas cifradas con bcrypt (`password_hash` / `password_verify`).
- Protección contra SQL Injection mediante PreparedStatements.
- Protección contra XSS mediante `htmlspecialchars()`.
- Control de acceso por roles con verificación de sesión en cada controlador.
- Bloqueo tras 3 intentos fallidos de login.

---

*Protegiendo el latido del bosque.* 🌲🐾
