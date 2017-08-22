-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.14 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour technews-limas
CREATE DATABASE IF NOT EXISTS `technews-limas` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `technews-limas`;

-- Export de la structure de la table technews-limas. article
CREATE TABLE IF NOT EXISTS `article` (
  `IDARTICLE` int(11) NOT NULL AUTO_INCREMENT,
  `IDAUTEUR` int(11) NOT NULL,
  `IDCATEGORIE` int(11) NOT NULL,
  `TITREARTICLE` char(150) NOT NULL,
  `CONTENUARTICLE` text NOT NULL,
  `FEATUREDIMAGEARTICLE` longtext,
  `SPECIALARTICLE` tinyint(1) NOT NULL DEFAULT '0',
  `SPOTLIGHTARTICLE` tinyint(1) NOT NULL DEFAULT '0',
  `DATECREATIONARTICLE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDARTICLE`),
  KEY `FK_REDIGER` (`IDAUTEUR`),
  KEY `FK_PLACER` (`IDCATEGORIE`),
  CONSTRAINT `FK_PLACER` FOREIGN KEY (`IDCATEGORIE`) REFERENCES `categorie` (`IDCATEGORIE`),
  CONSTRAINT `FK_REDIGER` FOREIGN KEY (`IDAUTEUR`) REFERENCES `auteur` (`IDAUTEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Export de données de la table technews-limas.article : ~8 rows (environ)
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` (`IDARTICLE`, `IDAUTEUR`, `IDCATEGORIE`, `TITREARTICLE`, `CONTENUARTICLE`, `FEATUREDIMAGEARTICLE`, `SPECIALARTICLE`, `SPOTLIGHTARTICLE`, `DATECREATIONARTICLE`) VALUES
	(1, 1, 2, 'Tip Aligning Digital Marketing with Business Goals and Objectives', ' <p> <span class="dropcap ">N</span>ulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh.</p><p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus.</p><div class="post-detail-img"><img alt="" src="http://localhost/POO/technews/public/images/product/4.jpg" /></div><p class="quote">Sed porttitor lectus nibh. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p><p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus.</p>', '3.jpg', 0, 1, '2017-02-26 09:37:18'),
	(2, 2, 3, 'Six big ways MacOS Sierra is going to change your Apple experience', ' <p> <span class="dropcap ">N</span>ulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh.</p><p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus.</p><div class="post-detail-img"><img alt="" src="http://localhost/POO/technews/public/images/product/4.jpg" /></div><p class="quote">Sed porttitor lectus nibh. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p><p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus.</p>', '4.jpg', 0, 0, '2017-02-26 11:19:18'),
	(3, 1, 2, 'Will Anker be the company to finally put a heads-up display in my car', ' <p> <span class="dropcap ">N</span>ulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh.</p><p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus.</p><div class="post-detail-img"><img alt="" src="http://localhost/POO/technews/public/images/product/4.jpg" /></div><p class="quote">Sed porttitor lectus nibh. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p><p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus.</p>', '5.jpg', 1, 0, '2017-02-26 11:53:18'),
	(4, 2, 3, 'Windows 10 Now Running on 400 Million Active Devices, Says Microsoft', ' <p> <span class="dropcap ">N</span>ulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh.</p><p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus.</p><div class="post-detail-img"><img alt="" src="http://localhost/POO/technews/public/images/product/4.jpg" /></div><p class="quote">Sed porttitor lectus nibh. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p><p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus.</p>', '1.jpg', 0, 0, '2017-02-26 11:53:18'),
	(5, 1, 3, '400 million machines are now running Windows 10', ' <p> <span class="dropcap ">N</span>ulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh.</p><p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus.</p><div class="post-detail-img"><img alt="" src="http://localhost/POO/technews/public/images/product/4.jpg" /></div><p class="quote">Sed porttitor lectus nibh. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p><p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus.</p>', '7.jpg', 0, 1, '2017-02-26 11:53:18'),
	(6, 2, 2, '7 essential lessons from agency marketing to startup growth', ' <p> <span class="dropcap ">N</span>ulla quis lorem ut libero malesuada feugiat. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Sed porttitor lectus nibh.</p><p>Quisque velit nisi, pretium ut lacinia in, elementum id enim. Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Pellentesque in ipsum id orci porta dapibus.</p><div class="post-detail-img"><img alt="" src="http://localhost/POO/technews/public/images/product/4.jpg" /></div><p class="quote">Sed porttitor lectus nibh. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Quisque velit nisi, pretium ut lacinia in, elementum id enim.</p><p>Curabitur aliquet quam id dui posuere blandit. Sed porttitor lectus nibh. Sed porttitor lectus nibh. Pellentesque in ipsum id orci porta dapibus.</p>', '6.jpg', 0, 0, '2017-02-26 11:53:18');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;

-- Export de la structure de la table technews-limas. auteur
CREATE TABLE IF NOT EXISTS `auteur` (
  `IDAUTEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOMAUTEUR` varchar(50) DEFAULT NULL,
  `PRENOMAUTEUR` varchar(50) DEFAULT NULL,
  `EMAILAUTEUR` varchar(50) DEFAULT NULL,
  `MDPAUTEUR` varchar(255) DEFAULT NULL,
  `ROLESAUTEUR` longtext,
  PRIMARY KEY (`IDAUTEUR`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Export de données de la table technews-limas.auteur : ~3 rows (environ)
/*!40000 ALTER TABLE `auteur` DISABLE KEYS */;
INSERT INTO `auteur` (`IDAUTEUR`, `NOMAUTEUR`, `PRENOMAUTEUR`, `EMAILAUTEUR`, `MDPAUTEUR`, `ROLESAUTEUR`) VALUES
	(1, 'Doe', 'John', 'admin@biyn.media', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'ROLE_ADMIN'),
	(2, 'Doe', 'Jane', 'auteur@biyn.media', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 'ROLE_AUTEUR');
/*!40000 ALTER TABLE `auteur` ENABLE KEYS */;

-- Export de la structure de la table technews-limas. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `IDCATEGORIE` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLECATEGORIE` varchar(50) NOT NULL,
  PRIMARY KEY (`IDCATEGORIE`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Export de données de la table technews-limas.categorie : ~3 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`IDCATEGORIE`, `LIBELLECATEGORIE`) VALUES
	(2, 'Business'),
	(3, 'Computing'),
	(4, 'Tech');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Export de la structure de la table technews-limas. newsletter
CREATE TABLE IF NOT EXISTS `newsletter` (
  `IDNEWSLETTER` int(11) NOT NULL AUTO_INCREMENT,
  `EMAILNEWSLETTER` varchar(50) NOT NULL,
  `CONTACTNEWSLETTER` varchar(80) NOT NULL,
  PRIMARY KEY (`IDNEWSLETTER`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Export de données de la table technews-limas.newsletter : 0 rows
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;

-- Export de la structure de la table technews-limas. referencer
CREATE TABLE IF NOT EXISTS `referencer` (
  `IDARTICLE` int(11) NOT NULL,
  `IDTAGS` int(11) NOT NULL,
  PRIMARY KEY (`IDARTICLE`,`IDTAGS`),
  KEY `FK_REFERENCER2` (`IDTAGS`),
  CONSTRAINT `FK_REFERENCER` FOREIGN KEY (`IDARTICLE`) REFERENCES `article` (`IDARTICLE`),
  CONSTRAINT `FK_REFERENCER2` FOREIGN KEY (`IDTAGS`) REFERENCES `tags` (`IDTAGS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Export de données de la table technews-limas.referencer : ~0 rows (environ)
/*!40000 ALTER TABLE `referencer` DISABLE KEYS */;
/*!40000 ALTER TABLE `referencer` ENABLE KEYS */;

-- Export de la structure de la table technews-limas. tags
CREATE TABLE IF NOT EXISTS `tags` (
  `IDTAGS` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLETAGS` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDTAGS`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Export de données de la table technews-limas.tags : ~5 rows (environ)
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`IDTAGS`, `LIBELLETAGS`) VALUES
	(1, 'iPhone 7'),
	(2, 'News'),
	(3, 'Sport'),
	(4, 'Apple'),
	(5, 'Alcatel');
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;

-- Export de la structure de la vue technews-limas. view_articles
-- Création d'une table temporaire pour palier aux erreurs de dépendances de VIEW
CREATE TABLE `view_articles` (
	`IDARTICLE` INT(11) NOT NULL,
	`IDAUTEUR` INT(11) NOT NULL,
	`IDCATEGORIE` INT(11) NOT NULL,
	`LIBELLECATEGORIE` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
	`TITREARTICLE` CHAR(150) NOT NULL COLLATE 'utf8_general_ci',
	`CONTENUARTICLE` TEXT NOT NULL COLLATE 'utf8_general_ci',
	`FEATUREDIMAGEARTICLE` LONGTEXT NULL COLLATE 'utf8_general_ci',
	`SPECIALARTICLE` TINYINT(1) NOT NULL,
	`SPOTLIGHTARTICLE` TINYINT(1) NOT NULL,
	`DATECREATIONARTICLE` TIMESTAMP NOT NULL,
	`NOMAUTEUR` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`PRENOMAUTEUR` VARCHAR(50) NULL COLLATE 'utf8_general_ci',
	`EMAILAUTEUR` VARCHAR(50) NULL COLLATE 'utf8_general_ci'
) ENGINE=MyISAM;

-- Export de la structure de la vue technews-limas. view_articles
-- Suppression de la table temporaire et création finale de la structure d'une vue
DROP TABLE IF EXISTS `view_articles`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_articles` AS select `article`.`IDARTICLE` AS `IDARTICLE`,`article`.`IDAUTEUR` AS `IDAUTEUR`,`article`.`IDCATEGORIE` AS `IDCATEGORIE`,`categorie`.`LIBELLECATEGORIE` AS `LIBELLECATEGORIE`,`article`.`TITREARTICLE` AS `TITREARTICLE`,`article`.`CONTENUARTICLE` AS `CONTENUARTICLE`,`article`.`FEATUREDIMAGEARTICLE` AS `FEATUREDIMAGEARTICLE`,`article`.`SPECIALARTICLE` AS `SPECIALARTICLE`,`article`.`SPOTLIGHTARTICLE` AS `SPOTLIGHTARTICLE`,`article`.`DATECREATIONARTICLE` AS `DATECREATIONARTICLE`,`auteur`.`NOMAUTEUR` AS `NOMAUTEUR`,`auteur`.`PRENOMAUTEUR` AS `PRENOMAUTEUR`,`auteur`.`EMAILAUTEUR` AS `EMAILAUTEUR` from ((`article` join `auteur`) join `categorie`) where ((`article`.`IDAUTEUR` = `auteur`.`IDAUTEUR`) and (`article`.`IDCATEGORIE` = `categorie`.`IDCATEGORIE`));

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
