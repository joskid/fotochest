<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of download
 *
 * @author derek
 */
class Download extends Controller {
    //put your code here


    public function downloadAlbum($albumName){
        

        $this->load->library('zip');
        ini_set("memory_limit","1600M");

        $path = getSetting('absoluteFilePath') . "img_stor/albums/" . $albumName . "/originals/";


       $this->zip->read_dir($path, FALSE);


        $this->zip->download($albumName . '.zip');
    }

    public function downloadFile($albumName, $fileName){

        $this->load->helper('download');
        $data = file_get_contents(getSetting('absoluteFilePath') . "img_stor/albums/" . $albumName . "/originals/" . $fileName); // Read the file's contents
        force_download($fileName, $data);
        
    }
}
?>
