<?php

final class SegmentoDao extends Base {

    public function __construct() {
        parent::__construct("segmento");
        $this->conectar();
    }

    public function selectTodos() {
        $res = $this->selectBase();
        $segmento = array();
        foreach ($res as $row) {
            $segmento[] = new Segmento(
                    $row['id'], $row['nome']);
        }
        return $segmento;
    }
    public function selectPorId($id) {
        $res = $this->selectBase('*','where id=?',$id);
        $segmento;
        foreach ($res as $row) {
            $segmento = new Segmento(
                    $row['id'], $row['nome']);
        }
        return $segmento;
    }

    public function alterar($id,$nome) {
        $this->updateBase(array($nome, $id), 'nome', 'where id=?');
    }

    public function insert($segmento) {
        $this->insertBase(array('null',$segmento));
    }
}
