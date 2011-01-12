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
    (1, 'default', 'Derek Stegelman', 1),
        (2, 'Galleria', 'Derek Stegelman', 0);


delete from `photoSettings` where settingID = 5;
delete from `photoSettings` where settingID = 6;
delete from `photoSettings` where settingID = 7;
delete from `photoSettings` where settingID = 8;
delete from `photoSettings` where settingID = 9;


-- Remember to add a modify for the comments table.


--  Following changes are post 1.5

alter table photoAlbums change albumID id int;
alter table photoPhotos change photoID id int;
alter table photoComments change commentID id int;
alter table photoSettings change settingID id int;
alter table photoThemes chanage themeID id int;

--  Change table column names @todo

--  Drop albumDesc from album table