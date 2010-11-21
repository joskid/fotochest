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
* Photo Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/
/*
* FotoChest - a web based photo album
* Copyright (C) 2009-2010 Derek Stegelman http://stegelman.com
* @package FotoCore
* @subpackage PhotoMgmt
* @author Derek Stegelman
*
* Modified on Oct 18 2010
*
*
*/
class Photos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Photo_mdl');
        $this->load->model('Album_mdl');
        $this->data['title'] = getSetting('siteName') . "'s Photos";     
    }

    public function index(){

        // For each loop
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'photos/page/';
        $config['total_rows'] = $this->db->count_all($this->config->item('photoTable'));
        $config['per_page'] = '21';
        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->data['totalPhotos'] = $this->db->count_all($this->config->item('photoTable'));
        $this->data['photoData'] = $this->Photo_mdl->getPublicPhotoStream();
        
        // Build the Theme
        //$this->load->view(getFullThemePath() . 'photoStream', $this->data);

        $this->template->write('title', 'This page was built by the template engine');
        $this->template->write_view('navigation', 'navigation', $this->data);
        $this->template->write_view('content', 'stream', $this->data);
        $this->template->render();
    }

    public function stream()
    {
        // For each loop
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'photos/page/';
        $config['total_rows'] = $this->db->count_all($this->config->item('photoTable'));
        $config['per_page'] = '21';
        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->data['totalPhotos'] = $this->db->count_all($this->config->item('photoTable'));
        $this->data['photoData'] = $this->Photo_mdl->getPublicPhotoStream();

        // Build the Theme
        //$this->load->view(getFullThemePath() . 'photoStream', $this->data);
        $this->template->write('title', 'This page is built by the template engine');
        $this->template->write_view('content', 'stream', $this->data);
        $this->template->write_view('navigation', 'navigation', $this->data);
        $this->template->render();
    }

    public function slideshow($albumName){

        if (!isset($albumName) || is_numeric($albumName) == TRUE){
            show_404();
        }

        $albumID = getAlbumID($albumName);
        $this->data['photoInfo'] = $this->Photo_mdl->getAllAlbumPhotos($albumID);
        $this->data['albumName'] = $albumName;
        $this->data['title'] = getAlbumFriendlyName($albumID) . " slideshow";
        $this->load->view(getFullThemePath() . 'slideshow', $this->data);
    }

    public function page($pageNum){
                // Load the photo data
        if (!is_numeric($pageNum) || empty($pageNum)){
            show_404();
        }

        // For each loop
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'photos/page/';
        $config['total_rows'] = $this->db->count_all($this->config->item('photoTable'));
        $config['per_page'] = '21';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->data['totalPhotos'] = $this->db->count_all($this->config->item('photoTable'));
        $this->data['photoData'] = $this->Photo_mdl->getPublicPhotoStream($pageNum);


        //$this->load->view(getFullThemePath() . 'photoStream', $this->data);

        $this->template->write('title', 'Stream built by the template engine.');
        $this->template->write_view('navigation', 'navigation', $this->data);
        $this->template->write_view('content', 'stream', $this->data);
        $this->template->render();
    }

    public function view($albumName,$photoID){

        if (!is_numeric($photoID) || empty($albumName) || empty($photoID) || !checkPhoto($photoID, $albumName)){
            show_404();
        } else {
        
        $this->load->model('Comments_mdl');
        
        $this->data['comments'] = $this->Comments_mdl->getComments($photoID);
        $this->data['photoInfo'] = $this->Photo_mdl->getPhotoInfo($photoID);
        $this->load->library('album_lib');
        
        $this->data['albumNameURL'] = $albumName;
        $this->data['photoID'] = $photoID;
        // Get the exif data
        $photoURL = ('./img_stor/albums/' . $albumName . '/originals/' . getPhotoFileName($photoID) );
        $exif_data = exif_read_data( $photoURL );
        $this->data['photoEXIF'] = $exif_data;
        
        $this->data['title'] = getPhotoTitle($photoID);
        
        //$this->load->view(getFullThemePath() . 'photo', $this->data);

        $this->template->write('title', getPhotoTitle($photoID));
        $this->template->write_view('navigation', 'photoNavigation', $this->data);
        $this->template->write_view('content', 'singlePhoto', $this->data);
        $this->template->render();

        }
    }

    public function addNoAlbum()
    {
        $this->load->view('admin/modals/chooseAlbum', $this->data);
    }

  

}
?>