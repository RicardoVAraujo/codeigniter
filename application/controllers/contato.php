<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contato extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("form");
    }

    public function index() {
        $data['view'] = 'contato.phtml';
        $data['titulo'] = 'Pagina de contato';
        $this->load->view('site.phtml', $data);
    }

    public function enviar() {
      
        if ($this->input->post('enviar')) {
            $this->load->library('form_validation');

            $this->form_validation->set_rules("nome", "Nome", "trim|required");
            $this->form_validation->set_rules("mail", "E-mail", "trim|required|valid_email");

            if (!$this->form_validation->run()) {
                $data['errors'] = validation_errors();
            } else {
                $this->load->library('email');
                $config = $this->email->setConfiguration();
                $this->email->initialize($config);

                $this->email->to('contato@asolucoesweb.com.br');
                $this->email->from($this->input->post('mail'));
                $this->email->subject($this->input->post('assunto'));
                $this->email->message($this->input->post('mensagem'));
            
                
                if ($this->email->send()) {
                    $data['enviado'] = true;               
                }
            }
        }
     
        $data['view'] = 'contato.phtml';
        $data['titulo'] = 'Pagina de contato';
        $this->load->view('site.phtml', $data);
    }

}