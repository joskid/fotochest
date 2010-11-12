<?php 
/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.0
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



class Comments_mdl extends CI_Model{
  
  // Comment Variables
  
  var $commentID;
  var $commentContent;
  var $commentDate;
  var $commentPhotoID;
  var $commentTable;

  public function __construct(){
      parent::__construct();
      $this->commentTable = $this->config->item('commentsTable');
      
  }

  
  public function addComment(){
    $this->commentDate = date('y/m/d');
    $commentData = array('commentContent'=>$this->commentContent, 'commentDate'=>$this->commentDate,
                         'commentPhotoID'=>$this->commentPhotoID);
    $buildQuery = $this->db->insert_query($this->commentTable, $commentData);
    $this->db->query($buildQuery);
  }
  
  public function getComments($photoID){
    $getCommentsSQL = "SELECT * FROM $this->commentTable WHERE commentPhotoID = $photoID";
    $exe = $this->db->query($getCommentsSQL);
    return $exe;
  }
}


?>