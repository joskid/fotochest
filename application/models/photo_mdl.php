<?php
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
        parent::CI_Model();
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
//
//    public function getPublicPhotoStreamPage($pageNum){
//        // Grab necessary information for each page of the public photo stream
//
//        // Increase the page number.
//
//        $pageNumMax = $pageNum + 21;
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
//        return $executeGetSQL;
//    }
    
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

    public function getPhotoCount(){
        $select = "Select * FROM $this->photoTable";
        $exe = $this->db->query($select);
        $num = $exe->num_rows();
        return $num;
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

    public function deletePhoto(){

        $fileName = $this->getFileName($this->photoID);
        $deleteSQL = "delete from $this->photoTable where photoID = $this->photoID";
        log_message('info', 'Query executed by Photo_mdl::deletePhoto ' . $deleteSQL);
        $this->db->query($deleteSQL);
        $buildFilePath = "./img_stor/albums/" . $this->photoAlbumName . "/";
        $thumb = $buildFilePath . "thumbs/" . $fileName;
        $orginal = $buildFilePath . "originals/" . $fileName;
        unlink($filename);

    }

    public function movePhoto(){

        // @todo Actually move the file...

        $photoInfo = $this->getPhotoInfo($this->photoID);
        foreach($photoInfo->result() as $row){
            $oldAlbumID = $row->photoAlbumID;
            $fileName = $row->photoFileName;
            
        }
        
        $albumInfo = $this->getAlbumDetails($oldAlbumID);
        foreach($albumInfo->result() as $oldAlbum){

            $oldAlbumName = $oldAlbum->albumName;
        }
        
        $newAlbumInfo = $this->getAlbumDetails($this->photoAlbumID);
        foreach($newAlbumInfo->result() as $newAlbum){
            
            $newAlbumName = $newAlbum->albumName;
            
        }

        //Move the thumb first.


        log_message('info', 'Moving thumbnail ' . $fileName);
        $thumbIsPath = $this->config->item('absoluteFilePath') . "img_stor/albums/" . $oldAlbumName . "/thumbs/" . $fileName;

        $thumbGoPath = $this->config->item('absoluteFilePath') . "img_stor/albums/" . $newAlbumName . '/thumbs/' . $fileName;

        rename($thumbIsPath, $thumbGoPath);

        // Time for the original....

        log_message('info', 'Moving original '. $fileName);

        $originalIsPath = $this->config->item('absoluteFilePath') . "img_stor/albums/" . $oldAlbumName . "/originals/" . $fileName;

        $originalGoPath = $this->config->item('absoluteFilePath') . "img_stor/albums/" . $newAlbumName . '/originals/' . $fileName;

        rename($originalIsPath, $originalGoPath);

        // Query tiem....

        $updateQuery = array('photoAlbumID'=>$this->photoAlbumID);

        $where = "photoID = $this->photoID";

        $updateString = $this->db->update_string( $this->photoTable, $updateQuery, $where);

        log_message('info', 'Query executed by Photo_mdl::movePhoto() ' . $updateString);
        $this->db->query($updateString);

    }

    public function getPhotoInfo($photoID){
        $getPhotoStreamSQL = "SELECT * FROM $this->photoTable, $this->albumTable WHERE photoAlbumID = albumID AND photoID = $photoID";
        log_message('info', 'Photo_mdl::getPhotoInfo() is executing a query ' . $getPhotoStreamSQL);
        $executeGetSQL = $this->db->query($getPhotoStreamSQL);
        return $executeGetSQL;
    }

    public function getProfilePicture(){
        $select = "SELECT * FROM $this->photoTable WHERE isProfilePic = 1";
        log_message('info', 'Photo_mdl::getProfilePicture() is executing a query ' . $select);
        $exe = $this->db->query($select);
        return $exe;
    }
    public function setProfilePicture($photoID){
        $updateData = array('isProfilePic'=>1);
        $where = "photoID = $photoID";
        $updateQuery = $this->db->update_string($this->photoTable, $updateData, $where);
        log_message('info', 'Photo_mdl::setProfilePicture executed a query ' . $updateQuery);
        $this->db->query($updateQuery);
    }

    




}
?>