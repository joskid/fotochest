<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Photo_lib
 *
 * @author derek
 */
class Photo_lib {
    
    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function getFileName($photoID){

        // Depreciated *** //
        $selectQuery = "SELECT photoFileName FROM $this->photoTable WHERE photoID = $photoID";
        log_message('info', 'Photo_mdl::getFileName() is excuting a query ' . $selectQuery);
        log_message('error', 'Decreciated method getFileName has been used');
        $exe = $this->db->query($selectQuery);
        foreach($exe->result() as $row){
            $photoFileName = $row->photoFileName;
        }
        return $photoFileName;
    }

    public function buildMainThumb($photoDirectory, $photoFileName, $albumName){

        $main_size['image_library'] = 'gd2';
        $main_size['source_image'] = $photoDirectory;
        $main_size['maintain_ratio'] = TRUE;
        $main_size['new_image'] = './img_stor/albums/' . $albumName . '/thumbs/' . $photoFileName;
        $main_size['width'] = 700;
        $main_size['height'] = 700;
        $this->ci->image_lib->initialize($main_size);
        if (!$this->ci->image_lib->resize()){
            log_message('error', 'Photo_mdl::buildMainThumb() - Error with Main Thumb Resize Method ' . $this->ci->image_lib->display_errors());
        } else {

        }
        $this->image_lib->clear();
    }

    public function getPhotoCount(){
        // Load the model
        $this->ci->load->model('Photo_mdl');

        // Call read method
        $getPhotos = $this->ci->Photo_mdl->read();

        return $getPhotos->num_rows();
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

    public function setProfilePicture($photoID){
        $updateData = array('isProfilePic'=>1);
        $where = "photoID = $photoID";
        $updateQuery = $this->db->update_string($this->photoTable, $updateData, $where);
        log_message('info', 'Photo_mdl::setProfilePicture executed a query ' . $updateQuery);
        $this->db->query($updateQuery);
    }

    public function getProfilePicture(){
        // Load the model
        $this->ci->load->model('Photo_mdl');

        // Call the method
        $photoData = $this->ci->Photo_mdl->readProfilePicture();

        return $photoData;
    }

    
}
?>
