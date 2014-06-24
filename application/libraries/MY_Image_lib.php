<?php

class MY_Image_lib extends CI_Image_lib {

    private $path;
    private $largura;
    private $altura;
    private $new;
    private $config = array();

    public function getPath() {
        return $this->path;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function getLargura() {
        return $this->largura;
    }

    public function setLargura($largura) {
        $this->largura = $largura;
    }

    public function getAltura() {
        return $this->altura;
    }

    public function setAltura($altura) {
        $this->altura = $altura;
    }

    
    public function getNew() {
        return $this->new;
    }

    public function setNew($new) {
        $this->new = $new;
    }

    public function __construct() {
        parent::__construct();
    }

    public function setConfiguration() {
        $this->config['source_image'] = $this->getPath();
        $this->config['new_image'] = $this->getNew();
        $this->config['image_library'] = 'gd2';
        $this->config['create_thumb'] = FALSE;
        $this->config['maintain_ratio'] = TRUE;
        $this->config['width'] = $this->getLargura();
        $this->config['height'] = $this->getAltura();
        return $this->config;
    }

}