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
* Setting Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/


class Setting_lib {


    public $settingID;
    public $settingName;
    public $settingValue;
    public $settingTable;

    // CI master object
    private $ci;

    public function __construct(){
        $this->ci =& get_instance();
        $this->ci->load->model('Setting_mdl');
    }

    public function getSetting($settingName){

        $settingData = $this->ci->Setting_mdl->readName($settingName);

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

        $this->ci->Setting_mdl->update($settingName, $settingValue);
        log_message('debug', 'Setting ' . $settingName . ' has been set to: ' . $settingValue);
    }

    public function getAllSettings(){
        $this->ci->load->model('Setting_mdl');
        $execute = $this->ci->Setting_mdl->readName();
        $settingsArray = array();
        foreach($execute->result() as $row){
            $settingsArray[$row->settingName] = $row->settingValue;
        }
        return $settingsArray;
    }
}
?>
