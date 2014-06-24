<?php

class Filmes_Model extends MY_Model {
    
    function __construct() {
        parent::__construct();
    }

    public function buscar_filmes($filme_nome, $por_pagina, $inicio) {
        $this->db->like('filme_nome', $filme_nome)->limit($por_pagina, $inicio);
        return $this->db->get('filmes')->result();
    }

    public function get_total_filmes_busca($filme_nome) {
        $this->db->like('filme_nome', $filme_nome);
        $query = $this->db->get('filmes');
        return $query->num_rows();
    }

}