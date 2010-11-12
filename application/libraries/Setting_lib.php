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


    var $settingID;
    var $settingName;
    var $settingValue;
    var $settingTable;

    private $ci;

    public function __construct(){
        $this->ci =& get_instance();
        $this->settingTable = $this->ci->config->item('settingTable');
    }

    public function getSetting($settingName){

        $selectQuery = "SELECT * FROM $this->settingTable WHERE settingName = '$settingName'";
        $execute = $this->ci->db->query($selectQuery);
        if($execute->num_rows() == 0){
            log_message('ERROR', 'Setting ' . $settingName . " not found");
            return false;
        } else {
            foreach($execute->result() as $row){
                $settingValue = $row->settingValue;
            }
            log_message('debug','Setting fetched: ' . $settingName . " set as " . $settingValue);
            return $settingValue;
        }
    }

    public function setSetting($settingName, $settingValue){

        $data = array('settingValue'=>$settingValue);
        $where = "settingName = '$settingName'";
        $buildUpdate = $this->ci->db->update_string($this->settingTable, $data, $where);
        $this->ci->db->query($buildUpdate);
        log_message('debug', 'Setting ' . $settingName . ' has been set to: ' . $settingValue);

    }

    public function getAllSettings(){
        $this->ci->load->model('Setting_mdl');
        $execute = $this->ci->Setting_mdl->read();
        $settingsArray = array();
        foreach($execute->result() as $row){
            $settingsArray[$row->settingName] = $row->settingValue;
        }
        return $settingsArray;
    }
}
?>
