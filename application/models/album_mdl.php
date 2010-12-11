<?php

/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.0
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright		2010 FotoChest
*/

// ----------------------------------------------------------------

/**
* Album Model
*
* @package		FotoChest
* @category		Model
* @author		Derek Stegelman
*/


class Album_mdl extends CI_Model {

    // Establish Variables

    var $albumName;
    var $albumCreateDate;
    var $albumID;
    var $albumParentID;
    var $albumDesc;
    var $albumFriendlyName;
    var $albumTable;
    var $photoTable;

    public function __construct(){
        parent::__construct();
        $this->photoTable = $this->config->item('photoTable');
        $this->albumTable = $this->config->item('albumTable');
    }

    /**
     *
     * CRUD operations
     *
     *
     */

    public function create()
    {
        $albumData = array('albumName'=>$this->albumName, 'albumCreateDate'=>date("m/y/d"), 'albumParentID'=>$this->albumParentID,
                           'albumDesc'=>$this->albumDesc, 'albumFriendlyName'=>$this->albumFriendlyName);
        $this->db->insert($this->albumTable, $albumData);
    }


    public function read($albumID = null)
    {
        if ($albumID == null)
        {
            $readData = $this->db->get($this->albumTable);
        }
        else
        {
            $readData = $this->db->get_where($this->albumTable, array('albumID'=>$albumID));
        }
        return $readData;
    }

    public function update($albumID, $albumData)
    {
        
        $this->db->where('albumID', $albumID);
        $this->db->update($this->albumTable, $albumData);
    }

    public function delete($albumID)
    {
        $this->db->delete($this->albumTable, array('albumID'=>$albumID));
    }

    public function exists($albumName)
    {
        $albums = $this->db->where('albumName', $albumName)
                           ->get($this->albumTable);
        if($albums->num_rows != 0)
        {
            return true;

        }
        else
        {
            return false;
        }
    }


    /*************************************************
     *
     *  getAlbums()
     *  Params: None;
     *  Returns: an array of all the albums and their information.
     *
     *
     * ************************************************
     */
    public function getAlbums($parent, $pageNum = null, $perPage = null){

        
        $getAlbumInfo = $this->db->get_where($this->albumTable, array('albumParentID'=>$parent), $perPage, $pageNum);
        return $getAlbumInfo;
    }




   
    public function findChildID($albumID){
        $select = "SELECT * FROM $this->albumTable WHERE albumParentID = $albumID LIMIT 1";
        log_message('info', 'fineChildID:: ' . $select);
        $exe = $this->db->query($select);
        if($exe->num_rows() == 0)
        {
            return 0;

        }
        else {
            foreach($exe->result() as $row){
                $childID = $row->albumID;
            }
            return $childID;
        }
    }
    

    public function getAlbumThumbnails($albumID, $numOfThumbs = 3){
        $select = "SELECT * FROM $this->albumTable, $this->photoTable WHERE photoAlbumID = $albumID AND albumID = photoAlbumID group by photoID limit $numOfThumbs";
        log_message('info', 'getAlbumThumnails:: ' . $select);
        $exe = $this->db->query($select);
        return $exe;
    }

    
    
    public function getAlbumCount($albumID){
        $select = "SELECT * FROM $this->photoTable WHERE photoAlbumID = $albumID";
        $exe = $this->db->query($select);
        $count = $exe->num_rows();
        return $count;
    }
    
    public function updateAlbum(){
        $updateData = array('albumFriendlyName'=>$this->albumFriendlyName, 'albumDesc'=>$this->albumDesc);
        $where = "albumID = $this->albumID";
        
        $updateQuery = $this->db->update_string($this->albumTable, $updateData, $where);
        log_message('info', 'Album_mdl::updateAlbum() is executing a query ' . $updateQuery);
        $this->db->query($updateQuery);
    }
    
	
    

    public function getAlbumByName($albumName)
    {
        $selectSQL = "SELECT * FROM $this->albumTable WHERE albumName = '$albumName'";
        $albumInfo = $this->db->query($selectSQL);
        return $albumInfo;
    }

    
    public function getAlbumAdminInfo($pageNum){
        if ($pageNum == 0){
        $selectSQL = "SELECT albumID, albumFriendlyName, albumDesc, albumName, albumParentID
        FROM $this->albumTable
         LIMIT 5";
	} else {

            $selectSQL = "SELECT albumID, albumFriendlyName, albumDesc, albumName, albumParentID
        FROM $this->albumTable
         LIMIT $pageNum, 5";
	}
        $getInfo = $this->db->query($selectSQL);
        return $getInfo;   
    }
  

    /**
     *
     * @param string $albumName
     * @return boolean
     *
     * Indicates if this album has children or not..
     *
     */
    public function hasChildren($albumName){
        $albumID = getAlbumID($albumName);

        $albums = "SELECT * FROM $this->albumTable where albumParentID = $albumID";

        $childAlbums  = $this->db->query($albums);
        if ($childAlbums->num_rows == 0){
            return false;
        } else
        {
            return true;
        }
    }
    
}
?>