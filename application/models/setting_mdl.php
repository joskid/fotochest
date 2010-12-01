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


class Setting_mdl extends CI_Model {

    var $settingID;
    var $settingName;
    var $settingValue;
    var $settingTable;

    public function  __construct() {
        parent::__construct();
        $this->settingTable = $this->config->item('settingTable');
    }

    // Getters
    public function getID($settingName)
    {
        $query = "SELECT * FROM $this->settingTable WHERE settingName = $settingName";
        $settingData = $this->db->query($query);
        foreach($settingData->result() as $row)
        {
            $settingID = $row->settingID;
        }
        return $settingID;
    }

    public function create()
    {
        $insertData = array('photoAlbumName'=>$this->photoAlbumName,
            'photoFileName'=>$this->photoFileName,
            'photoTitle'=>$this->photoTitle,
            'photoDesc'=>$this->photoDesc,
            'photoCreatedDate'=>date("m/d/y"),
            'isProfilePicture'=>0);
        $this->db->insert($this->photoTable, $insertData);
    }

    public function readName($settingName = null)
    {
        if($settingName == null)
        {
            $settingData = $this->db->get($this->settingTable);
        }
        else
        {
            $query = "SELECT * FROM $this->settingTable WHERE settingName = $settingName";
            $settingData = $this->db->query($query);
        }
        return $settingData;
    }


    public function update($settingName, $settingValue)
    {
        $updateData = array('settingValue'=>$settingValue);
        $settingID = $this->getID($settingName);
        $this->db->where('settingID', $settingID);
        $this->db->update($this->settingTable, $updateData);
    }

    public function delete($photoID)
    {
        $this->db->delete($this->photoTable, array('photoID'=>$photoID));
    }
}
?>
