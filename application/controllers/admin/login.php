<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->helper('form');
        $this->load->model('Login_Model');

        if ($_POST) {
            /* pegar dados do form */
            $login = $this->input->post('login');
            $senha = $this->input->post('senha');
            
            $dadosLogin = $this->Login_Model->login($login, $senha);
            if(count($dadosLogin) == 1){
                $dadosAdmin=array(
                    'logado' => true,
                    'nome_admin' => $dadosLogin->admin_nome
                );
                $this->session->set_userdata($dadosAdmin);
                redirect('admin/painel');
            }else{
                $data['erro'] = true;
            }
        }
        
        $data['titulo'] = 'login';
        $this->load->view('admin/login.phtml', $data);
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect('admin/login');
    }

}
