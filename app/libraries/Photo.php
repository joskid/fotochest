<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
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

class Photo extends CoreLibrary {
	
    // Object properties
    public $photoAlbumID;  // ID of the Album that the photo belongs to.
    public $photoAlbumName;
    public $photoFileName;
    public $photoTitle;
    public $photoDesc;
    public $photoCreatedDate;
    public $id;
    public $isProfilePicture;
    
    /*
     * 
     * constructor
     * 
     * @author Derek Stegelman
     * @access Public
     * @version 2.0 - Ready for Testing
     * @param void
     * @return void
     */

    public function __construct()
    {
        parent::__construct();
    }
    
    /*
     * 
     * getPhoto
     * 
     * @author Derek Stegelman
     * @access Public
     * @version 2.0 - Ready for Testing
     * @param int $photoID
     * @return array of photo Data
     */
    
    public function getPhoto($photoID)
    {
    	return $this->ci->Photo_mdl->getPhotoInfo($photoID);
    }

    /*
     * buildMainThumb
     * 
     * @author Derek Stegelman
     * @version 1.5 - @todo Clean up and see what you can do to make it faster
     * @access Public @todo Make this private?
     * @param string PhotoDirectory, string file name, string album name
     * @return void
     */

    public function buildMainThumb($photoDirectory, $photoFileName, $albumName)
    {
        
        $main_size['image_library'] = 'gd2';
        $main_size['source_image'] = $photoDirectory;
        $main_size['maintain_ratio'] = TRUE;
        $main_size['new_image'] = './img_stor/albums/' . $albumName . '/thumbs/' . $photoFileName;
        $main_size['width'] = $this->ci->config->item('thumbWidth');
        $main_size['height'] = $this->ci->config->item('thumbHeight');
        $this->ci->image_lib->initialize($main_size);
        if (!$this->ci->image_lib->resize()){
            log_message('error', 'Photo_mdl::buildMainThumb() - Error with Main Thumb Resize Method ' . $this->ci->image_lib->display_errors());
        } 
        $this->ci->image_lib->clear();
    }
    
    /*
     * getPhotoCount
     * 
     * @author Derek Stegelman
     * @access Public
     * @version 2.0 - Ready for Testing
     * @param void
     * @return int how many photos.
     */

    public function getPhotoCount()
    {
        return $this->ci->Photo_mdl->getCount();
    }

    /*
     *
     * deletePhoto
     *
     * @author Derek Stegelman
     * @access Public
     * @version 2.0 - Ready for Testing
     * @param void
     * @return void
     */

    public function deletePhoto()
    {

        $fileName = getPhotoFileName($this->id);
        $this->ci->Photo_mdl->delete($this->id);
        
        // Find where the photo is at.
        $buildFilePath = "./img_stor/albums/" . $this->photoAlbumName . "/";
        $thumb = $buildFilePath . "thumbs/" . $fileName;
        $orginal = $buildFilePath . "originals/" . $fileName;
        
        // Delete files.
        unlink($thumb);
        unlink($original);
    }

    /*
     *
     *
     * add()
     *
     * @author Derek Stegelman
     * @access Public
     * @version 2.0
     * @param void - uses photo object
     * @return void
     *
     *
     */

    public function add()
    {
        $photoData = array('photoAlbumID'=>$this->photoAlbumID, 'photoCreatedDate'=>$this->photoCreatedDate,
                           'photoDesc'=>$this->photoDesc, 'photoFileName'=>$this->photoFileName, 'photoTitle'=>$this->photoTitle);
        $this->ci->Photo_mdl->create($photoData);
    }
    
    /*
     * movePhoto
     * 
     * @author Derek Stegelman
     * @access Public
     * @version 1.5
     */

    public function movePhoto(){
    	
        $photoInfo = $this->ci->Photo_mdl->get($this->id);
        foreach($photoInfo->result() as $row){
            $oldAlbumID = $row->photoAlbumID;
            $fileName = $row->photoFileName;
        }
        
        // Load Album Model
        $this->ci->load->model('Album_mdl');
        $albumInfo = $this->ci->Album_mdl->get($oldAlbumID);
        foreach($albumInfo->result() as $oldAlbum){
            $oldAlbumName = $oldAlbum->albumName;
        }

        $newAlbumInfo = $this->ci->Album_mdl->get($this->photoAlbumID);
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

        // Query time....

        $updateQuery = array('photoAlbumID'=>$this->photoAlbumID);
        $this->ci->Photo_mdl->update($updateQuery, $this->id);
    }

    public function setProfilePicture($photoID)
    {
        $updateData = array('isProfilePic'=>1);
        $where = "photoID = $photoID";
        $updateQuery = $this->db->update_string($this->photoTable, $updateData, $where);
        log_message('info', 'Photo_mdl::setProfilePicture executed a query ' . $updateQuery);
        $this->db->query($updateQuery);
    }

    public function getProfilePicture()
    {
        // Load the model
        //$this->ci->load->model('Photo_mdl');

        // Call the method
        
        $photoData = $this->ci->Photo_mdl->getWhere('isProfilePic', '1');
        log_message('info', 'success at photo lib');
        return $photoData;
    }

    public function rotateImage($rotation, $photoID)
    {
        // Memory limit is set really high on purpose.  Rotation takes a lot of memory.
        ini_set('memory_limit', '512M');
        $this->ci->load->model('Photo_mdl');

        $photoData = $this->ci->Photo_mdl->getPhotoInfo($photoID);
        foreach($photoData->result() as $row)
        {
            $albumName = $row->albumName;
            $fileName = $row->photoFileName;
        }

        $photoLocation = './img_stor/albums/' . $albumName . '/originals/' . $fileName;
        $thumbLocation = './img_stor/albums/' . $albumName . '/thumbs/' . $fileName;

        if($rotation == 1)
        {
            $config['rotation_angle'] = '270';
            $thumb['rotation_angle'] = '270';
        }
        else
        {
            $config['rotation_angle'] = '90';
            $thumb['rotation_angle'] = '90';
        }

        $config['image_library'] = 'gd2';
        $thumb['image_library'] = 'gd2';
        $config['source_image'] = $photoLocation;
        $thumb['source_image'] = $thumbLocation;
        log_message('info', 'Attempting rotation');

        $this->ci->image_lib->initialize($config);
        
        if(!$this->ci->image_lib->rotate())
        {
            log_message('ERROR', 'Issue with image rotation ' . $this->ci->image_lib->display_errors());
        }
        $this->ci->image_lib->clear();

        $this->ci->image_lib->initialize($thumb);
        if(!$this->ci->image_lib->rotate())
        {
            log_message('ERROR', 'Issue with image rotation ' . $this->ci->image_lib->display_errors());
        }
        $this->ci->image_lib->clear();

    }

    public function exists($photoID, $albumName)
    {

        // Load Model
        $this->ci->load->model('Album_mdl');

        // Get Album Data
        $albumData = $this->ci->Album_mdl->getWhere('albumName', $albumName);

        // Get ID
        foreach($albumData->result() as $album)
        {
            $albumID = $album->id;
        }

        // Load Photo Model
        $this->ci->load->model('Photo_mdl');

        // Grab photo info
        $photoData = $this->ci->Photo_mdl->getPhotoInfo($photoID);
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