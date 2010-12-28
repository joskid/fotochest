<?php

class Comment_mdl extends CoreModel {
	
	public function __construct()
	{
		parent::__construct();
		$this->_table = $this->config->item('commentsTable');
	}
	
}

?>