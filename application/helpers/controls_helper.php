<?php



function getAlbumDropdownList(){
        $ci =& get_instance();
        $ci->load->model('Album_mdl');
        $albums = $ci->Album_mdl->read();
        $options = array();
        foreach($albums->result() as $row){
            $options[$row->albumID] = $row->albumName;
        }
        $options[0] = 'No Parent';
        $id = 'id="albumID"';
        return form_dropdown('albumID', $options, '', $id);

    }

function getAlbumDropdownListNoParent(){
    
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
