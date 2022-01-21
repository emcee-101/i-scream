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
 ('Under the Dome', 'A series about people living under a dome.', 'https://vistapointe.net/images/under-the-dome-wallpaper-5.jpg', 0),
 ('Freddy vs Jason', 'A crossover between the movies Nightmare on Elm Street and Friday the 13th', 'https://i.ytimg.com/vi/GqyN4OvWyEE/maxresdefault.jpg', 1),
 ('Friday the 13th', 'A classic Slasher Film','https://assets.cdn.moviepilot.de/files/b9d196ccab9f50516ba3e3615a0ef867371cb9b7162fc3bea4ef5591c0a9/limit/1024/2000/promo.jpg', 1),
 ('Casper', 'A haunted house horror classic, that portrays a child-ghost.', 'https://images8.alphacoders.com/110/thumb-1920-1108557.jpg', 1),
 ('Garfield', 'A drama about a cat from hell, torturing its owner John', 'https://cdn.mos.cms.futurecdn.net/cNLu3sFaaKtM2wNwf2FRMR-1200-80.jpg', 1),
 ('The Conjuring','A movie about a possessed doll, that tortures a family and the people trying to help this family.','https://www.filmfutter.com/wp-content/uploads/2013/07/The-Conjuring-Movie.jpg', 1),
 ('The Thing', 'The Prequel to John Carpenters The Thing', 'https://www.dafont.com/forum/attach/orig/1/2/122268.jpg', 1),
 ('The Fog', 'John Carpenters classic Horror Film about a city being engulfed in murderous fog', 'https://trendblog.euronics.de/wp-content/uploads/2015/07/Carpenter_TheFog.jpg', 1),
 ('Supernatural', 'TV SHow about two brothers solving supernatural mysteries.', 'http://www.robots-and-dragons.de/sites/default/files/styles/large/public/supernatural-banner.jpg', 0),
 ('Preacher', 'About a small-town preacher that gets convinced he has a gift of god.', 'https://www.tracking-board.com/wp-content/uploads/2017/06/preacher-banner.jpg', 0),
 ('Ash vs Evil Dead', 'About Ash from The Evil Dead who gets hunted by demons yet again.', 'https://geekroniques.fr/wp-content/uploads/2016/02/une-ash-vs-evildead.jpg', 0),
 ('Evil Dead', 'Remake of the classic Horror Movie where young people are trapped in a cabin in the woods with demons attaqcking them.', 'https://www.pophorror.com/wp-content/uploads/2017/04/evil-dead-banner-new-5.jpg', 1),
 ('The Strain', 'Series about a murderous parasite that gets infects a lot of people', 'https://flixable.b-cdn.net/disney-plus/large/de/the-strain.png', 0),
 ('The Walking Dead', 'Series about People surviving in a Zombie Apocalypse.', 'https://s-cdn.serienjunkies.de/n/the-walking-dead-og.jpg', 0),
 ('American Horror Story', 'Anthology Series about People trapped in horrifying places modelled after classical horror scenarios.', 'https://glitcheffekt.de/wp-content/uploads/Ecran_Titre_dAmerican_Horror_Story.png', 0);


  -- Dritte Tabelle "Movies" anlegen
 CREATE TABLE `movies` (
   `id` int(10) NOT NULL AUTO_INCREMENT,
   `entity_id` int(10) NOT NULL,
   `release_year` int(4) NOT NULL,
   `video_embed` varchar(20) NULL,

    PRIMARY KEY(`id`),
    KEY `movfr1` (`entity_id`)

 ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


  -- Testdaten für Tabelle "Movies"
  INSERT INTO `movies` (`entity_id`, `release_year`, `video_embed`)
  VALUES
  (1, 1978, "idXwM4FXpDs"),
  (3, 2003, "ipbCUW3umJU"),
  (4, 2009, "cCfO1aB8CIE"),
  (5, 1995, "BBEB9OSfeCA"),
  (6, 2004, "GV5y4yTDtBI"),
  (7, 2013, "k10ETZ41q5o"),
  (8, 2011, "Txjm94GnrPA"),
  (9, 1980, "nOZwnivtLbc"),
  (13, 2013, "TVWQmdKmct4");

    -- Vierte Tabelle "Series" anlegen
   CREATE TABLE `series` (
     `id` int(10) NOT NULL AUTO_INCREMENT,
     `entity_id` int(10) NOT NULL,
     `start_year` int(4) NOT NULL,
     `season` int(2) NOT NULL,
     `episode` int(2) NOT NULL,
     `video_embed` varchar(20) NULL,

      PRIMARY KEY(`id`),
      KEY `serfr1` (`entity_id`)

   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


    -- Testdaten für Tabelle "Series"
    INSERT INTO `series` (entity_id, start_year, season, episode, `video_embed`)
    VALUES
    (2, 2013, 1, 0, "f_Y5YeYrqUk"),
    (2, 2014, 2, 0, "ZlMVVdw1a8w"),
    (10, 2005, 1, 0, "t-775JyzDTk"),
    (11, 2016, 1, 0, "GLcapWjVXoE"),
    (12, 2015, 1, 0, "-Yq3jeOmxSk"),
    (14, 2014, 1, 0, "GqiDTt5WP7s"),
    (15, 2010 ,1, 0, "sfAc2U20uyg"),
    (16, 2011, 1, 0, "-tC3wIAIBx8");

    -- Fünfte Tabelle "Video Group" anlegen
   CREATE TABLE `video_group` (
     `video_group_id` int(10) NOT NULL AUTO_INCREMENT,
     `title` varchar(20) NOT NULL,
     `isMovies` tinyint(1) NOT NULL,

      PRIMARY KEY(`video_group_id`)

   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


    -- Testdaten für Tabelle "Video group"
    INSERT INTO `video_group` (`title`, `isMovies`)
    VALUES
    ("Slasher Horror", 1),
    ("Stephen King Series", 0),
    ("Haunted House", 1),
    ("Creature Horror", 1),
    ("John Carpenter", 1),
    ("Biblical Themes", 0),
    ("Supernatural Themes", 0),
    ("Science Fiction Horror", 0);



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
    (1, 3),
    (1, 4),
    (3, 5),
    (4, 6),
    (3, 7),
    (5, 1),
    (5, 9),
    (5, 8),
    (4, 5),
    (4, 8),
    (6, 10),
    (7, 10),
    (6, 11),
    (7, 12),
    (4, 13),
    (1, 13),
    (8, 14),
    (8, 15),
    (7, 16);

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
    ("https://images8.alphacoders.com/841/841728.jpg", 3),
    ("https://image.tmdb.org/t/p/w1280/8dkD13xlSr51S6xCjDJB6F4Q7Ax.jpg",2);


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


      -- Siebte Tabelle "Ticket" anlegen
    CREATE TABLE `ticket` (
        `id` int(10) NOT NULL AUTO_INCREMENT,
        `user_id` int(10) NOT NULL,
        `topic` varchar(200) NOT NULL,
        `description` text NOT NULL,

        PRIMARY KEY(`id`),
        KEY `ticket_usr` (`user_id`)

    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    INSERT INTO `ticket` (`user_id`,`topic`,`description`)
    VALUES
    (1,"The index site looks bad :(", "So on the first page when logging in there is this slideshow tingy, but it doesnt work or soemthing and iam reyll angry!!!1!");

 -- Fremdschlüsselprüfung zu referenzierten Daten hinzufügen

  ALTER TABLE `movies` ADD CONSTRAINT `movfr1` FOREIGN KEY (`entity_id`)  REFERENCES `entity`(`entity_id`);
  ALTER TABLE `series` ADD CONSTRAINT `serfr1` FOREIGN KEY (`entity_id`)  REFERENCES `entity`(`entity_id`);

  ALTER TABLE `video_group_member` ADD CONSTRAINT `vidgrmem1` FOREIGN KEY (`video_group_id`)  REFERENCES  `video_group`(`video_group_id`);
  ALTER TABLE `video_group_member` ADD CONSTRAINT `vidgrmem2` FOREIGN KEY (`entity_id`)  REFERENCES `entity`(`entity_id`);

  ALTER TABLE `banner_images` ADD CONSTRAINT `banner_ent` FOREIGN KEY (`entity_id`) REFERENCES `entity`(`entity_id`);

  ALTER TABLE `watchlist` ADD CONSTRAINT `watchl_usr` FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`);
  ALTER TABLE `watchlist` ADD CONSTRAINT `watchl_ent` FOREIGN KEY (`entity_id`) REFERENCES `entity`(`entity_id`);

  ALTER TABLE `ticket` ADD CONSTRAINT `ticket_usr` FOREIGN KEY (`user_id`) REFERENCES `user`(`user_id`);


 --  User für Zugriff von Web erstellen
CREATE OR REPLACE USER 'usr1'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'usr1'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `iscream`.* TO 'usr1'@'localhost';


COMMIT;

