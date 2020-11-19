-- CREACION BASE DE DATOS
-- Creacion de la base de datos DAW217DBDepartamentos
CREATE DATABASE IF NOT EXISTS DAW217DBDepartamentos;
-- Creacion de tablas de la base de datos
CREATE TABLE IF NOT EXISTS DAW217DBDepartamentos.Departamento (
CodDepartamento VARCHAR(3) PRIMARY KEY,
DescDepartamento VARCHAR(255) NOT NULL,
FechaBaja DATE NULL,
VolumenNegocio FLOAT NULL
)ENGINE=INNODB;

-- CREACION USUARIO ADMINISTRADOR
-- Creacion de usuario administrador de la base de datos: usuarioDAW217DBDepartamentos / P@ssw0rd
CREATE USER 'usuarioDAW217DBDepartamentos'@'%' IDENTIFIED BY 'P@ssw0rd';
-- Permisos para la base de datos
GRANT ALL PRIVILEGES ON DAW217DBDepartamentos.* TO 'usuarioDAW217DBDepartamentos'@'%' WITH GRANT OPTION;