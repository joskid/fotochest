-- Upgrade from 1 to 1.5
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
	(3, 'Europe', 'Derek and Lindy Stegelman', 0),
        (4, 'Galleria', 'Derek Stegelman', 0);


delete from `photoSettings` where settingID = 5;
delete from `photoSettings` where settingID = 6;
delete from `photoSettings` where settingID = 7;
delete from `photoSettings` where settingID = 8;
delete from `photoSettings` where settingID = 9;


-- Remember to add a modify for the comments table.