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
* Thumb Helper
*
* @package		FotoChest
* @category		Helpers
* @author		Derek Stegelman
*/


/* Consider deprecating this function */
function getAlbumThumb($albumID){
    $CI =& get_instance();
    $CI->load->model('Album_mdl');
    $CI->load->library('album_lib');
    $albumName = getAlbumName($albumID);
    $thumbs = $CI->album_lib->findAlbumThumbnails($albumID, 1);
    if (getAlbumPhotoCount($albumID) > 1){
    foreach($thumbs->result() as $row){
        $fileName = $row->photoFileName;
    }
    $thumbHTML = "<img src='" . site_url() . "/img_stor/albums/" . $albumName . "/thumbs/" . $fileName . "' width='75' class='profilePic'>";
    } else {
        $thumbHTML = "<img src='http://dummyimage.com/75X75'>";
    }
    return $thumbHTML;
}

function getAlbumThumbs($albumID, $thumbs = 3, $isAdmin = FALSE)
{

    $CI =& get_instance();
    $CI->load->model('Album_mdl');
    $CI->load->library('album_lib');
    $getThumbs = $CI->album_lib->findAlbumThumbnails($albumID, $thumbs);
    log_message('info', 'getThumbs is called ' . $getThumbs->num_rows());
    $thumbMarkup = "";
    $thumbCount = 0;

    if($getThumbs->num_rows() == 0 && $isAdmin == TRUE)
    {
        $thumbMarkup = "<img src='http://dummyimage.com/75X75'>";
    }
    elseif($getThumbs->num_rows() == 0 && $isAdmin == FALSE)
    {
       $thumbMarkup = "<img src='http://dummyimage.com/240X240'>";
    }
    else
    {

        foreach($getThumbs->result() as $imgs)
        {
            $thumbCount += 1;
            log_message('info', 'Thumbcut' . $thumbCount);
            log_message('info', 'AlbumName ' . $imgs->albumName);
            $url = base_url() . "img_stor/albums/" . $imgs->albumName . "/thumbs/" . $imgs->photoFileName;
            if($isAdmin == TRUE)
            {
                $thumbMarkup = $thumbMarkup . "<img class='img$thumbCount thumb' src='$url' width='75'>";
            }
            else
            {
                $thumbMarkup = $thumbMarkup . "<img class='img$thumbCount thumb' src='$url'>";
            }
        }
    }
    return $thumbMarkup;

}
?>