<?php

class CoreController extends CI_Controller {
	
	public function __construct()
	{
            parent::__construct();

            $this->load->model('Photo_mdl');
            // Enable profiler in debug mode.
            if($this->config->item('environment') == 'dev')
            {
                $this->output->enable_profiler(TRUE);
            }
	}
	
	
}

?>