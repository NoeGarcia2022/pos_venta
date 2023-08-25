CREATE DATABASE bd_ventas;

USE bd_ventas;

CREATE TABLE
    tb_usuarios(
        id_usuario INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellido VARCHAR(50) NOT NULL,
        correo VARCHAR(50) NOT NULL,
        clave TEXT(50) NOT NULL,
        fechaCaptura DATE
    );

CREATE TABLE
    tb_categorias(
        id_categoria INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT NOT NULL,
        nombreCategoria VARCHAR(150) NOT NULL,
        fechaCaptura DATE
    );

CREATE Table
    tb_imagenes(
        id_imagen INT AUTO_INCREMENT PRIMARY KEY,
        id_categoria INT NOT NULL,
        nombre VARCHAR(500) NOT NULL,
        ruta VARCHAR(500) NOT NULL,
        fechaSubida DATE
    );

CREATE TABLE
    tb_productos(
        id_producto INT AUTO_INCREMENT PRIMARY KEY,
        id_categoria INT NOT NULL,
        id_imagen INT NOT NULL,
        id_usuario INT NOT NULL,
        nombre VARCHAR(50) NOT NULL,
        descripcion VARCHAR(500) NOT NULL,
        cantidad INT NOT NULL,
        precio FLOAT NOT NULL,
        fechaCaptura DATE
    );

CREATE TABLE
    tb_clientes(
        id_cliente INT AUTO_INCREMENT PRIMARY KEY,
        id_usuario INT NOT NULL,
        nombre VARCHAR(200) NOT NULL,
        apellido VARCHAR(200) NOT NULL,
        direccion VARCHAR(500) NOT NULL,
        correo VARCHAR(200) NOT NULL,
        telefono VARCHAR(200) NOT NULL,
        dui VARCHAR(200) NOT NULL
    );

CREATE TABLE
    tb_ventas(
        id_venta INT AUTO_INCREMENT PRIMARY KEY,
        id_cliente INT NOT NULL,
        id_producto INT NOT NULL,
        precio FLOAT,
        fechaCompra date
    );