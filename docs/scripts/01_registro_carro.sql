
CREATE TABLE `nw202301`.`car` (
  `registro_id` INT NOT NULL AUTO_INCREMENT,
  `placa_carro` VARCHAR(10) NOT NULL,
  `modelo_carro` VARCHAR(45) NOT NULL,
  `year_carro` int(4) DEFAULT NULL,
  `bin_carro` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`registro_id`));