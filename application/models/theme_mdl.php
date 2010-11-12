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
* Theme Model
*
* @package		FotoChest
* @category		Models
* @author		Derek Stegelman
*/

class Theme_mdl extends CI_Model {

    public $themeID;
    public $themeName;
    public $themeAuthor;

    private $_themeTable;

    public function __construct()
    {
        parent::__construct();
        $this->_themeTable = $this->config->item('themeTable');

    }
        

     public function create()
    {
        $albumData = array('albumName'=>$this->albumName, 'albumCreateDate'=>date("m/y/d"), 'albumParentID'=>$this->albumParentID,
                           'albumDesc'=>$this->albumDesc, 'albumFriendlyName'=>$this->albumFriendlyName);
        $this->db->insert($this->albumTable, $albumData);
    }


    public function read($themeID = null)
    {
        if ($themeID == null)
        {
            $readData = $this->db->get($this->_themeTable);
        }
        else
        {
            $readData = $this->db->get_where($this->_themeTable, array('themeID'=>$themeID));
        }
        return $readData;
    }

    public function readActive()
    {
        $readData = $this->db->get_where($this->_themeTable, array('themeActive'=>1));
        return $readData;
    }

    public function update($themeID, $themeData)
    {

        $this->db->where('themeID', $themeID);
        $this->db->update($this->_themeTable, $themeData);
    }

    public function shutdownTheme()
    {
        $data = array('themeActive'=>0);
        $this->db->where('themeActive', 1);
        $this->db->update($this->_themeTable, $data);
    }

    public function delete($albumID)
    {
        $this->db->delete($this->albumTable, array('albumID'=>$albumID));
    }

    
}
?>
