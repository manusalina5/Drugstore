-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Dumping data for table `caja`
--

LOCK TABLES `caja` WRITE;
/*!40000 ALTER TABLE `caja` DISABLE KEYS */;
INSERT INTO `caja` VALUES (2,'2024-10-16 16:47:00',NULL,1000.00,NULL,0,1),(3,'2024-10-16 18:53:54',NULL,1500.00,NULL,0,1),(4,'2024-10-18 17:20:09',NULL,3000.00,NULL,0,1),(5,'2024-10-18 18:16:23','2024-10-18 19:20:31',2000.00,12307.48,-1,1),(6,'2024-10-18 20:21:55',NULL,3000.00,NULL,1,1);
/*!40000 ALTER TABLE `caja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'2024-09-14 12:29:55',1,'Cliente default',30),(2,'2024-09-19 18:33:46',1,'piola',31),(3,'2024-10-01 14:33:36',1,'Jugador.',36),(4,'2024-10-01 14:35:24',1,'Jugador',37),(5,'2024-10-01 15:33:18',1,'prueba',38),(6,'2024-10-01 15:36:40',1,'asdasd',39),(7,'2024-10-01 15:36:41',1,'asdasd',40),(8,'2024-10-01 15:40:14',1,'',41),(9,'2024-10-01 15:44:51',1,'',42),(10,'2024-10-01 15:50:57',1,'',43),(11,'2024-10-01 15:53:06',1,'',44),(12,'2024-10-01 15:53:42',1,'',45),(13,'2024-10-01 15:53:43',1,'',46),(14,'2024-10-01 15:58:56',1,'',47),(15,'2024-10-01 15:58:57',1,'',48),(16,'2024-10-01 16:02:00',1,'',49),(17,'2024-10-01 16:02:01',1,'',50),(18,'2024-10-01 16:28:27',1,'',51),(19,'2024-10-01 16:28:28',1,'',52),(20,'2024-10-01 16:29:47',1,'',53),(21,'2024-10-01 16:29:48',1,'',54),(22,'2024-10-01 16:30:25',1,'',55),(23,'2024-10-01 16:30:26',1,'',56),(24,'2024-10-01 16:46:14',1,'asdasdasd',57),(25,'2024-10-01 16:46:15',1,'asdasdasd',58),(26,'2024-10-01 16:46:26',1,'aasdasd',59),(27,'2024-10-01 16:46:27',1,'aasdasd',60),(28,'2024-10-01 16:53:39',1,'',61),(29,'2024-10-01 16:53:40',1,'',62),(30,'2024-10-01 16:56:51',1,'',63),(31,'2024-10-01 16:56:52',1,'',64),(32,'2024-10-01 16:57:44',1,'',65),(33,'2024-10-01 16:57:45',1,'',66),(34,'2024-10-01 17:01:28',1,'',67),(35,'2024-10-01 17:01:29',1,'',68),(36,'2024-10-01 17:13:56',1,'',69),(37,'2024-10-01 17:36:17',1,'',70),(38,'2024-10-01 17:36:18',1,'',71),(39,'2024-10-01 17:39:24',1,'',72),(40,'2024-10-01 17:51:38',1,'',73),(41,'2024-10-01 18:07:47',1,'',74),(42,'2024-10-01 18:18:24',1,'',75),(43,'2024-10-01 18:19:22',1,'',76),(44,'2024-10-01 23:44:41',1,'',77),(45,'2024-10-02 00:00:33',1,'',78),(46,'2024-10-02 00:04:02',1,'',79),(47,'2024-10-02 00:04:04',1,'',80),(48,'2024-10-02 00:04:05',1,'',81),(49,'2024-10-02 00:04:06',1,'',82),(50,'2024-10-02 00:04:06',1,'',83),(51,'2024-10-02 00:04:06',1,'',84),(52,'2024-10-02 00:06:36',1,'',85),(53,'2024-10-02 00:07:07',1,'',86),(54,'2024-10-02 00:14:16',1,'',87),(55,'2024-10-02 14:18:40',1,'',88),(56,'2024-10-02 14:22:33',1,'',89),(57,'2024-10-02 14:24:00',1,'',90),(58,'2024-10-02 14:31:50',1,'asdasd',91),(59,'2024-10-02 15:34:34',1,'maury',92);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `comboproductos`
--

LOCK TABLES `comboproductos` WRITE;
/*!40000 ALTER TABLE `comboproductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `comboproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `combos`
--

LOCK TABLES `combos` WRITE;
/*!40000 ALTER TABLE `combos` DISABLE KEYS */;
/*!40000 ALTER TABLE `combos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `compra`
--

LOCK TABLES `compra` WRITE;
/*!40000 ALTER TABLE `compra` DISABLE KEYS */;
/*!40000 ALTER TABLE `compra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `contacto`
--

LOCK TABLES `contacto` WRITE;
/*!40000 ALTER TABLE `contacto` DISABLE KEYS */;
INSERT INTO `contacto` VALUES (1,'3704611035',1,1,10),(2,'salinasjuanmanuel98@gmail.com',1,3,11),(3,'salinasjuanmanuel98@gmail.com',1,1,13),(4,'3704063638',1,1,1),(5,'3704611035',1,1,2),(6,'nico@gmail.com',1,3,3),(7,'3704063638',1,1,14),(8,'3704611035',1,1,15),(9,'palermo@gmail.com',1,3,17),(10,'3704611035',1,3,16),(11,'1105659874',1,1,18),(12,'370400505505',1,1,19),(13,'+549(371)8617994',1,1,20),(14,'martin@gmail.com',1,1,21),(15,'3704063638',1,1,22),(16,'3704063638',1,1,23),(17,'3704063638',1,1,24),(18,'3704063638',1,1,25),(19,'3704063638',1,1,26),(20,'cocacola@hotmail.com',1,1,27),(21,'alfadistribuidora@gmail.com',1,3,28),(22,'admin@admin.com',1,3,30),(23,'3704063638',1,1,31),(24,'+549(370)4063638',1,1,32),(25,'+549(370)4255897',1,1,33),(26,'3704063638',1,1,34),(27,'+549(370)5063638',1,1,35),(28,'3704063638',1,1,36),(29,'+549(370)4063638',1,1,37),(30,'+549(371)23123',1,1,38),(31,'+549(371)23123',1,1,57),(32,'+549(371)23123',1,1,58),(33,'+549(371)23123',1,1,59),(34,'+549(371)23123',1,1,60),(35,'+549(370)4063638',1,1,61),(36,'+549(370)4063638',1,1,62),(37,'+549(370)4063638',1,1,63),(38,'+549(370)4063638',1,1,64),(39,'+549(370)4063638',1,1,65),(40,'+549(370)4063638',1,1,66),(41,'+549(370)4063638',1,1,67),(42,'+549(370)4063638',1,1,68),(43,'+549(370)4063638',1,1,69),(44,'+549(370)4063638',1,1,70),(45,'+549(370)4063638',1,1,71),(46,'+549(370)4063638',1,1,72),(47,'+549(370)4063638',1,1,73),(48,'+549(370)4063638',1,1,74),(49,'+549(370)405555',1,1,75),(50,'lautaro@gmail.com',1,1,76),(51,'lautaro@gmail.com',1,1,77),(52,'lautaro@gmail.com',1,1,78),(53,'lautaro@gmail.com',1,1,79),(54,'lautaro@gmail.com',1,1,80),(55,'lautaro@gmail.com',1,1,81),(56,'lautaro@gmail.com',1,1,82),(57,'lautaro@gmail.com',1,1,83),(58,'lautaro@gmail.com',1,1,84),(59,'lautaro@gmail.com',1,1,85),(60,'lautaro@gmail.com',1,1,86),(61,'lautaro@gmail.com',1,1,87),(62,'+549(370)4063638',1,1,88),(63,'+549(370)4063638',1,1,89),(64,'+549(370)4063638',1,1,90),(65,'+549(370)4063638',1,1,91),(66,'maury@gmail.com',1,3,92);
/*!40000 ALTER TABLE `contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalle_venta`
--

LOCK TABLES `detalle_venta` WRITE;
/*!40000 ALTER TABLE `detalle_venta` DISABLE KEYS */;
INSERT INTO `detalle_venta` VALUES (1,2300.00,10,3,1,1),(2,90.00,10,3,6,1),(3,900.00,15,4,2,1),(4,1900.00,5,4,15,1),(5,300.00,2,5,7,1),(6,2300.00,2,5,1,1),(7,50.00,4,5,5,1),(8,2441.87,1,6,1,1),(9,90.00,2,6,6,1),(10,2441.87,3,7,1,1),(11,90.00,4,8,6,1);
/*!40000 ALTER TABLE `detalle_venta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detallecompra`
--

LOCK TABLES `detallecompra` WRITE;
/*!40000 ALTER TABLE `detallecompra` DISABLE KEYS */;
/*!40000 ALTER TABLE `detallecompra` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `detalleusuario`
--

LOCK TABLES `detalleusuario` WRITE;
/*!40000 ALTER TABLE `detalleusuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `detalleusuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `direccion`
--

LOCK TABLES `direccion` WRITE;
/*!40000 ALTER TABLE `direccion` DISABLE KEYS */;
INSERT INTO `direccion` VALUES (1,'Barrio Eva Peron',1,1),(2,'EVA PERON M64 ',1,15),(3,'B° Eva Peron Mz 64 Casa 31',1,14),(4,'Brandsen 805',1,17),(5,'EVA PERON M64 C31',1,16),(6,'Brandsen 805',1,18),(7,'San Miguel',1,19),(8,'Barrio San Francisco',1,20),(9,'Brandsen 805',1,21),(10,'Barrio Republi',1,22),(11,'Barrio Republi',1,23),(12,'Barrio Republi',1,24),(13,'Barrio Republi',1,25),(14,'Yapeyú',1,26),(15,'9 De Julio',1,27),(16,'Gutnisky 2300',1,28),(17,'Sin datos',1,30),(18,'B° EVA PERON M64 C31',1,31),(19,'Gutnisky',1,32),(20,'Brandsen 805',1,33),(21,' ',1,34),(22,'San Martin 205',1,35),(23,'Manchester, Inglaterra',1,36),(24,'Manchester  Inglaterra',1,37),(25,'Manchester Inglaterra',1,38),(26,'asdasdasd',1,57),(27,'asdasdasd',1,58),(28,'asd',1,59),(29,'asd',1,60),(30,'asdasdasd',1,61),(31,'asdasdasd',1,62),(32,'asdasdasd',1,63),(33,'asdasdasd',1,64),(34,'Manchester, Inglaterra',1,65),(35,'Manchester, Inglaterra',1,66),(36,'asdasdasd',1,67),(37,'asdasdasd',1,68),(38,'asdasdasd',1,69),(39,'asdfasdasd',1,70),(40,'asdfasdasd',1,71),(41,'asdasdasd',1,72),(42,'asdasdasd',1,73),(43,'asdasdasdasd',1,74),(44,'San Martin 985',1,75),(45,'Italia',1,76),(46,'asdasdasd',1,77),(47,'asdasdasd',1,78),(48,'asdasdasd',1,79),(49,'asdasdasd',1,80),(50,'asdasdasd',1,81),(51,'asdasdasd',1,82),(52,'asdasdasd',1,83),(53,'asdasdasd',1,84),(54,'B° EVA PERON M64 C31',1,85),(55,'B° EVA PERON M64 C31',1,86),(56,'Italia',1,87),(57,'La boca',1,88),(58,'asdasdasdasd',1,89),(59,'asdasdas',1,90),(60,'adasdasdasd',1,91),(61,'barrio eva peron',1,92);
/*!40000 ALTER TABLE `direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `documento`
--

LOCK TABLES `documento` WRITE;
/*!40000 ALTER TABLE `documento` DISABLE KEYS */;
INSERT INTO `documento` VALUES (1,'14738658',1,10,1),(2,'42181949',1,11,1),(3,'42181949',1,13,1),(4,'40988670',1,1,1),(5,'39845789',1,3,1),(6,'40988670',1,14,1),(7,'14738658',1,15,1),(8,'40988670',1,14,1),(9,'40988670',1,14,1),(10,'40988670',1,14,1),(11,'40988670',1,14,1),(12,'40988670',1,14,1),(13,'40988670',1,14,1),(14,'40988670',1,14,1),(15,'20000000',1,17,1),(16,'40988670',1,16,1),(17,'20001128',1,18,1),(18,'4006589',1,19,1),(19,'42759127',1,20,1),(20,'20-20658942-2',4,21,1),(21,'40988670',1,22,1),(22,'40988670',1,23,1),(23,'40988670',1,24,1),(24,'40988670',1,25,1),(25,'1',1,26,1),(26,'202965123123123',4,27,1),(27,'2024617',4,28,1),(28,'1',1,30,1),(29,'40988670',1,31,1),(30,'65656565656',2,32,1),(31,'20001128',1,33,1),(32,'20001128',1,34,1),(33,'45687900',1,35,1),(34,'28495874',1,36,1),(35,'28495874',1,37,1),(36,'40988670',1,38,1),(37,'40988670',1,57,1),(38,'40988670',1,58,1),(39,'40988670',1,59,1),(40,'40988670',1,60,1),(41,'2588989',2,61,1),(42,'2588989',2,62,1),(43,'2588989',1,63,1),(44,'2588989',1,64,1),(45,'2588989',1,65,1),(46,'2588989',1,66,1),(47,'2588989',1,67,1),(48,'2588989',1,68,1),(49,'2588989',1,69,1),(50,'2588989',1,70,1),(51,'2588989',1,71,1),(52,'2588989',1,72,1),(53,'2588989',1,73,1),(54,'2588989',1,74,1),(55,'29325000',1,75,1),(56,'258888888',1,76,1),(57,'40988670',1,77,1),(58,'40988670',1,78,1),(59,'40988670',1,79,1),(60,'40988670',1,80,1),(61,'40988670',1,81,1),(62,'40988670',1,82,1),(63,'40988670',1,83,1),(64,'40988670',1,84,1),(65,'40988670',1,85,1),(66,'40988670',1,86,1),(67,'40988670',1,87,1),(68,'32000000',1,88,1),(69,'32000000',1,89,1),(70,'32000000',1,90,1),(71,'2636589',1,91,1),(72,'42127548',1,92,1);
/*!40000 ALTER TABLE `documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `empleado`
--

LOCK TABLES `empleado` WRITE;
/*!40000 ALTER TABLE `empleado` DISABLE KEYS */;
INSERT INTO `empleado` VALUES (1,'2022-05-06 00:00:00','1231551',1,1),(2,'2024-06-15 18:31:26','665656',1,1),(3,'2024-06-15 20:16:51','20016565',1,18),(4,'2024-06-16 22:03:05','1231551241',1,19),(5,'2024-06-16 22:03:47','123155124232',1,20),(6,'2024-06-16 22:04:08','12315512412',1,21),(7,'2024-06-16 22:04:16','123155124',0,22),(8,'2024-06-16 22:09:48','123155124',0,23),(9,'2024-06-16 22:09:55','123155124',0,24),(10,'2024-06-16 22:12:00','123155124',0,25),(11,'2024-06-17 12:27:05','123123123',0,26),(12,'2024-09-19 22:00:08','20016565',0,33),(13,'2024-09-19 22:01:14','20016565',0,34);
/*!40000 ALTER TABLE `empleado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `marca`
--

LOCK TABLES `marca` WRITE;
/*!40000 ALTER TABLE `marca` DISABLE KEYS */;
INSERT INTO `marca` VALUES (1,'Coca Cola',1),(2,'Lays',1),(3,'Pepsi',1),(4,'Malboro',1),(5,'Poett',1),(6,'Nestle',1),(7,'Rexona',1),(8,'Arcor',1),(9,'Oreo',1),(10,'Malboro',0),(11,'Malboro',0),(12,'Malboro',0),(13,'Oreo',0),(14,'La Serenísima',1),(15,'Pruebas',0),(16,'Molinos Río de la Plata',1);
/*!40000 ALTER TABLE `marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `metodopago`
--

LOCK TABLES `metodopago` WRITE;
/*!40000 ALTER TABLE `metodopago` DISABLE KEYS */;
INSERT INTO `metodopago` VALUES (1,'Efectivo','Pagos con dinero físico',1),(2,'Tarjeta de Crédito','',1),(3,'Tarjeta de Débito','',1);
/*!40000 ALTER TABLE `metodopago` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,'usuarios',1),(2,'ventas',1),(3,'productos',1),(4,'compras',1),(5,'personas',1),(6,'egresos',1),(7,'caja',1);
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `movimientocaja`
--

LOCK TABLES `movimientocaja` WRITE;
/*!40000 ALTER TABLE `movimientocaja` DISABLE KEYS */;
/*!40000 ALTER TABLE `movimientocaja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `perfiles`
--

LOCK TABLES `perfiles` WRITE;
/*!40000 ALTER TABLE `perfiles` DISABLE KEYS */;
INSERT INTO `perfiles` VALUES (1,'Administrador',1),(2,'Vendedor',1),(3,'Gerente',1);
/*!40000 ALTER TABLE `perfiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `perfiles_has_modulos`
--

LOCK TABLES `perfiles_has_modulos` WRITE;
/*!40000 ALTER TABLE `perfiles_has_modulos` DISABLE KEYS */;
INSERT INTO `perfiles_has_modulos` VALUES (1,1,1),(1,2,1),(1,3,1),(1,4,1),(1,5,1),(1,6,1),(1,7,1),(2,1,0),(2,2,1),(2,3,0),(2,4,1),(2,5,0),(2,6,1),(3,2,1),(3,3,1),(3,4,1),(3,6,1),(3,7,1);
/*!40000 ALTER TABLE `perfiles_has_modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `persona`
--

LOCK TABLES `persona` WRITE;
/*!40000 ALTER TABLE `persona` DISABLE KEYS */;
INSERT INTO `persona` VALUES (1,'Juan Manuel','Salinas',1),(2,'Mauricio','Salinas',0),(3,'Nicolas','Mastori',0),(4,'Nelida','Ruiz Diaz',0),(5,'Alan','Beck',0),(6,'Juan Manuel','Salinas',0),(7,'Juan Manuel','Salinas',0),(8,'Juan Manuel','Salinas',0),(9,'Nelida','Ruiz Diaz',0),(10,'Nelida','Ruiz Diaz',0),(11,'Mauricio Fabian','Salinas',0),(12,'Mauricio Fabian','Salinas',0),(13,'Mauricio Fabian','Salinas',0),(14,'Juan Manuel','Salinas',1),(15,'Nelida','Ruiz Diaz',1),(16,'Martin','Palermo',1),(17,'Martin','Palermo',1),(18,'Juan Roman','Riquelme',1),(19,'Nicolas','Mastori',1),(20,'Mauricio Fabian','Salinas',1),(21,'Martin','Palermo',1),(22,'Juan Manuel','Salinas',0),(23,'Juan Manuel','Salinas',0),(24,'Juan Manuel','Salinas',0),(25,'Juan Manuel','Salinas',0),(26,'José ','de San Martín',0),(27,'Coca Cola ','Coca Cola',1),(28,'Alfa','null',1),(29,'Cliente','Default',1),(30,'Cliente','Default',1),(31,'Juan Manuel','Salinas',1),(32,'Coca Cola','SRL',1),(33,'Nicolas','Mastori',0),(34,'45','Salinas',0),(35,'Pablo','Ramirez',1),(36,'Lisandro','Martinez',1),(37,'Lisandro','Martinez',1),(38,'Juan Manuel','Salinas',1),(39,'Juan Manuel','Salinas',1),(40,'Juan Manuel','Salinas',1),(41,'Juan Manuel','Salinas',1),(42,'Juan Manuel','Salinas',1),(43,'Juan Manuel','Salinas',1),(44,'Juan Manuel','Salinas',1),(45,'Juan Manuel','Salinas',1),(46,'Juan Manuel','Salinas',1),(47,'Nelida','Ruiz Diaz',1),(48,'Nelida','Ruiz Diaz',1),(49,'Nelida','Ruiz Diaz',1),(50,'Nelida','Ruiz Diaz',1),(51,'Nelida','Ruiz Diaz',1),(52,'Nelida','Ruiz Diaz',1),(53,'Nelida','Ruiz Diaz',1),(54,'Nelida','Ruiz Diaz',1),(55,'Nelida','Ruiz Diaz',1),(56,'Nelida','Ruiz Diaz',1),(57,'Nelida','Ruiz Diaz',1),(58,'Nelida','Ruiz Diaz',1),(59,'Nelida','Ruiz Diaz',1),(60,'Nelida','Ruiz Diaz',1),(61,'Nicolas','Mastori',1),(62,'Nicolas','Mastori',1),(63,'Nicolas','Mastori',1),(64,'Nicolas','Mastori',1),(65,'Nicolas','Mastori',1),(66,'Nicolas','Mastori',1),(67,'Nicolas','Mastori',1),(68,'Nicolas','Mastori',1),(69,'Nicolas','Mastori',1),(70,'Nicolas','Mastori',1),(71,'Nicolas','Mastori',1),(72,'Nicolas','Mastori',1),(73,'Nicolas','Mastori',1),(74,'Nicolas','Mastori',1),(75,'Alfredo','Villafañe',1),(76,'Lautaro','Martinez',1),(77,'Nelida','Ruiz Diaz',1),(78,'Nelida','Ruiz Diaz',1),(79,'Nelida','Ruiz Diaz',1),(80,'Nelida','Ruiz Diaz',1),(81,'Nelida','Ruiz Diaz',1),(82,'Nelida','Ruiz Diaz',1),(83,'Nelida','Ruiz Diaz',1),(84,'Nelida','Ruiz Diaz',1),(85,'Nelida','Ruiz Diaz',1),(86,'Nelida','Ruiz Diaz',1),(87,'Lautaro','Martinez',1),(88,'Fernando','Gago',1),(89,'Fernando','Gago',1),(90,'Fernando','Gago',1),(91,'Fernando','Gago',1),(92,'Mauricio','Salinas',1);
/*!40000 ALTER TABLE `persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `producto`
--

LOCK TABLES `producto` WRITE;
/*!40000 ALTER TABLE `producto` DISABLE KEYS */;
INSERT INTO `producto` VALUES (1,'Coca Cola 1.5L','1000000000000',15,16,1500.00,2441.87,1,1,2,50.00),(2,'Galletas Oreo','1234567890123',50,40,600.00,900.00,1,9,4,50.00),(3,'Papas Fritas Lays','3456789012345',30,5,1200.00,1550.00,0,2,5,50.00),(4,'Coca Cola 500ml','7791234567890',100,10,60.00,90.00,1,1,1,50.00),(5,'Lays Clásicas','7791234567891',200,20,30.00,50.00,1,2,5,50.00),(6,'Pepsi 1.5L','7791234567892',150,15,72.00,108.00,1,3,1,50.00),(7,'Marlboro Box 20','7791234567893',50,5,200.00,300.00,1,4,6,50.00),(8,'Poett Lavanda 500ml','7791234567894',80,10,35.00,55.00,1,5,2,50.00),(9,'Nestle Chocolate 100g','7791234567895',120,12,25.00,40.00,1,6,4,50.00),(10,'Rexona Men 150ml','7791234567896',90,9,50.00,75.00,1,7,3,50.00),(11,'Arcor Caramelos 500g','7791234567897',130,13,40.00,60.00,1,8,4,50.00),(12,'Oreo 100g','7791234567898',140,14,20.00,35.00,1,9,4,50.00),(13,'La Serenísima Leche 1L','7791234567899',200,20,70.00,100.00,1,14,6,50.00),(14,'Oreo','6565656565656',300,30,1300.00,1900.00,1,9,4,50.00),(15,'Sprite Grande','6565656565657',300,30,1560.00,2340.00,1,1,1,50.00),(16,'Sprite','6565656565658',300,30,1560.00,2340.00,1,1,1,50.00),(17,'Harina 000','1000000000000',155,15,1000.00,1200.00,0,16,9,50.00),(18,'Harina 000','1000000000000',155,15,1000.00,1200.00,0,16,9,50.00),(19,'Harina 000','1000000000000',155,15,1000.00,1200.00,0,16,9,50.00),(20,'Jabon','5656565656569',15,15,2000.00,2500.00,1,5,2,25.00);
/*!40000 ALTER TABLE `producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `producto_has_combos`
--

LOCK TABLES `producto_has_combos` WRITE;
/*!40000 ALTER TABLE `producto_has_combos` DISABLE KEYS */;
/*!40000 ALTER TABLE `producto_has_combos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `proveedor`
--

LOCK TABLES `proveedor` WRITE;
/*!40000 ALTER TABLE `proveedor` DISABLE KEYS */;
INSERT INTO `proveedor` VALUES (1,'Coca Cola Srl','2024-06-17',1,27),(2,'Alfa Srl','2024-06-17',1,28),(3,'Coca Cola SRL','2024-09-19',1,32);
/*!40000 ALTER TABLE `proveedor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `rubro`
--

LOCK TABLES `rubro` WRITE;
/*!40000 ALTER TABLE `rubro` DISABLE KEYS */;
INSERT INTO `rubro` VALUES (1,'Gaseosas',1),(2,'Limpieza',1),(3,'Higiene',1),(4,'Galletas',1),(5,'Snacks',1),(6,'Lácteos',1),(7,'Otros',1),(8,'Rubro prueba',1),(9,'Alimento',1),(10,'Harina',1),(11,'Golosinas',1);
/*!40000 ALTER TABLE `rubro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipocontacto`
--

LOCK TABLES `tipocontacto` WRITE;
/*!40000 ALTER TABLE `tipocontacto` DISABLE KEYS */;
INSERT INTO `tipocontacto` VALUES (1,'Telefono',1),(2,'',0),(3,'Email',1),(4,'Celular',1),(5,'Instagram',0);
/*!40000 ALTER TABLE `tipocontacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipodescuento`
--

LOCK TABLES `tipodescuento` WRITE;
/*!40000 ALTER TABLE `tipodescuento` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipodescuento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `tipodocumentos`
--

LOCK TABLES `tipodocumentos` WRITE;
/*!40000 ALTER TABLE `tipodocumentos` DISABLE KEYS */;
INSERT INTO `tipodocumentos` VALUES (1,'DNI',1),(2,'Extranjero',1),(3,'Libreta Civica',1),(4,'CUIT',1),(5,'CUIL',1),(6,'L.E.',1);
/*!40000 ALTER TABLE `tipodocumentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'manusalinas','$2y$10$wyjpJuUCyJG3GXXhoTeSNuBtnSOlfZ6yukgsx7Nyx8iqj5lesZ3KO','2022-05-06',1,1,1),(2,'manusalina5','$2y$10$dRZ6MTbqyG.H3d.5l/YSBerGsEdE3vWQWirG798zkysirajnyRf2C','2024-06-17',1,1,1),(3,'manusalinasfsa','$2y$10$e0uhK/I8roQLnZPdpgKCyOs2UFGzs7E3o4tpesQqeEpRJwMkfWs7G','2024-06-17',0,2,1),(4,'root','$2y$10$wyjpJuUCyJG3GXXhoTeSNuBtnSOlfZ6yukgsx7Nyx8iqj5lesZ3KO','2024-06-18',1,3,2),(5,'prueba','$2y$10$XNZ4uihNidEqmJDFUuqjF.Hfz2PPJhmtWUivsLRqSqKcdyjO7ju1G','2024-06-18',1,9,2),(6,'nicolasmastori','$2y$10$p8S28sYsjCOFKPbQJRjIZOnIwsr69CueIvlKL8iLnabwPojJJXqEq','2024-06-22',1,4,1),(7,'martinpalermo','$2y$10$rbw7aFi08qI//sCQQbcIhuRUA5uXZ/ZMOLeYmLxpp0slTRtcSM.ee','2024-06-22',1,6,1),(8,'admin','$2y$10$x.X8p4tDsY7jUteOZhyTfOHGtvS3guPnKqaaetCkK7Pnj1H91bBdy','2024-09-07',1,5,1),(9,'mastogerente','$2y$10$RbuU/0JQOoJ900Sp1Ymknek/dKJ14gqF90a6PNgDMfonZcGdkQNVa','2024-09-20',1,12,3);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
INSERT INTO `venta` VALUES (2,'2024-10-07','22:09:26',6900.00,1,1,1,59,0),(3,'2024-10-08','16:05:45',23900.00,1,1,1,59,0),(4,'2024-10-08','17:38:58',23000.00,1,1,1,28,0),(5,'2024-10-08','18:14:50',5400.00,1,1,1,59,0),(6,'2024-10-18','18:19:21',2621.87,1,1,1,59,5),(7,'2024-10-18','18:53:27',7325.61,1,1,1,28,5),(8,'2024-10-18','18:54:54',360.00,1,1,1,28,5);
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

-- Dump completed on 2024-10-25 18:14:59
