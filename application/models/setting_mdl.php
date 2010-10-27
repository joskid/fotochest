<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of setting_mdl
 *
 * @author derek
 */
class Setting_mdl extends CI_Model {

    var $settingID;
    var $settingName;
    var $settingValue;
    var $settingTable;

    public function  __construct() {
        parent::CI_Model();
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

    public function read($photoID = null)
    {
        if ($photoID == null)
        {
            $photoData = $this->db->get($this->photoTable);
        }
        else
        {
            $photoData = $this->db->get_where($this->photoTable, array('photoID'=>$photoID));
        }
        return $photoData;
    }

    public function update($photoID)
    {
        $updateData = array('photoAlbumName'=>$this->photoAlbumName,
            'photoFileName'=>$this->photoFileName,
            'photoTitle'=>$this->photoTitle,
            'photoDesc'=>$this->photoDesc,
            'isProfilePicture'=>$this->isProfilePicture);
        $this->db->where('photoID', $photoID);
        $this->db->update($this->photoTable, $updateData);
    }

    public function delete($photoID)
    {
        $this->db->delete($this->photoTable, array('photoID'=>$photoID));
    }
}
?>
