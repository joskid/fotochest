<?php

class Users extends Controller {

    public function __construct(){
        parent::Controller();
        $this->User_mdl->userTable = $this->config->item('userTable');
    }
  
  public function login(){
    

    // Load Validation

    $this->load->library('form_validation');
    $this->form_validation->set_rules('userEmail', 'Email Address', 'required|xss_clean');
    $this->form_validation->set_rules('userPassword', 'Password', 'required|xss_clean');

    // Run Validation

    if(!$this->form_validation->run())
    {
        $this->data['error'] = FALSE;
        $this->load->view('admin/userLogin', $this->data);
    }
    else
    {
        $this->User_mdl->userEmail = $this->input->post('userEmail');
        $this->User_mdl->userPassword = $this->input->post('userPassword');
        $userID = $this->User_mdl->login();
        if ($userID != -1)
        {
            redirect('admin/dashboard');
        }
        else
        {
            redirect('users/loginError/2');
        }
    }



    
  }
  
  public function loginError($errorType){
    $this->data['error'] = TRUE;
    if ($errorType == 1){
      $this->data['errorMsg'] = "You have logged out.";
    }
    if ($errorType == 2){
      $this->data['errorMsg'] = "Username/Password combination is incorrect.";
    }
    $this->load->view('admin/userLogin', $this->data);
  }
  
 
  
  public function register(){
        $this->load->view('admin/modals/addUser');
    }
    
    public function do_register(){
        log_message('debug', 'Attempt made to register');
        
        $this->User_mdl->userEmail = $this->input->post('userEmail');
        $this->User_mdl->userPassword = $this->input->post('userPassword');
        $this->User_mdl->userFirstName = $this->input->post('userFirstName');
        $this->User_mdl->userLastName = $this->input->post('userLastName');
        $this->User_mdl->register();
        
    }
  
  public function logout(){
    $this->User_mdl->logout();
    redirect('users/loginError/1');
    
  }
  
    public function forgotPassword(){

        $this->load->library('form_validation');

        $this->form_validation->set_rules('userEmail', 'Email Address', 'required|xss_clean');

        if (!$this->form_validation->run())
        {
            $this->load->view('admin/forgotPassword');
        }
        else
        {

            $this->User_mdl->userEmail = $this->input->post('userEmail');
            $this->load->helper('string');
            $pass = random_string('alnum', 10);
            $message = $this->User_mdl->resetPassword($pass);
            // Print $message to debug.
            $this->data['message'] = "Your password has been reset and emailed to your account.";
            $this->load->view('admin/forgotPassword', $this->data);
        }
        

    }
  
}

?>