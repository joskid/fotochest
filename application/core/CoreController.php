<?php

class CoreController extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Photo_mdl');
		
		// Enable profiler in debug mode.
        $this->output->enable_profiler($this->config->item('debugMode'));
	}
	
	
}

?>