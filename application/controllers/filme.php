<?php

class Filme extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function detalhes() {
        $this->load->helper("form");
        $this->load->model('Filmes_Model');
        
        $tabela = 'filmes';
        $where = ['id', $this->uri->segment(3)];
        $data['filme_encontrado']=$this->Filmes_Model->find_by_id($tabela, $where);

        $data['titulo'] = 'detalhes';
        $data['view'] = 'detalhes.phtml';
        $this->load->view('site.phtml', $data);
    }

}
