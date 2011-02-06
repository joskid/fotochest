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


class Albums extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->data['pageNum'] = 2;
        $this->data['showUserButton'] = FALSE;
        $this->template->write_view('navigation', 'admin/partials/nav', $this->data);
    }

    public function createAlbum(){
        // Load the Library
        $this->load->library('album');
        $this->album->albumName = str_replace(" ", "-", $this->input->post('albumName'));
        $this->album->albumFriendlyName = $this->input->post('albumFriendlyName');
        $this->album->albumParentID = $this->input->post('albumID');
        $this->album->createAlbum();
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


        $this->data['showAlbum'] = TRUE;
        

        // Load the Library
        $this->load->library('album');


        $this->data['albums'] = $this->Album_mdl->getAlbumAdminInfo($pageNum);
	$this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/albums/';
        $config['total_rows'] = $this->album->getTotalAlbumCount();
        $config['per_page'] = '5';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->template->write('title', 'Albums');
        
        $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
        $this->template->write_view('content', 'admin/partials/albums', $this->data);
        $this->template->render();

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
        log_message('info', 'got album id ' . $albumID);


        $this->data['showAlbum'] = FALSE;
        

        // Call the method
        $this->data['photos'] = $this->Photo_mdl->getAlbumPhotos($albumID);
        $this->data['allAlbums'] = $this->Album_mdl->get();
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

        // Write the view
        $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
        $this->template->write_view('content', 'admin/partials/singleAlbum', $this->data);
        $this->template->render();
    }

    // May delete this method later.

    public function viewAlbumPage($albumName, $albumPage){

      $albumID = $this->Photo_mdl->getAlbumID($albumName);
       $this->data['showAlbum'] = FALSE;
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
      $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
        $this->template->write_view('content', 'admin/partials/singleAlbum', $this->data);
        $this->template->render();
    }

    public function addAlbum(){


        $this->load->view('admin/modals/addAlbum');
    }

    
}
?>
