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
* Admin User Controller
*
* @package		FotoChest
* @category		Controllers
* @author		Derek Stegelman
*/


class Users extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index(){

        $this->template->write('title', 'Users');
        $this->data['showAlbum'] = FALSE;
        $this->data['showUserButton'] = TRUE;
        $This->data['pageNum'] = 5;

        // Load the model
        $this->load->model('User_mdl');


        $this->data['users'] = $this->User_mdl->read();

        // Build View
        $this->template->write_view('navigation', 'admin/partials/nav', $this->data);
        $this->template->write_view('sidebar', 'admin/partials/sidebar', $this->data);
        $this->template->write_view('content', 'admin/partials/users', $this->data);
        $this->template->render();
    }

    public function addUser(){
        $this->load->view('admin/modals/addUser');
    }

    public function editUser($userID){

        // Load the model
        $this->load->model('User_mdl');
        $this->data['userInfo'] = $this->User_mdl->read($userID);

        $this->load->view('admin/modals/editUser', $this->data);
    }

    function do_userSave(){

        // @todo move this.
        $this->User_mdl->userEmail = $this->input->post('userEmail');
        $this->User_mdl->userPassword = $this->input->post('userPassword');
        $this->User_mdl->userFirstName = $this->input->post('userFirstName');
        $this->User_mdl->userLastName = $this->input->post('userLastName');
        $this->User_mdl->userUserID = $this->input->post('userUserID');
        $this->User_mdl->saveUser();


    }
    public function do_register(){
        log_message('debug', 'Attempt made to register');

        $this->load->library('user_lib');

        $this->user_lib->userEmail = $this->input->post('userEmail');
        $this->user_lib->userPassword = $this->input->post('userPassword');
        $this->user_lib->userFirstName = $this->input->post('userFirstName');
        $this->user_lib->userLastName = $this->input->post('userLastName');
        $this->user_lib->register();

    }

    function do_userDelete(){

        // @todo move this.
        $this->load->model('User_mdl');
        $userID = $this->input->post('userUserID');
        $this->User_mdl->delete($userID);
    }
    



    function deleteUser($userID){

        $this->data['userID'] = $userID;
        $this->load->view('admin/modals/deleteUser', $this->data);
    }

   

}
?>
