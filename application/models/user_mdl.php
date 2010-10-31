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
    var $userUserID;
    var $userName;
    var $userPassword;
    var $userGroupID;
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
                          'userPassword'=>$this->userPassword);

        $this->db->insert($this->userTable, $userData);

    }

    function read($userID = null)
    {
        if($userID == null)
        {
            $readData = $this->db->get($this->userTable);
        }
        else
        {
            $readData = $this->db->get_where($this->userTable, array('userID'=>$userID));
        }
        return $userID;
    }

    public function readEmail($userEmail)
    {
        $readData = $this->db->get_where($this->userTable, array('userEmail'=>'$userEmail'));
        return $readData;
    }
    

    function update()
    {
        $userData = array('email'=>$this->userEmail,
                          'firstName'=>$this->userFirstName,
                          'lastName'=>$this->userLastName);


        $this->db->where('userID', $this->userID);
        $this->db->update($this->userTable, $data);
    }

    function delete($userID)
    {
        $this->db->delete($this->userTable, array('userID'=>$userID));
    }


    // User Methods

    // Login Method

   
    // Logout Method



    function getUsers(){
        $select = "SELECT * FROM $this->userTable";
        log_message('info', 'User_mdl::getUsers() is executing a query ' . $select);
        $dump = $this->db->query($select);
        return $dump;
    }

    function getUserInfo($userID){
        $select = "SELECT * FROM $this->userTable WHERE userID = $userID LIMIT 1";
        log_message('info', 'User_mdl::getUserInfo() is executing a query ' . $select);
        $dump = $this->db->query($select);
        return $dump;
    }

    function getUserPassword($userID){
        $select = "SELECT * FROM $this->userTable WHERE userID = $userID LIMIT 1";
        log_message('info', 'User_mdl::getUserPassword() is executing a query ' . $select);
        $dump = $this->db->query($select);
        foreach($dump->result() as $row){
            $encryptPass = $row->pass;
        }

        $decode = $this->encrypt->decode($encryptPass);
        return $decode;
    }

    
    function getCurrentUser(){
        $this->userUserID = $this->session->userdata('UserID');
        
        $userQuery = "SELECT email FROM $this->userTable WHERE userID = $this->userUserID LIMIT 1";

        $executeQuery = $this->db->query($userQuery);
        foreach ($executeQuery->result() as $row){
            $this->userEmail = $row->Email;
        }
        return $this->userEmail;
    }

    function saveUser(){

        $encryptPass = $this->encrypt->encode($this->userPassword);

        $data = array('email'=>$this->userEmail, 'pass'=>$encryptPass, 'firstName'=>$this->userFirstName, 'lastName'=>$this->userLastName);
        $where = "userID = $this->userUserID";
        $updateString = $this->db->update_string($this->userTable, $data, $where);
        log_message('info', 'User_mdl::saveUser() is trying to execute a query ' . $updateString);
        $this->db->query($updateString);
    }

    function deleteUser(){
        $delete = "DELETE FROM $this->userTable WHERE userID = $this->userUserID";
        log_message('info', 'User_mdl::deleteUser() is trying to execute a query ' . $delete);
        $this->db->query($delete);
    }
    
    function changePassword($oldPassword, $newPassword, $userEmail){
        
        $this->userEmail = $userEmail;
        
        $getOldPassword = "SELECT * FROM $this->userTable WHERE email = $this->userEmail";
        $getPass = $this->db->query($getOldPassword);
        foreach ($getPass->result() as $row){
            $dbOldPassword = $row->Pass;
        }
        if ($oldPassword == $dbOldPassword){
            // Continue changing the password
            $setData = array('Pass'=>$newPassword);
            $setQuery = $this->db->update_string($setData, $userTable);
            $this->db->query($setQuery);
        } else {
            return -1;
        }
    }

    function resetPassword($password){

        $pass_encrypt = $this->encrypt->encode($password);
        $data = array('pass'=>$pass_encrypt);
        $where = "email = '$this->userEmail'";
        $setQuery = $this->db->update_string($this->userTable, $data, $where);
        $this->db->query($setQuery);
        $this->load->helper('email');
        if(valid_email($this->userEmail)){
            $this->load->library('email');

            $this->email->from('support@fotochest.com', 'FotoChest Support');
            $this->email->to($this->userEmail);
           

            $this->email->subject('Your Password has been reset.');
            $this->email->message('Your password has been set to ' . $password);

            $this->email->send();
            $message = $this->email->print_debugger();

            return $message;
        }

    }

  

    public function getUserName(){
        $userName = $this->session->userdata('username');
        return $userName;
    }
    public function getUserID(){
        $userID = $this->session->userdata('userid');
        return $userID;
    }

    public function getUserIDUsername($userName){
        $select = "SELECT userID FROM $this->userTable WHERE email = '$userName'";
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
        
        $getName = "SELECT FirstName
        FROM $this->userTable
        WHERE UserID = $this->userUserID LIMIT 1";

        
        $excQuery = $this->db->query($getName);
        foreach ($excQuery->result() as $row){
            $firstName = $row->FirstName;
            
        }
        return $firstName;
    }

    
   
}
?>
