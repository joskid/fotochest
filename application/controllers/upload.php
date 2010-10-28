<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of upload
 *
 * @author derek
 */
class Upload extends Controller {

    public function __construct()
    {
        parent::Controller();
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
        $this->Photo_mdl->photoTitle = $file;
        $this->Photo_mdl->create();
        log_message('info', 'Adding a phoot single upload complete');
        return true;

    }

}
?>
