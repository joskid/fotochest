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
* Admin Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/

class Themes extends MY_Controller {
    
    public function __construct() {
        parent::__construct();
    }

    public function index()
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
