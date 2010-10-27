<?php
/*
* FotoChest - a web based photo album
* Copyright (C) 2009-2010 Derek Stegelman http://stegelman.com
* @package FotoCore
* @subpackage PhotoMgmt
* @author Derek Stegelman
*
* Modified on Oct 26 2010
*
*
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
        parent::CI_Model();
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

    public function update($albumID)
    {
        $albumData = array('albumName'=>$this->albumName, 'albumParentID'=>$this->albumParentID,
                           'albumDesc'=>$this->albumDesc, 'albumFriendlyName'=>$this->albumFriendlyName);
        $this->db->where('albumID', $albumID);
        $this->db->update($this->albumTable, $albumData);
    }

    public function delete($albumID)
    {
        $this->db->delete($this->albumTable, array('albumID'=>$albumID));
    }




    

    /*****************************************************
     *
     *
     *  addPhotoAlbum - Adds a photo to a specific album.
     *  Mostly just executes a query to add it to the db.
     *
     *  Params: $photoID (The id of the actual photo),
     *  $albumID: Id of the album to add it to.
     *
     *  Returns null
     * **************************************************
     */

    public function addPhotoAlbum($photoID, $albumID){

        log_message('info', 'Adding photo:' . $photoID . " to album ID: " . $albumID);
        $addPhotoData = array('photoAlbumID'=>$albumID);
        $where = "photoID = $photoID";
        $updateString = $this->db->update_string($this->photoTable, $addPhotoData, $where);
        log_message('info', 'Album_mdl::addPhotoAlbum() is executing a query ' . $updateString);
        $this->db->query($updateString);
    }

   

    public function getTotalAlbumCount(){

        $select = "SELECT * FROM $this->albumTable";
        $exe = $this->db->query($select);
        log_message('info', 'Album_mdl::getTotalAlbumCount() is executing a query ' . $select);
        $count = $exe->num_rows();
        return $count;

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
    public function getAlbums($parent){

        //$selectAlbums = "SELECT * FROM $this->albumTable, $this->photoTable WHERE albumParentID = $parent and photoAlbumID = albumID GROUP BY albumName";
        $selectAlbums = "SELECT * FROM $this->albumTable WHERE albumParentID = $parent";
        log_message('info', 'Album_mdl::getAlbums() is executing a query ' . $selectAlbums);
        $getAlbumInfo = $this->db->query($selectAlbums);
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

    public function getAlbumInfo($albumID){
        $selectAlbum = "SELECT * FROM $this->albumTable WHERE albumID = $albumID";
        log_message('info', 'Album_mdl::getAlbumInfo() is executing a query ' . $selectAlbum);
        $exe = $this->db->query($selectAlbum);
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
    
	
    public function getNumAlbums(){
        $select = "SELECT * FROM $this->albumTable";
        $execute = $this->db->query($select);
        $count = $execute->num_rows();
        return $count;
    }

    public function getAlbumByName($albumName)
    {
        $selectSQL = "SELECT * FROM $this->albumTable WHERE albumName = '$albumName'";
        $albumInfo = $this->db->query($selectSQL);
        return $albumInfo;
    }

    public function getAllAlbums(){
        $selectAlbums = "SELECT * FROM $this->albumTable";
        $getAlbumInfo = $this->db->query($selectAlbums);
        return $getAlbumInfo;
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
    
//    public function getProfilePhoto(){
//        $getPhoto = "SELECT * FROM $this->photoTable, $this->albumTable WHERE photoLibrary.photoAlbumID = photoAlbums.albumID AND photoLibrary.photoID = 1";
//        $photo = $this->db->query($getPhoto);
//        $checkForNull = $photo->num_rows();
//        if ($checkForNull != 0){
//            foreach($photo->result() as $row){
//                $albumName = $row->albumName;
//                $fileName = $row->photoFileName;
//            }
//            $photoURL = base_url() . "/img_stor/albums/" . $albumName . "/thumbs/" . $fileName;
//            return $photoURL;
//        } else {
//            return FALSE;
//        }
//
//    }
}
?>