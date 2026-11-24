# DocTrack

<p align="center">
  <strong>Sistema de gestión y validación documental</strong>
</p>

<p align="center">
  Plataforma web para centralizar la entrega, revisión y administración de documentos mediante diferentes perfiles de usuario.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" />
  <img src="https://img.shields.io/badge/CodeIgniter-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white" />
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" />
  <img src="https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" />
</p>

---

## Descripción

DocTrack es un sistema web desarrollado para facilitar la administración y validación de documentos dentro de un entorno académico.

La plataforma organiza el proceso documental mediante tres perfiles de usuario: alumno, maestro y administrador. Cada perfil dispone de diferentes permisos y herramientas según sus responsabilidades.

Su objetivo es simplificar la entrega de documentos, facilitar su revisión y mantener organizado el proceso de validación.

## Funcionalidades principales

### 🎓 Alumno

- Acceder a su panel de usuario.
- Subir documentos al sistema.
- Consultar los documentos enviados.
- Visualizar sus archivos.
- Eliminar documentos.

### 👨‍🏫 Maestro

- Consultar los documentos enviados por los alumnos.
- Revisar los archivos recibidos.
- Aceptar documentos.
- Rechazar documentos.
- Agregar comentarios durante el proceso de revisión.

### ⚙️ Administrador

- Consultar los usuarios registrados.
- Crear nuevas cuentas.
- Editar información de usuarios.
- Eliminar usuarios.
- Administrar el acceso a la plataforma.

## Flujo de validación documental

El funcionamiento general del sistema sigue este proceso:

```text
       ALUMNO
          |
          v
   Sube un documento
          |
          v
   MAESTRO REVISA
          |
     +----+----+
     |         |
     v         v
  Aceptado  Rechazado
     |         |
     v         v
  Validado  Comentarios
     |
     v
  Proceso finalizado
```

## Tecnologías utilizadas

| Tecnología | Aplicación |
|---|---|
| PHP | Lógica del servidor |
| CodeIgniter | Framework backend |
| MySQL | Gestión de datos |
| HTML5 | Estructura de interfaces |
| CSS3 | Diseño visual |
| JavaScript | Interactividad |
| Bootstrap | Componentes y diseño responsive |

## Estructura del proyecto

```text
DocTrack/
│
├── BDD/
│   └── Archivos relacionados con la base de datos
│
├── application/
│   └── Aplicación y configuración de CodeIgniter
│
├── system/
│   └── Núcleo del framework CodeIgniter
│
├── assets/
│   └── Recursos del proyecto
│
├── uploads/
│   └── Archivos y documentos cargados
│
├── index.php
├── license.txt
└── README.md
```

## Instalación y configuración

### Requisitos

- PHP compatible con la versión de CodeIgniter utilizada.
- MySQL.
- Apache o un servidor web compatible con PHP.
- XAMPP, WAMP o un entorno local equivalente.

### 1. Clonar el repositorio

```bash
git clone https://github.com/SaredGarcia/DocTrack.git
```

### 2. Preparar el entorno local

Coloca la carpeta del proyecto dentro del directorio público de tu servidor local.

Por ejemplo, con XAMPP:

```text
C:/xampp/htdocs/DocTrack
```

Inicia Apache y MySQL desde el panel de XAMPP.

### 3. Configurar la base de datos

1. Abre phpMyAdmin.
2. Crea la base de datos correspondiente al proyecto.
3. Revisa la carpeta `BDD` para localizar los archivos SQL disponibles.
4. Importa el script de base de datos correspondiente.

### 4. Configurar la conexión

Abre:

```text
application/config/database.php
```

Configura los datos de conexión de acuerdo con tu entorno local:

- Host de MySQL.
- Nombre de la base de datos.
- Usuario.
- Contraseña.

No publiques credenciales reales dentro del repositorio.

### 5. Configurar la URL del proyecto

Abre:

```text
application/config/config.php
```

Ajusta la variable `base_url` para que coincida con la dirección local donde ejecutarás DocTrack.

### 6. Ejecutar el proyecto

Con Apache y MySQL activos, abre en tu navegador:

```text
http://localhost/DocTrack/
```

La ruta final dependerá de la configuración de tu servidor local.

## Seguridad y manejo de documentos

El sistema contempla diferentes perfiles de usuario para separar las responsabilidades de administración, revisión y entrega documental.

Para un entorno de producción se deben configurar correctamente los permisos de acceso, la validación de archivos, las credenciales de base de datos y la protección del directorio de documentos.

## Alcance del proyecto

DocTrack está orientado a la gestión documental en un entorno académico.

Su estructura permite organizar las operaciones de alumnos, maestros y administradores dentro de un mismo sistema.

## Autor

**Sared García**

Desarrollador Web Junior.

[GitHub](https://github.com/SaredGarcia)

---

<p align="center">
  <strong>SARED × GAPE</strong><br>
  Soluciones digitales para procesos reales.
</p>
