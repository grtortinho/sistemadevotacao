<?php

final class AnexoDao extends Base {

    public function __construct() {
        parent::__construct("anexo");
        $this->conectar();
    }

    public function insert($id, $nome,$tipo) {
        $this->insertBase(array("null", $nome,$id,$tipo));
    }

    public function selectPorIdUsu($id) {
        $res = $this->selectBase("*", "where idusuario=?",$id);
        $dados = array();
        foreach ($res as $row) {
            $dados[] = new Anexo(
                    $row['id'], $row['nome'], $row['tipo']);
        }

        return $dados;
    }


}
