<?php

final class Aluno {

    private $id;
    private $nome;
    private $turma;
    function __construct($id, $nome, $turma) {
        $this->id = $id;
        $this->nome = $nome;
        $this->turma = $turma;
    }
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getTurma() {
        return $this->turma;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setTurma($turma) {
        $this->turma = $turma;
    }


}
