<?php

class Busca extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Filmes_Model');
        $this->load->helper('form');
        $this->load->helper('text');

    }

    public function filme() {

        if ($_GET || $this->uri->segment(5)) {

            $por_pagina = 2;
            $inicio = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
            $filme = ($this->input->get('q')) ? $this->input->get('q') : $this->uri->segment(3);

            $filmes_encontrados = $this->Filmes_Model->buscar_filmes($filme, $por_pagina, $inicio);
            $data['filmes_encontrados'] = $filmes_encontrados;
            
            /* dados para paginacao */
            $this->load->library('pagination');
            $config['base_url'] = base_url('busca/filme') . '/' . $filme . '/page/';
            $config['per_page'] = $por_pagina;
            $config['total_rows'] = $this->Filmes_Model->get_total_filmes_busca($filme);
            $config['num_links'] = 5;
            $config['first_url'] = '1';
            $config['uri_segment'] = 5;

            /* inciailizar a paginacao */
            $this->pagination->initialize($config);
            /* criar links da paginacao */
            $data['paginacao_filmes'] = $this->pagination->create_links();
        } else {
            //se nao clicou no form mandar para pagina inicial
            redirect( site_url() );
        }

        $data['view'] = 'busca.phtml';
        $data['titulo'] = 'Busca de filmes';
        $this->load->view('site.phtml', $data);
    }

}
