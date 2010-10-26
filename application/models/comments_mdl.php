<?php
/**
 *
 *
 * @todo CRUD
 *
 *
 */



class Comments_mdl extends CI_Model{
  
  // Comment Variables
  
  var $commentID;
  var $commentContent;
  var $commentDate;
  var $commentPhotoID;
  var $commentTable;

  public function __construct(){
      parent::CI_Model();
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