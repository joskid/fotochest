<?php
/*
* FotoChest - a web based photo album
* Copyright (C) 2009-2010 Derek Stegelman http://derek.stegelman.com
*
*/

class Albums extends Controller {

    public function __construct(){
        parent::Controller();
        $this->load->model('Album_mdl');
        $this->load->model('Photo_mdl');
        $this->data['title'] = getSetting('siteName') . "'s Photos";
    }

    public function index(){
    // View All Albums...

    $albumInfo = $this->Album_mdl->getAlbums(0);  // Set to 0 for Root Albums
   
    $this->data['albumInfo'] = $albumInfo;
    $this->load->view('albums', $this->data);
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

            $this->load->view('viewAlbum', $this->data);
        } else {
            // Get Children??

            $this->data['albumName'] = $albumName;
            $this->data['albumInfo'] = $this->Album_mdl->getAlbums($albumID);
            
            $this->load->view('albums', $this->data);

        }
       }
       else
        {
             if (!is_numeric($photoStart) || is_numeric($albumName) == TRUE || isset($albumName) == FALSE || isset($photoStart) == FALSE){
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


        $this->load->view('viewAlbum', $this->data);
        }
    }

//    public function viewAlbumPage($albumName, $photoStart){
//
//        if (!is_numeric($photoStart) || is_numeric($albumName) == TRUE || isset($albumName) == FALSE || isset($photoStart) == FALSE){
//            show_404();
//        }
//
//        $albumID = $this->Album_mdl->getAlbumID($albumName);
//        $this->data['albumFriendlyName'] = $this->Album_mdl->getAlbumFriendlyName($albumID);
//        $getAlbumThumb = $this->Album_mdl->getAlbumThumbFileName($albumName);
//        $hasChildren = $this->Album_mdl->hasChildren($albumName);
//
//        $this->data['photoData'] = $this->Photo_mdl->getAlbumPhotosPage($albumID, $photoStart);
//        $this->data['albumName'] = $albumName;
//        $this->data['albumFileName'] = $getAlbumThumb;
//        $this->load->library('pagination');
//
//        $config['base_url'] = base_url() . 'albums/viewAlbumPage/' . $albumName . '/';
//        $config['total_rows'] = $this->Album_mdl->getAlbumCount($albumID);
//
//        $config['per_page'] = '21';
//        $config['uri_segment'] = 4;
//
//        $this->pagination->initialize($config);
//
//        $this->data['pages'] =  $this->pagination->create_links();
//
//
//        $this->load->view('viewAlbum', $this->data);
//
//    }

 
}
?>
