<?php

class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->uri->segment(1) === 'admin') {
            if (!$this->session->userdata('logado')) {
                redirect('admin/login');
            }
        }
    }

}