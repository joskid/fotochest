<?php

class Authentication_mdl extends CoreModel {

    private $email;
    private $password;
    private $salt;
    private $username;
    private $firstName;
    private $lastName;
    private $active;



    public function __construct()
    {
        parent::__construct();
        $this->primaryKey = 'user_id';
        $this->_table = $this->config->item('authTable');
        log_message('info', 'Auth table should be loaded ' . $this->_table);
    }

    public function checkUser($email)
    {
        return $this->db->where('email', $email)
                        ->get($this->_table);
        
    }

    public function getLogin($email)
    {
        return $this->db->select('user_id, email, password, salt')
                        ->where('email', $email)
                        ->get($this->authTable);
    }

    public function createUser($data)
    {
        $this->ci->db->where('status', 1)
                     ->insert($this->_table, $data);

        return $this->ci->db->insert_id();
    }
    public function  __destruct() {
        parent::__destruct();
    }
}
?>
