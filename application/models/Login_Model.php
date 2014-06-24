<?php

class Login_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function login($login, $senha) {     
     $this->db->where('admin_login', $login);
     $this->db->where('admin_senha', $senha);
     $query=$this->db->get('admin');
     return $query->row();
        
    }

}