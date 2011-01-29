<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
* FotoChest - a web based photo album
* Copyright (C) 2009-2010 Derek Stegelman http://fotochest.com
*
*/

/*-----------------------------------------------------
 *
 * Database Tables
 *
 *
 */


$config['settingTable'] = "photoSettings";
$config['photoTable']= "photoLibrary";
$config['albumTable']= "photoAlbums";
$config['userTable']= "photoUsers";
$config['commentsTable']= "photoComments";
$config['themeTable'] = "photoThemes";


/* Application Settings */

$config['enableMultiUser'] = FALSE;


/*------------------------------------------------------
 * 
 * Size of thumbnails
 * 
 */
$config['thumbWidth'] = '700';
$config['thumbHeight'] = '700';

$config['environment'] = 'dev'; // Options are 'dev', 'staging', 'production'

?>
