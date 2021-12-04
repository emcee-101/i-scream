 -- Datenbank iscream löschen, wenn sie existiert
DROP DATABASE IF EXISTS `iscream`;

 -- erstellen
CREATE DATABASE iscream
CHARACTER SET `utf8`;
USE iscream;

 -- erste Tabelle "user" anlegen
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mail_address` varchar(50) NOT NULL,
  `age` int NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isSubscribed` tinyint(1) NOT NULL DEFAULT 0,

   PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


 -- Testdaten für Tabelle "user"
 INSERT INTO `user` (username, password, mail_address, age, signUpDate, isSubscribed)
 VALUES ('Test1', 'testpass1', 'eins@gmail.com', 19, '2021-09-15 05:30:20', 1);


 -- Entsprechenden User für Nutzung mit PDO erstellen
CREATE OR REPLACE USER 'usr1'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'usr1'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `iscream`.* TO 'usr1'@'localhost';

 -- zweite Tabelle "entity" anlegen
CREATE TABLE `entity` (
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `isMovie` tinyint(1) NOT NULL DEFAULT 0,
  `movie_id` int(10) NOT NULL DEFAULT 0,
  `series_id` int(10) NOT NULL DEFAULT 0,

   PRIMARY KEY(`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


 -- Testdaten für Tabelle "entity"
 INSERT INTO `entity` (title, description, picture, isMovie, movie_id, series_id)
 VALUES ('Halloween', 'A creepy movie about Halloween.', '/img/mypic.jpg', 1, 2342,2345);


  -- Dritte Tabelle "Movies" anlegen
 CREATE TABLE `movies` (
   `id` int(10) NOT NULL,
   `release_year` int(4) NOT NULL,
   `video_reference` varchar(100) NOT NULL,

    PRIMARY KEY(`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


  -- Testdaten für Tabelle "Movies"
  INSERT INTO `movies` (id, release_year, video_reference)
  VALUES (123, 2012, "/videos/mymovie.mp4");

    -- Vierte Tabelle "Series" anlegen
   CREATE TABLE `series` (
     `id` int(10) NOT NULL,
     `start_year` int(4) NOT NULL,
     `season` int(2) NOT NULL,
     `episode` int(2) NOT NULL,
     `video_reference` varchar(100) NOT NULL,

      PRIMARY KEY(`id`)
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


    -- Testdaten für Tabelle "Movies"
    INSERT INTO `series` (id, start_year, season, episode, video_reference)
    VALUES (123, 2012, 5, 12, "/videos/myseries.mp4");


COMMIT;

