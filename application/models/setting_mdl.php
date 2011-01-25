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
* Settings Model
*
* @package		FotoChest
* @category		Models
* @author		Derek Stegelman
*/

//  !!! @todo how did I miss this???  This needs completed...


class Setting_mdl extends CoreModel {

    public $settingID;
    public $settingName;
    public $settingValue;
    public $settingTable;

    public function  __construct() {
        parent::__construct();
        //$this->settingTable = $this->config->item('settingTable');
        $this->_table = $this->config->item('settingTable');
    }

    // Getters
    public function getID($settingName)
    {
        show_error('getID from settings model is depreciated, use core instead.');
        log_message('ERROR', 'getID from settings model is depreciated, use core instead.');
//        $query = "SELECT * FROM $this->settingTable WHERE settingName = '$settingName'";
//        $settingData = $this->db->query($query);
//        foreach($settingData->result() as $row)
//        {
//            $settingID = $row->settingID;
//        }
//        return $settingID;
    }

    public function readName($settingName = null)
    {
        show_error('readname from settings model is depreciated, use core instead.');
        log_message('ERROR', 'readname from settings model is depreciated, use core instead.');
//        if($settingName == null)
//        {
//            $settingData = $this->db->get($this->settingTable);
//        }
//        else
//        {
//            $query = "SELECT * FROM $this->settingTable WHERE settingName = '$settingName'";
//            $settingData = $this->db->query($query);
//        }
//        return $settingData;
    }


    public function update($settingName, $settingValue)
    {
        show_error('update from settings model is depreciated, use core instead.');
        log_message('ERROR', 'update from settings model is depreciated, use core instead.');
//        $updateData = array('settingValue'=>$settingValue);
//        $settingID = $this->getID($settingName);
//        $this->db->where('settingID', $settingID);
//        $this->db->update($this->settingTable, $updateData);
    }

    public function delete($photoID)
    {
        show_error('delete from settings model is depreciated, use core instead.');
        log_message('ERROR', 'delete from settings model is depreciated, use core instead.');
        //$this->db->delete($this->photoTable, array('photoID'=>$photoID));
    }
}