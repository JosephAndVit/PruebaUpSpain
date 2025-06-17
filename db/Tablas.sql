-- CREATE DATABASE `api_rest`

use api_rest;

CREATE TABLE productos (
    producto_id VARCHAR(36) NOT NULL PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL
);

CREATE TABLE variantes (
    variante_id VARCHAR(36) NOT NULL PRIMARY KEY,
    producto_id VARCHAR(36) NOT NULL,
    talla VARCHAR(10) NOT NULL,
    color VARCHAR(7) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    cantidad INT NOT NULL,
    imagen VARCHAR(255) NOT NULL,
    CONSTRAINT fk_producto FOREIGN KEY (producto_id) REFERENCES productos(producto_id) ON DELETE CASCADE
);
