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
* Photo Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/


class Photo_lib {

    // Global CI variable.
    private $ci;

    // Object properties
    var $photoAlbumID;  // ID of the Album that the photo belongs to.
    var $photoAlbumName;
    var $photoFileName;
    var $photoTitle;
    var $photoDesc;
    var $photoCreatedDate;
    var $photoID;
    var $isProfilePicture;

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

       /**
	 * Autoloads the given class.
	 *
	 * @access	public
	 * @param	string	The name of the class
	 * @return	bool	Whether the class was loaded or not
	 */

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
        $this->ci->image_lib->clear();
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
        // @todo update this function

        //Load Photo Model
        $this->ci->load->model('Photo_mdl');

        $photoInfo = $this->ci->Photo_mdl->read($this->photoID);
        foreach($photoInfo->result() as $row){
            $oldAlbumID = $row->photoAlbumID;
            $fileName = $row->photoFileName;
        }

        // Load Album Model
        $this->ci->load->model('Album_mdl');

        $albumInfo = $this->ci->Album_mdl->read($oldAlbumID);
        foreach($albumInfo->result() as $oldAlbum){
            $oldAlbumName = $oldAlbum->albumName;
        }

        $newAlbumInfo = $this->ci->Album_mdl->read($this->photoAlbumID);
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

        $this->ci->Photo_mdl->update($this->photoID, $updateQuery);

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

    public function rotateImage($rotation, $photoID)
    {
        
    }

    public function exists($photoID, $albumName)
    {

        // Load Model
        $this->ci->load->model('Album_mdl');

        // Get Album Data
        $albumData = $this->ci->Album_mdl->getAlbumByName($albumName);

        // Get ID
        foreach($albumData->result() as $album)
        {
            $albumID = $album->albumID;
        }

        // Load Photo Model
        $this->ci->load->model('Photo_mdl');

        // Grab photo info
        $photoData = $this->ci->Photo_mdl->read($photoID);
        if ($photoData->num_rows() == 0)
        {
            return FALSE;
        }
        foreach($photoData->result() as $photo)
        {
            $photoAlbumID = $photo->photoAlbumID;
        }
        if ($photoAlbumID == $albumID)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }

    }

    
}
?>
