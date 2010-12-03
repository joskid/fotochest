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
* Comments Model
*
* @package		FotoChest
* @category		Models
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


  public function create(){
    log_message('info', 'create hit');
    $this->commentDate = date('y/m/d');
    $commentData = array('commentContent'=>$this->commentContent, 'commentDate'=>$this->commentDate,
                         'commentPhotoID'=>$this->commentPhotoID);
    $this->db->insert($this->commentTable, $commentData);
    
  }
  
  public function readByPhotoID($photoID)
  {
    $comments = $this->db->get_where($this->commentTable, array('commentPhotoID'=>$photoID));
    return $comments;
  }
}


?>