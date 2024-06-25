-- MySQL dump 10.13  Distrib 8.0.31, for Win64 (x86_64)
--
-- Host: localhost    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `caja`
--

DROP TABLE IF EXISTS `caja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `caja` (
  `idCajas` int NOT NULL AUTO_INCREMENT,
  `fechaApertura` datetime DEFAULT NULL,
  `fechaCierre` datetime DEFAULT NULL,
  `Empleado_idEmpleado` int NOT NULL,
  PRIMARY KEY (`idCajas`),
  KEY `fk_Cajas_Empleado1_idx` (`Empleado_idEmpleado`),
  CONSTRAINT `fk_Cajas_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compra`
--

DROP TABLE IF EXISTS `compra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `compra` (
  `idCompra` int NOT NULL AUTO_INCREMENT,
  `fechaCompra` date NOT NULL,
  `horaCompra` time NOT NULL,
  `totalCompra` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `metodoPago_idmetodoPago` int NOT NULL,
  PRIMARY KEY (`idCompra`),
  KEY `fk_Compra_metodoPago1_idx` (`metodoPago_idmetodoPago`),
  CONSTRAINT `fk_Compra_metodoPago1` FOREIGN KEY (`metodoPago_idmetodoPago`) REFERENCES `metodopago` (`idmetodoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacto`
--

DROP TABLE IF EXISTS `contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacto` (
  `idcontacto` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(150) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `tipoContacto_idtipoContacto` int NOT NULL,
  `Persona_idPersona` int NOT NULL,
  PRIMARY KEY (`idcontacto`),
  KEY `fk_contacto_tipoContacto1_idx` (`tipoContacto_idtipoContacto`),
  KEY `fk_contacto_Persona1_idx` (`Persona_idPersona`),
  CONSTRAINT `fk_contacto_Persona1` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`),
  CONSTRAINT `fk_contacto_tipoContacto1` FOREIGN KEY (`tipoContacto_idtipoContacto`) REFERENCES `tipocontacto` (`idtipoContacto`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacto`
--

LOCK TABLES `contacto` WRITE;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` VALUES (1,'3704611035',1,1,10),(2,'salinasjuanmanuel98@gmail.com',1,3,11),(3,'salinasjuanmanuel98@gmail.com',1,1,13),(4,'3704063638',1,1,1),(5,'3704611035',1,1,2),(6,'nico@gmail.com',1,3,3),(7,'3704063638',1,1,14),(8,'3704611035',1,1,15),(9,'palermo@gmail.com',1,3,17),(10,'3704611035',1,3,16),(11,'1105659874',1,1,18),(12,'370400505505',1,1,19),(13,'3718617994',1,1,20),(14,'martin@gmail.com',1,1,21),(15,'3704063638',1,1,22),(16,'3704063638',1,1,23),(17,'3704063638',1,1,24),(18,'3704063638',1,1,25),(19,'3704063638',1,1,26),(20,'cocacola@hotmail.com',1,1,27),(21,'alfadistribuidora@gmail.com',1,3,28);
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalle_venta`
--

DROP TABLE IF EXISTS `detalle_venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalle_venta` (
  `idDetalle_Venta` int NOT NULL AUTO_INCREMENT,
  `precioActual` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `Venta_idVenta` int NOT NULL,
  `Producto_idProductos` int NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idDetalle_Venta`),
  KEY `fk_Detalle_Venta_Venta1_idx` (`Venta_idVenta`),
  KEY `fk_Detalle_Venta_Producto1_idx` (`Producto_idProductos`),
  CONSTRAINT `fk_Detalle_Venta_Producto1` FOREIGN KEY (`Producto_idProductos`) REFERENCES `producto` (`idProductos`),
  CONSTRAINT `fk_Detalle_Venta_Venta1` FOREIGN KEY (`Venta_idVenta`) REFERENCES `venta` (`idVenta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detallecompra`
--

DROP TABLE IF EXISTS `detallecompra`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detallecompra` (
  `iddetalleCompra` int NOT NULL AUTO_INCREMENT,
  `precioActual` decimal(10,2) NOT NULL,
  `cantidad` int NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Producto_idProductos` int NOT NULL,
  `Compra_idCompra` int NOT NULL,
  PRIMARY KEY (`iddetalleCompra`),
  KEY `fk_detalleCompra_Producto1_idx` (`Producto_idProductos`),
  KEY `fk_detalleCompra_Compra1_idx` (`Compra_idCompra`),
  CONSTRAINT `fk_detalleCompra_Compra1` FOREIGN KEY (`Compra_idCompra`) REFERENCES `compra` (`idCompra`),
  CONSTRAINT `fk_detalleCompra_Producto1` FOREIGN KEY (`Producto_idProductos`) REFERENCES `producto` (`idProductos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detallecompra`
--

LOCK TABLES `detallecompra` WRITE;
/*!40000 ALTER TABLE `detallecompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecompra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleusuario`
--

DROP TABLE IF EXISTS `detalleusuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleusuario` (
  `iddetalleUsuario` int NOT NULL AUTO_INCREMENT,
  `fechaHoraIngreso` datetime NOT NULL,
  `fechaHoraEgreso` datetime NOT NULL,
  `Usuario_idUsuario` int NOT NULL,
  PRIMARY KEY (`iddetalleUsuario`),
  KEY `fk_detalleUsuario_Usuario1_idx` (`Usuario_idUsuario`),
  CONSTRAINT `fk_detalleUsuario_Usuario1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleusuario`
--

LOCK TABLES `detalleusuario` WRITE;
/*!40000 ALTER TABLE `detalleusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `direccion`
--

DROP TABLE IF EXISTS `direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `direccion` (
  `idDireccion` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Persona_idPersona` int NOT NULL,
  PRIMARY KEY (`idDireccion`),
  KEY `fk_Direccion_Persona1_idx` (`Persona_idPersona`),
  CONSTRAINT `fk_Direccion_Persona1` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3 COMMENT='			';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` VALUES (1,'Barrio Eva Peron',1,1),(2,'EVA PERON M64 ',1,15),(3,'B° Eva Peron Mz 64 Casa 31',1,14),(4,'Brandsen 805',1,17),(5,'EVA PERON M64 C31',1,16),(6,'Brandsen 805',1,18),(7,'San Miguel',1,19),(8,'Barrio San Francisco',1,20),(9,'Brandsen 805',1,21),(10,'Barrio Republi',1,22),(11,'Barrio Republi',1,23),(12,'Barrio Republi',1,24),(13,'Barrio Republi',1,25),(14,'Yapeyú',1,26),(15,'9 De Julio',1,27),(16,'Gutnisky 2300',1,28);
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documento`
--

DROP TABLE IF EXISTS `documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `documento` (
  `idDocumento` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(100) NOT NULL,
  `tipoDocumentos_idtipoDocumentos` int NOT NULL,
  `Persona_idPersona` int NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idDocumento`),
  KEY `fk_Documento_tipoDocumentos1_idx` (`tipoDocumentos_idtipoDocumentos`),
  KEY `fk_Documento_Persona1_idx` (`Persona_idPersona`),
  CONSTRAINT `fk_Documento_Persona1` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`),
  CONSTRAINT `fk_Documento_tipoDocumentos1` FOREIGN KEY (`tipoDocumentos_idtipoDocumentos`) REFERENCES `tipodocumentos` (`idtipoDocumentos`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (1,'14738658',1,10,1),(2,'42181949',1,11,1),(3,'42181949',1,13,1),(4,'40988670',1,1,1),(5,'39845789',1,3,1),(6,'40988670',1,14,1),(7,'14738658',1,15,1),(8,'40988670',1,14,1),(9,'40988670',1,14,1),(10,'40988670',1,14,1),(11,'40988670',1,14,1),(12,'40988670',1,14,1),(13,'40988670',1,14,1),(14,'40988670',1,14,1),(15,'20000000',1,17,1),(16,'40988670',1,16,1),(17,'20001128',1,18,1),(18,'4006589',1,19,1),(19,'42759127',1,20,1),(20,'20-20658942-2',4,21,1),(21,'40988670',1,22,1),(22,'40988670',1,23,1),(23,'40988670',1,24,1),(24,'40988670',1,25,1),(25,'1',1,26,1),(26,'202965123123123',4,27,1),(27,'2024617',4,28,1);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `egreso`
--

DROP TABLE IF EXISTS `egreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `egreso` (
  `idEgresos` int NOT NULL AUTO_INCREMENT,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Empleado_idEmpleado` int NOT NULL,
  `tipoGastos_idtipoGastos` int NOT NULL,
  PRIMARY KEY (`idEgresos`),
  KEY `fk_Gastos_Empleado1_idx` (`Empleado_idEmpleado`),
  KEY `fk_Gastos_tipoGastos1_idx` (`tipoGastos_idtipoGastos`),
  CONSTRAINT `fk_Gastos_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  CONSTRAINT `fk_Gastos_tipoGastos1` FOREIGN KEY (`tipoGastos_idtipoGastos`) REFERENCES `tipoegresos` (`idtipoEgresos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `egreso`
--

LOCK TABLES `egreso` WRITE;
/*!40000 ALTER TABLE `egreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `egreso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `empleado`
--

DROP TABLE IF EXISTS `empleado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `empleado` (
  `idEmpleado` int NOT NULL AUTO_INCREMENT,
  `fechaAlta` datetime NOT NULL,
  `legajo` varchar(100) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Persona_idPersona` int NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  KEY `fk_Empleado_Persona1_idx` (`Persona_idPersona`),
  CONSTRAINT `fk_Empleado_Persona1` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'2022-05-06 00:00:00','1231551',1,1),(2,'2024-06-15 18:31:26','665656',1,1),(3,'2024-06-15 20:16:51','20016565',1,18),(4,'2024-06-16 22:03:05','1231551241',1,19),(5,'2024-06-16 22:03:47','123155124232',1,20),(6,'2024-06-16 22:04:08','12315512412',1,21),(7,'2024-06-16 22:04:16','123155124',0,22),(8,'2024-06-16 22:09:48','123155124',0,23),(9,'2024-06-16 22:09:55','123155124',0,24),(10,'2024-06-16 22:12:00','123155124',0,25),(11,'2024-06-17 12:27:05','123123123',0,26);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marca`
--

DROP TABLE IF EXISTS `marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `marca` (
  `idMarca` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'Coca Cola',1),(2,'Lays',1),(3,'Pepsi',1),(4,'Malboro',1),(5,'Poett',1),(6,'Nestle',1),(7,'Rexona',1),(8,'Arcor',1),(9,'Oreo',1),(10,'Malboro',0),(11,'Malboro',0),(12,'Malboro',0),(13,'Oreo',0),(14,'La Serenísima',1);
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `metodopago`
--

DROP TABLE IF EXISTS `metodopago`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `metodopago` (
  `idmetodoPago` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmetodoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `metodopago`
--

LOCK TABLES `metodopago` WRITE;
/*!40000 ALTER TABLE `metodopago` DISABLE KEYS */;
/*!40000 ALTER TABLE `metodopago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `modulos` (
  `idmodulos` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idmodulos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'usuarios',1),(2,'ventas',1),(3,'productos',1),(4,'compras',1),(5,'personas',1),(6,'egresos',1);
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles`
--

DROP TABLE IF EXISTS `perfiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles` (
  `idperfiles` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idperfiles`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'Administrador',1),(2,'Vendedor',1),(3,'Gerente',0);
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `perfiles_has_modulos`
--

DROP TABLE IF EXISTS `perfiles_has_modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `perfiles_has_modulos` (
  `perfiles_idperfiles` int NOT NULL,
  `modulos_idmodulos` int NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`perfiles_idperfiles`,`modulos_idmodulos`),
  KEY `fk_perfiles_has_modulos_modulos1_idx` (`modulos_idmodulos`),
  KEY `fk_perfiles_has_modulos_perfiles1_idx` (`perfiles_idperfiles`),
  CONSTRAINT `fk_perfiles_has_modulos_modulos1` FOREIGN KEY (`modulos_idmodulos`) REFERENCES `modulos` (`idmodulos`),
  CONSTRAINT `fk_perfiles_has_modulos_perfiles1` FOREIGN KEY (`perfiles_idperfiles`) REFERENCES `perfiles` (`idperfiles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `perfiles_has_modulos`
--

LOCK TABLES `perfiles_has_modulos` WRITE;
/*!40000 ALTER TABLE `perfiles_has_modulos` DISABLE KEYS */;
INSERT INTO `perfiles_has_modulos` VALUES (1,1,1),(1,2,1),(1,3,1),(1,4,1),(1,5,1),(1,6,1),(2,1,0),(2,2,1),(2,3,1),(2,4,1),(2,5,0),(2,6,1);
/*!40000 ALTER TABLE `perfiles_has_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `persona`
--

DROP TABLE IF EXISTS `persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `persona` (
  `idPersona` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Juan Manuel','Salinas',1),(2,'Mauricio','Salinas',0),(3,'Nicolas','Mastori',0),(4,'Nelida','Ruiz Diaz',0),(5,'Alan','Beck',0),(6,'Juan Manuel','Salinas',0),(7,'Juan Manuel','Salinas',0),(8,'Juan Manuel','Salinas',0),(9,'Nelida','Ruiz Diaz',0),(10,'Nelida','Ruiz Diaz',0),(11,'Mauricio Fabian','Salinas',0),(12,'Mauricio Fabian','Salinas',0),(13,'Mauricio Fabian','Salinas',0),(14,'Juan Manuel','Salinas',1),(15,'Nelida','Ruiz Diaz',1),(16,'Martin','Palermo',1),(17,'Martin','Palermo',1),(18,'Juan Roman','Riquelme',1),(19,'Nicolas','Mastori',1),(20,'Mauricio Fabi','Salinas',1),(21,'Martin','Palermo',1),(22,'Juan Manuel','Salinas',0),(23,'Juan Manuel','Salinas',0),(24,'Juan Manuel','Salinas',0),(25,'Juan Manuel','Salinas',0),(26,'José ','de San Martín',0),(27,'Coca Cola ','Coca Cola',1),(28,'Alfa','null',1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `producto`
--

DROP TABLE IF EXISTS `producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `producto` (
  `idProductos` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codBarras` varchar(100) NOT NULL,
  `cantidad` int NOT NULL,
  `cantidadMin` int NOT NULL,
  `precioCosto` decimal(10,2) NOT NULL,
  `precioVenta` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Marca_idMarca` int NOT NULL,
  `Rubro_idRubros` int NOT NULL,
  PRIMARY KEY (`idProductos`),
  KEY `fk_Producto_Marca_idx` (`Marca_idMarca`),
  KEY `fk_Producto_Rubro1_idx` (`Rubro_idRubros`),
  CONSTRAINT `fk_Producto_Marca` FOREIGN KEY (`Marca_idMarca`) REFERENCES `marca` (`idMarca`),
  CONSTRAINT `fk_Producto_Rubro1` FOREIGN KEY (`Rubro_idRubros`) REFERENCES `rubro` (`idRubros`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Coca Cola 1.5L','78949007098',15,1,1500.00,2300.00,1,1,2),(2,'Galletas Oreo','1234567890123',50,10,600.00,900.00,1,9,4),(3,'Papas Fritas Lays','3456789012345',30,5,1200.00,1550.00,0,2,5);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedor` (
  `idProveedor` int NOT NULL AUTO_INCREMENT,
  `razonSocial` varchar(100) NOT NULL,
  `fechaAlta` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Persona_idPersona` int NOT NULL,
  PRIMARY KEY (`idProveedor`),
  KEY `fk_Proveedor_Persona1_idx` (`Persona_idPersona`),
  CONSTRAINT `fk_Proveedor_Persona1` FOREIGN KEY (`Persona_idPersona`) REFERENCES `persona` (`idPersona`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'Coca Cola Srl','2024-06-17',1,27),(2,'Alfa Srl','2024-06-17',1,28);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubro`
--

DROP TABLE IF EXISTS `rubro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rubro` (
  `idRubros` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idRubros`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubro`
--

LOCK TABLES `rubro` WRITE;
/*!40000 ALTER TABLE `rubro` DISABLE KEYS */;
INSERT INTO `rubro` VALUES (1,'Gaseosas',1),(2,'Limpieza',1),(3,'Higiene',1),(4,'Galletas',1),(5,'Snacks',1),(6,'Lácteos',1);
/*!40000 ALTER TABLE `rubro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipocontacto`
--

DROP TABLE IF EXISTS `tipocontacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipocontacto` (
  `idtipoContacto` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(80) NOT NULL,
  `estado` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`idtipoContacto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipocontacto`
--

LOCK TABLES `tipocontacto` WRITE;
/*!40000 ALTER TABLE `tipocontacto` DISABLE KEYS */;
INSERT INTO `tipocontacto` VALUES (1,'Telefono',1),(2,'',0),(3,'Email',1),(4,'Celular',1),(5,'Instagram',0);
/*!40000 ALTER TABLE `tipocontacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipodocumentos`
--

DROP TABLE IF EXISTS `tipodocumentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipodocumentos` (
  `idtipoDocumentos` int NOT NULL AUTO_INCREMENT,
  `valor` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipoDocumentos`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipodocumentos`
--

LOCK TABLES `tipodocumentos` WRITE;
/*!40000 ALTER TABLE `tipodocumentos` DISABLE KEYS */;
INSERT INTO `tipodocumentos` VALUES (1,'DNI',1),(2,'Extranjero',1),(3,'Libreta Civica',1),(4,'CUIT',1),(5,'CUIL',1),(6,'L.E.',1);
/*!40000 ALTER TABLE `tipodocumentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipoegresos`
--

DROP TABLE IF EXISTS `tipoegresos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipoegresos` (
  `idtipoEgresos` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`idtipoEgresos`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipoegresos`
--

LOCK TABLES `tipoegresos` WRITE;
/*!40000 ALTER TABLE `tipoegresos` DISABLE KEYS */;
INSERT INTO `tipoegresos` VALUES (1,'Factura Luz',1);
/*!40000 ALTER TABLE `tipoegresos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `fechaAlta` date NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `Empleado_idEmpleado` int NOT NULL,
  `perfiles_idperfiles` int NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `fk_Usuario_Empleado1_idx` (`Empleado_idEmpleado`),
  KEY `fk_Usuario_perfiles1_idx` (`perfiles_idperfiles`),
  CONSTRAINT `fk_Usuario_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  CONSTRAINT `fk_Usuario_perfiles1` FOREIGN KEY (`perfiles_idperfiles`) REFERENCES `perfiles` (`idperfiles`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'manusalinas','123','2022-05-06',1,1,1),(2,'manusalina5','$2y$10$d8T5j3qy3stMOIv0BZeVTu9bolIGNON.yE/311ozavf7D9YcuktOS','2024-06-17',1,1,1),(3,'manusalinasfsa','$2y$10$e0uhK/I8roQLnZPdpgKCyOs2UFGzs7E3o4tpesQqeEpRJwMkfWs7G','2024-06-17',0,2,1),(4,'root','$2y$10$wyjpJuUCyJG3GXXhoTeSNuBtnSOlfZ6yukgsx7Nyx8iqj5lesZ3KO','2024-06-18',0,3,2),(5,'prueba','$2y$10$XNZ4uihNidEqmJDFUuqjF.Hfz2PPJhmtWUivsLRqSqKcdyjO7ju1G','2024-06-18',1,9,2),(6,'nicolasmastori','$2y$10$p8S28sYsjCOFKPbQJRjIZOnIwsr69CueIvlKL8iLnabwPojJJXqEq','2024-06-22',1,4,1),(7,'martinpalermo','$2y$10$rbw7aFi08qI//sCQQbcIhuRUA5uXZ/ZMOLeYmLxpp0slTRtcSM.ee','2024-06-22',1,6,1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `venta` (
  `idVenta` int NOT NULL AUTO_INCREMENT,
  `fechaVenta` date NOT NULL,
  `horaVenta` time NOT NULL,
  `totalVenta` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `metodoPago_idmetodoPago` int NOT NULL,
  `Empleado_idEmpleado` int NOT NULL,
  PRIMARY KEY (`idVenta`),
  KEY `fk_Venta_metodoPago1_idx` (`metodoPago_idmetodoPago`),
  KEY `fk_Venta_Empleado1_idx` (`Empleado_idEmpleado`),
  CONSTRAINT `fk_Venta_Empleado1` FOREIGN KEY (`Empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`),
  CONSTRAINT `fk_Venta_metodoPago1` FOREIGN KEY (`metodoPago_idmetodoPago`) REFERENCES `metodopago` (`idmetodoPago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-06-25 17:27:35
