<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of themes
 *
 * @author derek
 */
class Themes extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function themes()
    {
        // Load Theme Library
        $this->load->library('theme_lib');

        // Get the Themes that are Installed
        $this->data['themes'] = $this->theme_lib->getThemes();

        $this->load->view('admin/themeAdmin', $this->data);
    }

    public function activateTheme($themeID)
    {
        // Load the Theme Library
        $this->load->library('theme_lib');

        // Change the theme
        $this->theme_lib->changeTheme($themeID);

        // Redirect to the theme page.
        redirect('admin/themes');
    }

}
?>
