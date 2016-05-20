<?php

final class AlunoDao extends Base {

    public function __construct() {
        parent::__construct("turmas",TRUE);
        $this->conectar();
    }

    public function isert($nome, $iddados) {
        $this->insertBase(array("null", "'{$nome}'", "'{$iddados}'"));
    }

    public function selectPorIdDados() {
        $this->setPdo($this->conectar());
        $this->iniciarTransacoes();
        $res = $this->selectBase();
        $this->insertBase(ARRAY(1,1));
        $this->insertBase(ARRAY(2,1));
        $this->insertBase(ARRAY(3,1));
        parent::__construct("turma",TRUE);
        $this->insertBase(ARRAY(4,1));
        $this->insertBase(ARRAY(5,1));
        $this->insertBase(ARRAY(6,1));
        $this->finalizarTransacoes();
//        var_dump($res);
//        $dados = array();
//        foreach ($res as $row) {
//            $dados[] = new Aluno(
//                    $row['idaluno'], $row['nome'], NULL);
//        }

//        return $dados;
    }

    public function selectUId($iddados) {
        $res = $this->selectBase("*", "where iddados='{$iddados}' order by idaluno DESC  limit 1");
        $id;
        foreach ($res as $row) {
            $id = $row['idaluno'];
        }
        return $id;
    }

}
