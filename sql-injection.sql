CREATE DATABASE IF NOT EXISTS sqlInjection;
USE sqlInjection;

DROP TABLE IF EXISTS Productos;
DROP TABLE IF EXISTS Usuarios;

CREATE TABLE Usuarios (
    UsuarioId INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(100) NOT NULL,
    CorreoElectronico VARCHAR(150) NOT NULL UNIQUE,
    Contrasena VARCHAR(100) NOT NULL,
    FechaRegistro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Productos (
    ProductoId INT AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(150) NOT NULL,
    Descripcion VARCHAR(255),
    Precio DECIMAL(10,2) NOT NULL,
    Stock INT NOT NULL DEFAULT 0,
    UsuarioId INT NOT NULL,
    FechaCreacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_Productos_Usuarios
        FOREIGN KEY (UsuarioId)
        REFERENCES Usuarios(UsuarioId)
);
INSERT INTO Usuarios
(Nombre, CorreoElectronico, Contrasena)
VALUES
('Juan Pérez', 'juan.perez@example.com', 'juan123'),
('María Gómez', 'maria.gomez@example.com', 'maria123'),
('Carlos Rodríguez', 'carlos.rodriguez@example.com', 'carlos123'),
('Ana Martínez', 'ana.martinez@example.com', 'ana123'),
('Luis Herrera', 'luis.herrera@example.com', 'luis123'),
('Sofía Ramírez', 'sofia.ramirez@example.com', 'sofia123'),
('Diego Torres', 'diego.torres@example.com', 'diego123'),
('Valentina Castro', 'valentina.castro@example.com', 'vale123'),
('Andrés Moreno', 'andres.moreno@example.com', 'andres123'),
('Camila Vargas', 'camila.vargas@example.com', 'camila123');

INSERT INTO Productos
(Nombre, Descripcion, Precio, Stock, UsuarioId)
VALUES
('Laptop Dell Inspiron', 'Laptop para oficina', 850.00, 15, 1),
('Mouse Logitech M185', 'Mouse inalámbrico', 18.50, 50, 1),
('Teclado Mecánico Redragon', 'Teclado RGB', 65.99, 25, 2),
('Monitor Samsung 24', 'Monitor Full HD', 179.90, 12, 2),
('Disco SSD Kingston 1TB', 'Almacenamiento SSD', 89.99, 30, 3),
('Memoria RAM 16GB', 'DDR4 3200MHz', 54.50, 40, 3),
('Impresora HP LaserJet', 'Impresora láser', 199.00, 8, 4),
('Webcam Logitech C920', 'Webcam Full HD', 74.99, 20, 4),
('Auriculares Sony', 'Audio estéreo', 45.00, 35, 5),
('Micrófono USB Blue Yeti', 'Micrófono profesional', 129.99, 10, 5),
('Tablet Samsung Galaxy', 'Tablet Android', 249.99, 14, 6),
('Smartphone Xiaomi', 'Teléfono Android', 320.00, 18, 6),
('Router TP-Link AX1800', 'WiFi 6 Router', 95.00, 22, 7),
('Disco Externo 2TB', 'Backup portátil', 79.90, 16, 7),
('Silla Gamer', 'Silla ergonómica', 189.99, 6, 8),
('Escritorio Ajustable', 'Escritorio elevable', 299.00, 4, 8),
('Cable HDMI 2m', 'Cable HDMI 4K', 9.99, 100, 9),
('Hub USB-C', 'Adaptador multipuerto', 34.99, 28, 9),
('Cámara Canon EOS', 'Cámara digital', 699.00, 5, 10),
('Proyector Epson', 'Proyector Full HD', 499.99, 7, 10);