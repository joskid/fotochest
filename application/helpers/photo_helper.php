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

?>
