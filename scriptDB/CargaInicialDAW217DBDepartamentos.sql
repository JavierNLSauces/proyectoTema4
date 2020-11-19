-- CARGA INICIAL DE LA BASE DE DATOS
USE DAW217DBDepartamentos;

-- Carga de datos
INSERT INTO Departamento(CodDepartamento,DescDepartamento,FechaBaja,VolumenNegocio) VALUES
('INF', 'Departamento de Informatica',null,1),
('QUM', 'Departamento de Quimica',null,2),
('FIS', 'Departamento de Fisica',null,3),
('TEC', 'Departamento de Tecnologia',null,4),
('MAT', 'Departamento de Matematicas',null,5),
('LCL', 'Departamento de Lengua Castellana y Literatura',null,6);