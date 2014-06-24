<?php

class cart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Filmes_Model');
        $this->load->library('cart');
    }

    public function index() {
        if ($_POST) {

            $inserir = true;
            $produtos_no_carrinho = $this->cart->contents();

            /* dados para inserir o produto no carrinho */
            $id = $this->input->post('id');
            $qtd = $this->input->post('qtd');

            /* pegar dados para atualizar carrinho */
            foreach ($produtos_no_carrinho as $produto) {
                if ($produto['id'] === $id) {
                    $rowid = $produto['rowid'];
                    $qty = $produto['qty'] + $qtd;
                    $inserir = false;
                }
            }

            /* dados para pegar o filme do banco para adicionar ao carrinho */
            $tabela = 'filmes';
            $where = ['id', $id];
            $dados_carrinho = $this->Filmes_Model->find_by_id($tabela, $where);

            $insert = array(
                'id' => $dados_carrinho->id,
                'qty' => $qtd,
                'price' => $dados_carrinho->filme_preco,
                'name' => $dados_carrinho->filme_nome,
            );

            if ($inserir === true) {
                $this->cart->insert($insert);
            } else {
                $update = ['rowid' => $rowid, 'qty' => $qty];
                $this->cart->update($update);
            }
        }
        $data['titulo'] = 'carrinho de compras';
        $data['view'] = 'cart.phtml';
        $this->load->view('site.phtml', $data);
    }

    public function update() {
        $this->cart->update($_POST);
        redirect('cart');
    }
    
    public function delete(){
        $dados_update=['rowid'=>$this->uri->segment(3), 'qty' => 0];
        $this->cart->update($dados_update);
        redirect('cart');
    }
    
    public function limpar(){
       $this->cart->destroy();
       redirect('cart');
    }
}