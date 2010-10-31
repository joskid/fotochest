<?php

function getSetting($settingName){
    $CI =& get_instance();
    
    $settingValue = $CI->setting_lib->getSetting($settingName);
    return $settingValue;
}

function setSetting($settingName, $settingValue){
    $CI =& get_instance();
    $CI->setting_lib->setSetting($settingName, $settingValue);
    return true;
}

function isOverPhotoLimit(){
    $CI =& get_instance();

    // Load the photo library
    $CI->load->library('photo_lib');

    // Call the count method
    $photoNum = $CI->photo_lib->getPhotoCount();
    
    $planType = $CI->setting_lib->getSetting('planType');
    switch ($planType){
        case 0:
            if($photoNum > 350){
                return true;
            }
            break;
        case 1:
            if($photoNum > 1000){
                return true;
                break;
            }
    }
    
}

function getPhotoLimit(){
    $CI =& get_instance();
    
    $planType = $CI->setting_lib->getSetting('planType');
    switch ($planType){
        case 0:
            return 350;
            break;
        case 1:
            return 1000;
            break;
    }

}

function getPhotoCount(){
    $CI =& get_instance();

    // Load the photo library
    $CI->load->library('photo_lib');

    // Call the method
    $count = $CI->photo_lib->getPhotoCount();
    return $count;
}

function getAlbumCount(){
    $CI =& get_instance();

    // Load the library
    $CI->load->library('album_lib');

    // Call the method
    $count = $CI->album_lib->getTotalAlbumCount();
    return $count;
}


function isChecked($bool){

    if ($bool == 'TRUE'){
        return 'Checked';

    } else {
        return '';
    }
}

function getVersion(){
    $CI =& get_instance();
    $version = $CI->config->item('versionNumber');
    return $version;
}

?>
