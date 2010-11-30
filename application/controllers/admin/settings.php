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
* Settings Admin Controller
*
* @package		FotoChest
* @category		Admin Controllers
* @author		Derek Stegelman
*/

class Settings extends Admin_Controller {

    public function  __construct()
    {
        parent::__construct();
        $this->data['pageNum'] = 3;
        $this->data['showUserButton'] = TRUE;
        $this->data['showAlbum'] = FALSE;
        $this->template->write('title', 'Settings');
        $this->template->write_view('navigation', 'admin/partials/nav', $this->data);
        $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
    }

    public function index(){

        /*
         *
         * Change to just settings and remove settings method
         *
         */

        $this->load->library('form_validation');

        $this->form_validation->set_rules('siteName', 'FotoChest Site Name', 'required|xss_clean');

        if(!$this->form_validation->run())
        {
            $this->template->write_view('content', 'admin/partials/settings', $this->data);
            $this->template->render();
        }
        else
        {

            if ($this->input->post('showPhotoTitle') == "on"){
            setSetting('showPhotoTitle', 'TRUE');
            } else {
                setSetting('showPhotoTitle', 'FALSE');
            }

            if ($this->input->post('enableSlideshow') == "on"){
                setSetting('enableSlideshow', 'TRUE');
            } else {
                setSetting('enableSlideshow', 'FALSE');
            }
            if ($this->input->post('enableComments') == "on"){
                setSetting('enableComments', 'TRUE');
            } else {
                setSetting('enableComments', 'FALSE');
            }
            setSetting('siteName', $this->input->post('siteName'));
            redirect('admin/settings');
        }
    }

    public function changeSetting($settingName, $settingValue)
    {
        setSetting($settingName, $settingValue);
        redirect('admin');
    }
}
?>
