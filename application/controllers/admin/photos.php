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
* Admin Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/

class Photos extends MY_Controller {

    public function  __construct()
    {
        parent::__construct();
    }

    public function test()
    {
        $this->load->view('admin/userLogin');
    }

    public function savePhoto(){
      // @todo Move this...

        log_message('debug','Save Photo Method hit');

        $this->Photo_mdl->photoID = $this->input->post('photoID');
        $this->Photo_mdl->photoAlbumID = $this->input->post('albumID');
        $this->Photo_mdl->photoTitle = $this->input->post('photoTitle');
        $this->Photo_mdl->photoDesc = $this->input->post('photoDesc');
        if ($this->input->post('makeProfile') == 'on'){
            $makeProfilePicture = 1;
        } else {
            $makeProfilePicture = 0;
        }
        $this->Photo_mdl->isProfilePicture = $makeProfilePicture;
        log_message('info', 'admin::savePhoto has set isProfilePicture to ' . $this->Photo_mdl->isProfilePicture);
        log_message('debug','photo vars set');
        $this->Photo_mdl->updatePhoto();
        log_message('debug','Photo update complete');
    }

    public function index(){

        $this->data['photos'] = $this->Photo_mdl->getAdminPhotoStream(0);

        // Pagination

        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'admin/photos/';
        $config['total_rows'] = $this->db->count_all($this->config->item('photoTable'));
        $config['per_page'] = '5';
        $this->pagination->initialize($config);
        $this->data['pages'] =  $this->pagination->create_links();

        //Load the view.

        $this->load->view('admin/dashboard', $this->data);
    }

    function do_photoDelete(){

        // @todo move this

      $this->Photo_mdl->photoID = $this->input->post('photoID');
      $this->Photo_mdl->deletePhoto();
    }

    public function photos($pageNum){

        $this->data['photos'] = $this->Photo_mdl->getAdminPhotoStream($pageNum);


        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/photos/';
        $config['total_rows'] = $this->db->count_all($this->config->item('photoTable'));
        $config['per_page'] = '5';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->load->view('admin/dashboard', $this->data);
    }

    public function photoUpload($albumID){

        // @todo photo Upload or MultiUpload which one is it?

        $this->data['albumID'] = $albumID;
        $this->load->view('admin/photoUpload', $this->data);
    }




    public function multiUpload(){

         // Depecrated...@todo REMOVE

        $this->data['albumDropDown'] = $this->Album_mdl->getAlbumDropdownList();
        $this->load->view('admin/modals/multiFile', $this->data);
    }

    public function editPhoto($photoID, $isFront){

        $this->data['isFront'] = $isFront;
        $photoData = $this->Photo_mdl->getPhotoInfo($photoID);
        foreach($photoData->result() as $row){
            $this->data['photoTitle'] = $row->photoTitle;
            $this->data['photoFileName'] = $row->photoFileName;
            $this->data['albumName'] = $row->albumName;
            $this->data['photoID'] = $row->photoID;
            $this->data['photoDesc'] = $row->photoDesc;
            $this->data['isProfilePic'] = $row->isProfilePic;
            $this->data['albumID'] = $row->photoAlbumID;
        }
        $this->load->view('admin/modals/editPhoto', $this->data);
    }

    public function runImport($albumName){

        $this->Photo_mdl->photoAlbumName = $albumName;
        $this->Photo_mdl->importPhotos();
        redirect('photos');
    }

    public function movePhoto($photoID){

        $this->data['photoID'] = $photoID;
        $this->data['albums'] = $this->Album_mdl->getAlbumAdminInfo(0);

        $this->load->view('admin/modals/movePhotoModal', $this->data);
    }

    public function movePhotoAction($albumID, $photoID){

        // Load the library
        $this->load->library('album_lib');

      $albumName = getAlbumName($albumID);
      $this->Photo_mdl->photoAlbumID = $albumID;
      $this->Photo_mdl->photoID = $photoID;
      $this->Photo_mdl->movePhoto();


        $this->data['photos'] = $this->Photo_mdl->getAlbumPhotos($albumID);
        $this->data['allAlbums'] = $this->Album_mdl->getAllAlbums();
        $this->data['albumName'] = $albumName;

        $this->data['albumFriendlyName'] = getAlbumFriendlyName($albumID);

        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/viewAlbumPage/' . $albumName;
        $config['total_rows'] = $this->album_lib->getTotalAlbumCount();
        $config['per_page'] = '21';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->load->view('admin/viewSingleAlbum', $this->data);



    }

    public function importModal(){

        $data['albumDropDown'] = $this->Album_mdl->getAlbumDropdownList();
        $this->load->view('admin/modals/addPhotoModal', $data);
    }

    public function uploadPhotos($albumID){
        $this->data['albumID'] = $albumID;
        $this->load->view('admin/photoUpload', $this->data);

    }

    public function deletePhoto($photoID){

        $this->data['photoID'] = $photoID;
        $this->load->view('admin/modals/deletePhotoModal', $this->data);

    }


    public function processPhotos(){

        log_message('debug', 'ProcessPhotos function hit.');

        log_message('debug', 'Album and Photo model loaded with ProcessPhotos');
        $albumName = $this->Album_mdl->getAlbumName($this->input->post('albumID'));
        $this->Photo_mdl->photoAlbumName = $albumName;
        log_message('debug', 'Begin photo import using admin controller');
        $this->Photo_mdl->importPhotos();


    }
}

?>
