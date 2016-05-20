<?php

final class UsuarioLogin extends Secao {

    function __construct() {
        
    }

    public function login($id, $login, $nome, $status) {
        if (!$this->verificarSecao('id')) {
            $this->criarSecao('id', $id);
            $this->criarSecao('login', $login);
            $this->criarSecao('nome', $nome);
            $this->criarSecao('status', $status);
            return TRUE;
        }  else {
            return FALSE;    
        }
    }

    public function logof() {
        $this->apagarSecao('id');
        $this->apagarSecao('login');
        $this->apagarSecao('nome');
        $this->apagarSecao('status');
    }

    public function getId() {
        return $this->getSecao('id');
    }

    public function getLogin() {
        return $this->getSecao('login');
    }

    public function getNome() {
        return $this->getSecao('mome');
    }

    public function getStatus() {
        return $this->getSecao('status');
    }
    
    public function verificar($senha=FALSE) {
        if ($this->verificarSecao('id')) {
            if($this->getStatus()>0 or $senha){
                return TRUE;
            }else{
                new Exibir("alterarsenhainicial", null);
                die();
            }
        }  else {
            return FALSE;
        }
    }
}
