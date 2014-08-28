CREATE TABLE cli_empresas
(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha_registro DATETIME,
  fecha_cambio DATETIME,
  uid INT NOT NULL,
  razonSocial VARCHAR(255),
  nit VARCHAR(255),
  telefonos VARCHAR(255),
  direccion VARCHAR(255),
  webSite VARCHAR(255),
  email VARCHAR(255),
  comentarios LONGTEXT
);
CREATE TABLE cli_empresas_contactos
(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha_registro DATETIME,
  fecha_cambio DATETIME,
  uid INT NOT NULL,
  idEmpresa INT,
  nombres VARCHAR(255) NOT NULL,
  apPat VARCHAR(255) NOT NULL,
  apMat VARCHAR(255) NOT NULL,
  telefonos VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  comentarios VARCHAR(255) NOT NULL
);
CREATE TABLE cli_personas
(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha_registro DATETIME,
  fecha_cambio DATETIME,
  uid INT NOT NULL,
  nombres VARCHAR(255) NOT NULL,
  apPat VARCHAR(255) NOT NULL,
  apMat VARCHAR(255) NOT NULL,
  nit VARCHAR(255) NOT NULL,
  telefono VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  direccion VARCHAR(255) NOT NULL,
  comentarios VARCHAR(255) NOT NULL
);
CREATE TABLE productos
(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha_registro DATETIME,
  fecha_cambio DATETIME,
  uid INT NOT NULL,
  codigo VARCHAR(255),
  nombre VARCHAR(255),
  precio VARCHAR(255),
  stockMin VARCHAR(255),
  stock VARCHAR(255),
  comentarios LONGTEXT
);
CREATE TABLE usuarios
(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha_registro DATETIME,
  fecha_cambio DATETIME,
  uid INT NOT NULL,
  activo TINYINT DEFAULT 1 NOT NULL,
  usuario VARCHAR(32),
  password VARCHAR(32),
  grupo VARCHAR(255),
  nombres VARCHAR(255),
  apPat VARCHAR(255),
  apMat VARCHAR(255),
  docId VARCHAR(255),
  telefonos VARCHAR(255),
  email VARCHAR(255),
  direccion VARCHAR(255),
  comentarios LONGTEXT
);
CREATE TABLE usuarios_grupos
(
  id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
  fecha_registro DATETIME,
  fecha_cambio DATETIME,
  uid INT NOT NULL,
  nombre VARCHAR(255) NOT NULL
);
