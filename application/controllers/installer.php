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
* Installer Controller
*
* @package		FotoChest
* @category		Installer
* @author		Derek Stegelman
*/

class Installer extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function index(){

        $this->load->view('admin/userLogin');

    }

    public function install(){
         //$this->load->library('form_validation');
         $this->load->model('User_mdl');

    

        // Create/load the tables first.

//        $this->load->dbforge();
//
//        //Add the columns.
//
//        $fields = array(
//                        'settingID' => array(
//                                                 'type' => 'INT',
//                                                 'auto_increment' => TRUE
//                                          ),
//                        'settingName' => array(
//                                                 'type' => 'publicCHAR',
//                                                 'constraint' => '100',
//                                          ),
//                        'settingValue' => array(
//                                                 'type' =>'publicCHAR',
//                                                 'constraint' => '300',
//                                                 'null' => TRUE
//
//                                          ),
//
//                );
//        $this->dbforge->addField($fields);
//        $this->dbforge->create_table($this->input->post('tablePrefix') . 'photoSettings');



        $this->load->helper('string');
        $pass = random_string('alnum', 10);
        $this->load->library('user_lib');

        $this->user_lib->userEmail = "admin@admin.com";
        $this->user_lib->userPassword = "admin";
        $this->user_lib->userFirstName = "admin";
        $this->user_lib->userLastName = "admin";
        $this->user_lib->register();
            
    }


   
}
?>
