<?php

final class TextoDao extends Base {

    public function __construct() {
        parent::__construct("textos");
        $this->conectar();
    }

    public function insert($idusuario, $curriculo, $proposta, $justificativa) {
        $this->insertBase(array("null", $idusuario, $curriculo, $proposta, $justificativa));
    }

    public function selectPorIdUsu($id) {
        $res = $this->selectBase('*', 'where idusuario=?', $id);
        $dados ;
        foreach ($res as $row) {
            $dados = new Texto(
                    $row['id'], $row['curriculo'], $row['proposta'], $row['justificativa']);
        }

        return $dados;
    }

}
