<?php

final class DeclaracaoDao extends Base {

    public function __construct() {
        parent::__construct("declaracao");
        $this->conectar();
    }

    public function insert($id, $nome, $tipo) {
        $this->insertBase(array("null", $nome, $tipo,$id));
    }


    public function selectPorIdUsu($id) {
        $res = $this->selectBase("*", "where idusuario=?",$id);
        $dados = array();
        foreach ($res as $row) {
            $dados[] = new Declaracao(
                    $row['id'], $row['nome'],$row['tipo']);
        }

        return $dados;
    }

}
