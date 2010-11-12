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
* User Helper
*
* @package		FotoChest
* @category		Helpers
* @author		Derek Stegelman
*/


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
    $CI->load->library('user_lib');
    $loggedIn = $CI->user_lib->isLoggedIn();
    return $loggedIn;

}

function getPassword($userID){
    $CI =& get_instance();
    $CI->load->model('User_mdl');
    $userData = $CI->User_mdl->read($userID);
    foreach($userData->result() as $user)
    {
        $password = $user->userPassword;
    }

    // Load the encryption library
    $CI->load->library('encrypt');
    $encrypted = $CI->encrypt->decode($password);
    return $encrypted;
}


?>
