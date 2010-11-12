<?php

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::CI_Controller();
        $this->load->library('user_agent');
        if($this->agent->is_mobile())
        {
            
        }
    }


}
?>
