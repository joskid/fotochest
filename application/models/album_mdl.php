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


class Album_mdl extends CoreModel {

    // Establish publiciables

    public $albumName;
    public $albumCreateDate;
    public $id;
    public $albumParentID;
    public $albumDesc;
    public $albumFriendlyName;
    public $photoTable;

    public function __construct(){
        parent::__construct();
        $this->photoTable = $this->config->item('photoTable');
        $this->_table = $this->config->item('albumTable');
        $this->albumTable = $this->_table;
    }

    /**
     *
     * CRUD operations
     *
     *
     */
	
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
    
    public function getAlbumThumbnails($albumID, $numOfThumbs = 3)
    {
        $this->db->select('*');
        $this->db->from($this->albumTable);
        $this->db->join($this->photoTable, $this->photoTable . '.photoAlbumID = ' . $this->albumTable . '.id');
        $this->db->where($this->photoTable . '.photoAlbumID', $albumID);
        $this->db->group_by($this->photoTable . '.id');
        $this->db->limit($numOfThumbs);
        return $this->db->get();
//        $select = "SELECT * FROM $this->albumTable, $this->photoTable WHERE photoAlbumID = $albumID AND albumID = photoAlbumID group by photoID limit $numOfThumbs";
//        log_message('info', 'getAlbumThumnails:: ' . $select);
//        $exe = $this->db->query($select);
//        return $exe;
    }
    /*
	// @todo this should be added to core.  Get count by x.
    public function getAlbumCount($albumID){
        $select = "SELECT * FROM $this->photoTable WHERE photoAlbumID = $albumID";
        $exe = $this->db->query($select);
        $count = $exe->num_rows();
        return $count;
    }
    */
    // @todo This should be able to use core. 
    public function updateAlbum(){
        $updateData = array('albumFriendlyName'=>$this->albumFriendlyName, 'albumDesc'=>$this->albumDesc);
        $where = "albumID = $this->albumID";
        
        $updateQuery = $this->db->update_string($this->albumTable, $updateData, $where);
        log_message('info', 'Album_mdl::updateAlbum() is executing a query ' . $updateQuery);
        $this->db->query($updateQuery);
    }
    
	// @todo this can use the core.
    public function getAlbumByName($albumName)
    {
        $selectSQL = "SELECT * FROM $this->albumTable WHERE albumName = '$albumName'";
        $albumInfo = $this->db->query($selectSQL);
        return $albumInfo;
    }


    /**
     * getAlbumAdminInfo
     *
     * @access Public
     * @author Derek Stegelman
     * @param int $pageNum
     * @return array of data
     */

    public function getAlbumAdminInfo($pageNum = 0)
    {
        $this->db->select('*');
        $this->db->from($this->albumTable);
        $this->db->limit(5, $pageNum);
        return $this->db->get();

    }

    /**
    public function getAlbumAdminInfo($pageNum = 0){
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
  
DEPRECIATED **/
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