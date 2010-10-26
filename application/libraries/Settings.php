<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Settings
 *
 * @author derek
 */
class Settings {
    //put your code here

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
         $selectQuery = "SELECT * FROM $this->settingTable";
         log_message('debug', 'Query Executed by Setting_mdl::getAllSettings() ' . $selectQuery);
        $execute = $this->ci->db->query($selectQuery);
        $settingsArray = array();
        foreach($execute->result() as $row){
            $settingsArray[$row->settingName] = $row->settingValue;
        }
        return $settingsArray;
    }

}
?>