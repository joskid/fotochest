<?php


function getFirstname(){
    $CI =& get_instance();
    $CI->load->model('User_mdl');
    $username = $CI->User_mdl->getFirstName();
    return $username;
}

function getProfilePicture(){
    $CI =& get_instance();
   
    $CI->load->library('photo_lib');
    $profileData = $CI->photo_lib->getProfilePicture();
    if ($profileData->num_rows == 0){

        $imgString = "<img src='http://dummyimage.com/75X75' alt='No Profile Picture' width='75' height='75' class='profilePic'>";

    } else {
    foreach($profileData->result() as $row){
        $photoFileName = $row->photoFileName;
        $albumID = $row->photoAlbumID;
        $photoName = $row->photoTitle;
    }
    $CI->load->model('Album_mdl');
    $albumName = getAlbumName($albumID);
    $imgString = "<img src='" . base_url() . "img_stor/albums/" . $albumName . "/thumbs/" . $photoFileName . "' alt='" . $photoName . "' width='75' height='75' class='profilePic'>";
    
    }
    return $imgString;
}

function isLoggedIn(){
    $CI =& get_instance();
    $CI->load->model('User_mdl');
    $loggedIn = $CI->User_mdl->isLoggedIn();
    return $loggedIn;

}

function getPassword($userID){
    $CI =& get_instance();
    $CI->load->model('User_mdl');
    $password = $CI->User_mdl->getUserPassword($userID);
    return $password;
}


?>
