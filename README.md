# DocTrack
### Plataforma de gestión y validación documental académica

Organiza entregas, revisiones y aprobaciones de documentos desde un solo lugar.

![PHP](https://img.shields.io/badge/PHP-7.4%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3-EF4223?style=for-the-badge&logo=codeigniter&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8%2B-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-4-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

**SARED × GAPE**

## Acerca del proyecto
DocTrack es una aplicación web académica para administrar el ciclo de vida documental: el estudiante entrega un archivo, el profesor responsable lo revisa y el sistema registra su aceptación o rechazo con observaciones. El administrador gestiona usuarios y tipos de documentos.

Proyecto de portafolio que demuestra PHP, CodeIgniter 3, MySQL, autenticación por roles, validación de formularios y manejo de archivos.

## Funcionalidades
| Perfil | Capacidades |
|---|---|
| Estudiante | Enviar archivos y revisar el estado de sus entregas. |
| Profesor | Consultar documentos asignados y aceptar o rechazar entregas con comentarios. |
| Administrador | Administrar cuentas y gestionar el catálogo documental. |

## Stack tecnológico
- Backend: PHP y CodeIgniter 3 (MVC).
- Base de datos: MySQL / MariaDB.
- Frontend: HTML5, CSS3, JavaScript y Bootstrap.
- Seguridad: sesiones, password_hash(), password_verify(), validación y autorización por rol.
- Archivos: validación de tipo y tamaño, nombres aleatorios y cargas excluidas de Git.

## Instalación local
1. Clona el repositorio:
   ~~~bash
   git clone https://github.com/SaredGarcia/DocTrack.git
   cd DocTrack
   ~~~
2. Coloca el proyecto en el directorio público de Apache, por ejemplo C:/xampp/htdocs/DocTrack.
3. Importa BDD/awva.sql desde phpMyAdmin o ejecuta. **Atención:** el script recrea las tablas y elimina las tablas existentes de la base doctrack; úsalo únicamente en una base nueva o respaldada:
   ~~~bash
   mysql -u root -p < BDD/awva.sql
   ~~~
4. Configura DB_HOST, DB_NAME, DB_USER y DB_PASSWORD como variables de entorno. En XAMPP local se usan valores predeterminados.
5. Ajusta APP_BASE_URL en application/config/config.php.
6. Inicia Apache y MySQL y abre http://localhost/DocTrack/.

## Cuentas de demostración
| Perfil | Correo |
|---|---|
| Administrador | admin@doctrack.test |
| Profesor | profesor@doctrack.test |
| Estudiante | alumno@doctrack.test |

Contraseña local para las tres cuentas: **DocTrackDemo2026!**. Son cuentas ficticias de demostración; no deben utilizarse en producción.

## Seguridad y alcance
- Contraseñas almacenadas como hashes y verificadas con password_verify().
- Paneles protegidos por autenticación y rol.
- Operaciones de revisión restringidas al profesor asignado.
- El estudiante solo puede eliminar sus documentos pendientes.
- Cargas con extensiones permitidas, límite de tamaño y nombres aleatorios.
- Los archivos locales de usuarios no se versionan.

DocTrack conserva CodeIgniter 3 para mostrar la evolución de una aplicación existente. Antes de producción aún se requiere completar pruebas de integración, descarga privada de archivos, CSRF en todos los formularios, HTTPS, claves de cifrado y respaldos. También conviene planear una migración a un framework con soporte vigente.

## Autor
**Sared García** · Desarrollador Web  
[GitHub](https://github.com/SaredGarcia)

---
**SARED × GAPE** · Soluciones digitales para procesos reales.
