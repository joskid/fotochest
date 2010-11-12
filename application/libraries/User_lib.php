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
* @link                 <http://fotochest.com>
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
    var $userID;
    var $userPassword;
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
        $userData = $this->ci->User_mdl->readEmail($this->userEmail);
        
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
                       'email'=> $storedEmail,
                       'userid'=> $storedUserID,
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

        // Encrypt the password
        $encryptPassword = $this->ci->encrypt->encode($this->userPassword);
        
        // Load the User Model
        $this->ci->load->model('User_mdl');
        
        // Set properties for the update
       
        $this->ci->User_mdl->userID = $this->userID;

        $data = array('userPassword'=>$this->userPassword,
                      'userFirstName'=>$this->userFirstName,
                      'userLastName'=>$this->userLastName,
                      'userEmail'=>$this->userEmail);

        // Fire off the update
        $this->ci->User_mdl->update($data);
    }

    function resetPassword($password)
    {

        // Load encryption library
        $this->ci->load->library('encrypt');

        // Load the User Model
        $this->ci->load->model('User_mdl');

        // Find User ID;
        $this->userID = $this->ci->User_mdl->getUserIDFromEmail($this->userEmail);

        $pass_encrypt = $this->ci->encrypt->encode($password);
        $data = array('userPassword'=>$pass_encrypt);

        // Fire the Update
        $this->ci->User_mdl->update($data);
        
        // Load email helper
        $this->ci->load->helper('email');
        if(valid_email($this->userEmail)){
            
            // Load email library
            $this->ci->load->library('email');

            $this->ci->email->from('support@fotochest.com', 'FotoChest Support');
            $this->ci->email->to($this->userEmail);


            $this->ci->email->subject('Your Password has been reset.');
            $this->ci->email->message('Your password has been set to ' . $password);

            $this->ci->email->send();
            $message = $this->ci->email->print_debugger();

            return $message;
        }
    }
}
?>
