-- database script version 1.7

USE `pelicanoc`;

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE setting set version="1.7" where Id=1;

COMMIT;
-- End script

