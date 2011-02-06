<?php

/**
* Open Cook Book
*
* Open Cook Book is a simple CodeIgniter based cooking application that stores recipes.
*
* @package		OpenCookBook
* @version		1.0
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright		2010 OpenCookBook
*/

// ----------------------------------------------------------------

/**
* Recipes Controller
*
* @package		OpenCookBook
* @category		Controllers
* @author		Derek Stegelman
*/

class Setting extends CoreLibrary {
    //put your code here

    public $settingID;
    public $settingName;
    public $settingValue;
    public $settingTable;


    public function __construct()
    {
        parent::__construct();

    }

    public function getSetting($settingName)
    {
        $settingData = $this->ci->Setting_mdl->getWhere('settingName', $settingName);

        if($settingData->num_rows() == 0){
            log_message('ERROR', 'Setting ' . $settingName . " not found");
            return false;
        } else {
            foreach($settingData->result() as $row){
                $settingValue = $row->settingValue;
            }
            log_message('debug','Setting fetched: ' . $settingName . " set as " . $settingValue);
            return $settingValue;
        }
    }

    public function setSetting($settingName, $settingValue){

        $data = array('settingValue'=>$settingValue);
        $this->ci->Setting_mdl->updateWhere($data, $settingName, $settingValue); //data key value
        log_message('debug', 'Setting ' . $settingName . ' has been set to: ' . $settingValue);
    }

    public function getAllSettings(){

        $execute = $this->ci->Setting_mdl->get();
        $settingsArray = array();
        foreach($execute->result() as $row){
            $settingsArray[$row->settingName] = $row->settingValue;
        }
        return $settingsArray;
    }
}
