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
* Album Admin Controller
*
* @package		FotoChest
* @category		Admin Controllers
* @author		Derek Stegelman
*/


class Albums extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Album_mdl');
        $this->load->model('Photo_mdl');
    }

    public function createAlbum(){

// @todo mov ethis
        // Load the Library
        $this->load->library('album_lib');
        $this->album_lib->albumName = $this->input->post('albumName');
        $this->album_lib->albumFriendlyName = $this->input->post('albumFriendlyName');
        $this->album_lib->albumParentID = $this->input->post('albumID');
        $this->album_lib->createAlbum();
    }



    public function saveAlbum(){

        // @todo move this.

        $this->Album_mdl->albumFriendlyName = $this->input->post('albumFriendlyName');
        $this->Album_mdl->albumID = $this->input->post('albumID');
        $this->Album_mdl->albumDesc = $this->input->post('albumDesc');
        $this->Album_mdl->updateAlbum();
    }

    public function editAlbum($albumID){

        $this->data['albumData'] = $this->Album_mdl->read($albumID);


        $this->load->view('admin/modals/editAlbum', $this->data);
    }

    public function deleteAlbum($albumID){

      $this->data['albumID'] = $albumID;
        $this->load->view('admin/modals/deleteAlbum', $this->data);
    }

    public function do_delete(){

        // @todo remoe this.
        $albumID = $this->input->post('albumID');

      $path = getSetting('absolutePath');
      $this->Album_mdl->deleteAlbum($albumID, $path);

    }


    public function albumsView($pageNum = 0){

        //@todo pagination should point back here?

        // Load the Library
        $this->load->library('album_lib');


        $this->data['albums'] = $this->Album_mdl->getAlbumAdminInfo($pageNum);
	$this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/albums/';
        $config['total_rows'] = $this->album_lib->getTotalAlbumCount();
        $config['per_page'] = '5';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->load->view('admin/viewAlbums', $this->data);

    }
    // End Album Functions

    // Begin photo functions

    // Refactor so that we don't need two methods for the intial page and then pages after that...


//    public function albumsPage($pageNum = 0){
//
//        $this->data['albums'] = $this->Album_mdl->getAlbumAdminInfo($pageNum);
//        $this->load->library('pagination');
//
//        $config['base_url'] = base_url() . 'admin/albumsPage/';
//        $config['total_rows'] = getAlbumCount();
//        $config['per_page'] = '5';
//
//        $this->pagination->initialize($config);
//
//        $this->data['pages'] =  $this->pagination->create_links();
//	$this->load->view('admin/viewAlbums', $this->data);
//	}

    public function viewAlbum($albumName){
        $albumID = getAlbumID($albumName);
        // Load the library
        $this->load->library('photo_lib');

        // Call the method
        $this->data['photos'] = $this->Photo_mdl->getAlbumPhotos($albumID);
        $this->data['allAlbums'] = $this->Album_mdl->read();
        $this->data['albumName'] = $albumName;
        $this->data['albumID'] = $albumID;
        $this->data['albumFriendlyName'] = getAlbumFriendlyName($albumID);

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/viewAlbumPage/' . $albumName;
        $config['total_rows'] = $this->Album_mdl->getAlbumCount($albumID);
        $config['per_page'] = '21';
        $config['uri_segment'] = 4;
        $this->pagination->initialize($config);
        $this->data['pages'] =  $this->pagination->create_links();
        $this->load->view('admin/viewSingleAlbum', $this->data);
    }

    // May delete this method later.

    public function viewAlbumPage($albumName, $albumPage){

      $albumID = $this->Photo_mdl->getAlbumID($albumName);
      $this->data['photos'] = $this->Photo_mdl->getAlbumPhotosPage($albumID, $albumPage);
      $this->data['allAlbums'] = $this->Album_mdl->getAllAlbums();
        $this->data['albumName'] = $albumName;
        $this->data['albumFriendlyName'] = $this->Album_mdl->getAlbumFriendlyName($albumID);
      $this->load->library('pagination');
      $albumCount = $this->Album_mdl->getAlbumCount($albumID);

        $config['base_url'] = base_url() . 'admin/viewAlbumPage/' . $albumName . '/';
        $config['total_rows'] = $albumCount;
        $config['per_page'] = '21';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
      $this->load->view('admin/viewSingleAlbum', $this->data);
    }

    public function addAlbum(){


        $this->load->view('admin/modals/addAlbum');
    }

    
}
?>
