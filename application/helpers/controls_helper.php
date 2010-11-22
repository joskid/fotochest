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
* Controls Helper
*
* @package		FotoChest
* @category		Helpers
* @author		Derek Stegelman
*/


function getAlbumDropdownList($showParent = TRUE){
        $ci =& get_instance();
        $ci->load->model('Album_mdl');
        $albums = $ci->Album_mdl->read();
        $options = array();
        foreach($albums->result() as $row){
            $options[$row->albumID] = $row->albumName;
        }
        if ($showParent == TRUE)
        {
            $options[0] = 'No Parent';
        }
        $id = 'id="albumID"';
        return form_dropdown('albumID', $options, '', $id);

    }

function getPreviousURL($photoID, $albumName)
{
    if (checkPhoto($photoID, $albumName))
    {
        $newPhotoID = $photoID - 1;
        $url = site_url() . "photos/view/" . $albumName . "/" . $newPhotoID;
    }
    return $url;
}

function getNextURL($photoID)
{
    
}

?>
