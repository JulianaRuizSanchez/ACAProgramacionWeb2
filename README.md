# Sistema de Gestión de Citas - IPS Alma Vida

Este proyecto es una aplicación web moderna desarrollada para digitalizar el registro y gestión de citas de exámenes laborales en la IPS Alma Vida. El sistema soluciona problemáticas como la doble asignación de turnos y la pérdida de información mediante validaciones en tiempo real y una arquitectura sólida.

**Autor:** Juliana Ruiz Sánchez - Ficha: 51189
**Materia:** Desarrollo Web (Ingeniería de Sistemas - CUN)  
**Arquitectura:** MVC (Modelo-Vista-Controlador) en PHP nativo  

---

## Tecnologías Utilizadas

* **Backend:** PHP 8+ puro (PDO, Sentencias Preparadas, Manejo de Sesiones).
* **Base de Datos:** MySQL.
* **Frontend:** HTML5, CSS3, TailwindCSS (vía CDN), SweetAlert2.
* **Lógica del Cliente:** JavaScript Vanilla (Validaciones en tiempo real, Fetch API / AJAX, Paginación dinámica).

---

## Requisitos Previos

Para ejecutar este proyecto en tu entorno local, necesitas tener instalado:

1. Un servidor local como **XAMPP**, **WAMP** o **MAMP** (que incluya Apache y MySQL).
2. Un navegador web moderno (Chrome, Edge, Firefox, Brave).

---

## Instrucciones de Instalación y Ejecución

Sigue estos pasos para desplegar el proyecto en `localhost`:

### Paso 1: Clonar o descargar el repositorio
Descarga este código o clona el repositorio dentro de la carpeta pública de tu servidor local.
* Si usas **XAMPP**: Coloca la carpeta en `C:\xampp\htdocs\`.
* Si usas **WAMP**: Coloca la carpeta en `C:\wamp\www\`.
* Si usas **MAMP**: Coloca la carpeta en `/Applications/MAMP/htdocs/`.

*(Asegúrate de que la carpeta del proyecto se llame `ips_alma_vida` o renómbrala a tu gusto, pero recuerda el nombre para el Paso 3).*

### Paso 2: Configurar la Base de Datos
1. Abre tu servidor local (Apache y MySQL deben estar encendidos).
2. Ve a `http://localhost/phpmyadmin/` en tu navegador.
3. Crea una nueva base de datos llamada **`ips_alma_vida`**.
4. Selecciona la base de datos recién creada, ve a la pestaña **SQL** y ejecuta el siguiente script para crear las tablas y el usuario administrador o importa el archivo ips_alma_vida.sql:

```sql
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO usuarios (nombre, correo, password) 
VALUES ('Administrador', 'admin@almavida.com', 'admin123');

CREATE TABLE IF NOT EXISTS pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_completo VARCHAR(150) NOT NULL,
    tipo_documento VARCHAR(20) NOT NULL,
    numero_documento VARCHAR(50) NOT NULL,
    direccion VARCHAR(150),
    telefono VARCHAR(20),
    celular VARCHAR(20) NOT NULL,
    fecha_nacimiento DATE NOT NULL,
    edad INT NOT NULL,
    eps VARCHAR(100) NOT NULL,
    contacto_adicional VARCHAR(150),
    parentesco VARCHAR(50),
    tipo_examen VARCHAR(50) NOT NULL,
    doctor VARCHAR(50),
    empresa_solicita VARCHAR(150) NOT NULL,
    fecha_examen DATE NOT NULL,
    hora_examen TIME,
    estado VARCHAR(20) DEFAULT 'Pendiente',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Paso 3: Ejecutar la aplicación
Abre tu navegador web e ingresa a la siguiente URL (si tu carpeta en `htdocs` se llama diferente, solo cambia la última parte):

**`http://localhost/ips_alma_vida/`**

### Paso 4: Credenciales de Acceso
El sistema cuenta con protección de rutas. Para ingresar al panel de gestión, utiliza las siguientes credenciales (ya incluidas en el script SQL):

* **Usuario / Correo:** `admin@almavida.com`
* **Contraseña:** `admin123`

---

## Características Principales

* **Protección de Rutas:** Inicio de sesión seguro con variables de sesión (`$_SESSION`).
* **Dashboard Dinámico:** Buscador en tiempo real, filtros combinados y paginación del lado del cliente.
* **Agendamiento Inteligente:** Validación AJAX (Fetch API) que impide registrar citas dobles y bloquea horas previamente ocupadas o pasadas en tiempo real.
* **Diseño UI/UX:** Interfaz moderna y adaptable utilizando TailwindCSS y alertas de SweetAlert2.