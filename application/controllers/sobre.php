<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sobre extends CI_Controller {

    public function index() {

        $this->load->model('Filmes_Model');
        $this->Filmes_Model->create(array(
            'filme_nome' => 'predador 2',
            'filme_descricao' => 'continucao de o predador'
        ));
        $data['titulo'] = 'sobre a empresa';
        $data['view'] = 'sobre.phtml';
        $this->load->view('site.phtml', $data);
    }

}