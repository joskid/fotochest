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
* Admin Photos Controller
*
* @package		FotoChest
* @category		Admin Controllers
* @author		Derek Stegelman
*/

class Photos extends Admin_Controller {

    public function  __construct()
    {
        parent::__construct();
    }

    public function savePhoto(){
      // @todo Move this...

        log_message('debug','Save Photo Method hit');

        //$this->Photo_mdl->photoID = $this->input->post('photoID');
        //$this->Photo_mdl->photoAlbumID = $this->input->post('albumID');
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
        $this->Photo_mdl->update($this->input->post('photoID'));
        log_message('debug','Photo update complete');
    }


    function do_photoDelete(){

        // @todo move this

        $this->load->library('photo_lib');
        $this->photo_lib->photoID = $this->input->post('photoID');
        $this->photo_lib->photoAlbumName = getPhotoAlbumName($this->input->post('photoID'));
        $this->photo_lib->deletePhoto();
        
    }

    public function photosView($pageNum = 0){
        $this->data['pageNum'] = 1;
        $this->data['showAlbum'] = TRUE;
        $this->data['showUserButton'] = FALSE;

        $this->data['photos'] = $this->Photo_mdl->getAdminPhotoStream($pageNum);


        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'admin/photos/';
        $config['total_rows'] = $this->db->count_all($this->config->item('photoTable'));
        $config['per_page'] = '5';

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();
        $this->template->write('title', 'Your FotoChest Dashboard');
        $this->template->write_view('navigation', 'admin/partials/nav', $this->data);
        $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
        $this->template->write_view('content', 'admin/partials/dashboard', $this->data);
        $this->template->render();
    }

    public function photoUpload($albumID){

        // @todo photo Upload or MultiUpload which one is it?

        $this->data['albumID'] = $albumID;
        // Load the view
        $this->template->write('title', 'Upload Photos');
        $this->data['isUpload'] = 1;
        $this->data['pageNum'] = 1;
        $this->data['showAlbum'] = FALSE;
        $this->data['showUserButton'] = FALSE;
        $this->template->write_view('navigation', 'admin/partials/nav', $this->data);
        $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
        $this->template->write_view('content', 'admin/partials/upload', $this->data);
        $this->template->render();
        $this->load->view('admin/photoUpload', $this->data);
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

    public function movePhoto($photoID){

        $this->data['photoID'] = $photoID;
        
        $this->load->view('admin/modals/movePhotoModal', $this->data);
    }

    public function movePhotoAction($albumID, $photoID){

        // Load the library
        $this->load->library('album_lib');

      $albumName = getAlbumName($albumID);
      $this->Photo_mdl->photoAlbumID = $albumID;
      $this->Photo_mdl->photoID = $photoID;
      $this->Photo_mdl->movePhoto();

      redirect('admin/album/' . $albumName);
    }



    public function deletePhoto($photoID){

        $this->data['photoID'] = $photoID;
        $this->load->view('admin/modals/deletePhotoModal', $this->data);

    }

    public function fullEdit($photoID = null)
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('photoID', 'PhotoID', 'required|xss_clean');

        if(!$this->form_validation->run())
        {
            $this->data['pageNum'] = 2;
            $this->data['showAlbum'] = FALSE;
            $this->data['showUserButton'] = FALSE;

            $this->data['photoData'] = $this->Photo_mdl->getPhotoInfo($photoID);
            $this->template->write('title', 'Edit');
            $this->template->write_view('navigation', 'admin/partials/nav', $this->data);
            $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
            $this->template->write_view('content', 'admin/partials/editPhoto', $this->data);
            $this->template->render();
        }
        else
        {
            $this->Photo_mdl->photoTitle = $this->input->post('photoTitle');
            $this->Photo_mdl->photoDesc = $this->input->post('photoDesc');
            $this->Photo_mdl->photoID = $this->input->post('photoID');
            if ($this->input->post('isProfile') == 'on'){
                $this->Photo_mdl->isProfilePicture = 1;
            } else {
                $this->Photo_mdl->isProfilePicture = 0;
            }
            $this->Photo_mdl->update($this->input->post('photoID'));
            redirect('admin/photos/fullEdit/' . $this->input->post('photoID'));
        }

        
    }

    public function rotate($direction, $photoID)
    {
        if(empty($direction) || empty($photoID) || !is_numeric($photoID))
        {
            show_404();
        }
        
        $this->load->library('photo_lib');
        if ($direction == "clock")
        {
            
            $this->photo_lib->rotateImage(1, $photoID);
        }
        else
        {
            $this->photo_lib->rotateImage(2, $photoID);
        }

        redirect('admin/photos/fullEdit/' . $photoID);
        
    }

    public function addNoAlbum()
    {
        
        $this->load->view('admin/modals/chooseAlbum');
    }

}

?>
