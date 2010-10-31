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
* Admin Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/



class Admin extends Controller {
  
    public function __construct(){
        parent::Controller();
        if(isLoggedIn() == TRUE){
            $this->load->model('Photo_mdl');
            $this->load->model('Album_mdl');

        } else {
            redirect('users/login');
        }
    }

    // Begin public page views

    public function index(){
        redirect('admin/dashboard');
    }
	
    public function savePhoto(){
      

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
    
    public function dashboard(){

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

    public function users(){


        $this->data['users'] = $this->User_mdl->getUsers();
        $this->load->view('admin/users', $this->data);
    }

    public function addUser(){


        $this->load->view('admin/modals/addUser', $this->data);
    }

    public function editUser($userID){


        $this->data['userInfo'] = $this->User_mdl->getUserInfo($userID);

        $this->load->view('admin/modals/editUser', $this->data);
    }

    function do_userSave(){
        $this->User_mdl->userEmail = $this->input->post('userEmail');
        $this->User_mdl->userPassword = $this->input->post('userPassword');
        $this->User_mdl->userFirstName = $this->input->post('userFirstName');
        $this->User_mdl->userLastName = $this->input->post('userLastName');
        $this->User_mdl->userUserID = $this->input->post('userUserID');
        $this->User_mdl->saveUser();


    }

    function do_photoDelete(){

      $this->Photo_mdl->photoID = $this->input->post('photoID');
      $this->Photo_mdl->deletePhoto();
    }

    function deleteUser($userID){

        $this->data['userID'] = $userID;

        $this->load->view('admin/modals/deleteUser', $this->data);
    }

    function do_userDelete(){
        $this->User_mdl->userUserID = $this->input->post('userUserID');
        $this->User_mdl->deleteUser();
    }

    public function settings(){

        /*
         *
         * Change to just settings and remove settings method
         *
         */

        $this->load->library('form_validation');

        $this->form_validation->set_rules('siteName', 'FotoChest Site Name', 'required|xss_clean');

        if(!$this->form_validation->run())
        {
            $this->load->view('admin/settings');
        }
        else
        {

            if ($this->input->post('showPhotoTitle') == "on"){
            setSetting('showPhotoTitle', 'TRUE');
            } else {
                setSetting('showPhotoTitle', 'FALSE');
            }

            if ($this->input->post('enableSlideshow') == "on"){
                setSetting('enableSlideshow', 'TRUE');
            } else {
                setSetting('enableSlideshow', 'FALSE');
            }
            if ($this->input->post('enableComments') == "on"){
                setSetting('enableComments', 'TRUE');
            } else {
                setSetting('enableComments', 'FALSE');
            }
            setSetting('siteName', $this->input->post('siteName'));
            redirect('admin/settings');
        }
    }

    // End Settings

    
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

    // Begin Album admin functions

   
    public function createAlbum(){
        


        $this->Album_mdl->albumName = $this->input->post('albumName');
        $this->Album_mdl->albumFriendlyName = $this->input->post('albumFriendlyName');
        $this->Album_mdl->albumParentID = $this->input->post('albumID');
        $this->Album_mdl->createAlbum();
    }

    public function saveAlbum(){

        $this->Album_mdl->albumFriendlyName = $this->input->post('albumFriendlyName');
        $this->Album_mdl->albumID = $this->input->post('albumID');
        $this->Album_mdl->albumDesc = $this->input->post('albumDesc');
        $this->Album_mdl->updateAlbum();
    }

    public function editAlbum($albumID){

        $this->data['albumData'] = $this->Album_mdl->getAlbumInfo($albumID);


        $this->load->view('admin/modals/editAlbum', $this->data);
    }
    
    public function deleteAlbum($albumID){

      $this->data['albumID'] = $albumID;
        $this->load->view('admin/modals/deleteAlbum', $this->data);
    }

    public function do_delete(){
        $albumID = $this->input->post('albumID');

      $path = getSetting('absolutePath');
      $this->Album_mdl->deleteAlbum($albumID, $path);
        
    }
    

    public function albums(){

        // Load the Library
        $this->load->library('album_lib');
        

        $this->data['albums'] = $this->Album_mdl->getAlbumAdminInfo(0);
	$this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/albumsPage/';
        $config['total_rows'] = $this->album_lib->getTotalAlbumCount();
        $config['per_page'] = '5';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->load->view('admin/viewAlbums', $this->data);
       
    }
    // End Album Functions

    // Begin photo functions

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
	
	public function albumsPage($pageNum = 0){
            
        $this->data['albums'] = $this->Album_mdl->getAlbumAdminInfo($pageNum);
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/albumsPage/';
        $config['total_rows'] = $this->Album_mdl->getNumAlbums();
        $config['per_page'] = '5';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
	$this->load->view('admin/viewAlbums', $this->data);
	}
    
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
        
        $data['albumDropDown'] = $this->Album_mdl->getAlbumDropdownList();
        $this->load->view('admin/modals/addAlbum', $data);
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
