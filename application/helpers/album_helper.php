<?php
/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.5
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright		2010 FotoChest
*/

// ----------------------------------------------------------------

/**
* Album Helper
*
* @package		FotoChest
* @category		Helpers
* @author		Derek Stegelman
*/

// Get album Friendly Name

function getAlbumFriendlyName($albumID)
{
    log_message('info', $albumID);
    $CI =& get_instance();
    $CI->load->model('Album_mdl');
    $exe = $CI->Album_mdl->read($albumID);
    foreach($exe->result() as $row){
        $albumFriendly = $row->albumFriendlyName;
    }
    return $albumFriendly;
}

function getAlbumName($albumID)
{
    log_message('info', $albumID);
    $CI =& get_instance();
    $CI->load->model('Album_mdl');
    $exe = $CI->Album_mdl->get($albumID);
    foreach($exe->result() as $row)
    {
        $albumName = $row->albumName;
    }
    return $albumName;
}

function getAlbumPhotoCount($albumID){

    $CI =& get_instance();
    $CI->load->model('Photo_mdl');
    $photos = $CI->Photo_mdl->getAllAlbumPhotos($albumID);
    $count = $photos->num_rows();
    return $count;
}

function getAlbumID($albumName)
{
    $CI =& get_instance();
    $CI->load->model('Album_mdl');
    $getAlbumInfo = $CI->Album_mdl->getWhere('albumName', $albumName);
    if ($getAlbumInfo->num_rows() == 0){

        return false;
    } else {
        foreach($getAlbumInfo->result() as $row){
            $albumID = $row->albumID;
        }
    }
    return $albumID;
}


?>
