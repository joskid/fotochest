<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.6
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

class Album extends CoreLibrary {
	

    public $albumName;
    public $albumCreateDate;
    public $id;
    public $albumParentID;
    public $albumDesc;
    public $albumFriendlyName;
    
    public function __construct()
    {
        parent::__construct();
    }


    /**********************************************
     *  createAlbum
     *
     *  Params(); None - Accepts object properties
     *  returns null; 
     * ********************************************
     */

    public function createAlbum(){

        log_message('info', 'Executing createAlbum method'); // Log for information purposes.
        // Once a new photo is uploaded to the album it becomes the thumbnail....

        // Load up the variables
        $albumData = array('albumName'=>$this->albumName, 'albumCreateDate'=>date("m/y/d"), 
        				   'albumParentID'=>$this->albumParentID,
                           'albumFriendlyName'=>$this->albumFriendlyName);

        // Check for exisitng folder
        if ($this->ci->Album_mdl->exists($this->albumName))
        {
            // Probably should randomize the name then right?
            log_message('ERROR', 'The album ' . $this->albumName . ' already exists.  Manually changing the name now.');
            $this->ci->Album_mdl->albumName = $this->_saltName($this->albumName);
        }

        // Call the CRUD Method
        $this->ci->Album_mdl->create($albumData);

        // Create the album folders
        mkdir("./img_stor/albums/" . $this->albumName);
        mkdir("./img_stor/albums/" . $this->albumName . "/originals");
        mkdir("./img_stor/albums/" . $this->albumName . "/thumbs");
    }
    
    /*
     * _saltName
     * 
     * @author Derek Stegelman
     * @access Private
     * @param string $albumName
     * @return random string of albumname plus other chars.
     * 
     */

    private function _saltName($albumName)
    {
        return $albumName . rand(5, 45);
    }
    
    /**********************************************
     *  Delete Album
     * @param AlbumID, and the path of the site.  (Can we grab this here???)
     * 
     * *********************************************
     */

    public function deleteAlbum($albumID, $path){

        // Call the delete Method
        $this->ci->Album_mdl->delete($albumID);
        
        // Now we must delete all photos associated with this album
        $this->load->model('Photo_mdl');  // Must inhert core model before this works.
        $this->Photo_mdl->deleteWhere('photoAlbumID', $albumID);

        // Deleting files in the album folder.
        delete_files($path . "img_stor/albums/" . $this->albumName);
        rmdir('./img_stor/albums/' . $this->albumName);  // Delete directory
        log_message('info', 'Removing directory for album ' . $this->albumName);
    }

    public function findAlbumThumbnails($albumID, $neededPhotos= 3){

        // First check to see if the album has some thumbs allready/needs to have pictures in it to do this.
        $grabbedPhotos = 0;
        $currentAlbum = $albumID;
        $inNeed = $neededPhotos;
        $albumThumbs = $this->ci->Album_mdl->getCountWhere('id', $albumID);

        if ($albumThumbs >= $neededPhotos)
        {
            // Good..
            log_message('info', 'Falls under first if');
            $imgs = $this->ci->Album_mdl->getAlbumThumbnails($albumID, $neededPhotos);
            log_message('info', 'got thumbs');
            return $imgs;
        }
        else
        {
            // Begin finding other phtoos.
            while($grabbedPhotos < $neededPhotos)
            {

                $childPhotos = $this->ci->Album_mdl->getAlbumThumbnails($currentAlbum, $neededPhotos);

                if($childPhotos->num_rows() >= $neededPhotos)
                {

                    $grabbedPhotos = $childPhotos->num_rows();
                    return $childPhotos;
                    break;
                }
                else
                {

                    $currentAlbum = $this->ci->Album_mdl->findChildID($currentAlbum);

                    $grabbedPhotos = 0 ;

                    if($currentAlbum == 0)
                    {

                        // This shouldn't happen....
                        return $this->ci->Album_mdl->getAlbumThumbnails($currentAlbum);
                        break;
                    }
                }
            }
        }
    }


    /*****************************************************
     *
     *
     *  addPhotoToAlbum - Adds a photo to a specific album.
     *  Mostly just executes a query to add it to the db.
     *
     *  Params: $photoID (The id of the actual photo),
     *  $albumID: Id of the album to add it to.
     *
     *  Returns null
     * **************************************************
     */

    public function addPhotoToAlbum($photoID, $albumID){

        // loading data
        $addPhotoData = array('photoAlbumID'=>$albumID);

        // Call update Method 
        $this->ci->load->model('Photo_mdl');
        $this->ci->Photo_mdl->update($addPhotoData, $photoID);
    }
    
    /**
     * getTotalAlbumcount()
     *
     * Gets total albums in teh system
     * @return integer
     * 
     * 
     */

    public function getTotalAlbumCount(){
    	      
        return $this->ci->Album_mdl->getCount();
    }
}

?>