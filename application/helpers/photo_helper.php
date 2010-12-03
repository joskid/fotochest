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
* Photo Helper
*
* @package		FotoChest
* @category		Helpers
* @author		Derek Stegelman
*/

function getPhotoTitle($photoID)
{
    $CI =& get_instance();
    $CI->load->model('Photo_mdl');
    $photoInfo = $CI->Photo_mdl->getPhotoInfo($photoID);
    foreach($photoInfo->result() as $row)
    {
        $photoTitle = $row->photoTitle;
    }
    return $photoTitle;
}

// Get File Name

function getPhotoFileName($photoID)
{
    $CI =& get_instance();
    $CI->load->model('Photo_mdl');
    $photoInfo = $CI->Photo_mdl->getPhotoInfo($photoID);
    foreach($photoInfo->result() as $row)
    {
        $photoFileName = $row->photoFileName;
    }
    return $photoFileName;
}

function checkPhoto($photoID, $albumName)
{
    $CI =& get_instance();
    $CI->load->library('photo_lib');
    $exist = $CI->photo_lib->exists($photoID, $albumName);
    return $exist;
    
}

function getPhotoAlbumName($photoID)
{
    $CI =& get_instance();
    $CI->load->model('Photo_mdl');
    $photoInfo = $CI->Photo_mdl->getPhotoInfo($photoID);
    foreach($photoInfo->result() as $row)
    {
        $photoAlbumName = $row->albumName;
    }
    return $photoAlbumName;
}

function nextNav($photoID, $albumName)
{

    $nextPhoto = $photoID - 1;
    $nextLink = "<a class='prev'";
    if(!checkPhoto($nextPhoto, $albumName))
    {
        $nextLink = $nextLink . " style='display:none;'";
    }
    $nextLink = $nextLink . " href='" . site_url() . "photo/" . $albumName . "/" . $nextPhoto . "'>";
    $nextLink = $nextLink . "<img src='" . base_url() . "assets/images/Arrow-Right.png' width='24'></a>";
    return $nextLink;

}

function previousNav($photoID, $albumName)
{
    $nextPhoto = $photoID + 1;

    $prevLink = "<a class='prev'";
    if(!checkPhoto($nextPhoto, $albumName))
    {
        $prevLink = $prevLink . " style='display:none;'";
    }
    $prevLink = $prevLink . " href='" . site_url() . "photo/" . $albumName . "/" . $nextPhoto . "'>";
    $prevLink = $prevLink . "<img src='" . base_url() . "assets/images/Arrow-Left.png' width='24'></a>";
    return $prevLink;
}

?>
