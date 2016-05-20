<?php

final class ResuldatoTriagem {
    private $id;
    private $nome;
    private $segmento;
    private $status;
    private $tipo;
    function __construct($id, $nome, $segmento, $status, $tipo) {
        $this->id = $id;
        $this->nome = $nome;
        $this->segmento = $segmento;
        $this->status = $status;
        $this->tipo = $tipo;
    }
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getSegmento() {
        return $this->segmento;
    }

    function getStatus() {
        return $this->status;
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

    function setSegmento($segmento) {
        $this->segmento = $segmento;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }


}
