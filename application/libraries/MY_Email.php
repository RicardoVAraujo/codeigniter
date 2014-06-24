<?php

class MY_Email extends CI_Email{
    
    private $config = array();
    
    public function __construct(){
        parent::__construct();
    }
    
    public function setConfiguration(){
        
        $this->config['protocol'] = 'sendmail';
        $this->config['smtp_host'] = '';
        $this->config['smtp_user'] = '';
        $this->config['smtp_pass'] = '';
        $this->config['smtp_port'] = '';
        $this->config['charset'] = 'utf-8';
        $this->config['mailtype'] = 'html';
        return $this->config;    
        
    }
    
}