<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.6
* @author		Derek Stegelman <fotochest.com|stegelman.com>
* @license		Apache License v2.0
* @copyright	2010 FotoChest
*/

// ----------------------------------------------------------------

/**
* Theme Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/

class Theme extends CoreLibrary {
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getThemes()
    {
        // Get Data
        $themes = $this->ci->Theme_mdl->get();
        return $themes;
    }

    public function getCurrentTheme()
    {
        
        $theme = $this->ci->Theme_mdl->getWhere('themeActive', '1');
        foreach($theme->result() as $themeInfo)
        {
            $themeName = $themeInfo->themeName;
        }

        return $themeName;
    }

    public function changeTheme($newThemeID)
    {
        $oldTheme = $this->ci->Theme_mdl->getWhere('themeActive', 1);
        
        foreach($oldTheme->result() as $themeData)
        {
        	$id = $themeData->id;
        }
        // Turn off current theme
        $data2 = array('themeActive'=>0);
        $this->ci->Theme_mdl->update($data2, $id);

        // Turn on new theme
        $data = array('themeActive'=>1);
        $this->ci->Theme_mdl->update($data, $newThemeID);
    }
}

?>