-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Marca`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Marca` (
  `idMarca` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idMarca`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Rubro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Rubro` (
  `idRubros` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idRubros`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Producto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Producto` (
  `idProductos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `codBarras` VARCHAR(100) NOT NULL,
  `cantidad` INT NOT NULL,
  `cantidadMin` INT NOT NULL,
  `precioCosto` DECIMAL(10,2) NOT NULL,
  `precioVenta` DECIMAL(10,2) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `Marca_idMarca` INT NOT NULL,
  `Rubro_idRubros` INT NOT NULL,
  PRIMARY KEY (`idProductos`),
  INDEX `fk_Producto_Marca_idx` (`Marca_idMarca` ASC) VISIBLE,
  INDEX `fk_Producto_Rubro1_idx` (`Rubro_idRubros` ASC) VISIBLE,
  CONSTRAINT `fk_Producto_Marca`
    FOREIGN KEY (`Marca_idMarca`)
    REFERENCES `mydb`.`Marca` (`idMarca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Producto_Rubro1`
    FOREIGN KEY (`Rubro_idRubros`)
    REFERENCES `mydb`.`Rubro` (`idRubros`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`metodoPago`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`metodoPago` (
  `idmetodoPago` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(255) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idmetodoPago`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Persona`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Persona` (
  `idPersona` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `apellido` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idPersona`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Empleado`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Empleado` (
  `idEmpleado` INT NOT NULL AUTO_INCREMENT,
  `fechaAlta` DATETIME NOT NULL,
  `legajo` VARCHAR(100) NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `Persona_idPersona` INT NOT NULL,
  PRIMARY KEY (`idEmpleado`),
  INDEX `fk_Empleado_Persona1_idx` (`Persona_idPersona` ASC) VISIBLE,
  CONSTRAINT `fk_Empleado_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Venta` (
  `idVenta` INT NOT NULL AUTO_INCREMENT,
  `fechaVenta` DATE NOT NULL,
  `horaVenta` TIME NOT NULL,
  `totalVenta` DECIMAL(10,2) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `metodoPago_idmetodoPago` INT NOT NULL,
  `Empleado_idEmpleado` INT NOT NULL,
  PRIMARY KEY (`idVenta`),
  INDEX `fk_Venta_metodoPago1_idx` (`metodoPago_idmetodoPago` ASC) VISIBLE,
  INDEX `fk_Venta_Empleado1_idx` (`Empleado_idEmpleado` ASC) VISIBLE,
  CONSTRAINT `fk_Venta_metodoPago1`
    FOREIGN KEY (`metodoPago_idmetodoPago`)
    REFERENCES `mydb`.`metodoPago` (`idmetodoPago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Venta_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `mydb`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Detalle_Venta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Detalle_Venta` (
  `idDetalle_Venta` INT NOT NULL AUTO_INCREMENT,
  `precioActual` DECIMAL(10,2) NOT NULL,
  `cantidad` INT NOT NULL,
  `Venta_idVenta` INT NOT NULL,
  `Producto_idProductos` INT NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idDetalle_Venta`),
  INDEX `fk_Detalle_Venta_Venta1_idx` (`Venta_idVenta` ASC) VISIBLE,
  INDEX `fk_Detalle_Venta_Producto1_idx` (`Producto_idProductos` ASC) VISIBLE,
  CONSTRAINT `fk_Detalle_Venta_Venta1`
    FOREIGN KEY (`Venta_idVenta`)
    REFERENCES `mydb`.`Venta` (`idVenta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Detalle_Venta_Producto1`
    FOREIGN KEY (`Producto_idProductos`)
    REFERENCES `mydb`.`Producto` (`idProductos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Compra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Compra` (
  `idCompra` INT NOT NULL AUTO_INCREMENT,
  `fechaCompra` DATE NOT NULL,
  `horaCompra` TIME NOT NULL,
  `totalCompra` DECIMAL(10,2) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `metodoPago_idmetodoPago` INT NOT NULL,
  PRIMARY KEY (`idCompra`),
  INDEX `fk_Compra_metodoPago1_idx` (`metodoPago_idmetodoPago` ASC) VISIBLE,
  CONSTRAINT `fk_Compra_metodoPago1`
    FOREIGN KEY (`metodoPago_idmetodoPago`)
    REFERENCES `mydb`.`metodoPago` (`idmetodoPago`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`detalleCompra`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`detalleCompra` (
  `iddetalleCompra` INT NOT NULL AUTO_INCREMENT,
  `precioActual` DECIMAL(10,2) NOT NULL,
  `cantidad` INT NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `Producto_idProductos` INT NOT NULL,
  `Compra_idCompra` INT NOT NULL,
  PRIMARY KEY (`iddetalleCompra`),
  INDEX `fk_detalleCompra_Producto1_idx` (`Producto_idProductos` ASC) VISIBLE,
  INDEX `fk_detalleCompra_Compra1_idx` (`Compra_idCompra` ASC) VISIBLE,
  CONSTRAINT `fk_detalleCompra_Producto1`
    FOREIGN KEY (`Producto_idProductos`)
    REFERENCES `mydb`.`Producto` (`idProductos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_detalleCompra_Compra1`
    FOREIGN KEY (`Compra_idCompra`)
    REFERENCES `mydb`.`Compra` (`idCompra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permisos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`permisos` (
  `idpermisos` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idpermisos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`perfiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`perfiles` (
  `idperfiles` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idperfiles`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`permisosPerfiles`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`permisosPerfiles` (
  `idpermisosPerfiles` INT NOT NULL AUTO_INCREMENT,
  `permitido` VARCHAR(100) NOT NULL,
  `permisos_idpermisos` INT NOT NULL,
  `perfiles_idperfiles` INT NOT NULL,
  PRIMARY KEY (`idpermisosPerfiles`),
  INDEX `fk_permisosPerfiles_permisos1_idx` (`permisos_idpermisos` ASC) VISIBLE,
  INDEX `fk_permisosPerfiles_perfiles1_idx` (`perfiles_idperfiles` ASC) VISIBLE,
  CONSTRAINT `fk_permisosPerfiles_permisos1`
    FOREIGN KEY (`permisos_idpermisos`)
    REFERENCES `mydb`.`permisos` (`idpermisos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_permisosPerfiles_perfiles1`
    FOREIGN KEY (`perfiles_idperfiles`)
    REFERENCES `mydb`.`perfiles` (`idperfiles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tipoDocumentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipoDocumentos` (
  `idtipoDocumentos` INT NOT NULL AUTO_INCREMENT,
  `valor` VARCHAR(100) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtipoDocumentos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`tipoContacto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipoContacto` (
  `idtipoContacto` INT NOT NULL AUTO_INCREMENT,
  `valor` VARCHAR(80) NOT NULL,
  `estado` TINYINT(1) NULL DEFAULT 1,
  PRIMARY KEY (`idtipoContacto`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`contacto`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`contacto` (
  `idcontacto` INT NOT NULL AUTO_INCREMENT,
  `valor` VARCHAR(150) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `tipoContacto_idtipoContacto` INT NOT NULL,
  `Persona_idPersona` INT NOT NULL,
  PRIMARY KEY (`idcontacto`),
  INDEX `fk_contacto_tipoContacto1_idx` (`tipoContacto_idtipoContacto` ASC) VISIBLE,
  INDEX `fk_contacto_Persona1_idx` (`Persona_idPersona` ASC) VISIBLE,
  CONSTRAINT `fk_contacto_tipoContacto1`
    FOREIGN KEY (`tipoContacto_idtipoContacto`)
    REFERENCES `mydb`.`tipoContacto` (`idtipoContacto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_contacto_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Documento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Documento` (
  `idDocumento` INT NOT NULL AUTO_INCREMENT,
  `valor` VARCHAR(100) NOT NULL,
  `tipoDocumentos_idtipoDocumentos` INT NOT NULL,
  `Persona_idPersona` INT NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idDocumento`),
  INDEX `fk_Documento_tipoDocumentos1_idx` (`tipoDocumentos_idtipoDocumentos` ASC) VISIBLE,
  INDEX `fk_Documento_Persona1_idx` (`Persona_idPersona` ASC) VISIBLE,
  CONSTRAINT `fk_Documento_tipoDocumentos1`
    FOREIGN KEY (`tipoDocumentos_idtipoDocumentos`)
    REFERENCES `mydb`.`tipoDocumentos` (`idtipoDocumentos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Documento_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Proveedor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Proveedor` (
  `idProveedor` INT NOT NULL AUTO_INCREMENT,
  `razonSocial` VARCHAR(100) NOT NULL,
  `fechaAlta` DATE NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `Persona_idPersona` INT NOT NULL,
  PRIMARY KEY (`idProveedor`),
  INDEX `fk_Proveedor_Persona1_idx` (`Persona_idPersona` ASC) VISIBLE,
  CONSTRAINT `fk_Proveedor_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  `fechaAlta` DATE NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `Empleado_idEmpleado` INT NOT NULL,
  `perfiles_idperfiles` INT NOT NULL,
  PRIMARY KEY (`idUsuario`),
  INDEX `fk_Usuario_Empleado1_idx` (`Empleado_idEmpleado` ASC) VISIBLE,
  INDEX `fk_Usuario_perfiles1_idx` (`perfiles_idperfiles` ASC) VISIBLE,
  CONSTRAINT `fk_Usuario_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `mydb`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_perfiles1`
    FOREIGN KEY (`perfiles_idperfiles`)
    REFERENCES `mydb`.`perfiles` (`idperfiles`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`detalleUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`detalleUsuario` (
  `iddetalleUsuario` INT NOT NULL AUTO_INCREMENT,
  `fechaHoraIngreso` DATETIME NOT NULL,
  `fechaHoraEgreso` DATETIME NOT NULL,
  `Usuario_idUsuario` INT NOT NULL,
  PRIMARY KEY (`iddetalleUsuario`),
  INDEX `fk_detalleUsuario_Usuario1_idx` (`Usuario_idUsuario` ASC) VISIBLE,
  CONSTRAINT `fk_detalleUsuario_Usuario1`
    FOREIGN KEY (`Usuario_idUsuario`)
    REFERENCES `mydb`.`Usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Direccion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Direccion` (
  `idDireccion` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(255) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `Persona_idPersona` INT NOT NULL,
  PRIMARY KEY (`idDireccion`),
  INDEX `fk_Direccion_Persona1_idx` (`Persona_idPersona` ASC) VISIBLE,
  CONSTRAINT `fk_Direccion_Persona1`
    FOREIGN KEY (`Persona_idPersona`)
    REFERENCES `mydb`.`Persona` (`idPersona`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '			';


-- -----------------------------------------------------
-- Table `mydb`.`tipoEgresos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`tipoEgresos` (
  `idtipoEgresos` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(200) NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`idtipoEgresos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Egreso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Egreso` (
  `idEgresos` INT NOT NULL AUTO_INCREMENT,
  `monto` DECIMAL(10,2) NOT NULL,
  `fecha` DATE NOT NULL,
  `hora` TIME NOT NULL,
  `estado` TINYINT(1) NOT NULL DEFAULT 1,
  `Empleado_idEmpleado` INT NOT NULL,
  `tipoGastos_idtipoGastos` INT NOT NULL,
  PRIMARY KEY (`idEgresos`),
  INDEX `fk_Gastos_Empleado1_idx` (`Empleado_idEmpleado` ASC) VISIBLE,
  INDEX `fk_Gastos_tipoGastos1_idx` (`tipoGastos_idtipoGastos` ASC) VISIBLE,
  CONSTRAINT `fk_Gastos_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `mydb`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Gastos_tipoGastos1`
    FOREIGN KEY (`tipoGastos_idtipoGastos`)
    REFERENCES `mydb`.`tipoEgresos` (`idtipoEgresos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Caja`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Caja` (
  `idCajas` INT NOT NULL AUTO_INCREMENT,
  `fechaApertura` DATETIME NULL,
  `fechaCierre` DATETIME NULL,
  `Empleado_idEmpleado` INT NOT NULL,
  INDEX `fk_Cajas_Empleado1_idx` (`Empleado_idEmpleado` ASC) VISIBLE,
  PRIMARY KEY (`idCajas`),
  CONSTRAINT `fk_Cajas_Empleado1`
    FOREIGN KEY (`Empleado_idEmpleado`)
    REFERENCES `mydb`.`Empleado` (`idEmpleado`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
