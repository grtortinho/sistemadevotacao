<?php

final class Anexo {

    private $id;
    private $nome;
    private $tipo;
    function __construct($id, $nome, $tipo) {
        $this->id = $id;
        $this->nome = $nome;
        $this->tipo = $tipo;
    }
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }



}
