    CREATE DATABASE IF NOT EXISTS gesCofrade;
    USE gesCofrade;

    CREATE TABLE Hermandad (
        id_hermandad INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        tipo VARCHAR(100) NOT NULL,
        ubicacion VARCHAR(255) NOT NULL
    );

    CREATE TABLE Hermanos (
        DNI VARCHAR(20) PRIMARY KEY,
        nombre VARCHAR(255) NOT NULL,
        apellido VARCHAR(255) NOT NULL,
        direccion TEXT NOT NULL,
        telefono VARCHAR(20) NOT NULL,
        id_hermandad JSON NOT NULL,
        CONSTRAINT chk_hermandad_json CHECK (JSON_VALID(id_hermandad))
    );

    CREATE TABLE Inventario (
        referencia VARCHAR(100) PRIMARY KEY,
        elemento VARCHAR(255) NOT NULL,
        descripcion TEXT NOT NULL,
        id_hermandad INT NOT NULL,
        FOREIGN KEY (id_hermandad) REFERENCES Hermandad(id_hermandad) ON DELETE CASCADE
    );

    CREATE TABLE Usuarios (
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(50) UNIQUE NOT NULL,
        contrasena VARCHAR(255) NOT NULL,
        id_hermandad INT NOT NULL,
        FOREIGN KEY (id_hermandad) REFERENCES Hermandad(id_hermandad) ON DELETE CASCADE
    );

    CREATE TABLE Modulos (
        id_modulo INT AUTO_INCREMENT PRIMARY KEY,
        descripcion VARCHAR(255) UNIQUE NOT NULL,
        precio FLOAT NOT NULL,
        id_hermandad JSON NOT NULL,
        CONSTRAINT chk_hermandad_json CHECK (JSON_VALID(id_hermandad))
    );

    INSERT INTO Hermandad (nombre, tipo, ubicacion) VALUES
    ('Hermandad de Nuestro Padre Jesús Nazareno', 'Penitencial', 'Herrera, Sevilla'),
    ('Hermandad del Santo Entierro', 'Penitencial', 'Herrera, Sevilla'),
    ('Hermandad de la Borriquita', 'Penitencial', 'Herrera, Sevilla'),
    ('Hermandad del Rocío de Herrera', 'Gloria', 'Herrera, Sevilla'),
    ('Hermandad de la Virgen de los Dolores', 'Penitencial', 'Herrera, Sevilla'),
    ('Hermandad de Nuestro Padre Jesús Cautivo', 'Penitencial', 'Alcalá de Guadaíra, Sevilla'),
    ('Hermandad de la Virgen de la Paz', 'Gloria', 'Utrera, Sevilla'),
    ('Hermandad de la Esperanza Macarena', 'Penitencial', 'Sevilla Capital'),
    ('Hermandad del Rocío de Utrera', 'Gloria', 'Utrera, Sevilla'),
    ('Hermandad de la Virgen de los Remedios', 'Penitencial', 'Dos Hermanas, Sevilla'),
    ('Hermandad de Nuestro Padre Jesús Nazareno', 'Penitencial', 'Écija, Sevilla'),
    ('Hermandad de la Virgen del Rocío', 'Gloria', 'Alcalá de Guadaíra, Sevilla');

    INSERT INTO Hermanos (DNI, nombre, apellido, direccion, telefono, id_hermandad) VALUES
    ('11223344A', 'Antonio', 'López', 'Calle Real 5', '654321987', '[1,4]'),
    ('22334455B', 'Lucía', 'Martín', 'Av. de la Paz 12', '678123456', '[2]'),
    ('33445566C', 'Carlos', 'Ramírez', 'Calle Nueva 9', '698745632', '[3,5]'),
    ('44556677D', 'Rosa', 'Moreno', 'Plaza Mayor 3', '600123987', '[1,2,3]'),
    ('55667788E', 'David', 'Serrano', 'Camino del Molino 8', '612345678', '[4,5]'),
    ('11223344J', 'José', 'González', 'C/ Mayor 12', '610000001', '[6]'),
    ('22334455M', 'María', 'Sánchez', 'C/ Real 14', '610000002', '[7]'),
    ('33445576C', 'Carlos', 'Fernández', 'C/ Sevilla 9', '610000003', '[8]'),
    ('44556677L', 'Laura', 'Hernández', 'C/ Virgen 20', '610000004', '[9]'),
    ('55667788A', 'Antonio', 'Pérez', 'C/ Sol 15', '610000005', '[10]');

    INSERT INTO Inventario (referencia, elemento, descripcion, id_hermandad) VALUES
    ('NPJN001XHS', 'Cruz Guía', 'Cruz que encabeza la procesión', 1),
    ('HSE001XHS', 'Urna del Santo Entierro', 'Urna de cristal con detalles dorados', 2),
    ('HBOR001XHS', 'Palmas para la Borriquita', 'Palmas blancas trenzadas', 3),
    ('HROC001XHS', 'Simpecado del Rocío', 'Simpecado bordado en oro', 4),
    ('HVD001XHS', 'Manto de la Virgen de los Dolores', 'Manto de terciopelo bordado', 5),
    ('NPC001XAG', 'Cruz Guía', 'Cruz de madera para procesión', 6),
    ('VPA001XUS', 'Candelabros', 'Candelabros para el paso de la Virgen de la Paz', 7),
    ('HEM001XSE', 'Túnica de Nazareno', 'Túnica morada con cíngulo dorado', 8),
    ('RUC001XUS', 'Carreta del Simpecado', 'Carreta de madera para la romería', 9),
    ('VDR001XDH', 'Medalla de la Virgen', 'Medalla en oro de la Virgen de los Remedios', 10),
    ('JNZ001XEC', 'Faroles de procesión', 'Faroles antiguos de hierro', 11),
    ('VRC001XAG', 'Simpecado bordado', 'Simpecado con bordados dorados', 6);

    INSERT INTO Usuarios (usuario, contrasena, id_hermandad) VALUES
    ('nazareno_admin', 'clave123', 1),
    ('nazareno_hermano_mayor', 'hmnazareno2024', 1),
    ('entierro_admin', 'segura456', 2),
    ('entierro_hermano_mayor', 'hmentierro2024', 2),
    ('borriquita_user', 'pass789', 3),
    ('borriquita_hermano_mayor', 'hmborriquita2024', 3),
    ('rocio_admin', 'rocio2024', 4),
    ('rocio_hermano_mayor', 'hmrocio2024', 4),
    ('dolores_admin', 'dolores2024', 5),
    ('dolores_hermano_mayor', 'hmdolores2024', 5),
    ('cautivo_admin', 'adminCautivo2024', 6),
    ('cautivo_hermano_mayor', 'hmCautivo2024', 6),
    ('virgenpaz_admin', 'adminPaz2024', 7),
    ('virgenpaz_hermano_mayor', 'hmPaz2024', 7),
    ('macarena_admin', 'adminMacarena2024', 8),
    ('macarena_hermano_mayor', 'hmMacarena2024', 8),
    ('rocioutrera_admin', 'adminRocioUtrera2024', 9),
    ('rocioutrera_hermano_mayor', 'hmRocioUtrera2024', 9),
    ('remedios_admin', 'adminRemedios2024', 10),
    ('remedios_hermano_mayor', 'hmRemedios2024', 10);

    INSERT INTO Modulos (descripcion, precio, id_hermandad) VALUES
    ('Inventario', 150.00, '[1,2,3,4,5]'),
    ('Correspondencia', 100.00, '[1,3,5,7]'),
    ('GPS', 250.00, '[2,4,6,8]'),
    ('Diseño 3D', 300.00, '[1,2,3,4,5,6,7,8,9,10]');

