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
* Album Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Album_mdl');
        $this->load->model('Photo_mdl');
        $this->load->library('photo_lib');
    }

     public function multiUpload($albumID){

        // Remove later


        //$albumID = $this->input->post('albumID');
        
        log_message('debug', 'Trying to upload singleUpload admin method hit.');

        $albumName = getAlbumName($albumID);

        $config['upload_path'] = './img_stor/albums/' . $albumName . '/originals/';
        $config['allowed_types'] = '*';
        $this->load->helper('string');
        
        $config['encrypt_name'] = TRUE;


        $this->load->library('upload', $config);
        log_message('debug', 'Try upload now...');
        $this->upload->do_upload('Filedata');
        $photoData = $this->upload->data();
        $file = $photoData['file_name'];
        $photoLocation = './img_stor/albums/' . $albumName . '/originals/' . $file;
        log_message('debug', 'Trying to place this photo from ' . $photoLocation);
        

        $this->photo_lib->buildMainThumb($photoLocation, $file, $albumName);
        $this->Photo_mdl->photoAlbumID = $albumID;
        $this->Photo_mdl->photoCreatedDate = date("y/m/d");
        $this->Photo_mdl->photoDesc = null;
        $this->Photo_mdl->photoFileName = $file;
        $this->Photo_mdl->photoTitle = '';
        $this->Photo_mdl->create();
        log_message('info', 'Adding a phoot single upload complete');
        return true;

    }

    public function basicUploader($albumID)
    {
        $albumName = getAlbumName($albumID);
        $config['upload_path'] = './img_stor/albums/' . $albumName . '/originals/';
        $config['allowed_types'] = '*';
        $this->load->helper('string');

        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload())
        {
            $this->load->view('admin/photoUpload');
        }
        else
        {
        $photoData = $this->upload->data();
        $file = $photoData['file_name'];
        $photoLocation = './img_stor/albums/' . $albumName . '/originals/' . $file;
        log_message('debug', 'Trying to place this photo from ' . $photoLocation);


        $this->photo_lib->buildMainThumb($photoLocation, $file, $albumName);
        $this->Photo_mdl->photoAlbumID = $albumID;
        $this->Photo_mdl->photoCreatedDate = date("y/m/d");
        $this->Photo_mdl->photoDesc = null;
        $this->Photo_mdl->photoFileName = $file;
        $this->Photo_mdl->photoTitle = '';
        $this->Photo_mdl->create();
        log_message('info', 'Adding a phoot single upload complete');
        }
    }

}
?>
