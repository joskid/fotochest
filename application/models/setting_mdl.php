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
* Album Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/
class Setting_mdl extends CI_Model {

    var $settingID;
    var $settingName;
    var $settingValue;
    var $settingTable;

    public function  __construct() {
        parent::__construct();
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
