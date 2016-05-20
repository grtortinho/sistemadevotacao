<?php

final class TriagemDao extends Base {

    public function __construct() {
        parent::__construct("triagem");
        $this->conectar();
    }

    public function insert($status, $idtriagista, $texto, $idusuario) {
        $this->insertBase(array('null', date("Y-m-d H:i:s"),$status, $idtriagista, $texto, $idusuario));
    }

    public function selectTodos() {
        $res = $this->selectBase();
        $s = new SegmentoDao();
        $triagista = array();
        foreach ($res as $row) {
            $triagista[] = new Triagista(
                    $row['idusuario'], $row['nome'], $s->selectPorId($row['segmento'])
            );
        }
        return $triagista;
    }

    public function selectPorId($id) {
        $res = $this->selectBase('*', 'where idusuario=?', $id);
        $s = new SegmentoDao();
        $triagista = array();
        foreach ($res as $row) {
            $triagista[] = new Triagem(
                    $row['id'], $row['data'], $row['status'], $row['idtriagista'],
                    $row['texto']
                    , $row['idusuario'] );
        }
        return $triagista;
    }

    public function deletekao($id) {
        $this->deleteBase($id,'WHERE id=? order by status limit 1');
            
    }

}
