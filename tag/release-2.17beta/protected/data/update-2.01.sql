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

-- database script version 1.96
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.96" where Id=1;

COMMIT;

-- database script version 1.97
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.97" where Id=1;

COMMIT;


-- database script version 1.98
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="1.98" where Id=1;

COMMIT;

-- database script version 2
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `pelicanoc`.`marketplace`;
USE `pelicanoc`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `pelicano`@`localhost` 
    SQL SECURITY DEFINER
VIEW `pelicanoc`.`marketplace` AS
 select 
        `nzb`.`Id` AS `Id`,
        `nzb`.`Id_my_movie_disc_nzb` AS `Id_my_movie_disc_nzb`,
        1 AS `source_type`,
        `nzb`.`date` AS `date`,
		`mn`.`original_title` AS `title`,
        `nzb`.`Id_TMDB_data` AS `Id_TMDB_data`,
		`mn`.`production_year` AS `year`,
		`mn`.`genre` AS `genre`,
        if(`nzb`.`ready_to_play` = 1,1,0) AS `downloaded`,
        if(`nzb`.`ready_to_play` = 0  and `nzb`.`downloaded` = 1 or `nzb`.`downloading` = 1,1,0) AS `downloading`
    from
        (
			(
				`nzb`
				join `my_movie_disc_nzb` `mdn` ON ((`mdn`.`Id` = `nzb`.`Id_my_movie_disc_nzb`))
			)
			join `my_movie_nzb` `mn` ON ((`mn`.`Id` = `mdn`.`Id_my_movie_nzb`))			
		)
    where
        ((`nzb`.`ready` = 1)
		and (`nzb`.`Id_nzb` is null)
		and (`nzb`.`deleted` = 0)) ;

UPDATE `pelicanoc`.`setting` set version="2" where Id=1;

COMMIT;



-- database script version 2.01
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="2.01" where Id=1;

COMMIT;

-- End script
