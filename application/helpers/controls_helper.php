<?php



function getAlbumDropdownList(){
        $ci =& get_instance();
        $albums = $ci->Album_mdl->getAllAlbums();
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

?>
