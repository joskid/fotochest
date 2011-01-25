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
    public $userID;
    public $userPassword;
    public $userLastName;
    public $userFirstName;
    public $userDateCreated;
    public $userTable;

    public function __construct(){
        parent::__construct();
        $this->userTable = $this->config->item('userTable');
        $this->_table = $this->config->item('userTable');
    }

    // CRUD.

    function create()
    {
        show_error('create from user model is depreciated, use core instead.');
        log_message('ERROR', 'create from user model is depreciated, use core instead.');
//        $this->dateCreated = date('m/y/d');
//        $userData = array('userEmail'=>$this->userEmail,
//                          'userFirstName'=>$this->userFirstName,
//                          'userLastName'=>$this->userLastName,
//                          'userDateCreated'=>$this->dateCreated,
//                          'userPassword'=>$this->userPassword);
//
//        $this->db->insert($this->userTable, $userData);

    }

    function read($userID = NULL)
    {
        show_error('read from user model is depreciated, use core instead.');
        log_message('ERROR', 'read from user model is depreciated, use core instead.');
//        if($userID == NULL)
//        {
//            $readData = $this->db->get($this->userTable);
//        }
//        else
//        {
//            $readData = $this->db->get_where($this->userTable, array('userID'=>$userID));
//        }
//        return $readData;
    }

    public function readEmail($userEmail)
    {
        show_error('readEmail from user model is depreciated, use core instead.');
        log_message('ERROR', 'readEmail from user model is depreciated, use core instead.');
//        $select = "SELECT * FROM $this->userTable WHERE userEmail = '$userEmail'";
//        $readData = $this->db->query($select);
//        return $readData;
    }
    
    function update($data, $id)
    {
        show_error('update from user model is depreciated, use core instead.');
        log_message('ERROR', 'udpate from user model is depreciated, use core instead.');
        //$this->db->where('userID', $id);
        //$this->db->update($this->userTable, $data);
    }
    
    // There is no save users..???
    
    function saveUser()
    {
        show_error('saveUser from user model is depreciated, use core instead.');
        log_message('ERROR', 'saveUser from user model is depreciated, use core instead.');
//    	$this->load->library('encrypt');
//    	$data = array('userEmail'=>$this->userEmail,
//    				  'userPassword'=>$this->encrypt->encode($this->userPassword),
//    				  'userFirstName'=>$this->userFirstName,
//    				  'userLastName'=>$this->userLastName);
//    	$this->update($data, $this->userUserID);
    }

    function delete($userID)
    {
        show_error('delete from user model is depreciated, use core instead.');
        log_message('ERROR', 'delete from user model is depreciated, use core instead.');

        //$this->db->delete($this->userTable, array('userID'=>$userID));
    }


    public function getUserIDFromEmail($email){
        show_error('getUserIDFromEmail from user model is depreciated, use core instead.');
        log_message('ERROR', 'getUserIDFromEmail from user model is depreciated, use core instead.');
//        $select = "SELECT userID FROM $this->userTable WHERE userEmail = '$email'";
//        log_message('info', 'User_mdl::getUserIDUsername() is executing a query ' . $select);
//        $dump = $this->db->query($select);
//        foreach($dump->result() as $row){
//            $userID = $row->userID;
//            log_message('debug', 'User_mdl::getUserIDUsername() has fetched the userid ' . $userID);
//        }
//        return $userID;
    }

    function getFirstName(){
        $this->userUserID = $this->session->userdata('userid');
        
//        $getName = "SELECT userFirstName
//        FROM $this->userTable
//        WHERE userID = $this->userUserID LIMIT 1";

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
?>
