<?php

// Get album Friendly Name

function getAlbumFriendlyName($albumID)
{
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
    $CI =& get_instance();
    $CI->load->model('Album_mdl');
    $exe = $CI->Album_mdl->read($albumID);
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
    $getAlbumInfo = $CI->Album_mdl->getAlbumByName($albumName);
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
