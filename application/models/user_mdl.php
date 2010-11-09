<?php 
/**
* FotoChest
*
* FotoChest is a simple photo management web based application.
*
* @package		FotoChest
* @version		1.0
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

class User_mdl extends CI_Model {

    // User Properties

    var $userEmail;
    var $userID;
    var $userPassword;
    var $userLastName;
    var $userFirstName;
    var $userDateCreated;
    var $userTable;

    public function __construct(){
        parent::CI_Model();
        $this->userTable = $this->config->item('userTable');
        
    }

    // CRUD.

    function create()
    {
        $this->dateCreated = date('m/y/d');
        $userData = array('userEmail'=>$this->userEmail,
                          'userFirstName'=>$this->userFirstName,
                          'userLastName'=>$this->userLastName,
                          'userDateCreated'=>$this->dateCreated,
                          'userPassword'=>$Password);

        $this->db->insert($this->userTable, $userData);

    }

    function read($userID = NULL)
    {
        if($userID == NULL)
        {
            $readData = $this->db->get($this->userTable);
        }
        else
        {
            $readData = $this->db->get_where($this->userTable, array('userID'=>$userID));
        }
        return $readData;
    }

    public function readEmail($userEmail)
    {
        $select = "SELECT * FROM $this->userTable WHERE userEmail = '$userEmail'";
        $readData = $this->db->query($select);
        return $readData;
    }
    

    function update($data)
    {

       
        $this->db->where('userID', $this->userID);
        $this->db->update($this->userTable, $data);
    }

    function delete($userID)
    {
        $this->db->delete($this->userTable, array('userID'=>$userID));
    }


    public function getUserIDFromEmail($email){
        $select = "SELECT userID FROM $this->userTable WHERE userEmail = '$email'";
        log_message('info', 'User_mdl::getUserIDUsername() is executing a query ' . $select);
        $dump = $this->db->query($select);
        foreach($dump->result() as $row){
            $userID = $row->userID;
            log_message('debug', 'User_mdl::getUserIDUsername() has fetched the userid ' . $userID);
        }
        return $userID;
    }

    function getFirstName(){
        $this->userUserID = $this->session->userdata('userid');
        
        $getName = "SELECT userFirstName
        FROM $this->userTable
        WHERE userID = $this->userUserID LIMIT 1";

        
        $excQuery = $this->db->query($getName);
        foreach ($excQuery->result() as $row){
            $firstName = $row->userFirstName;
            
        }
        return $firstName;
    }

    
   
}
?>
