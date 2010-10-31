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
* User Library
*
* @package		FotoChest
* @category		Libraries
* @author		Derek Stegelman
*/

class User_lib {

    // CI Super Object
    private $ci;

    // Object Properties

    var $userEmail;
    var $userUserID;
    var $userName;
    var $userPassword;
    var $userGroupID;
    var $userLastName;
    var $userFirstName;
    var $userDateCreated;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function login()
    {
        // Variable Check
        if (!isset($this->userEmail) || !isset($this->userPassword))
        {
            return -1;
        }

        $this->ci->load->model('User_mdl');
        $userData = $this->ci->User_mdl->read($this->userEmail);

        // Check to make sure there is at least one record.
        if ($userData->num_rows() == 0)
        {
            log_message('debug', 'User Library: $query->num_rows() returned a null or 0 value.');
            return -1;
        }
        else
        {
            foreach($userData->result() as $user)
            {
                $storedPassword = $user->userPassword;
                $storedUserID = $user->userID;
                $storedEmail = $user->userEmail;
            }

            // Load encryption library
            $this->ci->load->library('encrypt');

            $decodedPassword = $this->ci->encrypt->decode($storedPassword);

            if($decodedPassword == $this->userPassword)
            {
                log_message('debug', 'User_mdl: User ' . $this->userEmail . ' has logged in successfully.');
                $newdata = array(
                       'isLoggedIn'  => '1',
                       'email'=> $dbEmail,
                       'userid'=> $dbUserID,
                   );
                $this->ci->session->set_userdata($newdata);
                return $storedUserID;
            }
            else
            {
                log_message('debug', 'User_mdl: User ' . $this->userEmail . ' could no be authenticated.');
                return -1;
            }
        }
    }

    public function logout()
    {
        $this->ci->session->sess_destroy();
    }

    public function isLoggedIn()
    {
        if ($this->ci->session->userdata("isLoggedIn") == 1)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    public function register()
    {
        // Load the Encryption LIbrary
        $this->ci->load->library('encrypt');

        // Encrypt the password.
        $encryptedPassword = $this->ci->encrypt->encode($this->userPassword);

        // Load the User Model
        $this->ci->load->model('User_mdl');

        // Set the properties to add a user
        $this->ci->User_mdl->userPassword = $encryptedPassword;
        $this->ci->User_mdl->userEmail = $this->userEmail;
        $this->ci->User_mdl->userFirstName = $this->userFirstName;
        $this->ci->User_mdl->userLastName = $this->userLastName;

        // Fire off the create
        $this->ci->User_mdl->create();
        
    }

    public function saveUser()
    {
        // Load the encryption library
        $this->ci->load->library('encrypt');

        $encryptPassword = ;

        
    }



}
?>
