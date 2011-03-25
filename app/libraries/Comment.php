<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.6
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright		2010 FotoChest
*/

// ----------------------------------------------------------------

/**
* Comment Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/

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