CREATE DATABASE portal_noticias;

CREATE TABLE usuarios
(
    id INT AUTO_INCREMENT,
    nombre VARCHAR(20),
    correo VARCHAR(40),
    contrasena VARCHAR(18)
    CONSTRAINT pk_usuarios_id PRIMARY KEY(id)
);