<?php

final class DeclaracoesDao extends Base {

    public function __construct() {
        parent::__construct("declaracoes");
        $this->conectar();
    }

    public function selectTodos() {
        $res = $this->selectBase();
        $segmento = array();
        foreach ($res as $row) {
            $segmento[] = new Declaracoes(
                    $row['id'], $row['nome'], $row['tipo']);
        }
        return $segmento;
    }

}
