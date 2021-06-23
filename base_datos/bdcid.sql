/*
Navicat MySQL Data Transfer

Source Server         : USUARIO
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : bdcid

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-06-15 21:54:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for aperturas
-- ----------------------------
DROP TABLE IF EXISTS `aperturas`;
CREATE TABLE `aperturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cursos_id` int(11) DEFAULT NULL,
  `aula_id` int(11) DEFAULT NULL,
  `sede` int(11) DEFAULT NULL,
  `fec_ini` date DEFAULT NULL,
  `fec_fin` date DEFAULT NULL,
  `docente_id` int(11) DEFAULT NULL,
  `act_web` tinyint(4) DEFAULT NULL,
  `nota` tinyint(4) DEFAULT NULL,
  `us_reg` int(11) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of aperturas
-- ----------------------------

-- ----------------------------
-- Table structure for aulas
-- ----------------------------
DROP TABLE IF EXISTS `aulas`;
CREATE TABLE `aulas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of aulas
-- ----------------------------
INSERT INTO `aulas` VALUES ('1', 'SALA VIRTUAL MEET', '1');
INSERT INTO `aulas` VALUES ('2', 'SALA DE VIDEOLLAMADA EN ZOOM', '1');
INSERT INTO `aulas` VALUES ('3', 'AULA 01 - LABORATORIO', '1');

-- ----------------------------
-- Table structure for carreras
-- ----------------------------
DROP TABLE IF EXISTS `carreras`;
CREATE TABLE `carreras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of carreras
-- ----------------------------
INSERT INTO `carreras` VALUES ('1', 'INGENIERIA DE SISTEMAS E INFORMÁTICA', '1');

-- ----------------------------
-- Table structure for certificados
-- ----------------------------
DROP TABLE IF EXISTS `certificados`;
CREATE TABLE `certificados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula_id` int(11) DEFAULT NULL,
  `fec_ini` date DEFAULT NULL,
  `fec_fin` date DEFAULT NULL,
  `folio` varchar(255) DEFAULT NULL,
  `correlativo` varchar(255) DEFAULT NULL,
  `fecha_imp` date DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `modalidad` varchar(255) DEFAULT NULL,
  `usu_reg` int(11) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `usu_ente` int(11) DEFAULT NULL,
  `entrega` tinyint(4) DEFAULT NULL,
  `fec_ent` date DEFAULT NULL,
  `usu_dupli` int(11) DEFAULT NULL,
  `duplicado` tinyint(4) DEFAULT NULL,
  `fecha_imp_dupli` date DEFAULT NULL,
  `entrega_dupli` tinyint(4) DEFAULT NULL,
  `usu_entrega_dupli` int(11) DEFAULT NULL,
  `fec_entrega_dupli` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of certificados
-- ----------------------------

-- ----------------------------
-- Table structure for ciclos
-- ----------------------------
DROP TABLE IF EXISTS `ciclos`;
CREATE TABLE `ciclos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of ciclos
-- ----------------------------
INSERT INTO `ciclos` VALUES ('1', 'REGULAR', '1');
INSERT INTO `ciclos` VALUES ('2', 'INTENSIVO', '1');

-- ----------------------------
-- Table structure for conceptos
-- ----------------------------
DROP TABLE IF EXISTS `conceptos`;
CREATE TABLE `conceptos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of conceptos
-- ----------------------------
INSERT INTO `conceptos` VALUES ('1', 'DERECHO A MATRICULA', '01843', '1');

-- ----------------------------
-- Table structure for cursos
-- ----------------------------
DROP TABLE IF EXISTS `cursos`;
CREATE TABLE `cursos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ciclo_id` int(11) DEFAULT NULL,
  `nivel_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `costo` decimal(10,0) DEFAULT NULL,
  `silabus` varchar(255) DEFAULT NULL,
  `act_web` tinyint(4) DEFAULT NULL,
  `usu_reg` int(11) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of cursos
-- ----------------------------
INSERT INTO `cursos` VALUES ('1', '1', '1', 'INGLES PREGRADO', '1170', 'Informe_de_actividades.docx', '1', '1', '2021-06-03', '1');

-- ----------------------------
-- Table structure for dias
-- ----------------------------
DROP TABLE IF EXISTS `dias`;
CREATE TABLE `dias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of dias
-- ----------------------------
INSERT INTO `dias` VALUES ('1', 'LUNES', '1');
INSERT INTO `dias` VALUES ('2', 'MARTES', '1');
INSERT INTO `dias` VALUES ('3', 'MIÉRCOLES', '1');
INSERT INTO `dias` VALUES ('4', 'JUEVES', '1');
INSERT INTO `dias` VALUES ('5', 'VIERNES', '1');

-- ----------------------------
-- Table structure for docentes
-- ----------------------------
DROP TABLE IF EXISTS `docentes`;
CREATE TABLE `docentes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(12) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adicional` varchar(255) DEFAULT '',
  `usu_reg` varchar(255) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `fec_web` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of docentes
-- ----------------------------
INSERT INTO `docentes` VALUES ('1', '45198491', 'RAMÍREZ SHUPINGAHUA SEGUNDO ROGER', '944929637', 'ctiunsm@gmail.com', 'segunda prueba', '1', '2021-05-27', null, '1');

-- ----------------------------
-- Table structure for estudiantes
-- ----------------------------
DROP TABLE IF EXISTS `estudiantes`;
CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(12) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `adicional` varchar(255) DEFAULT '',
  `usu_reg` varchar(255) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `fec_web` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of estudiantes
-- ----------------------------
INSERT INTO `estudiantes` VALUES ('1', null, 'ss', '944929637', 'a', null, '1', '2021-05-25', null, '0');
INSERT INTO `estudiantes` VALUES ('2', '48190265', 'QUINDE HUAMÁN IVONNE', '123456789', 'ctiunsm@gmail.com', 'xxccx', '1', '2021-05-27', null, '1');
INSERT INTO `estudiantes` VALUES ('3', '45198491', 'RAMÍREZ SHUPINGAHUA SEGUNDO ROGER', '944929637', 'ramish390@hotmail.com', 'este alumno no posee muchos conocimientos', '1', '2021-05-27', null, '1');
INSERT INTO `estudiantes` VALUES ('4', '48198491', 'MOSQUERA NOA NAYLER', '456789149', 'ramish390@hotmail.com', 'prueba', '1', '2021-05-27', null, '1');
INSERT INTO `estudiantes` VALUES ('5', '71719922', 'COTRINA VALLES GERMAN', '920307572', 'GERMAN@gmail.com', 'ES UN PUTITO', '1', '2021-06-13', null, '1');

-- ----------------------------
-- Table structure for horarios
-- ----------------------------
DROP TABLE IF EXISTS `horarios`;
CREATE TABLE `horarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apertura_id` int(11) DEFAULT NULL,
  `dia_id` int(11) DEFAULT NULL,
  `hora_ini` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of horarios
-- ----------------------------

-- ----------------------------
-- Table structure for matriculas
-- ----------------------------
DROP TABLE IF EXISTS `matriculas`;
CREATE TABLE `matriculas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estudiante_id` int(11) DEFAULT NULL,
  `apertura_id` int(11) DEFAULT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `carrera_id` int(11) DEFAULT NULL,
  `costo` decimal(10,0) DEFAULT NULL,
  `descuento` varchar(255) DEFAULT NULL,
  `monto` varchar(255) DEFAULT NULL,
  `deuda` decimal(10,0) DEFAULT NULL,
  `pagado` tinyint(4) DEFAULT NULL,
  `matriculado` tinyint(4) DEFAULT NULL,
  `nota` tinyint(4) DEFAULT NULL,
  `certificado` tinyint(4) DEFAULT NULL,
  `usu_reg` int(11) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of matriculas
-- ----------------------------

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', 'aulas', 'mantenimiento/aulas');
INSERT INTO `menus` VALUES ('2', 'carreras', 'mantenimiento/carreras');
INSERT INTO `menus` VALUES ('3', 'ciclos', 'mantenimiento/ciclos');
INSERT INTO `menus` VALUES ('4', 'conceptos', 'mantenimiento/conceptos');
INSERT INTO `menus` VALUES ('5', 'dias', 'mantenimiento/dias');
INSERT INTO `menus` VALUES ('6', 'niveles', 'mantenimiento/niveles');
INSERT INTO `menus` VALUES ('7', 'sedes', 'mantenimiento/sedes');
INSERT INTO `menus` VALUES ('8', 'tipos', 'mantenimiento/tipos');
INSERT INTO `menus` VALUES ('9', 'estudiantes', 'registrar/estudiantes');
INSERT INTO `menus` VALUES ('10', 'docentes', 'registrar/docentes');
INSERT INTO `menus` VALUES ('11', 'cursos', 'registrar/cursos');
INSERT INTO `menus` VALUES ('12', 'modulos', 'registrar/modulos');

-- ----------------------------
-- Table structure for modulos
-- ----------------------------
DROP TABLE IF EXISTS `modulos`;
CREATE TABLE `modulos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curso_id` int(11) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `abreviatura` varchar(255) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `usu_reg` int(11) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of modulos
-- ----------------------------
INSERT INTO `modulos` VALUES ('1', '1', 'CILO I', 'A1-I', '30', '1', '2021-06-03', '1');
INSERT INTO `modulos` VALUES ('2', '1', 'CILO II', 'A1-II', '30', '1', '2021-06-03', '1');
INSERT INTO `modulos` VALUES ('3', '1', 'CICLO III', 'A1-III', '30', '1', '2021-06-03', '1');
INSERT INTO `modulos` VALUES ('4', '1', 'CICLO IV', 'A1-IV', '30', '1', '2021-06-03', '1');

-- ----------------------------
-- Table structure for niveles
-- ----------------------------
DROP TABLE IF EXISTS `niveles`;
CREATE TABLE `niveles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of niveles
-- ----------------------------
INSERT INTO `niveles` VALUES ('1', 'BÁSICO', '1');
INSERT INTO `niveles` VALUES ('2', 'INTERMEDIO', '1');
INSERT INTO `niveles` VALUES ('3', 'AVANZADO', '1');

-- ----------------------------
-- Table structure for notas
-- ----------------------------
DROP TABLE IF EXISTS `notas`;
CREATE TABLE `notas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula_id` int(11) DEFAULT NULL,
  `modulo_id` int(11) DEFAULT NULL,
  `nota` varchar(255) DEFAULT NULL,
  `usu_reg` int(11) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of notas
-- ----------------------------

-- ----------------------------
-- Table structure for pagos
-- ----------------------------
DROP TABLE IF EXISTS `pagos`;
CREATE TABLE `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula_id` int(11) DEFAULT NULL,
  `estudiante_id` int(11) DEFAULT NULL,
  `concepto_id` int(11) DEFAULT NULL,
  `descripcion` int(11) DEFAULT NULL,
  `monto` decimal(10,0) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `fec_pago` date DEFAULT NULL,
  `usu_reg` int(11) DEFAULT NULL,
  `fec_reg` date DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pagos
-- ----------------------------

-- ----------------------------
-- Table structure for permisos
-- ----------------------------
DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `insert` int(11) DEFAULT NULL,
  `update` int(11) DEFAULT NULL,
  `delete` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_menus` (`menu_id`),
  KEY `fk_roles` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of permisos
-- ----------------------------
INSERT INTO `permisos` VALUES ('1', '1', '1', '1', '0', '0', '0');
INSERT INTO `permisos` VALUES ('2', '2', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('3', '3', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('4', '4', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('5', '5', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('6', '6', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('7', '7', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('8', '8', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('9', '9', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('10', '10', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('11', '11', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('12', '12', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('13', '13', '1', '1', '1', '1', '1');
INSERT INTO `permisos` VALUES ('14', null, null, null, null, null, null);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'superadmin', 'hace de todo');

-- ----------------------------
-- Table structure for sedes
-- ----------------------------
DROP TABLE IF EXISTS `sedes`;
CREATE TABLE `sedes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of sedes
-- ----------------------------
INSERT INTO `sedes` VALUES ('1', 'OFICINA TARAPOTO', '1');
INSERT INTO `sedes` VALUES ('2', 'OFICINA MOYOBAMBA', '1');
INSERT INTO `sedes` VALUES ('3', 'OFICINA RIOJAS', '1');

-- ----------------------------
-- Table structure for tipos
-- ----------------------------
DROP TABLE IF EXISTS `tipos`;
CREATE TABLE `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of tipos
-- ----------------------------
INSERT INTO `tipos` VALUES ('1', 'PREGRADO', '1');
INSERT INTO `tipos` VALUES ('2', 'MAESTRÍA', '1');
INSERT INTO `tipos` VALUES ('3', 'DOCTORADO', '1');
INSERT INTO `tipos` VALUES ('4', 'PÚBLICO EN GENERAL', '1');
INSERT INTO `tipos` VALUES ('5', 'ADMINISTRATIVO', '1');
INSERT INTO `tipos` VALUES ('6', 'OTROS', '1');

-- ----------------------------
-- Table structure for tipo_documento
-- ----------------------------
DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE `tipo_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tipo_documento
-- ----------------------------
INSERT INTO `tipo_documento` VALUES ('1', 'DNI');
INSERT INTO `tipo_documento` VALUES ('2', 'RUC');
INSERT INTO `tipo_documento` VALUES ('3', 'PASAPORTE');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dni` varchar(255) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT '',
  `ciudad` varchar(100) DEFAULT '',
  `celular` varchar(20) DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_rol` (`rol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', '45198491', 'RAMÍREZ SHUPINGAHUA SEGUNDO ROGER', 'TARAPOTO', '944929637', 'segundoroger@gmail.com', 'shego', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '1', '1');
