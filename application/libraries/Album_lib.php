<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Album_lib
 *
 * @author derek
 */
class Album_lib {

    private $ci;

    function Album_lib()
    {
        $this->ci = get_instance();
    }


//    public function getAlbumThumbFileName($albumName){
//
//
//
//        $albumID = getAlbumID($albumName);
//        $selectAlbumInfo = "SELECT * FROM $this->photoTable WHERE photoAlbumID = $albumID LIMIT 1";
//        log_message('info', 'Album_mdl::getAlbumThumbFileName() is executing a query ' . $selectAlbumInfo);
//        $execute = $this->db->query($selectAlbumInfo);
//        foreach($execute->result() as $row){
//            $filename = $row->photoFileName;
//        }
//        return $filename;
//
//    }

    public function findAlbumThumbnails($albumID, $neededPhotos= 3){

        // First check to see if the album has some thumbs allready/needs to have pictures in it to do this.

        $grabbedPhotos = 0;
        $currentAlbum = $albumID;
        $inNeed = $neededPhotos;
        $this->ci->load->model('Album_mdl');

        $albumThumbs = $this->ci->Album_mdl->getAlbumCount($albumID);


        if ($albumThumbs >= $neededPhotos)
        {
            // Good..

            $imgs = $this->ci->Album_mdl->getAlbumThumbnails($albumID, $neededPhotos);


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

//    public function getAlbumFriendlyName($albumID){
//
//        //Deprecated...
//        log_message('error', 'getAlbumFriendlyName has been used.  This method is deprecated...');
//        $selectAlbum = "SELECT * FROM $this->albumTable WHERE albumID = $albumID";
//        log_message('info', 'Album_mdl::getAlbumFriendlyName() is executing a query ' . $selectAlbum);
//        $exe = $this->db->query($selectAlbum);
//        foreach($exe->result() as $row){
//            $albumFriendly = $row->albumFriendlyName;
//        }
//        return $albumFriendly;
//    }
//
//    public function getAlbumName($albumID){
//        $selectAlbum = "SELECT * FROM $this->albumTable WHERE albumID = $albumID";
//        log_message('info', 'Album_mdl::getAlbumName is executing a query ' . $selectAlbum);
//        $execute = $this->db->query($selectAlbum);
//        foreach($execute->result() as $row){
//            $albumName = $row->albumName;
//        }
//        return $albumName;
//    }
}
?>
