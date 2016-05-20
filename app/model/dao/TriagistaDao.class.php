<?php

final class TriagistaDao extends Base {

    public function __construct() {
        parent::__construct("triagista");
        $this->conectar();
    }

    public function insert($idusuario, $nome) {
        $this->insertBase(array($idusuario, $nome));
    }

    public function selectTodos() {
        $res = $this->selectBase();
        $triagista = array();
        foreach ($res as $row) {
            $triagista[] = new Triagista(
                    $row['idusuario'], $row['nome'],null
            );
        }
        return $triagista;
    }

    public function selectTodosSemLogardo($id) {
        $res = $this->selectBase('*', 'where idusuario!=? order by idusuario', $id);
        $u = new usuarioDao();
        $triagista = array();
        foreach ($res as $row) {
            $triagista[] = new Triagista(
                    $row['idusuario'], $row['nome'],$u->selectPorId($row['idusuario'])
            );
        }
        return $triagista;
    }

    public function alterar($id,$nome,$email,$status) {
        $u = new usuarioDao();
        $this->updateBase(array($nome, $id), 'nome', 'where idusuario=?');
        $u->alterar($id,$email,$status);
    }


    public function selectPorId($id) {
        $res = $this->selectBase('*', 'where idusuario=?', $id);
        $u = new usuarioDao();
        $triagista = null;
        foreach ($res as $row) {
            $triagista = new Triagista(
                    $row['idusuario'], $row['nome'],$u->selectPorId($row['idusuario']));
        }
        return $triagista;
    }

}
