<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of live_edit
 *
 * @author Derek
 */
class Live_edit extends Live_Edit_Controller {

    public function __construct()
    {
        parent::__construct();

        $data['page_slug'] = 'Settings';
        $this->template->write_view('navigation', 'navigation', $data);
    }
    //put your code here

    public function index()
    {

        $this->load->library('form_validation');

        $this->form_validation->set_rules('setting');

        if(!$this->form_validation->run())
        {


            $this->template->write_view('content', 'live_edit/settings');
            $this->template->render();
        }
        else
        {
            set_setting('about_text', $this->input->post('about_text'));
            set_setting('home_page_text', $this->input->post('home_page_text'));
            redirect('liveedit/settings');
        }

    }
}
?>
