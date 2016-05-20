<?php

class DadosSesao extends Secao {

    public function criarDado($nome, $dado) {
        $this->criarSecao($nome, $dado);
    }

    public function apagarDado($nome) {
        $this->apagarSecao($nome);
    }

    public function verDado($nome) {
        return $this->getSecao($nome);
    }

}
