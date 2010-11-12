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


/*
* FotoChest - a web based photo album
* Copyright (C) 2009-2010 Derek Stegelman http://stegelman.com
*
 * @todo several functions can be combined./CRUD
 *
 * Last updated October 27 2010
 *
*/


class Photo_mdl extends CI_Model {

    var $photoAlbumID;  // ID of the Album that the photo belongs to.
    var $photoAlbumName;
    var $photoFileName;
    var $photoTitle;
    var $photoDesc;
    var $photoCreatedDate;
    var $photoID;
    var $photoTable;
    var $albumTable;
    var $isProfilePicture;

    
    public function __construct() {
        parent::__construct();
        $this->photoTable = $this->config->item('photoTable');
        $this->albumTable = $this->config->item('albumTable');    
    }
    /**
     * CRUD
     *
     *
     *
     *
     */

    public function create()
    {
        $insertData = array(
            'photoFileName'=>$this->photoFileName,
            'photoTitle'=>$this->photoTitle,
            'photoDesc'=>$this->photoDesc,
            'photoCreatedDate'=>date("m/d/y"),
            'photoAlbumID' =>$this->photoAlbumID,
            'isProfilePic'=>0);
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

    public function readProfilePicture()
    {
        $photoData = $this->db->get_where($this->photoTable, array('isProfilePic'=>1));
        return $photoData;
    }


    public function update($photoID, $updateData)
    {
        
        $this->db->where('photoID', $photoID);
        $this->db->update($this->photoTable, $updateData);
    }

    public function delete($photoID)
    {
        $this->db->delete($this->photoTable, array('photoID'=>$photoID));
    }


    
    public function getPublicPhotoStream($pageNum = 0){
        if ($pageNum == 0)
        {
            $getPhotoStreamSQL = "SELECT * FROM $this->photoTable, $this->albumTable
                WHERE photoAlbumID = albumID ORDER BY photoID DESC LIMIT 0, 21";
            log_message('debug', 'SQL Executed ' . $getPhotoStreamSQL);
            $executeGetSQL = $this->db->query($getPhotoStreamSQL);
        }
        else
        {
            $pageNumMax = $pageNum + 21;


        $max_amount = $this->db->count_all($this->photoTable);
        $getPhotoStreamSQL = "SELECT * FROM $this->photoTable, $this->albumTable
            WHERE $this->photoTable.photoAlbumID = albumID ORDER BY $this->photoTable.photoID
            DESC LIMIT $pageNum, 21";
        log_message('info', 'Photo_mdl::getPublicPhotoStreamPage is executing a query ' . $getPhotoStreamSQL);

        // Execute Query

        $executeGetSQL = $this->db->query($getPhotoStreamSQL);
        }

        return $executeGetSQL;
    }

    
    public function getAdminPhotoStream($pageNum){
        if ($pageNum == 0){
            $select = "SELECT * FROM $this->photoTable, $this->albumTable
            WHERE photoAlbumID = albumID ORDER BY photoID DESC LIMIT 0, 10";
            
        } else {
            $select = "SELECT * FROM $this->photoTable, $this->albumTable
            WHERE photoAlbumID = albumID ORDER BY photoID DESC LIMIT $pageNum, 10";
        }
        
        $executeSql = $this->db->query($select);
            return $executeSql;
        
    }

    public function getAlbumPhotos($albumID){
        $albumPhotosSQL = "SELECT * FROM $this->photoTable, $this->albumTable WHERE photoAlbumID = $albumID AND albumID = photoAlbumID GROUP BY photoID DESC LIMIT 21";
        log_message('info', 'Photo_mdl::getAlbumPhotos is executing a query ' . $albumPhotosSQL);
        $photoResults = $this->db->query($albumPhotosSQL);
        return $photoResults;
    }
    
    public function getAllAlbumPhotos($albumID){
        $albumPhotosSQL = "SELECT * FROM $this->photoTable WHERE photoAlbumID = $albumID ORDER BY photoID DESC";
        $photoResults = $this->db->query($albumPhotosSQL);
        return $photoResults;
    }

    public function getAlbumPhotosPage($albumID, $photoStart){
        $albumMax = $photoStart + 21;
         $albumPhotosSQL = "SELECT * FROM $this->photoTable, $this->albumTable WHERE photoAlbumID = $albumID AND albumID = photoAlbumID GROUP BY photoID DESC LIMIT $photoStart, 21";
        $photoResults = $this->db->query($albumPhotosSQL);
        return $photoResults;
    }

    
      

    public function getAlbumDetails($albumID){

        $selectAlbum = "SELECT * FROM $this->albumTable WHERE albumID = $albumID";
        log_message('info', 'Photo_mdl::getAlbumDetails() is executing a query ' .$selectAlbum);
        $getAlbumInfo = $this->db->query($selectAlbum);
        return $getAlbumInfo;

    }


    public function addPhoto(){
        
        $insertData = array('photoTitle'=>$this->photoTitle, 'photoDesc'=>$this->photoDesc,
            'photoFileName'=>$this->photoFileName, 'photoCreatedDate'=>$this->photoCreatedDate,
            'photoAlbumID'=>$this->photoAlbumID);
        $insertQuery = $this->db->insert_string($this->photoTable, $insertData);
        log_message('info', 'Photo_mdl::addPhoto() is excuting a query ' . $insertQuery);
        $this->db->query($insertQuery);
    }
    
    public function updatePhoto(){

        if ($this->isProfilePicture == 1){
            // Clear out the DB.

            $clear = "UPDATE $this->photoTable SET isProfilePic = 0 WHERE isProfilePic = 1";
            log_message('info', 'Photo_mdl::updatePhoto() is excuting a query ' . $clear);
            $this->db->query($clear);
        }

        $updateData = array('photoTitle'=>$this->photoTitle, 'photoDesc'=>$this->photoDesc,
                            'photoAlbumID'=>$this->photoAlbumID, 'isProfilePic'=>$this->isProfilePicture);
        $where = "photoID = $this->photoID";
        $updateQuery = $this->db->update_string($this->photoTable, $updateData, $where);

        log_message('info', 'Query executed by Photo_mdl::updatePhoto() ' . $updateQuery);
        $this->db->query($updateQuery);
    }

    public function getPhotoInfo($photoID){
        $getPhotoStreamSQL = "SELECT * FROM $this->photoTable, $this->albumTable WHERE photoAlbumID = albumID AND photoID = $photoID";
        log_message('info', 'Photo_mdl::getPhotoInfo() is executing a query ' . $getPhotoStreamSQL);
        $executeGetSQL = $this->db->query($getPhotoStreamSQL);
        return $executeGetSQL;
    }

}
?>