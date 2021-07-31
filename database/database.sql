CREATE DATABASE tienda;
use tienda;
CREATE TABLE usuarios(
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    apellidos VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(20),
    image VARCHAR(255),
    CONSTRAINT pk_usuarios PRIMARY KEY (id),
    CONSTRAINT uq_email UNIQUE(email)
) ENGINE = InnoDb;
INSERT INTO USUARIOS
VALUES(
        NULL,
        "Admin",
        "Admin",
        "admin@admin.com",
        "$2y$04$brfgDrymvScc9046qRZF3OcovzJWzVlro3UkGwTTjzDG8BkkeJVNm",
        "admin",
        NULL
    );
CREATE TABLE categorias(
    id INT(255) AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    CONSTRAINT pk_categorias PRIMARY KEY (id)
) ENGINE = InnoDb;
INSERT INTO CATEGORIAS
VALUES(NULL, 'Manga Corta');
INSERT INTO CATEGORIAS
VALUES(NULL, 'Manga Larga');
INSERT INTO CATEGORIAS
VALUES(NULL, 'Sudaderas');
CREATE TABLE productos(
        id INT(255) AUTO_INCREMENT NOT NULL,
        categoria_id INT(255) NOT NULL,
        nombre VARCHAR(100) NOT NULL,
        descripcion TEXT,
        precio FLOAT(100, 2) NOT NULL,
        stock INT(255) NOT NULL,
        oferta VARCHAR(2),
        fecha date not null,
        imagen VARCHAR(255) NOT NULL,
        CONSTRAINT pk_productos PRIMARY KEY (id),
        CONSTRAINT fk_producto_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
    ) ENGINE = InnoDb;
INSERT INTO PRODUCTOS
VALUES(
        NULL,
        1,
        'Jersey Alemania',
        'Jersey selección de alemania',
        1200,
        14,
        null,
        CURDATE(),
        'alemania.jpg'
    );
INSERT INTO PRODUCTOS
VALUES(
        NULL,
        2,
        'Playera roja',
        'playera roja manga larga',
        500,
        40,
        null,
        CURDATE(),
        ''
    );
INSERT INTO PRODUCTOS
VALUES(
        NULL,
        3,
        'Sudadera Azul',
        'sudadera azul con gorro',
        1500,
        20,
        null,
        CURDATE(),
        ''
    );
CREATE TABLE pedidos(
    id INT(255) AUTO_INCREMENT NOT NULL,
    usuario_id INT(255) NOT NULL,
    c_estado VARCHAR(100) NOT NULL,
    delegacion VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    coste FLOAT(200, 2) NOT NULL,
    estado VARCHAR(30) NOT NULL,
    fecha date not null,
    hora TIME,
    CONSTRAINT pk_pedidos PRIMARY KEY (id),
    CONSTRAINT fk_pedido_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
) ENGINE = InnoDb;
CREATE TABLE lineas_pedidos(
    id INT(255) AUTO_INCREMENT NOT NULL,
    pedido_id INT(255) NOT NULL,
    producto_id INT(255) NOT NULL,
    unidades INT(255) NOT NULL,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_linea_pedido_id FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_linea_producto_id FOREIGN KEY(producto_id) REFERENCES productos(id)
) ENGINE = InnoDb;