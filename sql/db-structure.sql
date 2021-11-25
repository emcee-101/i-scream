 -- Datenbank iscream löschen, wenn sie existiert
DROP DATABASE IF EXISTS `iscream`;

 -- erstellen
CREATE DATABASE iscream
CHARACTER SET `utf8`;
USE iscream;

 -- erste Tabelle "user" anlegen
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mail_address` varchar(50) NOT NULL,
  `age` int NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isSubscribed` tinyint(1) NOT NULL DEFAULT 0,

   PRIMARY KEY(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


 -- Testdaten
 INSERT INTO `user`
 VALUES (1,'Test1', 'testpass1', 'eins@gmail.com', 19, '2021-09-15 05:30:20', 1);
 VALUES (2,'Test2', 'testpass2', 'zwei@gmail.com', 30, '2021-10-10 10:30:10', 0);
 VALUES (3,'Test3', 'testpass3', 'drei@gmail.com', 40, '2021-04-15 07:24:50', 1);



 -- Entsprechenden User für Nnutzung mit PDO erstellen
CREATE OR REPLACE USER 'usr1'@'localhost' IDENTIFIED BY 'pass';
GRANT SELECT, INSERT, UPDATE, DELETE, FILE ON *.* TO 'usr1'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;GRANT ALL PRIVILEGES ON `iscream`.* TO 'usr1'@'localhost';


COMMIT;
