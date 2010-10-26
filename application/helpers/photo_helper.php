<?php
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

?>
