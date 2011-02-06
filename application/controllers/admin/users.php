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
* @category		Admin Controllers
* @author		Derek Stegelman
*/


class Users extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('user');
    }

    public function index(){

        $this->template->write('title', 'Users');
        $this->data['showAlbum'] = FALSE;
        $this->data['showUserButton'] = TRUE;
        $this->data['pageNum'] = 5;

        // Load the model
        $this->load->model('User_mdl');


        $this->data['users'] = $this->User_mdl->get();

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
        $this->data['userInfo'] = $this->User_mdl->get($userID);

        $this->load->view('admin/modals/editUser', $this->data);
    }

    function do_userSave(){

        $this->user->id = $this->input->post('userUserID');

        // Call Save User
        $this->user->saveUser();



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

    function do_userDelete()
    {
        $this->User_mdl->delete($this->input->post('id'));
    }
    
    function deleteUser($id)
    {

        $this->data['id'] = $id;
        $this->load->view('admin/modals/deleteUser', $this->data);
    }

   

}
?>
