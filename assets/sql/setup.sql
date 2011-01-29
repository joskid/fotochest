# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: 127.0.0.1 (MySQL 5.1.44)
# Database: fotochest
# Generation Time: 2011-01-29 10:14:16 -0600
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table photoAlbums
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photoAlbums`;

CREATE TABLE `photoAlbums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `albumName` varchar(220) DEFAULT NULL,
  `albumCreateDate` date DEFAULT NULL,
  `albumModifiedDate` date DEFAULT NULL,
  `albumParentID` int(11) unsigned DEFAULT NULL,
  `albumFriendlyName` text,
  `albumDesc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;



# Dump of table photoComments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photoComments`;

CREATE TABLE `photoComments` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `commentContent` text,
  `commentPhotoID` int(11) NOT NULL,
  `commentDate` date DEFAULT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


# Dump of table photoLibrary
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photoLibrary`;

CREATE TABLE `photoLibrary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photoTitle` text,
  `photoDesc` text,
  `photoFileName` text,
  `photoCreatedDate` date DEFAULT NULL,
  `photoAlbumID` int(11) NOT NULL,
  `isProfilePic` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;



# Dump of table photoSessions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photoSessions`;

CREATE TABLE `photoSessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


# Dump of table photoSettings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photoSettings`;

CREATE TABLE `photoSettings` (
  `settingID` int(11) DEFAULT NULL,
  `settingName` varchar(255) DEFAULT NULL,
  `settingValue` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `photoSettings` WRITE;
/*!40000 ALTER TABLE `photoSettings` DISABLE KEYS */;
INSERT INTO `photoSettings` (`settingID`,`settingName`,`settingValue`)
VALUES
	(1,'siteName','Coolest photo album ever'),
	(3,'absoluteFilePath','/Applications/MAMP/htdocs/'),
	(4,'enableOriginalDownload','TRUE'),
	(22,'showPhotoTitle','TRUE'),
	(10,'enableComments','TRUE'),
	(11,'enableSlideshow','TRUE'),
	(12,'debugMode','FALSE'),
	(13,'enableMaps','FALSE'),
	(14,'enablePhotoInfo','FALSE'),
	(15,'enableLiveEdit','TRUE'),
	(16,'enableFullViewPhoto','TRUE'),
	(17,'enablePhotoFTPImport','FALSE'),
	(18,'enableUserCreation','TRUE'),
	(19,'planType','5'),
	(20,'themeName','Galleria'),
	(21,'firstTimeLogin','FALSE');

/*!40000 ALTER TABLE `photoSettings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table photoThemes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photoThemes`;

CREATE TABLE `photoThemes` (
  `themeID` int(11) DEFAULT NULL,
  `themeName` varchar(255) DEFAULT NULL,
  `themeAuthor` varchar(255) DEFAULT NULL,
  `themeActive` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

LOCK TABLES `photoThemes` WRITE;
/*!40000 ALTER TABLE `photoThemes` DISABLE KEYS */;
INSERT INTO `photoThemes` (`themeID`,`themeName`,`themeAuthor`,`themeActive`)
VALUES
	(1,'default','Derek Stegelman',0),
	(2,'Flickr-ish','Derek Stegelman',0),
	(3,'Europe','Derek and Lindy Stegelman',0),
	(4,'Galleria','Derek Stegelman',1);

/*!40000 ALTER TABLE `photoThemes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table photoUsers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photoUsers`;

CREATE TABLE `photoUsers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userEmail` varchar(45) DEFAULT NULL,
  `userPassword` varchar(255) DEFAULT NULL,
  `userFirstName` varchar(255) DEFAULT NULL,
  `userLastName` varchar(255) DEFAULT NULL,
  `userDateCreated` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;







/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
