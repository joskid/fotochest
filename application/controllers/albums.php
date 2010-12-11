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
* Album Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/


class Albums extends Public_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Album_mdl');
        $this->load->model('Photo_mdl');
        $this->template->write('title', getSetting('siteName') . "'s Photos");
    }

    /*
     * ViewAll - This method replaces index so we can pass a var to it.
     *
     *
     */

    public function viewAll($pageNum = null)
    {

        $albumInfo = $this->Album_mdl->getAlbums(0, $pageNum, 8);
        $this->data['albumInfo'] = $albumInfo;
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'albums/';
        $config['total_rows'] = $this->Album_mdl->getAlbumCount($albumID);
        $config['per_page'] = '21';
        $this->pagination->initialize($config);
        $this->data['pages'] = $this->pagination->create_links();
        //$this->template->write_view('navigation', 'albumNavigation', $this->data);
        $this->template->write_view('content', 'themes/' . getTheme() . '/' . 'albums', $this->data);
        $this->template->render();
        

    }

    


    public function index(){
    // View All Albums... YOu can't do this, you have to use a different method and call it witih routing.

    $albumInfo = $this->Album_mdl->getAlbums(0);  // Set to 0 for Root Albums
   
    $this->data['albumInfo'] = $albumInfo;
    //$this->load->view(getFullThemePath() . 'albums', $this->data);
    $this->load->library('pagination');

    //$config['base_url'] = base_url() . 'albums/view/' . $albumName . '/';
    //$config['total_rows'] = $this->Album_mdl->getAlbumCount($albumID);
    //$config['per_page'] = '21';
    //$this->pagination->initialize($config);
    //$this->data['pages'] = $this->pagination->create_links();
    //$this->template->write_view('navigation', 'albumNavigation', $this->data);
    $this->template->write_view('content', 'themes/' . getTheme() . '/' . 'albums', $this->data);
    $this->template->render();
    }

    public function view($albumName, $photoStart = 0){
        // @todo FINISH THIS.
        $albumID = getAlbumID($albumName);
        $this->data['albumID'] = $albumID;
        

       if ($photoStart == 0)
       {

        
        if ($albumID == FALSE){
            show_404();
        }
        $this->data['albumFriendlyName'] = getAlbumFriendlyName($albumID);
        
        $hasChildren = $this->Album_mdl->hasChildren($albumName);
       
        if ($hasChildren == false){
            
            $this->data['photoData'] = $this->Photo_mdl->getAlbumPhotos($albumID);
            $this->data['albumName'] = $albumName;
            
            $this->load->library('pagination');

            $config['base_url'] = base_url() . 'albums/view/' . $albumName . '/';
            $config['total_rows'] = $this->Album_mdl->getAlbumCount($albumID);
            $config['per_page'] = '21';
            $config['uri_segment'] = 4;

            $this->pagination->initialize($config);

            $this->data['pages'] =  $this->pagination->create_links();
            $this->data['title'] = $this->data['albumFriendlyName'];

            //$this->load->view(getFullThemePath() . 'viewAlbum', $this->data);
            
            $this->template->write_view('navigation', 'singleAlbumNavigation', $this->data);
            $this->template->write_view('content', 'viewAlbum', $this->data);
            $this->template->render();
        } else {
            // Get Children??

            $this->data['albumName'] = $albumName;
            $this->data['albumInfo'] = $this->Album_mdl->getAlbums($albumID);
            
            //$this->load->view(getFullThemePath() . 'albums', $this->data);

            
            $this->template->write_view('navigation', 'albumNavigation', $this->data);
            $this->template->write_view('content', 'albums', $this->data);
            $this->template->render();

        }
       }
       else
        {
             if (!is_numeric($photoStart) || is_numeric($albumName) || empty($albumName) || empty($photoStart)){
            show_404();
        }

        $albumID = getAlbumID($albumName);
        $this->data['albumFriendlyName'] = getAlbumFriendlyName($albumID);
        
        $hasChildren = $this->Album_mdl->hasChildren($albumName);

        $this->data['photoData'] = $this->Photo_mdl->getAlbumPhotosPage($albumID, $photoStart);
        $this->data['albumName'] = $albumName;
        
        $this->load->library('pagination');

        $config['base_url'] = base_url() . 'albums/view/' . $albumName . '/';
        $config['total_rows'] = $this->Album_mdl->getAlbumCount($albumID);

        $config['per_page'] = '21';
        $config['uri_segment'] = 4;

        $this->pagination->initialize($config);

        $this->data['pages'] =  $this->pagination->create_links();

        //$this->load->view(getFullThemePath() . 'viewAlbum', $this->data);
        
        $this->template->write_view('navigation', 'singleAlbumNavigation', $this->data);
        $this->template->write_view('content', 'viewAlbum', $this->data);
        $this->template->render();
        }
    }


}
?>
