<?php

class Comment extends CoreLibrary {
	
	public $content;
	private $date;
	public $photoID;
	
	public function getComments($photoID)
	{
		return $this->ci->Comment_mdl->getWhere('commentPhotoID', $photoID);
	}
	
	public function add()
	{
		$this->date = date('y/m/d');
    	$commentData = array('content'=>$this->content, 'date'=>$this->date,
                             'photoID'=>$this->photoID);
	}
}
?>