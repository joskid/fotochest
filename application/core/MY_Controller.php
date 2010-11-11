<?php

class MY_Controller extends Controller {

    public function __construct()
    {
        $this->load->library('user_agent');
        if($this->agent->is_mobile())
        {
            
        }
    }


}
?>
