<?php

final class Voto {

    private $id;
    private $voto;
    private $nome;
    private $segmento;
    function __construct($id, $voto, $nome, $segmento) {
        $this->id = $id;
        $this->voto = $voto;
        $this->nome = $nome;
        $this->segmento = $segmento;
    }
    function getId() {
        return $this->id;
    }

    function getVoto() {
        return $this->voto;
    }

    function getNome() {
        return $this->nome;
    }

    function getSegmento() {
        return $this->segmento;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setVoto($voto) {
        $this->voto = $voto;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSegmento($segmento) {
        $this->segmento = $segmento;
    }




}
