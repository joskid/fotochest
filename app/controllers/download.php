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
* Album Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/

class Download extends Public_Controller {
    

    public function __construct()
    {
        parent::__construct();
    }

    public function downloadAlbum($albumName)
    {
        
        $this->load->library('zip');
        ini_set("memory_limit","1600M");

        $path = getSetting('absoluteFilePath') . "img_stor/albums/" . $albumName . "/originals/";
        $this->zip->read_dir($path, FALSE);
        $this->zip->download($albumName . '.zip');
    }

    public function downloadFile($albumName, $fileName)
    {
        $this->load->helper('download');
        $data = file_get_contents(getSetting('absoluteFilePath') . "img_stor/albums/" . $albumName . "/originals/" . $fileName); // Read the file's contents
        force_download($fileName, $data);    
    }
}