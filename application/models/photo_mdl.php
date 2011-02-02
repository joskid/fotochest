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
* Photo Model
*
* @package		FotoChest
* @category		Model
* @author		Derek Stegelman
*/

class Photo_mdl extends CoreModel {

    public $photoAlbumID;  // ID of the Album that the photo belongs to.
    public $photoAlbumName;
    public $photoFileName;
    public $photoTitle;
    public $photoDesc;
    public $photoCreatedDate;
    public $photoID;
    public $photoTable;
    public $albumTable;
    public $isProfilePicture;

    
    public function __construct() {
        parent::__construct();
        $this->photoTable = $this->config->item('photoTable');
        $this->_table = $this->config->item('photoTable');
        $this->albumTable = $this->config->item('albumTable');
        log_message('info', 'loaded photo model');
    }
    /**
     * CRUD
     *
     *
     *
     *
     */

//    public function create()
//    {
////        $insertData = array(
////            'photoFileName'=>$this->photoFileName,
////            'photoTitle'=>$this->photoTitle,
////            'photoDesc'=>$this->photoDesc,
////            'photoCreatedDate'=>date("m/d/y"),
////            'photoAlbumID' =>$this->photoAlbumID,
////            'isProfilePic'=>0);
////        $this->db->insert($this->photoTable, $insertData);
//        //log_message('info', 'create on photo model is depreciated');
//        //show_error('create photo is depreciated, use core instead');
//    }
/**
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
**/
    /**
    public function readProfilePicture()
    {
        log_message('info', 'trying to get profile');
        $photoData = $this->db->get_where($this->photoTable, array('isProfilePic'=>1));
        return $photoData;
    }
**/

    public function update($photoID)
    {
//        $updateData = array(
//            'photoTitle'=>$this->photoTitle,
//            'photoDesc'=>$this->photoDesc,
//            'isProfilePic'=>$this->isProfilePicture);
//
//        $this->db->where('photoID', $photoID);
//        $this->db->update($this->photoTable, $updateData);
        log_message('info', 'update on photo model is depreciated');
        show_error('update photo is depreciated, use core instead');
    }

    public function delete($photoID)
    {
        //$this->db->delete($this->photoTable, array('photoID'=>$photoID));
        log_message('info', 'delete is derecieated.');
        show_error('delete photo is depreciated, use core instead');
    }


    
    public function getPublicPhotoStream($pageNum = 0){
//        if ($pageNum == 0)
//        {
//            //$getPhotoStreamSQL = "SELECT * FROM $this->photoTable, $this->albumTable
//            //    WHERE photoAlbumID = albumID ORDER BY $this->photoTable.id DESC LIMIT 0, 21";
//            $this->db->select('*');
//            $this->db->from($this->photoTable);
//            $this->db->join($this->albumTable, 'photoAlbumID = ' . $this->albumTable . '.id');
//            $this->db->order_by($this->photoTable . '.id', 'desc');
//            $this->db->limit(21, 0);
//            return $this->db->get();
//            log_message('debug', 'SQL Executed ' . $getPhotoStreamSQL);
//            //$executeGetSQL = $this->db->query($getPhotoStreamSQL);
//        }
//        else
//        {
//            $pageNumMax = $pageNum + 21;
//
//
//        $max_amount = $this->db->count_all($this->photoTable);
//        $getPhotoStreamSQL = "SELECT * FROM $this->photoTable, $this->albumTable
//            WHERE $this->photoTable.photoAlbumID = albumID ORDER BY $this->photoTable.photoID
//            DESC LIMIT $pageNum, 21";
//        log_message('info', 'Photo_mdl::getPublicPhotoStreamPage is executing a query ' . $getPhotoStreamSQL);
//
//        // Execute Query
//
//        $executeGetSQL = $this->db->query($getPhotoStreamSQL);
//        }
        log_message('info', 'Trying to execute query on public photo stream');
        $this->db->select('*, ' . $this->photoTable . '.id as photoID');
        $this->db->from($this->photoTable);
        $this->db->join($this->albumTable, 'photoAlbumID = ' . $this->albumTable . '.id');
        $this->db->order_by($this->photoTable . '.id', 'desc');
        $this->db->limit(21, $pageNum);
        return $this->db->get();
        //return $executeGetSQL;
    }

    public function getAdminPhotoStream($pageNum = 0){
        log_message('info', 'executing');
            $this->db->select('*, ' . $this->photoTable . '.id as photoID');
            $this->db->from($this->photoTable);
            $this->db->join($this->albumTable, $this->photoTable . '.photoAlbumID = ' . $this->albumTable . '.id');
            $this->db->order_by($this->photoTable . '.id', 'desc');
            $this->db->limit(10, $pageNum);
            return $this->db->get();
            
    }

    public function getAlbumPhotos($albumID){
        //$albumPhotosSQL = "SELECT * FROM $this->photoTable, $this->albumTable WHERE photoAlbumID = $albumID AND albumID = photoAlbumID GROUP BY photoID DESC LIMIT 21";
        log_message('info', 'Photo_mdl::getAlbumPhotos is executing a query ');
        $this->db->select('*');
        $this->db->from($this->photoTable);
        $this->db->join($this->albumTable, $this->albumTable . '.id = photoAlbumID');
        $this->db->where('photoAlbumID', $albumID);
        $this->db->group_by($this->photoTable . '.id', 'desc');
        $this->db->limit(21);
        return $this->db->get();
        //$photoResults = $this->db->query($albumPhotosSQL);
        //return $photoResults;
    }
    
    public function getAllAlbumPhotos($albumID){
        $this->db->select('*');
        $this->db->where('photoAlbumID', $albumID);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->photoTable);
//        $albumPhotosSQL = "SELECT * FROM $this->photoTable WHERE photoAlbumID = $albumID ORDER BY photoID DESC";
//        $photoResults = $this->db->query($albumPhotosSQL);
//        return $photoResults;
    }

    public function getAlbumPhotosPage($albumID, $photoStart){
        //$albumMax = $photoStart + 21;
         //$albumPhotosSQL = "SELECT * FROM $this->photoTable, $this->albumTable WHERE photoAlbumID = $albumID AND albumID = photoAlbumID GROUP BY photoID DESC LIMIT $photoStart, 21";
        $this->db->select('*');
        $this->db->from($this->photoTable);
        $this->db->join($this->albumTable, $this->albumTable . '.id = photoAlbumID');
        $this->db->where('photoAlbumID', $albumID);
        $this->db->group_by($this->photoTable . '.id', 'desc');
        $this->db->limit(21, $photoStart);
        return $this->db->get();
         //$photoResults = $this->db->query($albumPhotosSQL);
        //return $photoResults;
    }

    public function getAlbumDetails($albumID){
        //$selectAlbum = "SELECT * FROM $this->albumTable WHERE albumID = $albumID";
        $this->db->where('id', $albumID);
        return $this->db->get($this->albumTable);
//        log_message('info', 'Photo_mdl::getAlbumDetails() is executing a query ' .$selectAlbum);
//        $getAlbumInfo = $this->db->query($selectAlbum);
//        return $getAlbumInfo;

    }

    public function addPhoto(){
        log_message('info', 'add photo is depreciated, use core instead');
        show_error('add photo is depreciated, use core instead');
//        $insertData = array('photoTitle'=>$this->photoTitle, 'photoDesc'=>$this->photoDesc,
//            'photoFileName'=>$this->photoFileName, 'photoCreatedDate'=>$this->photoCreatedDate,
//            'photoAlbumID'=>$this->photoAlbumID);
//        $insertQuery = $this->db->insert_string($this->photoTable, $insertData);
//        log_message('info', 'Photo_mdl::addPhoto() is excuting a query ' . $insertQuery);
//        $this->db->query($insertQuery);
    }
    
    public function updatePhoto(){
        show_error('update photo (line 222) is depreciated, use core instead, library needs to take over some of these duties.');
        log_message('ERROR', 'update photo (line 222) is depreciated, use core instead, library needs to take over some of these duties.');
//        if ($this->isProfilePicture == 1){
//            // Clear out the DB.
//
//            $clear = "UPDATE $this->photoTable SET isProfilePic = 0 WHERE isProfilePic = 1";
//            log_message('info', 'Photo_mdl::updatePhoto() is excuting a query ' . $clear);
//            $this->db->query($clear);
//        }
//
//        $updateData = array('photoTitle'=>$this->photoTitle, 'photoDesc'=>$this->photoDesc,
//                            'photoAlbumID'=>$this->photoAlbumID, 'isProfilePic'=>$this->isProfilePicture);
//        $where = "photoID = $this->photoID";
//        $updateQuery = $this->db->update_string($this->photoTable, $updateData, $where);
//
//        log_message('info', 'Query executed by Photo_mdl::updatePhoto() ' . $updateQuery);
//        $this->db->query($updateQuery);
    }

    public function getPhotoInfo($photoID)
    {
        $this->db->select('*, ' . $this->photoTable . '.id as photoID');
        $this->db->from($this->photoTable);
        $this->db->join($this->albumTable, 'photoAlbumID = ' . $this->albumTable . '.id');
        $this->db->where($this->photoTable . '.id', $photoID);
        return $this->db->get();
    }

}
?>