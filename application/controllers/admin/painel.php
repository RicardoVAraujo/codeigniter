<?php

class Painel extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['titulo'] = 'Painel do administrador';
        $data['view'] = 'admin/home.phtml';
        $this->load->view('admin/painel.phtml', $data);
    }

}
