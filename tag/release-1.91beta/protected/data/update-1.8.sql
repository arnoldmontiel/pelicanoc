-- database script version 1.8

USE `pelicanoc`;

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE setting set version="1.8" where Id=1;

COMMIT;
-- End script

