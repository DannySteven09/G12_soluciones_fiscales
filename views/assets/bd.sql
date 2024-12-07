-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS bd_g12_3c_soluciones_fiscales;
USE bd_g12_3c_soluciones_fiscales;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('Admin', 'Usuario') NOT NULL
);

-- Insertar usuario de prueba
INSERT INTO usuarios (nombre, correo, password, rol) 
VALUES 
('Administrador', 'admin@example.com', MD5('12345'), 'Admin');

-- Tabla de clientes
CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    cedula VARCHAR(20) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL
);

-- Tabla de citas
CREATE TABLE IF NOT EXISTS citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    fecha_hora DATETIME NOT NULL,
    descripcion TEXT NOT NULL,
    estado ENUM('Pendiente', 'Confirmada', 'Cancelada') NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE CASCADE
);

-- Tabla de servicios
CREATE TABLE IF NOT EXISTS servicios (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT NOT NULL,
    nombre_servicio VARCHAR(100) NOT NULL,
    estado ENUM('Activo', 'Inactivo') NOT NULL,
    fecha_contratacion DATE NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente) ON DELETE CASCADE
);

-- Insertar datos de prueba en clientes
INSERT INTO clientes (nombre, cedula, correo, telefono) 
VALUES 
('Juan Pérez', '123456789', 'juan.perez@example.com', '555-1234'),
('María López', '987654321', 'maria.lopez@example.com', '555-5678');

-- Insertar datos de prueba en citas
INSERT INTO citas (id_cliente, fecha_hora, descripcion, estado) 
VALUES 
(1, '2024-12-01 10:00:00', 'Consulta general', 'Confirmada'),
(2, '2024-12-05 15:30:00', 'Reunión de seguimiento', 'Pendiente');

-- Insertar datos de prueba en servicios
INSERT INTO servicios (id_cliente, nombre_servicio, estado, fecha_contratacion) 
VALUES 
(1, 'Asesoría fiscal', 'Activo', '2024-01-10'),
(2, 'Auditoría contable', 'Inactivo', '2024-03-20');
