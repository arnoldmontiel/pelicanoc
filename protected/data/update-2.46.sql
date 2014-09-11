-- database script version 1.8
-------------------------------

USE `pelicanoc`;

-- database script version 1.9
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

ALTER TABLE `pelicanoc`.`nzb` 
ADD COLUMN `size` BIGINT(20) NULL DEFAULT NULL AFTER `has_error`;

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

COMMIT;

-- database script version 2.07
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

ALTER TABLE `pelicanoc`.`setting` 
ADD COLUMN `disc_min_size_warning` INT(11) NULL DEFAULT NULL COMMENT 'prcentaje aviso disco lleno' AFTER `version`;

COMMIT;

-- database script version 2.13
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

CREATE TABLE IF NOT EXISTS `pelicanoc`.`theme` (
  `Id` INT(11) NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NULL DEFAULT NULL,
  `file_name` VARCHAR(45) NULL DEFAULT NULL,
  `hide` TINYINT(4) NULL DEFAULT 0,
  PRIMARY KEY (`Id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1
COLLATE = latin1_swedish_ci;

  ALTER TABLE `pelicanoc`.`user` 
ADD COLUMN `Id_theme` INT(11) NOT NULL;

ALTER TABLE `pelicanoc`.`user` 
ADD CONSTRAINT `fk_user_theme1`
  FOREIGN KEY (`Id_theme`)
  REFERENCES `pelicanoc`.`theme` (`Id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;

INSERT INTO `pelicanoc`.`theme` VALUES (1,'Light','light-theme.css',0),(2,'Dark','dark-theme.css',0);

update pelicanoc.user set Id_theme = 1 where Id_theme = 0;
  
COMMIT;

-- database script version 2.19
-------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;

ALTER TABLE `pelicanoc`.`nzb` 
ADD COLUMN `already_downloaded` TINYINT(4) NULL DEFAULT 0 AFTER `deleted`;

COMMIT;

-- database script version 2.2
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
        if(`nzb`.`ready_to_play` = 0  and `nzb`.`downloaded` = 1 or `nzb`.`downloading` = 1,1,0) AS `downloading`,
		`nzb`.`already_downloaded` AS `already_downloaded`
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

COMMIT;

-- database script version 2.21
-------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;

INSERT INTO `pelicanoc`.`items`
(`name`,`type`,`description`,`bizrule`,`data`)
VALUES
('SiteConsumption',0,'','','s:0:"";');

INSERT INTO `pelicanoc`.`itemchildren`
(`parent`,`child`)
VALUES
('SiteManage','SiteConsumption');

COMMIT;


-- database script version 2.28
-------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;

LOCK TABLES `nzb_state` WRITE;
INSERT INTO `nzb_state` VALUES (7,'Downloaded not informed');
UNLOCK TABLES;

COMMIT;

-- database script version 2.39
-------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

DROP TABLE IF EXISTS `pelicanoc`.`movies`;
USE `pelicanoc`;
CREATE 
     OR REPLACE ALGORITHM = UNDEFINED 
    DEFINER = `pelicano`@`localhost` 
    SQL SECURITY DEFINER
VIEW `pelicanoc`.`movies` AS
 select 
        `nzb`.`Id` AS `Id`,
        `nzb`.`Id_my_movie_disc_nzb` AS `Id_my_movie_disc_nzb`,
        NULL AS `Id_my_movie_disc`,
        1 AS `source_type`,
        `nzb`.`change_state_date` AS `date`,
		`mn`.`original_title` AS `title`,
        `nzb`.`Id_TMDB_data` AS `Id_TMDB_data`,
		`mn`.`production_year` AS `year`,
		`mn`.`genre` AS `genre`,
		not exists (select 1 from `current_play` `cp` where `cp`.`Id_nzb` = `nzb`.`Id`) AS `is_new`
    from
        ((`nzb`
        join `my_movie_disc_nzb` `mdn` ON ((`mdn`.`Id` = `nzb`.`Id_my_movie_disc_nzb`)))
        join `my_movie_nzb` `mn` ON ((`mn`.`Id` = `mdn`.`Id_my_movie_nzb`)))
    where
        ((`nzb`.`downloaded` = 1)
            and (`nzb`.`ready_to_play` = 1)
            and (`nzb`.`Id_nzb` is null)
            and (`mn`.`Id_my_movie_serie_header` is null)) 
    union select 
        `ripped_movie`.`Id` AS `Id`,
        NULL AS `Id_my_movie_disc_nzb`,
        `ripped_movie`.`Id_my_movie_disc` AS `Id_my_movie_disc`,
        2 AS `source_type`,
        `ripped_movie`.`creation_date` AS `date`,
		`m`.`original_title` AS `title`,
        `ripped_movie`.`Id_TMDB_data` AS `Id_TMDB_data`,
		`m`.`production_year` AS `year`,
		`m`.`genre` AS `genre`,
		not exists (select 1 from `current_play` `cp` where `cp`.`Id_ripped_movie` = `ripped_movie`.`Id`) AS `is_new`
    from
        ((`ripped_movie`
        join `my_movie_disc` `md` ON ((`md`.`Id` = `ripped_movie`.`Id_my_movie_disc`)))
        join `my_movie` `m` ON ((`m`.`Id` = `md`.`Id_my_movie`)))
    where
        (`m`.`Id_my_movie_serie_header` is null)
	union select 
        `local_folder`.`Id` AS `Id`,
        NULL AS `Id_my_movie_disc_nzb`,
        `local_folder`.`Id_my_movie_disc` AS `Id_my_movie_disc`,
        3 AS `source_type`,
        `local_folder`.`read_date` AS `date`,
		`m`.`original_title` AS `title`,
        `local_folder`.`Id_TMDB_data` AS `Id_TMDB_data`,
		`m`.`production_year` AS `year`,
		`m`.`genre` AS `genre`,
		not exists (select 1 from `current_play` `cp` where `cp`.`Id_local_folder` = `local_folder`.`Id`) AS `is_new`
    from
        ((`local_folder`
        join `my_movie_disc` `md` ON ((`md`.`Id` = `local_folder`.`Id_my_movie_disc`)))
        join `my_movie` `m` ON ((`m`.`Id` = `md`.`Id_my_movie`)))
    where
        isnull(`m`.`Id_my_movie_serie_header`)
		and `local_folder`.hide = 0
		and `local_folder`.ready = 1
;

COMMIT;

----------------------------------------------------------------------------
-- database script esto se ejecuta siempre con el update de la version
----------------------------------------------------------------------------

SET AUTOCOMMIT=0;
START TRANSACTION;

UPDATE `pelicanoc`.`setting` set version="2.46" where Id=1;

COMMIT;

-- End script
