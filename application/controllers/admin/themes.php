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

class Themes extends Admin_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->data['pageNum'] = 4;
        $this->data['showUserButton'] = FALSE;
        $this->data['showAlbum'] = FALSE;
        $this->template->write('title', 'Theme Admin');
        $this->template->write_view('navigation', 'admin/partials/nav', $this->data);
        $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);

    }

    public function index()
    {
        // Load Theme Library
        $this->load->library('theme_lib');

        // Get the Themes that are Installed
        $this->data['themes'] = $this->theme_lib->getThemes();

        $this->template->write_view('content', 'admin/partials/themes', $this->data);
        $this->template->render();
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
