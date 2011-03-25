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

    
    public function __construct()
    {
        parent::__construct();
        $this->photoTable = $this->config->item('photoTable');
        $this->_table = $this->config->item('photoTable');
        $this->albumTable = $this->config->item('albumTable');
        log_message('info', 'loaded photo model');
    }

    public function getPublicPhotoStream($pageNum = 0)
    {

        log_message('info', 'Trying to execute query on public photo stream');
        $this->db->select('*, ' . $this->photoTable . '.id as photoID');
        $this->db->from($this->photoTable);
        $this->db->join($this->albumTable, 'photoAlbumID = ' . $this->albumTable . '.id');
        $this->db->order_by($this->photoTable . '.id', 'desc');
        $this->db->limit(21, $pageNum);
        return $this->db->get();
    }

    public function getAdminPhotoStream($pageNum = 0)
    {
        log_message('info', 'executing');
            $this->db->select('*, ' . $this->photoTable . '.id as photoID');
            $this->db->from($this->photoTable);
            $this->db->join($this->albumTable, $this->photoTable . '.photoAlbumID = ' . $this->albumTable . '.id');
            $this->db->order_by($this->photoTable . '.id', 'desc');
            $this->db->limit(10, $pageNum);
            return $this->db->get();
            
    }

    public function getAlbumPhotos($albumID)
    {
        
        log_message('info', 'Photo_mdl::getAlbumPhotos is executing a query ');
        $this->db->select('*, '.$this->photoTable.'.id as photoID');
        $this->db->from($this->photoTable);
        $this->db->join($this->albumTable, $this->albumTable . '.id = photoAlbumID');
        $this->db->where('photoAlbumID', $albumID);
        $this->db->group_by($this->photoTable . '.id');
        $this->db->order_by($this->photoTable . '.id', 'desc');
        $this->db->limit(21);
        return $this->db->get();

    }
    
    public function getAllAlbumPhotos($albumID)
    {
        $this->db->select('*');
        $this->db->where('photoAlbumID', $albumID);
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->photoTable);

    }

    public function getAlbumPhotosPage($albumID, $photoStart)
    {
       
        $this->db->select('*');
        $this->db->from($this->photoTable);
        $this->db->join($this->albumTable, $this->albumTable . '.id = photoAlbumID');
        $this->db->where('photoAlbumID', $albumID);
        $this->db->group_by($this->photoTable . '.id', 'desc');
        $this->db->limit(21, $photoStart);
        return $this->db->get();

    }

    public function getAlbumDetails($albumID)
    {
        
        $this->db->where('id', $albumID);
        return $this->db->get($this->albumTable);

    }

    public function addPhoto()
    {
        log_message('info', 'add photo is depreciated, use core instead');
        show_error('add photo is depreciated, use core instead');
//        $insertData = array('photoTitle'=>$this->photoTitle, 'photoDesc'=>$this->photoDesc,
//            'photoFileName'=>$this->photoFileName, 'photoCreatedDate'=>$this->photoCreatedDate,
//            'photoAlbumID'=>$this->photoAlbumID);
//        $insertQuery = $this->db->insert_string($this->photoTable, $insertData);
//        log_message('info', 'Photo_mdl::addPhoto() is excuting a query ' . $insertQuery);
//        $this->db->query($insertQuery);
    }
    
    public function updatePhoto()
    {
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