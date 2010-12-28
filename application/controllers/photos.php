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

class Photos extends Public_Controller {

    public function __construct() {
        parent::__construct();
        $this->template->write('title', getSetting('siteName') . "'s Photos");
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

        
        //$this->template->write_view('navigation', 'navigation', $this->data);
        $this->template->write_view('content', 'themes/' . getTheme() . '/stream', $this->data);
        $this->template->render();
    }

    public function slideshow($albumName){

        if (empty($albumName) || is_numeric($albumName) == TRUE){
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

        $this->template->write_view('navigation', 'navigation', $this->data);
        $this->template->write_view('content', 'stream', $this->data);
        $this->template->render();
    }
    
    /*
     * view
     * 
     * @author Derek Stegelman
     * @access Public
     * @version 2.0 - Ready for Testing
     * @param string $albumName int $photoID
     * @return photo view.
     */

    public function view($albumName, $photoID){

        if (!is_numeric($photoID) || empty($albumName) || empty($photoID) || !checkPhoto($photoID, $albumName)){
            show_404();
        } else {
        
       	// Load dependencies
        $this->load->library('comment');
        $this->load->library('photo');
        
        $this->data['comments'] = $this->comment->getComments($photoID);
        $this->data['photoInfo'] = $this->photo->getPhoto($photoID);
        $this->data['albumNameURL'] = $albumName;
        $this->data['photoID'] = $photoID;
        // Get the exif data
        $photoURL = ('./img_stor/albums/' . $albumName . '/originals/' . getPhotoFileName($photoID) );
        $exif_data = exif_read_data( $photoURL );
        $this->data['photoEXIF'] = $exif_data;
        $this->data['title'] = getPhotoTitle($photoID);
        
		// Load view.
        $this->template->write('title', getPhotoTitle($photoID));
        $this->template->write_view('content', 'themes/' . getTheme() . '/' . 'singlePhoto', $this->data);
        $this->template->render();

        }
    }
    
    /*
     * saveComment
     * 
     * @author Derek Stegelman
     * @access Public
     * @version 2.0 - Ready for Testing
     * @param null
     * @return refresh of the page.
     */

    public function saveComment()
    {
		// Load dependencies
		$this->load->library('comment');
        
		// Load up the vars
		$this->comment->content = $this->input->post('content');
		$this->comment->photoID = $this->input->post('photoID');
		$this->comment->add();
		
		// Redirect to the same page (Refresh)
        redirect('photo/' . $this->input->post('albumName') . '/' . $this->input->post('photoID'));
    }
}
?>