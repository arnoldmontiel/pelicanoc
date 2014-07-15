-- database script version 1.8

USE `pelicanoc`;

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE setting set version="1.8" where Id=1;

COMMIT;


-- database script version 1.9
--

SET AUTOCOMMIT=0;
START TRANSACTION;

ALTER TABLE `pelicanoc`.`nzb` 
ADD COLUMN `size` BIGINT(20) NULL DEFAULT NULL AFTER `has_error`;
UPDATE `pelicanoc`.`setting` set version="1.9" where Id=1;

COMMIT;

-- End script

