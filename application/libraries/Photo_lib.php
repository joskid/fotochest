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

    function Photo_lib()
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

    
}
?>
