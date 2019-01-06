-- PROCEDURE TO CREATE USERS --
USE `dbphp7`;
DROP procedure IF EXISTS `sp_usuarios_insert`;

DELIMITER $$
USE `dbphp7`$$
CREATE PROCEDURE `sp_usuarios_insert` (plogin VARCHAR(64),psenha VARCHAR(256))
BEGIN
	INSERT INTO tb_usuarios (login,senha) VALUES (plogin,psenha);
    SELECT * FROM tb_usuarios WHERE id = LAST_INSERTED_ID();
END$$

DELIMITER ;

-- DETERMINE TABLE AND DB CHARSETS
SELECT default_character_set_name FROM information_schema.SCHEMATA S WHERE schema_name = "dbphp7";
SELECT CCSA.character_set_name FROM information_schema.`TABLES` T,information_schema.`COLLATION_CHARACTER_SET_APPLICABILITY` CCSA WHERE CCSA.collation_name = T.table_collation AND T.table_schema = "dbphp7" AND T.table_name = "tb_usuarios";

-- CREATE TABLE
CREATE TABLE `dbphp7`.`tb_usuarios` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(256) NOT NULL,
  `reg_data`TIMESTAMP NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC));
  
-- USE `dbphp7`;
-- DROP procedure IF EXISTS `sp_usuarios_insert`;

-- DELIMITER $$
-- USE `dbphp7`$$
-- CREATE DEFINER=`gus`@`localhost` PROCEDURE `sp_usuarios_insert`(plogin VARCHAR(50),psenha VARCHAR(256))
-- BEGIN
-- 	SELECT @exists := login FROM tb_usuarios WHERE `login` = `plogin`;
--     IF(@exists IS NULL) THEN
-- 		INSERT INTO tb_usuarios (login,senha) VALUES (plogin,psenha);
-- 	END IF;
--     SELECT * FROM tb_usuarios WHERE id = last_insert_id();
-- END$$

-- DELIMITER ;

