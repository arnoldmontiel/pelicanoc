-- database script version 1.8
-------------------------------

USE `pelicanoc`;

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE setting set version="1.8" where Id=1;

COMMIT;


-- database script version 1.9
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

ALTER TABLE `pelicanoc`.`nzb` 
ADD COLUMN `size` BIGINT(20) NULL DEFAULT NULL AFTER `has_error`;
UPDATE `pelicanoc`.`setting` set version="1.9" where Id=1;

COMMIT;


-- database script version 1.91
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.91" where Id=1;

COMMIT;

-- database script version 1.92
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.92" where Id=1;

COMMIT;

-- database script version 1.93
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.93" where Id=1;

COMMIT;

-- database script version 1.94
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.94" where Id=1;

COMMIT;

-- database script version 1.95
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.95" where Id=1;

COMMIT;

-- End script
