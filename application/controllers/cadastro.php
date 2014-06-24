<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cadastro extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("form");
        $this->load->library('form_validation');
    }

    public function index() {
        $data['view'] = 'cadastro.phtml';
        $data['titulo'] = 'Pagina de contato';
        $this->load->view('site.phtml', $data);
    }

    public function register() {

        if ($_POST) {

            /* pegar dados do form e colocar em variaveis */
            $titulo = $this->input->post('filme');
            $descricao = $this->input->post('descricao');

            /* verificar se os campos estao vazios */
            $this->form_validation->set_rules('filme', 'Filme', 'trim|required|is_unique[filmes.filme_nome]');
            $this->form_validation->set_rules('descricao', 'Descrição', 'required');

            /* verifica se retornou algum erro ao validar os campos */
            if (!$this->form_validation->run()) {
                $data['erro'] = validation_errors();
            } else {
                $this->load->library('upload');

                /* renomear foto */
                $nome_atual = $_FILES['userfile']['name'];
                $extensao = end(explode('.', $nome_atual));
                $novo_nome = uniqid() . '.' . $extensao;

                $this->upload->setName($novo_nome);
                $this->upload->setTypes('jpeg|jpg|png');
                $this->upload->setWidth(500);
                $this->upload->setHeight(500);
                $this->upload->setPath('./public/arquivos/');
                $this->upload->setSize(200);

                $config = $this->upload->setConfiguration();
                $this->upload->initialize($config);

                /* fazer upload da foto */
                if (!$this->upload->do_upload()) {
                    $data['erro'] = $this->upload->display_errors();
                } else {

                    $data_upload = $this->upload->data();

                    /* faz resize da foto */
                    $this->load->library('image_lib');
                    $this->image_lib->setPath($_FILES['userfile']['tmp_name']);
                    $this->image_lib->setNew($data_upload['file_path'] . 'thumbs/' . $data_upload['file_name']);
                    $this->image_lib->setLargura(200);
                    $this->image_lib->setAltura(150);
                    $config_resize = $this->image_lib->setConfiguration();
                    $this->image_lib->initialize($config_resize);

                    if (!$this->image_lib->resize()) {
                        unlink($data_upload['full_path']);
                        echo $this->image_lib->display_errors();
                    } else {
                        /* cadastrar dados filme */
                        $this->load->model('Filmes_Model');
                        $attributes = array(
                            'filme_nome' => $titulo,
                            'filme_descricao' => $descricao,
                            'filme_foto' => 'public/arquivos/'.$data_upload['file_name'],
                            'filme_thumb' => 'public/arquivos/thumbs/' . $data_upload['file_name']
                        );
                        $this->Filmes_Model->create('filmes',$attributes);
                    }
                }
            }
        }

        $data['view'] = 'cadastro.phtml';
        $data['titulo'] = 'Pagina de contato';
        $this->load->view('site.phtml', $data);
    }

}