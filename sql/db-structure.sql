 -- Datenbank iscream löschen, wenn sie existiert
DROP DATABASE IF EXISTS `iscream`;

 -- erstellen
CREATE DATABASE iscream
CHARACTER SET `utf8`;
USE iscream;

 -- erste Tabelle "user" anlegen
CREATE TABLE `user` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `mail_address` varchar(50) NOT NULL,
  `age` int NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isSubscribed` tinyint(1) NOT NULL DEFAULT 0,
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,

   PRIMARY KEY(`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


 -- Testdaten für Tabelle "user"
 INSERT INTO `user` (username, password, mail_address, age, signUpDate, isSubscribed, isAdmin)
 VALUES
 ('Test1', '$2y$10$h2Iup2QJD2SmmapWEdh5YuBP1vk2B6aX5VTBlZ3Y2cjCF81Fy.lAG', 'eins@gmail.com', 19, '2021-09-15 05:30:20', 1, 0),
 ('Test2', '$2y$10$f39dbnWGLiy5NKqQ98OCQ.MiMTNsxr/1AJ5puDiVKK1lLVvTOS4y.', 'zwei@gmail.com', 30, '2020-03-11 07:50:22', 1, 1);



 -- zweite Tabelle "entity" anlegen
CREATE TABLE `entity` (
  `entity_id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `is_movie` tinyint(1) NOT NULL DEFAULT 0,


   PRIMARY KEY(`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


 -- Testdaten für Tabelle "entity"
 INSERT INTO `entity` (title, description, picture, is_movie)
 VALUES
 ('Halloween', 'A creepy movie about Halloween.', 'https://www.tasteofcinema.com/wp-content/uploads/2015/10/maxresdefault.jpg', 1),
 ('Under the Dome', 'A series about people living under a dome.', '/img/mypic2.jpg', 0),
 ('Freddy vs Jason', 'A crossover between the movies Nightmare on Elm Street and Friday the 13th', 'https://i.ytimg.com/vi/GqyN4OvWyEE/maxresdefault.jpg', 1);


  -- Dritte Tabelle "Movies" anlegen
 CREATE TABLE `movies` (
   `id` int(10) NOT NULL AUTO_INCREMENT,
   `entity_id` int(10) NOT NULL,
   `release_year` int(4) NOT NULL,
   `video_reference` varchar(100) NOT NULL,

    PRIMARY KEY(`id`),
    KEY `movfr1` (`entity_id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


  -- Testdaten für Tabelle "Movies"
  INSERT INTO `movies` (`entity_id`, release_year, video_reference)
  VALUES
  (1, 2012, "/videos/mymovie.mp4"),
  (3, 2003, "/vid/newvod1.mp4");

    -- Vierte Tabelle "Series" anlegen
   CREATE TABLE `series` (
     `id` int(10) NOT NULL AUTO_INCREMENT,
     `entity_id` int(10) NOT NULL,
     `start_year` int(4) NOT NULL,
     `season` int(2) NOT NULL,
     `episode` int(2) NOT NULL,
     `video_reference` varchar(100) NOT NULL,

      PRIMARY KEY(`id`),
      KEY `serfr1` (`entity_id`)

   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


    -- Testdaten für Tabelle "Series"
    INSERT INTO `series` (entity_id, start_year, season, episode, video_reference)
    VALUES (2, 2012, 5, 12, "/videos/myseries.mp4");


    -- Fünfte Tabelle "Video Group" anlegen
   CREATE TABLE `video_group` (
     `video_group_id` int(10) NOT NULL,
     `title` varchar(20) NOT NULL,
     `isMovies` tinyint(1) NOT NULL,
      PRIMARY KEY(`video_group_id`)

   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


    -- Testdaten für Tabelle "Video group"
    INSERT INTO `video_group` (`video_group_id`, `title`, `isMovies`)
    VALUES
    (1, "Slasher Horror", 1),
    (2, "Stephen King Series", 0);



    -- Fünfte Tabelle "Video Group Member" anlegen
   CREATE TABLE `video_group_member` (
     `id` int(10) NOT NULL AUTO_INCREMENT,
     `video_group_id` int(10) NOT NULL,
     `entity_id` int(10) NOT NULL,
      PRIMARY KEY(`id`),
      KEY `vidgrmem1` (`video_group_id`),
      KEY `vidgrmem2` (`entity_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

       -- Testdaten für Tabelle "Video group Member"
    INSERT INTO `video_group_member` (`video_group_id`, `entity_id`)
    VALUES
    (1, 1),
    (2, 2),
    (1, 3);

        -- Fünfte Tabelle "Video Group Member" anlegen
   CREATE TABLE `banner_images` (
     `id` int(10) NOT NULL AUTO_INCREMENT,
     `image_path` varchar(100) NOT NULL,
     `entity_id` int(10) NOT NULL,
      PRIMARY KEY(`id`),
      KEY `banner_ent` (`entity_id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

       -- Testdaten für Tabelle "Video group Member"
    INSERT INTO `banner_images` (`image_path`, `entity_id`)
    VALUES
    ("img/Halloween_Movie_Feature.jpg", 1),
    ("img/wp5685960-under-the-dome-wallpapers",2);


      -- Sechste Tabelle "Watchlist" anlegen
    CREATE TABLE `watchlist` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `user_id` int(10) NOT NULL,
        `entity_id` int(10) NOT NULL,
         PRIMARY KEY(`id`),
         KEY `watchl_usr` (`user_id`),
         KEY `watchl_ent` (`entity_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

      -- Testdaten für Tabelle "Watchlist"
    INSERT INTO `watchlist` (`user_id`, `entity_id`)
    VALUES
    (1,1),
    (1,3);


 -- Fremdschlüsselprüfung zu referenzierten Daten hinzufügen

  ALTER TABLE `movies` ADD CONSTRAINT `movfr1` FOREIGN KEY (`entity_id`)  REFERENCES `entity`(`entity_id`);
  ALTER TABLE `series` ADD CONSTRAINT `serfr1` FOREIGN KEY (`entity_id`)  REFERENCES `entity`(`entity_id`);

  ALTER TABLE `video_group_member` ADD CONSTRAINT `vidgrmem1` FOREIGN KEY (`video_group_id`)  REFERENCES  `video_group`(`video_group_id`);
  ALTER TABLE `video_group_member` ADD CONSTRAINT `vidgrmem2` FOREIGN KEY (`entity_id`)  REFERENCES `entity`(`entity_id`);

  ALTER TABLE `banner_images` ADD CONSTRAINT `banner_ent` FOREIGN KEY (`entity_id`) REFERENCES `entity`(`entity_id`);

  ALTER TABLE `watchlist` ADD CONSTRAINT `watchl_usr` FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`);
  ALTER TABLE `watchlist` ADD CONSTRAINT `watchl_ent` FOREIGN KEY (`entity_id`) REFERENCES `entity`(`entity_id`);

 --  User für Zugriff von Web erstellen
CREATE OR REPLACE USER 'usr1'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'usr1'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `iscream`.* TO 'usr1'@'localhost';


COMMIT;

