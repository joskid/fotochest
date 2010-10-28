<?php

function getSetting($settingName){
    $CI =& get_instance();
    
    $settingValue = $CI->settings_lib->getSetting($settingName);
    return $settingValue;
}

function setSetting($settingName, $settingValue){
    $CI =& get_instance();
    $CI->settings_lib->setSetting($settingName, $settingValue);
    return true;
}

function isOverPhotoLimit(){
    $CI =& get_instance();
    $CI->load->model('Photo_mdl');
    $photoNum = $CI->Photo_mdl->getPhotoCount();
    
    $planType = $CI->settings_lib->getSetting('planType');
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
    
    $planType = $CI->settings_lib->getSetting('planType');
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
    $CI->load->model('Photo_mdl');
    $count = $CI->Photo_mdl->getPhotoCount();
    return $count;
}

function getAlbumCount(){
    $CI =& get_instance();
    $CI->load->model('Album_mdl');
    $count = $CI->Album_mdl->getTotalAlbumCount();
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
