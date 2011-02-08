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
* User Model
*
* @package		FotoChest
* @category		Models
* @author		Derek Stegelman
*/


class User_mdl extends CoreModel {

    // User Properties

    public $userEmail;
    public $id;
    public $userPassword;
    public $userLastName;
    public $userFirstName;
    public $userDateCreated;
    public $userTable;

    public function __construct()
    {
        parent::__construct();
        $this->userTable = $this->config->item('userTable');
        $this->_table = $this->config->item('userTable');
    }

    function getFirstName()
    {
        $this->userUserID = $this->session->userdata('userid');
        $this->db->select('*');
        $this->db->from($this->userTable);
        $this->db->where('id', $this->userUserID);
        $this->db->limit(1);
        $excQuery = $this->db->get();
        foreach ($excQuery->result() as $row){
            $firstName = $row->userFirstName;
            
        }
        return $firstName;
    }
}