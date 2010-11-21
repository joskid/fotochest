

CREATE TABLE `photoAlbums` (
  `albumID` int(11) NOT NULL auto_increment,
  `albumName` varchar(220) default NULL,
  `albumCreateDate` date default NULL,
  `albumModifiedDate` date default NULL,
  `albumParentID` int(11) unsigned default NULL,
  `albumFriendlyName` text,
  `albumDesc` text,
  PRIMARY KEY  (`albumID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;




CREATE TABLE `photoComments` (
  `commentID` int(11) NOT NULL auto_increment,
  `commentContent` text,
  `commentPhotoID` int(11) NOT NULL,
  PRIMARY KEY  (`commentID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table photoLibrary
# ------------------------------------------------------------


CREATE TABLE `photoLibrary` (
  `photoID` int(11) NOT NULL auto_increment,
  `photoTitle` text,
  `photoDesc` text,
  `photoFileName` text,
  `photoCreatedDate` date default NULL,
  `photoAlbumID` int(11) NOT NULL,
  `isProfilePic` int(11) default '0',
  PRIMARY KEY  (`photoID`)
) ENGINE=MyISAM AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;


CREATE TABLE `photoSessions` (
  `session_id` varchar(40) NOT NULL default '0',
  `ip_address` varchar(16) NOT NULL default '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL default '0',
  `user_data` text NOT NULL,
  PRIMARY KEY  (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





CREATE TABLE `photoSettings` (
  `settingID` int(11) default NULL,
  `settingName` varchar(255) default NULL,
  `settingValue` varchar(255) default NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `photoSettings` (`settingID`,`settingName`,`settingValue`)
VALUES
	(1,'siteName','Coolest photo album ever'),
	(3,'absoluteFilePath','/Applications/MAMP/htdocs/'),
	(4,'enableOriginalDownload','TRUE'),
	(10,'enableComments','FALSE'),
	(11,'enableSlideshow','TRUE'),
	(12,'debugMode','FALSE'),
	(13,'enableMaps','FALSE'),
	(14,'enablePhotoInfo','FALSE'),
	(15,'enableLiveEdit','TRUE'),
	(16,'enableFullViewPhoto','TRUE'),
	(17,'enablePhotoFTPImport','FALSE'),
	(18,'enableUserCreation','TRUE'),
	(19,'planType','5'),
	(20,'themeName','default'),
	(21,'firstTimeLogin','TRUE');

CREATE TABLE `photoUsers` (
  `userID` int(11) NOT NULL auto_increment,
  `userEmail` varchar(45) default NULL,
  `userPassword` varchar(255) default NULL,
  `userFirstName` varchar(255) default NULL,
  `userLastName` varchar(255) default NULL,
  `userDateCreated` date default NULL,
  PRIMARY KEY  (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE `photoThemes` (
  `themeID` int(11) NOT NULL auto_increment,
  `themeName` varchar(255) default NULL,
  `themeAuthor` varchar(255) default NULL,
  `themeActive` int(11) default NULL,
  PRIMARY KEY  (`themeID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO `photoThemes` (`themeID`,`themeName`,`themeAuthor`,`themeActive`)
VALUES
	(1, 'default', 'Derek Stegelman', 0),
	(2, 'Flickr-ish', 'Derek Stegelman', 1),
	(3, 'Europe', 'Derek and Lindy Stegelman', 0);
