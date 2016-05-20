<?php

final class Triagem {

    private $id;
    private $data;
    private $status;
    private $idtriagista;
    private $texto;
    function __construct($id, $data, $status, $idtriagista, $texto) {
        $this->id = $id;
        $this->data = $data;
        $this->status = $status;
        $this->idtriagista = $idtriagista;
        $this->texto = $texto;
    }
    function getId() {
        return $this->id;
    }

    function getData() {
        return $this->data;
    }

    function getDatabr() {
        $t=substr($this->data, 8,2) . '/' . substr($this->data, 5, 2) . '/' . substr($this->data, 0, 4). ' as ' . substr($this->data, 11);
        return $t;
    }

    function getStatus() {
        return $this->status;
    }

    function getIdtriagista() {
        return $this->idtriagista;
    }

    function getTexto() {
        return $this->texto;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setIdtriagista($idtriagista) {
        $this->idtriagista = $idtriagista;
    }

    function setTexto($texto) {
        $this->texto = $texto;
    }



}
