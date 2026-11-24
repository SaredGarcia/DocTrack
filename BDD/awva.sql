-- DocTrack - esquema limpio para portafolio (MySQL 8 / MariaDB 10.4+)
-- Cuentas demo: admin@doctrack.test, profesor@doctrack.test, alumno@doctrack.test
-- Contraseña local de las tres cuentas: DocTrackDemo2026! (almacenada como hash).

CREATE DATABASE IF NOT EXISTS doctrack CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE doctrack;
SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS documentos;
DROP TABLE IF EXISTS tipos_documentos;
DROP TABLE IF EXISTS usuarios;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE usuarios (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(50) NOT NULL,
 apellidos VARCHAR(50) NOT NULL,
 correo VARCHAR(100) NOT NULL,
 contrasena VARCHAR(255) NOT NULL,
 tipo_usuario ENUM('Estudiante','Profesor','Admin') NOT NULL,
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY(id), UNIQUE KEY uq_usuarios_correo(correo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE tipos_documentos (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 nombre VARCHAR(100) NOT NULL,
 proposito VARCHAR(255) NOT NULL,
 contenido VARCHAR(255) NOT NULL,
 documento_path VARCHAR(255) DEFAULT NULL,
 PRIMARY KEY(id), UNIQUE KEY uq_tipos_documentos_nombre(nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE documentos (
 id INT UNSIGNED NOT NULL AUTO_INCREMENT,
 usuario_id INT UNSIGNED NOT NULL,
 titulo VARCHAR(100) NOT NULL,
 archivo_path VARCHAR(255) NOT NULL,
 estado ENUM('Pendiente','Aceptado','Rechazado') NOT NULL DEFAULT 'Pendiente',
 fecha_subida TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 maestro_id INT UNSIGNED NOT NULL,
 motivo TEXT DEFAULT NULL,
 PRIMARY KEY(id),
 KEY idx_documentos_alumno(usuario_id,fecha_subida),
 KEY idx_documentos_maestro_estado(maestro_id,estado,fecha_subida),
 CONSTRAINT fk_documentos_alumno FOREIGN KEY(usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
 CONSTRAINT fk_documentos_maestro FOREIGN KEY(maestro_id) REFERENCES usuarios(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO usuarios(nombre,apellidos,correo,contrasena,tipo_usuario) VALUES
('Alex','Estudiante Demo','alumno@doctrack.test','$2y$12$DulDf.a6MICDKYqX.KgsS.DHLcsftpS1FQ.AQ9iC5k3GN892SB0Zu','Estudiante'),
('Sam','Profesor Demo','profesor@doctrack.test','$2y$12$DulDf.a6MICDKYqX.KgsS.DHLcsftpS1FQ.AQ9iC5k3GN892SB0Zu','Profesor'),
('Taylor','Administrador Demo','admin@doctrack.test','$2y$12$DulDf.a6MICDKYqX.KgsS.DHLcsftpS1FQ.AQ9iC5k3GN892SB0Zu','Admin');

INSERT INTO tipos_documentos(nombre,proposito,contenido) VALUES
('Carta de presentación','Presentar al estudiante y sus objetivos.','Objetivo, datos ficticios y firma.'),
('Memoria de estadías','Documentar actividades realizadas.','Resumen de actividades y aprendizajes.'),
('Carta de término','Registrar la conclusión del proceso.','Fecha de término y observaciones.');
