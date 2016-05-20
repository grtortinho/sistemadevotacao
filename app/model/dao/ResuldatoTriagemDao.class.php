<?php

final class ResuldatoTriagemDao extends Base {

    public function __construct() {
        parent::__construct("resuldatotriagem");
        $this->conectar();
    }

    
    public function update($id, $nome, $segmento, $status,$tipo) {
        $this->updateBase(array($nome,$segmento,$status,$tipo, $id),
                array('nome','segmento','status','tipo'), 'where id=?');
    }
    public function inserir($id, $nome, $segmento, $status,$tipo) {
        $this->insertBase(array($id, $nome, $segmento, $status,$tipo));
    }

    public function select() {
        $res = $this->selectBase('*','where 1 order by nome');
        $resu = array();
        foreach ($res as $row) {
            $resu[] = new ResuldatoTriagem(
                    $row['id'], $row['nome'], $row['segmento'], $row['status'], $row['tipo']);
        }

        return $resu;
    }
    public function selectStatus($status) {
        $res = $this->selectBase('*','where status=? order by nome',$status);
        $resu = array();
        foreach ($res as $row) {
            $resu[] = new ResuldatoTriagem(
                    $row['id'], $row['nome'], $row['segmento'], $row['status'], $row['tipo']);
        }

        return $resu;
    }
    public function selectnome($nome) {
        $res = $this->selectBase('*',"where nome='{$nome}' order by nome");
        $resu = array();
        foreach ($res as $row) {
            $resu[] = new ResuldatoTriagem(
                    $row['id'], $row['nome'], $row['segmento'], $row['status'], $row['tipo']);
        }

        return $resu;
    }
    public function selectkao() {
        $res = $this->selectBase(array('count(nome) as v', 'nome' ),
            'GROUP BY nome HAVING COUNT(nome) > 1 ORDER BY count(nome) DESC');
        $resu = array();
        foreach ($res as $row) {
            $resu[] = array(
                    $row['v'],
                    $row['nome']
                    );
        }

        return $resu;
    }
    public function deletekao($id) {
        $this->deleteBase($id,'WHERE id=? order by status limit 1');
    }
    public function deletekaostatus($id,$status) {
        $this->deleteBase(array($id,$status),'WHERE id=? and status=? order by status limit 1');
    }


}
