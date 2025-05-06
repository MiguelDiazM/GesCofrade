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
        
    INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `id_hermandad`) VALUES
    (1, 'nazareno_admin@gmail.com', 'clave123', 1),
    (2, 'nazareno_hermano_mayor', '$2y$10$etpyutX1IsROazFohsqsd.8tGQwMTtfLNnGTmYhbcbv/igQlHq57q', 1),
    (3, 'entierro_admin', '$2y$10$58N.Dnefv51zncFRMxRXyeiznPxSMNvpeF9fsIgRYfvfzv3i.LCfW', 2),
    (4, 'entierro_hermano_mayor', '$2y$10$liPgZ2ZN421mBkQeXQCEG.CEJpLggF./VqQB1Vr3W37OfEUPnF8sW', 2),
    (5, 'borriquita_user', '$2y$10$KzgJs41LmtXa7gprVDecX.act7wTb6bF6Pmiy877aKs0PXicdlMbS', 3),
    (6, 'borriquita_hermano_mayor', '$2y$10$3e06uAeeMrTFFw4hiw6zXOQSjLJNDeFAioDbvMfefZIeTFd3IGcfG', 3),
    (7, 'rocio_admin', '$2y$10$TVUFCm/DuSk2NLuVdiPMbOQXblH0DE9BB8oXsjTC9cuNnWPAkddoa', 4),
    (8, 'rocio_hermano_mayor', '$2y$10$OAXscTW7YUnCOcGwDEh11OKVrrWJYMM.f0VvanbeqqxoVzQ3w2URi', 4),
    (9, 'dolores_admin', '$2y$10$Nm7otpKWaRRwxKVXmUz6VuKb1EoyltSjh4V74ak39sNWOCSolhOMa', 5),
    (10, 'dolores_hermano_mayor', '$2y$10$5bJ7Lb2sGWkIslM9UYEcjeXU9nhPIAFkQFB8JQGo7Y6WglxcfTXym', 5),
    (11, 'cautivo_admin', '$2y$10$vdHckFD2E7O0sSpMBlpetulvOe9Yy2uAbeOn.dnl5mAVt/bmBPqp6', 6),
    (12, 'cautivo_hermano_mayor', '$2y$10$hSAS173KiuhacHzmiHaaU.qR0sVR.mVdmq2kp0hN0hi8ByBON0sgS', 6),
    (13, 'virgenpaz_admin', '$2y$10$JmHRRadTcLKvnXSBX15MlOQ20zYWb3oXSBc2cpmDyQd7rIRzVIEmC', 7),
    (14, 'virgenpaz_hermano_mayor', '$2y$10$YdMAamqPjOTFGQQW77thdOiP265NCmePfLu59V0MBc2W9Sh5chRjK', 7),
    (15, 'macarena_admin', '$2y$10$Btp0CP7M1US03/RE5Ff71eeXKeVeAERNvj7TV7jp7d2h09MsOSsES', 8),
    (16, 'macarena_hermano_mayor', '$2y$10$lNsNQek/.7uQqYdg8LMLhuy1RrzMNjTG8IOlK.lHlz1Dq8xjIpQR.', 8),
    (17, 'rocioutrera_admin', '$2y$10$onxzV80/.7LfF.FWDRG1HOe9yWwq80WUCJOf9/EFzezmmMNrx8eUm', 9),
    (18, 'rocioutrera_hermano_mayor', '$2y$10$VikoD0lRvTgOiTqE3.hTIeHiDO7aCAgm0WpA.xT8FtQ/pf3tQ3qYS', 9),
    (19, 'remedios_admin', '$2y$10$h6f6X5Nn.5mKNzsVGoEtX.Eb8VHewlTzfYtVAFJq.mnDbebpLPREW', 10),
    (20, 'remedios_hermano_mayor', '$2y$10$6DYAKMtrJJTQc.pWzJ7dO.1BV/fnulzzRGZHWaPtp8YMTmxLnitJy', 10),
    (21, 'nazareno_admin', '$2y$10$8qIV8F5.JHFcyzcYYubVQ.b.qAk3u0z5JS9iUfhs5fPaXGNn0wg7y', 1);


    INSERT INTO Modulos (descripcion, precio, id_hermandad) VALUES
    ('Inventario', 150.00, '[1,2,3,4,5]'),
    ('Correspondencia', 100.00, '[1,3,5,7]'),
    ('GPS', 250.00, '[2,4,6,8]'),
    ('Diseño 3D', 300.00, '[1,2,3,4,5,6,7,8,9,10]');

