<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model("Filmes_Model");
        $this->load->helper("form");
        $this->load->helper('text');
    }

    public function index() {

        $por_pagina = 4;
        $inicio = $this->uri->segment(2);
        $orderby = ['filme_nome', 'ASC'];
        $tabela='filmes';
        $data['filmes_encontrados'] = $this->Filmes_Model->FindWithPagination($tabela, $por_pagina, $inicio, $orderby);
        $data['view'] = 'home.phtml';
        $data['titulo'] = 'Pagina inicial do curso de codeigniter';

        /* dados para paginacao */
        $this->load->library('pagination');
        $config['base_url'] = base_url() . 'page/';
        $config['per_page'] = $por_pagina;
        $config['total_rows'] = $this->Filmes_Model->num_rows($tabela);
        $config['num_links'] = 5;
        $config['first_url'] = '1';
        $config['uri_segment'] = 2;

        /* inciailizar a paginacao */
        $this->pagination->initialize($config);
        /* criar links da paginacao */
        $data['paginacao_filmes'] = $this->pagination->create_links();

        $this->load->view('site.phtml', $data);
    }

}